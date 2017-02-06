<div class="col col-md-12">
	<h1>Gasoline Expense per Month</h1>
	<p><small>The graph below shows the annual gasoline expense of motorpool for year <span class="year"></span></small></p>
</div>
<div class="col col-md-12">
	<canvas id="myChart2" width="400" height="200"></canvas>
</div>
 
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/Chart.status.js"></script>
<script>
$(document).ready(function(){
	appendToChart(new Date().getFullYear());
	$('.year').html(new Date().getFullYear())
})
</script>