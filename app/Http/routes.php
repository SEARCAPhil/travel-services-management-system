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
Route::get('/','Home@index');
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




/**authentication**/

#login
Route::get('/authentication',function(){
	return View::make('authentication');
});

/**API**/
######################################################################################
#Official
######################################################################################
Route::get('api/travel/official/{page?}',['uses' =>'Official@index']);
Route::get('api/travel/official/preview/{id}',['uses' =>'Official@show']);
Route::get('api/travel/official/staff/{id}',['uses' =>'Official_staff@index']);
Route::get('api/travel/official/scholars/{id}',['uses' =>'Official_scholars@index']);
Route::get('api/travel/official/custom/{id}',['uses' =>'Official_custom@index']);
Route::get('api/travel/official/itenerary/{id}',['uses' =>'Official_itenerary@index']);
Route::get('api/travel/official/search/{param}',['uses' =>'Official@search']);


Route::post('api/travel/official/purpose',['uses' =>'Official@create_purpose']);
Route::put('api/travel/official/purpose',['uses' =>'Official@update_purpose']);

Route::post('api/directory/staff/',['uses' =>'Official_staff@create']);
Route::post('api/travel/official/itenerary',['uses' =>'Official_itenerary@create']);





Route::delete('api/travel/official/{id}',['uses' =>'Official@destroy']);
Route::delete('api/travel/official/staff/{id}',['uses' =>'Official_staff@destroy']);


#scholar
Route::delete('api/travel/official/scholar/{id}',['uses' =>'Official_scholars@destroy']);

#custom
Route::delete('api/travel/official/custom/{id}',['uses' =>'Official_custom@destroy']);

#itenerary
Route::delete('api/travel/official/itenerary/{id}',['uses' =>'Official_itenerary@destroy']);

######################################################################################
#Personal
######################################################################################
Route::get('/api/travel/personal/{page?}',['uses' =>'Personal@index']);
#campus
Route::get('/api/travel/campus/{page?}',['uses' =>'Personal@index']);

######################################################################################
#Staff and scholars directory
######################################################################################

Route::get('api/directory/staff/{page?}',['uses' =>'Directory@staff']);
Route::get('api/directory/staff/search/{param}',['uses' =>'Directory@staff_search']);
Route::get('api/directory/scholars/{page?}',['uses' =>'Directory@scholars']);
Route::get('api/directory/scholars/search/{param}/',['uses' =>'Directory@scholar_search']);
Route::get('api/directory/drivers/{page?}',['uses' =>'Directory@drivers']);



