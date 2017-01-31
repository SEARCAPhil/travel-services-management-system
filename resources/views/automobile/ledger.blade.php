	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Ledger</h1>
		<div class="col col-md-12 ">
			<div class="col col-md-3">
				<select class="form-control" id="ledger-date">
					<option>2017</option>
					<option>2016</option>
					<option>2015</option>
					<option>2014</option>

				</select>
			</div>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</div>
		<div class="col col-md-12 "><br/><div style="border:1px solid rgb(45,45,45)"></div><br/></div>

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

		<section class="col col-md-11"  style="display: block;">





		</section>

	</div>
<script type="text/javascript" src="js/ledger.maintenance.js"></script>	
<script type="text/javascript">

$(document).ready(function(){
	var plate_no=($(selectedAutomobile).attr('data-content'))

	bindMaintenanceLedger(plate_no,new Date().getFullYear())

	$('#ledger-date').change(function(){
		bindMaintenanceLedger(plate_no,$(this).val())
	})
})	
</script>

