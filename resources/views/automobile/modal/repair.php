<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
    <div class="row">
      <div class="col col-md-5 col-sm-5 col-sm-offset-4 col-md-offset-4">
        
      </div>

  		<div class="col col-md-12 col-sm-12">
        <h3 class="page-header"><a href="#">Repair</a></h3>
      </div>
  		<form  class="form col col-sm-12  text-left" id="form">
          <p>Specify Item(s) to repair <small class="text-danger">(* Required)</small></p>
          <p class="text-danger repair-item-status"></p> 
          <input type="text" class="form-control" id="item">
            
            <p>Details <small class="text-danger">(* Required)</small></p>
            <p class="text-danger repair-details-status"></p> 
            <textarea class="form-control" placeholder="write details here" id="details"></textarea>
            



            <p>Amount in PHP <small class="text-danger">(* Required)</small></p> 
            <p class="text-danger repair-amount-status"></p>
            <input type="text" class="form-control" placeholder="PHP 00.00" id="amount">
            


            <p>Receipt Number</p> 
            <input type="text" class="form-control" id="receipt_number">

            <p>Repair Shop</p>
            <input type="text" class="form-control" id="supplier">


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
        	
    