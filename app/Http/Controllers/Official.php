<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Authentication;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;



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


    /**
     * List Official Travel Request by ID
     * @param int $page 
     * @return json
     */ 

    public function list_by_account($page=1)
    {


            try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                $this->id=$_SESSION['id'];
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;


                $this->pdoObject->beginTransaction();

                $sql="SELECT * FROM tr where tr.requested_by=:id ORDER BY date_created DESC LIMIT :start, 10";
                $sql2="SELECT count(*) as total FROM tr where tr.requested_by=:id";

                $statement=$this->pdoObject->prepare($sql);
                $statement2=$this->pdoObject->prepare($sql2);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
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



    function list_all($page=1){
        
        try{

                $this->pdoObject=DB::connection()->getPdo();
                $this->page=htmlentities(htmlspecialchars($page));
                $this->page=$page>1?$page:1;
                $this->id=$_SESSION['id'];
                #set starting limit(page 1=10,page 2=20)
                $start_page=$this->page<2?0:( integer)($this->page-1)*10;


                $this->pdoObject->beginTransaction();


                $sql="SELECT * FROM tr where status!=0 ORDER BY date_created DESC LIMIT :start, 10";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
                $statement->execute();


                $sql2="SELECT count(*) as total FROM tr where status!=0";
                $statement2=$this->pdoObject->prepare($sql2);
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
            //$uid=$request->session()->get('id');
            $uid=16;
            $purpose=$request->input('purpose');

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="INSERT INTO tr(requested_by,purpose) values (:requested_by,:purpose)";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':requested_by',$uid);
            $statement->bindParam(':purpose',$purpose);
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
                $res[]=$row;
            }
            $this->pdoObject->commit();

            return json_encode($res);

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
        
    }

    public function search($param,$page=1){
        $id=16;
        return self::search_user_request($param,$id,$page);
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

            $sql="SELECT * FROM tr where id LIKE :key1 or purpose LIKE :key2  ORDER BY date_created DESC LIMIT :start, 10";
            $sql2="SELECT count(*) as total FROM tr where  id LIKE :key1 or purpose LIKE :key2 ORDER BY date_created DESC";
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
                $remove_rfp_sql="DELETE FROM tr where id=:id";
                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);
                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->execute();
                $this->pdoObject->commit();

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }
}
