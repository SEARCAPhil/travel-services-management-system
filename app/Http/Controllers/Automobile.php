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

}
