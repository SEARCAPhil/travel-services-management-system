<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class Directory extends Controller
{
    function staff($page=1){

    	try{	
    			$this->pdoObject=DB::connection()->getPdo();
				$this->pdoObject->beginTransaction();
				$this->page=htmlentities(htmlspecialchars($page));
				$this->page=$page>1?$page:1;

				#set starting limit(page 1=10,page 2=20)
				$start_page=$this->page<2?0:( integer)($this->page-1)*20;
				//$this->limit=$limit;
				$view_account_sql="SELECT * FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.department on searcaba_login_db.department.dept_id=searcaba_login_db.account_profile.dept_id WHERE searcaba_login_db.account_profile.profile_name!='' and searcaba_login_db.account_profile.uid IS NOT NULL  LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.department on searcaba_login_db.department.dept_id=searcaba_login_db.account_profile.dept_id WHERE searcaba_login_db.account_profile.profile_name!='' and searcaba_login_db.account_profile.uid IS NOT NULL";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement2=$this->pdoObject->query($view_account_sql2);
				$view_profile_statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
				$view_profile_statement->execute();
				$view_profile_statement2->execute();
				$result=[];

				while ($row=$view_profile_statement->fetch(\PDO::FETCH_ASSOC)) {

					$result[]=['uid'=>$row['uid'],'name'=>utf8_encode($row['profile_name']),'email'=>$row['profile_email'],'designation'=>$row['position'],'office'=>$row['dept_name'],'profile_image'=>$row['profile_image']];
					#$result[]=array('uid'=>$row['uid'],'about'=>$description);

				}
					
				$count=0;
				if($row_c=$view_profile_statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
				$no_pages=1;
				if($count>=20){
						$pages=ceil(@$count/20);
						$no_pages=$pages;
						
				}else{
						$no_pages=1;

				}
				#check if page request is < the actual page
				$current_page=$this->page<=$no_pages?$this->page:$no_pages;

				#return in json format
				$res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$result);
					
				$this->pdoObject->commit();
				return json_encode($res);
			
				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}

    }



    function scholars($page=1){

		try{
				$this->pdoObject=DB::connection()->getPdo();
				$this->pdoObject->beginTransaction();
				$this->page=htmlentities(htmlspecialchars($page));
				$this->page=$page>1?$page:1;

				#set starting limit(page 1=10,page 2=20)
				$start_page=$this->page<2?0:( integer)($this->page-1)*20;

				//$this->limit=$limit;
				$view_account_sql="SELECT * FROM searcaba_ischo_db.personal_tb LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM searcaba_ischo_db.personal_tb";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement2=$this->pdoObject->query($view_account_sql2);
				$view_profile_statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
				$view_profile_statement->execute();
				$view_profile_statement2->execute();
				$result=NULL;

				while ($row=$view_profile_statement->fetch(\PDO::FETCH_OBJ)) {

					$full_name=$row->surname.' '.$row->firstname.' '.$row->middlename;
					$full_name=strlen($full_name)<3?$row->fullname:$full_name;
					$result[]=array('uid'=>$row->pers_id,'full_name'=>$full_name,'nationality'=>$row->nationality,'profile_image'=>$row->image);

				}
				
				$count=0;
				if($row_c=$view_profile_statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
				$no_pages=1;
				if($count>=20){
						$pages=ceil(@$count/20);
						$no_pages=$pages;
						
				}else{
						$no_pages=1;

				}
				#check if page request is < the actual page
				$current_page=$this->page<=$no_pages?$this->page:$no_pages;

				#return in json format
				$res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$result);
					
				$this->pdoObject->commit();
				return json_encode($res);
			
				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){$this->pdoObject->rollback();}
    }


	function signatory($id){
		try{
				$this->pdoObject=DB::connection()->getPdo();
				
				
				//$this->limit=$limit;
				if($id==8){
					//for director
					$id=9;
						
				}else if($id==9){
					//for dda
					$id=8;
				}else{

					
				}
				$this->id=htmlentities(htmlspecialchars($id));

				//view users profile from login_db
				$sql="SELECT searcaba_login_db.account_profile.uid,searcaba_login_db.department.dept_id as dept_id FROM searcaba_login_db.account_profile  LEFT JOIN searcaba_login_db.department on searcaba_login_db.department.dept_id=searcaba_login_db.account_profile.dept_id where uid=:uid LIMIT 1";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':uid',$this->id);
				$statement->execute();

				$res=$statement->fetch(\PDO::FETCH_OBJ);

				if(isset($res->dept_id)){

					

					if($res->dept_id==8){
						//for director
						$res->dept_id=9;
							
					}else if($res->dept_id==9){
						//for dda
						$res->dept_id=8;
					}else{

						
					}


					$view_account_sql="SELECT searcaba_login_db.account_profile.profile_name,searcaba_login_db.department.dept_name,searcaba_login_db.signatory.priority,searcaba_login_db.signatory.uid FROM searcaba_login_db.signatory LEFT JOIN searcaba_login_db.account_profile on searcaba_login_db.account_profile.uid=searcaba_login_db.signatory.uid LEFT JOIN searcaba_login_db.department on searcaba_login_db.signatory.dept_id=department.dept_id where searcaba_login_db.signatory.dept_id=:id ORDER BY searcaba_login_db.signatory.id DESC LIMIT 1";
					$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
					$view_profile_statement->bindParam(':id',$res->dept_id);
					$view_profile_statement->execute();
					$result=NULL;

					$data=NULL;
					while ($row=$view_profile_statement->fetch(\PDO::FETCH_ASSOC)) {

						#check if user id is the same with its signatory
						#if so, the user might be the UNIT HEAD
						#in this case,make the result NULL so it will get the default signatory
						
						$result[]=array('profile_name'=>$row['profile_name'],'uid'=>$row['uid']);
						$data=json_encode($result);

						if($res->uid==$row['uid']) $result=NULL;
						
					}

					if(is_null($result)){
						//director by default
						$dept=0;
						$view_profile_statement->bindParam(':id',$dept);
						$view_profile_statement->execute();

						$row=$view_profile_statement->fetch(\PDO::FETCH_OBJ);

						$result[]=array('profile_name'=>$row->profile_name,'uid'=>$row->uid);
						$data=json_encode($result);

						
					}
					
					
					return $data;
				}


				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){ echo $e->getMessage(); }


	}





	function signatory_department($id){
		try{
				$this->pdoObject=DB::connection()->getPdo();
				
				$this->id=htmlentities(htmlspecialchars($id));

			
				$view_account_sql="SELECT account_profile.profile_name,account_profile.id as profile_id,department.dept_name,signatory.priority,signatory.account_profile_id ,account_profile.uid FROM signatory LEFT JOIN  account_profile on  account_profile.id=signatory.account_profile_id LEFT JOIN department on signatory.dept_id=department.dept_id where signatory.dept_id=:id ORDER BY signatory.id DESC LIMIT 1";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement->bindParam(':id',$id);
				$view_profile_statement->execute();
				$result=NULL;

				$data=NULL;
				while ($row=$view_profile_statement->fetch(\PDO::FETCH_ASSOC)) {

					#check if user id is the same with its signatory
					#if so, the user might be the UNIT HEAD
					#in this case,make the result NULL so it will get the default signatory
					
					$result[]=$row;
					$data=json_encode($result);
					
				}


				if(is_null($result)){
					//director by default
					$dept=0;
					$view_profile_statement->bindParam(':id',$dept);
					$view_profile_statement->execute();

					$row=$view_profile_statement->fetch(\PDO::FETCH_OBJ);

					$result[]=array('profile_name'=>$row->profile_name,'uid'=>$row->uid);
					$data=json_encode($result);
				}
					
					
				return $data;

				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){ echo $e->getMessage(); }
	}

	function signatory_list(){
		try{
				$this->pdoObject=DB::connection()->getPdo();
				
				

			
				$view_account_sql="SELECT account_profile.profile_name,account_profile.id as profile_id,department.dept_name,signatory.priority,signatory.account_profile_id ,account_profile.uid FROM signatory LEFT JOIN  account_profile on  account_profile.id=signatory.account_profile_id LEFT JOIN department on signatory.dept_id=department.dept_id where account_profile.profile_name IS NOT NULL  GROUP BY account_profile.uid ORDER BY signatory.id ";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement->execute();
				$result=NULL;

				$data=NULL;
				while ($row=$view_profile_statement->fetch(\PDO::FETCH_ASSOC)) {

					#check if user id is the same with its signatory
					#if so, the user might be the UNIT HEAD
					#in this case,make the result NULL so it will get the default signatory
					
					$result[]=$row;
					$data=json_encode($result);
					
				}
					
				return $data;

				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){ echo $e->getMessage(); }
	}

    function staff_search($param,$page=1){

    		try{
    			$this->pdoObject=DB::connection()->getPdo();
				$this->pdoObject->beginTransaction();
				$this->page=htmlentities(htmlspecialchars($page));
				$this->page=$page>1?$page:1;
				$param=htmlentities(htmlspecialchars($param));
				$param='%'.$param.'%';
				#set starting limit(page 1=10,page 2=20)
				$start_page=$this->page<2?0:( integer)($this->page-1)*20;
				//$this->limit=$limit;
				$view_account_sql="SELECT * FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.department on searcaba_login_db.department.dept_id=searcaba_login_db.account_profile.dept_id WHERE (searcaba_login_db.account_profile.profile_name LIKE :param1 or searcaba_login_db.account_profile.first_name LIKE :param2 or searcaba_login_db.account_profile.last_name LIKE :param3) and searcaba_login_db.account_profile.profile_name!='' and searcaba_login_db.account_profile.uid IS NOT NULL  LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.department on searcaba_login_db.department.dept_id=searcaba_login_db.account_profile.dept_id WHERE (searcaba_login_db.account_profile.profile_name LIKE :param1 or searcaba_login_db.account_profile.first_name LIKE :param2 or searcaba_login_db.account_profile.last_name LIKE :param3) and searcaba_login_db.account_profile.profile_name!='' and searcaba_login_db.account_profile.uid IS NOT NULL";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement2=$this->pdoObject->prepare($view_account_sql2);
				$view_profile_statement->bindParam(':param1',$param);
				$view_profile_statement->bindParam(':param2',$param);
				$view_profile_statement->bindParam(':param3',$param);
				$view_profile_statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
				$view_profile_statement2->bindParam(':param1',$param);
				$view_profile_statement2->bindParam(':param2',$param);
				$view_profile_statement2->bindParam(':param3',$param);
				$view_profile_statement->execute();
				$view_profile_statement2->execute();
				$result=[];

				while ($row=$view_profile_statement->fetch(\PDO::FETCH_ASSOC)) {

					$result[]=['uid'=>$row['uid'],'name'=>html_entity_decode($row['profile_name']),'email'=>$row['profile_email'],'designation'=>$row['position'],'office'=>$row['dept_name'],'profile_image'=>$row['profile_image']];
					#$result[]=array('uid'=>$row['uid'],'about'=>$description);

				}
					
				$count=0;
				if($row_c=$view_profile_statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
				$no_pages=1;
				if($count>=20){
						$pages=ceil(@$count/20);
						$no_pages=$pages;
						
				}else{
						$no_pages=1;

				}
				#check if page request is < the actual page
				$current_page=$this->page<=$no_pages?$this->page:$no_pages;

				#return in json format
				$res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$result);
					
				$this->pdoObject->commit();
				return json_encode($res);
			
				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();}

    }

    function scholar_search($param,$page=1){

    		try{
    			$this->pdoObject=DB::connection()->getPdo();
				$this->pdoObject->beginTransaction();
				$this->page=htmlentities(htmlspecialchars($page));
				$this->page=$page>1?$page:1;
				$param=htmlentities(htmlspecialchars($param));
				$param='%'.$param.'%';

				#set starting limit(page 1=10,page 2=20)
				$start_page=$this->page<2?0:( integer)($this->page-1)*20;

				//$this->limit=$limit;
				$view_account_sql="SELECT * FROM searcaba_ischo_db.personal_tb where searcaba_ischo_db.personal_tb.fullname LIKE :param1 or searcaba_ischo_db.personal_tb.surname LIKE :param2 or searcaba_ischo_db.personal_tb.firstname LIKE :param3   LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM searcaba_ischo_db.personal_tb where searcaba_ischo_db.personal_tb.fullname  LIKE :param1 or searcaba_ischo_db.personal_tb.surname LIKE :param2 or searcaba_ischo_db.personal_tb.firstname LIKE :param3  ";
				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement2=$this->pdoObject->prepare($view_account_sql2);
				$view_profile_statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
				$view_profile_statement->bindParam(':param1',$param);
				$view_profile_statement->bindParam(':param2',$param);
				$view_profile_statement->bindParam(':param3',$param);

				$view_profile_statement2->bindParam(':param1',$param);
				$view_profile_statement2->bindParam(':param2',$param);
				$view_profile_statement2->bindParam(':param3',$param);

				$view_profile_statement->execute();
				$view_profile_statement2->execute();
				$result=NULL;

				while ($row=$view_profile_statement->fetch(\PDO::FETCH_OBJ)) {

					$full_name=$row->surname.' '.$row->firstname.' '.$row->middlename;
					$full_name=strlen($full_name)<3?$row->fullname:$full_name;
					$result[]=array('uid'=>$row->pers_id,'full_name'=>$full_name,'nationality'=>$row->nationality,'profile_image'=>$row->image);

				}
				
				$count=0;
				if($row_c=$view_profile_statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
				$no_pages=1;
				if($count>=20){
						$pages=ceil(@$count/20);
						$no_pages=$pages;
						
				}else{
						$no_pages=1;

				}
				#check if page request is < the actual page
				$current_page=$this->page<=$no_pages?$this->page:$no_pages;

				#return in json format
				$res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$result);
					
				$this->pdoObject->commit();
				return json_encode($res);
			
				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){$this->pdoObject->rollback();}

    }


    function drivers($page=1){

    	try{
    			$this->pdoObject=DB::connection()->getPdo();
				$this->pdoObject->beginTransaction();
				$this->page=htmlentities(htmlspecialchars($page));
				$this->page=$page>1?$page:1;

				#set starting limit(page 1=10,page 2=20)
				$start_page=$this->page<2?0:( integer)($this->page-1)*20;

				//$this->limit=$limit;
				$view_account_sql="SELECT searcaba_login_db.account_profile.id as profile_id, searcaba_login_db.account_profile.uid,searcaba_login_db.account_profile.last_name, searcaba_login_db.account_profile.first_name,searcaba_login_db.designation.id,searcaba_login_db.position.position FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.designation on searcaba_login_db.designation.uid=searcaba_login_db.account_profile.uid LEFT JOIN searcaba_login_db.position on searcaba_login_db.position.id=searcaba_login_db.designation.pid WHERE searcaba_login_db.position.position = 'driver' and searcaba_login_db.designation.active=1 LIMIT :start,20";

				$view_account_sql2="SELECT count(*) as total FROM searcaba_login_db.account_profile LEFT JOIN searcaba_login_db.designation on searcaba_login_db.designation.uid=searcaba_login_db.account_profile.uid LEFT JOIN searcaba_login_db.position on searcaba_login_db.position.id=searcaba_login_db.designation.pid WHERE searcaba_login_db.position.position = 'driver' and searcaba_login_db.designation.active=1 ";

				$view_profile_statement=$this->pdoObject->prepare($view_account_sql);
				$view_profile_statement2=$this->pdoObject->query($view_account_sql2);
				$view_profile_statement->bindParam(':start',$start_page,\PDO::PARAM_INT);
				$view_profile_statement->execute();
				$view_profile_statement2->execute();
				$result=NULL;

				while ($row=$view_profile_statement->fetch(\PDO::FETCH_OBJ)) {

				
					$result[]=$row;

				}
				
				$count=0;
				if($row_c=$view_profile_statement2->fetch(\PDO::FETCH_OBJ)){ $count=$row_c->total; }
				$no_pages=1;
				if($count>=20){
						$pages=ceil(@$count/20);
						$no_pages=$pages;
						
				}else{
						$no_pages=1;

				}
				#check if page request is < the actual page
				$current_page=$this->page<=$no_pages?$this->page:$no_pages;

				#return in json format
				$res=Array('current_page'=>$current_page,'total_pages'=>$no_pages,'data'=>$result);
					
				$this->pdoObject->commit();
				return json_encode($res);
			
				#return $view_profile_statement->rowCount()>0?$view_profile_statement->rowCount():0;
		}catch(Exception $e){$this->pdoObject->rollback();}
    }


    function vehicles($page=1){

    	try{
	    	$this->pdoObject=DB::connection()->getPdo();
			$this->pdoObject->beginTransaction();
			$this->page=htmlentities(htmlspecialchars($page));
			$this->page=$page>1?$page:1;

			#set starting limit(page 1=10,page 2=20)
			$start_page=$this->page<2?0:( integer)($this->page-1)*20;



			$sql="SELECT * FROM automobile";
			$statement=$this->pdoObject->query($sql);
			#$statement->bindParam(':plate_no',$this->plate_no);
			$statement->execute();
			$res=Array();
			while($row=$statement->fetch(\PDO::FETCH_OBJ)){
				$res[]=Array('id'=>$row->plate_no,'brand'=>$row->manufacturer,'color'=>$row->color,'status'=>$row->availability,'image'=>$row->image);
			}
			$this->pdoObject->commit();

			return json_encode($res);
		}catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
    }


    public function gasoline_charge()
    {

        try{
                $this->pdoObject=DB::connection()->getPdo();
                $sql="SELECT * FROM tr_gc";
                $statement=$this->pdoObject->prepare($sql);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=$row;
                }
               

                echo json_encode($res);

        }catch(Exception $e){echo $e->getMessage();}


        
    }


 	public function drivers_charge()
    {

        try{
                $this->pdoObject=DB::connection()->getPdo();
                $sql="SELECT * FROM dc";
                $statement=$this->pdoObject->prepare($sql);
                $statement->execute();
                $res=Array();
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $res[]=$row;
                }
               

                echo json_encode($res);

        }catch(Exception $e){echo $e->getMessage();}


        
    }


    public function update_signatory($id,$uid)

    {

        try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->id=(int) htmlentities(htmlspecialchars($id));
                $this->uid=(int) htmlentities(htmlspecialchars($uid));

                $this->pdoObject->beginTransaction();

                $remove_rfp_sql="UPDATE tr set approved_by=:approved_by where id=:id";

                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

                $remove_statement->bindParam(':id',$this->id);
                $remove_statement->bindParam(':approved_by',$this->uid);

                $remove_statement->execute();

                $this->pdoObject->commit();



                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }



    public function update_approval_recommending($id,$uid)

    {

        try{

                $this->pdoObject=DB::connection()->getPdo();

                $this->id=(int) htmlentities(htmlspecialchars($id));
                $this->uid=(int) htmlentities(htmlspecialchars($uid));

             


                if(!is_null($uid)){

                    $remove_rfp_sql="UPDATE tr set recommended_by=:recommended_by where id=:id";

	                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

	                $remove_statement->bindParam(':id',$this->id);
	                $remove_statement->bindParam(':recommended_by',$this->uid);	
                }else{
                	$remove_rfp_sql="UPDATE tr set recommended_by= NULL where id=:id";

	                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);

	                $remove_statement->bindParam(':id',$this->id);
                }



                $remove_statement->execute();

            

                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;



        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }


    public function update_signatory_to_odda($id){
        //static users id
        //currently set to ATR
        self::update_signatory($id,3);
    }


    public function update_signatory_to_od($id){
        //static users id
        //currently set to GCS
        self::update_signatory($id,2);
    }


    public function update_approval_recommending_to_null($id){
        //static users id
        //currently set to GCS
        self::update_approval_recommending($id,NULL);
    }





}
