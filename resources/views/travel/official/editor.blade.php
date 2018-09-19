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
<div class="contextMenu" id="fundingMenu">
	<ul class="list-group">		
		<li class="list-group-item removeFundButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
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
<div class="modal fade" id="funding-modal">
	<div class="modal-dialog" id="itenerary-modal-dialog">
			@include('travel/modal/funds')
	</div>
</div>

<div class="col col-md-8 col-md-offset-2 preview-content" style="margin-top: 50px;height:100vh; overflow-y: auto;padding-bottom:160px;">
	<div class="col-xs-12"> 
		<a href="#" onclick="event.preventDefault();$('.automobile-tab[data-type=official]').click();"><i class="material-icons">keyboard_backspace</i> back to list</a>
	</div>

	<div class="col col-md-8 content-section">
		<div class="col col-xs-12 col-md-12 preview-title">
			<div class="col col-lg-3 col-md-4 hide">
				<div class="profile-image profile-image-lg preview-profile-image" style="background: rgba(200,200,200,0.4);"></div>
			</div>
			<div class="col col-lg-8 col-md-8 col-xs-7 row">
				<h3 class="preview-name">. . .</h3>
				<small class="preview-unit">. . .</small>
				<small class="preview-created">. . .</small>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 preview-sections">

				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						<span class="pull-left"><b>Purpose</b></span> &emsp;

						<span id="officialPurposeSaveStatus"></span>
					</div>

					<div class="col col-md-2">
						<button class="btn btn-default btn-xs" id="officialPurposeSaveButton"><i class="material-icons md-18">save</i> Save</button>
					</div>
				</div>

				<div class="col col-md-12">
					<p class="purpose-content"> 
						<textarea class="col col-md-12 col-sm-12 col-xs-12  preview-purpose" rows="15" id="form-purpose">. . .</textarea>	
					</p>
				</div>	
			</div>

			<div class="col col-md-12 preview-sections">
				{{csrf_field()}}
				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						<span class="pull-left"><b>Passengers</b></span>&emsp;
					</div>

					<div class="col col-md-2">
						<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#passenger-modal"><i class="material-icons md-18">add_box</i></button>
					</div>

				</div>


				<div class="col col-md-12">
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
			</div>


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> 
						<span class="pull-left"><b>Itinerary</b></span> &emsp;
						
					</div>

					<div class="col col-md-2">
						<button class="btn btn-default btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal" data-toggle="modal" data-target="#passenger-modal"><i class="material-icons md-18">add_box</i> Location</button>
					</div>
				</div>

				<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				
				<div class="preview-itenerary"></div>
				
			</div>

			<div class="col col-md-12 preview-sections">

				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						<p><b>Source of funds: <span class="" id="officialSourceOfFundSaveStatus"></span></b>
					</p> 
					</div>
					<div class="col col-md-2"><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#funding-modal" id="sourceOfFundFormButton"><span class="glyphicon glyphicon-plus"></span></button></div>
				</div>

				<div class="col col-md-12">
					<div class="preview-cash-advance source_of_fund_section">

					</div>
				</div>

				


			<div class="col col-md-12 preview-sections  show-for show-for-trp-only">
				<p></p><div class="mini-circle"></div> <b>Type of Vehicle</b> <span id="personalVehicleTypeSaveStatus" class=""></span><p></p>
				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" 	class="vehicleTypeFormButton"> SUV 
					<input type="radio" name="vtype" value="2" select-mobi="2"   class="vehicleTypeFormButton"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3"  class="vehicleTypeFormButton"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12 preview-sections  show-for show-for-trp-only">
				<p></p><div class="mini-circle"></div> <b>Mode of Payment</b> <span id="paymentSaveStatus" class=""></span><p></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" class="paymentFormButton" value="cash"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment"  class="paymentFormButton" value="sd"></span>
				</p>
			</div>

			<div class="col col-md-12 content-header-section" style="margin-top: 80px;">
				<div class="content-header">
					<b>Notes</b> <span id="notesSaveStatus" class=""></span>
				</div>
				
				<p>&emsp;<button class="btn btn-default btn-xs" id="notesSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></button></p>
				

				<hr/>
				<!--<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>-->
				<textarea class="col col-md-12 col-xs-12 preview-notes" id="form-notes" rows="15" cols="10" placeholder="Notes"></textarea>	
			</div>


			<div class="col col-md-12 content-header-section" style="margin-top: 80px;">

				<details>
					<summary>Advanced options</summary>
					<br/><br/>
					<div class="col col-md-12 row">
						<div class="col col-md-10">
							<b> <i class="material-icons md-18">note</i> Signatory :</b>
							<span class="preview-signatory"></span>
						</div>
						<div class="col col-md-2"><button onclick="$('#signatory').show();return false;" class="btn btn-default btn-xs"><i class="material-icons md-18">edit</i> Change</button></div>
					</div>	
					
					

					<div class="col col-md-12" id="signatory" style="display:none;margin-top: 20px;">

						<!--<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>-->
						<select class="col col-md-12 col-xs-12 form-control" id="form-signatory">
							<option>(default)</option>
						</select>

						<p>&emsp;<button class="btn btn-default btn-xs" id="signatorySaveButton"><span class="glyphicon glyphicon-floppy-disk"></span> SAVE</button></p>
					

					</div>
				</details>	
			</div>

				

			</div>
			<button class="btn btn-success pull-right" onclick="event.preventDefault();$('.automobile-tab[data-type=official]').click();"><i class="material-icons md-18">check_circle</i> done</button>
		</div>


	</div>
</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/callback.official.js"></script>
<script type="text/javascript" src="js/form.official.js"></script>
<script type="text/javascript">	

$(document).ready(function(){

	//modify form id to assume that editor is also running inside form page
	//this will update the purpose instead of creating another one
	form_id=$(selectedElement).attr('id');

	bindOfficialPurposeSaveButton()
	bindSourceOfFund()
	bindOtfSelection();
	bindVehicleType()
	bindPayment()
	bindRequestType()
	bindNotesSaveButton()
	bindShowSignatorySelector()
	bindChangeSignatory()

});
</script>