/**
* STATUS UPDATE SCRIPT FOR PERSONAL TRAVEL REQUEST
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
* Send and closed travel request
*/




/*
|----------------------------------------------------------------------------
| AJAX Update status
|---------------------------------------------------------------------------
|
| Update status of the travel request
|
|
*/

function ajax_updateTravelStatusPreview(url,id,status,callback){
	//ajax here
	$.ajax({
		url:url+''+id,
		method:'PUT',
		data: { _token: $("input[name=_token]").val(),id:id,status:status},
		success:function(data){
			if(data>0){

				//callback
				callback(data)

	    		$('#preview-modal').modal('hide');

			}else{
				alert('Something went wrong.Please try again later')
				//back to original
				$(this).attr('enabled','enabled')
				$('#preview-modal').modal('hide');
			}
		}
	})
}


/*
|----------------------------------------------------------------------------
| Update status bar (ADMIN)
|---------------------------------------------------------------------------
|
| Display different status of the travel request. These functions are restricted to administrator
| and should not be exposed to ordinary user. Displaying status relies on the current status as follows
|
|		--------------------------------------
|		 For Admin
|		 0 - N/A (For ordinary user only)
|		 1 - showUntouchedStatusAdmin()
|		 2 - showVerifyStatusAdmin()
|		 3 - showReturnStatusAdmin()
|		 4 - showClosedStatus() (applies aso to ordinary user)
|		 --------------------------------------
*/

function showUntouchedStatusAdmin(){
	var htm=`
			<div class="col col-md-11">
				<p>
					<button class="btn btn-xs btn-danger preview-return">Return to sender <span class="glyphicon glyphicon-inbox"></span></button> Or
					<button class="btn btn-xs btn-danger preview-verify"> Accept <span class="glyphicon glyphicon-ok"></span></button>
				</p>
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}



function showVerifyStatusAdmin(){

	var htm=`
			<div class="col col-md-11">
				<p>
					
					<button class="btn btn-xs btn-danger preview-return">Return to sender <span class="glyphicon glyphicon-inbox"></span></button> Or
					<button class="btn btn-xs btn-danger preview-close">Mark as <u>Closed</u> <span class="glyphicon glyphicon-lock"></span></button> 
				</p>
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
		//bind
	bindReturnPersonal()
	bindClosePersonal();
}


function showClosedStatusAdmin(){
	var htm=`<div class="col col-md-12" style="margin-bottom: 20px;padding: 5px;">
				<p>
					 This Travel Request is already closed and only available for viewing.
				</p>
			</div>`;

	$('.preview-status-section').fadeIn().html(htm);
}



function showReturnStatusAdmin(){
	var htm=`

			<div class="col col-md-12">
				
					<i class="material-icons md-18">undo</i> This Travel Request was returned. 
				
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}




function showClosedStatus(){
	var htm=`
			<div class="col col-md-11">
				<p>
					<div class="status-markings gray">
						 <span class="glyphicon glyphicon-lock"></span>
					</div>	
					This Travel Request is already closed.
				</p><br/>
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}




/*
|----------------------------------------------------------------------------
| Update status bar (ORDINARY USER)
|---------------------------------------------------------------------------
|
| Display different status of the travel request. These functions are for
| ordinary users
|
|		--------------------------------------
|		 For Admin
|		 0 - N/A
|		 1 - showVerfyStatus()
|		 2 - showVerifiedStatus() <if verified by admin>
|		 3 - showReturnStatus()
|		 4 - showClosedStatus()
|		 --------------------------------------
|
| showUntouchedStatus() will be only use if the travel request is not yet send within 3 days
*/




function showUntouchedStatus(){
	var htm=`

			<div class="col col-md-12" style="background:rgba(250,250,250,0.8);color:rgb(150,150,150);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request has not yet viewed or verified. 				
					<button class="btn btn-xs btn-danger preview-forward preview-command">Send <span class="glyphicon glyphicon-send"></span></button>
				</p>
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);

	//bind forward button
	bindForwardOfficial()
}



function showVerifyStatus(){

	var htm=`
			<div class="col col-md-12">
				<p>
					This Travel Request is waiting for verification
				</p>
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}

function showVerifiedStatus(){

	var htm=`
			<div class="col col-md-11">
				<p>
					<i class="material-icons md-18">check_circle</i> This Travel Request has been verified.
				</p>

			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}



function showReturnStatus(){
	var htm=`
			<div class="col col-md-11" style="margin-bottom: 20px;">

				
					<i class="material-icons md-18">undo</i> This Travel Request was returned by admin.Please review the request before resending.
				
			</div>`;
	$('.preview-status-section').fadeIn().html(htm);
}







/*
|----------------------------------------------------------------------------
| Status Commands
|---------------------------------------------------------------------------
|
| This is used to change the status of the travel request. Some of this could not be used
| if the status of the request is not equal to 0 (not yend send) or 3(returned by the admin)
|
*/

function forwardPersonalTravelRequest(){
	
	$('.modal-submit').on('click',function(){

		//loading
	    previewLoadingEffect()
	    		
	    //disable onclick
	    $(this).attr('disabled','disabled')

	    //ajax here
	    ajax_updateTravelStatusPreview('api/travel/personal/status/',$(selectedElement).attr('id'),1,function(data){

	    	if(data==1){
	    		//change status
	    		if(isAdmin()){
					showUntouchedStatusAdmin()

					//rebind buttons
					setTimeout(function(){
						bindReturnPersonal()
						bindVerifyPersonal()
					},1000)
					
				}else{
					showVerifyStatus();


					//remove bindings
					unbindRemovePersonalPreview();
					unbindForwardPersonal()
					unbindUpdatePersonalPreview()
				}
	    	}else{
	    		//show error
	    		alert('Oops!Something went wrong.Please try again later.')
	    	}
		})


	    $('#preview-modal').modal('hide');

	    //back to original
	    $(this).attr('disabled','enabled')
	})
	
}


function verifyPersonalTravelRequest(id){
	
	$('.modal-submit').on('click',function(){

		//loading
	    previewLoadingEffect()
	    		
	    //disable onclick
	    $(this).attr('disabled','disabled')

 		ajax_updateTravelStatusPreview('api/travel/personal/status/',$(selectedElement).attr('id'),2,function(data){

	    	if(data==1){
	    		//change status
	    		if(isAdmin()){
					showVerifyStatusAdmin();
				}else{
					showVerifyStatus();
				}
	    	}else{
	    		//show error
	    		alert('Oops!Something went wrong.Please try again later.')
	    	}
		})


	    $('#preview-modal').modal('hide');
	    //back to original
	    $(this).attr('disabled','enabled')
	})
	
}


function returnPersonalTravelRequest(){
	
	$('.modal-submit').on('click',function(){

		//loading
	    previewLoadingEffect()
	    		
	    //disable onclick
	    $(this).attr('disabled','disabled')

	    //ajax here

	    ajax_updateTravelStatusPreview('api/travel/personal/status/',$(selectedElement).attr('id'),3,function(data){

	    	if(data==1){
	    		//change status
	    		if(isAdmin()){
					showReturnStatusAdmin()

					//hide section
					setTimeout(function(){
				    	$('.preview-content').fadeOut()
				    	$(selectedElement).remove();		
				    },1000)
				}

	    	}else{
	    		//show error
	    		alert('Oops!Something went wrong.Please try again later.')
	    	}
		})


	    $('#preview-modal').modal('hide');

	    //back to original
	    $(this).attr('disabled','enabled')
	})
	
}



function closePersonalTravelRequest(){
	
	$('.modal-submit').on('click',function(){

		//loading
	    previewLoadingEffect()
	    		
	    //disable onclick
	    $(this).attr('disabled','disabled')

	    //ajax here

	    ajax_updateTravelStatusPreview('api/travel/personal/status/',$(selectedElement).attr('id'),4,function(data){

	    	if(data==1){
	    		
					showClosedStatus();
					$(selectedElement).addClass('closed')
				
	    	}else{
	    		//show error
	    		alert('Oops!Something went wrong.Please try again later.')
	    	}
		})


	    $('#preview-modal').modal('hide');

	    //back to original
	    $(this).attr('disabled','enabled')
	})
	
}




/*
|----------------------------------------------------------------------------
| COMMAND BINDING
|---------------------------------------------------------------------------
|
| Bind commands to each respective buttons
|
*/

function bindVerifyPersonal(){
	$('.preview-verify').off('click');
	$('.preview-verify').on('click',function(){

			//call custom bootstrap dialog
			showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/verify',function(){
				//verify
				verifyPersonalTravelRequest()

			})
	})
}

function bindForwardPersonal(){
	$('.preview-forward').off('click');
	$('.preview-forward').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/forward',function(){
			//forward
			forwardPersonalTravelRequest()

		})
	})

}


function bindReturnPersonal(){

	$('.preview-return').off('click');
	$('.preview-return').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/return',function(){
			//forward
			returnPersonalTravelRequest()

		})
	})

}


function bindClosePersonal(){
	$('.preview-close').off('click');
	$('.preview-close').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/close',function(){
			//forward
			closePersonalTravelRequest()

		})
	})

}


function enableStatusDefaultButtonCommandGroup(){
	$('.preview-remove').removeClass('disabled');
	$('.preview-update').removeClass('disabled');
	$('.preview-forward').removeClass('disabled');
}

