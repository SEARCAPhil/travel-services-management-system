<div class="row">
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
			
				<p><div class="mini-circle"></div> <span class="pull-left"><b>Passengers</b></span> <span class="label label-success status-box status-box-mini green passenger-count">0</span></p>
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
				<p><div class="mini-circle"></div> <b>Itenerary</b></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Type of Vehicle</b></p>
				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" disabled="disabled" > SUV 
					<input type="radio" name="vtype" value="2" select-mobi="2" disabled="disabled"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Mode of Payment</b></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" value="cash"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled" value="sd"></span>
				</p>
			</div>

		</div>


	</div>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/preview.personal.js"></script>
<script type="text/javascript" src="js/status.personal.js"></script>
<script type="text/javascript">	


$(document).ready(function(){ });
</script>
