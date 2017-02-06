
<div class="row preview-content">
{{csrf_field()}}
		
		

		<div class="col col-md-12 row">
			<small>
				<ul class="list-unstyled preview-menu-li pull-right">

					
					<li class="preview-command"><a href="#" target="_blank" class="preview-print" title="print"><span class="glyphicon glyphicon-print"></span> Print</a></li>
					<li class="preview-remove preview-command disabled" title="remove"><span class="glyphicon glyphicon-remove"></span> Remove</li>
					<li class="preview-update preview-command disabled" title="update"><span class="glyphicon glyphicon-pencil"></span> Update</li>
					<li class="text-danger preview-forward preview-command disabled" title="send"> <span class="glyphicon glyphicon-send"></span> Send</li>

				</ul>
			</small>
			
		</div>


		<div class="col col-md-12 preview-title" >
			<div class="col col-md-3">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9">
				<h3 class="preview-name"></h3>
				<p class="preview-unit">. . .</p>
				<p class="preview-created">. . .</p>
			</div>
		</div>

		<div class="preview-status-section"></div>

		
		<div class="row">
			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Purpose</b></p>
				<p class="purpose-content preview-purpose"> . . .</p>	
			</div>

			<div class="col col-md-12 preview-sections">
			
				<p><div class="mini-circle"></div> <span class="pull-left"><b>Passengers</b></span> <span class="label label-success status-box status-box-mini green passenger-count">?</span></p>
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
				<p><div class="mini-circle"></div> <span class="pull-left"><b>Itinerary</b></span> 
				<span class="label label-success status-box status-box-mini green itenerary-count"> ? </span></p>
				<div class="preview-itenerary">

				</div>
				
			</div>


			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <span class="pull-left"><b>Cash Advance</b></span></p> 
				<div class="preview-cash-advance">

				</div>
				
			</div>



		</div>


	</div>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/status.official.js"></script>
<script type="text/javascript" src="js/preview.official.js"></script>
<script type="text/javascript">	


$(document).ready(function(){






	
});
</script>