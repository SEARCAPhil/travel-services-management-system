<?php @session_start();?>
@extends('automobile.page')
@section('header')
<script type="text/javascript" src="js/preview.official.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-top top-navbar">
		<div class="container">
			<div class="navbar-header">
				<div class="navbar-brand"><span class="glyphicon glyphicon-th-large"></span></div>
			</div>

			<div class="navbar-right dropdown">
			<?php 
				/*check image*/
				$image=@$_SESSION["image"];
				if(is_null($image)||empty($image)){
					$image='user.png';
				}

			?>
				<div class="profile-name pull-left"><?php echo @$_SESSION['name']; ?></div>
				<div class="profile-picture dropdown-toggle" data-toggle="dropdown" style="background:url('/profiler/profile/<?php echo $image; ?>') no-repeat center center;background-size:cover;"></div>

					<!--account-menu-->
					<ul class="dropdown-menu"  id="account_menu">
					    <li><a href="authentication/logout">Logout</a></li>
				
					</ul>
			</div>
		</div>
	</nav>
@endsection
@section('status')
	<section class="row">
		<div class="col col-md-12 col-sm-12 col-xs-12" style="float:left;">
			<center  class="col col-xs-6 col-sm-6 col-md-4  col-md-offset-4 col-sm-offset-3 col-xs-offset-3  chart-section">
				<h3>Current Status</h3>
				<canvas id="myChart" width="400" height="200"></canvas>
				
			</center>
			<div class="col col-md-10 col-sm-10 col-xs-10 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 "><br/>
				<ul class="list-unstyled status-indicator">
					<li class="col col-md-4"><div class="status-box blue"></div>Automobile</li>
					<li class="col col-md-4"><div class="status-box green"></div>Available Cars</li>
					<li class="col col-md-4"><div class="status-box red"></div>Unavailable</li>
				</ul>
			</div>
		</div>
		
	</section>
@endsection
@section('tabs')
<div class="modal fade" id="preview-modal">
	<div class="modal-dialog" id="preview-modal-dialog">
			
	</div>
</div>

	<div>
		<br/><br/>
	  <div class="col col-md-4 col-sm-4 col-xs-4" style="padding-right:0;"><div class="tab-line">&nbsp;</div></div>
	  
		  <ul class="nav nav-tabs col col-md-8 col-sm-8 col-xs-8 tablist" role="tablist">

		   <?php if(@$_SESSION["priv"]=='admin'): ?>
		 	 <li role="presentation" class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab" class="automobile-tab" data-page="status">Status</a></li>
		  <?php endif; ?> 

		   <?php if(@$_SESSION["priv"]=='admin'): ?>
		   		<li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab" data-page="automobile">Automobile</a></li>
		   	<?php endif; ?>

	
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab" data-page="calendar">Calendar</a></li>
		   

		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab" data-page="travel">Travel</a></li>

		    <?php if(@$_SESSION["priv"]=='admin'): ?>
		   		<li role="presentation"><a href="#verified" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab" data-page="verified">Verified</a></li>
		   	<?php endif; ?>

		    <li role="presentation"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="editorTab" style="display:none;">Editor</a></li>
		    <li role="presentation"><a href="#editor" aria-controls="messages" role="tab" data-toggle="tab"  data-page="travel/official/editor" id="insertTab" style="display:none;">&nbsp;</a></li>
		  </ul>
	  </div>

	</div>
@endsection


@section('dropdown-section')
	<div>
		
	  <!-- Tab panes -->
	  <div class="tab-content" style="margin-top: 80px;">


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

<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/chart.automobile.status.js"></script>


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
		            data: [total_automobile, available_automobile, under_maintenance_automobile],
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
		$('.status-box.red').html(under_maintenance_automobile)

	});



	
})

	</script>
@stop


