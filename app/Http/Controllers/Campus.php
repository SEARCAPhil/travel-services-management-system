<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class Campus extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
         try{
            $this->pdoObject=DB::connection()->getPdo();
            $this->page=htmlentities(htmlspecialchars($page));
            $this->id=16;
            $this->page=$page>1?$page:1;

            #set starting limit(page 1=10,page 2=20)
            $start_page=$this->page<2?0:( integer)($this->page-1)*10;


            $this->pdoObject->beginTransaction();

            $sql="SELECT * FROM trc where requested_by=:id ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM trc where requested_by=:id  ORDER BY date_created DESC";
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
            return json_encode($res);

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
            $uid=16;

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="INSERT INTO trc(requested_by) values (:requested_by)";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':requested_by',$uid);
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
            $remove_rfp_sql="DELETE FROM trc where id=:id";
            $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
            $remove_statement->bindParam(':id',$this->id);
            $remove_statement->execute();
            $this->pdoObject->commit();

            return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
