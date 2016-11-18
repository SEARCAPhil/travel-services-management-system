@extends('layouts.home')
@section('title','Motorpool Travel Services')
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
@section('modal')
	<div class="backdrop">
		<div class="modalx">
			@include('automobile.info')
		</div>
	</div>
@endsection
@section('content-preview')
sdsdsds
@endsection
@section('chart')

	
	
@endsection

@section('tabs')
	<div>
		<br/><br/>
	  <!-- Nav tabs -->
	  <div class="col col-md-4 col-sm-4 col-xs-4" style="padding-right:0;"><div class="tab-line">&nbsp;</div></div>
	  <ul class="nav nav-tabs col col-md-8 col-sm-8 col-xs-8" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Automobile</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Calendar</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Travel</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content" style="margin-top: 80px;">

	  <!--home-->
	    <div role="tabpanel" class="tab-pane active" id="home">
	    	<!--<img src="{{asset('img/loading.png')}}" class="loading-circle" style="width: 80px !important;" />-->
	    	<div class="col col-md-12">
	    		<p><a href="#"><div class="status-box status-box-sm gray">+</div> Status</a></p>
		    	<div class="col col-md-12 row">
		    		<div class="col col-md-12">
		    			<h1>100 Liters</h1>
		    			<p><small>The graph below shows the annual gasoline expense of motorpool from year 2014 to 2016</small></p>
		    		</div>
		    		<div class="col col-md-12">
		    			<canvas id="myChart2" width="400" height="200"></canvas>
		    		</div>
		    	</div>

		    	<div class="col col-md-12">
		    		<p><a href="#"><div class="status-box status-box-sm gray">+</div>Vehicle</a></p>
		    		<div class="col col-md-12 row">
		    			<div class="col col-md-12 automobile-list">
		    				<!--automobile-->
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col col-md-12"><p><a href="#"><div class="status-box status-box-sm gray">+</div>Ledger</a></p></div>
		    </div>
	    </div>


	    <!--profile-->
	    <div role="tabpanel" class="tab-pane" id="profile"></div>



	    <div role="tabpanel" class="tab-pane" id="messages">...</div>
	  </div>

	</div>
@endsection

@section('automobile-tab')
	<section class="row">
		<div class="col col-md-12">ss</div>
	</section>
@endsection

@section('page-script')
<script type="text/javascript" src="js/Chart.min.js"></script>
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



var months= ['January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September','October', 'November', 'December'];
var statData=[{"total":{"amount":1250,"liters":16.5,"year":"2014"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":1000,"liters":15},"jun":{"amount":0,"liters":0},"jul":{"amount":250,"liters":1.5},"aug":{"amount":0,"liters":0},"sep":{"amount":0,"liters":0},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]},{"total":{"amount":5504,"liters":103,"year":"2015"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":0,"liters":0},"jun":{"amount":0,"liters":0},"jul":{"amount":504,"liters":6},"aug":{"amount":5000,"liters":97},"sep":{"amount":0,"liters":0},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]},{"total":{"amount":2301,"liters":152,"year":"2016"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":0,"liters":0},"jun":{"amount":1000,"liters":56},"jul":{"amount":0,"liters":0},"aug":{"amount":0,"liters":0},"sep":{"amount":1301,"liters":96},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]}]

var data2 = {
    labels:months,
};


data2.datasets= [
				
				{
					label: statData[0].total.year + " outlay",
					backgroundColor:'rgba(0,150,100, 0.2)',
            		data:[statData[0].data[0].jan.amount,statData[0].data[0].feb.amount,statData[0].data[0].mar.amount,statData[0].data[0].apr.amount,statData[0].data[0].may.amount,statData[0].data[0].jun.amount,statData[0].data[0].jul.amount,statData[0].data[0].aug.amount,statData[0].data[0].sep.amount,statData[0].data[0].oct.amount,statData[0].data[0].nov.amount,statData[0].data[0].dec.amount]
					
				},
				{
					label: statData[1].total.year+ " outlay",
           			backgroundColor:'rgba(255, 150, 0, 0.5)',
            		data:[statData[1].data[0].jan.amount,statData[1].data[0].feb.amount,statData[1].data[0].mar.amount,statData[1].data[0].apr.amount,statData[1].data[0].may.amount,statData[1].data[0].jun.amount,statData[1].data[0].jul.amount,statData[1].data[0].aug.amount,statData[1].data[0].sep.amount,statData[1].data[0].oct.amount,statData[1].data[0].nov.amount,statData[1].data[0].dec.amount]
					
				}
				,
				{
					label: statData[2].total.year+ " outlay",
					backgroundColor:'rgba(255, 99, 132, 0.8)',
            		data:[statData[2].data[0].jan.amount,statData[2].data[0].feb.amount,statData[2].data[0].mar.amount,statData[2].data[0].apr.amount,statData[2].data[0].may.amount,statData[2].data[0].jun.amount,statData[2].data[0].jul.amount,statData[2].data[0].aug.amount,statData[2].data[0].sep.amount,statData[2].data[0].oct.amount,statData[2].data[0].nov.amount,statData[2].data[0].dec.amount]
					
				}
				

			]


var ctx2 = document.getElementById("myChart2");




// bar
var myDoughnutChart = new Chart(ctx2, {
    type: 'bar',
    data: data2,
   
});


var ctx3 = document.getElementById("myChart3");
var data3 = {
    labels:months,
};


data3.datasets= [
				
				{
					label: statData[0].total.year + " outlay",
					backgroundColor:'rgba(255,255,255, 0.8)',
            		data:[statData[0].data[0].jan.amount,statData[0].data[0].feb.amount,statData[0].data[0].mar.amount,statData[0].data[0].apr.amount,statData[0].data[0].may.amount,statData[0].data[0].jun.amount,statData[0].data[0].jul.amount,statData[0].data[0].aug.amount,statData[0].data[0].sep.amount,statData[0].data[0].oct.amount,statData[0].data[0].nov.amount,statData[0].data[0].dec.amount]
					
				},
				{
					label: statData[1].total.year+ " outlay",
           			backgroundColor:'rgba(0,150,150, 0.8)',
            		data:[statData[1].data[0].jan.amount,statData[1].data[0].feb.amount,statData[1].data[0].mar.amount,statData[1].data[0].apr.amount,statData[1].data[0].may.amount,statData[1].data[0].jun.amount,statData[1].data[0].jul.amount,statData[1].data[0].aug.amount,statData[1].data[0].sep.amount,statData[1].data[0].oct.amount,statData[1].data[0].nov.amount,statData[1].data[0].dec.amount]
					
				}
				,
				{
					label: statData[2].total.year+ " outlay",
					backgroundColor:'rgba(255, 150, 0, 0.9)',
            		data:[statData[2].data[0].jan.amount,statData[2].data[0].feb.amount,statData[2].data[0].mar.amount,statData[2].data[0].apr.amount,statData[2].data[0].may.amount,statData[2].data[0].jun.amount,statData[2].data[0].jul.amount,statData[2].data[0].aug.amount,statData[2].data[0].sep.amount,statData[2].data[0].oct.amount,statData[2].data[0].nov.amount,statData[2].data[0].dec.amount]
					
				}
				

			]

// And for a doughnut chart
var c3 = new Chart(ctx3, {
    type: 'line',
    data: data3,
   
});
</script>
@stop


@section('automobile-script')
<script type="text/javascript">
function automobilePreview(){
	$("body").css("overflow", "hidden");
	$('.backdrop').css({marginTop:0}).click(function(e){
		if(this==e.target){
			$(this).css({marginTop:'-200%'})
			$("body").css("overflow", "auto");
		}
	})
}

$(document).ready(function(){

	


	var auto=[{"id":"0EV-21859","brand":"Toyota Corolla GLI","color":"Gray","status":"in_use","image":null},{"id":"1598fd","brand":"Toyota Camry LE","color":"#004040","status":"available","image":"1598fd.png"},{"id":"4589df","brand":"","color":"#000000","status":"available","image":"4589df.png"},{"id":"abc1315","brand":"Honda CR-V","color":"black","status":"available","image":"abc1315.png"},{"id":"asd","brand":"","color":"","status":"available","image":null},{"id":"asdasd","brand":"","color":"","status":"available","image":null},{"id":"AXA 1341","brand":"Toyota Fortuner 4x2 SUV","color":"#ffdbb7","status":"available","image":"asdasdasdas.png"},{"id":"new","brand":"Toyota Wigo 13.0 GMT","color":"#ffffff","status":"available","image":"new.png"},{"id":"no plate 2","brand":"Toyota Innova 2.5J MT","color":"white","status":"available","image":"35603A.png"},{"id":"OEV-22436","brand":"Mitsubishi L300 cab","color":"#ff9900","status":"available","image":null},{"id":"OEV-24469","brand":"Toyota Hi-ACE Grandia GL 2.5 DSL 5s","color":"#f7f7f7","status":"available","image":"OEV-24469.png"},{"id":"OEV-24498","brand":"Toyota Hi-Lux J M\/T 4x2","color":"#ffffff","status":"available","image":"OEV-24498.jpg"},{"id":"OEV-26782","brand":"Honda Accord 3.5 S AT","color":"#000000","status":"available","image":"OEV-26782.png"},{"id":"OEV-28050","brand":"Hyundai Grand Starex GL","color":"#ffffff","status":"available","image":"OEV-28050.png"},{"id":"po435","brand":"","color":"#800000","status":"available","image":null},{"id":"RENT A CAR","brand":"RENT A CAR","color":"#000000","status":"available","image":"RENT A CAR.png"},{"id":"sdfsdf","brand":"","color":"#000000","status":"available","image":null},{"id":"TQE 247","brand":"SUZUKI multicab","color":"#ffffd7","status":"available","image":null}];

	for(var x=0;x<auto.length;x++){
		console.log(auto[x].brand)
		var brand=auto[x].brand.length>1?auto[x].brand:'<br/>';
		var htm=`<div class="col col-md-3 col-sm-4 col-xs-6 " onclick="automobilePreview()"><div class="automobile-list-item">
		    					<img src="/laravel/public/uploads/automobile/`+auto[x].image+`" onerror="this.src='/laravel/public/img/no-photo-available.jpg'"/>
		    					<div class="col col-md-12">
		    						<h4 class="page-header">`+brand+`</h4>
		    						<p><div class="marker marker-danger">`+auto[x].id+`</div></p>`
		   if(auto[x].status=='in_use'){
		   	htm+=`<p><center class="text-muted"><b>Unavailable</b></ceter></p>`
		   }
		    						
		htm+=`
		    					</div></div>
		    				</div>`
		$('.automobile-list').append(htm)
	}




})
</script>
@stop
