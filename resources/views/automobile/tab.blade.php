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
				<a class="navbar-brand"  style="margin-left:0;color: #009688;"><i class="material-icons">menu</i></a>
				<a class="navbar-brand"  style="margin-left:0;"></a>
			</div>
			
		</div>
	</nav>
@endsection
@section('status')
	<div class="col col-md-2 col-sm-3" style="background: rgb(60,60,60);min-height: 1080px;box-shadow: 0px 5px 15px rgba(200,200,200,0.3);">

		<div class="col col-md-12 col-xs-12 col-sm-12">
 			<ul class="list-unstyled main-menu main-menu-list pull-left">

 			<?php if(@$_SESSION["priv"]=='admin'): ?>
 				<li href="#status" aria-controls="status" role="tab" data-toggle="tab" class="automobile-tab col col-md-12" data-page="status">
 					<i class="material-icons" style="width: 24px;">dashboard</i> Dashboard 	
 				</li>
 			<?php endif; ?>

 			<?php if(@$_SESSION["priv"]=='admin'): ?>
 				<li  href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab col col-md-12" data-page="automobile">
 					<i class="material-icons" style="width: 24px;">motorcycle</i> Automobile
 				 </li>
 			<?php endif; ?>


 			<?php if(@$_SESSION["priv"]=='admin'): ?>
 				<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab col col-md-12" data-page="verified">
 					<i class="material-icons">card_travel</i> Travel
 				</li>
 			<?php endif; ?>


 			<?php if(@$_SESSION["priv"]!='admin'): ?>
 				<li>
 					<i class="material-icons">card_travel</i> Travel
 				</li>
 			<?php endif; ?>


					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab pull-left col col-md-10" data-page="travel" data-type="official" onclick="showOfficialTravelList()">&emsp;&emsp;Official </li>


					<li role="presentation" class="col col-md-1"><a href="#" class="add-button" data-content="official"><i class="material-icons">add_box</i></a></li>


					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab pull-left col col-md-10" data-page="travel" data-type="personal"  onclick="showPersonalTravelList()">&emsp;&emsp;Personal </li>


					<li role="presentation" class="col col-md-1"><a href="#" class="add-button" data-content="personal"><i class="material-icons">add_box</i></a></li>


					<li href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab  pull-left col col-md-10" data-page="travel" data-type="campus"  onclick="showCampusTravelList()">&emsp;&emsp;Campus </li>


					<li role="presentation" class="col col-md-1"><a href="#" class="add-button" data-content="campus"><i class="material-icons">add_box</i></a></li>



 				<li href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab col col-md-12" data-page="calendar">
 					<i class="material-icons" style="width: 24px;">event</i> Calendar 
 				</li>



 				<li role="presentation" class=" hidden-lg hiiden-md hiiden-xs"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="editorTab" style="display:none;">Editor</a></li>
		  		<li role="presentation" class=" hidden-lg hiiden-md hiiden-xs"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="insertTab" style="display:none;">&nbsp;</a></li>


 			</ul>

 			<ul class="list-unstyled main-menu main-menu-list pull-left">
 				<li id="new"><a href="authentication/logout">Sign-out<i class="material-icons" style="width: 24px;">keyboard_backspace</i></a></li>
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
	    <div role="tabpanel" class="tab-pane active" id="status">
	    	
	    </div>

	  <!--home-->
	    <div role="tabpanel" class="tab-pane" id="home">
	    	
	    </div>


	    <!--profile-->
	    <div role="tabpanel" class="tab-pane" id="profile">
	    	
	    </div>



	    <div role="tabpanel" class="tab-pane" id="messages">
	    
	    </div>

	    <div role="tabpanel" class="tab-pane" id="verified"> </div>

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
});
</script>


@stop


@section('status-script')

	<script>
$(document).ready(function(){


	getautomobileStatus(function(){
		var ctx = document.getElementById("myChart");
		Chart.defaults.global.legend.display = false;
		var data = {
		    labels:['Total number of automobile','Available','Unavailable'],
		    datasets: [
		        {
		            data: [total_automobile, available_automobile,in_use_automobile],
		            backgroundColor: [
		                "rgb(32,122,199)",
		                "rgb(32,199,150)",
		                "rgb(255,82,87)"
		            ],
		            hoverBackgroundColor: [
		                "#FF6384",
		                "#36A2EB",
		                "#FFCE56"
		            ]
		        }]
		};

		// And for a doughnut chart
		var myDoughnutChart = new Chart(ctx, {
		    type: 'doughnut',
		    data: data,
		   
		});


		//status box
		$('.status-box.blue').html(total_automobile)
		$('.status-box.green').html(available_automobile)
		$('.status-box.red').html(in_use_automobile)

	});



	
})

	</script>
@stop


