<div class="modal-content" style="color:rgb(40,40,40);">
  <div class="modal-body">
    <div class="row">
        <div class="col col-md-12 col-sm-12 text-center">
          <center>[LOGO HERE]</center>
          <h3 class="ng-scope">Change Oil</h3><br/>
        </div>
      		<form  class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left" id="form">
           
             <label>Type of oil</label>
             <select class="form-control" id="oil"><option value="regular">Select one</option>
              <option value="regular">Regular Oil</option>
              <option value="synthetic">Synthetic Oil</option>
            </select>
            <label>Amount in PHP</label> <input type="text" class="form-control" id="amount" placeholder="PHP 00.00">
            <label>Mileage</label> <input type="text" class="form-control" id="mileage" placeholder="mileage">
      			<label>Receipt / Voucher Number</label> <input type="text" class="form-control" id="receipt_number">
            <label>Station</label> <input type="text" class="form-control" id="station" placeholder="Station"><br><br>
             <div class="form-group text-right">
                <button class="btn btn-success" type="button" id="add-button">Add</button>
                <button class="btn btn-default" type="button" data-dismiss="modal" id="">Cancel</button>
              </div>
      		</form>
          <div style="clear:both;"></div>
          <div id="form-status"></div>
          
          <!--
          <div class="col col-md-12 col-sm-12">
             <details>
              <summary>View change oil status</summary><br>
                <label>Number of kilometers : </label> <span class="ng-binding">0 km/s</span><br>
                <span><label>Last Change oil : </label> <span><em class="ng-binding">2016-06-01</em> at <b class="ng-binding">8212 kms</b></span><br></span>
                <span><label>Kilometers run : </label> <span><em> <b class="ng-binding">-8212 kms</b></em></span><br></span>
                <label>You recently used : </label> <span><em class="ng-binding">regular</em> oil </span><br><br>
            </details><br><br>
            
            
           <p class="alert alert-warning" ng-show="mobileGasPreview.travel.mileage-mobileGasPreview.changeOil.mileage<5000"><span class="glyphicon glyphicon-warning-sign text-warning"></span> You only run  <b class="ng-binding">-8212 kms</b> and have not yet reached the <b>minimum of 5000kms and maximum of 10000kms</b> mileage usage.It is not recommended to change the oil of this vehicle.</p>-->
          </div>
    </div>
  </div>

</div>
