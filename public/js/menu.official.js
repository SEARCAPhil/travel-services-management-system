
	function setActive(target,callback){
		$(target).off('click dblclick');
		$(target).on('click dblclick',function(e){
						
			$(target).attr('data-event',e.type)
			$(target).removeClass('active');
			$(this).addClass('active')
			callback(this)
		})
	}




	function assignOfficialPlateNumber(id,plate_number,vehicle_name){
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



	function assignPersonalPlateNumber(id,plate_number,vehicle_name){
		$.ajax({

			url:'api/travel/personal/vehicle/'+id,
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


	function assignCampusPlateNumber(id,plate_number,vehicle_name){
		$.ajax({

			url:'api/travel/campus/vehicle/'+id,
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

	function showVehicleList(callback){
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
			callback(vehicleList)


		});	
	}
	



	function assignVehicle(){
		setActive('.list-item-selection',function(target){

			var content=$(selectedTrips).attr('data-content');
			var json=JSON.parse(content);
			var id=json.id;
			var type=json.type;

			var plate_no=$(target).attr('data-mark');
			var vehicle_name=$(target).attr('data-vehicle');
			
			//bind submit
			$('.modal-submit').off('click');
			$('.modal-submit').on('click',function(e){



				assignPlateNumber(id,plate_no,vehicle_name)
			})


			if($(target).attr('data-event')=='dblclick'){

				if(type=='official'){
					assignOfficialPlateNumber(id,plate_no,vehicle_name)
				}

				if(type=='personal'){
					assignPersonalPlateNumber(id,plate_no,vehicle_name)
				}

				

				if(type=='campus'){
					assignCampusPlateNumber(id,plate_no,vehicle_name)
				}
				
				$('#preview-modal').modal('hide');
			}  
		})
	}







/*
|----------------------------------------------------------------------------
| Driver
|---------------------------------------------------------------------------*/

	
	function assignDriver(){
		setActive('.list-item-selection',function(target){

			var content=$(selectedTrips).attr('data-content');
			var json=JSON.parse(content);
			var id=json.id;
			var type=json.type;
			var current_status=json.status;
			var driver=$(target).attr('data-mark');
			var driver_name=$(target).attr('data-driver');
			//bind submit
			$('.modal-submit').off('click');
			$('.modal-submit').on('click',function(e){
				
				assignDriver(id,driver,driver_name)

			})


			if($(target).attr('data-event')=='dblclick'){

				if(type=='official'){
					assignOfficialDriver(id,driver,driver_name);
				}

				if(type=='personal'){

					assignPersonalDriver(id,driver,driver_name);
				}


				if(type=='campus'){
			
					assignCampusDriver(id,driver,driver_name);
				}


				$('#preview-modal').modal('hide');
			}  


		})
	}


	function assignOtherDriver(){
		var content=$(selectedTrips).attr('data-content');
		var json=JSON.parse(content);
		var id=json.id;
		var type=json.type;
		var current_status=json.status;
		var timeout;
		$('.other-driver-button').hide();
		$('.other-driver').on('keyup',function(){
			clearTimeout(timeout);
			var parent=$('.other-driver');
			timeout=setTimeout(function(){
				if($(parent).val().length<1){
					$('.other-driver-button').hide();
				}else{
					$('.other-driver-button').show();
				}

				bindAssignOtherDriver(type,id,'n/a',$(parent).val())

			},700)

		})

	}



	function assignOfficialDriver(id,driver,driver_name){
		$.ajax({

			url:'api/travel/official/driver/'+id,
			method:'PUT',
			data: { _token: $("input[name=_token]").val(),id:id,driver:driver,driver_name:driver_name},
			success:function(data){


				if(data==1){
					$('.travel-other-details-read-more-'+id).click();
					$('.travel-other-details-driver-'+id).html(driver_name+' <span class="glyphicon glyphicon-ok text-success"></span>')
				}else{
					alert('Oops! Something went wrong.Try to refresh the page')
				}

				$('#preview-modal').modal('hide');
			}
		})
	}

	function assignPersonalDriver(id,driver,driver_name){
		$.ajax({

			url:'api/travel/personal/driver/'+id,
			method:'PUT',
			data: { _token: $("input[name=_token]").val(),id:id,driver:driver,driver_name:driver_name},
			success:function(data){


				if(data==1){
					$('.travel-other-details-read-more-'+id).click();
					$('.travel-other-details-driver-'+id).html(driver_name+' <span class="glyphicon glyphicon-ok text-success"></span>')
				}else{
					alert('Oops! Something went wrong.Try to refresh the page')
				}

				$('#preview-modal').modal('hide');
			}
		})
	}


	function assignCampusDriver(id,driver,driver_name){
		$.ajax({

			url:'api/travel/campus/driver/'+id,
			method:'PUT',
			data: { _token: $("input[name=_token]").val(),id:id,driver:driver,driver_name:driver_name},
			success:function(data){


				if(data==1){
					$('.travel-other-details-read-more-'+id).click();
					$('.travel-other-details-driver-'+id).html(driver_name+' <span class="glyphicon glyphicon-ok text-success"></span>')
				}else{
					alert('Oops! Something went wrong.Try to refresh the page')
				}

				$('#preview-modal').modal('hide');
			}
		})
	}


	function showDriversList(callback){
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


				htm+=`
							<div class="row"><div class="col col-md-1 col-sm-1 col-xs-1">
	
					 		</div>`
					htm+=`<div class="col col-md-8 col-sm-8 col-xs-8">
							<p>
								<input type="text" class="form-control other-driver" placeholder="Other : Specify Driver(Rent a Car only)"/>
							</p>
						</div>
						<div class="col col-md-2 col-sm-2 col-xs-2"><button class="btn btn-xs btn-default other-driver-button">SAVE</button></div>
						</div>`



				$('.driver-section').append(htm)



				callback(driverList)


			});
	}


	function bindAssignOtherDriver(type,id,driver,driver_name){
		$('.other-driver-button').off('click')
		$('.other-driver-button').on('click',function(){

			previewLoadingEffect('#preview-modal-dialog .modal-body')

			if(type=='official'){
					assignOfficialDriver(id,driver,driver_name);
			}

			if(type=='personal'){

				assignPersonalDriver(id,driver,driver_name);
			}


			if(type=='campus'){
		
				assignCampusDriver(id,driver,driver_name);
			}

		})
	}
		
