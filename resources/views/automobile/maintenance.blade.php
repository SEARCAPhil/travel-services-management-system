	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span> Maintenance</h1>
		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/repair"><span class="glyphicon glyphicon-wrench"></span> Repair</span></p>

		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/oil" id="changeOilButton" oil-dialog=""><span class="glyphicon glyphicon-oil"></span> Change Oil Schedule/Due Date</span></p>

		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/replace" replace-dialog=""><span class="glyphicon glyphicon-wrench"></span> Replace parts</span></p>
	</div>
	<script type="text/javascript" src="js/maintenance.js"></script>
	
	<script type="text/javascript">


	$(document).ready(function(){
		bindMaintenance()
	})
	</script>