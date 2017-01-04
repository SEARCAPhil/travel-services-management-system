
function ajax_getCampusTravelListPreview(id,callback){
	$.get('api/travel/campus/preview/'+id,function(json){
		preview=JSON.parse(json)
		callback(preview);
		return preview;
	})
}


function ajax_getCampusTravelItenerary(id,callback){
	$.get('api/travel/campus/itenerary/'+id,function(json){
		official_travel_itenerary=JSON.parse(json)
		callback(official_travel_itenerary);
		return official_travel_itenerary;
	})
}





function showCampusTravelListPreview(id){
	ajax_getCampusTravelListPreview(id,function(json){
		$('.preview-id').html(preview[0].id)
		$('.preview-name').html(preview[0].profile_name)
		$('.preview-unit').html(preview[0].department)
		$('.preview-created').html(((preview[0].date_created).split(' '))[0])
		$('.preview-purpose').html(preview[0].purpose)


		
	})
}


function showCampusTravelItenerary(id){
	ajax_getCampusTravelItenerary(id,function(official_travel_itenerary){
		itenerary_count=0;
		for(var x=0; x<official_travel_itenerary.length;x++){
			itenerary_count++;
			showTotalIteneraryCount();
			var htm=`<details id="official_travel_itenerary`+official_travel_itenerary[x].id+`" data-menu="iteneraryMenu" data-selection="`+official_travel_itenerary[x].id+ `" class="contextMenuSelector official_travel_itenerary`+official_travel_itenerary[x].id+` col col-md-12">
					<summary>`+official_travel_itenerary[x].location+` - `+official_travel_itenerary[x].destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>`+official_travel_itenerary[x].location+`</td>
								<td>`+official_travel_itenerary[x].destination+`</td>
								<td>`+official_travel_itenerary[x].departure_date+`</td>
								<td>`+official_travel_itenerary[x].departure_time+`</td>
							</tr>
						</tbody>
					</table>
				</details>
			`

			$('.preview-itenerary').append(htm)
			setTimeout(function(){ context() },1000);
		}



	});
	
	
	
}

function removeCampusTravelRequest(id){

	    	$('.modal-submit').on('click',function(){

	    		//loading
	    		previewLoadingEffect()
	    		
	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		$(this).html('Removing . . .')

	    		$.ajax({

	    			url:'api/travel/campus/'+id,
	    			method:'DELETE',
	    			data: { _token: $("input[name=_token]").val()},
	    			success:function(data){
	    				if(data==1){
	    					//ajax here
				    		setTimeout(function(){

				    			$('.preview-content').fadeOut()

				    			var nextItem=$(selectedElement).next();
				    			$(selectedElement).remove();

				    			//select next
				    			$(nextItem).click()
				    			
				    		},1000)

				    		$('#preview-modal').modal('hide');
	
	    				}else{
	    					alert('Oops! Something went wrong.Try to refresh the page')
	    				}
	    			}
	    		})

	    		
	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	
}


function removeCampusTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/campus/itenerary/',id);
	    })
	});

	$('#preview-modal').modal('toggle');
	
}



function bindRemoveItenerary(){
	$('.removeIteneraryButton').off('click');
	$('.removeIteneraryButton').on('click',function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeCampusTravelItenerary(context)
	})
}


