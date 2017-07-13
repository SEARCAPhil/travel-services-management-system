@extends('layouts.home')
@section('title','SEARCA System Authentication')
@section('content')
<style type="text/css">
  input[type="text"],input[type="password"]{
    border: 1px solid #ccc !important;
    border-radius: 0 !important;
    -webkit-border-radius: 0 !important;
    padding:20px;
    box-shadow: none;
  }

  .btn-submit{
    background: rgb(55,164,249);
    color:rgb(255,255,255);
    padding: 10px;
    border-radius: 20px;
  }

  .searca-about,.searca-footer{
    font-size: 9px;
    margin-top: 50px;
  }
  .searca-footer{
    line-height: 0;
    margin-top: 60px;
  }
  .alert-danger{
    background: rgba(255,99,33,0.3);
  }
</style>
	<section class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" style="margin-top: 10vh;">
		<div class="col col-md-11 col-md-offset-1">
			<form class="form form-horizontal" method="POST" action="/laravel/public/authentication/confirmation">
				{{csrf_field()}}

				<div class="row">
		         	<div class="col col-md-2 col-sm-2 col-xs-2" style="min-width: 70px !important;">
		         	 	<p><img src="{{url('/')}}/img/sample-logo.png"  width="60px"></p>
		         	</div>

		         	<div class="col col-md-10 col-sm-10 col-xs-10" style="line-height: 0;">
		            	<h1 style="padding-right: 0px !important;"> Sign In </h1>
		           	 	<p><small class="text-muted"><a href="#" style="color:rgb(180,180,180);">Travel Services Information System</a></b></small></p>
		           	 	<p>&nbsp;</p>
		         	</div>
		         
		        </div>

				

				<div class="col col-md-12 row form-group">
					<input type="text" class="form-control" name="username" placeholder="Username" />
				</div>

				<div class="col col-md-12 form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>

				<div class="col col-md-12 form-group">
					<?php echo @$message; ?>
					<button class="btn btn btn-block btn-submit pull-right">Sign-in</button>
				</div>
			</form>
			<div style="clear: both;"></div>
			<div class="searca-about">  
			   <center>
			        <p>The Southeast Asian Regional Center for Graduate Study and Research in Agriculture (SEARCA) was established by the Southeast Asian Ministers of Education Organization (SEAMEO) in 1966 “to provide to the participating countries high quality graduate study in agriculture; promote, undertake, and coordinate research programs related to the needs and problems of the Southeast Asian region; and disseminate the findings of agricultural research and experimentation.</p>
			    </center>
			</div>


			<footer class="searca-footer"> 
			   <center>
			      <p>Created By</p>
			      <p>Information Technology Services Unit</p>
			      <p>&copy;2017 SEAMEO SEARCA</p>
			      <p><a href="www.searca.org" style="color:rgb(6,148,66);">www.searca.org</a></p>
			      <p><img src="{{url('/')}}/img/logo-new.png" width="40px"></p>
			      
			   </center>
			</footer>
     
		</div>
		
	</section>


	
@endsection