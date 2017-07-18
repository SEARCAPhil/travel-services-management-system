<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
      <div class="row">
          <div class="col col-md-12 col-sm-12">
            <h3 class="page-header"><a href="#">Automobile</a></h3><br/>
          </div>
      		<form  class="form col col-md-12 col-sm-12 text-left" id="form">
      			<p>Vehicle Brand/Make/Model <small class="text-danger">(* Required)</small></p>
             <input type="text" class="form-control" id="automobile" placeholder="Toyota Corolla XL" autofocus="autofocus">
            <p class="text-danger automobile-brand-status"></p>
      			<p>Plate Number <small class="text-danger">(* Required)</small></p> <input type="text" class="form-control" placeholder="ABC-1234" id="plate_number_input">
            <p class="text-danger automobile-no-status"></p>
      			<p>Color</p> <input type="color" class="form-control" id="color">
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
<script type="text/javascript">$.material.init();</script>
        	
    