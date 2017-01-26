<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Official_itenerary;
use App\Http\Controllers\Personal;
use App\Http\Controllers\Campus_itenerary;


class Calendar extends Controller
{
    
	public function index($date){

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
