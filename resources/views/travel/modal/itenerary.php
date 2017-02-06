<div class="modal-content">
	<div class="modal-body">
	
	  	<div class="tab-content" style="margin-top: 20px;">


		    <div role="tabpanel" class="tab-pane text-center row active" id="itenerary">
		    	<div class="row" id="itenerary-dialog-content">
			    	<div class="col col-md-12">
			    		<div class="col col-md-5 col-sm-5 col-sm-offset-4 col-md-offset-4">
				    		<div style="width:100px;height:100px;border-radius: 50%;background: rgb(200,200,200);overflow:hidden;margin-left: 40px;">
				    			<h1 style="font-size: 4em;"><span class="glyphicon glyphicon-map-marker"></span></h1>
				    		</div>
				    	</div>
			    	</div>
			    	<div class="col col-md-12">
			    		<div class="col col-md-12 col-sm-12">
		            		<h3 class="ng-scope">Itinerary</h3>
		            		<p class="ng-scope">Please fill up all fields below</p>
		            	</div>
			            <form class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left">
			                <div class="form-group "><br/>
			                    
			                        <label class="">Origin</label>
			                    <input type="text" class="form-control" id="officialTravelOrigin">
			                </div>

			                <div class="form-group">
			                    <label class="">Destination</label>
			                    <input type="text" class="form-control" id="officialTravelDestination">
			                </div>


			                <div class="form-group">
			                    <label class="">Departure Date</label>
			                    <input type="date" class="form-control" id="officialTravelDepartureDate">
			                </div>

			                 <div class="form-group">
			                    <label class="">Departure Time</label>
			                    <input type="time" class="form-control" id="officialTravelDepartureTime">
			                </div>

			                <div class="form-group">
			                    <label class="">Driver</label>
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
	show_driversList()
})
</script>

