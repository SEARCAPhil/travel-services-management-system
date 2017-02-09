
	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span> Information</h1>
		<p>Plate number : <span id="plate_number" style="color:#ff9933"></span></p>

		<p>Brand/Make/Model : <span id="brand" style="color:#ff9933"></span></p>

		<p>Color : <input type="color" id="color" class="automobile-color" style="border:none !important;-webkit-appearance:none !important;" /></p>

	</div>

	<canvas id="myChart3" width="400" height="250"></canvas>
<script type="text/javascript" src="js/chart.info.js"></script>
<script>
$(document).ready(function(){

	for(var y=2015;y<2018;y++){
		show_automobileExpenses(plate_no,y);
	}

})
</script>

