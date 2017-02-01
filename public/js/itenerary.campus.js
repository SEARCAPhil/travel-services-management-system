/**
* CAMPUS TRAVEL REQUEST ITENERARY SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/


/*
|----------------------------------------------------------------------------
| Append Itenerary Confirmation
|---------------------------------------------------------------------------
|
| Shows confirmation dialog before appending item to itenerary 
|
*/

function appendIteneraryListPreviewConfirmation(){
	//dialog
	var htm=`<br/><br/><div class="col col-md-12"><h4>Are you sure you want to add this to your itenerarys?</h4>
		<button class="btn btn-danger" id="iteneraryConfirmationButton"><span class="glyphicon glyphicon-ok"></span>&nbsp;Yes</button> <button class="btn btn-default" id="iteneraryConfirmationButtonCancel">No</button>
	</div>`

	$('#itenerary-dialog-content').hide();
	$('#itenerary-confirmation').html(htm)
	
	//add event handler in confirmation button
	$('#iteneraryConfirmationButton').click(function(){
		
		$(this).html('saving . . .')
		var that=this

		//Input value
		var origin=$('#officialTravelOrigin').val();
		var destination=$('#officialTravelDestination').val();
		var departure_date=$('#officialTravelDepartureDate').val();
		var departure_time=$('#officialTravelDepartureTime').val();
		var date=new Date();
		var date_created=date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate();
		var driver=$('#officialTravelDriver').val();

		var tr_id=form_id

		if(typeof $(selectedElement).attr('id')!='undefined') tr_id=$(selectedElement).attr('id');


		//JSON data
		var data={"id":null,"tr_id":tr_id,"res_id":null,"location":origin,"destination":destination,"departure_time":departure_time,"actual_departure_time":"00:00:00","returned_time":"00:00:00","departure_date":departure_date,"returned_date":"0000-00-00","status":"scheduled","plate_no":null,"driver_id":"0","linked":"no","date_created":date_created,driver_id:driver,_token:$('input[name=_token]').val()}


		//------------------------------------
		// Adding itenerary for the first time
		// This allows to determine if a new epty travel requested should be created 
		// before adding itenerary on the database or there is an existing
		// If so, an item on the list is selected so we must use its ID
		//------------------------------------
		if(form_id==0){

			$.post('api/travel/campus',data,function(result){
				//check if no error
				if(result>0&&result.length<50){
					//assign to form_id
					form_id=result

					//assign to result for backup
					data.tr_id=result

					//change ID of the selected element
					//Application will now assumed that there is selected item
					$(selectedElement).attr('id',result)

					//clear itenerary fields
					//Campus only allow only one itenerary so we must clear it befording appending new item
					appendIteneraryListPreviewConfirmationDone(data)

				}else{
					alert('Oops!Something went wrong.Please try again later');
				}

			})

		}else{

			appendIteneraryListPreviewConfirmationDone(data)
		}
			

		//show form
		setTimeout(function(){

			$('#itenerary-modal').modal('hide');
			//clear form

			//display default view
			$('#itenerary-dialog-content').show();
			$('#itenerary-confirmation').html('')
		},900)
	})

	//cancel
	$('#iteneraryConfirmationButtonCancel').click(function(){
		//show form
		setTimeout(function(){

			//display default view
			$('#itenerary-dialog-content').show();
			$('#itenerary-confirmation').html('')
		},900)
	});
}


/*
|----------------------------------------------------------------------------
| Append Itenerary Confirmation Done
|---------------------------------------------------------------------------
|
| Clear itenerary and allow only one item on the list
|
*/

function appendIteneraryListPreviewConfirmationDone(data){
	//post actual itenerary
	$.post('api/travel/campus/itenerary',data,function(res){

		try{

			var id=JSON.parse(res).id;
			data.id=id;
			//add to preview
			appendIteneraryToListPreview(data,function(data){
				$('#iteneraryConfirmationButton').html('saved')
				//clear form
				$('#officialTravelOrigin').val('');
				$('#officialTravelDestination').val('');
				$('#officialTravelDepartureDate').val('');
				$('#officialTravelDepartureTime').val('');
				//enabling context
				unbindContext();
				context();

				//enable context modal
				setTimeout(function(){
						bindRemoveItenerary();
				},800);
				
				//calback
				appendIteneraryToListPreviewCallback(data);
			})


		}catch(e){
			alert('Something went wrong.Please try again later!');
		}

	});	
}


