
	var month=new Date().getMonth();
	var year=new Date().getFullYear();
	var day=new Date().getDay()
	var dayVal=[0,0,0,0,0,0,0]
	var calendar={}
	var charge={}
	var TimeOut;
	


	calendar.days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
	calendar.rows=[1,2,3,4,5,6];
	calendar.monthMaxDays=[31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	calendar.monthMaxDaysLeap=[31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	calendar.month=month
	calendar.year=year
	calendar.day=day

	calendar.monthLabels= ['January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September','October', 'November', 'December'];


	



	function getFirstDay(){

		console.log(new Date(calendar.year,calendar.month,1).getDay())
		console.log(calendar.monthMaxDays[calendar.month])

	}


	function calendarNextMonth(){
		if(calendar.month<11){
			++calendar.month+1;	
		}else{
			//reset to january and procede to next year
			calendar.month=0;
			++calendar.year
		}
		

		calendarTable('credential-animate'); 
		
	}


	var calendarPreviousMonth=function(){
		if(calendar.month>0){
			--calendar.month+1;	
		}else{
			//reset to january and decrease year
			calendar.month=11;
			--calendar.year
		}

		
		calendarTable('right-animate'); 
		clearTimeout(TimeOut);

		

	}


	var calendarToday=function(){

		calendar.month=month
		calendar.year=year
		calendar.day=day
		calendarTable();
		document.getElementById(new Date().toLocaleDateString()).className="today"
		getReserved(calendar.year+'-'+(calendar.month+1)+'-'+1)
		
	

	}

	var calendarTable=function(animation){

		var cal=document.querySelector('.calendar');
		var rd=new Date(calendar.year,calendar.month,1).getDay();
		var dayPointer=0;

		var htm='<center style="margin-top:-50px;"><h3><b>'+calendar.monthLabels[calendar.month]+' '+calendar.year+'</b></h3></center>'
		htm+='<table class="table table-bordered table-striped">'
		var limits

		cal.innerHTML='';

		

		//for week label
		
		htm+='<tr class="'+animation+'">'
		for(var w=0;w<7;w++){

			htm+='<td>'+calendar.days[w]+'</td>'

		}
		htm+='</tr>'


		if (calendar.month == 1) { // February only!
  			if ((calendar.year % 4 == 0 && calendar.year % 100 != 0) || calendar.year % 400 == 0){
  			  calendar.monthMaxDays[calendar.month] = 29;
 			 }else{calendar.monthMaxDays[calendar.month] = 28}
		}

		//for tr
		for(var r=0;r<=Math.ceil(calendar.monthMaxDays[calendar.month]/7)&&dayPointer<calendar.monthMaxDays[calendar.month];r++){

			htm+='<tr class="'+animation+'">'
			//td's must be less than maxdays and only 7 td
			for(var x=1;x<=calendar.monthMaxDays[calendar.month]&&x<=7; x++){
				/**td must be greater than the starting day of the month but less than the maxdays
				 	else retain the td blank
				*/
				if(x>rd&&dayPointer<calendar.monthMaxDays[calendar.month]){
					++dayPointer
					//htm+='<td  context="'+(dayPointer)+'" data-menu="selectCarMenu"><b>'+(dayPointer)+'</b>'
					htm+='<td><b style="color: #e91e63;">'+(dayPointer)+'</b>'
					htm+='<div class="sched"  id='+new Date(calendar.year+'-'+(calendar.month+1)+'-'+dayPointer).toLocaleDateString()+'></div></td>'
					
				}else{
					/**continue counting if next row*/
					if(r>0&&dayPointer<calendar.monthMaxDays[calendar.month]){
						++dayPointer
						htm+='<td><b style="color: #e91e63;">'+dayPointer+'</b>'
						htm+='<div class="sched"  id='+new Date(calendar.year+'-'+(calendar.month+1)+'-'+dayPointer).toLocaleDateString()+'></div></td>'
					
					}else{
						htm+='<td></td>'	
					}
					
				}
				
			}

			htm+='</tr>'


		}

		htm+='</table>';
		

		cal.innerHTML=htm;
		
		
				getReserved(calendar.year+'-'+(calendar.month+1)+'-'+1)
					
	
		
		



		
	}



	function getReserved(res){
		var reserved=[];

		$.get('api/travel/calendar/'+res,function(json){
			var data=JSON.parse(json);
			reserved=data;


			//reset before appending schedules on td
			var el=document.querySelector('.sched')

			for(var x=0;x<el.length; x++){
				el[x].innerHTML=''
			}


			for(var x=0;x<reserved.length; x++){

				var el=document.getElementById(new Date(reserved[x].departure_date).toLocaleDateString())
				var mobile=(reserved[x].manufacturer==null?' ':reserved[x].manufacturer)+' '+(reserved[x].plate_no==null?' ':'#'+reserved[x].plate_no);
				
				//if(reserved[x].plate_no!=null&&reserved[x].driver!=" "){
					

					//dayVal[new Date(reserved[x].departure_date).getDay()]++;

					var htm=`<div> 
								<small style="line-height: 12px;">
									<span class="text-success">`+reserved[x].location +` - `+reserved[x].destination + `</span><br/> 
									<input type="time" class="timeSelector" style="margin:0;background:none;border:none;padding:none;" value="`+reserved[x].departure_time+`" disabled="disabled">
									<span class="badge">${reserved[x].tr_id}</span>
								`


						htm+=`<br/><span class="text-muted">`+mobile+`</span>`;
						
						//hide driver
						
						htm+=`<br/><span class="text-muted">`+reserved[x].driver+`<span><br/>
						</small><hr/>`
						
						
						htm+=`</div>`
						
						el.innerHTML+=htm


				//}
				
								
			}




		}).fail(function(){
			alert('Calendar is not available right now.Please try again later')
		})


		//reserved=[{"id":"260","tr_id":"278","status":"scheduled","location":"test","destination":"test","departure_date":"2016-10-29","departure_time":"02:00:00","returned_time":"00:00:00","plate_no":null,"driver":" ","type":"travel"},{"id":"257","tr_id":"275","status":"scheduled","location":"SEARCA","destination":"Cavite","departure_date":"2016-10-26","departure_time":"04:00:00","returned_time":"00:00:00","plate_no":null,"driver":" ","type":"travel"},{"id":"258","tr_id":"276","status":"scheduled","location":"Cabuyao","destination":"Tagaytay","departure_date":"2016-10-26","departure_time":"05:00:00","returned_time":"00:00:00","plate_no":null,"driver":" ","type":"travel"},{"id":"265","tr_id":"283","status":"scheduled","location":"SEARCA","destination":"Cavite","departure_date":"2016-10-26","departure_time":"05:00:00","returned_time":"00:00:00","plate_no":null,"driver":" ","type":"travel"},{"id":"8","tr_id":null,"status":"scheduled","location":"SEARA","destination":"Tagaytay","departure_date":"2016-10-29","departure_time":"03:00:00","returned_time":"00:00:00","plate_no":"AXA 1341","driver":"Nelson Milante","type":"trp"},{"id":"11","tr_id":null,"status":"scheduled","location":"test","destination":"test","departure_date":"2016-10-29","departure_time":"00:00:00","returned_time":"00:00:00","plate_no":null,"driver":" ","type":"trp"},{"id":"43","tr_id":"32","status":"scheduled","location":"Mayondon","destination":"Cabuyao","departure_date":"2016-10-29","departure_time":"18:00:00","returned_time":null,"plate_no":null,"manufacturer":null,"driver":" ","type":"trc"},{"id":"44","tr_id":"33","status":"scheduled","location":"Mayondon","destination":"Vega","departure_date":"2016-10-29","departure_time":"08:00:00","returned_time":null,"plate_no":null,"manufacturer":null,"driver":" ","type":"trc"}];
			
			

			

			//assignReserved()

	}




	calendarTable('s');

