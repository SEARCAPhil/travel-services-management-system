<div class="col col-md-12 preview-status-section" style="background-image: none;background: rgba(225, 61, 52,0.2);"></div>	

<div class="col col-md-12"  style="margin-bottom: 10px;margin-top: 20px;">
	<small>
		<ul class="list-unstyled preview-menu-li">

			
			<li class="preview-command"><a href="#" target="_blank" class="preview-print" title="print"><span class="glyphicon glyphicon-print"></span> Print</a></li>
			<li class="preview-remove preview-command disabled" title="remove"><span class="glyphicon glyphicon-remove"></span> Remove</li>
			<li class="preview-update preview-command disabled" title="update"><span class="glyphicon glyphicon-pencil"></span> Update</li>
			<li class="text-danger preview-forward preview-command disabled" title="send"> <span class="glyphicon glyphicon-send"></span> Send</li>

		</ul>
	</small>
	
</div>


<div class="col col-md-12 preview-content content-section">
{{csrf_field()}}

		
		<div class="col col-md-12 preview-title row" >

			<div class="col col-md-9">
				<h3 class="preview-name"></h3>
				<small class="preview-unit">. . .</small><br/>
				<small class="preview-created">. . .</small>
			</div>
		</div>



		
		<div class="row">


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <b>Purpose</b></div>
				</div>
				
				<div class="col col-md-12">
					<p class="purpose-content preview-purpose"> . . .</p>
				</div>	
			</div>



			<div class="col col-md-12 preview-sections">

				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						<span class="pull-left"><b>Passengers</b></span> &emsp;
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
					<div class="content-header"> <span class="pull-left"><b>Itinerary</b></span> &emsp;
				<span class="label label-success itenerary-count"> ? </span></div>
				</div>

				
				<div class="preview-itenerary">

				</div>
				
			</div>


			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header"> <span><b>Cash Advance</b></span></div>
				</div>
				<div class="col co-md-12">
					<div class="preview-cash-advance"></div>
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