<div class="modal-content">
	<div class="modal-body">
		<h3>Vehicle</h3>
		<p>Assign vehicle for this travel</p><hr/><br/>

		<div class="row">
			<div class="col col-md-12 driver-section">
			</div>
	  	</div>

	</div>

	<div class="modal-footer">
		<button class="btn btn-primary modal-submit"  data-dismiss="modal" aria-label="Proceed">Proceed</button>
		<button class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
	</div>

</div>



<script type="text/javascript" src="js/itenerary.official.js"></script>
<script type="text/javascript">

	ajax_getVehiclesList(function(vehicleList){
		var htm='';
		for(x of vehicleList){
			htm+=`
					<div class="row" style="margin-bottom:10px;"><div class="col col-md-1 col-sm-1 col-xs-1">
			 			<div class="profile-image  profileImage profile-image-requester" data-mode="staff" style="font-size:1.2em;background:`+x.color+`;color:rgb(255,255,255);padding-top:8px;">
			 				`+x.brand.charAt(0)+`
			 			</div>
			 		</div>`
			htm+=`<div class="col col-md-11 col-sm-11 col-xs-11">
						<p>`+x.brand+`</p>
						<p>`+x.id+`</p>
					</div>
				</div>`
			htm+=`<div style="clear:both;"></div>`;

	
			
		}

		$('.driver-section').append(htm)
	});
</script>


