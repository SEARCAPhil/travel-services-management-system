

 <div class="col col-md-7 col-sm-8 col-lg-5 col-lg-offset-1"><br/>
	<div class="col col-md-12 content-section">
		<h1>Gasoline Expense per Month</h1>
		<p><small>The graph below shows the annual gasoline expense of motorpool for year <span class="year"></span></small></p>
		<canvas id="myChart2" width="400" height="200"></canvas>
	</div>
</div>


<div class="col col-md-6 col-lg-3 col-sm-8"><br/>
	<div class="col col-md-8 col-sm-12 content-section">
		
			<center  class="chart-section">
				<h1>Current Status</h1>
				<canvas id="myChart" width="400" height="200"></canvas>
				
			</center>
			<div class="col col-md-12 col-sm-12"><br/>
				<ul class="list-unstyled status-indicator">
					<li class="col col-md-3"><div class="status-box blue"></div><small class="text-muted">Cars</small></li>
					<li class="col col-md-3"><div class="status-box green"></div><small class="text-muted">Available</small></li>
					<li class="col col-md-3"><div class="status-box red"></div><small class="text-muted">Unavailable</small></li>
				</ul>
			</div>
		
		
	</div>
</div>



<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/Chart.status.js"></script>
<script>
$(document).ready(function(){
	appendToChart(new Date().getFullYear());
	$('.year').html(new Date().getFullYear())
})
</script>

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