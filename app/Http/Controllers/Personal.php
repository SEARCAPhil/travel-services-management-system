<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Authentication;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Personal_staff;
use App\Http\Controllers\Personal_scholars;
use App\Http\Controllers\Personal_custom;


@session_start();

class Personal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
       $auth=new Authentication();

        if($auth->isAdmin()){
           self::list_all($page); 
        }else{
            self::list_by_account($page);
        } 
    }

    public function list_by_account($page=1){
       try{
            $this->pdoObject=DB::connection()->getPdo();
            $this->page=htmlentities(htmlspecialchars($page));
            $this->id=$_SESSION['id'];
            $this->page=$page>1?$page:1;

           

            #set starting limit(page 1=10,page 2=20)
            $start_page=$this->page<2?0:( integer)($this->page-1)*10;


            $this->pdoObject->beginTransaction();

            $sql="SELECT * FROM trp where requested_by=:id and trp_status!=5 ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM trp where requested_by=:id and trp_status!=5  ORDER BY date_created DESC";
            $statement=$this->pdoObject->prepare($sql);
            $statement2=$this->pdoObject->prepare($sql2);
            $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
            $statement->bindParam(':id',$this->id,\PDO::PARAM_INT);
            $statement2->bindParam(':id',$this->id,\PDO::PARAM_INT);
            $statement->execute();
            $statement2->execute();
            $res=Array();
            $data=Array();
            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                if(strlen($row->purpose)>=150) $row->purpose=substr($row->purpose,0,149).'. . . ';
                $row->purpose=nl2br(utf8_encode($row->purpose));
                $data[]=$row;
            }
            

            $count=0;
            if($row_c=$statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
            #count pages
            $no_pages=1;
            if($count>=10){
                    $pages=ceil(@$count/10);
                    $no_pages=$pages;
                    
            }else{
                    $no_pages=1;

            }
            #check if page request is < the actual page
            $current_page=$this->page<=$no_pages?$this->page:$no_pages;

            #return in json format
            $res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$data);
                
            $this->pdoObject->commit();
            echo json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
    

     public function list_all($page=1){
       try{
            $this->pdoObject=DB::connection()->getPdo();
            $this->page=htmlentities(htmlspecialchars($page));
            $this->id=$_SESSION['id'];
            $this->page=$page>1?$page:1;

            #set starting limit(page 1=10,page 2=20)
            $start_page=$this->page<2?0:( integer)($this->page-1)*10;


            $this->pdoObject->beginTransaction();

            $sql="SELECT * FROM trp where trp_status!=0 and trp_status!=5  ORDER BY date_created DESC LIMIT :start, 10";

            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
            $statement->execute();

            $sql2="SELECT count(*) as total FROM trp where trp_status!=0 and trp_status!=5";
            $statement2=$this->pdoObject->prepare($sql2);
            $statement2->execute();

            $res=Array();
            $data=Array();
            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                if(strlen($row->purpose)>=150) $row->purpose=substr($row->purpose,0,149).'. . . ';
                $row->purpose=nl2br(utf8_encode($row->purpose));
                $data[]=$row;
            }
            

            $count=0;
            if($row_c=$statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
            #count pages
            $no_pages=1;
            if($count>=10){
                    $pages=ceil(@$count/10);
                    $no_pages=$pages;
                    
            }else{
                    $no_pages=1;

            }
            #check if page request is < the actual page
            $current_page=$this->page<=$no_pages?$this->page:$no_pages;

            #return in json format
            $res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$data);
                
            $this->pdoObject->commit();
            echo json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
    




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



        public function create_purpose(Request $request){

        try{
            //$uid=$request->session()->get('id');
            $uid=$_SESSION['id'];
            $purpose=$request->input('purpose');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="INSERT INTO trp(requested_by,purpose) values (:requested_by,:purpose)";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':requested_by',$uid);
            $statement->bindParam(':purpose',$purpose);
            $statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();

            echo $lastId;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    } 


     public function update_purpose(Request $request){

        try{
            $id=$request->input('id');
            $purpose=$request->input('purpose');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE trp set purpose=:purpose where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':purpose',$purpose);
            $statement->bindParam(':id',$id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    } 



    public function update_status(Request $request){

        try{
            $id=$request->input('id');
            $purpose=$request->input('status');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE trp set trp_status=:status where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':status',$purpose);
            $statement->bindParam(':id',$id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


     /*public function update_signatory(Request $request){

        try{
            $id=$request->input('id');
            $value=$request->input('value');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE trp set purpose=:purpose where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':purpose',$purpose);
            $statement->bindParam(':id',$id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }*/ 




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
       
        try{
                $this->pdoObject=DB::connection()->getPdo(); 
                $this->id=htmlentities(htmlspecialchars($id));
               
                #$sql="SELECT trp.*, account_profile.* FROM trp LEFT JOIN account_profile on trp.requested_by=account_profile.id where trp.id=:id";

                $sql="SELECT trp.*, account_profile.last_name,account_profile.first_name,account_profile.middle_name,account_profile.profile_name, account_profile.position, account_profile.profile_image,account_profile.department,account_profile.department_alias,automobile_class.class FROM trp LEFT JOIN account_profile on trp.requested_by=account_profile.id LEFT JOIN automobile_class on automobile_class.id=trp.vehicle_type  where trp.id=:id";

                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=$row;
                }
              

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();}
        
    }


     public function search($param,$page=1){
        $id=$_SESSION['id'];

        $auth=new Authentication();
        if($auth->isAdmin()){
            return self::search_admin($param,$page);
        }else{
             return self::search_user_request($param,$id,$page);
        }

    }


    public function search_admin($param,$page=1){
        
        try{

            $this->pdoObject=DB::connection()->getPdo();
            $this->page=htmlentities(htmlspecialchars($page));
            $this->tr_id=htmlentities(htmlspecialchars($param));
            $key='%'.$this->tr_id.'%';
            $this->page=$page>1?$page:1;

            #set starting limit(page 1=10,page 2=20)
            $start_page=$this->page<2?0:( integer)($this->page-1)*10;


            $this->pdoObject->beginTransaction();

            $sql="SELECT * FROM trp where id LIKE :key1 or purpose LIKE :key2 and trp_status!=0  ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM trp where  id LIKE :key1 or purpose LIKE :key2 and trp_status!=0 ORDER BY date_created DESC";
            $statement=$this->pdoObject->prepare($sql);
            $statement2=$this->pdoObject->prepare($sql2);

            $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

            
            $statement->bindParam(':key1',$key);
             $statement->bindParam(':key2',$key);
            $statement2->bindParam(':key1',$key);
            $statement2->bindParam(':key2',$key);



            $statement->execute();
            $statement2->execute();
            $res=Array();
            $data=Array();
            while($row=$statement->fetch()){
                $data[]=$row;
            }
            

            $count=0;
            if($row_c=$statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
            #count pages
            $no_pages=1;
            if($count>=10){
                    $pages=ceil(@$count/10);
                    $no_pages=$pages;
                    
            }else{
                    $no_pages=1;

            }
            #check if page request is < the actual page
            $current_page=$this->page<=$no_pages?$this->page:$no_pages;

            #return in json format
            $res=Array('current_page'=>$this->page,'total_pages'=>$no_pages,'data'=>$data);
                
            $this->pdoObject->commit();
            return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
       
    }


    function search_user_request($param,$id,$page=1){
        
        try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->id=(int) htmlentities(htmlspecialchars($id));
                $this->tr_id=htmlentities(htmlspecialchars($param));
                $key='%'.$this->tr_id.'%';
                $this->page=$page>1?$page:1;

                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;


                $this->pdoObject->beginTransaction();

                $sql="SELECT * FROM trp where requested_by=:id and id LIKE :key1 or purpose LIKE :key2  ORDER BY date_created DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trp where requested_by=:id and id LIKE :key1 or purpose LIKE :key2  ORDER BY date_created DESC";
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement2->bindParam(':id',$this->id,\PDO::PARAM_INT);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement->bindParam(':id',$this->id,\PDO::PARAM_INT);

                
                $statement->bindParam(':key1',$key);
                $statement->bindParam(':key2',$key);
                $statement2->bindParam(':key1',$key);
                $statement2->bindParam(':key2',$key);



                $statement->execute();
                $statement2->execute();
                $res=Array();
                $data=Array();
                while($row=$statement->fetch()){
                    $data[]=$row;
                }
                

                $count=0;
                if($row_c=$statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
                #count pages
                $no_pages=1;
                if($count>=10){
                        $pages=ceil(@$count/10);
                        $no_pages=$pages;
                        
                }else{
                        $no_pages=1;

                }
                #check if page request is < the actual page
                $current_page=$this->page<=$no_pages?$this->page:$no_pages;

                #return in json format
                $res=Array('current_page'=>$this->page,'total_pages'=>$no_pages,'data'=>$data);
                    
                $this->pdoObject->commit();
                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}


    }




    public function payment(Request $request){

        $token = $request->input('_token');
        $payment = htmlentities(htmlspecialchars($request->input('payment')));
        $id = $request->input('id');

        $pay='cash';
        switch ($payment) {
            case 'cash':
                $pay='cash';
                break;
            case 'sd':
                $pay='sd';
                break;
            default:
                $pay='cash';
                break;
        }

        try{
            $this->pdoObject=DB::connection()->getPdo(); 
            $this->tr=htmlentities(htmlspecialchars($id));
            
            #begin transaction
            $this->pdoObject->beginTransaction();
            
            $insert_sql="UPDATE trp set mode_of_payment=:p where id=:tr_id";
            $insert_statement=$this->pdoObject->prepare($insert_sql);
    
            #params
            $insert_statement->bindParam(':tr_id',$this->tr);
            $insert_statement->bindParam(':p',$pay);
            
            
            #exec the transaction
            $insert_statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();

            #return
            return $insert_statement->rowCount()>0?$insert_statement->rowCount():0;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}
    }



    function recent($page=1){

        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;

                $this->pdoObject->beginTransaction();
                $sql="SELECT trp.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN account_profile on account_profile.id=driver_id  where trp.status='scheduled' and trp.trp_status='2' and departure_date!='0000-00-00' ORDER BY trp.id DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no  where trp.status='scheduled' and trp.trp_status='2' and departure_date!='0000-00-00' and trp.plate_no IS NOT NULL";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trp' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";

                //passengers
                $passenger_staff_class=new Personal_staff();
                $passenger_scholar_class=new Personal_scholars();
                $passenger_custom_class=new Personal_custom();

                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement4=$this->pdoObject->prepare($sql4);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;





                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    $passenger_staff=$passenger_staff_class->index($row->id);
                    $passenger_scholar=$passenger_scholar_class->index($row->id);
                    $passenger_custom=$passenger_custom_class->index($row->id);


                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                    //override driver by other driver
                    if(!empty($row->other_driver)) $driver=$row->other_driver;

                    //requester
                    $statement4->bindValue(':id',$row->requested_by,\PDO::PARAM_INT);
                    $statement4->execute();

                    while($row4=$statement4->fetch(\PDO::FETCH_OBJ)){
                        $requester=$row4->profile_name; 
                        $image=$row4->profile_image;    
                        $department=$row4->department_alias;
                    }

         

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'returned_date'=>$row->returned_date,'departure_time'=>$row->departure_time,'actual_time'=>$row->actual_departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'personal','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));
                }

                $no_pages=1;
                if($count>=20){
                        $pages=ceil($count/20);
                        $no_pages=$pages;
                        
                }else{
                        $no_pages=1;

                }
                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$start_page,'data'=>$res);
                $this->pdoObject->commit();
                
                
                #Array('total'=>$count,'current_page'=>$start_page,'data'=>$res);
                return json_encode($data);
                

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


    function scheduled($date){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                
                $this->pdoObject->beginTransaction();
                
                 $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)  and linked='no' ORDER BY departure_date DESC";

                $sql="SELECT trp.*,automobile.manufacturer, login_db.account_profile.last_name, login_db.account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH) and trp.trp_status>0  ORDER BY departure_date DESC";

                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':datez1',$this->datez);
                $statement->bindParam(':datez2',$this->datez);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'trp');
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }




     function scheduled_in_calendar($date){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                
                $this->pdoObject->beginTransaction();
                


                $sql="SELECT trp.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN account_profile on account_profile.id=driver_id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH) and (trp.trp_status=2||trp.trp_status=4)  ORDER BY departure_date DESC";

                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':datez1',$this->datez);
                $statement->bindParam(':datez2',$this->datez);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'trp');
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


    function scheduled_per_user($date,$id){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                $this->id=htmlentities(htmlspecialchars($id));
                
                $this->pdoObject->beginTransaction();
                

                $sql="SELECT trp.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN account_profile on account_profile.id=driver_id  where trp.requested_by=:id and departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH) and trp.trp_status>0  ORDER BY departure_date DESC";

                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':datez1',$this->datez);
                $statement->bindParam(':datez2',$this->datez);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'trp');
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }




function ongoing($page=1){

        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;

                $this->pdoObject->beginTransaction();
                $sql="SELECT trp.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN account_profile on account_profile.id=driver_id  where trp.status='ongoing' and trp.trp_status='2' and departure_date!='0000-00-00' ORDER BY trp.id DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no  where trp.status='ongoing' and trp.trp_status='2' and departure_date!='0000-00-00' and trp.plate_no IS NOT NULL";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trp' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";

                //passengers
                $passenger_staff_class=new Personal_staff();
                $passenger_scholar_class=new Personal_scholars();
                $passenger_custom_class=new Personal_custom();

                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement4=$this->pdoObject->prepare($sql4);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;





                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    $passenger_staff=$passenger_staff_class->index($row->id);
                    $passenger_scholar=$passenger_scholar_class->index($row->id);
                    $passenger_custom=$passenger_custom_class->index($row->id);


                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                     //override driver by other driver
                    if(!empty($row->other_driver)) $driver=$row->other_driver;

                    //requester
                    $statement4->bindValue(':id',$row->requested_by,\PDO::PARAM_INT);
                    $statement4->execute();

                    while($row4=$statement4->fetch(\PDO::FETCH_OBJ)){
                        $requester=$row4->profile_name; 
                        $image=$row4->profile_image;    
                        $department=$row4->department_alias;
                    }

         

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'returned_date'=>$row->returned_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'actual_time'=>$row->actual_departure_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'personal','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));
                }

                $no_pages=1;
                if($count>=20){
                        $pages=ceil($count/20);
                        $no_pages=$pages;
                        
                }else{
                        $no_pages=1;

                }
                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$start_page,'data'=>$res);
                $this->pdoObject->commit();
                
                
                #Array('total'=>$count,'current_page'=>$start_page,'data'=>$res);
                return json_encode($data);
                

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


function finished($page=1){

        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;

                $this->pdoObject->beginTransaction();
                $sql="SELECT trp.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no LEFT JOIN account_profile on account_profile.id=driver_id  where trp.status='finished' and trp.trp_status='2' and departure_date!='0000-00-00' ORDER BY trp.id DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trp LEFT JOIN automobile on automobile.plate_no=trp.plate_no  where trp.status='finished' and trp.trp_status='2' and departure_date!='0000-00-00' and trp.plate_no IS NOT NULL";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trp' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";

                //passengers
                $passenger_staff_class=new Personal_staff();
                $passenger_scholar_class=new Personal_scholars();
                $passenger_custom_class=new Personal_custom();

                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement4=$this->pdoObject->prepare($sql4);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;





                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    $passenger_staff=$passenger_staff_class->index($row->id);
                    $passenger_scholar=$passenger_scholar_class->index($row->id);
                    $passenger_custom=$passenger_custom_class->index($row->id);


                    //driver
                    $driver=@$row->first_name. ' '. @$row->last_name;
                    $statement3->bindValue(':id',$row->id,\PDO::PARAM_INT);
                    $statement3->execute();

                    while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $driver=$row3->drivers_name;    
                    }

                    //override driver by other driver
                    if(!empty($row->other_driver)) $driver=$row->other_driver;

                    //requester
                    $statement4->bindValue(':id',$row->requested_by,\PDO::PARAM_INT);
                    $statement4->execute();

                    while($row4=$statement4->fetch(\PDO::FETCH_OBJ)){
                        $requester=$row4->profile_name; 
                        $image=$row4->profile_image;    
                        $department=$row4->department_alias;
                    }

                    

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'returned_date'=>$row->returned_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'actual_time'=>$row->actual_departure_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'personal','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));
                }

                $no_pages=1;
                if($count>=20){
                        $pages=ceil($count/20);
                        $no_pages=$pages;
                        
                }else{
                        $no_pages=1;

                }
                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$start_page,'data'=>$res);
                $this->pdoObject->commit();
                
                
                #Array('total'=>$count,'current_page'=>$start_page,'data'=>$res);
                return json_encode($data);
                

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function update_signatory($id,$name)

    {

        try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->id=(int) htmlentities(htmlspecialchars($id));
                $this->name=utf8_encode(strip_tags($name));

                $this->pdoObject->beginTransaction();

                $remove_rfp_sql="UPDATE trp set approved_by=:approved_by where id=:id";

                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->bindParam(':approved_by',$this->name);

                $remove_statement->execute();

                $this->pdoObject->commit();



                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

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
                $this->id=(int) htmlentities(htmlspecialchars($id));
                $this->pdoObject->beginTransaction();
                $remove_rfp_sql="UPDATE trp set trp_status=5 where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
