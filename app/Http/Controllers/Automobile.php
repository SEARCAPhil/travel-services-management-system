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


	function view_expenses($id,$year=''){
		
		try{

				$this->year=htmlentities(htmlspecialchars($year));
				$this->plate_no=htmlentities(htmlspecialchars($id));
				$datey=($year+1);
				$this->pdoObject=DB::connection()->getPdo();
				$sql="SELECT amount as amount,DATE_FORMAT(date_created,'%m') as month,liters,plate_no,date_created,DATE_FORMAT(date_created,'%Y') as aa FROM automobile_refuel where (DATE_FORMAT(date_created,'%Y')<:datey and DATE_FORMAT(date_created,'%Y')>=:datez) and plate_no=:plate_no";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':datez',$this->year);
				$statement->bindParam(':datey',$datey);
				$statement->bindParam(':plate_no',$this->plate_no);
				$statement->execute();
				$res=Array();
				$jan1=$feb1=$mar1=$apr1=$may1=$jun1=$jul1=$aug1=$sep1=$oct1=$nov1=$dec1=Array();
				$jan2=$feb2=$mar2=$apr2=$may2=$jun2=$jul2=$aug2=$sep2=$oct2=$nov2=$dec2=Array();
				
				$amount=0;

				
					
				while($row=$statement->fetch(\PDO::FETCH_OBJ)){
					#$amount+=$row->amount;
					#var_dump($row);
					switch ($row->month) {
						case 1:
							array_push($jan1,$row->amount);
							array_push($jan2,$row->liters);

							break;
						case 2:
							array_push($feb1,$row->amount);
							array_push($feb2,$row->liters);

							break;
						case 3:
							array_push($mar1,$row->amount);
							array_push($mar2,$row->liters);

							break;
						case 4:
							array_push($apr1,$row->amount);
							array_push($apr2,$row->liters);

							break;
						case 5:
							array_push($may1,$row->amount);
							array_push($may2,$row->liters);

							break;
						case 6:
							array_push($jun1,$row->amount);
							array_push($jun2,$row->liters);

							break;
						case 7:
							array_push($jul1,$row->amount);
							array_push($jul2,$row->liters);

							break;
						case 8:
							array_push($aug1,$row->amount);
							array_push($aug2,$row->liters);
							

							break;
						case 9:
							array_push($sep1,$row->amount);
							array_push($sep2,$row->liters);

							break;
						case 10:
							array_push($oct1,$row->amount);
							array_push($oct2,$row->liters);

							break;
						case 11:
							array_push($nov1,$row->amount);
							array_push($nov2,$row->liters);

							break;
						case 12:
							array_push($dec1,$row->amount);
							array_push($dec,$row->liters);

							break;

						
						default:
							# code...
							break;
					}
					
				
				}


				#var_dump(array_sum($jul1));
				$totalAmount=array_sum($jan1)+array_sum($feb1)+array_sum($mar1)+array_sum($apr1)+array_sum($may1)+array_sum($jun1)+array_sum($jul1)+array_sum($aug1)+array_sum($sep1)+array_sum($oct1)+array_sum($nov1)+array_sum($dec1);
				$totalLiters=array_sum($jan2)+array_sum($feb2)+array_sum($mar2)+array_sum($apr2)+array_sum($may2)+array_sum($jun2)+array_sum($jul2)+array_sum($aug2)+array_sum($sep2)+array_sum($oct2)+array_sum($nov2)+array_sum($dec2);
				
				$jan=Array('amount'=>array_sum($jan1),'liters'=>array_sum($jan2));
				$feb=Array('amount'=>array_sum($feb1),'liters'=>array_sum($feb2));
				$mar=Array('amount'=>array_sum($mar1),'liters'=>array_sum($mar2));
				$apr=Array('amount'=>array_sum($apr1),'liters'=>array_sum($apr2));
				$may=Array('amount'=>array_sum($may1),'liters'=>array_sum($may2));
				$jun=Array('amount'=>array_sum($jun1),'liters'=>array_sum($jun2));
				$jul=Array('amount'=>array_sum($jul1),'liters'=>array_sum($jul2));
				$aug=Array('amount'=>array_sum($aug1),'liters'=>array_sum($aug2));
				$sep=Array('amount'=>array_sum($sep1),'liters'=>array_sum($sep2));
				$oct=Array('amount'=>array_sum($oct1),'liters'=>array_sum($oct2));
				$nov=Array('amount'=>array_sum($nov1),'liters'=>array_sum($nov2));
				$dec=Array('amount'=>array_sum($dec1),'liters'=>array_sum($dec2));
				$total=Array('amount'=>$totalAmount,'liters'=>$totalLiters,'year'=>$year);
				
				$data[]=Array('jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aug'=>$aug,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec);
				$res[]=Array('total'=>$total,'data'=>$data);
				

				
				return json_encode($res);

		}catch(Exception $e){echo $e->getMessage();}


	}




}
