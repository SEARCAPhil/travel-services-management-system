<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
      <div class="row">
          <div class="col col-md-12 col-sm-12 text-center">
            <center>[LOGO HERE]</center>
            <h3 class="ng-scope">Change Oil</h3><br/>
          </div>
      		<form  class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left">
      			<label>Specify Item(s) to replace</label> <input type="text" class="form-control ng-pristine ng-untouched ng-valid" ng-model="repairItem">
           		<label>Details</label> <textarea class="form-control ng-pristine ng-untouched ng-valid" ng-model="repairDetails" placeholder="write details here"></textarea>
      			<label>Amount in PHP</label> <input type="text" class="form-control ng-pristine ng-untouched ng-valid" ng-model="repairAmount" placeholder="PHP 00.00">
      			<label>Receipt Number</label> <input type="text" class="form-control ng-pristine ng-untouched ng-valid" ng-model="repairReceipt">
            	<label>Dealer/Supplier</label> <input type="text" class="form-control ng-pristine ng-untouched ng-valid" ng-model="repairStation"><br><br>
              <div class="form-group text-right">
                   <button class="btn btn-success" type="button" onclick="appendIteneraryListPreviewConfirmation()">Add</button>
                  <button class="btn btn-default" type="button" id="">Cancel</button>
              </div>
      		</form>
      </div>
	</div>

</div>
        	
    