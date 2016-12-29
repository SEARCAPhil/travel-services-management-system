

function appendStaffToListPreview(jsonData){
	var data=JSON.parse(jsonData)

	//ajax here
	$.post('api/directory/staff',{id:$(selectedElement).attr('id'),_token:$('input[name=_token]').val(),uid:data.uid},function(res){

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
			//enable context modal
			setTimeout(function(){
					bindRemoveStaff();
			},2000);
			appendStaffToListPreviewCallback(data);



		}

	})

}

function appendScholarToListPreview(jsonData){
	var data=JSON.parse(jsonData)


	//ajax here
	$.post('api/directory/scholars',{id:$(selectedElement).attr('id'),_token:$('input[name=_token]').val(),uid:data.uid},function(res){

		if(res>0){


			var htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+res+`" id="official_travel_scholars_passenger_tr`+res+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+data.uid+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+data.profile_image+`" data-mode="scholars"></div></div>
									<div class="col col-md-9"><b>`+data.full_name+`</b></div></td>

								
								<td>`+data.nationality+`</td>
								<td>N/A</td>
							</tr>`
			$('.preview-passengers').append(htm)

			setTimeout(function(){ unbindContext(); context(); bindRemoveOfficialScholar();  },1000);
			appendScholarToListPreviewCallback(data);



		}

	})


}


function appendCustomToListPreview(jsonData){
	var a={}
	a={id:1,full_name:'kenneth',designation:'director'}
	a.id=1;
	a.full_name='kenneth'
	a.designation="IT Director"
	var data=JSON.parse(JSON.stringify(jsonData))



	//ajax here
	$.post('api/directory/custom',{id:$(selectedElement).attr('id'),_token:$('input[name=_token]').val(),full_name:data.full_name,designation:data.designation},function(res){

		if(res>0){


		var htm=`<tr data-menu="customPassengerMenu" data-selection="`+res+ `" id="official_travel_custom_passenger_tr`+res+`" class="contextMenuSelector official_travel_custom_passenger_tr`+data.id+`">
						<td>
							<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="" data-mode="custom"></div></div>
							<div class="col col-md-9"><b>`+data.full_name+`</b></div></td>
						<td>`+data.designation+`</td>
						<td>N/A</td>
					</tr>`
		$('.preview-passengers').append(htm)

		setTimeout(function(){ unbindContext(); context(); bindRemoveOfficialCustom(); },1000);


		}

	}).fail(function(){
		alert('Oops something went wrong.Please try again later.')
	})



	
}


function appendCustomListPreviewConfirmation(){
	var htm=`<br/><br/><div class="col col-md-12"><h4>Are you sure you want to add this to the passenger list?</h4>
		<button class="btn btn-danger" id="customPassengerConfirmationButton"><span class="glyphicon glyphicon-ok"></span>&nbsp;Yes</button> <button class="btn btn-default" id="customPassengerConfirmationButtonCancel">No</button>
	</div>`


	var fullName=$('#customFullName').val();
	var designation=$('#customDesignation').val();

	if(fullName.length>0&&designation.length>0){
		$('#custom-dialog-content').hide();
		$('#custom-confirmation').html(htm)
	}


	$('#customPassengerConfirmationButton').click(function(){
		
		$(this).html('saving . . .')

		//insert to view
		var data={full_name:fullName,designation:designation,id:0}


		appendCustomToListPreview(data)

		//show form
		setTimeout(function(){

			$('#passenger-modal').modal('hide');
			//clear form
			$('#customFullName').val('')
			$('#customDesignation').val('')

			//display default view
			$('#custom-dialog-content').show();
			$('#custom-confirmation').html('')
		},1200)
	})

	//cancel
	$('#customPassengerConfirmationButtonCancel').click(function(){
		//show form
		setTimeout(function(){

			//display default view
			$('#custom-dialog-content').show();
			$('#custom-confirmation').html('')
		},1200)
	});
}

