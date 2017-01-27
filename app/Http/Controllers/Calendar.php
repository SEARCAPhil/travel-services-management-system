<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Official_itenerary;
use App\Http\Controllers\Personal;
use App\Http\Controllers\Campus_itenerary;

@session_start();

class Calendar extends Controller
{
    
	public function index($date){
		$id=$_SESSION['id'];

		if($_SESSION['priv']=='admin'){
			return self::list_all($date);
		}else{

			return self::list_by_account($date,$id);
		}
		
	}

	public function list_by_account($date,$id){

		$official_itenerary_class=new Official_itenerary();
		$campus_itenerary_class=new Campus_itenerary();
		$personal_class=new Personal();

		$official=@json_decode($official_itenerary_class->scheduled_per_user($date,$id));
		$personal=@json_decode($personal_class->scheduled_per_user($date,$id));
		$campus=@json_decode($campus_itenerary_class->scheduled_per_user($date,$id));

		$merged_data=@array_merge($official,$personal,$campus);
		return json_encode($merged_data);

		
	}



	public function list_all($date){

		

		$official_itenerary_class=new Official_itenerary();
		$personal_class=new Personal();
		$campus_itenerary_class=new Campus_itenerary();
		$official=@json_decode($official_itenerary_class->scheduled($date));
		$personal=@json_decode($personal_class->scheduled($date));
		$campus=@json_decode($campus_itenerary_class->scheduled($date));

		#return $official_itenerary_class->scheduled($date);
		#return $personal_class->scheduled($date);

		$merged_data=array_merge($official,$personal,$campus);
		return json_encode($merged_data);


		
	}
}
