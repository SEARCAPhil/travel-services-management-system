{{csrf_field()}}
<div class="row">
		<div class="col col-md-12 row">
			<ul class="list-unstyled preview-menu-li pull-right">
				<li><strong class="preview-id"></strong></li>

				<li class="preview-command" title="print"><a href="#" target="_blank" class="preview-print"><span class="glyphicon glyphicon-print"></span></a></li>
				<li class="preview-remove preview-command disabled" title="remove"><span class="glyphicon glyphicon-remove"></span></li>
				<li class="preview-update preview-command disabled" title="update" ><span class="glyphicon glyphicon-pencil"></span></li>
				<li class="text-danger preview-forward preview-command disabled" title="send"> <span class="glyphicon glyphicon-send"></span></li>
			</ul>
			
		</div>
		<div class="preview-status-section"></div>
		<div class="col col-md-12 preview-title" >
			<div class="col col-md-3">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9">
				<h3 class="preview-name"></h3>
				<p class="preview-unit">...</p>
				<p class="preview-created">...</p>
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
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/status.campus.js"></script>	
<script type="text/javascript" src="js/preview.campus.js"></script>
<script type="text/javascript">	
function bindUpdateCampusPreview(){

	$('.preview-update').off('click');
	$('.preview-update').on('click',function(){
		$('#editorTab').click();
		//loading
	    showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		setTimeout(function(){ 
			$('#editor').load('travel/campus/editor/'+$(selectedElement).attr('id'),function(){
				var id=$(selectedElement).attr('id');
				showCampusTravelListPreview(id)
				showCampusTravelItenerary(id)
				

				setTimeout(function(){
					bindRemoveItenerary();
				},2000)
				


			}); 

		},100);
	})
}



function bindRemoveCampusPreview(){

	$('.preview-remove').on('click',function(){
	//call custom bootstrap dialog
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
			//remove
			removeCampusTravelRequest($(selectedElement).attr('id'))

		})
		
	})

}


$(document).ready(function(){
	


	
});
</script>
