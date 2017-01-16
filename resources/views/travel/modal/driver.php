<div class="modal-content">
	<div class="modal-body">
		<h3>Driver</h3>
		<p>Assign driver for this travel</p><hr/><br/>

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

		
	function setActive(target,callback){
		$(target).on('click  dblclick',function(e){
			$(target).attr('data-event',e.type)
			$(target).removeClass('active');
			$(this).addClass('active')
			callback(this)
		})
	}

	function assignDriver(id,driver,driver_name){
		$.ajax({

			url:'api/travel/official/driver/'+id,
			method:'PUT',
			data: { _token: $("input[name=_token]").val(),id:id,driver:driver},
			success:function(data){


				if(data==1){
					$('.travel-other-details-read-more-'+id).click();
					$('.travel-other-details-driver-'+id).html(driver_name+' <span class="glyphicon glyphicon-ok text-success"></span>')
				}else{
					alert('Oops! Something went wrong.Try to refresh the page')
				}
			}
		})
	}
		
	ajax_getDriversList(function(driverList){

		var htm='';
		for(x of driverList.data){
			htm+=`
					<div class="row list-item-selection" data-mark="`+x.profile_id+`" data-driver="`+x.first_name+` `+x.last_name+`"><div class="col col-md-1 col-sm-1 col-xs-1">
			 			<div class="profile-image  profileImage profile-image-requester" data-mode="staff" style="font-size:1.2em;background:rgb(0,150,200);color:rgb(255,255,255);padding-top:8px;">
			 				`+x.first_name.charAt(0)+`
			 			</div>
			 		</div>`
			htm+=`<div class="col col-md-11 col-sm-11 col-xs-11"><p>`+x.first_name+` `+x.last_name+`</p></div></div>`

		}


		$('.driver-section').append(htm)



		setActive('.list-item-selection',function(target){
			var content=$(selectedTrips).attr('data-content');
			var json=JSON.parse(content);
			var id=json.id;
			var current_status=json.status;
			var driver=$(target).attr('data-mark');
			var driver_name=$(target).attr('data-driver');
			//bind submit
			$('.modal-submit').off('click');
			$('.modal-submit').on('click',function(e){
				
				

		
				assignDriver(id,driver,driver_name)

			})


			if($(target).attr('data-event')=='dblclick'){
				assignDriver(id,driver,driver_name)
				$('#preview-modal').modal('hide');
			}  


		})



	});
</script>


