<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Http\Controllers\Charge;

class Personal_itenerary extends Controller
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
        $driver=$request->input('driver_id');
        $tr=$request->input('tr_id');

         try{

            $this->pdoObject=DB::connection()->getPdo();
            $this->tr=htmlentities(htmlspecialchars($tr));
            $this->destination=htmlentities(htmlspecialchars($destination));
            $this->from=htmlentities(htmlspecialchars($origin));
            $this->time=htmlentities(htmlspecialchars($departure_time));
            $this->date=htmlentities(htmlspecialchars($departure_date));
            $this->driver=htmlentities(htmlspecialchars($driver));
        

            #begin transaction
            $this->pdoObject->beginTransaction();
            #if action is create
            $insert_sql="UPDATE trp set destination=:destination,location=:location, departure_date=:datez,departure_time=:timex,driver_id=:driver where id=:id";
            #prepare sql first
            $insert_statement=$this->pdoObject->prepare($insert_sql);

            
        
            $insert_statement->bindParam(':id',$this->tr);
         

            #all param for both
            $insert_statement->bindParam(':location',$this->from);
            $insert_statement->bindParam(':timex',$this->time);
            $insert_statement->bindParam(':datez',$this->date);
            $insert_statement->bindParam(':destination',$this->destination);
            $insert_statement->bindParam(':driver',$this->driver);
            

            
            #exec the transaction
            $insert_statement->execute();
            $this->pdoObject->commit();
            
           

            $res=array('id'=>$this->tr,'departure_date'=>$this->date,'location'=>$this->from,'destination'=>$this->destination,'departure_time'=>$this->time);
            return json_encode($res);
            
            
            

        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}
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
            
            $insert_sql="UPDATE trp set vehicle_type=:p where id=:tr_id";
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
            $sql="UPDATE trp set status=:status where id=:id";
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
            $sql="UPDATE trp set plate_no=:plate_no where id=:id";
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
            $sql="UPDATE trp set driver_id=:driver where id=:id";
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

                    $insert_sql="INSERT INTO trp_charge(rid,start,end,dca,gasoline_charge,drivers_charge,gc,dc,base_km,drivers_day_rate) values (:rid,:start,:end,:dca,:gasoline_charge,:drivers_charge,:gc,:dc,:base_km,:drivers_day_rate)";

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
                    $insert_statement->bindParam(':base_km',$this->base); 
                    $insert_statement->bindParam(':drivers_day_rate',$this->drivers_day_rate);  
                    #exec the transaction
                    $insert_statement->execute();
                   
                }

                

                $lastId=$this->pdoObject->lastInsertId();

                $personal_travel=new Personal();
                #charge computation module
                $charge_travel=new Charge();


                $itenerary=@json_decode($personal_travel->show($this->id))[0];

                
                $gasoline_charge=$charge_travel->calculate_gasoline_charge($this->base,$this->out-$this->in,$this->gc,$default_rate='25');
        

                if($this->appointment=='emergency'){
                    $drivers_charge=($charge_travel->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc));
                }else{
                    $drivers_charge=($charge_travel->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc,$this->drivers_day_rate));
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




                $this->pdoObject->commit();

                #return
                echo $lastId;
            


        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}


    }


     function show_charges($id){
        try{

            $this->id=htmlentities(htmlspecialchars($id));


            $this->pdoObject=DB::connection()->getPdo();

            $sql="SELECT trp_charge.*,trp_charge_breakdown.charge,trp_charge_breakdown.notes,trp_charge_breakdown.additional_charge,trp_charge_breakdown.charge,trp_charge_breakdown.drivers_overtime_charge,trp_charge_breakdown.overtime,trp_charge_breakdown.total FROM trp_charge LEFT JOIN trp_charge_breakdown on trp_charge_breakdown.charge_id=trp_charge.id where rid=:id ORDER BY trp_charge_breakdown.id DESC LIMIT 1";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':id',$this->id);
            $statement->execute();

            $res=Array();

            while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                $res[]=Array('id'=>$row->id,'trp_id'=>$row->rid,'start'=>$row->start,'end'=>$row->end,'gc'=>$row->gc,'dc'=>$row->dc,'charge'=>$row->charge,'gasoline_charge'=>$row->gasoline_charge,'drivers_charge'=>$row->drivers_charge,'additional_charge'=>$row->additional_charge,'drivers_overtime_charge'=>$row->drivers_overtime_charge,'overtime'=>$row->overtime,'appointment'=>$row->dca,'base'=>$row->base_km,'days'=>$row->drivers_day_rate,'total'=>$row->total,'notes'=>$row->notes);
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

                $sql="SELECT * from trp_charge_breakdown where charge_id=:id ORDER BY date_modified DESC LIMIT 1";
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
            $sql3="SELECT rid FROM trp_charge where id=:id";
            $sth3=$this->pdoObject->prepare($sql3);
            $sth3->bindParam(':id',$this->id);
            $sth3->execute();

            while ($preview=$sth3->fetch(\PDO::FETCH_OBJ)) {
                $this->rid=$preview->rid;
            
            }



            
            $insert_sql="UPDATE trp_charge SET start=:start,end=:end,dca=:dca,gasoline_charge=:gasoline_charge,drivers_charge=:drivers_charge,gc=:gc,dc=:dc,base_km=:base,drivers_day_rate=:day where id=:id";
            $insert_statement=$this->pdoObject->prepare($insert_sql);
    
            #params
            $insert_statement->bindParam(':id',$this->id);
            $insert_statement->bindParam(':start',$this->in);
            $insert_statement->bindParam(':end',$this->out);
            $insert_statement->bindParam(':dca',$this->appointment);
            $insert_statement->bindParam(':gasoline_charge',$this->gasoline_charge);
            $insert_statement->bindParam(':drivers_charge',$this->drivers_charge);
            $insert_statement->bindParam(':gc',$this->gasoline_charge);
            $insert_statement->bindParam(':dc',$this->drivers_charge); 
            $insert_statement->bindParam(':base',$this->base);
            $insert_statement->bindParam(':day',$this->drivers_day_rate); 
                
           
            
            #exec the transaction
            $insert_statement->execute();
            $lastId=$insert_statement->rowCount();


            $personal_travel=new Personal();
            #charge computation module
            $charge_travel=new Charge();




            #get ravel details
            $itenerary=@json_decode($personal_travel->show($this->rid))[0];

            
            $gasoline_charge=$charge_travel->calculate_gasoline_charge($this->base,$this->out-$this->in,$this->gc,$default_rate='25');
    

            if($this->appointment=='emergency'){
                $drivers_charge=($charge_travel->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc));
            }else{
                $drivers_charge=($charge_travel->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$this->dc,$this->drivers_day_rate));
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




            $this->pdoObject->commit();

            #return
            echo $lastId;
        


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
                $insert_sql="INSERT INTO trp_charge_breakdown(charge_id,charge,additional_charge,drivers_overtime_charge,overtime,total,notes)values(:charge_id,:charge,:additional_charge,:drivers_overtime_charge,:overtime,:total,:notes)";

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
                $insert_sql="UPDATE trp_charge_breakdown set charge=:charge,additional_charge=:additional_charge,drivers_overtime_charge=:drivers_overtime_charge,overtime=:overtime,total=:total where charge_id=:charge_id";

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
            $this->tr=htmlentities(htmlspecialchars($id));
            $this->destination='';
            $this->from='';
            $this->time='';
            $this->date='';
            $this->driver='';
        

            #begin transaction
            $this->pdoObject->beginTransaction();
            #update to empty fields
            $insert_sql="UPDATE trp set destination=:destination,location=:location, departure_date=:datez,departure_time=:timex,driver_id=:driver where id=:id";
            #prepare sql first
            $insert_statement=$this->pdoObject->prepare($insert_sql);

            
        
            $insert_statement->bindParam(':id',$this->tr);
         

            #all param for both
            $insert_statement->bindParam(':location',$this->from);
            $insert_statement->bindParam(':timex',$this->time);
            $insert_statement->bindParam(':datez',$this->date);
            $insert_statement->bindParam(':destination',$this->destination);
            $insert_statement->bindParam(':driver',$this->driver);
            

            
            #exec the transaction
            $insert_statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();
            
           

           
            echo $insert_statement->rowCount();
            
            
            

        }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
