<div class="modal-content" style="color:rgb(40,40,40);">
	<div class="modal-body">
      <div class="row">
          <div class="col col-md-12 col-sm-12 text-center">
            <center><img src="img/upload.png" width="40%"></center>
            <h3 class="ng-scope">UploadImage</h3>
            <p>Select image (.png,.jpg, .jpeg, .gif) not greater than 5MB</p><br/>

            <h1><button type="button" class="btn btn-lg" onclick="$('#auto-mobile-fie-input').click()"><span class="glyphicon glyphicon-paperclip"></span></button></h1>

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
        	
    