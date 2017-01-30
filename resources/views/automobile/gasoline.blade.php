<section class="col col-md-5 ng-scope">
	<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Gasoline</h1>
	<p>Total liters of Gasoline  : <span class="gasSpan ng-binding"> 96 Liter/s</span></p>
	<p>Total amount of Gasoline  : <span class="gasSpan ng-binding">Php 1301</span></p>
	<p>Number of travel/s this month : <span class="gasSpan ng-binding">0</span></p>
	<p>Total Number of travel/s : <span class="gasSpan ng-binding">0</span></p><br>
	<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/refuel"><span class="glyphicon glyphicon-object-align-bottom"></span> Refuel</span></p>
</section>

<script type="text/javascript">
function formCompleted(){
	$('#form').hide();
	var htm=`<center>
				<div style="width:60px;height:60px;background:rgb(0,200,150);color:rgb(255,255,255);border-radius:50%;text-align:center;overflow:hidden;font-size:3em;" class="text-success"><span class="glyphicon glyphicon-ok"></span></div>
				<h3 class="text-success">Added Succefully!</h3>
				<button class="btn btn-success" id="add-more">Add more + </button>
			</center>`;
	$('#form-status').html(htm)

	$('#add-more').click(function(){
		$('#form')[0].reset();
		$('#form-status').html(' ');
		$('#form').slideDown();

	})
}



function ajax_postGasoline(liters,amount,receipt,station,plate_no,callback){
	$.post('automobile/gasoline/'+plate_no,{_token:$('input[name=_token]').val(),liters:liters,amount:amount,receipt:receipt,station:station,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}
	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}


$(document).ready(function(){
	unbindAjaxLoad();
	ajaxLoad(function(){
		$('#add-button').on('click',function(){
			var liters=$('#liters').val();
			var amount=$('#amount').val();
			var receipt=$('#receipt_number').val();
			var station=$('#station').val();
			var plate_no=($(selectedAutomobile).attr('data-content'))

			ajax_postGasoline(liters,amount,receipt,station,plate_no,function(){
				formCompleted()
			});

		})
	});
})
</script>