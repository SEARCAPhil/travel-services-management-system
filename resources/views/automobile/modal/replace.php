<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
      <div class="row">
          <div class="col col-md-12 col-sm-12 text-center">
            <center>[LOGO HERE]</center>
            <h3 class="ng-scope">Change Oil</h3><br/>
          </div>
      		<form  class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left" id="form">
      			<label>Specify Item(s) to replace</label> <input type="text" class="form-control" id="item">
           		<label>Details</label> <textarea class="form-control" placeholder="write details here" id="details"></textarea>
      			<label>Amount in PHP</label> <input type="text" class="form-control" placeholder="PHP 00.00" id="amount">
      			<label>Receipt Number</label> <input type="text" class="form-control" id="receipt_number">
            	<label>Dealer/Supplier</label> <input type="text" class="form-control" id="supplier"><br><br>
              <div class="form-group text-right">
                   <button class="btn btn-success" type="button" id="add-button">Add</button>
                  <button class="btn btn-default" type="button" data-dismiss="modal" id="">Cancel</button>
              </div>
      		</form>

          <div style="clear:both;"></div>
          <div id="form-status"></div>
      </div>
	</div>

</div>
        	
    