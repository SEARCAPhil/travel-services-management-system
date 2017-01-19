/**
*COMMON SCRIPT
*
*This contains script that can be called insside other functions/pages
*To avoid anny issue, please include this script right after jquery javascript 
*/

var contextSelectedElement;
var active_list;
var active_page=''; 


/*
|----------------------------------------------------------------------------
| AJAX Load
|---------------------------------------------------------------------------
|
| Load external pages to the division
| DO NOT FORGET to call context() function to enable right click menu
|
*/


function ajaxLoad(){
	$('.ajaxload').on('click',function(){
		var target=$(this).attr('data-section')
		var content=$(this).attr('data-content')
		$(target).load(content,function(){

		})
	})
}


function unbindAjaxLoad(){
	$('.ajaxload').off('click')
}




/*
|----------------------------------------------------------------------------
| Contextmenu
|---------------------------------------------------------------------------
|
| Enable menu popup on right click event
| This allows the application to show remove,update etc menu on different ites on list or
| any documents present in the DOM
|
*/

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

			//show context menu based on its attribute
			var menu_attr=$(e.currentTarget).attr('data-menu')
			var menu_div=document.querySelector('#'+menu_attr)

			//update visibility
			menu_div.style.display="block";
			menu_div.style.top=(e.clientY)+"px";
			menu_div.style.left=(e.clientX)+"px";

			//hide when out of focus
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

}


function unbindContext(){
	//use explicitely to remove context
	//may be used before calling context() when adding new item 
	var menuSelector=document.querySelectorAll('.contextMenuSelector');
	for(var x=0;x<menuSelector.length;x++){

		$(menuSelector[x]).off('contextmenu');
	}
}




/*
|----------------------------------------------------------------------------
| Bootstrap Dialog
|---------------------------------------------------------------------------
|
| Shows dialog box and load external file on modal 
| It also allows to run a script when successful
|
*/

function showBootstrapDialog(modal,modalSection,url,callback){
	$(modal).off('show.bs.modal');
	$(modal).on('show.bs.modal', function (e) {
	    $(modalSection).load(url,callback)
	});

	$(modal).modal('toggle');

}


/*
|----------------------------------------------------------------------------
| Remove Element in Context
|---------------------------------------------------------------------------
|
| This is used to remove selected context element (the element you right click) 
| if item is successfully deleted in the database
|
*/
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


/*
|----------------------------------------------------------------------------
| Change button state
|---------------------------------------------------------------------------
|
| Toggle button to make it active or disabled 
|
*/

function changeButtonState(target,state='disabled'){
	
	if(state=='enabled'){
		$(target).removeAttr('disabled');
		$(target).attr('enabled','enabled');	
	}else{
		$(target).attr('disabled','disabled');
	}
	
}



/*
|----------------------------------------------------------------------------
| Change Circle state
|---------------------------------------------------------------------------
|
| Add class done to the target element
| It is used on the form to indicate in which part he/she already done
|
*/

function changeCircleState(target,state='enabled'){

	if(state=='enabled'){
		$(target).addClass('done');	
	
	}else{
		$(target).removeClass('done');
	}
	
}



/*
|----------------------------------------------------------------------------
| AJAX Update status
|---------------------------------------------------------------------------
|
| Update status of the travel request
|
|
*/

function ajax_updateTravelStatusPreview(url,id,status,callback){
	//ajax here
	$.ajax({
		url:url+''+id,
		method:'PUT',
		data: { _token: $("input[name=_token]").val(),id:id,status:status},
		success:function(data){
			if(data>0){

				//callback
				callback(data)

	    		$('#preview-modal').modal('hide');

			}else{
				alert('Something went wrong.Please try again later')
				//back to original
				$(this).attr('enabled','enabled')
				$('#preview-modal').modal('hide');
			}
		}
	})
}




/*
|----------------------------------------------------------------------------
| Hold data for the davailable drivers
|---------------------------------------------------------------------------
*/
var driverList={}

/*
|----------------------------------------------------------------------------
| Hold data for vehicle list
|---------------------------------------------------------------------------
*/
var vehicleList={}


/*
|----------------------------------------------------------------------------
| AJAX Drivers List
|---------------------------------------------------------------------------
|
| Get drivers list from the directory
|
*/

function ajax_getDriversList(func){
	$.get('api/directory/drivers',function(res){
		driverList=JSON.parse(res)
		func(driverList);
		return driverList;
	})
	
}




/*
|----------------------------------------------------------------------------
| AJAX Vehicle List
|---------------------------------------------------------------------------
|
| Get vehicle list from the directory
|
*/
function ajax_getVehiclesList(func){
	$.get('api/directory/vehicles',function(res){
		vehicleList=JSON.parse(res)
		func(vehicleList);
		return vehicleList;
	})
	
}



/*
|----------------------------------------------------------------------------
| Show Drivers List
|---------------------------------------------------------------------------
|
| Display drivers list
|
*/

function show_driversList(){
	ajax_getDriversList(function(driverList){
		for(x of driverList.data){
			$('#officialTravelDriver').append('<option value="'+x.id+'">'+x.first_name+' '+x.last_name+'</option>')
		}
		
	})
}






/*
|----------------------------------------------------------------------------
| Update status bar (ADMIN)
|---------------------------------------------------------------------------
|
| Display different status of the travel request. These functions are restricted to administrator
| and should not be exposed to ordinary user. Displaying status relies on the current status as follows
|
|		--------------------------------------
|		 For Admin
|		 0 - N/A (For ordinary user only)
|		 1 - showUntouchedStatusAdmin()
|		 2 - showVerifyStatusAdmin()
|		 3 - showReturnStatusAdmin()
|		 4 - showClosedStatus() (applies aso to ordinary user)
|		 --------------------------------------
*/

function showUntouchedStatusAdmin(){
	var htm=`

			<div class="col col-md-12" style="background: rgb(255,60,60);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request is not yet verified. Please review before making any further actions.
					<button class="btn btn-xs btn-danger preview-return">Return to sender <span class="glyphicon glyphicon-inbox"></span></button> Or
					<button class="btn btn-xs btn-danger preview-verify"> Verify <span class="glyphicon glyphicon-ok"></span></button>
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}



function showVerifyStatusAdmin(){

	var htm=`<div class="col col-md-12" style="background: rgb(0,150,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					Travel Request Verified!
					<button class="btn btn-xs btn-success preview-return">Return to sender <span class="glyphicon glyphicon-inbox"></span></button> Or
					<button class="btn btn-xs btn-success preview-close">Mark as <u>Closed</u> <span class="glyphicon glyphicon-lock"></span></button> 
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}


function showClosedStatusAdmin(){
	var htm=`<div class="col col-md-12" style="background: rgb(0,150,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					<b>[READ-ONLY]</b> This Travel Request is already closed and only available for viewing.
				</p>
			</div>`;

	$('.preview-status-section').html(htm);
}



function showReturnStatusAdmin(){
	var htm=`

			<div class="col col-md-12" style="background: rgb(255,82,87);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request was returned. 
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}




function showClosedStatus(){
	var htm=`<div class="col col-md-12" style="background: rgb(100,100,100);color:rgb(255,255,255);margin-bottom: 20px;padding: 5px;">
				<p>
					This Travel Request is already closed. <span class="glyphicon glyphicon-lock"></span>
				</p>
			</div>`;
	$('.preview-status-section').html(htm);
}


/*
|----------------------------------------------------------------------------
| Loading status
|---------------------------------------------------------------------------
|
| Display loading circle on a target element
| You may use this as an indicator when doing any actions
|
*/

function showLoading(targetDiv,status){
	var targetDiv=document.querySelectorAll(targetDiv);
	
	
	if(typeof status!='undefined'){
		$(targetDiv).prepend('<span class="loading-status">'+status+'</span>');
	}else{
		$('.loading-status').remove();
	}
}



function showActiveBar(element){
	var htm=`<div class="col col-md-12 text-right list-active-status-bar" style="background:rgb(150,150,150);padding:2px 5px 2px 5px;color:rgb(255,255,255);">Preview &emsp;<span class="glyphicon glyphicon-eye-open"></span></div>`

	var nodes=$(element)[0].childNodes
	console.log($(element))
	for(var x=0;x<nodes.length; x++){
		if($(nodes[x]).attr('class')=='list-active-status'){
			$('.list-active-status').html('');
			$(nodes[x]).html(htm)
		}
	}
}



