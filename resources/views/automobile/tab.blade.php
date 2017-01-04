<?php @session_start();?>
@extends('automobile.page')
@section('header')
<script type="text/javascript" src="js/preview.official.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-top top-navbar">
		<div class="container">
			<div class="navbar-header">
				<div class="navbar-brand"><span class="glyphicon glyphicon-th-large"></span></div>
			</div>

			<div class="navbar-right">
				<div class="profile-name pull-left"><?php echo @$_SESSION['name']; ?></div>
				<div class="profile-picture" style="background:url('/profiler/profile/<?php echo @$_SESSION["image"]; ?>') no-repeat center center;background-size:cover;"></div>
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
<div class="modal fade" id="preview-modal">
	<div class="modal-dialog" id="preview-modal-dialog">
			
	</div>
</div>

	<div>
		<br/><br/>
	  <div class="col col-md-4 col-sm-4 col-xs-4" style="padding-right:0;"><div class="tab-line">&nbsp;</div></div>
	  
		  <ul class="nav nav-tabs col col-md-8 col-sm-8 col-xs-8 tablist" role="tablist">
		  <li role="presentation" class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab" class="automobile-tab" data-page="status">Status</a></li>
		    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="automobile-tab" data-page="automobile">Automobile</a></li>
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"  class="automobile-tab" data-page="calendar">Calendar</a></li>
		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"  class="automobile-tab" data-page="travel">Travel</a></li>
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

	    <div role="tabpanel" class="tab-pane" id="editor"> </div>
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

function previewLoadingEffectFade(panel){
	$(panel).css({opacity:'1','user-select':'auto'});
}

$(document).ready(function(){
	 $(".automobile-tab").on('click',function(){
	 	var target=$(this).attr('href');

	 	var panel=document.querySelector(target);
	 	previewLoadingEffect(panel)
	 	$(panel).load($(this).attr('data-page'),function(){
	 		previewLoadingEffectFade(panel)
	 	})

	 	
	 })


	 //preselect first child
	 $('.automobile-tab')[0].click()
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


