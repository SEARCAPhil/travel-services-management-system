
	var plate_no=($(selectedAutomobile).attr('data-content'))

	var statData=Array();
	var request_count=0;

	var ctx3 = document.getElementById("myChart3");
	var data3 = {
	    labels:months,
	    datasets:[]
	};

	try{
		var automobile_description=JSON.parse($(selectedAutomobile).attr('data-json'));
		$('#plate_number').html(automobile_description.id)
		$('#color').val(automobile_description.color)
		$('#brand').html(automobile_description.brand)

		//brand logo
		var logo='';
		if((automobile_description.brand).toLowerCase().indexOf('toyota')!=-1){ logo='toyota-flat.png'; }
		if((automobile_description.brand).toLowerCase().indexOf('honda')!=-1){ logo='honda.png'; }
		if((automobile_description.brand).toLowerCase().indexOf('mitsubishi')!=-1){ logo='mitsubishi.jpg'; }
		if((automobile_description.brand).toLowerCase().indexOf('hyundai')!=-1){ logo='hyundai.png'; }
		if((automobile_description.brand).toLowerCase().indexOf('suzuki')!=-1){ logo='suzuki.png'; }

		$('#automobile-brand-logo').html('<img src="img/brands/'+logo+'" width="100%" onerror="this.remove();"/>')
	}catch(e){}


	

	function ajax_getAutomobileExpenses(plate_no,year,callback){
		$.get('automobile/info/expenses/'+plate_no+'/'+year,function(json){

			callback(json)

		})
	}

	function show_automobileExpenses(plate_no,year){

		ajax_getAutomobileExpenses(plate_no,year,function(json){

			request_count++;

			var statData=JSON.parse(json);


		

				var sets={
					label: statData[0].total.year + " outlay",
					backgroundColor:'rgba(255,255,255, 0.8)',
            		data:[statData[0].data[0].jan.amount,statData[0].data[0].feb.amount,statData[0].data[0].mar.amount,statData[0].data[0].apr.amount,statData[0].data[0].may.amount,statData[0].data[0].jun.amount,statData[0].data[0].jul.amount,statData[0].data[0].aug.amount,statData[0].data[0].sep.amount,statData[0].data[0].oct.amount,statData[0].data[0].nov.amount,statData[0].data[0].dec.amount]
						
					}

				//change color
				if(request_count==1) sets.backgroundColor='rgba(0,150,150, 0.8)';
				if(request_count==2) sets.backgroundColor='rgba(255, 150, 0, 0.9)';

				data3.datasets.push(sets)
			
			
				//update only in last  ajax request
				if(request_count==3){

					setTimeout(function(){
						updateChart(ctx3)
					},1000)
					
				} 
 
				
			


		})
	}
	


	function updateChart(chart){
	// And for a doughnut chart
			var c3 = new Chart(chart, {
			    type: 'line',
			    data: data3,
			    showTooltip: true,
                multiTooltipTemplate : "<%%=datasetLabel%> : <%%=value%>"
           					   
			});

	}
		

