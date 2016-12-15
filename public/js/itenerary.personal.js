/**append iteneray to list preview but the section must be emptied first
*Personal preview only allow only one itenerary
*/
function appendIteneraryToListPreview(jsonData,func){

	var json=jsonData;
	var data=JSON.parse(JSON.stringify(json))

	var htm=`<details id="official_travel_itenerary`+data.id+`" data-menu="iteneraryMenu" data-selection="`+data.id+ `" class="contextMenuSelector official_travel_itenerary`+data.id+` col col-md-12">
					<summary>`+data.location+` - `+data.destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>`+data.location+`</td>
								<td>`+data.destination+`</td>
								<td>`+data.departure_date+`</td>
								<td>`+data.departure_time+`</td>
							</tr>
						</tbody>
					</table>
				</details>
			`
	$('.preview-itenerary').html('')
	$('.preview-itenerary').append(htm)
	func(data);
	

}

function appendIteneraryListPreviewConfirmation(){
	var htm=`<br/><br/><div class="col col-md-12"><h4>Are you sure you want to add this to your itenerary?</h4>
		<button class="btn btn-danger" id="iteneraryConfirmationButton"><span class="glyphicon glyphicon-ok"></span>&nbsp;Yes</button> <button class="btn btn-default" id="iteneraryConfirmationButtonCancel">No</button>
	</div>`

	$('#itenerary-dialog-content').hide();
	$('#itenerary-confirmation').html(htm)
	


	$('#iteneraryConfirmationButton').click(function(){
		
		$(this).html('saving . . .')
		var that=this

		var origin=$('#officialTravelOrigin').val();
		var destination=$('#officialTravelDestination').val();
		var departure_date=$('#officialTravelDepartureDate').val();
		var departure_time=$('#officialTravelDepartureTime').val();
		var date=new Date();
		var date_created=date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate();
		var driver=$('#officialTravelDriver').val();
		//insert to view
		var data={"id":null,"tr_id":$(selectedElement).attr('id'),"res_id":null,"location":origin,"destination":destination,"departure_time":departure_time,"actual_departure_time":"00:00:00","returned_time":"00:00:00","departure_date":departure_date,"returned_date":"0000-00-00","status":"scheduled","plate_no":null,"driver_id":"0","linked":"no","date_created":date_created,driver_id:driver,_token:$('input[name=_token]').val()}

		$.post('api/travel/personal/itenerary',data,function(res){

			try{
				var id=JSON.parse(res).id;
				data.id=id;
				//add to preview
				appendIteneraryToListPreview(data,function(data){
					//saved button
					$(that).html('saved')

					//clear form
					$('#officialTravelOrigin').val('');
					$('#officialTravelDestination').val('');
					$('#officialTravelDepartureDate').val('');
					$('#officialTravelDepartureTime').val('');

					//enabling context
					unbindContext();
					context();

					appendIteneraryToListPreviewCallback(data);

				})


			}catch(e){
				alert('Something went wrong.Please try again later!');
			}


		});

			

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
