<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class Official_scholars extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ischo_db = 'trsdev_ischo_db';

    public function index($id)
    {

        try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->id=htmlentities(htmlspecialchars($id));
             
                $sql="SELECT passengers.id,passengers.uid,{$this->ischo_db}.personal_tb.*  FROM passengers LEFT JOIN {$this->ischo_db}.personal_tb on {$this->ischo_db}.personal_tb.pers_id=passengers.uid  where tr_id=:id and type='scholar'";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->id);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $full_name=$row->surname.' '.$row->firstname.' '.$row->middlename;
                    $full_name=strlen($full_name)<3?$row->fullname:$full_name;
                    $res[]=Array('full_name'=>$full_name,'uid'=>$row->pers_id,'id'=>$row->id,'nationality'=>$row->nationality,'profile_image'=>$row->image,'office'=>'scholar');
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
        $uid = $request->input('uid');
        $token = $request->input('_token');
        $type='scholar';

        if(!empty($id)&&!empty($uid)&&!empty($token)){
            
           try{

                $this->pdoObject=DB::connection()->getPdo();
                #begin transaction
                $this->pdoObject->beginTransaction();
                
                $insert_sql="INSERT INTO passengers(tr_id,uid,type)values(:tr_id,:uid,:type)";
                $insert_statement=$this->pdoObject->prepare($insert_sql);
        
                #params
                $insert_statement->bindParam(':tr_id',$id);
                $insert_statement->bindParam(':uid',$uid);
                $insert_statement->bindParam(':type',$type);
  
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
                $remove_rfp_sql="DELETE FROM passengers where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){/*echo $e->getMessage();*/$this->pdoObject->rollback();}
    }
}
