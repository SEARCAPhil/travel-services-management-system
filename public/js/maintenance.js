

function ajax_postReplaceParts(item,details,amount,receipt,supplier,plate_no,callback){
	$.post('automobile/replace/'+plate_no,{_token:$('input[name=_token]').val(),item:item,details:details,amount:amount,receipt:receipt,supplier:supplier,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}
	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}


function ajax_postRepairParts(item,details,amount,receipt,supplier,plate_no,callback){
	$.post('automobile/repair/'+plate_no,{_token:$('input[name=_token]').val(),item:item,details:details,amount:amount,receipt:receipt,supplier:supplier,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}


	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}


function ajax_postOil(oil,amount,receipt,station,mileage,plate_no,callback){
	$.post('automobile/oil/'+plate_no,{_token:$('input[name=_token]').val(),oil:oil,amount:amount,receipt:receipt,station:station,plate_no:plate_no,mileage:mileage},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}

	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}

function formCompleted(){
	$('#form').hide();
	var htm=`<center>
				<p class="text-success"><i class="material-icons text-success">check_circle</i>Added Succefully! <button class="btn btn-success btn-sm" id="add-more">Add more + </button></p>
			</center>`;
	$('#form-status').html(htm)

	$('#add-more').click(function(){
		$('#form')[0].reset();
		$('#form-status').html(' ');
		$('#form').slideDown();

	})
}


function bindMaintenance(){
	unbindAjaxLoad();
	ajaxLoad(function(content){

		//replace
		if(content=='automobile/modal/replace'){
			$('#add-button-replace').off('click');
			$('#add-button-replace').on('click',function(){
				var item=$('#item').val();
				var details=$('#details').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var supplier=$('#supplier').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))

				var error=[];

				$('.repair-item-status').html('')
				$('.repair-details-status').html('')
				$('.repair-amount-status').html('')


				if(validator.isEmpty(item)){
					$('.repair-item-status').html('<div class="alert alert-danger">Item must not be empty!</div>')
					error.push('item');
				}

				if(validator.isEmpty(details)){
					$('.repair-details-status').html('<div class="alert alert-danger">Details could not be empty!</div>')
					error.push('status');
				}

				if(validator.isEmpty(amount)){
					$('.repair-amount-status').html('<div class="alert alert-danger">Amount could not be empty!</div>')
					error.push('amount');
				}

				if(!validator.isNumeric(amount)&&!validator.isFloat(amount)){
					$('.repair-amount-status').html('<div class="alert alert-danger">Invalid amount</div>')
					error.push('amount');
				}


				//no error
				if(error.length===0){
					$(this).attr('disabled','disabled')
					ajax_postReplaceParts(item,details,amount,receipt,supplier,plate_no,function(){
						formCompleted()
					})
					$('#add-button-replace').attr('disabled','enabled')
				}

				

			})
		}


		//repair
		if(content=='automobile/modal/repair'){
			$('#add-button-replace').off('click');
			$('#add-button-replace').on('click',function(){
				var item=$('#item').val();
				var details=$('#details').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var supplier=$('#supplier').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))

				var error=[];

				$('.repair-item-status').html('')
				$('.repair-details-status').html('')
				$('.repair-amount-status').html('')


				if(validator.isEmpty(item)){
					$('.repair-item-status').html('<div class="alert alert-danger">Item must not be empty!</div>')
					error.push('item');
				}

				if(validator.isEmpty(details)){
					$('.repair-details-status').html('<div class="alert alert-danger">Details must not be empty!</div>')
					error.push('status');
				}

				if(validator.isEmpty(amount)){
					$('.repair-amount-status').html('<div class="alert alert-danger">Amount must not be empty!</div>')
					error.push('amount');
				}

				if(!validator.isNumeric(amount)&&!validator.isFloat(amount)){
					$('.repair-amount-status').html('<div class="alert alert-danger">Invalid amount</div>')
					error.push('amount');
				}


				//no error
				if(error.length===0){
						
					ajax_postRepairParts(item,details,amount,receipt,supplier,plate_no,function(){
						formCompleted()
					})

				}


			})
		}


		//oil
		if(content=='automobile/modal/oil'){
			$('#add-button-replace').off('click');
			$('#add-button-replace').on('click',function(){
				var oil=$('#oil').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var station=$('#station').val();
				var mileage=$('#mileage').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))


				var error=[];

				$('.oil-mileage-status').html('')
				$('.oil-amount-status').html('')
				$('.oil-status').html('')


				if(validator.isEmpty(oil)){
					$('.oil-status').html('<div class="alert alert-danger">Item must not be empty!/div>')
					error.push('oil');
				}

				if(validator.isEmpty(mileage)&&!validator.isNumeric(mileage)&&!validator.isFloat(mileage)){
					$('.oil-mileage-status').html('<div class="alert alert-danger">Invalid Mileage!</div>')
					error.push('mileage');
				}

				if(validator.isEmpty(amount)){
					$('.oil-amount-status').html('<div class="alert alert-danger">Amount could not be empty!</div>')
					error.push('amount');
				}

				if(!validator.isNumeric(amount)&&!validator.isFloat(amount)){
					$('.oil-amount-status').html('<div class="alert alert-danger">Invalid amount</div>')
					error.push('amount');
				}


				//no error
				if(error.length===0){
					
					ajax_postOil(oil,amount,receipt,station,mileage,plate_no,function(){
						formCompleted()
					})

				}



			})
		}


	});
}
