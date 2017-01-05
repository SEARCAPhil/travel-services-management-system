
<div class="row preview-content">
{{csrf_field()}}
		<div class="col col-md-12 row">

			<ul class="list-unstyled preview-menu-li pull-right">
				<li><strong class="preview-id"></strong></li>

				<li class="preview-command"><span class="glyphicon glyphicon-print"></span></li>
				<li class="preview-remove preview-command"><span class="glyphicon glyphicon-remove"></span></li>
				<li class="preview-update preview-command"><span class="glyphicon glyphicon-pencil"></span></li>
				<li class="text-danger preview-forward preview-command"> <span class="glyphicon glyphicon-send"></span></li>
			</ul>
			
		</div>

		<div class="preview-status-section">
			


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
				<p><div class="mini-circle"></div> <span class="pull-left"><b>Itenerary</b></span> 
				<span class="label label-success status-box status-box-mini green itenerary-count"> ? </span></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

		</div>


	</div>

<script type="text/javascript" src="js/preview.official.js"></script>
<script type="text/javascript" src="js/status.official.js"></script>
<script type="text/javascript">	


$(document).ready(function(){



$('.preview-remove').on('click',function(){
	//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
			//remove
			removeOfficialTravelRequest($(selectedElement).attr('id'))

		})
		
})




$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ 
			$('#editor').load('travel/official/editor/'+$(selectedElement).attr('id'),function(){
				var id=$(selectedElement).attr('id');
				showOfficialTravelListPreview(id);
				showOfficialTravelPassengerStaffPreview(id)
				showOfficialTravelPassengerScholarsPreview(id)
				showOfficialTravelPassengerCustomPreview(id)
				showOfficialTravelItenerary(id)

				setTimeout(function(){
					bindRemoveStaff();
					bindRemoveItenerary();
					bindRemoveOfficialScholar();
					bindRemoveOfficialCustom();
				},2000)
				

			}); 

		},100);
})



	
});
</script>