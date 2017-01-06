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




