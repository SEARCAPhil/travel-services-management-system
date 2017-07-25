@extends('layouts.home')
@section('title','SEARCA System Authentication')
@section('content')
<style type="text/css">
	body{
		background: rgb(255,255,255);
	}
  input[type="text"],input[type="password"]{
    border: none;
    border-radius: 0 !important;
    -webkit-border-radius: 0 !important;
    padding:20px;
    box-shadow: none;
    text-align: center;
  }

  .btn-submit{
    background: #009688;
     padding: 10px;
     border-radius: 20px;
     color:rgb(250,250,250) !important;
  }

  .searca-about,.searca-footer{
    font-size: 9px;
    margin-top: 50px;
  }
  .searca-footer{
    line-height: 0;
    margin-top: 60px;
  }

   .auth-error{
      transition: all 0.3s ease-in-out;
      opacity: 0.9;
   }

</style>
	<section class="col col-xs-12 col-lg-4 col-lg-offset-4 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1" style="margin-top: 15vh;">
		<div class="col col-md-12 text-center">
			<form class="form form-horizontal text-center" method="POST" action="/laravel/public/authentication/confirmation">
				{{csrf_field()}}

				<div class="row">
		         	<div class="col col-md-12 text-center row">
		         	 	<p><img src="{{url('/')}}/img/searca.png"  width="60%"></p>
		         	</div>

		         	<div class="col col-xs-12 row"><br/>
		            	<h1> Sign In </h1>
		           	 	<p><small><a href="#"  class="text-muted">Travel Services Information System</a></b></small></p>
		         	</div>
		         
		        </div>

				

				<div class="col col-md-12 row form-group">
					<?php echo @$message; ?>
					<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" />
				</div>

				<div class="col col-md-12 form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>

				<div class="col col-md-12 form-group">
					
					<button class="btn btn btn-block btn-submit pull-right">Sign-in</button>
				</div>
			</form>


			<footer class="searca-footer"> 
			   <center>
			      <p>&copy;2017www.searca.org</p>
			   </center>
			</footer>
     
		</div>
		
	</section>


	
@endsection