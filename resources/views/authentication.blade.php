@extends('layouts.home')
@section('title','SEARCA System Authentication')
@section('content')
<style>
	body{
		background: #fff !important;
		overflow: hidden;
	}
	.main-login {
		height:100vh;
		overflow:hidden;
	}
	.main-login-banner {
		height:100vh;
		padding-top:10%;
		color:rgb(255,255,255);
		z-index:1;
		position:relative;
	}

	.main-login-backdrop {
		float:left;
		position:absolute;
		width:100%;
		height:100%;
		top:0;
			background:rgba(0,0,0,0.8);
			z-index:1;
	}

	.main-login-banner-text {
		float:left;
		position:absolute;
		width:100%;
		height:100%;
		top:100px;
		z-index:2;
	}


	.green {
		color: #23f98b;
	}

	.sub-login-banner {
		padding-top:7%;
		position:relative;
		height:100%;
		overflow:hidden;
		overflow-y: auto;
	}
	.go-to-app-btn {
		border-radius: 50px !important;
		color: #fff !important;
		background: #e91e63 !important;
		padding: 15px !important;
		text-transform: none !important;
	}
	.doodle-section {
		height:100%;
		width:100%;
		background:url('{{url('/')}}/img/doodle.png') no-repeat;
		overflow:hidden;
		position:absolute;
		z-index:0;
		top:35%;
	}
	.sub-banner-deco {
		position:absolute;
		height:30vh;
		width:50%;
		background:url('{{url('/')}}/img/sub-banner-deco.png') no-repeat;
		background-size:cover;
		overflow:hidden;
		bottom:0;
		right:0;
	}
</style>
<article class="main-login row" id="{{ csrf_token() }}">
 
    <section class="col col-12 col-lg-7 main-login-banner">
        <div class="container col col-lg-10 col-8 col-md-8 col-lg-offset-1 col-sm-offset-2 col-xs-offset-1 main-login-banner-text"> 
            <h2>Travel Services Management System</h2><?php echo @$message; ?>
            <p class="text-muted">
							Monitor your land travel in one place! <span class="green">Book your travel</span> and we will take care the rest
						</p>
						<br/><br/>
						<h3 class="text-muted">Sign-in</h3>
            <button class="btn btn-office365 btn-lg   go-to-app-btn" type="button">Login with Office365</button>
        </div>
        <div class="main-login-backdrop"></div>
        <div class="doodle-section"></div>
    </section>



    <section class="col col-lg-5 sub-login-banner">
        <div class="sub-banner-deco"></div>
        <div class="col-lg-10 col-lg-offset-1">
            <img src="{{url('/')}}/img/searca-new.png" width="150px">
            <br/><br/>
            <div class="media">
                <div class="media-left">
                <img src="{{url('/')}}/img/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Well structured and organized</h4>
                    <p><small>Classified your records as personal, official or campus travel</small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="{{url('/')}}/img/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Safe and secured</h4>
                    <p><small>Stored your data in the cloud with security and privacy. By using your Office365 account, you gain 1 more extra security layer to protect your files against hackers and viruses  </small></p>
                </div>
                <hr/>
            </div>

             <div class="media">
                <div class="media-left">
                <img src="{{url('/')}}/img/checked-green.png" width="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Accessible everywhere</h4>
                    <p><small>You can always book your land travel anytime and everytime in the world!</small></p>
                </div>
                <hr/>
            </div>

            <br/>
            <br/>
            <p>
                <small>By signing in to TRS you are agree/accept to <span class="text-success">Users License agreement</span> and <span class="text-success">Data policy</span> settings of SEARCA</small>
            </p>
						
        </div> 
        
    </section>

<!--end content-->
</artice>

<script type="text/javascript" src="{{url('/')}}/js/auth.es.module.js"></script>