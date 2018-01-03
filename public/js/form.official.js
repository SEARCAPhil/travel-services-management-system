/**
* OFFICIAL TRAVEL REQUEST FORM SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*/



/*
|----------------------------------------------------------------------------
| Bind Save purpose
|---------------------------------------------------------------------------
*/

function bindOfficialPurposeSaveButton(){
	$('#officialPurposeSaveButton').off('click')
	$('#officialPurposeSaveButton').on('click',function(e){
		e.preventDefault();

		if($('#form-purpose').val().length<2){
			alert('Sorry!Unable to handle request.Please check all the fields if not empty.')
			return 0;
		} else{
			//loading
			showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
			setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)
		}
		
		var type='official'

		document.querySelectorAll('input[name="request_type"]').forEach((el,index)=>{
			if(el.checked){
				type=el.value
			}
		})

		//insert new item to db if not yet saved
		if(form_id<1){
			var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val(),type:type}
			$.post('api/travel/official/purpose',data,function(res){
				if(res>0&&res.length<50){
					form_id=res;

					//change selectedElement id to enable adding passenger
					$(selectedElement).attr('id',form_id);

					//show success status
					$('#officialPurposeSaveStatus').html('<span class="glyphicon glyphicon-ok text-success"></span>');
					//passsenger enable
					changeCircleState('.passenger-circle-group')
					changeButtonState('#passengerFormButton','enabled')
					changeButtonState('#iteneraryFormButton','enabled')
					changeButtonState(".paymentFormButton",'enabled')
					changeButtonState('.vehicleTypeFormButton','enabled')
					changeButtonState('#source_of_fund','enabled')
					changeButtonState('#notesSaveButton','enabled')
				}
			});
		}else{
			//update
			var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val(),id:form_id}


			$.ajax({
				url:'api/travel/official/purpose',
				data:data,
				method:'PUT',
				success:function(res){
					if(res>0&&res.length<50){
						alert('Updated Successfully!')
					}else{
						alert('Sorry!Unable to handle request.Please try again later.')
					}
				}
			});

		}

			

	})
}


function bindSourceOfFund(){
	$('#source_of_fund').off('change');
	$('#source_of_fund').on('change',function(){
					//update
			var data={_token:$('input[name=_token]').val(),source_of_fund:$(this).val(),id:form_id}

			$.ajax({
				url:'api/travel/official/fund',
				data:data,
				method:'PUT',
				success:function(res){
					if(res>0&&res.length<50){
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-ok text-success"></span>');
					}else{
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
					}
				}
			});
	});
}


function bindOtf(callback){
	$('#otf-fundings').off('change');
	$('#otf-fundings').on('change',function(){
			//clear name
			$('#otf-fundings-project-name').val('')
				
			var data={_token:$('input[name=_token]').val(),project:$(this).val(),id:form_id}

			$('#officialSourceOfFundSaveStatus').html('saving . . .');
			$.ajax({
				url:'api/travel/official/projects',
				data:data,
				method:'POST',
				success:function(res){
					if(res>0&&res.length<50){
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-ok text-success"></span>');
							//enable finished circle on forms
							changeCircleState('.finished-circle-group')
							callback(res)
					}else{
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
					}
				},error:function(){
					$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
				}
			});
	});
}


function bindOtfSelection(callback=function(){}){
	$('#source_of_fund').change(function(e){
		if($(this).val()=='otf'){
			$('#otf-fundings-project-name').show().val('');
			$('#otf-funding-section').show();
			//custom project name
			bindOtfProjectInput();

			$.get('api/travel/official/projects',function(json){
				var data=JSON.parse(json);
				var htm='<option value="N/A">Select project</option>'

				for(var x=0;x<data.length;x++){
				
					htm+='<option>'+data[x].title+'</option>';
				}

				$('#otf-fundings').html(htm)
				callback(json)
				bindOtf()
			}).fail(function(){
				alert('failed loading project list');
			})
		}else{
			$('#otf-funding-section').hide();
			$('#otf-fundings-project-name').val('')
		}
	})
}

function bindOtfProjectInput(){
	var timeout;

	$('#otf-fundings-project-name').off('keyup')
	$('#otf-fundings-project-name').on('keyup',function(){
		var parent=this;
		clearTimeout(timeout)

		timeout=setTimeout(function(){
			var data={_token:$('input[name=_token]').val(),project:$(parent).val(),id:form_id}

			$('#officialSourceOfFundSaveStatus').html('saving . . .');
			$.ajax({
				url:'api/travel/official/projects',
				data:data,
				method:'POST',
				success:function(res){
					if(res>0&&res.length<50){
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-ok text-success"></span>');
							//enable finished circle on forms
							changeCircleState('.finished-circle-group')
							callback(res)
					}else{
						$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
					}
				},error:function(){
					$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
				}
			});
		},700)

	})
}



/*
|----------------------------------------------------------------------------
| Bind Save purpose
|---------------------------------------------------------------------------
| 
| Select vehicle type on form
|
*/

function bindVehicleType(){
	$('.vehicleTypeFormButton').on('change',function(){
		//status
		$('#personalVehicleTypeSaveStatus').html('saving . . .')
		var data={_token:$('input[name=_token]').val(),vehicle:$(this).val(),id:form_id}

		$.ajax({
				url:'api/travel/official/vehicle_type',
				data:data,
				method:'PUT',
				success:function(res){
					if(res==1){
						$('#personalVehicleTypeSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	

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




/*
|----------------------------------------------------------------------------
| Bind Save payment
|---------------------------------------------------------------------------
| 
| Change Payment type
|
*/
function bindPayment(){
	$('.paymentFormButton').on('change',function(){
		//status
		$('#paymentSaveStatus').html('saving . . .')
		var data={_token:$('input[name=_token]').val(),payment:$(this).val(),id:form_id}

		$.ajax({
				url:'api/travel/official/payment',
				data:data,
				method:'PUT',
				success:function(res){
					if(res==1){
						$('#paymentSaveStatus').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>')	

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


function bindRequestType(){
	$('[name="request_type"]').off('change')
	$('[name="request_type"]').on('change',function(){ 

		if(this.value=='official'){
			$('.show-for-trp-only').hide()
		}


		if(this.value=='personal'){
			$('.show-for-trp-only').show()
		}

		if(this.value=='campus'){
			$('.show-for-trp-only').hide()
		}

	})
}


/*
|----------------------------------------------------------------------------
| Bind NOTES
|---------------------------------------------------------------------------
*/

function bindNotesSaveButton(){
	$('#notesSaveButton').off('click')
	$('#notesSaveButton').on('click',function(e){
		e.preventDefault();

		if($('#form-notes').val().length<2){
			alert('Sorry!Unable to handle request.Please check all the fields if not empty.')
			return 0;
		} else{
			//loading
			showLoading('#notesSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
			setTimeout(function(){  showLoading('#notesSaveStatus') },1000)
		}
		

		//update
		var data={_token:$('input[name=_token]').val(),notes:$('#form-notes').val(),id:form_id}


		$.ajax({
			url:'api/travel/official/notes',
			data:data,
			method:'PUT',
			success:function(res){
				if(res>0&&res.length<50){
					alert('Updated Successfully!')
				}else{
					alert('Sorry!Unable to handle request.Please try again later.')
				}
			}
		});	

	})
}