<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Authentication;



use Illuminate\Http\Request;



use App\Http\Requests;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Official_staff;

use App\Http\Controllers\Official_scholars;

use App\Http\Controllers\Official_custom;

use App\Http\Controllers\Directory;



@session_start();


class Official extends Controller

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


    public function personal_list($page=1){
         $auth=new Authentication();



        if($auth->isAdmin()){

           self::list_all_personal($page); 

        }else{

            self::list_by_account_personal($page);

        }
    }



    public function campus_list($page=1){
         $auth=new Authentication();



        if($auth->isAdmin()){

           self::list_all_campus($page); 

        }else{

            self::list_by_account_campus($page);

        }
    }





    /**

     * List Official Travel Request by ID

     * @param int $page 

     * @return json

     */ 



    public function list_by_account($page=1,$type='official')

    {



            try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->page=htmlentities(htmlspecialchars($page));

                $this->page=$page>1?$page:1;

                $this->id=$_SESSION['profile_id'];

                #set starting limit(page 1=10,page 2=20)

                $start_page=$this->page<2?0:( integer)($this->page-1)*10;





                $this->pdoObject->beginTransaction();



                #exclude deleted items #5

                $sql="SELECT * FROM tr where tr.requested_by=:id and tr.status!=5 and request_type=:type ORDER BY date_created DESC LIMIT :start, 10";

                $sql2="SELECT count(*) as total FROM tr where tr.requested_by=:id and tr.status!=5 and request_type=:type";



                $statement=$this->pdoObject->prepare($sql);

                $statement2=$this->pdoObject->prepare($sql2);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

                $statement->bindParam(':type',$type);

                $statement2->bindParam(':type',$type);


                $statement->bindParam(':id',$this->id,\PDO::PARAM_INT);

                $statement2->bindParam(':id',$this->id,\PDO::PARAM_INT);

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

                $res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$data);

                    

                $this->pdoObject->commit();

                echo json_encode($res);



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}





    }


    public function list_by_account_personal($page=1,$type='personal'){

        return self::list_by_account($page,$type);
    }

    public function list_by_account_campus($page=1,$type='campus'){

        return self::list_by_account($page,$type);
    }


    public function list_all_personal($page=1,$type="personal"){
       return self::list_all($page,$type);
    }

     public function list_all_campus($page=1,$type="campus"){
       return self::list_all($page,$type);
    }



    function list_all($page=1,$type="official"){

        

        try{



                $this->pdoObject=DB::connection()->getPdo();

                $this->page=htmlentities(htmlspecialchars($page));

                $this->page=$page>1?$page:1;

                $this->id=$_SESSION['id'];

                #set starting limit(page 1=10,page 2=20)

                $start_page=$this->page<2?0:( integer)($this->page-1)*10;





                $this->pdoObject->beginTransaction();





                $sql="SELECT tr.*,account_profile.profile_name FROM tr LEFT JOIN account_profile on account_profile.id = tr.requested_by where status!=0 and status!=5 and request_type=:type ORDER BY date_created DESC LIMIT :start, 10";

                $statement=$this->pdoObject->prepare($sql);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement->bindParam(':type',$type);

                $statement->execute();





                $sql2="SELECT count(*) as total FROM tr where status!=0 and request_type=:type and status!=5";

                $statement2=$this->pdoObject->prepare($sql2);
                $statement2->bindParam(':type',$type);

                $statement2->execute();







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

            $uid = $_SESSION['profile_id'];



            //uid saved in login_db

            //$original_uid=($_SESSION['uid']);

            //$uid=16;

            $purpose=$request->input('purpose');
            $type=$request->input('type');




            #get signatory

            $official_signatory = new Directory();
            $signatory = is_null($_SESSION['dept_id']) ? array() : @json_decode($official_signatory->signatory_department($_SESSION['dept_id']));

            $approved_by = @$signatory[0]->profile_name;
            $approved_by_id = NULL;
            $recommended_by_id = NULL;

            if($type=='official'){
                if(@strip_tags($_SESSION['name'])!=$approved_by){
                     $approved_by_id = @($signatory[0]->account_profile_id);
                }
            }

            if($type =='personal' || $type == 'campus'){
                //set to gsu head by default
                //currently RAM: 5
                $approved_by_id=5; 
            }

            if($type=='campus'){
                //set recommending
                $recommended_by_id = @($signatory[0]->account_profile_id);
            }

            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="INSERT INTO tr(requested_by,purpose,approved_by,request_type,recommended_by) values (:requested_by,:purpose,:approved_by,:request_type,:recommended_by)";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':requested_by',$uid);

            $statement->bindParam(':purpose',$purpose);

            $statement->bindParam(':approved_by',$approved_by_id);

            $statement->bindParam(':recommended_by',$recommended_by_id);

            $statement->bindParam(':request_type',$type);

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

            $sql="UPDATE tr set purpose=:purpose where id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':purpose',$purpose);

            $statement->bindParam(':id',$id);

            $statement->execute();

            $isUpdated=$statement->rowCount();

            $this->pdoObject->commit();



            echo $isUpdated;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }





    public function update_source_of_fund(Request $request){



        try{

            $id=$request->input('id');

            $source=$request->input('source_of_fund');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="UPDATE tr set source_of_fund=:source where id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':source',$source);

            $statement->bindParam(':id',$id);

            $statement->execute();

            $isUpdated=$statement->rowCount();

            $this->pdoObject->commit();



            echo $isUpdated;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }


    public function add_source_of_fund(Request $request){



        try{

            $tr_id=$request->input('tr_id');

            $source=$request->input('fund');
            $cost_center=$request->input('cost_center');
            $line_item=$request->input('line_item');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="INSERT INTO fundings(tr_id,fund,cost_center,line_item) values(:tr_id,:fund,:cost_center,:line_item)";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':fund',$source);
            $statement->bindParam(':cost_center',$cost_center);
            $statement->bindParam(':line_item',$line_item);

            $statement->bindParam(':tr_id',$tr_id);

            $statement->execute();

            $lastId=$this->pdoObject->lastInsertId();

            $this->pdoObject->commit();



            echo $lastId;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }





     public function set_project(Request $request){



        try{

            $id=$request->input('id');

            $project=$request->input('project');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();



            $sql="SELECT * FROM otf_projects where tr_id=:tr_id LIMIT 1";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':tr_id',$id);

            $statement->execute();



            $lastId=0;

            $count=0;

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                $count++;



                

            }



            if($count>0){

                //update

                $sql2="UPDATE otf_projects set project=:project where tr_id=:tr_id";

                $statement2=$this->pdoObject->prepare($sql2);

                $statement2->bindValue(':project',$project);

                $statement2->bindValue(':tr_id',$id);

                $statement2->execute();

                $lastId=$statement2->rowCount();

            }else{



                    $sql2="INSERT INTO otf_projects(tr_id,project) values (:tr_id,:project)";

                    $statement2=$this->pdoObject->prepare($sql2);

                    $statement2->bindValue(':project',$project);

                    $statement2->bindValue(':tr_id',$id);

                    $statement2->execute();

                    $lastId=$this->pdoObject->lastInsertId();

            }



            

            $this->pdoObject->commit();



            echo $lastId;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }





    public function update_status(Request $request){



        try{

            $id=$request->input('id');

            $purpose=$request->input('status');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="UPDATE tr set status=:status where id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':status',$purpose);

            $statement->bindParam(':id',$id);

            $statement->execute();

            $isUpdated=$statement->rowCount();

            $this->pdoObject->commit();



            echo $isUpdated;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    } 



    public function update_signatory(Request $request){



        try{

            $id=$request->input('id');

            $value=$request->input('value');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="UPDATE tr set approved_by=:approved_by where id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':approved_by',$value);

            $statement->bindParam(':id',$id);

            $statement->execute();

            $isUpdated=$statement->rowCount();

            $this->pdoObject->commit();

            echo $isUpdated;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }  



    public function update_notes(Request $request){



        try{

            $id=$request->input('id');

            $notes=$request->input('notes');



            $this->pdoObject=DB::connection()->getPdo();



            $this->pdoObject->beginTransaction();

            $sql="UPDATE tr set notes=:notes where id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':notes',$notes);

            $statement->bindParam(':id',$id);

            $statement->execute();

            $isUpdated=$statement->rowCount();

            $this->pdoObject->commit();



            echo $isUpdated;



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

            $sql="SELECT *,tr.id as tr FROM tr LEFT JOIN account_profile on tr.requested_by=account_profile.id where tr.id=:id";

            $statement=$this->pdoObject->prepare($sql);

            $statement->bindParam(':id',$this->id);

            $statement->execute();



            $res=Array();

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){



                $sql2="SELECT * FROM otf_projects where tr_id=:id";

                $statement2=$this->pdoObject->prepare($sql2);

                $statement2->bindValue(':id',$row->tr);

                $statement2->execute();

                $projects=Array();



                $row->projects=Array();



                while(($row2=$statement2->fetch(\PDO::FETCH_OBJ))&&$row->source_of_fund=='otf'){

                    $row->projects[]=$row2;

                }



              $source='Operating funds';
                switch ($row->source_of_fund) {
                         case 'opf':
                             $source='Operating funds';
                            break;
                        case 'opfs':
                            $source='Operating funds (Scholars)';
                            break;
                        case 'otf':
                           $source='Other funds';
                           break;
                        case 'op':
                           $source='Obligations Payable';
                           break;
                        case 'sf':
                           $source='Special funds';
                           break;   
                        case 'otfs':
                           $source='Other funds (Scholars)';
                           break;   
                      default:
                           $source='Operating funds';
                          break;
                  }  


                $row->source_of_fund_value=$source;

                //to be approved by
                
                $sql3="SELECT * FROM account_profile where id=:id";

                $statement3=$this->pdoObject->prepare($sql3);

                $statement3->bindValue(':id',$row->approved_by);

                $statement3->execute();

                while($row3=$statement3->fetch(\PDO::FETCH_OBJ)){
                    $row->approved_by_id=$row->approved_by;
                    $row->approved_by_uid=$row3->uid;
                    $row->approved_by=$row3->profile_name;
                    $row->approved_by_position=$row3->position;
                }


                 //approval recommended
                if(!is_null($row->recommended_by)){
                     $statement3->bindValue(':id',$row->recommended_by);
                     $statement3->execute();

                    while($row4=$statement3->fetch(\PDO::FETCH_OBJ)){
                        $row->recommended_by=$row4->profile_name;
                        $row->recommended_by_position=$row4->position;
                    }
                }

               


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



            $sql="SELECT * FROM tr where id LIKE :key1 or purpose LIKE :key2 and status!=0  ORDER BY date_created DESC LIMIT :start, 10";

            $sql2="SELECT count(*) as total FROM tr where  id LIKE :key1 or purpose LIKE :key2 and status!=0 ORDER BY date_created DESC";

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



                $sql="SELECT * FROM tr where requested_by=:id and id LIKE :key1 or purpose LIKE :key2  ORDER BY date_created DESC LIMIT :start, 10";

                $sql2="SELECT count(*) as total FROM tr where requested_by=:id and id LIKE :key1 or purpose LIKE :key2  ORDER BY date_created DESC";

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







    function recent($page=1){



        try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->page=htmlentities(htmlspecialchars($page));

                $this->page=$page>1?$page:1;



                #set starting limit(page 1=10,page 2=20)

                $start_page=$this->page<2?0:( integer)($this->page-1)*10;



                $this->pdoObject->beginTransaction();

                $sql="SELECT tr.status as tr_status,tr.requested_by,tr.request_type,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,other_driver,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='scheduled' and departure_date!='0000-00-00' and linked='no' and tr.status='2'  ORDER BY travel.id DESC LIMIT :start,10";



                $sql2="SELECT count(*) as total FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='scheduled' and departure_date!='0000-00-00' and linked='no' and tr.status='2'";



                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";

                $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";





                //passengers

                $passenger_staff_class=new Official_staff();

                $passenger_scholar_class=new Official_scholars();

                $passenger_custom_class=new Official_custom();







                $statement=$this->pdoObject->prepare($sql);

                $statement2=$this->pdoObject->query($sql2);

                $statement3=$this->pdoObject->prepare($sql3);

                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

                $statement->execute();

                $statement2->execute();

                $res=Array();

                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);

                $count=$row_count->total;

                $requester=$department=$image='';



                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    

                    $passenger_staff=$passenger_staff_class->index($row->tr_id);

                    $passenger_scholar=$passenger_scholar_class->index($row->tr_id);

                    $passenger_custom=$passenger_custom_class->index($row->tr_id);

                    //default driver

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



                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'actual_time'=>$row->actual_departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>$row->request_type,'driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));



                    

                }

                $no_pages=1;

                if($count>=10){

                        $pages=ceil($count/10);

                        $no_pages=$pages;

                        

                }else{

                        $no_pages=1;



                }

                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$this->page,'data'=>$res);

                $this->pdoObject->commit();

                

                



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

                $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,travel.other_driver,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='ongoing' and departure_date!='0000-00-00' and linked='no'  ORDER BY travel.id DESC LIMIT :start,10";



                $sql2="SELECT count(*) as total FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='ongoing' and departure_date!='0000-00-00' and linked='no' ";



                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";

                $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";





                //passengers

                $passenger_staff_class=new Official_staff();

                $passenger_scholar_class=new Official_scholars();

                $passenger_custom_class=new Official_custom();







                $statement=$this->pdoObject->prepare($sql);

                $statement2=$this->pdoObject->query($sql2);

                $statement3=$this->pdoObject->prepare($sql3);

                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

                $statement->execute();

                $statement2->execute();

                $res=Array();

                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);

                $count=$row_count->total;

                $requester=$department=$image='';



                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    

                    $passenger_staff=$passenger_staff_class->index($row->tr_id);

                    $passenger_scholar=$passenger_scholar_class->index($row->tr_id);

                    $passenger_custom=$passenger_custom_class->index($row->tr_id);

                    //default driver

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



                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'actual_time'=>$row->actual_departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'official','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));



                    

                }

                $no_pages=1;

                if($count>=10){

                        $pages=ceil($count/10);

                        $no_pages=$pages;

                        

                }else{

                        $no_pages=1;



                }

                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$this->page,'data'=>$res);

                $this->pdoObject->commit();

                

                



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

                $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,travel.other_driver,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='finished' and departure_date!='0000-00-00' and linked='no'  ORDER BY travel.id DESC LIMIT :start,10";



                $sql2="SELECT count(*) as total FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='finished' and departure_date!='0000-00-00' and linked='no' ";



                $sql3="SELECT * FROM automobile_rent where travel_id=:id and travel_type='tr' ORDER BY travel_id DESC LIMIT 1 ";

                $sql4="SELECT * FROM account_profile where id=:id LIMIT 1 ";





                //passengers

                $passenger_staff_class=new Official_staff();

                $passenger_scholar_class=new Official_scholars();

                $passenger_custom_class=new Official_custom();







                $statement=$this->pdoObject->prepare($sql);

                $statement2=$this->pdoObject->query($sql2);

                $statement3=$this->pdoObject->prepare($sql3);

                $statement4=$this->pdoObject->prepare($sql4);

                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);

                $statement->execute();

                $statement2->execute();

                $res=Array();

                $row_count=$statement2->fetch(\PDO::FETCH_OBJ);

                $count=$row_count->total;

                $requester=$department=$image='';



                while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                    

                    $passenger_staff=$passenger_staff_class->index($row->tr_id);

                    $passenger_scholar=$passenger_scholar_class->index($row->tr_id);

                    $passenger_custom=$passenger_custom_class->index($row->tr_id);

                    //default driver

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



                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'actual_time'=>$row->actual_departure_time,'returned_date'=>$row->returned_date,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'manufacturer'=>$row->manufacturer,'type'=>'official','driver'=>$driver,'requester'=>$requester,'department'=>$department,'image'=>$image,'passengers'=>array('staff'=>$passenger_staff,'scholars'=>$passenger_scholar,'custom'=>$passenger_custom));



                    

                }

                $no_pages=1;

                if($count>=10){

                        $pages=ceil($count/10);

                        $no_pages=$pages;

                        

                }else{

                        $no_pages=1;



                }

                $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$this->page,'data'=>$res);

                $this->pdoObject->commit();

                

                



                return json_encode($data);



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}



    }





    public function projects()

    {

        try{



            $this->pdoObject=DB::connection()->getPdo();



            $sql="SELECT * from searcaba_project_management.project ORDER BY title ASC";

            $statement=$this->pdoObject->prepare($sql);

            $statement->execute();

            $res=Array();

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){

                $res[]=$row;

            }

           



            return json_encode($res);



        }catch(Exception $e){echo $e->getMessage();}

        

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
                
                $insert_sql="UPDATE tr set mode_of_payment=:p where id=:tr_id";
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



    public function get_fundings($id)

    {

        try{

            $this->id=htmlentities(htmlspecialchars($id));

            $this->pdoObject=DB::connection()->getPdo();



            $sql="SELECT * from fundings where tr_id=:id";

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


    public function delete_source_of_fund($id)

    {

        try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->id=(int) htmlentities(htmlspecialchars($id));

                $this->pdoObject->beginTransaction();

                $remove_rfp_sql="DELETE FROM fundings where id=:id";

                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

                $remove_statement->bindParam(':id',$this->id);

                $remove_statement->execute();

                $this->pdoObject->commit();



                return $remove_statement->rowCount();



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

                $remove_rfp_sql="UPDATE tr set status=5 where id=:id";

                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

                $remove_statement->bindParam(':id',$this->id);

                $remove_statement->execute();

                $this->pdoObject->commit();



                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }

}

