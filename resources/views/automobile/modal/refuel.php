
<div class="modal-content" style="color:rgb(40,40,40);">
  <div class="modal-body">
    <div class="row">
          <div class="col col-md-12 col-sm-12">
              <h3 class="page-header"><a href="#">Gasoline</a></h3>
          </div>
            <form  class="form col col-md-12 text-left" id="form">
            <p>Liters <small class="text-danger">(* Required)</small></p>
            <p class="text-danger refuel-liters-status"></p> 
            <input type="text" class="form-control" id="liters" autofocus="autofocus">
            

            <p>Amount in PHP <small class="text-danger">(* Required)</small></p> 
            <p class="text-danger refuel-amount-status"></p>
            <input type="text" class="form-control" id="amount">


            <p>Receipt Number</p> <input type="text" class="form-control" id="receipt_number">
            <p>Gasoline station</p> <input type="text" class="form-control" id="station"> 

            <div class="form-group text-right">
                <button class="btn btn-success" type="button" id="add-gasoline-button">Add</button>
                <button class="btn btn-default" type="button" data-dismiss="modal" id="">Cancel</button>
            </div>
          </form>
          <div style="clear:both;"></div>
          <div id="form-status"></div>
       
          </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  $.material.init();
</script>