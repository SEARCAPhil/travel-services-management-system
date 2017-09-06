<div class="modal-content">
	<div class="modal-body">

		
		<h3>Charge</h3>
		<p>This will serve as a basis for the total computation for this travel.</p>
	
		<div class="col col-md-12"><hr/></div>
    	

		<div class="row">
			<div class="col col-md-12 driver-section">
				<form class="form">
                	{{csrf_field()}}

                
        	    	<div class="form-group">
        	    		
                		
                        <b>Mileage In (Start km)</b>
                		<input type="text" placeholder="km" class="form-control" id="start_km">
                	</div>

                	<div class="form-group">
                		<b>Mileage Out (End km)</b>
                		<input type="text" placeholder="km" class="form-control" id="end_km">
                	</div>
                	


                	<div class="form-group">
                		<b>Vehicle/Gasoline Charge</b>
                   		<select class="form-control" id="gasoline_charge"></select>
        	    	</div>

                	<div class="form-group">
                		<b>Drivers Overtime Charge</b>
                		<select class="form-control"  id="drivers_charge"></select>
                	</div>

                    <div class="form-group">
                        <b>Drivers Appointment</b>
                        <select class="form-control" id="appointment">
                           <option value="contracted">Contracted</option>
                           <option value="emergency">Emergency</option>
                        </select>
                        <input type="hidden" id="action">
                    </div>

                	
                </form>
			</div>

			<div class="col col-md-12">
					<button class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
					<button class="btn btn-success modal-submit pull-right"  data-dismiss="modal" aria-label="Proceed" style="margin-right:10px;">Proceed</button>
					
					<div style="clear: both"></div>
				
			</div>

	  	</div>

	</div>

</div>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/charges.official.js"></script>
<script type="text/javascript" src="js/itenerary.official.js"></script>
<script type="text/javascript">



$(document).ready(function(){ 

   gasolineCharge();

})
    

</script>

