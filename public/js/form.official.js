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
					changeButtonState('#sourceOfFundFormButton','enabled')
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

	ajax_getLineItem(function(data){

		for(var x=0;x<data.length;x++){

			$('#line_item').append(`<option value="${data[x].line2desc}">${data[x].line2desc.length>0?data[x].line2desc:'Select Line Item'}</option>`)
		}
	})

	$('.modal-submit-funding').on('click',function(){
		var source_of_fund = $('#source_of_fund_field').val()
		var cost_center = $('#cost_center_field').val()
		var line_item = $('#line_item').val()


		//show loading
		showLoading('#officialSourceOfFundSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
					

		//POST
		var data={_token:$('input[name=_token]').val(),fund:source_of_fund,cost_center:cost_center,line_item:line_item,tr_id:form_id}
		$.ajax({
			url:'api/travel/official/fund',
			data:data,
			method:'POST',
			success:function(res){
				var res = JSON.parse(res)
				if(res>0){
					//success
					$('.source_of_fund_section').append(`<p data-menu="fundingMenu" data-selection="${res}" class="contextMenuSelector"><b>${source_of_fund}</b> - <u>${cost_center.length>0?cost_center:'N/A'}</u> - <u>${line_item}</u></p>`)
					//bind menu
					setTimeout(function(){ unbindContext(); context(); },1000);
					setTimeout(function(){
							bindRemoveFund();
					},2000);

					$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-ok text-success"></span>');
					
					//rest form
					$('#funding-form')[0].reset()	
							
				}else{
					alert('Sorry!Unable to Add funding.Please try again later.')
					$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
				}
			},error:function(){
				alert('Sorry!Unable to Add funding.Please try again later.')
				$('#officialSourceOfFundSaveStatus').html('<span class="glyphicon glyphicon-remove text-danger"></span>');
			}
		});	
		

	})
	//$('#sourceOfFundFormButton').on('click',function(){
		//$('#preview-modal-dialog').load('travel/modal/remove',function(data){
	//})
	/*$('#source_of_fund').off('change');
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
	});*/
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

function bindShowSignatorySelector(){
	var data={_token:$('input[name=_token]').val()}
		$.ajax({
			url:'api/directory/signatories',
			data:data,
			method:'GET',
			success:function(res){
				var res = JSON.parse(res)
				if(res.length>0){
					var opt
					for(var x=0;x<res.length; x++){
						console.log(res[x])
						opt+=`<option value="${res[x].account_profile_id}">${res[x].profile_name}</option>`
					}
					$('#form-signatory').html(opt)
				}else{
					alert('Sorry!Unable to show signatories.Please try again later.')
				}
			}
		});	

}

function bindChangeSignatory(){
	$('#signatorySaveButton').off('click')
	$('#signatorySaveButton').on('click',function(){
		var data={_token:$('input[name=_token]').val(),value:$('#form-signatory').val(),id:form_id}
		$.ajax({
			url:'api/travel/official/signatory',
			data:data,
			method:'PUT',
			success:function(res){
				var res = JSON.parse(res)
				if(res==1){
					$('.preview-signatory').html(`<b>${$('#form-signatory')[0].selectedOptions[0].innerText}</b>`)
				
				}else{
					alert('Sorry!Unable to change signatory.Please try again later.')
				}
			}
		});	
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