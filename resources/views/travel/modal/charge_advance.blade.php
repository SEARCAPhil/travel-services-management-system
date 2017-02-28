<div class="modal-content">
	<div class="modal-body">

		
		<h3>Advance Option</h3>
		<small class="text-danger">DANGER: This will override the suggested payment and will disregard computation based on different charges</small>
	
		<div class="col col-md-12"><hr/></div>
    	

		<div class="row">
			<div class="col col-md-12 driver-section">
				<form class="form">
                	{{csrf_field()}}

                        <p><b>Gasoline Charge</b></p>
                        <input type="text" class="form-control" placeholder="Price in PHP" id="gasoline_charge" /><br/>

                        <p><b>Additional Charge</b></p>
                        <input type="text" class="form-control" placeholder="Price in PHP" id="additional_charge"/><br/>

                        <p><b>Drivers Charge</b></p>
                        <input type="text" class="form-control" placeholder="Price in PHP" id="drivers_charge"/><br/>


                        <p><b>Notes</b></p>
                        
                        <div style="margin-bottom: 30px;">
                            <textarea class="form-control" rows="5" placeholder="Notes" id="notes"></textarea>
                        </div>

                       
                 
            
                 </form>
                </div>
			<div class="col col-md-12">
					<button class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
					<button class="btn btn-danger modal-submit pull-right"  data-dismiss="modal" aria-label="Proceed" style="margin-right:10px;">Proceed</button>
					
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

   advanceGasolineCharge();

	showAdvanceGasolineCharge()

})
    

</script>

