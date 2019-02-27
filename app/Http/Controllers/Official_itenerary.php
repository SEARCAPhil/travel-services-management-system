<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Http\Controllers\Charge;

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
                $sql="SELECT tr.request_type,travel.* FROM travel left join tr on travel.tr_id=tr.id where tr_id=:id";
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
        $driver=$request->input('driver_id');
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
            $insert_sql="INSERT INTO travel(tr_id,location,destination,departure_time,departure_date,driver_id)values(:tr_id,:location,:destination,:time,:datez,:driver_id)";
            #prepare sql first
            $insert_statement=$this->pdoObject->prepare($insert_sql);

            
        
            $insert_statement->bindParam(':tr_id',$this->tr);
         

                #all param for both
                $insert_statement->bindParam(':location',$this->from);
                $insert_statement->bindParam(':time',$this->time);
                $insert_statement->bindParam(':datez',$this->date);
                $insert_statement->bindParam(':destination',$this->destination);
                $insert_statement->bindParam(':driver_id',$driver);
            

            
            
            
            
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
                $sql="SELECT tr.status as tr_status,tr.request_type,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where travel.status='scheduled' and departure_date!='0000-00-00' and linked='no' and tr.status='2' and travel.id!=:id  ORDER BY travel.id DESC LIMIT :start,10";

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



    function scheduled($date){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                
                $this->pdoObject->beginTransaction();
               
                 $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)  and linked='no' and tr.status>0 ORDER BY departure_date DESC";


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

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'travel');
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
               
                 $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where tr.requested_by=:id and departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)  and linked='no' and tr.status>0 ORDER BY departure_date DESC";


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

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'travel');
                }
                $this->pdoObject->commit();

                return json_encode($res);

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

                return json_encode($data);

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
        $this->id=htmlentities(htmlspecialchars($id));
        $this->token = $request->input('_token');
        $this->driver = $request->input('driver');
        $this->driver_name = $request->input('driver_name');

        //assign other driver if driver param is a string
       if(gettype($this->driver)==='string'&&$this->driver=='n/a'){
            return self::update_other_driver($this->id,$this->driver_name);
       }
       
        
        try{


            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE travel set driver_id=:driver ,other_driver='' where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':driver',$this->driver);
            $statement->bindParam(':id',$this->id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            echo $isUpdated;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


    public function update_other_driver($id,$driver){

        try{
            $this->id=htmlentities(htmlspecialchars($id));
            $this->driver=htmlentities(htmlspecialchars($driver));
            $this->driver_id=null;

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="UPDATE travel set driver_id=:driver_id,other_driver=:driver where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':driver_id',$this->driver_id);
            $statement->bindParam(':driver',$this->driver);
            $statement->bindParam(':id',$this->id);
            $statement->execute();
            $isUpdated=$statement->rowCount();
            $this->pdoObject->commit();

            return $isUpdated;

        }catch(Exception $e){$this->pdoObject->rollback();return $e->getMessage();}

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


    function update_date_time($id,$departure_date,$departure_time,$arrival_date,$arrival_time){
        $this->id=htmlentities(htmlspecialchars($id));
        $this->departure_date=htmlentities(htmlspecialchars($departure_date));
        $this->departure_time=htmlentities(htmlspecialchars($departure_time));
        $this->arrival_date=htmlentities(htmlspecialchars($arrival_date));
        $this->arrival_time=htmlentities(htmlspecialchars($arrival_time));

        $this->pdoObject=DB::connection()->getPdo();
        //date settings
        $sql_time="UPDATE travel set departure_date=:departure_date,actual_departure_time=:departure_time,returned_date=:returned_date,returned_time=:returned_time  where id=:id";
        $sth_time=$this->pdoObject->prepare($sql_time);
        $sth_time->bindParam(':departure_date',$this->departure_date);
        $sth_time->bindParam(':departure_time',$this->departure_time);
        $sth_time->bindParam(':returned_date',$this->arrival_date);
        $sth_time->bindParam(':returned_time',$this->arrival_time);
        $sth_time->bindParam(':id',$this->id);
        $sth_time->execute();
        $isUpdated=$sth_time->rowCount();

        return $isUpdated;

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


                $this->departure_date=htmlentities(htmlspecialchars($request->input('departure_date')));
                $this->departure_time=htmlentities(htmlspecialchars($request->input('departure_time')));
                $this->arrival_date=htmlentities(htmlspecialchars($request->input('arrival_date')));
                $this->arrival_time=htmlentities(htmlspecialchars($request->input('arrival_time')));
                        


                $this->gc=null;
                $this->dc=null;
                $this->base=null;
                $this->drivers_day_rate=null;
                $this->rid=null;

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();

                //gasoline charge
                $sql="SELECT * FROM tr_gc where id=:id";
                $sth=$this->pdoObject->prepare($sql);
                $sth->bindParam(':id',$this->gasoline_charge);
                $sth->execute();

                while ($gc=$sth->fetch(\PDO::FETCH_OBJ)) {
                   $this->gc=$gc->rates;
                    $this->base=$gc->base;
                }


                //gasoline charge
                $sql2="SELECT * FROM dc where id=:id";
                $sth2=$this->pdoObject->prepare($sql2);
                $sth2->bindParam(':id',$this->drivers_charge);
                $sth2->execute();

                while ($dc=$sth2->fetch(\PDO::FETCH_OBJ)) {
                    $this->dc=$dc->rate;
                    $this->drivers_day_rate=$dc->days;
                }

                


                if(!is_null($this->dc)&&!is_null($this->gc)){

                    $insert_sql="INSERT INTO tr_charge(rid,start,end,dca,gasoline_charge,drivers_charge,gc,dc,base_km,drivers_day_rate) values (:rid,:start,:end,:dca,:gasoline_charge,:drivers_charge,:gc,:dc,:base_km,:drivers_day_rate)";

                    $insert_statement=$this->pdoObject->prepare($insert_sql);
                if(is_null($this->base)) $this->base = 25; 
                    #params
                    $insert_statement->bindParam(':rid',$this->id);
                    $insert_statement->bindParam(':start',$this->in);
                    $insert_statement->bindParam(':end',$this->out);
                    $insert_statement->bindParam(':dca',$this->appointment);
                    $insert_statement->bindParam(':gasoline_charge',$this->gc);
                    $insert_statement->bindParam(':drivers_charge',$this->dc);
                    $insert_statement->bindParam(':gc',$this->gasoline_charge);
                    $insert_statement->bindParam(':dc',$this->drivers_charge); 
                    $insert_statement->bindParam(':base_km',$this->base); 
                    $insert_statement->bindParam(':drivers_day_rate',$this->drivers_day_rate); 
                    
                    #exec the transaction
                    $insert_statement->execute();


                  
                   
                }



                #charge id
                $lastId=$this->pdoObject->lastInsertId();


                #charge computation module
                $charge_travel=new Charge();


                #get ravel details
                $itenerary=@json_decode(self::show($this->id))[0];

                
                $gasoline_charge=$charge_travel->calculate_gasoline_charge($this->base,($this->out-$this->in),$this->gc,$default_rate='25');
        

                if($this->appointment=='emergency'){
                    $drivers_charge=($charge_travel->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->actual_departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc));
                }else{
                    $drivers_charge=($charge_travel->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->actual_departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc,$this->drivers_day_rate));
                }

                $overall_gasoline_charge=@array_sum($gasoline_charge);
                $overall_charge=$overall_gasoline_charge+$drivers_charge;

                $total_execess_time=0;
                #prevent wrong calculation if returned date is < departure_date
                if($itenerary->departure_date<$itenerary->returned_date){
                    $calculated_excess_time=$charge_travel->calculate_excess_time($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time);

                    #convert to overall hours
                    $days_to_hours=$calculated_excess_time['days']*24;
                    $hours=$calculated_excess_time['hours'];
                    $minutes_to_hour=$calculated_excess_time['minutes']/60;

                    $total_execess_time=$days_to_hours+$hours+$minutes_to_hour;

                }


               

                self::create_charge_breakdown($lastId,$gasoline_charge['amount'],$gasoline_charge['additional'],$drivers_charge,$total_execess_time,$overall_charge);

                $isDateTimeUpdated=self::update_date_time($this->id,$this->departure_date,$this->departure_time,$this->arrival_date,$this->arrival_time);


                $this->pdoObject->commit();

                #return
                echo $lastId||$isDateTimeUpdated;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


    }


    function show_charges($id){
        try{

            $this->id=htmlentities(htmlspecialchars($id));


            $this->pdoObject=DB::connection()->getPdo();

            $sql="SELECT tr_charge.*,tr_charge_breakdown.charge,tr_charge_breakdown.notes,tr_charge_breakdown.additional_charge,tr_charge_breakdown.drivers_overtime_charge,tr_charge_breakdown.overtime,tr_charge_breakdown.total FROM tr_charge LEFT JOIN tr_charge_breakdown on tr_charge_breakdown.charge_id=tr_charge.id where rid=:id ORDER BY tr_charge_breakdown.id DESC LIMIT 1";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':id',$this->id);
            $statement->execute();

            $res=Array();

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                $res[]=Array('id'=>$row->id,'trp_id'=>$row->rid,'start'=>$row->start,'end'=>$row->end,'gc'=>$row->gc,'dc'=>$row->dc,'gasoline_charge'=>$row->gasoline_charge,'drivers_charge'=>$row->drivers_charge,'additional_charge'=>$row->additional_charge,'appointment'=>$row->dca,'base'=>$row->base_km,'days'=>$row->drivers_day_rate,'total'=>$row->total,'notes'=>$row->notes);
            }
               

           return json_encode($res);
                

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


    function show_advance_charges($id){

        $charges=self::show_charges($id);

        $charge_id=@json_decode($charges)[0]->id;

        if(!empty($charge_id)&&!is_null($charge_id)){

            try{

                $this->id=htmlentities(htmlspecialchars($charge_id));


                $this->pdoObject=DB::connection()->getPdo();

                $sql="SELECT * from tr_charge_breakdown where charge_id=:id ORDER BY date_modified DESC LIMIT 1";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();

                $res=Array();

                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=Array('id'=>$row->id,'charge_id'=>$row->charge_id,'gasoline_charge'=>$row->charge,'drivers_charge'=>$row->drivers_overtime_charge,'additional_charge'=>$row->additional_charge,'total'=>$row->total,'notes'=>$row->notes);
                }
                   

               return json_encode($res);
                    

            }catch(Exception $e){
                echo $e->getMessage();
            }

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

            
                $this->departure_date=htmlentities(htmlspecialchars($request->input('departure_date')));
                $this->departure_time=htmlentities(htmlspecialchars($request->input('departure_time')));
                $this->arrival_date=htmlentities(htmlspecialchars($request->input('arrival_date')));
                $this->arrival_time=htmlentities(htmlspecialchars($request->input('arrival_time')));
            
                $this->gc=null;
                $this->dc=null;
                $this->base=null;
                $this->drivers_day_rate=null;
                $this->rid=null;
            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();


                //gasoline charge
                $sql="SELECT * FROM tr_gc where id=:id";
                $sth=$this->pdoObject->prepare($sql);
                $sth->bindParam(':id',$this->gasoline_charge);
                $sth->execute();

                while ($gc=$sth->fetch(\PDO::FETCH_OBJ)) {
                   $this->gc=$gc->rates;
                   $this->base=$gc->base;
                }


                //drivers charge
                $sql2="SELECT * FROM dc where id=:id";
                $sth2=$this->pdoObject->prepare($sql2);
                $sth2->bindParam(':id',$this->drivers_charge);
                $sth2->execute();

                while ($dc=$sth2->fetch(\PDO::FETCH_OBJ)) {
                    $this->dc=$dc->rate;
                    $this->drivers_day_rate=$dc->days;
                }


                #get rid form preview
                //drivers charge
                $sql3="SELECT rid FROM tr_charge where id=:id";
                $sth3=$this->pdoObject->prepare($sql3);
                $sth3->bindParam(':id',$this->id);
                $sth3->execute();

                while ($preview=$sth3->fetch(\PDO::FETCH_OBJ)) {
                    $this->rid=$preview->rid;
                
                }



                
                $insert_sql="UPDATE tr_charge SET start=:start,end=:end,dca=:dca,gasoline_charge=:gasoline_charge,drivers_charge=:drivers_charge,gc=:gc,dc=:dc,base_km=:base,drivers_day_rate=:day where id=:id";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
                if(is_null($this->base)) $this->base = 25;
                #params
                $insert_statement->bindParam(':id',$this->id);
                $insert_statement->bindParam(':start',$this->in);
                $insert_statement->bindParam(':end',$this->out);
                $insert_statement->bindParam(':dca',$this->appointment);
                $insert_statement->bindParam(':gasoline_charge',$this->gc);
                $insert_statement->bindParam(':drivers_charge',$this->dc);
                $insert_statement->bindParam(':gc',$this->gasoline_charge);
                $insert_statement->bindParam(':dc',$this->drivers_charge); 
                $insert_statement->bindParam(':base',$this->base);
                $insert_statement->bindParam(':day',$this->drivers_day_rate); 
                
                #exec the transaction
                $insert_statement->execute();
                $is_saved=$insert_statement->rowCount();


                #charge computation module
                $charge_travel=new Charge();


                #get ravel details
                $itenerary=@json_decode(self::show($this->rid))[0];


                $gasoline_charge=$charge_travel->calculate_gasoline_charge($this->base,(($this->out-$this->in)>=0?$this->out-$this->in:0),$this->gc,$default_rate='25');
        

                if($this->appointment=='emergency'){
                    $drivers_charge=($charge_travel->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->actual_departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc));
                }else{
                    $drivers_charge=($charge_travel->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->actual_departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc,$this->drivers_day_rate));
                }

                $overall_gasoline_charge=@array_sum($gasoline_charge);
                $overall_charge=$overall_gasoline_charge+$drivers_charge;

                $total_execess_time=0;
                #prevent wrong calculation if returned date is < departure_date
                if($itenerary->departure_date<$itenerary->returned_date){
                    $calculated_excess_time=$charge_travel->calculate_excess_time($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time);

                    #convert to overall hours
                    $days_to_hours=$calculated_excess_time['days']*24;
                    $hours=$calculated_excess_time['hours'];
                    $minutes_to_hour=$calculated_excess_time['minutes']/60;

                    $total_execess_time=$days_to_hours+$hours+$minutes_to_hour;

                }



               

                $charge_result=self::update_charge_breakdown($id,$gasoline_charge['amount'],$gasoline_charge['additional'],$drivers_charge,$total_execess_time,$overall_charge);
                $isDateTimeUpdated=self::update_date_time($this->id,$this->departure_date,$this->departure_time,$this->arrival_date,$this->arrival_time);

                $this->pdoObject->commit();
                #return
                echo $is_saved||$isDateTimeUpdated;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


    }



    function create_charge_breakdown($charge_id,$charge,$additional_charge,$drivers_overtime_charge,$overtime,$total,$notes=''){

            try{
             
                $this->charge_id=htmlentities(htmlspecialchars($charge_id));
                $this->charge=htmlentities(htmlspecialchars($charge));
                $this->additional_charge=htmlentities(htmlspecialchars($additional_charge));
                $this->drivers_overtime_charge=htmlentities(htmlspecialchars($drivers_overtime_charge));
                $this->overtime=htmlentities(htmlspecialchars($overtime));
                $this->total=htmlentities(htmlspecialchars($total));
                $this->notes=htmlentities(htmlspecialchars($notes));

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction   
                $insert_sql="INSERT INTO tr_charge_breakdown(charge_id,charge,additional_charge,drivers_overtime_charge,overtime,total,notes)values(:charge_id,:charge,:additional_charge,:drivers_overtime_charge,:overtime,:total,:notes)";

                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':charge_id',$this->charge_id);
                $insert_statement->bindParam(':charge',$this->charge);
                $insert_statement->bindParam(':additional_charge',$this->additional_charge);
                $insert_statement->bindParam(':drivers_overtime_charge',$this->drivers_overtime_charge);
                $insert_statement->bindParam(':overtime',$this->overtime);
                $insert_statement->bindParam(':total',$this->total);
                $insert_statement->bindParam(':notes',$this->notes);
                
                #exec the transaction
                $insert_statement->execute();
                $lastId=$this->pdoObject->lastInsertId();
             

                #return
                return $lastId;
            


        }catch(Exception $e){ echo $e->getMessage();}


    }


    function update_charge_breakdown($charge_id,$charge,$additional_charge,$drivers_overtime_charge,$overtime,$total){

            try{
             
                $this->charge_id=htmlentities(htmlspecialchars($charge_id));
                $this->charge=htmlentities(htmlspecialchars($charge));
                $this->additional_charge=htmlentities(htmlspecialchars($additional_charge));
                $this->drivers_overtime_charge=htmlentities(htmlspecialchars($drivers_overtime_charge));
                $this->overtime=htmlentities(htmlspecialchars($overtime));
                $this->total=htmlentities(htmlspecialchars($total));

            
            
            
                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction   
                $insert_sql="UPDATE tr_charge_breakdown set charge=:charge,additional_charge=:additional_charge,drivers_overtime_charge=:drivers_overtime_charge,overtime=:overtime,total=:total where charge_id=:charge_id";

                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':charge_id',$this->charge_id);
                $insert_statement->bindParam(':charge',$this->charge);
                $insert_statement->bindParam(':additional_charge',$this->additional_charge);
                $insert_statement->bindParam(':drivers_overtime_charge',$this->drivers_overtime_charge);
                $insert_statement->bindParam(':overtime',$this->overtime);
                $insert_statement->bindParam(':total',$this->total);
                
                #exec the transaction
                $insert_statement->execute();
                $is_updated=$insert_statement->rowCount();
             

                #return
                return  $is_updated;
            


        }catch(Exception $e){ echo $e->getMessage();}


    }

   function create_advance_charge_breakdown(Request $request){

        $token = $request->input('_token');
        $id = $request->input('id');
        $gasoline_charge = $request->input('gasoline_charge');
        $additional_charge = $request->input('additional_charge');
        $drivers_charge= $request->input('drivers_charge');
        $notes= $request->input('notes');

        $total=$gasoline_charge+$drivers_charge+$additional_charge;



        $charges=self::show_charges($id);

        $charge_id=@json_decode($charges)[0]->id;

        if(!empty($charge_id)&&!is_null($charge_id)){
            //override charges 
          return self::create_charge_breakdown($charge_id,$gasoline_charge,$additional_charge,$drivers_charge,0,$total,$notes);  
        }
       
        return 0;

   }



    public function vehicle_type(Request $request){
        $token = $request->input('_token');
        $vehicle = $request->input('vehicle');
        $id = $request->input('id');

        try{
            $this->pdoObject=DB::connection()->getPdo();
            $this->tr=htmlentities(htmlspecialchars($id));
            $this->p=htmlentities(htmlspecialchars($vehicle));
            #for update only
            
            

            #begin transaction
            $this->pdoObject->beginTransaction();
            
            $insert_sql="UPDATE tr set vehicle_type=:p where id=:tr_id";
            $insert_statement=$this->pdoObject->prepare($insert_sql);
    
            #params
            $insert_statement->bindParam(':tr_id',$this->tr);
            $insert_statement->bindParam(':p',$this->p);
            
            
            #exec the transaction
            $insert_statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();

            #return
            return $insert_statement->rowCount()>0?$insert_statement->rowCount():0;
            


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

        try{
           
                $this->id=htmlentities(htmlspecialchars($id));
                $this->pdoObject=DB::connection()->getPdo();
                $sql="SELECT travel.*,automobile.manufacturer,account_profile.profile_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id where travel.id=:id";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();

                // gasoline records
                $sql2="SELECT * FROM gasoline where tt_number=:id";
                
                
                // result
                while($row=$statement->fetch()){$statement2=$this->pdoObject->prepare($sql2);
                    $statement2->bindParam(':id',$row['id']);
                    $statement2->execute();
                    $row['gasoline_records'] = [];
                    //gas
                    while($row2=$statement2->fetch()) {
                        $row['gasoline_records'][] = $row2;
                    }
                    
                    $res[]=$row;
                }
                

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();}
        
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



        function scheduled_in_calendar($date){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                
                $this->pdoObject->beginTransaction();
               
                 $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, account_profile.last_name, account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN account_profile on account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)  and linked='no' and (tr.status=2||tr.status=4) ORDER BY departure_date DESC";


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

                    $res[]=Array('id'=>$row->id,'tr_id'=>$row->tr_id,'status'=>$row->status,'location'=>$row->location,'destination'=>$row->destination,'departure_date'=>$row->departure_date,'departure_time'=>$row->departure_time,'returned_time'=>$row->returned_time,'plate_no'=>$row->plate_no,'driver'=>$driver,'type'=>'travel');
                }
                $this->pdoObject->commit();

                return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }
}
