<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Official;
use App\Http\Controllers\Personal;

class Trips extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
       self::recent($page);
    }


    public function recent($page){

        $official_recent_class=new Official();
        $official_recent=@json_decode($official_recent_class->recent($page));

        #var_dump($official_recent->data);


        $personal_recent_class=new Personal();
        $personal_recent=@json_decode($personal_recent_class->recent($page));


        $campus_recent_class=new Campus();
        $campus_recent=@json_decode($campus_recent_class->recent($page));


        $merged_data=array_merge($official_recent->data,$personal_recent->data,$campus_recent->data);


        $count=count($merged_data);

        $no_pages=1;

        $no_pages=(max($official_recent->pages,$personal_recent->pages,$campus_recent->pages));

        $data=Array('total'=>$count,'pages'=>$no_pages,'current_page'=>$page,'data'=>$merged_data);
                
        echo json_encode($data); 
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
