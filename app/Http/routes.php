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

#modal
Route::get('/travel/modal/{page}',function($page){
	return View::make('travel/modal/'.$page);
});
Route::get('/travel/official','Official@index');

#editor
Route::get('travel/official/editor/{id}',function($id){
	return View::make('travel/official/editor',array('id'=>$id));
});
#preview
Route::get('/travel/official/preview/{id}',function($id){
	return View::make('travel/tr-preview',array('id'=>$id));
});

Route::get('/travel/personal/preview/{id}',function($id){
	return View::make('travel/tr-personal-preview',array('id'=>$id));
});

Route::get('/calendar',function(){
	return View::make('calendar/calendar');
});
Route::get('/automobile',function(){
	return View::make('automobile/status');
});


