<div class="modal-content">
	<div class="modal-body">
		<h3>Passenger</h3>
		<p>Select person you want to include on this trip</p>

		<div class="row">
			<div class="col col-md-12">
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#staff" aria-controls="staff" role="tab" data-toggle="tab" data-page="automobile">Staff</a></li>
				    <li role="presentation"><a href="#scholars" aria-controls="scholars" role="tab" data-toggle="tab"  data-page="calendar">Scholars</a></li>
				    <li role="presentation"><a href="#custom" aria-controls="custom" role="tab" data-toggle="tab"   data-page="travel">Custom</a></li>
				  </ul>
			</div>
	  </div>

  	<div class="tab-content" style="margin-top: 20px;">
	 	<!--staff-->
	    <div role="tabpanel" class="tab-pane active" id="staff">
	    	    <div class="col col-md-12 ng-scope" style="margin-bottom: 30px;">
	                <div class="col col-md-2 pull-right">/ <span class="list-total-pages-staff">0</span></div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control" ng-value="1" value="1" id="pagerPassenger"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find" id="searchInputPassenger"> </div>
	                <div class="col col-md-1 pull-right text-right"><span class="glyphicon glyphicon-search"></span> </div>
	            </div>
            
	    	<form class="row">

                <div class="form-group">
                    <div class="col col-md-12 staff-list-directory">
                       
                    </div>


                </div>
                <div class="form-group text-right">
                    
                </div>
           </form>
	    </div>















	    <div role="tabpanel" class="tab-pane" id="scholars">
	    	<div class="col col-md-12 ng-scope" style="margin-bottom: 30px;">
	                <div class="col col-md-2 pull-right ng-binding">/ <span class="list-total-pages-scholar">0</span></div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control" value="1" id="pagerScholar"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find"  id="searchInputScholar"> </div>
	                <div class="col col-md-1 pull-right text-right"><span class="glyphicon glyphicon-search"></span> </div>
	            </div>
            
	    	<form class="row">

                <div class="form-group">
                    <div class="col col-md-12 scholar-list-directory">
                       
                    </div>


                </div>
                <div class="form-group text-right">
                    
                </div>
           </form>
	    </div>


	    <div role="tabpanel" class="tab-pane text-center row" id="custom">
	    	<div class="row" id="custom-dialog-content">
		    	<div class="col col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
		    		<div class="profile-image profile-image-lg" display-image="" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
		    	</div>
		    	<div class="col col-md-12">
	            	<h3 class="ng-scope">Custom Passenger</h3>
	            	<p class="ng-scope">Passenger that is not employed in this organization</p>
		            <form class="form col col-md-10 col-md-offset-1">
		                <div class="form-group "><br/>
		                    
		                        <label class="">Full Name</label>
		                    <input type="text" class="form-control" id="customFullName">
		                </div>

		                <div class="form-group">
		                    <label class="">Designation</label>
		                    <input type="text" class="form-control" id="customDesignation">
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



<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript">

	$(document).ready(function(){

		showStaffList(1);
		showScholarList(1);

		pagerPassenger()
		searchInputPassenger()
		searchInputScholar()
		pagerScholar()

	})
</script>

