<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use App\Http\Requests;

use App\Http\Controllers\Directory;
use App\Http\Controllers\Official;



class Official_staff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->id=htmlentities(htmlspecialchars($id));
             
                $sql="SELECT passengers.id,passengers.uid,account_profile.profile_name,account_profile.position,account_profile.profile_image, account_profile.department as dept_name, account_profile.department_alias as dept_alias  FROM passengers LEFT JOIN account_profile on account_profile.uid=passengers.uid  where  tr_id=:id and type='staff'";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=Array('name'=>$row->profile_name,'uid'=>$row->uid,'id'=>$row->id,'designation'=>$row->position,'office'=>$row->dept_name,'profile_image'=>$row->profile_image,'alias'=>$row->dept_alias);
                }
                
                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();}


     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        $uid = $request->input('uid');
        $token = $request->input('_token');

        $passenger_class=new Official();
        $directory_class=new Directory();

        $tr=(@json_decode($passenger_class->show($id))[0]);

        $approver=@$tr->approved_by;

        if(!empty($id)&&!empty($uid)&&!empty($token)){
            
           try{

                $this->pdoObject=DB::connection()->getPdo();

                
                $insert_sql="INSERT INTO passengers(tr_id,uid)values(:tr_id,:uid)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':tr_id',$id);
                $insert_statement->bindParam(':uid',$uid);

                /*-------------------------
                | OFFICIAL IGNATORIES
                |--------------------------*/
                
                if($tr->request_type=='official'){
                    //if approving is one of the passengers
                    if(@$tr->approved_by_uid==$uid){ 
                        
                            //change signatory to ODDA here
                            // approver is the unit head by default, if he/she is one of the passengers,
                            // then he/she must follow the signatory hierarchy for official
                            
                            //check if not ODDA
                            if($tr->approved_by_uid!=25){
                                $directory_class->update_signatory_to_odda($tr->tr);  
                            }else{
                                //make OD as signatorie if ODDA is one of the passengers
                                 $directory_class->update_signatory_to_od($tr->tr); 
                            }      
                        
                    }else{
                        //if ODDA make the director as approving auth
                         if($uid==25){  
                            $directory_class->update_signatory_to_od($tr->tr); 
                         } 

                    }
                }


                if($tr->request_type=='personal'||$tr->request_type=='campus'){
                    //if GSU head is the passenger
                    //set current signatory to OODA deputy
                    //otherwise leave it as is
                    ///currently OODA =25
                    //GSU HEAD profile_id=5 , uid=105
                    if($uid==105){
                        $directory_class->update_signatory_to_odda($tr->tr); 
                        $directory_class->update_approval_recommending_to_null($tr->tr);    
                    }
                    

                }
                
  
                #exec the transaction
                $insert_statement->execute();
                $lastId=$this->pdoObject->lastInsertId();
          

                #return
                echo $lastId;

            }catch(Exception $e){ echo $e->getMessage();} 


        }else{
            echo 0;
        }
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    public function get_passenger_info($id){
        try{

                $this->pdoObject=DB::connection()->getPdo();

                
                $insert_sql="SELECT * FROM passengers where id=:id";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':id',$id);   
  
                #exec the transaction
                $insert_statement->execute();


                $res=Array();
                while($row=$insert_statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=$row;
                }
                
                return json_encode($res);

            }catch(Exception $e){ echo $e->getMessage();}    
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
                $passenger_class=new Official();
                $directory_class=new Directory();

                //default signatory
                $signatory=json_decode($directory_class->signatory_department($_SESSION['dept']));

                $this->pdoObject=DB::connection()->getPdo();
                $this->id=htmlentities(htmlspecialchars($id));

                $remove_rfp_sql="DELETE FROM passengers where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$id);

                //passenger info
                $passenger_info=(self::get_passenger_info($id));
                $pass=@json_decode($passenger_info)[0];

                //tr
                $tr=(@json_decode($passenger_class->show($pass->tr_id))[0]);


                //passengers
                $passenger_staff=self::index($pass->tr_id);

                $passList=@json_decode($passenger_staff);
                
                $passenger_list=array();


                for($x=0;$x<count($passList);$x++){
                    array_push($passenger_list,$passList[$x]->uid);
                }



                /* OFFICIAL*/
                if($tr->request_type=='official'){

                    //revert to default approver if ODDA is removed
                    if($pass->uid==25){
                        //if default signatory is on the list
                        //do not update to original signatory
                        //update to ODDA instead
                        if(in_array($signatory[0]->uid, $passenger_list)){
                            $directory_class->update_signatory_to_odda($tr->tr);
                        }else{
                           $directory_class->update_signatory($tr->tr,$signatory[0]->profile_id);  
                        }
                        
                    }

                    //revert to default if original signatory
                    if($signatory[0]->uid==$pass->uid){
                        $directory_class->update_signatory($tr->tr,$signatory[0]->profile_id);    
                    }
                }



                if($tr->request_type=='personal'||$tr->request_type=='campus'){
                    //if GSU head will be removed on the list 
                    // revert to default
                    // GSU HEAD default profile_id=5 , uid=105
                    if($pass->uid==105){
                        $directory_class->update_signatory($tr->tr,5);
                        $directory_class->update_approval_recommending($tr->tr,$signatory[0]->profile_id);       
                    }

                }

            

           // return 0;
                $remove_statement->execute();

                




 
                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){/*echo $e->getMessage();*/$this->pdoObject->rollback();}
    }
}
