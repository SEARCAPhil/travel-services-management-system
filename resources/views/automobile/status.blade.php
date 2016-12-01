<div class="col col-md-12">
	<h1>100 Liters</h1>
	<p><small>The graph below shows the annual gasoline expense of motorpool from year 2014 to 2016</small></p>
</div>
<div class="col col-md-12">
	<canvas id="myChart2" width="400" height="200"></canvas>
</div>
 <div class="col col-md-12">
	<p><a href="#"><div class="status-box status-box-sm gray">+</div>Vehicle</a></p>
	<div class="col col-md-12 row">
		@include('automobile/automobile-list')
	</div>
</div>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script>

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

</script>