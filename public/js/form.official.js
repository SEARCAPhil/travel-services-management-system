function bindOfficialPurposeSaveButton(){
	$('#officialPurposeSaveButton').click(function(e){
		e.preventDefault();
		//loading
		 showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
			setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)
		


		if($('#form-purpose').val().length<2) return 0;


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

					}
				}
			});

		}

			

	})
}
