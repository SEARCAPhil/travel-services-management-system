
var months= ['January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September','October', 'November', 'December'];
/*var statData=[{"total":{"amount":1250,"liters":16.5,"year":"2014"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":1000,"liters":15},"jun":{"amount":0,"liters":0},"jul":{"amount":250,"liters":1.5},"aug":{"amount":0,"liters":0},"sep":{"amount":0,"liters":0},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]},{"total":{"amount":5504,"liters":103,"year":"2015"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":0,"liters":0},"jun":{"amount":0,"liters":0},"jul":{"amount":504,"liters":6},"aug":{"amount":5000,"liters":97},"sep":{"amount":0,"liters":0},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]},{"total":{"amount":2301,"liters":152,"year":"2016"},"data":[{"jan":{"amount":0,"liters":0},"feb":{"amount":0,"liters":0},"mar":{"amount":0,"liters":0},"apr":{"amount":0,"liters":0},"may":{"amount":0,"liters":0},"jun":{"amount":1000,"liters":56},"jul":{"amount":0,"liters":0},"aug":{"amount":0,"liters":0},"sep":{"amount":1301,"liters":96},"oct":{"amount":0,"liters":0},"nov":{"amount":0,"liters":0},"dec":{"amount":0,"liters":0}}]}]*/

var data2 = {
    labels:months,
    datasets:[]
};

var request_count=0;

function ajax_getTotalGasolineAmount(year,callback){
	$.get('automobile/gasoline/ledger/'+year,function(json){

		callback(year,json);
		
	})

}

function appendToChart(year){
	ajax_getTotalGasolineAmount(year,function(year,json){

		request_count++;

		var statData=JSON.parse(json);
		
		var total_amount=statData[0].data[0].jan.amount+statData[0].data[0].feb.amount+statData[0].data[0].mar.amount+statData[0].data[0].apr.amount+statData[0].data[0].may.amount+statData[0].data[0].jun.amount+statData[0].data[0].jul.amount+statData[0].data[0].aug.amount+statData[0].data[0].sep.amount+statData[0].data[0].oct.amount+statData[0].data[0].nov.amount+statData[0].data[0].dec.amount;

		var total_liters=statData[0].data[0].jan.liters+statData[0].data[0].feb.liters+statData[0].data[0].mar.liters+statData[0].data[0].apr.liters+statData[0].data[0].may.liters+statData[0].data[0].jun.liters+statData[0].data[0].jul.liters+statData[0].data[0].aug.liters+statData[0].data[0].sep.liters+statData[0].data[0].oct.liters+statData[0].data[0].nov.liters+statData[0].data[0].dec.liters;

		var max_tick=total_amount/20;

		var sets={
					label:year+ " outlay",
					backgroundColor:'rgba(0,150,150, 0.9)',
					yAxisID: "A",
	        		data:[statData[0].data[0].jan.amount,statData[0].data[0].feb.amount,statData[0].data[0].mar.amount,statData[0].data[0].apr.amount,statData[0].data[0].may.amount,statData[0].data[0].jun.amount,statData[0].data[0].jul.amount,statData[0].data[0].aug.amount,statData[0].data[0].sep.amount,statData[0].data[0].oct.amount,statData[0].data[0].nov.amount,statData[0].data[0].dec.amount]
					
				}
				var set2={
					label:year+ " Total Liters",
					type:'line',
					yAxisID: "B",
					fill:false,
					borderColor: '#EC932F',
                    backgroundColor: '#EC932F',
                    pointBorderColor: '#EC932F',
                    pointBackgroundColor: '#EC932F',
                    pointHoverBackgroundColor: '#EC932F',
                    pointHoverBorderColor: '#EC932F',
	
	        		data:[statData[0].data[0].jan.liters,statData[0].data[0].feb.liters,statData[0].data[0].mar.liters,statData[0].data[0].apr.liters,statData[0].data[0].may.liters,statData[0].data[0].jun.liters,statData[0].data[0].jul.liters,statData[0].data[0].aug.liters,statData[0].data[0].sep.liters,statData[0].data[0].oct.liters,statData[0].data[0].nov.liters,statData[0].data[0].dec.liters]
					
				}
		

		//change color
		//if(request_count==1) sets.backgroundColor='rgba(0,150,150, 0.9)';
		//if(request_count==2) sets.backgroundColor='rgba(32,199,150,0.9)';

		data2.datasets.push(set2)
		data2.datasets.push(sets)
		

		//update only in last  ajax request
		updateChart(data2,max_tick);
			
			
		


	})
}

function updateChart(data,max_tick){

	var ctx2 = document.getElementById("myChart2");

	// bar
	var myDoughnutChart = new Chart(ctx2, {
	    type: 'bar',
	    data: data,
	    options:{
	    	scales: {
		      yAxes: [{
		        id: 'A',
		        type: 'linear',
		        position: 'left',
		      }, {
		        id: 'B',
		        type: 'linear',
		        position: 'right',
		        ticks: {
		          max: Math.ceil(max_tick)
		        }
		      }]
		    }
	    }
	   
	});


}
