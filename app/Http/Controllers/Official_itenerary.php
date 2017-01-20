<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class Official_itenerary extends Controller
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
                $this->pdoObject->beginTransaction();
                $sql="SELECT travel.* FROM travel where tr_id=:id";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch()){
                    $res[]=$row;
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $token = $request->input('_token');
        $origin = $request->input('location');
        $destination = $request->input('destination');
        $departure_date = $request->input('departure_date');
        $departure_time= $request->input('departure_time');
        $driver=$request->input('driver');
        $tr=$request->input('tr_id');

         try{

            $this->pdoObject=DB::connection()->getPdo();
            $this->tr=htmlentities(htmlspecialchars($tr));
            $this->destination=htmlentities(htmlspecialchars($destination));
            $this->from=htmlentities(htmlspecialchars($origin));
            $this->time=htmlentities(htmlspecialchars($departure_time));
            $this->date=htmlentities(htmlspecialchars($departure_date));
        

            #begin transaction
            $this->pdoObject->beginTransaction();
            #if action is create
            $insert_sql="INSERT INTO travel(tr_id,location,destination,departure_time,departure_date)values(:tr_id,:location,:destination,:time,:datez)";
            #prepare sql first
            $insert_statement=$this->pdoObject->prepare($insert_sql);

            
        
            $insert_statement->bindParam(':tr_id',$this->tr);
         

                #all param for both
                $insert_statement->bindParam(':location',$this->from);
                $insert_statement->bindParam(':time',$this->time);
                $insert_statement->bindParam(':datez',$this->date);
                $insert_statement->bindParam(':destination',$this->destination);
            

            
            
            
            
            #exec the transaction
            $insert_statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();
            
           

            $res=array('id'=>$lastId,'departure_date'=>$this->date,'location'=>$this->from,'destination'=>$this->destination,'departure_time'=>$this->time);
            return json_encode($res);
            
            
            

        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}
    }


     function recent($page=1,$id){

        try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;

                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;

                $this->pdoObject->beginTransaction();
                $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, login_db.account_profile.last_name, login_db.account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='scheduled' and departure_date!='0000-00-00' and linked='no' and tr.status='2' and travel.id!=:id  ORDER BY travel.id DESC LIMIT :start,10";

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
                $statement->bindParam(':id',$id,\PDO::PARAM_INT);
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


    function link($child,Request $request){

            try{
                $this->token = $request->input('_token');
                $this->child=htmlentities(htmlspecialchars($request->input('child')));
                $this->parent=htmlentities(htmlspecialchars($request->input('parent')));

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="INSERT INTO travel_link(child_id,parent_id)values(:child,:parent)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':child',$this->child);
                $insert_statement->bindParam(':parent',$this->parent);
                
                #exec the transaction
                $insert_statement->execute();
                $lastId=$this->pdoObject->lastInsertId();
                $this->pdoObject->commit();

                #return
                echo $lastId;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


    }


    function show_linked_travel($id){
        
        try{

                $this->id=htmlentities(htmlspecialchars($id));
                $this->pdoObject=DB::connection()->getPdo();


                $this->pdoObject->beginTransaction();
                $sql="SELECT travel_link.id,travel_link.parent_id,travel_link.child_id,travel.tr_id FROM travel_link LEFT JOIN travel on travel_link.child_id=travel.id where parent_id=:id ORDER BY travel_link.date_created DESC ";
                
                $sql2="SELECT account_profile.profile_name as requester, account_profile.last_name, account_profile.first_name,tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no, account_profile.last_name, account_profile.first_name FROM travel  LEFT JOIN tr on travel.tr_id=tr.id LEFT JOIN account_profile on account_profile.id=tr.requested_by where travel.id=:id  ORDER BY travel.id DESC LIMIT 1";
                
                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                $data=Array();

                while($row=$statement->fetch(\PDO::FETCH_OBJ)){


                    $statement2->bindValue(':id',$row->child_id);
                    $statement2->execute();

                  
                    while($row2=$statement2->fetch(\PDO::FETCH_OBJ)){
                        $row2->id=$row->id;
                        $res[]=$row2;
                    }

                $data=Array('data'=>$res);
                    
                }

                $this->pdoObject->commit();

                echo json_encode($data);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}


    }


    public function update_status($id,$status){

        try{
            $id=htmlentities(htmlspecialchars($id));

            $allowed_status=array('scheduled','finished','ongoing');

            if(!in_array($status, $allowed_status)){
                echo 0;
                exit;
            }
            

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE travel set status=:status where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':status',$status);
            $statement->bindParam(':id',$id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    } 


     public function update_driver($id,Request $request){

        try{
            $this->id=htmlentities(htmlspecialchars($id));
            $this->token = $request->input('_token');
            $this->driver = $request->input('driver');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE travel set driver_id=:driver where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':driver',$this->driver);
            $statement->bindParam(':id',$this->id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    } 


    public function update_plate_no($id,Request $request){

        try{
            $this->id=htmlentities(htmlspecialchars($id));
            $this->token = $request->input('_token');
            $this->plate_no = $request->input('plate_no');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE travel set plate_no=:plate_no where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':plate_no',$this->plate_no);
            $statement->bindParam(':id',$this->id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    } 


     function charge($id,Request $request){

            try{
                $this->token = $request->input('_token');
                 $this->id=htmlentities(htmlspecialchars($id));
                $this->in=htmlentities(htmlspecialchars($request->input('in')));
                $this->out=htmlentities(htmlspecialchars($request->input('out')));
                $this->gasoline_charge=htmlentities(htmlspecialchars($request->input('gasoline_charge')));
                $this->drivers_charge=htmlentities(htmlspecialchars($request->input('drivers_charge')));
                $this->appointment=htmlentities(htmlspecialchars($request->input('appointment')));

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="INSERT INTO tr_charge(rid,start,end,dca,gasoline_charge,drivers_charge) values (:rid,:start,:end,:dca,:gasoline_charge,:drivers_charge)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':rid',$this->id);
                $insert_statement->bindParam(':start',$this->in);
                $insert_statement->bindParam(':end',$this->out);
                $insert_statement->bindParam(':dca',$this->appointment);
                $insert_statement->bindParam(':gasoline_charge',$this->gasoline_charge);
                $insert_statement->bindParam(':drivers_charge',$this->drivers_charge);
               
                
                #exec the transaction
                $insert_statement->execute();
                $lastId=$this->pdoObject->lastInsertId();
                $this->pdoObject->commit();

                #return
                echo $lastId;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


    }


    function show_charges($id){
        try{

            $this->id=htmlentities(htmlspecialchars($id));


            $this->pdoObject=DB::connection()->getPdo();

            $sql="SELECT * FROM tr_charge where rid=:id ORDER BY id DESC LIMIT 1";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':id',$this->id);
            $statement->execute();

            $res=Array();

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                $res[]=Array('id'=>$row->id,'trp_id'=>$row->rid,'start'=>$row->start,'end'=>$row->end,'gc'=>$row->gc,'dc'=>$row->dc,'gasoline_charge'=>$row->gasoline_charge,'drivers_charge'=>$row->drivers_charge);
            }
               

           echo json_encode($res);
                

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


     function update_charges($id,Request $request){

            try{
                $this->token = $request->input('_token');
                $this->id=htmlentities(htmlspecialchars($id));
                $this->in=htmlentities(htmlspecialchars($request->input('in')));
                $this->out=htmlentities(htmlspecialchars($request->input('out')));
                $this->gasoline_charge=htmlentities(htmlspecialchars($request->input('gasoline_charge')));
                $this->drivers_charge=htmlentities(htmlspecialchars($request->input('drivers_charge')));
                $this->appointment=htmlentities(htmlspecialchars($request->input('appointment')));

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="UPDATE tr_charge SET start=:start,end=:end,dca=:dca,gasoline_charge=:gasoline_charge,drivers_charge=:drivers_charge where id=:id";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':id',$this->id);
                $insert_statement->bindParam(':start',$this->in);
                $insert_statement->bindParam(':end',$this->out);
                $insert_statement->bindParam(':dca',$this->appointment);
                $insert_statement->bindParam(':gasoline_charge',$this->gasoline_charge);
                $insert_statement->bindParam(':drivers_charge',$this->drivers_charge);
               
                
                #exec the transaction
                $insert_statement->execute();
                $lastId=$insert_statement->rowCount();
                $this->pdoObject->commit();

                #return
                echo $lastId;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


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
        //
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
                $this->id=htmlentities(htmlspecialchars($id));
                $this->pdoObject->beginTransaction();
                $remove_rfp_sql="DELETE FROM travel where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


    public  function destroy_linked_travel($id){
        try{

                $this->id=htmlentities(htmlspecialchars($id));

                $this->pdoObject=DB::connection()->getPdo();
                $this->pdoObject->beginTransaction();
                $remove_rfp_sql="DELETE FROM travel_link where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);

                $sql1="SELECT * FROM travel_link where id=:id";
                $statement1=$this->pdoObject->prepare($sql1);
                $statement1->bindParam(':id',$this->id);
                $statement1->execute();
                $result=0;
                $count=0;
                $removeRowCount=0;

                while($row1=$statement1->fetch(\PDO::FETCH_OBJ)){
                    $remove_statement->execute();
                    //count if 0 reamaining
                    $sql="SELECT count(*) as total FROM travel_link where child_id=:id";
                    $statement=$this->pdoObject->prepare($sql);
                    $statement->bindParam(':id',$row1->child_id);
                    $statement->execute();
                    
                    while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                        $count=$row->total;
                    }

                    $removeRowCount=$remove_statement->rowCount()>0?$remove_statement->rowCount():0;
                    
                    if($removeRowCount>0&&$count<1){
                        $sql2="UPDATE travel set linked='no' where id=:id";
                        $statement2=$this->pdoObject->prepare($sql2);
                        $statement2->bindParam(':id',$row1->child_id);
                        $statement2->execute();
                        $result=$statement2->rowCount()>0?$statement2->rowCount():0;
                    }
                }


                $this->pdoObject->commit();

                return $removeRowCount;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }
}
