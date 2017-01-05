/**
*Status update script
*
*
*
*/


//status update
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



function showClosedStatusAdmin(){
	var htm=`<div class="col col-md-12" style="background: rgb(0,150,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					<b>[READ-ONLY]</b> This Travel Request is already closed and only available for viewing.
				</p>
			</div>`;

	$('.preview-status-section').html(htm);
}

function showVerifyStatusAdmin(){

	var htm=`<div class="col col-md-12" style="background: rgb(0,150,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					Travel Request Verified!
					<button class="btn btn-xs btn-success preview-return">Return to sender <span class="glyphicon glyphicon-inbox"></span></button> Or
					<button class="btn btn-xs btn-success preview-close">Mark as <u>Closed</u> <span class="glyphicon glyphicon-lock"></span></button> 
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}

function showUntouchedStatusAdmin(){
	var htm=`

			<div class="col col-md-12" style="background: rgb(255,60,60);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request is not yet verified. Please review and accept this request.
					<button class="btn btn-xs btn-danger preview-verify"> Verify <span class="glyphicon glyphicon-ok"></span></button> 
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}

function showUntouchedStatus(){
	var htm=`

			<div class="col col-md-12" style="background:rgba(250,250,250,0.8);color:rgb(150,150,150);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request has not yet viewed or verified. 				
					<button class="btn btn-xs btn-danger preview-forward preview-command">Send <span class="glyphicon glyphicon-send"></span></button>
				</p>
			</div>`;
	$('.preview-status-section').html(htm);

	//bind forward button
	bindForwardOfficial()
}

function showVerifyStatus(){

	var htm=`<div class="col col-md-12" style="background: rgb(0,150,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request is waiting for verification
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}

function showReturnStatusAdmin(){
	var htm=`

			<div class="col col-md-12" style="background: rgb(255,60,60);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request was returned. 
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}


function showReturnStatus(){
	var htm=`

			<div class="col col-md-12" style="background: rgb(255,60,60);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request was returned by admin.Please review the request before resending.
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}


function showClosedStatus(){
	var htm=`<div class="col col-md-12" style="background: rgb(100,100,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request is already closed. <span class="glyphicon glyphicon-lock"></span>
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}




function bindVerifyOfficial(){
	$('.preview-verify').on('click',function(){

			//call custom bootstrap dialog
			showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/verify',function(){
				//verify
				verifyOfficialTravelRequest()

			})
	})
}

function bindForwardOfficial(){
	$('.preview-forward').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/forward',function(){
			//forward
			forwardOfficialTravelRequest()

		})
	})

}


function bindReturnOfficial(){
	$('.preview-return').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/return',function(){
			//forward
			returnOfficialTravelRequest()

		})
	})

}


function bindCloseOfficial(){
	$('.preview-close').on('click',function(){
		//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/close',function(){
			//forward
			closeOfficialTravelRequest()

		})
	})

}

