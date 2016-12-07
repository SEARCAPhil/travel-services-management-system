<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Official_itenerary extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $json='[{"id":"273","0":"273","tr_id":"291","1":"291","res_id":null,"2":null,"location":"SEARCA","3":"SEARCA","destination":"Cavite","4":"Cavite","departure_time":"05:00:00","5":"05:00:00","actual_departure_time":"00:00:00","6":"00:00:00","returned_time":"00:00:00","7":"00:00:00","departure_date":"2016-11-30","8":"2016-11-30","returned_date":"0000-00-00","9":"0000-00-00","status":"scheduled","10":"scheduled","plate_no":null,"11":null,"driver_id":"0","12":"0","linked":"no","13":"no","date_created":"2016-11-21 13:36:24","14":"2016-11-21 13:36:24"},{"id":"274","0":"274","tr_id":"291","1":"291","res_id":null,"2":null,"location":"Cabuyao","3":"Cabuyao","destination":"test","4":"test","departure_time":"05:00:00","5":"05:00:00","actual_departure_time":"00:00:00","6":"00:00:00","returned_time":"00:00:00","7":"00:00:00","departure_date":"2016-11-29","8":"2016-11-29","returned_date":"0000-00-00","9":"0000-00-00","status":"scheduled","10":"scheduled","plate_no":null,"11":null,"driver_id":"0","12":"0","linked":"no","13":"no","date_created":"2016-11-21 14:02:03","14":"2016-11-21 14:02:03"}]';
        echo $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
