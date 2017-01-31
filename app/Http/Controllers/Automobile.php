<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class Automobile extends Controller
{
    function index($page=1){
		
		try{

				$this->page=htmlentities(htmlspecialchars($page));
				$this->pdoObject=DB::connection()->getPdo();
				$sql="SELECT * FROM automobile";
				$statement=$this->pdoObject->query($sql);
				#$statement->bindParam(':plate_no',$this->plate_no);
				$statement->execute();
				$res=Array();
				while($row=$statement->fetch(\PDO::FETCH_OBJ)){
					$res[]=Array('id'=>$row->plate_no,'brand'=>$row->manufacturer,'color'=>$row->color,'status'=>$row->availability,'image'=>$row->image);
				}
			
				return json_encode($res);

		}catch(Exception $e){echo $e->getMessage();}


	}


	function create_replace_parts(Request $request,$id,$mode='replace'){
		
		try{

				
				$this->pdoObject=DB::connection()->getPdo();
				$this->mode=$mode;
				$token = $request->input('_token');
		        $plate_no = $request->input('plate_no');
		        $item= $request->input('item');
		        $amount = $request->input('amount');
		        $details= $request->input('details');
		        $receipt=$request->input('receipt');
		        $station=$request->input('supplier');

				$sql="INSERT INTO automobile_repair(plate_no,item,amount,details,receipt,station,mode)values(:plate_no,:item,:amount,:details,:receipt,:station,:mode)";
				$statement=$this->pdoObject->prepare($sql);

				$statement->bindParam(':plate_no',$plate_no);
				$statement->bindParam(':item',$item);
				$statement->bindParam(':amount',$amount);
				$statement->bindParam(':details',$details);
				$statement->bindParam(':receipt',$receipt);
				$statement->bindParam(':station',$station);
				$statement->bindParam(':mode',$this->mode);


				$statement->execute();

				$lastInsertId=$this->pdoObject->lastInsertId();
				$res=Array();
			
				return $lastInsertId;

		}catch(Exception $e){echo $e->getMessage();}


	}

	function create_repair_parts(Request $request,$id){
		return self::create_replace_parts($request,$id,'repair');
	}


	function create_oil(Request $request,$id){
		
		try{

				
				$this->pdoObject=DB::connection()->getPdo();
				$token = $request->input('_token');
		        $plate_no = $request->input('plate_no');
		        $oil=$request->input('oil');
		        $amount = $request->input('amount');
		        $receipt=$request->input('receipt');
		        $station=$request->input('station');
		        $mileage=$request->input('mileage');

				$sql="INSERT INTO automobile_oil(plate_no,oil_type,amount,mileage,receipt,station)values(:plate_no,:oil,:amount,:mileage,:receipt,:station)";
				$statement=$this->pdoObject->prepare($sql);

				$statement->bindParam(':plate_no',$plate_no);
				$statement->bindParam(':oil',$oil);
				$statement->bindParam(':amount',$amount);
				$statement->bindParam(':mileage',$mileage);
				$statement->bindParam(':receipt',$receipt);
				$statement->bindParam(':station',$station);
				


				$statement->execute();

				$lastInsertId=$this->pdoObject->lastInsertId();
				$res=Array();
			
				return $lastInsertId;

		}catch(Exception $e){echo $e->getMessage();}


	}


	function create_gasoline(Request $request,$id){
		
		try{

				
				$this->pdoObject=DB::connection()->getPdo();
				$token = $request->input('_token');
		        $plate_no = $request->input('plate_no');
		        $liters=$request->input('liters');
		        $amount = $request->input('amount');
		        $receipt=$request->input('receipt');
		        $station=$request->input('station');


				$sql="INSERT INTO automobile_refuel(plate_no,liters,amount,receipt,station)values(:plate_no,:liters,:amount,:receipt,:station)";
				$statement=$this->pdoObject->prepare($sql);

				$statement->bindParam(':plate_no',$plate_no);
				$statement->bindParam(':liters',$liters);
				$statement->bindParam(':amount',$amount);
				$statement->bindParam(':receipt',$receipt);
				$statement->bindParam(':station',$station);
				


				$statement->execute();

				$lastInsertId=$this->pdoObject->lastInsertId();
				$res=Array();
			
				return $lastInsertId;

		}catch(Exception $e){echo $e->getMessage();}


	}


	function view_ledger($plate_no,$year=' ',$month=''){


 		try{

 			$this->pdoObject=DB::connection()->getPdo();
 			$this->plate_no=htmlentities(htmlspecialchars($plate_no));
 			$this->month=htmlentities(htmlspecialchars($month));
 			$this->year=htmlentities(htmlspecialchars($year))==' '?date('Y'):htmlentities(htmlspecialchars($year));
 			
 		
			#for update only
						
			$insert_sql="SELECT *  FROM automobile_repair where plate_no=:plate_no and DATE_FORMAT(date_created,'%c')=:month and DATE_FORMAT(date_created,'%Y')=:year  ORDER BY date_created";
			$sql="SELECT *  FROM automobile_oil where plate_no=:plate_no and DATE_FORMAT(date_created,'%c')=:month and DATE_FORMAT(date_created,'%Y')=:year  ORDER BY date_created";
			
			#prepare sql first
			$insert_statement=$this->pdoObject->prepare($insert_sql);
			$insert_statement->bindParam(':plate_no',$this->plate_no);
			$insert_statement->bindParam(':month',$this->month);
			$insert_statement->bindParam(':year',$this->year);
			
			#prepare sql first
			$sth=$this->pdoObject->prepare($sql);
			$sth->bindParam(':plate_no',$this->plate_no);
			$sth->bindParam(':month',$this->month);
			$sth->bindParam(':year',$this->year);

			#exec the transaction
			$insert_statement->execute();
			$sth->execute();

			$res=Array();
			$item=$item2=Array();
			$amount=$amount2=0;
			while($row=$insert_statement->fetch(\PDO::FETCH_OBJ)){
				$item[]=Array('date_created'=>$row->date_created,'item'=>$row->item,'amount'=>number_format($row->amount,2,'.',','),'details'=>$row->details,'id'=>$row->id,'type'=>'repair','plate_no'=>$row->plate_no,'station'=>$row->station);
				$amount+=$row->amount;
				
			}

			while($row2=$sth->fetch(\PDO::FETCH_OBJ)){
				$item2[]=Array('date_created'=>$row2->date_created,'item'=>'change oil : '.$row2->oil_type,'amount'=>number_format($row2->amount,2,'.',','),'details'=>$row2->mileage.' km','id'=>$row2->id,'type'=>'oil','plate_no'=>$row2->plate_no,'station'=>$row2->station);
				$amount2+=$row2->amount;
				
			}

			$itemMerged=array_merge($item,$item2);
			$totalAmount=$amount+$amount2;


			$res[]=Array('grand_total'=>number_format($totalAmount,2,'.',','),'items'=>$itemMerged);
			
	

			#return
			return json_encode($res);
			


		}catch(Exception $e){ echo $e->getMessage();}



	}

	function view_gasoline_ledger($plate_no,$year=' ',$month=''){

		

 		try{
 			$this->pdoObject=DB::connection()->getPdo();
 			$this->plate_no=htmlentities(htmlspecialchars($plate_no));
 			$this->month=htmlentities(htmlspecialchars($month));
 			$this->year=htmlentities(htmlspecialchars($year))==' '?date('Y'):htmlentities(htmlspecialchars($year));

			
			$insert_sql="SELECT * FROM automobile_refuel where plate_no=:plate_no and DATE_FORMAT(date_created,'%c')=:month and DATE_FORMAT(date_created,'%Y')=:year  ORDER BY date_created";
			
			#prepare sql first
			$insert_statement=$this->pdoObject->prepare($insert_sql);
			$insert_statement->bindParam(':plate_no',$this->plate_no);
			$insert_statement->bindParam(':month',$this->month);
			$insert_statement->bindParam(':year',$this->year);
			#exec the transaction
			$insert_statement->execute();

			$res=Array();
			$result='';
			$amount=0;
			while($row=$insert_statement->fetch(\PDO::FETCH_OBJ)){

				$res[]=Array('id'=>$row->id,'plate_no'=>$row->plate_no,'date_created'=>date('m/d/y',strtotime($row->date_created)),'liters'=>$row->liters,'amount'=>number_format($row->amount, 2, '.', ''),'receipt'=>$row->receipt,'station'=>ucfirst($row->station));
				$amount+=$row->amount;
			}
			
			
			$result=Array('grand_total'=>number_format($amount,2,'.',','),'items'=>$res);

			#return
			return json_encode($result);
			


		}catch(Exception $e){ echo $e->getMessage();}



	}




}
