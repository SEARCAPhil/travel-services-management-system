/**
* @title PERSONAL TRAVEL REQUEST PREVIEW SCRIPT
* @author Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/



/*
|----------------------------------------------------------------------------
| AJAX preview functions
|---------------------------------------------------------------------------
|
| Contains logic in sending the data used by showPersonalTravelListPreview() function 
|
|
*/

function ajax_getPersonalTravelListPreview(id,callback){
	$.get('api/travel/personal/preview/'+id,function(json){
		preview=JSON.parse(json)
		callback(preview);
		return preview;
	})
}



/*
|----------------------------------------------------------------------------
| AJAX passenger functions
|---------------------------------------------------------------------------
|
| Contains logic in viewing pasengers of the official travel requests 
| This is called allong with showPersonalTravelPassenger.*() functions
|
*/

function ajax_getPersonalTravelPassengerStaffPreview(id,callback){

	$.get('api/travel/personal/staff/'+id,function(json){
		staff=JSON.parse(json)
		callback(staff);
		return staff;
	})
}

function ajax_getPersonalTravelPassengerScholarsPreview(id,callback){

	$.get('api/travel/personal/scholars/'+id,function(json){
		scholars=JSON.parse(json)
		callback(scholars);
		return scholars;
	})

}

function ajax_getPersonalTravelPassengerCustomPreview(id,callback){


	$.get('api/travel/personal/custom/'+id,function(json){
		official_travel_custom_passenger=JSON.parse(json)
		callback(official_travel_custom_passenger);
		return official_travel_custom_passenger;
	})

	
}



/*
|----------------------------------------------------------------------------
| AJAX itenerary functions
|---------------------------------------------------------------------------
|
| Get the personal travel request's itenerary
|
|
*/

function ajax_getPersonalTravelItenerary(id,callback){
	$.get('api/travel/personal/itenerary/'+id,function(json){
		official_travel_itenerary=JSON.parse(json)
		callback(official_travel_itenerary);
		return official_travel_itenerary;
	})
}



/*
|----------------------------------------------------------------------------
| Count Display
|---------------------------------------------------------------------------
|
| Display total count into section
|
|
*/

function showTotalPassengerCount(){
	$('.passenger-count').html(passenger_count)
}

function showTotalIteneraryCount(){
	$('.itenerary-count').html(itenerary_count)
}




/*
|----------------------------------------------------------------------------
| Display preview page
|---------------------------------------------------------------------------
|
| Show necessary information on the preview page including id,requestor,
| unit,date and purpose
|
|
*/


function showPersonalTravelListPreview(id){
	ajax_getPersonalTravelListPreview(id,function(json){
		$('.preview-id').html(json[0].id)
		$('.preview-name').html(json[0].profile_name)
		$('.preview-unit').html(json[0].department)
		$('.preview-created').html(((json[0].date_created).split(' '))[0])
		$('.preview-purpose').html(json[0].purpose)


				//--------------------------------------
		// Check for valid status
		// 0 - Not yet send
		// 1 - Sent
		// 2 - Verified
		// 3 - Returned to sender
		// 4 - Closed
		// --------------------------------------

		if(typeof json[0].trp_status!=undefined){


			if(json[0].trp_status==0){		
				//allow forwarding
				bindForwardPersonal()

				//allow updating
				bindUpdatePersonalPreview()
				bindRemovePersonalPreview()

				//enable command buttons
				enableStatusDefaultButtonCommandGroup()
							
			}


			if(json[0].trp_status==1){

				if(isAdmin()){
					//allow admin to verify or returned the request to the sender
					showUntouchedStatusAdmin()
					bindVerifyPersonal();
					bindReturnPersonal();

				}else{
					//Show waiting for confirmation status
					showVerifyStatus();
				}

			}


			if(json[0].trp_status==2){

				if(isAdmin()){
					//show a close or return to sender status
					showVerifyStatusAdmin();
					bindReturnPersonal()
					bindClosePersonal()

				}else{
					//show VERIFIED status to the ordinary user
					showVerifiedStatus();
				}

			}


			


			//returned status
			if(json[0].trp_status==3){
				//show returned status to both admin and user

				//allow the user to update the request
				showReturnStatus()
				bindForwardPersonal()
				bindUpdatePersonalPreview()
				bindRemovePersonalPreview()
				enableStatusDefaultButtonCommandGroup()
			}


			//close status
			if(json[0].trp_status==4){
				showClosedStatus()
			}
		}



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

		//data must no be empty before appending
		if(json[0].destination.length>0) $('.preview-itenerary').append(htm)
			

		//vehicle type radio
		$('input[name=vtype]').each(function(index,value){
			if(json[0].vehicle_type==$(value).val()){
				$(value).attr('checked','checked')
			}
			
		})

		//payment mode
		$('input[name=mode-of-payment]').each(function(index,value){
			console.log(index);
			//check Cash
			if(json[0].mode_of_payment=='cash'&&$(value).val()=='cash'){
				$(value).attr('checked','checked')
			}


			//check Salary Deduction
			if(json[0].mode_of_payment=='sd'&&$(value).val()=='sd'){
				$(value).attr('checked','checked')
			}


			
		})

	})
}




/*
|----------------------------------------------------------------------------
| Display passengers
|---------------------------------------------------------------------------
|
| Show all  passengers on the list.
| DO NOT FORGET to call context() function to enable right click menu
|
*/

function showPersonalTravelPassengerStaffPreview(id){
	ajax_getPersonalTravelPassengerStaffPreview(id,function(staff){

			console.log(staff)
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

function showPersonalTravelPassengerScholarsPreview(id){
	
	ajax_getPersonalTravelPassengerScholarsPreview(id,function(scholars){
		
		for(var x=0;x<scholars.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			var htm=''
			 htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+scholars[x].id+`" id="official_travel_scholars_passenger_tr`+scholars[x].id+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+scholars[x].id+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+scholars[x].profile_image+`" data-mode="scholars"></div></div>
									<div class="col col-md-9"><b>`+scholars[x].full_name+`</b></div></td>

								
								<td>`+scholars[x].nationality+`</td>
								<td>`+scholars[x].office+`</td>
							</tr>`
			$('.preview-passengers').append(htm);
			
		}

		
		setTimeout(function(){ context() },2000);	
	});
	
}


function showPersonalTravelPassengerCustomPreview(id){
	ajax_getPersonalTravelPassengerCustomPreview(id,function(official_travel_custom_passenger){
		
		var htm='';	
		for(var x=0;x<official_travel_custom_passenger.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			htm=`<tr data-menu="customPassengerMenu" data-selection="`+official_travel_custom_passenger[x].id+ `" id="official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`" class="contextMenuSelector official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="" data-mode="custom"></div></div>
									<div class="col col-md-9"><b>`+official_travel_custom_passenger[x].full_name+`</b></div></td>
								<td>`+official_travel_custom_passenger[x].designation+`</td>
								<td>N/A</td>
							</tr>`

			$('.preview-passengers').append(htm)
		}
		
		setTimeout(function(){ context() },1000);
	});
	
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



/*
|----------------------------------------------------------------------------
| Remove Travel Request
|---------------------------------------------------------------------------
|
| Remove the whole Trave Request including passengers and itenerary.
| DO NOT CALL THIS FUNCTION UNLESS DATA IS NOT USABLE.EFFECT OF THIS FUNCTION IS UNRECOVERABLE 
|
*/

function removePersonalTravelRequest(id){

	    	$('.modal-submit').on('click',function(){

	    		//loading
	    		previewLoadingEffect()
	    		
	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		$(this).html('Removing . . .')

	    		$.ajax({

	    			url:'api/travel/personal/'+id,
	    			method:'DELETE',
	    			data: { _token: $("input[name=_token]").val()},
	    			success:function(data){
	    				if(data==1){
	    					//ajax here
				    		setTimeout(function(){

				    			$('.preview-content').fadeOut()

				    			var nextItem=$(selectedElement).next();
				    			$(selectedElement).remove();

				    			//select next
				    			$(nextItem).click()
				    			
				    		},1000)

				    		$('#preview-modal').modal('hide');
	
	    				}else{
	    					alert('Oops! Something went wrong.Try to refresh the page')
	    				}
	    			}
	    		})

	    		
	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	
}



/*
|----------------------------------------------------------------------------
| Remove passengers
|---------------------------------------------------------------------------
|
| Remove all passengers from the travel request. This functions must be called with extra caution.
|
*/

function removePersonalTravelPassengerStaff(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){
	    		removeContextListElement('api/travel/personal/staff/',id);
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}


function removePersonalTravelPassengerScholar(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){
	    		removeContextListElement('api/travel/personal/scholars/',id);
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}


function removePersonalTravelPassengerCustom(id){
	
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/personal/custom/',id);
	    })
	});

	$('#preview-modal').modal('toggle');

	
}



/*
|----------------------------------------------------------------------------
| Remove Itenerary
|---------------------------------------------------------------------------
|
| Remove the travel from the list.DO NOT USE THIS on the closed travel
|
*/



function removePersonalTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/personal/itenerary/',id);
	    })
	});

	$('#preview-modal').modal('toggle');
	
}







/*
|----------------------------------------------------------------------------
| REMOVE BINDING
|---------------------------------------------------------------------------
|
| Bind the function into the front end.
|
*/


function bindRemoveStaff(){
	$('.removeOfficialPassengerButton').off('click');
	$('.removeOfficialPassengerButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelPassengerStaff(context)
	})
}
function bindRemovePersonalScholar(){
	$('.removeOfficialScholarButton').off('click');
	$('.removeOfficialScholarButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelPassengerScholar(context)
	})
}

function bindRemovePersonalCustom(){
	$('.removeOfficialCustomButton').off('click');
	$('.removeOfficialCustomButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelPassengerCustom(context)
	})
}


function bindRemoveItenerary(){
	$('.removeIteneraryButton').off('click');
	$('.removeIteneraryButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelItenerary(context)
	})
}



function bindRemovePersonalPreview(){
	$('.preview-remove').off('click');
	$('.preview-remove').on('click',function(){
	//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
			//remove
			removePersonalTravelRequest($(selectedElement).attr('id'))
		})	
	})
}




/*
|----------------------------------------------------------------------------
| UPDATE PREVIEW BINDING
|---------------------------------------------------------------------------
*/

function bindUpdatePersonalPreview(){

	//remove previous handler
	$('.preview-update').off('click');
	$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ 
			$('#editor').load('travel/personal/editor/'+$(selectedElement).attr('id'),function(){
				var id=$(selectedElement).attr('id');

				showPersonalTravelListPreview(id)
				showPersonalTravelPassengerStaffPreview(id)
				showPersonalTravelPassengerScholarsPreview(id)
				showPersonalTravelPassengerCustomPreview(id)

				setTimeout(function(){
					bindRemoveStaff();
					bindRemoveItenerary();
					bindRemovePersonalScholar()
					bindRemovePersonalCustom()
				},2000)
			}); 
		},100);
	})
}






