
<div class="preview-status-section col col-md-12"></div>
<div  class="col col-md-12"  style="margin-bottom: 10px;">
	<small>
		<ul class="list-unstyled preview-menu-li">

			
			<li class="preview-command"><a href="#" target="_blank" class="preview-print" title="print"><span class="glyphicon glyphicon-print"></span> Print</a></li>
			<li class="preview-remove preview-command disabled" title="remove"><span class="glyphicon glyphicon-remove"></span> Remove</li>
			<li class="preview-update preview-command disabled" title="update"><span class="glyphicon glyphicon-pencil"></span> Update</li>
			<li class="text-danger preview-forward preview-command disabled" title="send"> <span class="glyphicon glyphicon-send"></span> Send</li>

		</ul>
	</small>
	
		</div>

{{csrf_field()}}
<div class="col col-md-12 content-section">

		<div class="col col-md-12 preview-title row">
			<div class="col col-md-12">
				<h3 class="preview-name"></h3>
				<small class="preview-unit">. . .</small><br/>
				<small class="preview-created">. . .</small>
			</div>
		</div>
		
		<div class="row">
			


			
			<div class="col col-md-12 preview-sections">
				<div class="col col-md-12 content-header-section">
					<div class="content-header">
						 <span class="pull-left"><b>Itinerary</b></span> &emsp;
					</div>
				</div>

				
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
