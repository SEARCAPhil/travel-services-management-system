<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

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
