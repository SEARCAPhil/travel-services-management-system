

/**
* OFFICIAL TRAVEL REQUEST PREVIEW SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/

/*
|--------------------------------------------------------------------------
| Application Settings
|--------------------------------------------------------------------------
|
| Define varables used in different functions related to preview page
| removing these variables will trigger an error when using some functions. This 
| is also shared to other travel requests
|
*/





/*
|----------------------------------------------------------------------------
| Hold data for travel request preview
|---------------------------------------------------------------------------
|
| JSON from preview page AJAX request 
|
*/

var preview;
var scholars;
var staff;



var ttURL='/trs/public/travel/official/print/trip_ticket';



/*
|----------------------------------------------------------------------------
| Count Variable
|---------------------------------------------------------------------------
|
| Total count for passengers and itenerary 
|
*/
var passenger_count=0;
var itenerary_count=0;
var official_travel_custom_passenger;
var official_travel_itenerary;


/*
|----------------------------------------------------------------------------
| Form Id
|---------------------------------------------------------------------------
|
| This must be equivalent to Travel Request ID. This is the variable used to determine
| if the request is coming from a form. If form is empty, form_id is equal to zer(0).
| The value of variable must be changed to the last insert id of the previos CREATE operation
| so that the application will know that item is already added in the database.
|
| This is useful if form require an UPDATE after an INSERT operation
|
*/
var form_id=0;



/*
|----------------------------------------------------------------------------
| AJAX preview functions
|---------------------------------------------------------------------------
|
| Contains logic in sending the data used by showOfficialTravelListPreview() function 
|
|
*/

function ajax_getOfficialTravelListPreview(id,callback){
	$.get('api/travel/official/preview/'+id,function(json){
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
| This is called allong with showOfficialTravelPassenger.*() functions
|
*/

function ajax_getOfficialTravelPassengerScholarsPreview(id,callback){

	$.get('api/travel/official/scholars/'+id,function(json){
		scholars=JSON.parse(json)
		callback(scholars);
		return scholars;
	})

}

function ajax_getOfficialTravelPassengerStaffPreview(id,callback){

	$.get('api/travel/official/staff/'+id,function(json){
		staff=JSON.parse(json)
		callback(staff);
		return staff;
	})
}

function ajax_getOfficialTravelPassengerCustomPreview(id,callback){

	$.get('api/travel/official/custom/'+id,function(json){
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
| Get the official travel request's itenerary
|
|
*/

function ajax_getOfficialTravelItenerary(id,callback){
	$.get('api/travel/official/itenerary/'+id,function(json){
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
| Determine Admin privilege
|---------------------------------------------------------------------------
|
| Return true if current session privilege is administrator
|
|
*/

function isAdmin(){
	var priv=localStorage.getItem('priv');
	return priv==='admin';
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

function showOfficialTravelListPreview(id){
	//call ajax function 
	ajax_getOfficialTravelListPreview(id,function(json){

		$('.preview-id').html(json[0].tr)
		$('.preview-name').html(json[0].profile_name)
		$('.preview-unit').html(json[0].department)
		$('.preview-created').html(((json[0].date_created).split(' '))[0])
		$('.preview-purpose').html(json[0].purpose.replace(/[\n]/g,'<br/>'))
		$('.preview-cash-advance').html(' &emsp;&emsp;<b>'+json[0].source_of_fund_value+'</b>')

		if(json[0].notes){
			var n=json[0].notes.replace(/[\n]/g,'<br/>');
			$('.preview-notes').html(n)
		}
		
		$('input[name="vtype"]').each(function(index,el){
			if(el.value==json[0].vehicle_type) $(el).attr('checked','checked')
			
		})

		
			$('input[name="mode-of-payment"]').each(function(index,el){
				if(json[0].mode_of_payment=='cash'&&el.value=='cash'){
					$(el).attr('checked','checked')
				}else if(json[0].mode_of_payment=='sd'&&el.value=='sd'){
					$(el).attr('checked','checked')
				}else{

				}
			})
		
		if(json[0].request_type=='official'||json[0].request_type=='campus'){
			$('.show-for-trp-only').hide()
		}else{
			$('.show-for-trp-only').show()
		} 

		
		//.attr('checked','checked')
		//
		if(json[0].request_type=="official") $('.preview-print').attr('href','travel/official/print/travel_request/'+json[0].tr)
		if(json[0].request_type=="personal") $('.preview-print').attr('href','travel/personal/print/travel_request/'+json[0].tr)
		if(json[0].request_type=="campus") $('.preview-print').attr('href','travel/campus/print/travel_request/'+json[0].tr)

		

		//hide projects for opf
		if(json[0].source_of_fund!='opf'){
			for(var x=0;x<json[0].projects.length;x++){
				$('.preview-cash-advance').append('&emsp;<p>'+json[0].projects[x].project+'</p>');
			}	
		}

		

		//--------------------------------------
		// Check for valid status
		// 0 - Not yet send
		// 1 - Sent
		// 2 - Verified
		// 3 - Returned to sender
		// 4 - Closed
		// --------------------------------------

		if(typeof json[0].status!=undefined){


			if(json[0].status==0){		
				//allow forwarding
				bindForwardOfficial()

				//allow updating
				bindUpdateOfficialPreview()
				bindRemoveOfficialPreview()

				//enable command buttons
				enableStatusDefaultButtonCommandGroup()
							
			}


			if(preview[0].status==1){

				if(isAdmin()){
					//allow admin to verify or returned the request to the sender
					showUntouchedStatusAdmin()
					bindVerifyOfficial();
					bindReturnOfficial();

				}else{
					//Show waiting for confirmation status
					showVerifyStatus();
				}

			}


			if(preview[0].status==2){

				if(isAdmin()){
					//show a close or return to sender status
					showVerifyStatusAdmin();
					bindReturnOfficial()
					bindCloseOfficial()

				}else{
					//show VERIFIED status to the ordinary user
					showVerifiedStatus();
				}

			}


			


			//returned status
			if(preview[0].status==3){
				//show returned status to both admin and user

				//allow the user to update the request
				showReturnStatus()
				enableStatusDefaultButtonCommandGroup()

				
				bindForwardOfficial()
				bindUpdateOfficialPreview()
				unbindRemoveOfficialPreview()
				
			}


			//close status
			if(preview[0].status==4){
				showClosedStatus()
			}
		}

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

function showOfficialTravelPassengerStaffPreview(id){
	ajax_getOfficialTravelPassengerStaffPreview(id,function(staff){

			
			for(var x=0;x<staff.length;x++){
				passenger_count++;
				showTotalPassengerCount()
				var htm=`<tr data-menu="staffPassengerMenu" context="0" data-selection="`+staff[x].id+`" id="official_travel_staff_passenger_tr`+staff[x].id+`" class="contextMenuSelector official_travel_staff_passenger_tr`+staff[x].id+`">
									<td>
										<div class="col col-md-9"><b>`+staff[x].name+`</b></div>
									</td>

									
								<td>`+((staff[x].designation==null)?'N/A':staff[x].designation)+`</td>
								<td>`+((staff[x].office==null)?'N/A':staff[x].office)+`</td>
								</tr>`
				$('.preview-passengers').append(htm)
			}
			
			setTimeout(function(){ context() },1000);
			setTimeout(function(){
				if(passenger_count<=0){
					//$('.preview-passengers').parent().html('<center><h3>Empty Passenger</h3><p class="text-muted">This request do not have any passenger.Please select person from the list.</p></center>')
				}

			},5000)

	});
	
}



function showOfficialTravelPassengerScholarsPreview(id){
	
	ajax_getOfficialTravelPassengerScholarsPreview(id,function(scholars){
		
		for(var x=0;x<scholars.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			var htm=''
			 htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+scholars[x].id+`" id="official_travel_scholars_passenger_tr`+scholars[x].id+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+scholars[x].id+`">
								<td>
									
									<div class="col col-md-9"><b>`+scholars[x].full_name+`</b></div>
								</td>

								
								<td>`+scholars[x].nationality+`</td>
								<td>`+scholars[x].office+`</td>
							</tr>`
			$('.preview-passengers').append(htm);
			
		}

		
		setTimeout(function(){ context() },2000);	
	});
	
}



function showOfficialTravelPassengerCustomPreview(id){
	ajax_getOfficialTravelPassengerCustomPreview(id,function(official_travel_custom_passenger){
		
		var htm='';	
		for(var x=0;x<official_travel_custom_passenger.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			htm=`<tr data-menu="customPassengerMenu" data-selection="`+official_travel_custom_passenger[x].id+ `" id="official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`" class="contextMenuSelector official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`">
								<td>
								
									<div class="col col-md-9"><b>`+official_travel_custom_passenger[x].full_name+`</b></div>
								</td>
								<td>`+official_travel_custom_passenger[x].designation+`</td>
								<td>N/A</td>
							</tr>`

			$('.preview-passengers').append(htm)
		}
		
		setTimeout(function(){ context() },1000);
	});
	
}




/*
|----------------------------------------------------------------------------
| Display travel list
|---------------------------------------------------------------------------
|
| Show all itenerary related to the travel request
|
*/

function showOfficialTravelItenerary(id){
	ajax_getOfficialTravelItenerary(id,function(official_travel_itenerary){
		itenerary_count=0;
		for(var x=0; x<official_travel_itenerary.length;x++){
			itenerary_count++;
			showTotalIteneraryCount();


			//printables
			if(official_travel_itenerary[x].request_type=="official") ttURL='travel/official/print/trip_ticket'
			if(official_travel_itenerary[x].request_type=="personal") ttURL='travel/personal/print/statement_of_account'
			if(official_travel_itenerary[x].request_type=="campus") ttURL='travel/campus/print/notice_of_charges'

			var htm=`<details id="official_travel_itenerary`+official_travel_itenerary[x].id+`" data-menu="iteneraryMenu" data-selection="`+official_travel_itenerary[x].id+ `" class="contextMenuSelector official_travel_itenerary`+official_travel_itenerary[x].id+` col col-md-12">
					<summary>`+official_travel_itenerary[x].location+` - `+official_travel_itenerary[x].destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td><a href="#" onclick="event.preventDefault();window.open('${ttURL}/${official_travel_itenerary[x].id}');">`+official_travel_itenerary[x].location+`</a></td>
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


		if(itenerary_count<=0){
			$('.preview-itenerary').html('<center><i class="material-icons md-36">directions_car</i><h3>Empty Itinerary</h3><p class="text-muted">Add new destination to your request.</p></center>')
		}

		setTimeout(function(){ context() },1000);
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

function removeOfficialTravelRequest(id){

	$('.modal-submit').on('click',function(){

		//loading
		previewLoadingEffect()
		
		//disable onclick
		$(this).attr('disabled','disabled')

		$(this).html('Removing . . .')

		$.ajax({
			url:'api/travel/official/'+id,
			method:'DELETE',
			data: { _token: $("input[name=_token]").val()},
			success:function(data){
				if(data==1){
					//ajax here
		    		setTimeout(function(){

		    			$('.preview-content').fadeOut()
		    			$('.preview-section').html('<center style="margin-top:10vh;"><h3 class="text-danger"><i class="material-icons">check_circle</i> Deleted successfully!</h3><p>This request was deleted from the database and no longer link in any other request</p></center>')

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

function removeOfficialTravelPassengerCustom(id){
	
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/custom/',id);
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerScholar(id){

	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/scholar/',id);
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerStaff(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){
	    		removeContextListElement('api/travel/official/staff/',id);
	    	})
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


function removeOfficialTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/itenerary/',id);
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
		removeOfficialTravelPassengerStaff(context)
	})
}
function bindRemoveOfficialScholar(){
	$('.removeOfficialScholarButton').off('click');
	$('.removeOfficialScholarButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelPassengerScholar(context)
	})
}
function bindRemoveOfficialCustom(){
	$('.removeOfficialCustomButton').off('click');
	$('.removeOfficialCustomButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelPassengerCustom(context)
	})
}
function bindRemoveItenerary(){
	$('.removeIteneraryButton').off('click');
	$('.removeIteneraryButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelItenerary(context)
	})
}

function bindRemoveOfficialPreview(){

	$('.preview-remove').off('click');
	$('.preview-remove').on('click',function(){
		//call custom bootstrap dialog
			showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
				//remove
				removeOfficialTravelRequest($(selectedElement).attr('id'))

			})
			
	})

}




/*
|----------------------------------------------------------------------------
| UPDATE BINDING
|---------------------------------------------------------------------------
|
| Bind the function into the front end.
|
*/
function bindUpdateOfficialPreview(){

	$('.preview-update').on('click',function(){
			$('#editorTab').click();
			//loading
		    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
			setTimeout(function(){ 
				$('#editor').load('travel/official/editor/'+$(selectedElement).attr('id'),function(){
					var id=$(selectedElement).attr('id');
					showOfficialTravelListPreview(id);
					showOfficialTravelPassengerStaffPreview(id)
					showOfficialTravelPassengerScholarsPreview(id)
					showOfficialTravelPassengerCustomPreview(id)
					showOfficialTravelItenerary(id)

					setTimeout(function(){
						bindRemoveStaff();
						bindRemoveItenerary();
						bindRemoveOfficialScholar();
						bindRemoveOfficialCustom();
					},2000)
					

				}); 

			},100);
	})


}


function printOfficialTravelRequest(id){
	window.open('travel/official/print.php?id='+id);
}




function unbindRemoveOfficialPreview(){

	$('.preview-remove').off('click');
	$('.preview-remove').attr('disabled','disabled').addClass('disabled')
};


function unbindUpdateOfficialPreview(){

	$('.preview-update').off('click');
	$('.preview-update').attr('disabled','disabled').addClass('disabled')
}


function unbindForwardOfficial(){
	$('.preview-forward').off('click');
	$('.preview-forward').attr('disabled','disabled').addClass('disabled')
}



