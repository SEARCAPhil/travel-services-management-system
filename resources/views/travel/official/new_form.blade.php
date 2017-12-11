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

{{csrf_field()}}

	<div class="col-md-6 col-sm-8 col-md-offset-2" style="margin-top: 50px;"> 
		<a href="#" onclick="event.preventDefault();$('.automobile-tab[data-type=official]').click();"><i class="material-icons">keyboard_backspace</i> back to list</a>
	</div>

	<div class="row col col-md-6 col-sm-8 col-md-offset-2 content-section">

		<div class="col col-md-12">
			<h3 class="page-header">Travel Request Form</h3>
			<p class="text-muted">Please select the appropriate type of travel that suites you.</p>	
			<br/>		
		</div>
		
		<div class="col col-md-12 col-xs-12" style="display: none;">
			<div class="circle done purpose-circle-group">1<span class="circle-label">Purpose<span></div>	
			<div class="bar done purpose-circle-group"></div>	
			<div class="circle passenger-circle-group">2<span class="circle-label">Passenger<span></div>
			<div class="bar passenger-circle-group"></div>	
			<div class="circle itenerary-circle-group">3<span class="circle-label">Itinerary<span></div>
			<div class="bar itenerary-circle-group"></div>
			<div class="circle cash-advance-circle-group">4<span class="circle-label">Cash Advance<span></div>
			<div class="bar finished-circle-group" style="width: 140px"></div>
			<div class="circle finished-circle-group"><span class="glyphicon glyphicon-check"></span><span class="circle-label">Finished<span></div>
		</div>


		<p class="col col-md-12">
			<input type="radio" name="request_type" value="official"  checked="checked"> Official 
			<input type="radio" name="request_type" value="personal"> Personal
			<input type="radio" name="request_type" value="campus"> Campus	
		</p>
		<div class="col col-md-12 preview-sections" >

			<p class="purpose-content"  style="margin-top: 50px;"> 
				<p><span class="mini-circle"></span><span>Purpose</span> <button class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></button> <span class="" id="officialPurposeSaveStatus"></span></p>
				<textarea class="col col-md-12 col-xs-12 	preview-purpose" id="form-purpose" rows="15" cols="10" placeholder="Type the purpose of your travel request in this section"></textarea>	
			</p>

		</div>

		<div class="col col-md-12  preview-sections">
				<p></p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal" id="passengerFormButton"><span class="glyphicon glyphicon-plus"></span></button><p></p>
				<!--<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae </p>-->
				<hr/>
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
				<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#itenerary-modal" id="iteneraryFormButton"><span class="glyphicon glyphicon-map-marker"></span></button>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<hr/>
				<!--<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>-->
				<div class="preview-itenerary"></div>
		</div>


		<div class="col col-md-12 preview-sections">
			<p></p><div class="mini-circle"></div> <b>Cash Advance</b>
			<br/><br/>
			<p><b>Source of funds: <span class="" id="officialSourceOfFundSaveStatus"></span></b></p>
			<p>
				<select class="form-control" id="source_of_fund" disabled="disabled">
					<option value="opf">Select source of fund</option>
					<option value="opf">Operating Funds</option>
					<option value="otf" id="otf">Other Funds</option>
					<option value="op">Obligations Payable</option>
					<option value="sf">Special Funds</option>
					<option value="opfs">Operating Funds(Scholar)</option>
					<option value="otfs">Other Funds(Scholar)</option>
				</select>
			</p>
			<p id="otf-funding-section">
				<select id="otf-fundings" class="form-control">
					<option value="N/A">Select project</option>
					<div><input type="text" class="form-control" name="otf-fundings-project-name" id="otf-fundings-project-name" placeholder=" OR input project name" style="display: none;"></div>
				</select>
			</p>


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




			<button class="btn btn-success pull-right" onclick="event.preventDefault();$('.automobile-tab[data-type=official]').click();"><i class="material-icons md-18">check_circle</i> done</button>
		</div>

	</div>


</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/preview.official.js"></script>
<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/callback.official.js"></script>
<script type="text/javascript" src="js/form.official.js"></script>
<script type="text/javascript">	



$(document).ready(function(){

//reset form id
form_id=0;
//active page
active_page='official_form';

//change state
changeButtonState('#passengerFormButton','disabled')
changeButtonState('#iteneraryFormButton','disabled')

bindOfficialPurposeSaveButton()
bindSourceOfFund()
bindOtfSelection();
bindVehicleType()
bindPayment()

});
</script>
