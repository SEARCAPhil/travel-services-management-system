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
				<h3 class="preview-name"></h3>
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

<script type="text/javascript" src="js/preview.personal.js"></script>
<script type="text/javascript">	

function bindRemoveStaff(){
	$('.removeOfficialPassengerButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelPassengerStaff(context)
	})
}



function bindRemoveItenerary(){
	$('.removeIteneraryButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removePersonalTravelItenerary(context)
	})
}



function removePersonalTravelPassengerStaff(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){
	    		removeContextListElement('api/travel/personal/itenerary/',id);
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}


function removePersonalTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/personal/itenerary/',id);
	    })
	});

	$('#preview-modal').modal('toggle');
	
}



$(document).ready(function(){


//showOfficialTravelListPreview()
//showOfficialTravelPassengerStaffPreview()
//showOfficialTravelPassengerScholarsPreview()
//showOfficialTravelPassengerCustomPreview()
//showOfficialTravelItenerary()
	


	$('.preview-remove').on('click',function(){
	//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
			//remove
			removePersonalTravelRequest($(selectedElement).attr('id'))

		})
		
	})


	//remove previous handler
	$('.preview-update').off('click');


	$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ 
			$('#editor').load('travel/personal/editor/'+$(selectedElement).attr('id'),function(){
				var id=$(selectedElement).attr('id');

				showPersonalTravelListPreview(id)
				showPersonalTravelPassengerStaffPreview(id)

				setTimeout(function(){
					bindRemoveStaff();
					bindRemoveItenerary();
				},2000)
				


			}); 

		},100);
	})

	
});
</script>
