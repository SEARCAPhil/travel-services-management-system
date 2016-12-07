
	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span> Information</h1>
		<p>Plate number : 1598fd</p>

		<p>Current Mileage Reading : 0 km</p>

		<p>Brand/Make/Model : Toyota Camry LE</p>

		<p>Color :</p>
	</div>

	<canvas id="myChart3" width="400" height="250"></canvas>

	<script>
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

