<?php @session_start();?>
@extends('automobile.page')
@section('header')
<?php 
	/*check image*/
	$image=@$_SESSION["image"];
	if(is_null($image)||empty($image)){
		$image='user.png';
	}



?>

<script type="text/javascript" src="js/preview.official.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-top top-navbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"  style="margin-left:0;color: #f5b80e;"><i class="material-icons">menu</i></a>
				<a class="navbar-brand"  style="margin-left:0;"></a>
			</div>
			<div class="pull-right" style="width:40px;height: 40px;margin:5px; overflow:hidden;border-radius: 50px;" id="profilePicture"></div>
		</div>
	</nav>
@endsection
@section('status')
	<div class="col col-md-3 col-sm-4 col-lg-2" style="background: rgb(60,60,60);min-height: 1080px; height:100vh;box-shadow: 0px 5px 15px rgba(200,200,200,0.3);padding-top:5vh;">

		<div class="col col-md-12 col-xs-12 col-sm-12">
 			<ul class="list-unstyled main-menu main-menu-list pull-left">

 				<li href="#status" aria-controls="status" role="tab" data-toggle="tab" class="automobile-tab col col-md-12 col-sm-12" data-page="status">
 					<i class="material-icons" style="width: 24px;">dashboard</i> Today's Trip <span class="badge badge-danger">new</span>	
 				</li>

 			<?php if(@$_SESSION["priv"]=='admin'): ?>
 				<li  href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab col col-md-12 col-sm-12" data-page="automobile">
 					<i class="material-icons" style="width: 24px;">motorcycle</i> Automobile
 				 </li>
 			<?php endif; ?>


 			<?php if(@$_SESSION["priv"]=='admin'): ?>
 				<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab col col-md-12 col-sm-12" data-page="verified">
 					<i class="material-icons">card_travel</i> Travel
 				</li>
 			<?php endif; ?>


 			<?php if(@$_SESSION["priv"]!='admin'): ?>
 				<li class="col col-sm-12 col-md-12">
 					<i class="material-icons">card_travel</i> Travel
 				</li>
 			<?php endif; ?>


					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab pull-left col col-md-10 col-lg-9 text-smaller text-gray" data-page="travel" data-type="official" onclick="showOfficialTravelList">&emsp;&emsp;Official </li>


					


					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab pull-left col col-md-10 col-lg-9 text-smaller text-gray" data-page="travel" data-type="personal"  onclick="showPersonalTravelList">&emsp;&emsp;Personal </li>


					

					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab  pull-left col col-md-10 col-lg-9 text-smaller text-gray" data-page="travel" data-type="campus"  onclick="showCampusTravelList">&emsp;&emsp;Campus </li>


					<li role="presentation"></li>
					<li role="presentation"><a href="#" class="add-button text-smaller" data-content="official">&emsp;&emsp;Form<i class="material-icons">add_box</i></a></li>


 				<li href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab col col-md-12" data-page="calendar">
 					<i class="material-icons" style="width: 24px;">event</i> Calendar 
 				</li>



 				<li role="presentation" class=" hidden-lg hiiden-md hiiden-xs"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="editorTab" style="display:none;">Editor</a></li>
		  		<li role="presentation" class=" hidden-lg hiiden-md hiiden-xs"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="insertTab" style="display:none;">&nbsp;</a></li>


 			</ul>

 			<ul class="list-unstyled main-menu main-menu-list pull-left">
 				<li id="new" ><a href="authentication/logout" style="color: #f5b80e;">Sign-out<i class="material-icons" style="width: 24px;">keyboard_backspace</i></a></li>
 			</ul>

 			
 		</div>

	</div>

@endsection
@section('tabs')
<div class="modal fade" id="preview-modal">
	<div class="modal-dialog" id="preview-modal-dialog">
			
	</div>
</div>

	<!--<div>
		<br/><br/>
	  <div class="col col-md-4 col-sm-4 col-xs-4" style="padding-right:0;"><div class="tab-line">&nbsp;</div></div>
	  
		  <ul class="nav nav-tabs col col-md-10 col-sm-10 col-xs-10 tablist" role="tablist" style="opacity:0.1;">

		   <?php if(@$_SESSION["priv"]=='admin'): ?>
		 	 <li role="presentation" class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab" class="automobile-tab" data-page="status">Status</a></li>
		  <?php endif; ?> 

		   
		   	<li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab" data-page="automobile">Automobile</a></li>
		   

	
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab" data-page="calendar">Calendar</a></li>
		   

		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab" data-page="travel">Travel</a></li>

		    <?php if(@$_SESSION["priv"]=='admin'): ?>
		   		<li role="presentation"><a href="#verified" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab" data-page="verified">Verified</a></li>
		   	<?php endif; ?>

		    <li role="presentation"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="editorTab" style="display:none;">Editor</a></li>
		    <li role="presentation"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="insertTab" style="display:none;">&nbsp;</a></li>
		  </ul>
	  </div>

	</div>-->
@endsection


@section('dropdown-section')
	<div>
		
	  <!-- Tab panes -->
	  <div class="tab-content" style="margin-top: 40px;">


	  <!--status-->
	    <div role="tabpanel" class="tab-pane active" id="status" style="padding-top:10vh;">
	    	
	    </div>

	  <!--home-->
	    <div role="tabpanel" class="tab-pane" id="home">
	    	
	    </div>


	    <!--profile-->
	    <div role="tabpanel" class="tab-pane" id="profile">
	    	
	    </div>



	    <div role="tabpanel" class="tab-pane" id="messages">
	    
	    </div>

	    <div role="tabpanel" class="tab-pane" id="verified" style="padding-top:10vh;"> </div>

	    <div role="tabpanel" class="tab-pane" id="editor"> </div>
	  </div>

	</div>
@endsection








@section('script')
<script type="text/javascript" src="js/list.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/chart.automobile.status.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	//addd button
	bindAddFormNavigationButton();

	// profile pix
	let profileImage = document.getElementById('profilePicture')
	profileImage.innerHTML = ''

	if (!window.localStorage.getItem('image')) return
	profileImage.style.background = `url(${window.localStorage.getItem('image')})`
	profileImage.style.backgroundSize = 'cover'
});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-99081752-6"></script>
<script>
	const i = window.localStorage.getItem('givenName')
	if(i){
		window.dataLayer = window.dataLayer || []
		function gtag(){dataLayer.push(arguments)}
		gtag('js', new Date());
		gtag('set', {'user_id': i})
		gtag('config', 'UA-99081752-6')
	}
</script>



@stop


@section('status-script')


@stop


