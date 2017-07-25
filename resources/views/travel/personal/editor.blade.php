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

<div class="col col-md-8 col-md-offset-2 preview-content" style="margin-top: 50px;">

	<div class="col-xs-12"> 
		<a href="#" onclick="event.preventDefault();$('.automobile-tab[data-type=personal]').click();"><i class="material-icons">keyboard_backspace</i> back to list</a>
	</div>

	<div class="col col-md-8 content-section">
		<div class="col col-xs-12 col-xs-12 col-md-8 preview-title">

			<div class="col col-md-12 col-xs-7 row">
				<h3 class="preview-name">. . .</h3>
				<p class="preview-unit">. . .</p>
				<p class="preview-created">. . .</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 col-sm-12 preview-sections">
				{{csrf_field()}}
				<p></p><div class="mini-circle"></div> <b>Purpose</b> 
					<span class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></span>
					<span id="officialPurposeSaveStatus" class="text-muted"></span>
					<p></p>
				<p class="purpose-content"> <textarea class="col col-md-12 col-sm-12 col-xs-12  preview-purpose" rows="15" id="form-purpose">. . .
				</textarea>	
				</p>	
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal"><span class="glyphicon glyphicon-plus"></span></button></p>
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
				<p><div class="mini-circle"></div> <b>Itinerary</b> <span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

			<div class="col col-md-12  preview-sections">
				<p></p><div class="mini-circle"></div> <b>Type of Vehicle</b> <span id="personalVehicleTypeSaveStatus" class=""></span><p></p>
				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" 	class="vehicleTypeFormButton"> SUV 
					<input type="radio" name="vtype" value="2" select-mobi="2"   class="vehicleTypeFormButton"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3"  class="vehicleTypeFormButton"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12  preview-sections">
				<p></p><div class="mini-circle"></div> <b>Mode of Payment</b> <span id="paymentSaveStatus" class=""></span><p></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" class="paymentFormButton" value="cash"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment"  class="paymentFormButton" value="sd"></span>
				</p>
			</div>

			<button class="btn btn-success pull-right" onclick="event.preventDefault();$('.automobile-tab[data-type=personal]').click();"><i class="material-icons md-18">check_circle</i> done</button>


	</div>
</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/form.personal.js"></script>
<script type="text/javascript" src="js/itenerary.personal.js"></script>	
<script type="text/javascript" src="js/callback.personal.js"></script>

<script type="text/javascript">	

$(document).ready(function(){
	//modify form id to assume that editor is also running inside form page
	//this will update the purpose instead of creating another one
	form_id=$(selectedElement).attr('id');

	bindVehicleType()
	bindPayment()
	bindPurpose()
});
</script>