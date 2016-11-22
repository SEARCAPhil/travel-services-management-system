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
Route::get('/travel/official','Official@index');
Route::get('/travel/modal/{page}',function($page){
	return View::make('travel/modal/'.$page);
});
Route::get('/travel/official/preview/{id}',function($id){
	return View::make('travel/tr-preview',array('id'=>$id));
});


