<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','Home@index')->middleware('auth_custom');
Route::get('/travel',function(){
	return View::make('travel/list');
});

/**MODAL**/
Route::get('/travel/modal/{page}',function($page){
	return View::make('travel/modal/'.$page);
});

Route::get('/automobile/modal/{page}',function($page){
	return View::make('automobile/modal/'.$page);
});



/**official**/

#editor
Route::get('travel/official/editor/{id}',function($id){
	return View::make('travel/official/editor',array('id'=>$id));
});

#preview
Route::get('/travel/official/preview/{id}',function($id){
	return View::make('travel/official/tr-preview',array('id'=>$id));
});

#preview
Route::get('/automobile-preview/{id}',function($id){
	return View::make('layouts/automobile-preview',array('id'=>$id));
});



#official form
Route::get('forms/travel/official',function(){
	return View::make('travel/official/new_form',array('id'=>1));
});

#personal form
Route::get('forms/travel/personal',function(){
	return View::make('travel/personal/new_form',array('id'=>1));
});



#campus form
Route::get('forms/travel/campus',function(){
	return View::make('travel/campus/new_form',array('id'=>1));
});




/**PERSONAL**/
Route::get('/travel/personal/preview/{id}',function($id){
	return View::make('travel/personal/tr-personal-preview',array('id'=>$id));
});

#editor
Route::get('travel/personal/editor/{id}',function($id){
	return View::make('travel/personal/editor',array('id'=>$id));
});



/**CAMPUS**/
Route::get('/travel/campus/preview/{id}',function($id){
	return View::make('travel/campus/tr-campus-preview',array('id'=>$id));
});
Route::get('travel/campus/editor/{id}',function($id){
	return View::make('travel/campus/editor',array('id'=>$id));
});




/**CALENDAR**/

Route::get('/calendar',function(){
	return View::make('calendar/calendar');
});


/**automobile**/
#status
Route::get('/automobile',function(){
	return View::make('automobile/automobile-list');
});

#info
Route::get('/automobile/info',function(){
	return View::make('automobile/info');
});

#maintenance
Route::get('/automobile/maintenance',function(){
	return View::make('automobile/maintenance');
});

#ledger
Route::get('/automobile/ledger',function(){
	return View::make('automobile/ledger');
});


#gasoline
Route::get('/automobile/gasoline',function(){
	return View::make('automobile/gasoline');
});

#repair modal
Route::get('/automobile/repair',function(){
	return View::make('automobile/modal/repair');
});


/**STATUS**/
Route::get('/status',function(){
	return View::make('automobile/status');
});


/**VERIFIED TRAVEL REQUEST**/
Route::get('/verified',function(){
	return View::make('travel/verified');
});



/**RECENTLY VERIFIED TRAVEL REQUEST**/
Route::get('travel/verified/scheduled/{page?}',['uses'=>'Trips@show_recent']);
Route::get('travel/verified/ongoing/{page?}',['uses'=>'Trips@show_ongoing']);
Route::get('travel/verified/finished/{page?}',['uses'=>'Trips@show_finished']);

/**RECENTLY VERIFIED TRAVEL REQUEST [OFFICIAL ONLY]**/
Route::get('api/travel/official/verified/scheduled/{page}/{id}',['uses'=>'Official_itenerary@recent']);
Route::post('api/travel/official/verified/scheduled/{id}',['uses'=>'Official_itenerary@link']);
Route::get('api/travel/official/verified/scheduled/{id}',['uses'=>'Official_itenerary@show_linked_travel']);
Route::delete('api/travel/official/verified/scheduled/{id}',['uses'=>'Official_itenerary@destroy_linked_travel']);

/**RECENTLY VERIFIED TRAVEL REQUEST MARK AS**/
Route::put('api/travel/official/verified/{id}',['uses' =>'Trips@update_status']);






/**authentication**/

#login
Route::get('/authentication',function(){
	return View::make('authentication');
});

Route::post('/authentication',function(){
	return View::make('authentication');
});

Route::get('authentication/confirmation',['uses' =>'Authentication@index']);
Route::post('authentication/confirmation',['uses' =>'Authentication@index']);

#logout
Route::get('authentication/logout',['uses' =>'Authentication@logout']);


/**API**/
######################################################################################
#Official
######################################################################################

#project
Route::get('api/travel/official/projects',['uses' =>'Official@projects']);
Route::post('api/travel/official/projects',['uses' =>'Official@set_project']);


Route::get('api/travel/official/{page?}',['uses' =>'Official@index'])->middleware('auth_custom');
Route::get('api/travel/official/preview/{id}',['uses' =>'Official@show'])->middleware('auth_custom');
Route::get('api/travel/official/staff/{id}',['uses' =>'Official_staff@index']);
Route::get('api/travel/official/scholars/{id}',['uses' =>'Official_scholars@index']);
Route::get('api/travel/official/custom/{id}',['uses' =>'Official_custom@index']);
Route::get('api/travel/official/itenerary/{id}',['uses' =>'Official_itenerary@index']);
Route::get('api/travel/official/search/{param}',['uses' =>'Official@search']);


#purpose
Route::post('api/travel/official/purpose',['uses' =>'Official@create_purpose']);
Route::put('api/travel/official/purpose',['uses' =>'Official@update_purpose']);

#source of fund
Route::put('api/travel/official/fund',['uses' =>'Official@update_source_of_fund']);



#itenerary
Route::post('api/travel/official/itenerary',['uses' =>'Official_itenerary@create']);

#update status
Route::put('api/travel/official/status/{id}',['uses' =>'Official@update_status']);


Route::post('api/directory/staff/',['uses' =>'Official_staff@create']);
Route::delete('api/travel/official/{id}',['uses' =>'Official@destroy']);
Route::delete('api/travel/official/staff/{id}',['uses' =>'Official_staff@destroy']);


#scholar
Route::delete('api/travel/official/scholar/{id}',['uses' =>'Official_scholars@destroy']);
Route::post('api/directory/scholars/',['uses' =>'Official_scholars@create']);

#custom
Route::delete('api/travel/official/custom/{id}',['uses' =>'Official_custom@destroy']);
Route::post('api/directory/custom/',['uses' =>'Official_custom@create']);

#itenerary
Route::delete('api/travel/official/itenerary/{id}',['uses' =>'Official_itenerary@destroy']);


#driver
Route::put('api/travel/official/driver/{id}',['uses' =>'Official_itenerary@update_driver']);

#plate number
Route::put('api/travel/official/vehicle/{id}',['uses' =>'Official_itenerary@update_plate_no']);

/**CHARGE**/
Route::get('api/travel/official/charges/{id}',['uses' =>'Official_itenerary@show_charges']);
Route::put('api/travel/official/charges/{id}',['uses' =>'Official_itenerary@update_charges']);
Route::post('api/travel/official/charge/{id}',['uses' =>'Official_itenerary@charge']);
Route::get('api/travel/gc',['uses' =>'Directory@gasoline_charge']);
Route::get('api/travel/dc',['uses' =>'Directory@drivers_charge']);





######################################################################################
#Personal
######################################################################################
Route::get('/api/travel/personal/{page?}',['uses' =>'Personal@index'])->middleware('auth_custom');
Route::get('api/travel/personal/preview/{id}',['uses' =>'Personal@show'])->middleware('auth_custom');
Route::get('api/travel/personal/search/{param}',['uses' =>'Personal@search'])->middleware('auth_custom');

#purpose
Route::post('api/travel/personal/purpose',['uses' =>'Personal@create_purpose']);
Route::put('api/travel/personal/purpose',['uses' =>'Personal@update_purpose']);

#itenerary
Route::get('api/travel/personal/itenerary/{id}',['uses' =>'Personal_itenerary@index']);
Route::post('api/travel/personal/itenerary',['uses' =>'Personal_itenerary@create']);
Route::delete('api/travel/personal/itenerary/{id}',['uses' =>'Personal_itenerary@destroy']);


#view staff
Route::get('api/travel/personal/staff/{id}',['uses' =>'Personal_staff@index']);
Route::delete('api/travel/personal/staff/{id}',['uses' =>'Personal_staff@destroy']);
Route::post('api/directory/personal/staff/',['uses' =>'Personal_staff@create']);

#custom
Route::get('api/travel/personal/custom/{id}',['uses' =>'Personal_custom@index']);
Route::delete('api/travel/personal/custom/{id}',['uses' =>'Personal_custom@destroy']);
Route::post('api/directory/personal/custom/',['uses' =>'Personal_custom@create']);



#vehicle type
Route::put('api/travel/personal/vehicle_type',['uses' =>'Personal_itenerary@vehicle_type']);


#payment
Route::put('api/travel/personal/payment',['uses' =>'Personal@payment']);


#update status
Route::put('api/travel/personal/status/{id}',['uses' =>'Personal@update_status']);

#plate number
Route::put('api/travel/personal/vehicle/{id}',['uses' =>'Personal_itenerary@update_plate_no']);

#driver
Route::put('api/travel/personal/driver/{id}',['uses' =>'Personal_itenerary@update_driver']);

#charge
Route::post('api/travel/personal/charge/{id}',['uses' =>'Personal_itenerary@charge']);
Route::get('api/travel/personal/charges/{id}',['uses' =>'Personal_itenerary@show_charges']);
Route::put('api/travel/personal/charges/{id}',['uses' =>'Personal_itenerary@update_charges']);


##remove request
Route::delete('api/travel/personal/{id}',['uses' =>'Personal@destroy']);

#scholar
Route::get('api/travel/personal/scholars/{id}',['uses' =>'Personal_scholars@index']);
Route::post('api/travel/personal/scholars/',['uses' =>'Personal_scholars@create']);
Route::delete('api/travel/personal/scholars/{id}',['uses' =>'Personal_scholars@destroy']);

######################################################################################
#Staff and scholars directory
######################################################################################

Route::get('api/directory/staff/{page?}',['uses' =>'Directory@staff']);
Route::get('api/directory/staff/search/{param}',['uses' =>'Directory@staff_search']);
Route::get('api/directory/scholars/{page?}',['uses' =>'Directory@scholars']);
Route::get('api/directory/scholars/search/{param}/',['uses' =>'Directory@scholar_search']);
Route::get('api/directory/drivers/{page?}',['uses' =>'Directory@drivers']);
Route::get('api/directory/vehicles/{page?}',['uses' =>'Directory@vehicles']);









######################################################################################
#Campus
######################################################################################
Route::post('api/travel/campus/',['uses' =>'Campus@create']);
Route::get('api/travel/campus/preview/{id}',['uses' =>'Campus@show']);
Route::get('/api/travel/campus/{page?}',['uses' =>'Campus@index']);
Route::get('api/travel/campus/search/{param}',['uses' =>'Campus@search']);
Route::delete('api/travel/campus/{id}',['uses' =>'Campus@destroy']);
#itenerary
Route::post('api/travel/campus/itenerary',['uses' =>'Campus_itenerary@create']);
Route::get('api/travel/campus/itenerary/{id}',['uses' =>'Campus_itenerary@index']);
Route::delete('api/travel/campus/itenerary/{id}',['uses' =>'Campus_itenerary@destroy']);


#update status
Route::put('api/travel/campus/status/{id}',['uses' =>'Campus@update_status']);

#plate number
Route::put('api/travel/campus/vehicle/{id}',['uses' =>'Campus_itenerary@update_plate_no']);

#driver
Route::put('api/travel/campus/driver/{id}',['uses' =>'Campus_itenerary@update_driver']);

#charge
Route::post('api/travel/campus/charge/{id}',['uses' =>'Campus_itenerary@charge']);
Route::get('api/travel/campus/charges/{id}',['uses' =>'Campus_itenerary@show_charges']);
Route::put('api/travel/campus/charges/{id}',['uses' =>'Campus_itenerary@update_charges']);

###############################################################################################
# PRINTABLES
###############################################################################################

//OFFICIAL
#TR
Route::get('/travel/official/print/travel_request/{id}',['uses'=>'Official_printables@print_travel_request']);

#TT
Route::get('/travel/official/print/trip_ticket/{id}',['uses'=>'Official_printables@print_trip_ticket']);




//PERSONAL
Route::get('/travel/personal/print/travel_request/{id}',['uses'=>'Personal_printables@print_travel_request']);
Route::get('/travel/personal/print/statement_of_account/{id}',['uses'=>'Personal_printables@print_statement_of_account']);




//CAMPUS
Route::get('/travel/campus/print/travel_request/{id}',['uses'=>'Campus_printables@print_travel_request']);
Route::get('/travel/campus/print/notice_of_charges/{id}',['uses'=>'Campus_printables@print_notice_of_charges']);


#CALENDAR
Route::get('api/travel/calendar/{date}',['uses'=>'Calendar@index']);



###############################################################################################
# AUTMOBILE
###############################################################################################
#list
Route::get('/automobile/{id}',['uses'=>'Automobile@index']);
Route::post('api/automobile',['uses'=>'Automobile@create_automobile']);
Route::put('api/automobile/{id}',['uses'=>'Automobile@update_automobile']);


#replace parts
Route::post('/automobile/replace/{id}',['uses'=>'Automobile@create_replace_parts']);
Route::delete('/automobile/replace/{id}',['uses'=>'Automobile@destroy_parts']);

#repair parts
Route::post('/automobile/repair/{id}',['uses'=>'Automobile@create_repair_parts']);

#oil
Route::post('/automobile/oil/{id}',['uses'=>'Automobile@create_oil']);
Route::delete('/automobile/oil/{id}',['uses'=>'Automobile@destroy_oil']);

#gasoline
Route::post('/automobile/gasoline/{id}',['uses'=>'Automobile@create_gasoline']);
Route::get('/automobile/gasoline/ledger/{id}/{year}/{month}',['uses'=>'Automobile@view_gasoline_ledger']);
Route::delete('/automobile/gasoline/{id}',['uses'=>'Automobile@destroy_gasoline']);

#overall gasoline
Route::get('/automobile/gasoline/ledger/{year}',['uses'=>'Automobile@view_overall_gasoline_ledger']);

#ledger
Route::get('/automobile/maintenance/ledger/{id}/{year}/{month}',['uses'=>'Automobile@view_ledger']);
Route::get('/automobile/maintenance/ledger/print/{id}/{year}/{month}',['uses'=>'Automobile@print_ledger']);

#expenses

Route::get('/automobile/info/expenses/{id}/{year}/',['uses'=>'Automobile@view_expenses']);

