@extends('layouts.automobile-preview')
@section('content-preview')
	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span> Maintenance</h1>
		<p><span class="btn btn-primary" repair-dialog=""><span class="glyphicon glyphicon-wrench"></span> Repair</span></p>

		<p><span class="btn btn-primary" id="changeOilButton" oil-dialog=""><span class="glyphicon glyphicon-oil"></span> Change Oil Schedule/Due Date</span></p>

		<p><span class="btn btn-primary" replace-dialog=""><span class="glyphicon glyphicon-wrench"></span> Replace parts</span></p>
	</div>

@endsection
