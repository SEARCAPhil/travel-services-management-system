<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Official_staff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $json='[{"name":"ICU","uid":"4","id":"299","designation":"Accounting Head","office":"Accounting Unit","profile_image":null,"allias":"AcU"},{"name":"FMU","uid":"3","id":"300","designation":null,"office":"Facilities Management Unit","profile_image":"3.jpg","allias":"FMU"},{"name":"Administrator","uid":"1","id":"301","designation":"administrator","office":"Accounting Unit","profile_image":"1.jpg","allias":"AcU"},{"name":"Amy A. Antonio","uid":"29","id":"302","designation":null,"office":"Project Development and Technical Services","profile_image":null,"allias":"PDTS"}]';
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
