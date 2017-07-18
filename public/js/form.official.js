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
		

		//insert new item to db if not yet saved
		if(form_id<1){
			var data={_token:$('input[name=_token]').val(),purpose:$('#form-purpose').val()}
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
		$('#otf-funding-section').show();
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
	}
})
}
