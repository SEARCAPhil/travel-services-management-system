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

{{csrf_field()}}

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
			<h3 class="page-header">Official Travel Request Form</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>	
			<br/>		
		</div>
		
		<div class="col col-md-12 col-xs-12">
			<div class="circle done purpose-circle-group">1<span class="circle-label">Purpose<span></div>	
			<div class="bar done purpose-circle-group"></div>	
			<div class="circle passenger-circle-group">2<span class="circle-label">Passenger<span></div>
			<div class="bar passenger-circle-group"></div>	
			<div class="circle itenerary-circle-group">3<span class="circle-label">Itenerary<span></div>
			<div class="bar itenerary-circle-group"></div>	
			<div class="circle finished-circle-group"><span class="glyphicon glyphicon-check"></span><span class="circle-label">Finished<span></div>

		</div>


		<div class="col col-md-12 preview-sections" >

			<p class="purpose-content"  style="margin-top: 50px;"> 
				<p><span class="mini-circle"></span><span>Purpose</span> <button class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></button> <span class="pull-right" id="officialPurposeSaveStatus"></span></p>
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
				<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#itenerary-modal" id="iteneraryFormButton"><span class="glyphicon glyphicon-map-marker"></span></button>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>
				<div class="preview-itenerary"></div>
		</div>

	</div>


</div>

<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/callback.official.js"></script>
<script type="text/javascript" src="js/form.official.js"></script>
<script type="text/javascript">	


/*callback for selecting an item from directory list
* This must be only present on this page to avoid conflict
*/
function appendStaffToListPreviewCallback(data){
	//itenerary enable button on forms
	changeCircleState('.itenerary-circle-group')
	changeButtonState('#iteneraryFormButton','enabled')
}


function appendIteneraryToListPreviewCallback(data){
	//enable finished circle on forms
	changeCircleState('.finished-circle-group')
}





$(document).ready(function(){

//reset form id
form_id=0;
//active page
active_page='official_form';

//change state
changeButtonState('#passengerFormButton','disabled')
changeButtonState('#iteneraryFormButton','disabled')

bindOfficialPurposeSaveButton()

});
</script>
