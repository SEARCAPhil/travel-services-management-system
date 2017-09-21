<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;



use App\Http\Requests;



class Charge extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($id)

    {



      



        

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(Request $request)

    {

        

    }





     function recent($page=1,$id){



       



    }





    



    

    function calculate_gasoline_charge($threshold,$mileage,$rate,$default_rate='25'){

        $amount=$rate;

        $additional_charges=0;



        if($mileage>$threshold){



            #get excess KM from threshld

            $excess_mileage=$mileage-$threshold;

            $additional_charges=$excess_mileage*$default_rate;

        }



        return array('amount'=>$amount,'additional'=>$additional_charges);



    }





    function calculate_excess_time($departure_date,$departure_time,$returned_date,$returned_time){



        $date_difference=date_diff(date_create($departure_date.' '.$departure_time),date_create($returned_date.' '.$returned_time));



        

        $days=$date_difference->days;

        $months=$date_difference->m;

        $hours=$date_difference->h;

        $minutes=$date_difference->i;

        $seconds=$date_difference->s;



        #get day and time only

        return array('days'=>$days,'hours'=>$hours,'minutes'=>$minutes);



    }







    function calculate_emergency_drivers_charge($departure_date,$departure_time,$returned_date,$returned_time,$rate){



        #prevent wrong calculation if returned date is < departure_date

        if($departure_date>$returned_date){

            return 0;

        }



        $calculated_excess_time=self::calculate_excess_time($departure_date,$departure_time,$returned_date,$returned_time);



        $days=$calculated_excess_time['days'];

        $hours=$calculated_excess_time['hours'];

        $minutes=$calculated_excess_time['minutes'];



        #89 hours to subtract every day 

        $regular_hours=$days*8;







        #basic pay for excess days

        #deduct 8 hours every exceeding days

        $drivers_charge_per_day=(($days*24)-$regular_hours)*$rate;







        $additional_charge=0;



    

            #calculate the payment per day



            #convert hours to minutes

            $hours_to_min=($hours*60);



            #calculate overall minutes

            $minutes=$hours_to_min+$minutes; 



            #convert to hour

            $min_to_hour=($minutes)/60;



            

            if($min_to_hour>8){ 

                #additional charge only applies for beyond 8 working hours.

                $excess_hours=$min_to_hour-8;



                

                $additional_charge=$excess_hours*$rate;



            }else{

               $additional_charge=$min_to_hour*$rate; 

            }



          





             return $drivers_charge_per_day+$additional_charge;

    }







    function calculate_contracted_drivers_charge($departure_date,$departure_time,$returned_date,$returned_time,$rate,$daily_rate='week day'){



       #prevent wrong calculation if returned date is < departure_date

        if($departure_date>$returned_date){

            return 0;

        }



        $calculated_excess_time=self::calculate_excess_time($departure_date,$departure_time,$returned_date,$returned_time);



        $days=$calculated_excess_time['days'];

        $hours=$calculated_excess_time['hours'];

        $minutes=$calculated_excess_time['minutes'];







        #basic pay for excess days

        $drivers_charge_per_day=($days*24)*$rate;

        $additional_charge=0;



        #contracted week days  ot=in<8 am and out>5pm

        

        if($daily_rate=='week end'||$daily_rate=='holiday'){

            



            #calculate the payment per day,because dirvers rate is per day



            #convert hours to minutes

            $hours_to_min=($hours*60);



            #calculate overall minutes

            $minutes=$hours_to_min+$minutes; 



            #convert to hour

            $min_to_hour=($minutes)/60;



            #week ends and holidays must count every hour    

            $additional_charge=$drivers_charge_per_day+($min_to_hour*$rate);



        }





        if($daily_rate=='week day'){



            #driver's ot for continous day must deduct 8hours as their regular time



            #convert days  to hour

            $days_to_hours=$days/24;



            # 9 hours to subtract every day (including lunch)

            $regular_hours=$days*9;





            $hours_per_day=($days_to_hours-$regular_hours)>0?($days_to_hours-$regular_hours):0;#deduct 8am-12pm





            

            #before 8 and after 5 OT

            $ot_after=abs($returned_time-'17:00:00'>0?$returned_time-'17:00:00':0);

            $ot_before=abs('08:00:00'-$departure_time>0?'08:00:00'-$departure_time:0);

            $overtime_charge=($ot_before+$ot_after)*$rate;





            #convert hours to minutes

            $hours_to_min=($hours_per_day*60);



            #calculate overall minutes

            $minutes=$hours_to_min+$overtime_charge; 



            #convert to hour

            $min_to_hour=($minutes)/60;



            #week ends and holidays must count every hour    

            $additional_charge=$drivers_charge_per_day+($min_to_hour*$rate);



        }







        return $additional_charge;

        

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

                $sql="SELECT travel.*,automobile.manufacturer,searcaba_login_db.account_profile.profile_name FROM travel LEFT JOIN automobile on automobile.plate_no=travel.plate_no LEFT JOIN searcaba_login_db.account_profile on searcaba_login_db.account_profile.id=driver_id where travel.id=:id";

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

