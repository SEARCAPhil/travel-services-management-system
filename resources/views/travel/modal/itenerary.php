<div class="modal-content">
	<div class="modal-body">
	
	  	<div class="tab-content" style="margin-top: 20px;">


		    <div role="tabpanel" class="tab-pane row active" id="itenerary">
		    	<div class="row" id="itenerary-dialog-content">
			    	
			    	<div class="col col-md-12">
			    		<div class="col col-md-12 col-sm-12">
		            		<h3 class="page-header"><a href="#">Itinerary</a></h3>
		            		<p class="text-muted">Please fill up all fields below</p>
		            	</div>

			            <form class="form col col-md-12 text-left">
			                <div class="form-group "><br/>
			                    
			                    <p class="">Origin</p>
			                    <input type="text" class="form-control" id="officialTravelOrigin" autofocus="autofocus">
			                </div>

			                <div class="form-group">
			                    <p class="">Destination</p>
			                    <input type="text" class="form-control" id="officialTravelDestination">
			                </div>


			                <div class="form-group">
			                    <p class="">Departure Date</p>
			                    <input type="date" class="form-control" id="officialTravelDepartureDate">
			                </div>

			                 <div class="form-group">
			                    <p class="">Departure Time</p>
			                    <input type="time" class="form-control" id="officialTravelDepartureTime">
			                </div>

			                <div class="form-group">
			                    <p class="">Driver</p>
			                    <select class="form-control" id="officialTravelDriver">
			                    	<option>Select driver</option>
			                    </select>
			                </div>

			                <div class="form-group text-right">
			                     <button class="btn btn-success" type="button" onclick="appendIteneraryListPreviewConfirmation()">Add</button>
			                    <button class="btn btn-default" type="button" id="">Cancel</button>
			                </div>
			            </form> 
		            </div>
		        </div>
	            <div class="col col-md-12 text-left" id="itenerary-confirmation"></div>

		    </div>
	   	</div>

	</div>
</div>
<script type="text/javascript" src="js/itenerary.official.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$.material.init();
	show_driversList()
})
</script>

