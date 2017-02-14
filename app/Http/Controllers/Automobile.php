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
				$sql="SELECT * FROM automobile order by manufacturer ASC";
				$statement=$this->pdoObject->query($sql);
				#$statement->bindParam(':plate_no',$this->plate_no);
				$statement->execute();
				$res=Array();
				while($row=$statement->fetch(\PDO::FETCH_OBJ)){
					$res[]=Array('id'=>$row->plate_no,'brand'=>$row->manufacturer,'color'=>$row->color,'status'=>$row->availability,'image'=>$row->image);
				}
			
				return json_encode($res);

		}catch(Exception $e){}


	}


	 function is_exists_automobile($plate_no){
		
		try{

				$this->plate_no=htmlentities(htmlspecialchars($plate_no));
				$this->pdoObject=DB::connection()->getPdo();
				$sql="SELECT count(*) as total FROM automobile where plate_no=:plate_no LIMIT 1";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':plate_no',$this->plate_no);
				$statement->execute();
				$total=0;
				while($row=$statement->fetch(\PDO::FETCH_OBJ)){
					$total=$row->total;
				}
			
				return $total;

		}catch(Exception $e){}


	}

	function create_automobile(Request $request){
		
		try{

				
				
				$token = $request->input('_token');
		        $plate_no = $request->input('plate_number');
		        $color=$request->input('color');
		        $brand=$request->input('brand');

		        $already_exist=self::is_exists_automobile($plate_no);

				$this->pdoObject=DB::connection()->getPdo();

				if($already_exist){
					return 0;
				}

				$sql="INSERT INTO automobile(plate_no,manufacturer,color)values(:plate_no,:manufacturer,:color)";
				$statement=$this->pdoObject->prepare($sql);

				$statement->bindParam(':plate_no',$plate_no);
				$statement->bindParam(':manufacturer',$brand);
				$statement->bindParam(':color',$color);
				


				$statement->execute();

				$lastInsertId=$this->pdoObject->lastInsertId();
	
			
				return $lastInsertId;

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


	function update_automobile($plate_no,Request $request){
		
		try{

				
				
				$token = $request->input('_token');
		        $plate_no = $request->input('plate_no');
		        $color=$request->input('color');
		        $brand=$request->input('brand');

		  

				$this->pdoObject=DB::connection()->getPdo();

				
				$sql="UPDATE automobile set manufacturer=:manufacturer,color=:color where plate_no=:plate_no";
				$statement=$this->pdoObject->prepare($sql);

				$statement->bindParam(':plate_no',$plate_no);
				$statement->bindParam(':manufacturer',$brand);
				$statement->bindParam(':color',$color);
				


				$statement->execute();

				$lastInsertId=$statement->rowCount();
	
			
				return $lastInsertId;

		}catch(Exception $e){echo $e->getMessage();}


	}

	function update_automobile_image($plate_no,$file_name){
		
		try{

			$file_name=htmlentities(htmlspecialchars($file_name));
			$plate_no=htmlentities(htmlspecialchars($plate_no));

			$this->pdoObject=DB::connection()->getPdo();

			
			$sql="UPDATE automobile set image=:image where plate_no=:plate_no";
			$statement=$this->pdoObject->prepare($sql);

			$statement->bindParam(':plate_no',$plate_no);
			$statement->bindParam(':image',$file_name);
			

			$statement->execute();

			$lastInsertId=$statement->rowCount();

		
			return $lastInsertId;

		}catch(Exception $e){echo $e->getMessage();}


	}

	function upload_automobile_image($id=''){

		if(!isset($_FILES["attachment"])||empty($id)){
			$error = array('error' => 'invalid file');
             echo json_encode($error);
             exit;
		}

		$result=array();

		$inf=pathinfo($_FILES["attachment"]['name']);
		$allowed_types        = Array('gif','jpg','png','jpeg','pdf','bmp');

		#5MiB
     	$max_size             = 5242880;

     	$extension=$inf['extension'];
     	$size=$_FILES["attachment"]['size'];
     	$id=htmlentities(htmlspecialchars($id));

     	if(!in_array($extension, $allowed_types)){
     		$result['error']='invalid file';
     		
     	}

     	if($size>$max_size){
     		$result['error']='File must not be greater than 5MB';
     		
     	}

     	#if no error
     	if(!isset($result['error'])){

     		$filename=$id.'.'.$extension;
     		if(move_uploaded_file($_FILES["attachment"]["tmp_name"], 'uploads/automobile/'.$filename)){

     			$update_filename=self::update_automobile_image($id,$filename);

     		
     			$result['result']=1;
     			
     			
     			return json_encode($result);
     		}
     	}


		
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


	function view_overall_gasoline_ledger($year){
		try{
				$this->pdoObject=DB::connection()->getPdo();
				$this->year=htmlentities(htmlspecialchars($year));
				$datey=($this->year+1);
				$this->pdoObject->beginTransaction();
				$sql="SELECT amount as amount,DATE_FORMAT(date_created,'%m') as month,liters FROM automobile_refuel WHERE  (DATE_FORMAT(date_created,'%Y')<:datey and DATE_FORMAT(date_created,'%Y')>=:datez)";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':datez',$this->year);
				$statement->bindParam(':datey',$datey);
				$statement->execute();
				$res=Array();
				$jan1=$feb1=$mar1=$apr1=$may1=$jun1=$jul1=$aug1=$sep1=$oct1=$nov1=$dec1=Array();
				$jan2=$feb2=$mar2=$apr2=$may2=$jun2=$jul2=$aug2=$sep2=$oct2=$nov2=$dec2=Array();
				
				$amount=0;

				
					
				while($row=$statement->fetch(\PDO::FETCH_OBJ)){
					#$amount+=$row->amount;
					
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
				$total=Array('amount'=>$totalAmount,'liters'=>$totalLiters,'year'=>date($this->year));
				
				$data[]=Array('jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aug'=>$aug,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec);
				$res[]=Array('total'=>$total,'data'=>$data);
				$this->pdoObject->commit();

				
				return json_encode($res);

		}catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}


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


	 function destroy_parts($id){
		
		try{

				$this->id=htmlentities(htmlspecialchars($id));
				$this->pdoObject=DB::connection()->getPdo();
				$sql="DELETE FROM automobile_repair where id=:id";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':id',$this->id);
				$statement->execute();
				$is_removed=$statement->rowCount();
			
				return $is_removed;

		}catch(Exception $e){echo $e->getMessage();}


	}




	 function destroy_oil($id){
		
		try{

				$this->id=htmlentities(htmlspecialchars($id));
				$this->pdoObject=DB::connection()->getPdo();
				$sql="DELETE FROM automobile_oil where id=:id";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':id',$this->id);
				$statement->execute();
				$is_removed=$statement->rowCount();
			
				return $is_removed;

		}catch(Exception $e){echo $e->getMessage();}


	}

	 function destroy_gasoline($id){
		
		try{

				$this->id=htmlentities(htmlspecialchars($id));
				$this->pdoObject=DB::connection()->getPdo();
				$sql="DELETE FROM automobile_refuel where id=:id";
				$statement=$this->pdoObject->prepare($sql);
				$statement->bindParam(':id',$this->id);
				$statement->execute();
				$is_removed=$statement->rowCount();
			
				return $is_removed;

		}catch(Exception $e){echo $e->getMessage();}


	} 


	function print_ledger($id,$year,$month){

		global $idx;
   		$idx=$id;

   		$ledger=@json_decode(self::view_ledger($id,$year,$month));

    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPdf('L', $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		
   		

   		// Custom Header
		$pdf->setHeaderCallback(function($pdf) {
			global $idx;
			
			// Title
			// set cell margins
			$pdf->setFontSize(8);
			$pdf->Ln(10);
			$pdf->setFontSize(9);
			//$this->image("../model/img/Logo Searca.png",20,'',15);
			//$this->Cell(0, 0, '<img src="../model/img/Logo Searca.png"/>', 0, 2, 'L', 0, '', 0, false, 'T', 'B');
			//$this->Cell(0, 0, 'Southeast Asian Ministers of Education Organization', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE STUDY', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, ' AND RESEARCH IN AGRICULTURE', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'College, Laguna, 4031, Philippines', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(15);
			$pdf->Cell(0, 15, 'SEARCA Vehicle Travel Maintenance Ledger', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(12);
			$pdf->Cell(0, 0, $idx, 0, 2, 'C', 0, '', 0, false, 'T', 'B');



		if ($pdf->getPage() <= $pdf->getAliasNumPage()) {
			$pdf->SetY(-30);
			$pdf->Writehtml($foot);
		}



		});

		// Custom Footer
		$pdf->setFooterCallback(function($pdf) {

			$pdf->SetY(-50);
			// Set font
	        $pdf->SetFont('helvetica', 'N', 9);





	        // Position at 15 mm from bottom
	        $pdf->SetY(-15);
	       	$pdf->SetFont('helvetica', 'I', 8);
	        // Page number
	        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

	       


  	  	});


		//settings
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);

	




		
	
$html='
	<div align="center">

<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:0in 0in 0in 0in"> 
 <tbody>
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
  <td width="60" rowspan="2" valign="top" style="width:36.3pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Date<o:p></o:p></span></b></p>
  </td>
  <td width="120" rowspan="2" valign="top" style="width:120.3pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Particulars (Work Done)<o:p></o:p></span></b></p>
  </td>
  <td width="60" rowspan="2" valign="top" style="width:92.95pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Job Request No.<o:p></o:p></span></b></p>
  </td>
  <td width="50" rowspan="2" valign="top" style="width:79.05pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">PR No./TT No.<o:p></o:p></span></b></p>
  </td>
  <td width="40" rowspan="2" valign="top" style="width:.65in;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">OV No.<o:p></o:p></span></b></p>
  </td>
  <td width="155" colspan="3" valign="top" style="width:2.2in;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">O B L I G A T E D<o:p></o:p></span></b></p>
  </td>
  <td width="150" colspan="3" valign="top" style="width:2.2in;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">EXPENDED<o:p></o:p></span></b></p>
  </td>
  <td width="70" rowspan="2" valign="top" style="width:100.05pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Variance in Amount<o:p></o:p></span></b></p>
  </td>
  <td width="72" rowspan="2" valign="top" style="width:54.3pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Remarks<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1">
  <td width="50" valign="top" style="width:52.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Quantity<o:p></o:p></span></b></p>
  </td>
  <td width="50" valign="top" style="width:57.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Unit Price<o:p></o:p></span></b></p>
  </td>
  <td width="55" valign="top" style="width:49.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Amount<o:p></o:p></span></b></p>
  </td>
  <td width="50" valign="top" style="width:52.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Quantity<o:p></o:p></span></b></p>
  </td>
  <td width="50" valign="top" style="width:57.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Unit Price<o:p></o:p></span></b></p>
  </td>
  <td width="50" valign="top" style="width:49.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><b><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Amount<o:p></o:p></span></b></p>
  </td>
 </tr>';


foreach ($ledger[0]->items as $key => $value) {
				
						

$html.='<tr style="mso-yfti-irow:2"  nobr="true">
  <td width="60" valign="top" style="width:36.3pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">'.explode(' ',$value->date_created)[0].'</span></p>
  </td>
  <td width="120" valign="top" style="width:120.3pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">'.$value->item.'</span></p>
  </td>
  <td width="60" valign="top" style="width:92.95pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:79.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="40" valign="top" style="width:.65in;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:52.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:57.3pt;border-top:none;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="55" valign="top" style="width:49.05pt;border-top:none;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:52.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:57.3pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="50" valign="top" style="width:49.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">'.$value->amount.'</span></p>
  </td>
  <td width="70" valign="top" style="width:100.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="72" valign="top" style="width:54.3pt;border-top:none;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt">
  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
';

}


$html.='</tbody></table></div>';
$html.='<p text-align="left"><span style="font-size:10.0pt;font-family:&quot;Helvetica Neue&quot;">Grand Total : <b>Php '.@$ledger[0]->grand_total.'</b></span></p>

</article>';




		
		$pdf->setFontSize(8);	

		//output
        $pdf->AddPage('L');
        $pdf->SetMargins(10,50,5,true);
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    }




}
