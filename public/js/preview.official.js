
// placeholder
var preview;
var scholars;
var staff;
var passenger_count=0;
var itenerary_count=0;
var official_travel_custom_passenger;
var official_travel_itenerary;
var contextSelectedElement;
var active_page='';
var form_id=0; //equivelent to the tr_id

function ajax_getOfficialTravelListPreview(id,callback){
	$.get('api/travel/official/preview/'+id,function(json){
		preview=JSON.parse(json)
		callback(preview);
		return preview;
	})
}


function ajax_getOfficialTravelPassengerScholarsPreview(id,callback){

	$.get('api/travel/official/scholars/'+id,function(json){
		scholars=JSON.parse(json)
		callback(scholars);
		return scholars;
	})

}

function ajax_getOfficialTravelPassengerStaffPreview(id,callback){

	$.get('api/travel/official/staff/'+id,function(json){
		staff=JSON.parse(json)
		callback(staff);
		return staff;
	})
}

function ajax_getOfficialTravelPassengerCustomPreview(id,callback){


	$.get('api/travel/official/custom/'+id,function(json){
		official_travel_custom_passenger=JSON.parse(json)
		callback(official_travel_custom_passenger);
		return official_travel_custom_passenger;
	})

	
}




function ajax_getOfficialTravelItenerary(id,callback){
	$.get('api/travel/official/itenerary/'+id,function(json){
		official_travel_itenerary=JSON.parse(json)
		callback(official_travel_itenerary);
		return official_travel_itenerary;
	})
}




function showTotalPassengerCount(){
	$('.passenger-count').html(passenger_count)
}

function showTotalIteneraryCount(){
	$('.itenerary-count').html(itenerary_count)
}

function showOfficialTravelListPreview(id){
	ajax_getOfficialTravelListPreview(id,function(json){
		$('.preview-name').html(preview[0].profile_name)
		$('.preview-unit').html(preview[0].department)
		$('.preview-created').html(((preview[0].date_created).split(' '))[0])
		$('.preview-purpose').html(preview[0].purpose)

	})
	

}

function showOfficialTravelPassengerStaffPreview(id){
	ajax_getOfficialTravelPassengerStaffPreview(id,function(staff){

			
			for(var x=0;x<staff.length;x++){
				passenger_count++;
				showTotalPassengerCount()
				var htm=`<tr data-menu="staffPassengerMenu" context="0" data-selection="`+staff[x].id+`" id="official_travel_staff_passenger_tr`+staff[x].id+`" class="contextMenuSelector official_travel_staff_passenger_tr`+staff[x].id+`">
									<td>
										<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+staff[x].profile_image+`" data-mode="staff" style="background: url('/profiler/profile/`+staff[x].profile_image+`') center center no-repeat;background-size:cover;"></div></div>
										<div class="col col-md-9"><b>`+staff[x].name+`</b></div></td>

									
									<td>`+staff[x].designation+`</td>
									<td>`+staff[x].office+`</td>
								</tr>`
				$('.preview-passengers').append(htm)
			}
			
			setTimeout(function(){ context() },1000);


	});
	
}


function showOfficialTravelPassengerScholarsPreview(id){
	
	ajax_getOfficialTravelPassengerScholarsPreview(id,function(scholars){
		
		for(var x=0;x<scholars.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			var htm=''
			 htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+scholars[x].id+`" id="official_travel_scholars_passenger_tr`+scholars[x].id+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+scholars[x].id+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+scholars[x].profile_image+`" data-mode="scholars"></div></div>
									<div class="col col-md-9"><b>`+scholars[x].full_name+`</b></div></td>

								
								<td>`+scholars[x].nationality+`</td>
								<td>`+scholars[x].office+`</td>
							</tr>`
			$('.preview-passengers').append(htm);
			
		}

		
		setTimeout(function(){ context() },2000);	
	});
	
}


function showOfficialTravelPassengerCustomPreview(id){
	ajax_getOfficialTravelPassengerCustomPreview(id,function(official_travel_custom_passenger){
		
		var htm='';	
		for(var x=0;x<official_travel_custom_passenger.length;x++){
			passenger_count++;
			showTotalPassengerCount()
			htm=`<tr data-menu="customPassengerMenu" data-selection="`+official_travel_custom_passenger[x].id+ `" id="official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`" class="contextMenuSelector official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`">
								<td>
									<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="" data-mode="custom"></div></div>
									<div class="col col-md-9"><b>`+official_travel_custom_passenger[x].id+`</b></div></td>
								<td>`+official_travel_custom_passenger[x].designation+`</td>
								<td>N/A</td>
							</tr>`

			$('.preview-passengers').append(htm)
		}
		
		setTimeout(function(){ context() },1000);
	});
	
}


function showOfficialTravelItenerary(id){
	ajax_getOfficialTravelItenerary(id,function(official_travel_itenerary){
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
		}



	});
	
	
	
}

function removeContextListElement(url,id){
	$('.modal-submit').on('click',function(){
    		//disable onclick
    		$(this).attr('disabled','disabled')

    		//ajax here
    		$.ajax({

    			url:url+''+id,
    			method:'DELETE',
    			data: { _token: $("input[name=_token]").val()},
    			success:function(data){
    				if(data>0){
    					//ajax here
			    		setTimeout(function(){	    		
				    		//back to original
				    		$(this).attr('disabled','enabled') 
    						$(contextSelectedElement).fadeOut();

    						$(this).attr('enabled','enabled') 
			    			
			    		},1000)

			    		$('#preview-modal').modal('hide');

    				}else{
    					alert('Something went wrong.Please try again later')
    					//back to original
    					$(this).attr('enabled','enabled')
    					$('#preview-modal').modal('hide');
    				}
    			}
    		})


    })
}



function removeOfficialTravelPassengerCustom(id){
	
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/custom/',id);
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerScholar(id){

	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/scholar/',id);
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerStaff(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){
	    		removeContextListElement('api/travel/official/staff/',id);
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}

function removeOfficialTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	removeContextListElement('api/travel/official/itenerary/',id);
	    })
	});

	$('#preview-modal').modal('toggle');
	
}


function removeOfficialTravelRequest(id){

	    	$('.modal-submit').on('click',function(){

	    		//loading
	    		previewLoadingEffect()
	    		
	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		$(this).html('Removing . . .')

	    		$.ajax({

	    			url:'api/travel/official/'+id,
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


function forwardOfficialTravelRequest(id){
	
	$('.modal-submit').on('click',function(){

		//loading
	    previewLoadingEffect()
	    		
	    //disable onclick
	    $(this).attr('disabled','disabled')

	    //ajax here
	    setTimeout(function(){

	    	$('.preview-content').fadeOut()
	    	$(selectedElement).remove();
	    			
	    },1000)

	    $('#preview-modal').modal('hide');

	    //back to original
	    $(this).attr('disabled','enabled')
	})
	
}

function showBootstrapDialog(modal,modalSection,url,callback){

	$(modal).on('show.bs.modal', function (e) {
	    $(modalSection).load(url,callback)
	});

	$(modal).modal('toggle');

}

/**context menu**/

function context(fun){
	var menuSelector=document.querySelectorAll('.contextMenuSelector');
	var menu=document.querySelectorAll('.contextMenu');


	for(var x=0;x<menuSelector.length;x++){
		//menu[x].style.display="none"; //hide
		$(menuSelector[x]).on('contextmenu',function(e){
			e.preventDefault();
			//mark selected
			contextSelectedElement=this

			//hide all context menu
			$(menu).hide();

			//own context menu
			var menu_attr=$(e.currentTarget).attr('data-menu')
			var menu_div=document.querySelector('#'+menu_attr)
			menu_div.style.display="block";
			menu_div.style.top=(e.clientY)+"px";
			menu_div.style.left=(e.clientX)+"px";
			window.onscroll=function(){
				try{
					menu_div.style.display="none";
					delete menu_div;
				}catch(e){}
			}

			window.document.onclick=function(){
				try{
					menu_div.style.display="none";
					delete menu_div;
				}catch(e){}
			}

		})
	}

	//bindRemoveStaff();

}


function ajaxLoad(){
	$('.ajaxload').on('click',function(){
		var target=$(this).attr('data-section')
		var content=$(this).attr('data-content')
		$(target).load(content,function(){

		})
	})
}


/*bind action to contextMenu*/
function unbindContext(){
	//use explicitely to remove context
	//may be used before calling context() when adding new item 
	var menuSelector=document.querySelectorAll('.contextMenuSelector');
	for(var x=0;x<menuSelector.length;x++){
		//menu[x].style.display="none"; //hide
		$(menuSelector[x]).off('contextmenu');
	}
}

function unbindAjaxLoad(){
	$('.ajaxload').off('click')
}


function bindRemoveStaff(){
	$('.removeOfficialPassengerButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelPassengerStaff(context)
	})
}
function bindRemoveOfficialScholar(){
	$('.removeOfficialScholarButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelPassengerScholar(context)
	})
}
function bindRemoveOfficialCustom(){
	$('.removeOfficialCustomButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelPassengerCustom(context)
	})
}
function bindRemoveItenerary(){
	$('.removeIteneraryButton').click(function(){
		var context=($(contextSelectedElement).attr('data-selection'));
		removeOfficialTravelItenerary(context)
	})
}

/*loading*/
function showLoading(targetDiv,status){
	var targetDiv=document.querySelectorAll(targetDiv);
	
	
	if(typeof status!='undefined'){
		$(targetDiv).prepend('<span class="loading-status">'+status+'</span>');
	}else{
		$('.loading-status').remove();
	}
}

