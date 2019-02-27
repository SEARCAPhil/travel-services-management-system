<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Official;
use App\Http\Controllers\Personal;

use App\Http\Controllers\Official_itenerary;
use App\Http\Controllers\Personal_itenerary;
use App\Http\Controllers\Campus_itenerary;

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

        $official_class = new Official();
        $official_recent = @json_decode($official_class->recent($page));



        $data=Array('total'=>$official_recent->total,'pages'=>$official_recent->pages,'current_page'=>$page,'data'=>$official_recent->data);
                
        echo json_encode($data); 
    }


    public function ongoing($page){
        $official_class=new Official();
        $official_recent=@json_decode($official_class->ongoing($page));



        $data=Array('total'=>$official_recent->total,'pages'=>$official_recent->pages,'current_page'=>$page,'data'=>$official_recent->data);
                
        echo json_encode($data); 
    }


     public function finished($page){

        $official_class=new Official();
        $official_recent=@json_decode($official_class->finished($page));



        $data=Array('total'=>$official_recent->total,'pages'=>$official_recent->pages,'current_page'=>$page,'data'=>$official_recent->data);
                
        echo json_encode($data); 
    }

    public function search($param, $page){
        $official_class = new Official();
        $official_recent = @json_decode($official_class->search_trips($param, $page));
        $data=Array('total'=>$official_recent->total,'pages'=>$official_recent->pages,'current_page'=>$page,'data'=>$official_recent->data);           
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

    public function show_recent($page=1)
    {
       self::recent($page);
    }


    public function show_ongoing($page=1)
    {
       self::ongoing($page);
    }

    public function show_finished($page=1)
    {
       self::finished($page);
    }

    public function update_status($id,Request $request){
        $this->id=(int) htmlentities(htmlspecialchars($id));
        $status=$request->input('status');
        $type=$request->input('type');

        $official_class=new Official_itenerary();
        $personal_class=new Personal_itenerary();
        $campus_class=new Campus_itenerary();


        if(!empty($status)){

            #filter by status
            echo $official_class->update_status($id,$status); 
            /*if($type=='official') echo $official_class->update_status($id,$status); 
            if($type=='personal') echo $personal_class->update_status($id,$status);
            if($type=='campus') echo $campus_class->update_status($id,$status); */

        }
        
        
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
