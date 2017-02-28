
<div class="modal-content" style="color:rgb(40,40,40);">
  <div class="modal-body">
    <div class="row">
          <div class="col col-md-12 col-sm-12 text-center">
            <center><img src="img/fuel.png" width="40%"></center>
          </div>
            <form  class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left" id="form">
            <label>Liters <small class="text-danger">(* Required)</small></label> <input type="text" class="form-control" id="liters">
            <p class="text-danger refuel-liters-status"></p>
            <label>Amount in PHP <small class="text-danger">(* Required)</small></label> <input type="text" class="form-control" id="amount">
            <p class="text-danger refuel-amount-status"></p>
            <label>Receipt Number</label> <input type="text" class="form-control" id="receipt_number">
            <label>Gasoline station</label> <input type="text" class="form-control" id="station"> <br><br>
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

</div>
