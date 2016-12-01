@extends('layouts.home')
@section('title','SEARCA System Authentication')
@section('content')
	<section style="margin-top:20vh;">

		<div class="col col-md-5 col-md-offset-4">
			<form class="form form-horizontal" method="POST">
				<img src="/mpts/model/img/SEARCA.png" width="80%">
				<h4>Travel Services Management System</h4>
				<hr/>

				<div class="col col-md-12 form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" />
				</div>

				<div class="col col-md-12 form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" />
				</div>

				<div class="col col-md-12 form-group">
					<button class="btn btn-primary pull-right">Sign-in</button>
				</div>
			</form>
		</div>
	</section>
@endsection