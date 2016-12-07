<div class="row">
		<div class="col col-md-12 row">
			<ul class="list-unstyled preview-menu-li pull-right">
				<li><strong>5691</strong></li>
				<li><span class="glyphicon glyphicon-share-alt"></span></li>
				<li><span class="glyphicon glyphicon-print"></span></li>
				<li class="preview-remove"><span class="glyphicon glyphicon-remove"></span></li>
				<li class="preview-update"><span class="glyphicon glyphicon-pencil"></span></li>
			</ul>
			
		</div>
		<div class="col col-md-12 preview-title" >
			<div class="col col-md-3">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9">
				<h3>Lorem ipsum dolor sit amet</h3>
				<p>Management Services Unit</p>
				<p>1/17/16</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Purpose</b></p>
				<p class="purpose-content">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>	
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Passengers</b></p>
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
					<input type="radio" name="vtype" value="2" select-mobi="2" checked="checked"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Mode of Payment</b></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" checked="checked"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled"></span>
				</p>
			</div>

		</div>


	</div>


<script type="text/javascript">	


$(document).ready(function(){


//showOfficialTravelListPreview()
//showOfficialTravelPassengerStaffPreview()
//showOfficialTravelPassengerScholarsPreview()
//showOfficialTravelPassengerCustomPreview()
//showOfficialTravelItenerary()
	$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ $('#editor').load('travel/personal/editor/1'); },100);
	})
	
});
</script>
