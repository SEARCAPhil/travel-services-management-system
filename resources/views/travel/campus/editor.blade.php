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

<div class="row preview-content">
		<div class="col col-md-5 col-md-offset-2">
			<ul class="list-unstyled preview-menu-li">
				<li><strong>5691</strong>&emsp;<small>[R/W Mode]</small></li>
			</ul>
			
		</div>
		<div class="col col-xs-12 col-md-8  col-md-offset-2 preview-title">
			<div class="col col-md-2 col-sm-2">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9 col-xs-7">
				<h3 class="preview-name">John Kenneth G. Abella</h3>
				<p class="preview-unit">Info Tech Services Unit</p>
				<p class="preview-created">2016-10-17</p>
			</div>
		</div>
		
		<div class="row">
			


			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Itenerary</b>
				<span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span>
					<div id="officialIteneraryStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
				</p>
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
bindRemoveStaff();
bindRemoveItenerary();
bindRemoveOfficialScholar();
bindRemoveOfficialCustom();

$('#officialPurposeSaveButton').click(function(e){
	e.preventDefault();
	 showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
		setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)
	//$('#officialPurposeSaveStatus')
})

});
</script>