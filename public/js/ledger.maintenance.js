function ajax_getMaintenanceLedger(plate_no,year,month,callback){

	$.get('automobile/maintenance/ledger/'+plate_no+'/'+year+'/'+month,function(json){
			callback(json)
	});

}

function ajax_removeParts(id,callback){
	$.ajax({

		url:'automobile/replace/'+id,
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


function ajax_removeOil(id,callback){
	$.ajax({

		url:'automobile/oil/'+id,
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



function showMaintenanceLedger(plate_no,year,month){

	var months=['January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September','October', 'November', 'December'];

	//loading
	$('#'+month).html('<span class="loading-circle"> . . . . . .</span>');
	

	ajax_getMaintenanceLedger(plate_no,year,month,function(json){
		var data=JSON.parse(json);
		var items=data[0].items	



		var htm=`
				<h3 style="color:#f39c12;">`+months[month-1]+`</h3>
				<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> 2016</p>
				<div class="ledgerContent">
				<div style="border:1px solid rgb(60,60,60)"></div>
					<div class="table-fluid">
						<table class="ledgerContentTable table table-striped">
							<thead class="text-muted"><tr><th>Date</th><th>Automobile</th> <th>PARTICULARS</th> <th>Details</th> <th>Amount</th><th>Shop/Station</th><th></th></tr></thead>
							<tbody>
								`;

			for(var y=0;y<items.length;y++){

				
				htm+=`<tr>
						<td style="position:relative;">
							<div class="date-tags">`+new Date(items[y].date_created).getDate()+`<span class="caret"></span></div>
							`+(items[y].date_created).split(' ')[0]+`
						</td>
						<td><b>`+items[y].plate_no+`</b></td> 
						<td class="">`+items[y].item+`</td> 
						<td class="">`+items[y].details+`</td> 
						<td class="" style="color:rgb(32,199,150);">`+items[y].amount+`</td> 
						<td class="">`+items[y].station+`</td>
						<td>
							<span class="glyphicon glyphicon-remove text-muted remove-ledger-item" data-type="`+items[y].type+`" data-content="`+items[y].id+`" data-amount="`+items[y].amount+`" data-month="`+month+`"></span>
						</td>
					</tr>`;

			}
					
			


			htm+=`				</tbody>
						</table>
						<span class="pull-right"> &nbsp;&nbsp; 
							<span class="btn btn-xs btn-default" print-ledger="6"><span class="glyphicon glyphicon-print"></span> print </span></span> 
							<p class="pull-right ng-binding"> Total amount : <span style="color:rgb(32,199,150);">Php <span id="total-`+month+`">`+data[0].grand_total+`</span><span> </p>
					</div>
				</div>
			`;

			$('#'+month).html(' ');

			if(items.length>0){
				$('#'+month).html(htm)
			}else{
				/*var htm=`
					<div style="width:100%;background:rgb(70,70,70);margin-bottom:20px;margin-top:10px;padding:2px;text-align:center;color:rgb(180,180,180);opacity:0.2;"><h3>`+months[month-1]+`</h3></div>

				`;
				$('#'+month).html(htm)*/
			}
			

			$('.remove-ledger-item').off('click');
			$('.remove-ledger-item').on('click',function(){
				var target=this
				showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/remove',function(){
					//remove
					$('.modal-submit').click(function(){
						var type=$(target).attr('data-type')
						var id=$(target).attr('data-content')
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


						
						var updated_amount=parseFloat((parseFloat(parsed_total))-(parseFloat(amount)));


						$('.modal-body').html('Removing . . .')

						//repair
						if(type=='repair'||type=='replace'){
							ajax_removeParts(id,function(){
								$('.modal-body').html('<h3 class="text-success">Deleted Successfully! <span class="glyphicon glyphicon-ok"></span></h3>')
								$(target).parent().parent().fadeOut();


								//update amount
								$('#total-'+month).html(updated_amount);

								setTimeout(function(){ $('#preview-modal').modal('hide'); },1000);
							})

						}


						//oil
						if(type=='oil'){
							ajax_removeOil(id,function(){
								$('.modal-body').html('<h3 class="text-success">Deleted Successfully! <span class="glyphicon glyphicon-ok"></span></h3>')
								$(target).parent().parent().fadeOut();

								//update amount
								$('#total-'+month).html(updated_amount);

								setTimeout(function(){ $('#preview-modal').modal('hide'); },1000);
							})

						}

						
						
					})

				})
			})


	})
}

function bindMaintenanceLedger(plate_no,year){

	for(var x=1;x<=12;x++){

	 	showMaintenanceLedger(plate_no,year,x)
	}

}

