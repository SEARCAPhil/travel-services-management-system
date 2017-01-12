/**
* OFFICIAL TRAVEL REQUEST ITENERARY SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/



/*
|----------------------------------------------------------------------------
| Hold data for the davailable drivers
|---------------------------------------------------------------------------
*/
var driverList={}

/*
|----------------------------------------------------------------------------
| Hold data for vehicle list
|---------------------------------------------------------------------------
*/
var vehicleList={}


/*
|----------------------------------------------------------------------------
| AJAX Drivers List
|---------------------------------------------------------------------------
|
| Get drivers list from the directory
|
*/

function ajax_getDriversList(func){
	$.get('api/directory/drivers',function(res){
		driverList=JSON.parse(res)
		func(driverList);
		return driverList;
	})
	
}




/*
|----------------------------------------------------------------------------
| AJAX Vehicle List
|---------------------------------------------------------------------------
|
| Get vehicle list from the directory
|
*/
function ajax_getVehiclesList(func){
	$.get('api/directory/vehicles',function(res){
		vehicleList=JSON.parse(res)
		func(vehicleList);
		return vehicleList;
	})
	
}



/*
|----------------------------------------------------------------------------
| Show Drivers List
|---------------------------------------------------------------------------
|
| Display drivers list
|
*/

function show_driversList(){
	ajax_getDriversList(function(driverList){
		for(x of driverList.data){
			$('#officialTravelDriver').append('<option value="'+x.id+'">'+x.first_name+' '+x.last_name+'</option>')
		}
		
	})
}




/*
|----------------------------------------------------------------------------
| Append Itenerary To preview
|---------------------------------------------------------------------------
|
| Display travel list in preview page
|
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
	$('.preview-itenerary').append(htm)
	func(data);

	//enable context modal
	setTimeout(function(){
			bindRemoveItenerary();
	},2000);

}



/*
|----------------------------------------------------------------------------
| Append Itenerary Confirmation
|---------------------------------------------------------------------------
|
| Shows confirmation dialog efore appending item to itenerary 
|
*/

function appendIteneraryListPreviewConfirmation(){

	//dialog
	var htm=`<h3>Are you sure you want to add this to your itenerary?</h3><div class="col col-md-12">
		<button class="btn btn-danger" id="iteneraryConfirmationButton"><span class="glyphicon glyphicon-ok"></span>&nbsp;Yes</button> <button class="btn btn-default" id="iteneraryConfirmationButtonCancel">No</button>
	</div>`

	$('#itenerary-dialog-content').hide();
	$('#itenerary-confirmation').html(htm)
	

	//add event handler in confirmation button
	$('#iteneraryConfirmationButton').click(function(){
		
		$(this).html('saving . . .')
		var that=this


		//input value
		var origin=$('#officialTravelOrigin').val();
		var destination=$('#officialTravelDestination').val();
		var departure_date=$('#officialTravelDepartureDate').val();
		var departure_time=$('#officialTravelDepartureTime').val();
		var date=new Date();
		var date_created=date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate();
		var driver=$('#officialTravelDriver').val();

		//json data
		var data={"id":null,"tr_id":$(selectedElement).attr('id'),"res_id":null,"location":origin,"destination":destination,"departure_time":departure_time,"actual_departure_time":"00:00:00","returned_time":"00:00:00","departure_date":departure_date,"returned_date":"0000-00-00","status":"scheduled","plate_no":null,"driver_id":"0","linked":"no","date_created":date_created,driver_id:driver,_token:$('input[name=_token]').val()}





		$.post('api/travel/official/itenerary',data,function(res){

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

					//enabling contextmenu
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
