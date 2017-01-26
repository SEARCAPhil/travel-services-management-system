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
		<div class="col col-md-5 col-md-offset-2">
			<ul class="list-unstyled preview-menu-li">
				<li><strong></strong>&emsp;<small>[R/W Mode]</small></li>
			</ul>
			
		</div>
		<div class="col col-xs-12 col-md-8  col-md-offset-2 preview-title">
			<div class="col col-md-2 col-sm-2">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9 col-xs-7">
				<h3 class="preview-name">. . .</h3>
				<p class="preview-unit">. . .</p>
				<p class="preview-created">. . .</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-8 col-sm-12 col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Purpose</b> 
					<span class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></span>
					<span id="officialPurposeSaveStatus"></span>
					<p></p>
				<p class="purpose-content"> <textarea class="col col-md-12 col-sm-12 col-xs-12  preview-purpose" rows="15" id="form-purpose">. . .</textarea>	
				</p>	
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
			{{csrf_field()}}
				<p></p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal"><span class="glyphicon glyphicon-plus"></span></button><p></p>
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


			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Itenerary</b>
				<span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<div class="preview-itenerary"></div>
				
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Cash Advance</b> <small><a href="#"><span onclick="$('#fundings').show();return false;">Change</span></a></small>
				<div class="preview-cash-advance">

				</div>
				<br/><br/>
				<div id="fundings" style="display:none;">
					<p><b>Source of funds: <span class="" id="officialSourceOfFundSaveStatus"></span></b></p>
					<p>
						<select class="form-control" id="source_of_fund">
							<option value="opf">Operating Funds</option>
							<option value="otf" id="otf">Other Funds</option>
							<option value="opfs">Operating Funds(Scholar)</option>
							<option value="otfs">Other Funds(Scholar)</option>
						</select>
					</p>
					<p id="otf-funding-section">
						<select id="otf-fundings" class="form-control">
							<option value="N/A">Select project</option>
						</select>
					</p>
				</div>
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

});
</script>