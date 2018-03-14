<section class="col col-md-12">
	<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Gasoline</h1>
	
	<!--<p><b>Total liters of Gasoline  :</b> <span style="color:rgb(32,199,150);"> 96 Liter/s</span></p>
	<p><b>Total amount of Gasoline  :</b> <span style="color:rgb(32,199,150);">Php 1301</span></p>-->
	<p>
		<span class="btn btn-success ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/refuel"><span class="glyphicon glyphicon-object-align-bottom"></span> 
		Refuel</span>
	</p>

	<br/><br/>
	<div class="row col col-md-12">

		<div class="col col-xs-2">
			<div class="form-group">
				<p class="text-success"><i class="material-icons md-18">event</i> DATE </p>
			</div>
		</div>
		<div class="col col-xs-4">
			<select class="form-control" id="ledger-date" autofocus="autofocus">
				<option>Select year</option>
				<option>2018</option>
				<option>2017</option>
				<option>2016</option>
				<option>2015</option>
				<option>2014</option>

			</select>
		</div>
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
<script type="text/javascript" src="js/ledger.gasoline.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	//materialize
	$.material.init();

	//Bind function for add button in Re-fuel modal
	unbindAjaxLoad();
	ajaxLoad(function(){
		$('#add-gasoline-button').on('click',function(){
			var liters=$('#liters').val();
			var amount=$('#amount').val();
			var receipt=$('#receipt_number').val();
			var station=$('#station').val();
			var plate_no=($(selectedAutomobile).attr('data-content'))

			var error=[];

			$('.refuel-amount-status').html('')
			$('.refuel-liters-status').html('')


			if(validator.isEmpty(liters)){
				$('.refuel-liters-status').html('<div class="alert alert-danger">Item must not be empty!</div>')
				error.push('oil');
			}

			
			if(validator.isEmpty(amount)){
				$('.refuel-amount-status').html('<div class="alert alert-danger">Amount must not be empty!</div>')
				error.push('amount');
			}

			if(!validator.isNumeric(amount)&&!validator.isFloat(amount)){
				$('.refuel-amount-status').html('<div class="alert alert-danger">Invalid amount</div>')
				error.push('amount');
			}


			//no error
			if(error.length===0){
				$(this).attr('disabled','disabled')
				ajax_postGasoline(liters,amount,receipt,station,plate_no,function(){
					formCompleted(plate_no)

				});
				$('#add-gasoline-button').attr('disabled','enabled')
			}
			

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


