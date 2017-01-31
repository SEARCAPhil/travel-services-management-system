<section class="col col-md-12">
	<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Gasoline</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>

	<!--<p><b>Total liters of Gasoline  :</b> <span style="color:rgb(32,199,150);"> 96 Liter/s</span></p>
	<p><b>Total amount of Gasoline  :</b> <span style="color:rgb(32,199,150);">Php 1301</span></p>-->
	<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/refuel"><span class="glyphicon glyphicon-object-align-bottom"></span> Refuel</span></p>

	<br/><br/>
	<div class="row col col-md-12">
		<h5>Change Date</h5>
		<select class="form-control" id="ledger-date">
			<option>2017</option>
			<option>2016</option>
			<option>2015</option>
			<option>2014</option>

		</select>
	</div>

</section>
<section class="col col-md-12">
	<section class="col col-md-11 monthly-ledger January"  style="display: block;" id="1"></section>
	<section class="col col-md-11 monthly-ledger February"  style="display: block;" id="2"></section>
	<section class="col col-md-11 monthly-ledger March"  style="display: block;" id="3"></section>
	<section class="col col-md-11 monthly-ledger April"  style="display: block;" id="4"></section>
	<section class="col col-md-11 monthly-ledger May"  style="display: block;" id="5"></section>
	<section class="col col-md-11 monthly-ledger June"  style="display: block;" id="6"></section>
	<section class="col col-md-11 monthly-ledger July"  style="display: block;" id="7"></section>
	<section class="col col-md-11 monthly-ledger August"  style="display: block;" id="8"></section>
	<section class="col col-md-11 monthly-ledger September"  style="display: block;" id="9"></section>
	<section class="col col-md-11 monthly-ledger October"  style="display: block;" id="10"></section>
	<section class="col col-md-11 monthly-ledger November"  style="display: block;" id="11"></section>
	<section class="col col-md-11 monthly-ledger December"  style="display: block;" id="11"></section>

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

	//Bind function for add button in Re-fuel modal
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


	//gasoline ledger
	var plate_no=($(selectedAutomobile).attr('data-content'))

	bindGasolineLedger(plate_no,new Date().getFullYear())

	$('#ledger-date').change(function(){
		bindGasolineLedger(plate_no,$(this).val())
	})


})
</script>
<script type="text/javascript" src="js/ledger.gasoline.js"></script>

