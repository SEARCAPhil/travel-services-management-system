<div class="row preview-status-section"></div>	

<div class="row"  style="margin-bottom: 10px;box-shadow: 0px 10px 25px rgba(200,200,200,0.2);padding-bottom:15px;padding-left: 50px;font-size: 12px;">
	<section>
		<ul class="list-unstyled preview-menu-li">
			<li class="preview-command"><a href="#" target="_blank" class="preview-print" title="print"><span class="glyphicon glyphicon-print"></span> Print</a></li>
			<li class="preview-remove preview-command disabled" title="remove"><span class="glyphicon glyphicon-remove"></span> Remove</li>
			<li class="preview-update preview-command disabled" title="update"><span class="glyphicon glyphicon-pencil"></span> Update</li>
			<li class="text-danger preview-forward preview-command disabled" title="send"> <span class="glyphicon glyphicon-send"></span> Send</li>

		</ul>
</section>
	
</div>


<div class="col col-md-12 preview-content content-section">
{{csrf_field()}}

		
		<div class="col col-md-12 preview-title row" >
			<div class="col col-md-2 hide text-center" style="font-size:3em;">
				<div class="profile-image profile-image-lg preview-profile-image"></div>
			</div>
			<div class="col col-md-9">
				<h3 class="preview-name"></h3>
				<small class="preview-unit">. . .</small><br/>
				<small class="preview-created">. . .</small>
			</div>
		</div>



		
		<div class="row">


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <i class="material-icons md-18">label</i><b>Purpose</b></div>
				</div>
				
				<div class="col col-md-12">
					<p class="purpose-content preview-purpose"> . . .</p>
				</div>	
			</div>



			<div class="col col-md-12 preview-sections">

				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						<span class="pull-left"><i class="material-icons md-18">label</i> <b>Passengers</b></span> &emsp;
						<span class="label label-success  passenger-count">?</span>
					</div>
				</div>
				
				<div class="col col-md-12">
					<div class="colcol-md-12">
						<table class="table table-striped passenger-table preview-table table-fluid" id="table-passenger">
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
			</div>


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <span class="pull-left"><i class="material-icons md-18">label</i><b>Itinerary</b></span> &emsp;
				<span class="label label-success itenerary-count"> ? </span></div>
				</div>

				
				<div class="preview-itenerary">

				</div>
				
			</div>


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <i class="material-icons md-18">label</i><span><b>Source of fund</b></span></div>
				</div>
				<div class="col co-md-12">
					<div class="source_of_fund_section col-md-12"></div>
				</div>
			</div>

			<div class="col col-md-12 preview-sections  show-for show-for-trp-only">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"><span class="pull-left"><b>Type of Vehicle</b></span> &emsp;</div>
				</div>

				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" disabled="disabled"> SUV&emsp;
					<input type="radio" name="vtype" value="2" select-mobi="2" disabled="disabled"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12 preview-sections show-for show-for-trp-only">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <i class="material-icons md-18">label</i><span class="pull-left"><b>Mode of Payment</b></span> &emsp;</div>
				</div>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" value="cash"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled" value="sd"></span>
				</p>
			</div>


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <span class="pull-left"><i class="material-icons md-18">label</i><b>Notes</b></span> </div>
				</div>
				<div class="col col-md-12">
				
					<p class="preview-notes"></p>
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