@extends('automobile.page')
@section('header')
<nav class="navbar navbar-inverse top-navbar">
		<div class="container">
			<div class="navbar-header">
				<div class="navbar-brand">LOGo</div>
			</div>

			<div class="navbar-right">
				<div class="profile-name pull-left">Lorem Ipsum Sit dolor</div>
				<div class="profile-picture"></div>
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
					<li class="col col-md-4"><div class="status-box blue">20</div>Automobile</li>
					<li class="col col-md-4"><div class="status-box green">5</div>Available Cars</li>
					<li class="col col-md-4"><div class="status-box red">30</div>Unavailable</li>
				</ul>
			</div>
		</div>
		
	</section>
@endsection
@section('tabs')
	<div>
		<br/><br/>
	  <div class="col col-md-4 col-sm-4 col-xs-4" style="padding-right:0;"><div class="tab-line">&nbsp;</div></div>
		  <ul class="nav nav-tabs col col-md-8 col-sm-8 col-xs-8" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab">Automobile</a></li>
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab">Calendar</a></li>
		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab">Travel</a></li>
		  </ul>
	  </div>

	</div>
@endsection


@section('dropdown-section')
	<div>
		
	  <!-- Tab panes -->
	  <div class="tab-content" style="margin-top: 80px;">


	  <!--home-->
	    <div role="tabpanel" class="tab-pane active" id="home">
	    	<!--<img src="{{asset('img/loading.png')}}" class="loading-circle" style="width: 80px !important;" />-->
	    	<div class="col col-md-12">
	    		<p><a href="#"><div class="status-box status-box-sm gray">+</div>Status</a></p>
		    	<div class="col col-md-12 row">
		    	@include('automobile/status')
		    		<!--<p class="text-muted">Loading . . .</p>-->
		    	</div>
		    </div>

		    <div class="col col-md-12">
	    		<p><a href="#"><div class="status-box status-box-sm gray">+</div>Vehicle</a></p>
		    	<div class="col col-md-12 row">
		    		@include('automobile/automobile-list')
		    	</div>
		    </div>

		    <div class="col col-md-12">
	    		<p><a href="#"><div class="status-box status-box-sm gray">+</div>Ledger</a></p>
		    	<div class="col col-md-12 row">
		    		<p class="text-muted">Loading . . .</p>
		    	</div>
		    </div>
	    </div>


	    <!--profile-->
	    <div role="tabpanel" class="tab-pane" id="profile">
	    	@include('calendar/calendar')
	    </div>



	    <div role="tabpanel" class="tab-pane" id="messages">
	    <span class="col col-md-12 page-header visible-sm visible-xs"><a href="#" class="list-hidden-menu"><span class="glyphicon glyphicon-th"></span> List</a></span>
	    @include('travel/list')
	    </div>
	  </div>

	</div>
@endsection








@section('script')

<script type="text/javascript" src="js/Chart.min.js"></script>
<script>
//global function
function previewLoadingEffect(){
	$('.preview-content').css({opacity:'0.3','user-select':'none'});
	$('.preview-content').append('<img src="img/loading.png" class="loading-circle" style="width: 80px !important;top:20%;" />');
}

function previewLoadingEffect(panel){
	$(panel).css({opacity:'0.3','user-select':'none'});
	$(panel).append('<img src="img/loading.png" class="loading-circle" style="width: 80px !important;top:50%;" />');
}

$(document).ready(function(){
	 $(".automobile-tab").on('click',function(){
	 	var target=$(this).attr('href');

	 	var panel=document.querySelector(target);
	 	//previewLoadingEffect(panel)
	 })
})


</script>

@stop


@section('status-script')

	<script>
	var ctx = document.getElementById("myChart");
	 Chart.defaults.global.legend.display = false;
	var data = {
	    labels:['Total number of automobile','Available','Unavailable'],
	    datasets: [
	        {
	            data: [300, 50, 100],
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

	</script>
@stop


