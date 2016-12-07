<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Official extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
        $json='{"current_page":1,"total_pages":1,"data":[{"id":"290","purpose":null,"source_of_fund":"opf","requested_by":"16","approved_by":null,"date_approved":"","date_created":"2016-11-09 16:08:58","date_modified":"2016-11-09 16:15:43","plate_no":null,"status":"2"},{"id":"284","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nom. . . ","source_of_fund":"opf","requested_by":"1","approved_by":null,"date_approved":"","date_created":"2016-10-17 09:36:42","date_modified":"2016-11-09 15:27:26","plate_no":null,"status":"2"}]}';
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
    public function show()
    {
        
        $json='[{"id":"16","0":"290","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nom. . .","1":null,"source_of_fund":"opf","2":"opf","requested_by":"16","3":"16","approved_by":null,"4":null,"date_approved":"","5":"","date_created":"2016-11-09 16:08:58","6":"2016-11-09 16:08:58","date_modified":"2016-10-27 10:26:13","7":"2016-11-09 16:15:43","plate_no":null,"8":null,"status":"2","9":"2","10":"16","uid":"67","11":"67","profile_name":"John Kenneth G. Abella","12":"John Kenneth G. Abella","last_name":"Abella","13":"Abella","first_name":"John Kenneth","14":"John Kenneth","middle_name":null,"15":null,"profile_email":null,"16":null,"department":"Information Technology Services Unit","17":"Information Technology Services Unit","department_alias":"ITSU","18":"ITSU","position":"programmer","19":"programmer","profile_image":"67.jpg","20":"67.jpg","21":"2016-10-27 10:26:13"}]';
        echo $json;
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
