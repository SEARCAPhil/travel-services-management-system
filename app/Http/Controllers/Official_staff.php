<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use App\Http\Requests;




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
             
                $sql="SELECT passengers.id,passengers.uid,login_db.account_profile.profile_name,login_db.account_profile.position,login_db.account_profile.profile_image,login_db.department.dept_name,login_db.department.dept_alias  FROM passengers LEFT JOIN login_db.account_profile on login_db.account_profile.uid=passengers.uid LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id  where  tr_id=:id and type='staff'";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=Array('name'=>$row->profile_name,'uid'=>$row->uid,'id'=>$row->id,'designation'=>$row->position,'office'=>$row->dept_name,'profile_image'=>$row->profile_image,'allias'=>$row->dept_alias);
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

        if(!empty($id)&&!empty($uid)&&!empty($token)){
            
           try{

                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="INSERT INTO passengers(tr_id,uid)values(:tr_id,:uid)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':tr_id',$id);
                $insert_statement->bindParam(':uid',$uid);
  
                #exec the transaction
                $insert_statement->execute();
                $lastId=$this->pdoObject->lastInsertId();
                $this->pdoObject->commit();

                #return
                echo $lastId;

            }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();} 


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

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->id=htmlentities(htmlspecialchars($id));
                $this->pdoObject->beginTransaction();
                $remove_rfp_sql="DELETE FROM passengers where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){/*echo $e->getMessage();*/$this->pdoObject->rollback();}
    }
}
