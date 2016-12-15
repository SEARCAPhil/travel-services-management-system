<div class="contextMenu" id="staffPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialPassengerButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="contextMenu" id="scholarPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialScholarButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="contextMenu" id="customPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialCustomButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>

<div class="contextMenu" id="iteneraryMenu">
	<ul class="list-group">		
		<li class="list-group-item removeIteneraryButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="modal fade" id="custom-passenger-modal">
	<div class="modal-dialog" id="passenger-modal-dialog">
			
	</div>
</div>

<div class="modal fade" id="passenger-modal">
	<div class="modal-dialog" id="passenger-modal-dialog">
			@include('travel/modal/passenger')
	</div>
</div>

<div class="modal fade" id="itenerary-modal">
	<div class="modal-dialog" id="itenerary-modal-dialog">
			@include('travel/modal/itenerary')
	</div>
</div>

<div class="row preview-content">



	<div class="col col col-md-3 col-sm-3 hidden-xs">
		<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
		<ul class="list-unstyled travel-link-ul">
			<li><a href="#" class="travel-link pull-left" data-type="official">Official</a> <span class="add-button" data-content="official"><span class="glyphicon glyphicon-plus" ></span></li>
			<li><a href="#" class="travel-link pull-left" data-type="personal">Personal</a> <span class="add-button" data-content="personal"><span class="glyphicon glyphicon-plus"></span</span></li>
			<li><a href="#" class="travel-link pull-left" data-type="campus">Campus</a> <span class="add-button" data-content="campus"><span class="glyphicon glyphicon-plus"></span></span></li>
		</ul>

		<div class="col col-md-2 col-sm-2">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>

	</div>

	<div class="row col col-md-8 col-sm-8">

		<div class="col col-md-12">
			<h3 class="page-header">Personal Travel Request Form</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>	
			<br/>		
		</div>
		
		<div class="col col-md-12 xs-12">
			{{csrf_field()}}
			<div class="circle done">1<span class="circle-label">Purpose<span></div>	
			<div class="bar done"></div>	
			<div class="circle passenger-circle-group">2<span class="circle-label">Passenger<span></div>
			<div class="bar passenger-circle-group"></div>	
			<div class="circle  itenerary-circle-group">3<span class="circle-label">Itenerary<span></div>
			<div class="bar  itenerary-circle-group"></div>	
			<div class="circle vehicle-circle-group">4<span class="circle-label top">Vehicle<span></div>

		</div>


		<div class="col col-md-12 xs-12 hidden-sm">
			<div class="bar continuation-right  vehicle-circle-group"></div>	
		</div>
		<div class="col col-md-12 xs-12 circle-pull-right">

			<div class="circle  payment-circle-group">5<span class="circle-label">Payment<span></div>
			<div class="bar payment-circle-group" style="margin-right: -10px;"></div>	
			<div class="circle finished-circle-group"><span class="glyphicon glyphicon-check"></span><span class="circle-label">Finished<span></div>

		</div>

	
		<div class="col col-md-12" >

			<p class="purpose-content"  style="margin-top: 50px;"> 
				<p><span class="mini-circle"></span><span>Purpose</span> <span class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></span> <span id="officialPurposeSaveStatus" class="pull-right"></span></p>
				<textarea class="col col-md-12 col-xs-12 	preview-purpose" id="form-purpose" rows="15" cols="10" placeholder="Type the purpose of your travel request in this section"></textarea>	
			</p>

		</div>

		<div class="col col-md-12  preview-sections">
				<p></p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal" id="passengerFormButton"><span class="glyphicon glyphicon-plus"></span></button><p></p>
				<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae </p>

				<table class="table table-striped passenger-table preview-table table-fluid" id="table-passenger" ng-show="passengersX.length>=1||passengersScholar.length>=1||passengersCustom.length>=1">
					<thead>
						<tr>
							<th>Name</th><th>Designation</th><th>Office/Unit</th>
						</tr>
					</thead>
					<tbody class="preview-passengers">
					</tbody>
				</table>
			</div>


			<div class="col col-md-12 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Itenerary</b>
				<span class="btn btn-success btn-xs" id="iteneraryFormButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>
				<div class="preview-itenerary"></div>
		</div>

		<div class="col col-md-12 preview-sections">
			<p></p><div class="mini-circle"></div> <b>Type of Vehicle</b><p></p>
			<p class="col col-md-12">
				<input type="radio" name="vtype" value="1" select-mobi="1" disabled="disabled" class="vehicleTypeFormButton"> SUV 
				<input type="radio" name="vtype" value="2" select-mobi="2" checked="checked"  class="vehicleTypeFormButton"> Van
				<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"  class="vehicleTypeFormButton"> Pick-up	
			</p>
		</div>

		<div class="col col-md-12 preview-sections">
			<p></p><div class="mini-circle"></div> <b>Mode of Payment</b><p></p>
			<p class="col col-md-12">
				<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" checked="checked" class="paymentFormButton"></span>
				<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled" class="paymentFormButton"></span>
			</p>
		</div>




		

		


		</div>


	</div>

<script type="text/javascript">	
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








$(document).ready(function(){
//reset form id
form_id=0;
//active page
active_page='personal_form';

//change state
changeButtonState('#passengerFormButton','disabled')
changeButtonState('#iteneraryFormButton','disabled')
changeButtonState(".vehicleTypeFormButton",'disabled')
changeButtonState(".paymentFormButton",'disabled')

$('#officialPurposeSaveButton').click(function(e){
	e.preventDefault();
	 showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
		setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)

	if($('#form-purpose').val().length<2) return 0;

	//insert new item to db if not yet saved
	if(form_id<1){
		var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val()}
		$.post('api/travel/personal/purpose',data,function(res){
			//check if created successfully
			if(res>0&&res.length<50){
				form_id=res;

				//change selectedElement id to enable adding passenger
				$(selectedElement).attr('id',form_id);

				//passsenger enable
				changeCircleState('.passenger-circle-group')
				changeButtonState('#passengerFormButton','enabled')
			}else{
				alert('Oops something went wrong!Please try again later.')
			}

		}).fail(function(){

			alert('Oops something went wrong!Please try again later.')
		})

	}else{
		//update
		var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val(),id:form_id}


		$.ajax({
			url:'api/travel/personal/purpose',
			data:data,
			method:'PUT',
			success:function(res){
				if(res>0&&res.length<50){

				}
			}
		});

	}

})

});
</script>
