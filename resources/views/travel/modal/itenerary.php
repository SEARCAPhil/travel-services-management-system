<div class="modal-content">
	<div class="modal-body">
		<h3>Passenger</h3>
		<p>Select person you want to include on this trip</p>

		<div class="row">
			<div class="col col-md-12">
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#itenerary" aria-controls="custom" role="tab" data-toggle="tab"   data-page="travel">Itenerary</a></li>
				  </ul>
			</div>
	  </div>

	  	<div class="tab-content" style="margin-top: 20px;">


		    <div role="tabpanel" class="tab-pane text-center row active" id="itenerary">
		    	<div class="row" id="custom-dialog-content">
			    	<div class="col col-md-12">
			    		<div class="col col-md-5 col-sm-5 col-sm-offset-4 col-md-offset-4">
				    		<div style="width:100px;height:100px;border-radius: 50%;background: rgb(200,200,200);overflow:hidden;margin-left: 40px;">
				    			<h1 style="font-size: 4em;"><span class="glyphicon glyphicon-map-marker"></span></h1>
				    		</div>
				    	</div>
			    	</div>
			    	<div class="col col-md-12">
			    		<div class="col col-md-12 col-sm-12">
		            		<h3 class="ng-scope">Itenerary</h3>
		            		<p class="ng-scope">Please fill up all fields below</p>
		            	</div>
			            <form class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left">
			                <div class="form-group "><br/>
			                    
			                        <label class="">Origin</label>
			                    <input type="text" class="form-control" id="customFullName">
			                </div>

			                <div class="form-group">
			                    <label class="">Destination</label>
			                    <input type="text" class="form-control" id="customDesignation">
			                </div>


			                <div class="form-group">
			                    <label class="">Departure Date</label>
			                    <input type="date" class="form-control" id="customDesignation">
			                </div>

			                 <div class="form-group">
			                    <label class="">Departure Time</label>
			                    <input type="time" class="form-control" id="customDesignation">
			                </div>

			                <div class="form-group">
			                    <label class="">Driver</label>
			                    <select class="form-control">
			                    	<option>Select driver</option>
			                    	<option value="1">Nelson A.</option>
			                    	<option value="2">Allan Rabulan</option>
			                    </select>
			                </div>

			                <div class="form-group text-right">
			                     <button class="btn btn-success" type="button" onclick="appendCustomListPreviewConfirmation()">Add</button>
			                    <button class="btn btn-default" type="button">Cancel</button>
			                </div>
			            </form> 
		            </div>
		        </div>
	            <div class="col col-md-12" id="custom-confirmation"></div>

		    </div>
	   	</div>

	</div>
</div>





