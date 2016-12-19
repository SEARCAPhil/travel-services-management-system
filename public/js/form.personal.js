function bindPurpose(){

	$('#officialPurposeSaveButton').click(function(e){
		e.preventDefault();
		 showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
			setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)

		if($('#form-purpose').val().length<2){
			$('#officialPurposeSaveStatus').html('<span class="text-danger">Field must not be empty!</span>')	
			return 0;
		}  

		//insert new item to db if not yet saved
		if(form_id<1){
			var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val()}
			$.post('api/travel/personal/purpose',data,function(res){
				//check if created successfully
				if(res>0&&res.length<50){
					form_id=res;

					//change selectedElement id to enable adding passenger
					$(selectedElement).attr('id',form_id);

					
					 $('#officialPurposeSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	

					//passsenger enable
					changeCircleState('.passenger-circle-group')
					changeButtonState('#passengerFormButton','enabled')
				}else{
					alert('Oops something went wrong!Please try again later.')
				}

			}).fail(function(){

				alert('Oops something went wrong!Please try again later.')
			})

		}else{
			//update
			var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val(),id:form_id}


			$.ajax({
				url:'api/travel/personal/purpose',
				data:data,
				method:'PUT',
				success:function(res){
					if(res>0&&res.length<50){
						$('#officialPurposeSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	
					}
				}
			});

		}

	})
}


function bindVehicleType(){
	$('.vehicleTypeFormButton').on('change',function(){
		//status
		$('#personalVehicleTypeSaveStatus').html('saving . . .')
		var data={_token:$('input[name=_token]').val(),vehicle:$(this).val(),id:form_id}

		$.ajax({
				url:'api/travel/personal/vehicle_type',
				data:data,
				method:'PUT',
				success:function(res){
					if(res==1){
						$('#personalVehicleTypeSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	

						//payment enable
						changeCircleState('.payment-circle-group')
						changeButtonState(".paymentFormButton",'enabled')

						changeCircleState('.finished-circle-group')

					}else{
						//status
						$('#personalVehicleTypeSaveStatus').html('Changes not saved!.Please try again later')
						//alert('Sorry!.Please try again later.');
					}
				},
				failed:function(){
					$('#personalVehicleTypeSaveStatus').html('<span class="text-danger" style="color:rgb(255,10,10);">Changes not saved!.Please try again later</span>')
				}
			});
	})

}


function bindPayment(){
	$('.paymentFormButton').on('change',function(){
		//status
		$('#paymentSaveStatus').html('saving . . .')
		var data={_token:$('input[name=_token]').val(),payment:$(this).val(),id:form_id}

		$.ajax({
				url:'api/travel/personal/payment',
				data:data,
				method:'PUT',
				success:function(res){
					if(res==1){
						$('#paymentSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	

						//payment enable
						changeCircleState('.finished-circle-group')


					}else{
						//status
						$('#paymentSaveStatus').html('Changes not saved!.Please try again later')
						//alert('Sorry!.Please try again later.');
					}
				},
				failed:function(){
					$('#paymentSaveStatus').html('<span class="text-danger" style="color:rgb(255,10,10);">Changes not saved!.Please try again later</span>')
				}
			});
	})

}

