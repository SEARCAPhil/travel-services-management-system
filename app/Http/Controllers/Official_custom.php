<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;


class Official_custom extends Controller
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
       
                $sql="SELECT * FROM cust_passengers where tr_id=:id";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch()){
                    $res[]=$row;
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
        $full_name = $request->input('full_name');
        $designation = $request->input('designation');
        $token = $request->input('_token');
       

        if(!empty($id)&&!empty($full_name)&&!empty($token)){
            
           try{

                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="INSERT INTO cust_passengers(tr_id,full_name,designation)values(:tr_id,:full_name,:designation)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':tr_id',$id);
                $insert_statement->bindParam(':full_name',$full_name);
                $insert_statement->bindParam(':designation',$designation);
  
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
            $remove_rfp_sql="DELETE FROM cust_passengers where id=:id";
            $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
            $remove_statement->bindParam(':id',$this->id);
            $remove_statement->execute();
            $this->pdoObject->commit();

            return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){/*echo $e->getMessage();*/$this->pdoObject->rollback();}
    }
}
