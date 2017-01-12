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
				$view_account_sql="SELECT * FROM login_db.account_profile LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id WHERE login_db.account_profile.profile_name!='' and login_db.account_profile.uid IS NOT NULL  LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM login_db.account_profile LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id WHERE login_db.account_profile.profile_name!='' and login_db.account_profile.uid IS NOT NULL";
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
				$view_account_sql="SELECT * FROM ischo_db.personal_tb LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM ischo_db.personal_tb";
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
				$view_account_sql="SELECT * FROM login_db.account_profile LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id WHERE (login_db.account_profile.profile_name LIKE :param1 or login_db.account_profile.first_name LIKE :param2 or login_db.account_profile.last_name LIKE :param3) and login_db.account_profile.profile_name!='' and login_db.account_profile.uid IS NOT NULL  LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM login_db.account_profile LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id WHERE (login_db.account_profile.profile_name LIKE :param1 or login_db.account_profile.first_name LIKE :param2 or login_db.account_profile.last_name LIKE :param3) and login_db.account_profile.profile_name!='' and login_db.account_profile.uid IS NOT NULL";
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

					$result[]=['uid'=>$row['uid'],'name'=>utf8_decode($row['profile_name']),'email'=>$row['profile_email'],'designation'=>$row['position'],'office'=>$row['dept_name'],'profile_image'=>$row['profile_image']];
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
				$view_account_sql="SELECT * FROM ischo_db.personal_tb where ischo_db.personal_tb.fullname LIKE :param1 or ischo_db.personal_tb.surname LIKE :param2 or ischo_db.personal_tb.firstname LIKE :param3   LIMIT :start, 20";
				$view_account_sql2="SELECT count(*) as total FROM ischo_db.personal_tb where ischo_db.personal_tb.fullname  LIKE :param1 or ischo_db.personal_tb.surname LIKE :param2 or ischo_db.personal_tb.firstname LIKE :param3  ";
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
				$view_account_sql="SELECT login_db.account_profile.id as profile_id, login_db.account_profile.uid,login_db.account_profile.last_name, login_db.account_profile.first_name,login_db.designation.id,login_db.position.position FROM login_db.account_profile LEFT JOIN login_db.designation on login_db.designation.uid=login_db.account_profile.uid LEFT JOIN login_db.position on login_db.position.id=login_db.designation.pid WHERE login_db.position.position = 'driver' and login_db.designation.active=1 LIMIT :start,20";

				$view_account_sql2="SELECT count(*) as total FROM login_db.account_profile LEFT JOIN login_db.designation on login_db.designation.uid=login_db.account_profile.uid LEFT JOIN login_db.position on login_db.position.id=login_db.designation.pid WHERE login_db.position.position = 'driver' and login_db.designation.active=1 ";

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




}
