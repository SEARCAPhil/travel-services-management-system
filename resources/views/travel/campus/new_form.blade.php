<?php @session_start(); ?>
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


<div class="preview-content"  style="margin-top: 70px;">
{{csrf_field()}}

	<div class="row col col-md-6 col-sm-8 col-md-offset-2"> 
		<a href="#" onclick="event.preventDefault();$('.automobile-tab[data-type=campus]').click();"><i class="material-icons">keyboard_backspace</i> back to list</a>
	</div>


	<div class="row col col-md-6 col-md-offset-2 content-section">

		<div class="col col-md-12">
			<h3 class="page-header">Campus Travel Request Form</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>	
			<br/>		
		</div>
		
		<div class="col col-md-12 xs-12">
			<div class="circle done">1<span class="circle-label">Itinerary<span></div>	
			<div class="bar done"></div>	
			<div class="circle finished-circle-group"><span class="glyphicon glyphicon-check"></span><span class="circle-label">Finished<span></div>

		</div>


		


			<div class="col col-md-12 preview-sections"><br/><br/><br/>
				<p></p><div class="mini-circle"></div> <b>Itinerary</b>
				<span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
				<p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam </p>
				<div class="preview-itenerary"></div>

				<button class="btn btn-success pull-right" onclick="event.preventDefault();$('.automobile-tab[data-type=campus]').click();"><i class="material-icons md-18">check_circle</i> done</button>

		</div>


		</div>


	</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/preview.campus.js"></script>
<script type="text/javascript" src="js/itenerary.campus.js"></script>
<script type="text/javascript">	
function appendIteneraryToListPreviewCallback(data){
	changeCircleState('.finished-circle-group')
}


//reset form id
form_id=0;

$(document).ready(function(){


});
</script>
