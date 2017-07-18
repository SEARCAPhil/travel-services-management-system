<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
      <div class="row upload-image-section">
          <div class="col col-md-12 col-sm-12 text-center">
            <center><img src="img/upload.png" width="25%"></center>
            <h3 class="ng-scope">Upload Image</h3>
            <p>Select image (.png,.jpg, .jpeg, .gif) not greater than <em>5MB</em></p><br/>

           
            <button type="button" class="btn btn-lg btn-primary" onclick="$('#auto-mobile-fie-input').click()"><span class="glyphicon glyphicon-paperclip"></span></button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">SKIP/CANCEL</button>

            <div class="output"></div>

          </div>
      		<form  class="form col col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 text-left" id="form">
      			<input type="file" name="cover" style="display:none;" id="auto-mobile-fie-input">
      		</form>

          <div style="clear:both;"></div>
          <div id="form-status"></div>
      </div>
	</div>

</div>
<script type="text/javascript" src="js/automobile.upload.js"></script>

        	
    