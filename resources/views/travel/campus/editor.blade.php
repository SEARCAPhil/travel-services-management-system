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
{{csrf_field()}}
<div class="col col-md-8 col-md-offset-2 preview-content" style="margin-top: 50px;">
	<div class="col col-md-8 content-section">


		<div class="col col-md-12 preview-title row">
			<div class="col col-md-12">
				<h3 class="preview-name">. . .</h3>
				<p class="preview-unit">. . .</p>
				<p class="preview-created">. . .</p>
			</div>
		</div>
		
		<div class="row">
			


			<div class="col col-md-12 col-sm-12 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Itinerary</b>
				<span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<div class="preview-itenerary">

				
			</div>
				
			</div>

		</div>


	</div>
</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/preview.campus.js"></script>	
<script type="text/javascript" src="js/itenerary.campus.js"></script>
<script type="text/javascript">	

$(document).ready(function(){
	//modify form id to assume that editor is also running inside form page
	//this will update the purpose instead of creating another one
	form_id=$(selectedElement).attr('id');


});
</script>