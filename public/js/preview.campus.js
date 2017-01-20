/**
* @title CAMPUS TRAVEL REQUEST PREVIEW SCRIPT
* @author Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/



/*
|----------------------------------------------------------------------------
| AJAX preview functions
|---------------------------------------------------------------------------
|
| Contains logic in sending the data used by show  function 
|
|
*/

function ajax_getCampusTravelListPreview(id,callback){
	$.get('api/travel/campus/preview/'+id,function(json){
		preview=JSON.parse(json)
		callback(preview);
		return preview;
	})
}



/*
|----------------------------------------------------------------------------
| AJAX itenerary functions
|---------------------------------------------------------------------------
|
| Get travel request's itenerary
|
|
*/
function ajax_getCampusTravelItenerary(id,callback){
	$.get('api/travel/campus/itenerary/'+id,function(json){
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
| unit and date
|
|
*/

function showCampusTravelListPreview(id){
	ajax_getCampusTravelListPreview(id,function(json){
		$('.preview-id').html(json[0].id)
		$('.preview-name').html(json[0].profile_name)
		$('.preview-unit').html(json[0].department)
		$('.preview-created').html(((json[0].date_created).split(' '))[0])
		$('.preview-print').attr('href','travel/campus/print/notice_of_charges/'+json[0].id)


		if(typeof json[0].status!=undefined){

			if(json[0].status==0){		
				//allow forwarding
				bindForwardCampus()

				//allow updating
				bindUpdateCampusPreview()
				bindRemoveCampusPreview()

				//enable command buttons
				enableStatusDefaultButtonCommandGroup()
							
			}


			if(json[0].status==1){

				if(isAdmin()){
					//allow admin to verify or returned the request to the sender
					showUntouchedStatusAdmin()
					bindVerifyCampus();
					bindReturnCampus();

				}else{
					//Show waiting for confirmation status
					showVerifyStatus();
				}

			}


			if(json[0].status==2){

				if(isAdmin()){
					//show a close or return to sender status
					showVerifyStatusAdmin();
					bindReturnCampus()
					bindCloseCampus()

				}else{
					//show VERIFIED status to the ordinary user
					showVerifiedStatus();
				}

			}


			


			//returned status
			if(json[0].status==3){
				//show returned status to both admin and user

				//allow the user to update the request
				showReturnStatus()
				bindForwardCampus()
				bindUpdateCampusPreview()
				bindRemoveCampusPreview()
				enableStatusDefaultButtonCommandGroup()
			}


			//close status
			if(json[0].status==4){
				showClosedStatus()
			}
		}

		
	})
}



/*
|----------------------------------------------------------------------------
| Display travel list
|---------------------------------------------------------------------------
|
| Show all itenerary related to the travel request
|
*/


function showCampusTravelItenerary(id){
	ajax_getCampusTravelItenerary(id,function(official_travel_itenerary){
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
			setTimeout(function(){ context() },1000);
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

function removeCampusTravelRequest(id){

	    	$('.modal-submit').on('click',function(){

	    		//loading
	    		previewLoadingEffect()
	    		
	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		$(this).html('Removing . . .')

	    		$.ajax({

	    			url:'api/travel/campus/'+id,
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
| Remove Itenerary
|---------------------------------------------------------------------------
|
| Remove the travel from the list.DO NOT USE THIS on the closed travel
|
*/


function removeCampusTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/campus/itenerary/',id);
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

function bindRemoveItenerary(){
	$('.removeIteneraryButton').off('click');
	$('.removeIteneraryButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeCampusTravelItenerary(context)
	})
}


