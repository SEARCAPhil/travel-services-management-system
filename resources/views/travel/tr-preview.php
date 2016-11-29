<div class="row preview-content">
		<div class="col col-md-12 row">
			<ul class="list-unstyled preview-menu-li">
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
				<h4 class="preview-name"></h4>
				<p class="preview-unit">Management Services Unit</p>
				<p class="preview-created">1/17/16</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Purpose</b></p>
				<p class="purpose-content preview-purpose"> . . .</p>	
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

		</div>


	</div>


<script type="text/javascript">	

$(document).ready(function(){


showOfficialTravelListPreview()
showOfficialTravelPassengerStaffPreview()
showOfficialTravelPassengerScholarsPreview()
showOfficialTravelPassengerCustomPreview()
showOfficialTravelItenerary()


$('.preview-remove').on('click',function(){
		removeOfficialTravel(1)
})

$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    previewLoadingEffect()
		setTimeout(function(){ $('#editor').load('travel/official/editor/1'); },2000);
})
	
});
</script>