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
				<p><div class="mini-circle"></div> <b>Itenerary</b></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

			

		</div>


	</div>


<script type="text/javascript">	


$(document).ready(function(){


//showOfficialTravelListPreview()
//showOfficialTravelPassengerStaffPreview()
//showOfficialTravelPassengerScholarsPreview()
//showOfficialTravelPassengerCustomPreview()
showOfficialTravelItenerary()
	$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ $('#editor').load('travel/campus/editor/1'); },100);
	})
	
});
</script>
