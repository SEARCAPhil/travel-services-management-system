<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Authentication;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Directory;

@session_start();

class Campus extends Controller
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

            $sql="SELECT * FROM trc where requested_by=:id and trc.status!=5 ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM trc where requested_by=:id and trc.status!=5  ORDER BY date_created DESC";
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

            $sql="SELECT * FROM trc where status!=0 and trc.status!=5  ORDER BY date_created DESC LIMIT :start, 10";

            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
            $statement->execute();

            $sql2="SELECT count(*) as total FROM trc  where status!=0 and trc.status!=5";
            $statement2=$this->pdoObject->prepare($sql2);
            $statement2->execute();

            $res=Array();
            $data=Array();
            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
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
         try{
            //$uid=$request->session()->get('id');
            $uid=$_SESSION['id'];

            $original_uid=($_SESSION['uid']);


            



            #get signatory

            $official_signatory=new Directory();

            $signatory=json_decode($official_signatory->signatory($original_uid));

            $approved_by=@$signatory[0]->profile_name;

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="INSERT INTO trc(requested_by,approved_by) values (:requested_by,:approved_by)";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':requested_by',$uid);
            $statement->bindParam(':approved_by',$approved_by);
            $statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();

            echo $lastId;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }

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
                $this->pdoObject->beginTransaction();
                #$sql="SELECT trp.*, account_profile.* FROM trp LEFT JOIN account_profile on trp.requested_by=account_profile.id where trp.id=:id";

                $sql="SELECT trc.*, account_profile.last_name,account_profile.first_name,account_profile.middle_name,account_profile.profile_name, account_profile.position, account_profile.profile_image,account_profile.department,account_profile.department_alias FROM trc LEFT JOIN account_profile on trc.requested_by=account_profile.id  where trc.id=:id";

                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=$row;
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
        
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

            $sql="SELECT * FROM trc where id LIKE :key1  and status!=0  ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM trc where  id LIKE :key1  and status!=0  ORDER BY date_created DESC";
            $statement=$this->pdoObject->prepare($sql);
            $statement2=$this->pdoObject->prepare($sql2);

            $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

            
            $statement->bindParam(':key1',$key);
            $statement2->bindParam(':key1',$key);



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

                $sql="SELECT * FROM trc where requested_by=:id and id LIKE :key1  ORDER BY date_created DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trc where requested_by=:id and id LIKE :key1   ORDER BY date_created DESC";
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement2->bindParam(':id',$this->id,\PDO::PARAM_INT);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement->bindParam(':id',$this->id,\PDO::PARAM_INT);

                
                $statement->bindParam(':key1',$key);

                $statement2->bindParam(':key1',$key);




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




    public function update_status(Request $request){

        try{
            $id=$request->input('id');
            $purpose=$request->input('status');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE trc set status=:status where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':status',$purpose);
            $statement->bindParam(':id',$id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }



    function recent($page=1){

        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;

                $this->pdoObject->beginTransaction();
                $sql="SELECT trc.requested_by,trc.status as trc_status,trc_travel.*,automobile.manufacturer, account_profile.last_name,trc_travel.other_driver,account_profile.first_name FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no  LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN trc on trc_travel.trc_id=trc.id where trc_travel.status='scheduled' and trc.status='2' and departure_date!='0000-00-00' ORDER BY departure_date  DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no LEFT JOIN trc on trc_travel.trc_id=trc.id   where trc_travel.status='scheduled'  and trc.status='2' and departure_date!='0000-00-00'";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trc' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                #$statement->bindParam(':plate_no',$this->plate_no);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $data=[];
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

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

                 


                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->trc_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'actual_time'=>$row->actual_departure_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'campus','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>null,'scholars'=>null,'custom'=>null));
                }

                $no_pages=1;
                if($count>=10){
                        $pages=ceil($count/10);
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


    


function ongoing($page=1){

        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;
                
                $this->pdoObject->beginTransaction();
                $sql="SELECT trc.requested_by,trc.status as trc_status,trc_travel.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name,trc_travel.other_driver FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no  LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN trc on trc_travel.trc_id=trc.id where trc_travel.status='ongoing' and departure_date!='0000-00-00' ORDER BY departure_date  DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no LEFT JOIN trc on trc_travel.trc_id=trc.id   where trc_travel.status='ongoing' and departure_date!='0000-00-00'";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trc' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                #$statement->bindParam(':plate_no',$this->plate_no);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $data=[];
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

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

                 


                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->trc_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'actual_time'=>$row->actual_departure_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'campus','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>null,'scholars'=>null,'custom'=>null));
                }

                $no_pages=1;
                if($count>=10){
                        $pages=ceil($count/10);
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
                $sql="SELECT trc.requested_by,trc.status as trc_status,trc_travel.*,automobile.manufacturer, account_profile.last_name, account_profile.first_name,trc_travel.other_driver FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no  LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN trc on trc_travel.trc_id=trc.id where trc_travel.status='finished' and departure_date!='0000-00-00' ORDER BY departure_date  DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no LEFT JOIN trc on trc_travel.trc_id=trc.id   where trc_travel.status='finished' and departure_date!='0000-00-00'";
                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='trc' ORDER BY travel_id DESC LIMIT 1 ";
                 $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement3=$this->pdoObject->prepare($sql3);
                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                #$statement->bindParam(':plate_no',$this->plate_no);
                $statement->execute();
                $statement2->execute();
                $res=Array();
                $data=[];
                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);
                $count=$row_count->total;
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

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

                 


                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->trc_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'actual_time'=>$row->actual_departure_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'campus','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>null,'scholars'=>null,'custom'=>null));
                }

                $no_pages=1;
                if($count>=10){
                        $pages=ceil($count/10);
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
            $remove_rfp_sql="UPDATE trc set status=5 where id=:id";
            $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
            $remove_statement->bindParam(':id',$this->id);
            $remove_statement->execute();
            $this->pdoObject->commit();

            return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
