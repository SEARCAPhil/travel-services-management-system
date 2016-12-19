/*callback for selecting an item from directory list
* This must be only present on this page to avoid conflict
*/

function appendStaffToListPreview(jsonData){

	var data=JSON.parse(jsonData)

	//ajax here
	$.post('api/directory/personal/staff',{id:$(selectedElement).attr('id'),_token:$('input[name=_token]').val(),uid:data.uid},function(res){

		if(res>0){

			var htm=` <tr data-menu="staffPassengerMenu" context="0" data-selection="`+res+`" id="official_travel_staff_passenger_tr`+res+`" class="contextMenuSelector official_travel_staff_passenger_tr`+res+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+data.profile_image+`" data-mode="staff"></div></div>
									<div class="col col-md-9"><b>`+data.name+`</b></div></td>

								
								<td>`+data.designation+`</td>
								<td>`+data.office+`</td>
							</tr>`
			$('.preview-passengers').append(htm)


			setTimeout(function(){ unbindContext(); context(); },1000);

			appendStaffToListPreviewCallback(data);



		}

	})

}


function appendStaffToListPreviewCallback(data){
	//itenerary enable button on forms
	changeCircleState('.itenerary-circle-group')
	changeButtonState('#iteneraryFormButton','enabled')
}

function appendIteneraryToListPreviewCallback(data){
	changeCircleState('.vehicle-circle-group')
	changeButtonState('.vehicleTypeFormButton','enabled')

	//include mode of payment
	changeCircleState('.payment-circle-group')
	changeButtonState('.paymentFormButton','enabled')
}




