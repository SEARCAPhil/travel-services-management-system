
function ajax_getGasolineLedger(plate_no,year,month,callback){

	$.get('automobile/gasoline/ledger/'+plate_no+'/'+year+'/'+month,function(json){
			callback(json)
	});

}

function ajax_removeGasoline(id,callback){
	$.ajax({

		url:'automobile/gasoline/'+id,
		method:'DELETE',
		data: { _token: $("input[name=_token]").val(),id:id},
		success:function(data){
			if(data==1){
				callback(data)
			}else{
				alert('Oops! Something went wrong.Try to refresh the page')
			}
		},error:function(){
			$('#preview-modal').modal('hide');
			alert('Oops! Something went wrong.Try to refresh the page')
		}
	})


}


function ajax_postGasoline(liters,amount,receipt,station,plate_no,callback){
	$.post('automobile/gasoline/'+plate_no,{_token:$('input[name=_token]').val(),liters:liters,amount:amount,receipt:receipt,station:station,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}
	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}



function formCompleted(plate_no){
	$('#form').hide();
	var htm=`<center>
				<!--<div style="width:60px;height:60px;background:rgb(0,200,150);color:rgb(255,255,255);border-radius:50%;text-align:center;overflow:hidden;font-size:3em;" class="text-success"><span class="glyphicon glyphicon-ok"></span></div>-->
				<p class="text-success"><i class="material-icons text-success">check_circle</i>Added Succefully! <button class="btn btn-success btn-sm" id="add-more">Add more + </button></p>
				
			</center>`;
	$('#form-status').html(htm)

	$('#add-more').click(function(){
		$('#form')[0].reset();
		$('#form-status').html(' ');
		$('#form').slideDown();

	})

	//refresh section fo this month
	var date=new Date();
	var year=date.getFullYear();
	var month=date.getMonth();

	showGasolineLedger(plate_no,year,month+1)
}



function showGasolineLedger(plate_no,year,month){

	var months=['January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September','October', 'November', 'December'];

	//loading
	$('#'+month).html('<span class="loading-circle"> . . . . . .</span>');
	

	ajax_getGasolineLedger(plate_no,year,month,function(json){
		var data=JSON.parse(json);
		var items=data.items	

		var htm=`
				<h3 style="color:#f39c12;">`+months[month-1]+`</h3>
				<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> `+year+`</p>
				<div class="ledgerContent">
				<div style="border:1px solid rgb(60,60,60)"></div>
					<div class="table-fluid">
						<table class="ledgerContentTable table table-striped">
							<thead class="text-muted">
								<tr>
									<th>Date</th>
									<th>Liters</th> 
									<th>Amount</th> 
									<th>Shop/Station</th>
									<th>Receipt</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								`;

			for(var y=0;y<items.length;y++){

				
				htm+=`<tr>
						<td style="position:relative;">
							<div class="date-tags">`+new Date(items[y].date_created).getDate()+`<span class="caret"></span></div>
							`+(items[y].date_created).split(' ')[0]+`
						</td>
						<td class="">`+items[y].liters+`</td> 
						<td class="" style="color:rgb(32,199,150);">`+items[y].amount+`</td> 
						<td class="">`+items[y].station+`</td>
						<td class="">`+items[y].receipt+`</td> 
						<td>
							<button type="button" class="btn btn-default btn-xs remove-ledger-item" data-content="`+items[y].id+`" data-amount="`+items[y].amount+`" data-month="`+month+`" style="text-shadow:none;">Remove 
								<i class="material-icons md-18">remove</i>
							</button>
						</td>
					</tr>`;

			}
					
			


			htm+=`				</tbody>
						</table>

							<p class="pull-right ng-binding"> Total amount : <span style="color:rgb(32,199,150);">Php <span id="total-`+month+`">`+data.grand_total+`</span><span> </p>
					</div>
				</div>
			`;

			$('#'+month).html(' ');

			if(items.length>0){
				$('#'+month).html(htm)
			}


			$('.remove-ledger-item').off('click');
			$('.remove-ledger-item').on('click',function(){
				var target=this
				showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
					//remove
					$('.modal-submit').click(function(){

						var id=$(target).attr('data-content')
						var month=$(target).attr('data-month')
						var amount=$(target).attr('data-amount')

						var total_amount=$('#total-'+month).html();

						//remove , from number
						var total=total_amount.split(',');
						var parsed_total="";
						for(let x of total){
							parsed_total+=x;

						}


						
						var updated_amount=(parseFloat(parsed_total))-(parseFloat(amount));

						

						$('.modal-body').html('Removing . . .')


							ajax_removeGasoline(id,function(){

								$('.modal-body').html('<h3 class="text-success">Deleted Successfully! <span class="glyphicon glyphicon-ok"></span></h3>')
								$(target).parent().parent().fadeOut();

								console.log(updated_amount)

								//update amount
								$('#total-'+month).html(updated_amount);

								setTimeout(function(){ $('#preview-modal').modal('hide'); },1000);
							})

						
					})

				})
			})

			



	})
}

function bindGasolineLedger(plate_no,year){

	for(var x=1;x<=12;x++){

	 	showGasolineLedger(plate_no,year,x)
	}

}
