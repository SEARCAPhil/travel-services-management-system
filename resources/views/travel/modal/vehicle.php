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

	function setActive(target,callback){
		$(target).on('click dblclick',function(e){
						
			$(target).attr('data-event',e.type)
			$(target).removeClass('active');
			$(this).addClass('active')
			callback(this)
		})
	}




	function assignPlateNumber(id,plate_number,vehicle_name){
		$.ajax({

			url:'api/travel/official/vehicle/'+id,
			method:'PUT',
			data: { _token: $("input[name=_token]").val(),id:id,plate_no:plate_number},
			success:function(data){


				if(data==1){
					$('.travel-other-details-read-more-'+id).click();
					$('.travel-other-details-vehicle-'+id).html(vehicle_name+' '+plate_number+' <span class="glyphicon glyphicon-ok text-success"></span>')
				}else{
					alert('Oops! Something went wrong.Try to refresh the page')
				}
			}
		})
	}


	ajax_getVehiclesList(function(vehicleList){
		var htm='';
		for(x of vehicleList){
			htm+=`
					<div class="row list-item-selection" data-mark="`+x.id+`" data-vehicle="`+x.brand+`"><div class="col col-md-1 col-sm-1 col-xs-1">
			 			<div class="profile-image  profileImage profile-image-requester" data-mode="staff" style="font-size:1.2em;background:`+x.color+`;color:rgb(255,255,255);padding-top:8px;">
			 				`+x.brand.charAt(0)+`
			 			</div>
			 		</div>`
			htm+=`<div class="col col-md-11 col-sm-11 col-xs-11">
						<p>`+x.brand+`</p>
						<p>`+x.id+`</p>
					</div>
				</div>`
		
		}

		$('.driver-section').append(htm)
		assignVehicle()


	});


	function assignVehicle(){
		setActive('.list-item-selection',function(target){

			var content=$(selectedTrips).attr('data-content');
			var json=JSON.parse(content);
			var id=json.id;

			var plate_no=$(target).attr('data-mark');
			var vehicle_name=$(target).attr('data-vehicle');
			
			//bind submit
			$('.modal-submit').off('click');
			$('.modal-submit').on('click',function(e){


				assignPlateNumber(id,plate_no,vehicle_name)
			})

			if($(target).attr('data-event')=='dblclick'){
				assignPlateNumber(id,plate_no,vehicle_name)
				$('#preview-modal').modal('hide');
			}  
		})
	}
</script>
