<?php @session_start(); ?>
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

<div class="preview-content">

	<div class="row col col-md-6 col-sm-8 col-md-offset-2 content-section">

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
			<div class="circle  itenerary-circle-group">3<span class="circle-label">Itinerary<span></div>
			<div class="bar  itenerary-circle-group"></div>	
			<div class="circle vehicle-circle-group">4<span class="circle-label">Vehicle<span></div>
			<div class="bar payment-circle-group" style="width: 170px;"></div>	
			<div class="circle  payment-circle-group">5<span class="circle-label top">Payment<span></div>


		</div>


		<div class="col col-md-12 xs-12 hidden-sm">
			<div class="bar continuation-right  vehicle-circle-group"></div>	
		</div>
		<div class="col col-md-12 xs-12 circle-pull-right">
			<div class="circle finished-circle-group"><span class="glyphicon glyphicon-check"></span><span class="circle-label">Finished<span></div>
		</div>

	
		<div class="col col-md-12" >

			<p class="purpose-content"  style="margin-top: 50px;"> 
				<p><span class="mini-circle"></span><span>Purpose</span> <span class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></span> <span id="officialPurposeSaveStatus"></span></p>
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
				<p></p><div class="mini-circle"></div> <b>Itinerary</b>
				<span class="btn btn-success btn-xs" id="iteneraryFormButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>
				<div class="preview-itenerary"></div>
		</div>

		<div class="col col-md-12 preview-sections">
			<p></p><div class="mini-circle"></div> <b>Type of Vehicle</b> <span id="personalVehicleTypeSaveStatus" class=""></span><p></p>
			<p class="col col-md-12">
				<input type="radio" name="vtype" value="1" select-mobi="1" checked="checked" 	class="vehicleTypeFormButton"> SUV 
				<input type="radio" name="vtype" value="2" select-mobi="2" disabled="disabled"  class="vehicleTypeFormButton"> Van
				<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"  class="vehicleTypeFormButton"> Pick-up	
			</p>
		</div>

		<div class="col col-md-12 preview-sections">
			<p></p><div class="mini-circle"></div> <b>Mode of Payment</b> <span id="paymentSaveStatus" class=""></span><p></p>
			<p class="col col-md-12">
				<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" checked="checked" class="paymentFormButton" value="cash"></span>
				<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled" class="paymentFormButton" value="sd"></span>
			</p>
		</div>




		

		


		</div>


	</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/preview.personal.js"></script>
<script type="text/javascript" src="js/itenerary.personal.js"></script>
<script type="text/javascript" src="js/callback.personal.js"></script>
<script type="text/javascript" src="js/form.personal.js"></script>
<script type="text/javascript">	




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
bindVehicleType()
bindPayment()
bindPurpose()

});
</script>
