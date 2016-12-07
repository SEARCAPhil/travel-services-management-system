<div class="modal-content">
	<div class="modal-body">
	
	  	<div class="tab-content" style="margin-top: 20px;">


		    <div role="tabpanel" class="tab-pane text-center row active" id="itenerary">
		    	<div class="row" id="itenerary-dialog-content">
			    	<div class="col col-md-12">
			    		<div class="col col-md-5 col-sm-5 col-sm-offset-4 col-md-offset-4">
				    		<div style="width:100px;height:100px;border-radius: 50%;background: rgb(200,200,200);overflow:hidden;margin-left: 40px;">
				    			<h1 style="font-size: 4em;"><span class="glyphicon glyphicon-map-marker"></span></h1>
				    		</div>
				    	</div>
			    	</div>
			    	<div class="col col-md-12">
			    		<div class="col col-md-12 col-sm-12">
		            		<h3 class="ng-scope">Itenerary</h3>
		            		<p class="ng-scope">Please fill up all fields below</p>
		            	</div>
			            <form class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left">
			                <div class="form-group "><br/>
			                    
			                        <label class="">Origin</label>
			                    <input type="text" class="form-control" id="officialTravelOrigin">
			                </div>

			                <div class="form-group">
			                    <label class="">Destination</label>
			                    <input type="text" class="form-control" id="officialTravelDestination">
			                </div>


			                <div class="form-group">
			                    <label class="">Departure Date</label>
			                    <input type="date" class="form-control" id="officialTravelDepartureDate">
			                </div>

			                 <div class="form-group">
			                    <label class="">Departure Time</label>
			                    <input type="time" class="form-control" id="officialTravelDepartureTime">
			                </div>

			                <div class="form-group">
			                    <label class="">Driver</label>
			                    <select class="form-control" id="officialTravelDriver">
			                    	<option>Select driver</option>
			                    </select>
			                </div>

			                <div class="form-group text-right">
			                     <button class="btn btn-success" type="button" onclick="appendIteneraryListPreviewConfirmation()">Add</button>
			                    <button class="btn btn-default" type="button" id="">Cancel</button>
			                </div>
			            </form> 
		            </div>
		        </div>
	            <div class="col col-md-12" id="itenerary-confirmation"></div>

		    </div>
	   	</div>

	</div>
</div>
<script type="text/javascript">
var driverList={}
function ajax_getDriversList(func){

	driverList={"current_page":1,"total_pages":1,"data":[{"profile_id":"133","uid":"112","last_name":"Limbaco","first_name":"Van Allen ","id":"1","position":"driver"},{"profile_id":"139","uid":"117","last_name":"Aranzaso","first_name":"Jojo","id":"2","position":"driver"},{"profile_id":"140","uid":"118","last_name":"Corpuz","first_name":"Adriano Jr.","id":"3","position":"driver"},{"profile_id":"141","uid":"119","last_name":"Milante","first_name":"Nelson","id":"4","position":"driver"},{"profile_id":"142","uid":"120","last_name":"Raymundo","first_name":"Edward","id":"5","position":"driver"},{"profile_id":"143","uid":"121","last_name":"Simon","first_name":"Simon","id":"6","position":"driver"}]}
	func();
	return driverList;
}

function show_driversList(){
	ajax_getDriversList(function(){

		for(x of driverList.data){
			$('#officialTravelDriver').append('<option value="'+x.id+'">'+x.first_name+' '+x.last_name+'</option>')
		}
		
	})
}

function appendIteneraryToListPreview(jsonData,func){

	var a={}
	a={"id":"273","0":"273","tr_id":"291","1":"291","res_id":null,"2":null,"location":"SEARCA","3":"SEARCA","destination":"Cavite","4":"Cavite","departure_time":"05:00:00","5":"05:00:00","actual_departure_time":"00:00:00","6":"00:00:00","returned_time":"00:00:00","7":"00:00:00","departure_date":"2016-11-30","8":"2016-11-30","returned_date":"0000-00-00","9":"0000-00-00","status":"scheduled","10":"scheduled","plate_no":null,"11":null,"driver_id":"0","12":"0","linked":"no","13":"no","date_created":"2016-11-21 13:36:24","14":"2016-11-21 13:36:24"}
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
	func(1);

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
			//insert to view
			var data={"id":1,"tr_id":1,"res_id":null,"location":origin,"destination":destination,"departure_time":departure_time,"actual_departure_time":"00:00:00","returned_time":"00:00:00","departure_date":departure_date,"returned_date":"0000-00-00","status":"scheduled","plate_no":null,"driver_id":"0","linked":"no","date_created":date_created}

				//add date
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
				}


			)

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



$(document).ready(function(){
	show_driversList()
	
})


</script>

