<section class="col col-md-5 ng-scope">
	<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Gasoline</h1>
	<p>Total liters of Gasoline  : <span class="gasSpan ng-binding"> 96 Liter/s</span></p>
	<p>Total amount of Gasoline  : <span class="gasSpan ng-binding">Php 1301</span></p>
	<p>Number of travel/s this month : <span class="gasSpan ng-binding">0</span></p>
	<p>Total Number of travel/s : <span class="gasSpan ng-binding">0</span></p><br>
	<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/refuel"><span class="glyphicon glyphicon-object-align-bottom"></span> Refuel</span></p>
</section>

<script type="text/javascript">
$(document).ready(function(){
	unbindAjaxLoad();
	ajaxLoad();
})
</script>