<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class Campus_itenerary extends Controller
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
                $sql="SELECT * FROM trc_travel where trc_id=:id";
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
            $insert_sql="INSERT INTO trc_travel(trc_id,location,destination,departure_time,departure_date,driver_id)values(:tr_id,:location,:destination,:time,:datez,:driver_id)";
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
            $sql="UPDATE trc_travel set status=:status where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':status',$status);
            $statement->bindParam(':id',$id);
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
            $sql="UPDATE trc_travel set plate_no=:plate_no where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':plate_no',$this->plate_no);
            $statement->bindParam(':id',$this->id);
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
            $sql="UPDATE trc_travel set driver_id=:driver where id=:id";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':driver',$this->driver);
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
                $this->gc=null;
                $this->dc=null;
            
            
            
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
                }


                //gasoline charge
                $sql2="SELECT * FROM dc where id=:id";
                $sth2=$this->pdoObject->prepare($sql2);
                $sth2->bindParam(':id',$this->drivers_charge);
                $sth2->execute();

                while ($dc=$sth2->fetch(\PDO::FETCH_OBJ)) {
                   $this->dc=$dc->rate;
                }

                


                if(!is_null($this->dc)&&!is_null($this->gc)){

                    $insert_sql="INSERT INTO trc_charge(rid,start,end,dca,gasoline_charge,drivers_charge,gc,dc) values (:rid,:start,:end,:dca,:gasoline_charge,:drivers_charge,:gc,:dc)";

                    $insert_statement=$this->pdoObject->prepare($insert_sql);
            
                    #params
                    $insert_statement->bindParam(':rid',$this->id);
                    $insert_statement->bindParam(':start',$this->in);
                    $insert_statement->bindParam(':end',$this->out);
                    $insert_statement->bindParam(':dca',$this->appointment);
                    $insert_statement->bindParam(':gasoline_charge',$this->gc);
                    $insert_statement->bindParam(':drivers_charge',$this->dc);
                    $insert_statement->bindParam(':gc',$this->gasoline_charge);
                    $insert_statement->bindParam(':dc',$this->drivers_charge); 
                    #exec the transaction
                    $insert_statement->execute();
                   
                }

                

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

           $sql="SELECT trc_charge.*,tr_gc.base,dc.days,dc.rate FROM trc_charge LEFT JOIN tr_gc on trc_charge.gc=tr_gc.id LEFT JOIN dc on dc.id=trc_charge.dc where rid=:id ORDER BY id DESC LIMIT 1";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':id',$this->id);
            $statement->execute();

            $res=Array();

           while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                $res[]=Array('id'=>$row->id,'trp_id'=>$row->rid,'start'=>$row->start,'end'=>$row->end,'gc'=>$row->gc,'dc'=>$row->dc,'gasoline_charge'=>$row->gasoline_charge,'drivers_charge'=>$row->drivers_charge,'appointment'=>$row->dca,'base'=>$row->base,'days'=>$row->days);
            }
               

           return json_encode($res);
                

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
                
                $insert_sql="UPDATE trc_charge SET start=:start,end=:end,dca=:dca,gasoline_charge=:gasoline_charge,drivers_charge=:drivers_charge where id=:id";
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

     function scheduled($date){

        try{
                $this->pdoObject=DB::connection()->getPdo();
               
                $this->datez=htmlentities(htmlspecialchars($date));
                
                $this->pdoObject->beginTransaction();
                

                 $sql="SELECT tr.status as tr_status,tr.requested_by,travel.status,location,departure_date,returned_date,departure_time,actual_departure_time,returned_time,destination,tr_id,travel.id,travel.plate_no,automobile.manufacturer, login_db.account_profile.last_name, login_db.account_profile.first_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id LEFT JOIN tr on travel.tr_id=tr.id  where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)  and linked='no' and tr.status>0 ORDER BY departure_date DESC";

                  $sql="SELECT trc.requested_by,trc.status as trc_status,trc_travel.*,automobile.manufacturer, login_db.account_profile.last_name, login_db.account_profile.first_name FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no  LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id LEFT JOIN trc on trc_travel.trc_id=trc.id where departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)   and trc.status>0 ORDER BY departure_date DESC";


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
                

                  $sql="SELECT trc.requested_by,trc.status as trc_status,trc_travel.*,automobile.manufacturer, login_db.account_profile.last_name, login_db.account_profile.first_name FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no  LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id LEFT JOIN trc on trc_travel.trc_id=trc.id where trc.requested_by=:id and departure_date>= :datez1  and departure_date< (:datez2 +INTERVAL 1 MONTH)   and trc.status>0 ORDER BY departure_date DESC";


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
                $sql="SELECT trc_travel.*,automobile.manufacturer,login_db.account_profile.profile_name FROM trc_travel LEFT JOIN automobile on automobile.plate_no=trc_travel.plate_no LEFT JOIN login_db.account_profile on login_db.account_profile.id=driver_id where trc_travel.id=:id";
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
                $remove_rfp_sql="DELETE FROM trc_travel where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
