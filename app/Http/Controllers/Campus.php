<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class Campus extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
         $json='{"current_page":1,"total_pages":1,"data":[{"id":"8","purpose":null,"mode_of_payment":"cash","requested_by":"1","approved_by":null,"departure_date":"2016-10-29","departure_time":"03:00:00","returned_date":"0000-00-00","returned_time":"00:00:00","location":"SEARA","destination":"Tagaytay","charge_to":null,"vehicle_type":"3","date_created":"2016-10-11 09:21:39","date_modified":"2016-11-21 09:35:33","plate_no":"AXA 1341","driver_id":"141","status":"scheduled","trp_status":"2"}]}';
        echo $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         try{
            //$uid=$request->session()->get('id');
            $uid=16;

            $this->pdoObject=DB::connection()->getPdo();

            $this->pdoObject->beginTransaction();
            $sql="INSERT INTO trc(requested_by) values (:requested_by)";
            $statement=$this->pdoObject->prepare($sql);
            $statement->bindParam(':requested_by',$uid);
            $statement->execute();
            $lastId=$this->pdoObject->lastInsertId();
            $this->pdoObject->commit();

            echo $lastId;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
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
