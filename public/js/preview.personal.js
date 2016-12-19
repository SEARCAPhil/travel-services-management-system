
function ajax_getPersonalTravelListPreview(id,callback){
	$.get('api/travel/personal/preview/'+id,function(json){
		preview=JSON.parse(json)
		callback(preview);
		return preview;
	})
}

function ajax_getPersonalTravelPassengerStaffPreview(id,callback){

	$.get('api/travel/personal/staff/'+id,function(json){
		staff=JSON.parse(json)
		callback(staff);
		return staff;
	})
}


function ajax_getPersonalTravelItenerary(id,callback){
	$.get('api/travel/personal/itenerary/'+id,function(json){
		official_travel_itenerary=JSON.parse(json)
		callback(official_travel_itenerary);
		return official_travel_itenerary;
	})
}





function showPersonalTravelPassengerStaffPreview(id){
	ajax_getPersonalTravelPassengerStaffPreview(id,function(staff){

			
			for(var x=0;x<staff.length;x++){
				passenger_count++;
				showTotalPassengerCount()
				var htm=`<tr data-menu="staffPassengerMenu" context="0" data-selection="`+staff[x].id+`" id="official_travel_staff_passenger_tr`+staff[x].id+`" class="contextMenuSelector official_travel_staff_passenger_tr`+staff[x].id+`">
									<td>
										<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+staff[x].profile_image+`" data-mode="staff" style="background: url('/profiler/profile/`+staff[x].profile_image+`') center center no-repeat;background-size:cover;"></div></div>
										<div class="col col-md-9"><b>`+staff[x].name+`</b></div></td>

									
									<td>`+staff[x].designation+`</td>
									<td>`+staff[x].office+`</td>
								</tr>`
				$('.preview-passengers').append(htm)
			}
			
			setTimeout(function(){ context() },1000);


	});
}

function showPersonalTravelListPreview(id){
	ajax_getPersonalTravelListPreview(id,function(json){
		$('.preview-name').html(preview[0].profile_name)
		$('.preview-unit').html(preview[0].department)
		$('.preview-created').html(((preview[0].date_created).split(' '))[0])
		$('.preview-purpose').html(preview[0].purpose)


		//itenerary
		var htm=`<details id="official_travel_itenerary`+json[0].id+`" data-menu="iteneraryMenu" data-selection="`+json[0].id+ `" class="contextMenuSelector official_travel_itenerary`+json[0].id+` col col-md-12">
					<summary>`+json[0].location+` - `+json[0].destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>`+json[0].location+`</td>
								<td>`+json[0].destination+`</td>
								<td>`+json[0].departure_date+`</td>
								<td>`+json[0].departure_time+`</td>
							</tr>
						</tbody>
					</table>
				</details>
			`

			$('.preview-itenerary').append(htm)

		//vehicle type radio
		$('input[name=vtype]').each(function(index,value){
			if(json[0].vehicle_type==$(value).val()){
				$(value).attr('checked','checked')
			}
			
		})

		//payment mode
		$('input[name=mode-of-payment]').each(function(index,value){
			
			//check Cash
			if(json[0].mode_of_payment=='cash'&&index==0){
				$(value).attr('checked','checked')
			}


			//check Salary Deduction
			if(json[0].mode_of_payment=='sd'&&index==1){
				$(value).attr('checked','checked')
			}


			
		})

	})
}



function showPersonalTravelItenerary(id){



	ajax_getPersonalTravelItenerary(id,function(official_travel_itenerary){
		itenerary_count=0;
		for(var x=0; x<official_travel_itenerary.length;x++){
			itenerary_count++;
			showTotalIteneraryCount();
			var htm=`<details id="official_travel_itenerary`+official_travel_itenerary[x].id+`" data-menu="iteneraryMenu" data-selection="`+official_travel_itenerary[x].id+ `" class="contextMenuSelector official_travel_itenerary`+official_travel_itenerary[x].id+` col col-md-12">
					<summary>`+official_travel_itenerary[x].location+` - `+official_travel_itenerary[x].destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>`+official_travel_itenerary[x].location+`</td>
								<td>`+official_travel_itenerary[x].destination+`</td>
								<td>`+official_travel_itenerary[x].departure_date+`</td>
								<td>`+official_travel_itenerary[x].departure_time+`</td>
							</tr>
						</tbody>
					</table>
				</details>
			`

			$('.preview-itenerary').append(htm)
		}



	});
	
	
	
}