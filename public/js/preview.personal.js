
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
	})
}
