/**
* TRAVEL REQUEST LISTING SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/


/*
|----------------------------------------------------------------------------
| Hold data for travel request preview
|---------------------------------------------------------------------------
|
| JSON from travel request list AJAX request 
|
*/
var travel;
var list;


/*
|----------------------------------------------------------------------------
| Selected Element
|---------------------------------------------------------------------------
|
| Save a copy of element on the list that is currently selected/clicked
|
*/
var selectedElement;




/*
|----------------------------------------------------------------------------
| AJAX List functions
|---------------------------------------------------------------------------
|
| Contains logic in geting the list of Official, Personal and Campus travel request 
|
|
*/

function ajax_getOfficialTravelList(page=1,callback){

	$.get('api/travel/official/'+page,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})


}



function ajax_getPersonalTravelList(page=1,callback){

	$.get('api/travel/personal/'+page,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}




function ajax_getCampusTravelList(page=1,callback){

	$.get('api/travel/campus/'+page,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}






/*
|----------------------------------------------------------------------------
| AJAX Search functions
|---------------------------------------------------------------------------
|
| Get search items
|
|
*/

function ajax_searchOfficialTravelList(param,callback){
	$.get('api/travel/official/search/'+param,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}


function ajax_searchPersonalTravelList(param,callback){
	$.get('api/travel/personal/search/'+param,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}

function ajax_searchCampusTravelList(param,callback){
	$.get('api/travel/campus/search/'+param,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}





/*
|----------------------------------------------------------------------------
| Show Travel request list
|---------------------------------------------------------------------------
|
| Display the travel requests in the list 
|
|
*/

function showOfficialTravelList(page=1){
	ajax_getOfficialTravelList(page,function(){

		//mark the active list
		active_list='official';
		//append
		appendToList(function(){
			//attach click event
			attachClickEventToList('travel/official/preview/',function(e){

				//get target id
				var targetId;

				//for manual click and click on event trigger
				if(typeof e.currentTarget.id=='undefined'){
					targetId=e.target.id;
				}else{
					targetId=e.currentTarget.id;
				}
				//console.log(e.target.id)

				//get all necessary information of the request
				showOfficialTravelListPreview(targetId)
				showOfficialTravelPassengerStaffPreview(targetId)
				showOfficialTravelPassengerScholarsPreview(targetId)
				showOfficialTravelPassengerCustomPreview(targetId)
				showOfficialTravelItenerary(targetId)

			})

		});
	});
	
	
}


function showPersonalTravelList(page=1){
	ajax_getPersonalTravelList(page,function(){
		//mark the active list
		active_list='personal';

		//append
		appendToList(function(data){

			//attach click event
			attachClickEventToList('travel/official/preview/',function(e){

				//get target id
				var targetId;

				//for manual click and click on event trigger
				if(typeof e.currentTarget.id=='undefined'){
					targetId=e.target.id;
				}else{
					targetId=e.currentTarget.id;
				}
				//get all necessary information of the request
				showOfficialTravelListPreview(targetId)
				showOfficialTravelPassengerStaffPreview(targetId)
				showOfficialTravelPassengerScholarsPreview(targetId)
				showOfficialTravelPassengerCustomPreview(targetId)
				showOfficialTravelItenerary(targetId)
			})
		});
	});
	
}



function showCampusTravelList(page=1){
	ajax_getCampusTravelList(page,function(){
		//mark the active list
		active_list='campus';

		//append
		appendToList(function(data){

			//attach click event
			attachClickEventToList('travel/official/preview/',function(e){

				//get target id
				var targetId;

				//for manual click and click on event trigger
				if(typeof e.currentTarget.id=='undefined'){
					targetId=e.target.id;
				}else{
					targetId=e.currentTarget.id;
				}
				//console.log(e.target.id)
				//set active page
				active_page='campus_preview';
				//get all necessary information of the request
				showOfficialTravelListPreview(targetId)
				showOfficialTravelPassengerStaffPreview(targetId)
				showOfficialTravelPassengerScholarsPreview(targetId)
				showOfficialTravelPassengerCustomPreview(targetId)
				showOfficialTravelItenerary(targetId)
			})
		});
	});
	
}






/*
|----------------------------------------------------------------------------
| Search Travel request list
|---------------------------------------------------------------------------
|
| Display search results
|
|
*/

function searchOfficialTravelList(param){
	ajax_searchOfficialTravelList(param,function(){
		appendToList(function(){
			attachClickEventToList('travel/official/preview/',function(e){

				//get all necessary information of the request
				showOfficialTravelListPreview(e.currentTarget.id)
				showOfficialTravelPassengerStaffPreview(e.currentTarget.id)
				showOfficialTravelPassengerScholarsPreview(e.currentTarget.id)
				showOfficialTravelPassengerCustomPreview(e.currentTarget.id)
				showOfficialTravelItenerary(e.currentTarget.id)

			})
		})
	})
	

}


function searchPersonalTravelList(param){
	ajax_searchPersonalTravelList(param,function(){
		appendToList(function(){
			attachClickEventToList('travel/personal/preview/',function(e){

				//get all necessary information of the request
				showPersonalTravelListPreview(e.currentTarget.id)
				showPersonalTravelPassengerStaffPreview(e.currentTarget.id)
				showPersonalTravelPassengerScholarsPreview(e.currentTarget.id)
				showPersonalTravelPassengerCustomPreview(e.currentTarget.id)
				showPersonalTravelItenerary(e.currentTarget.id)

			})
		})
	})
	

}


function searchCampusTravelList(param){
	ajax_searchCampusTravelList(param,function(){
		appendToList(function(){
			attachClickEventToList('travel/campus/preview/',function(e){

				//get all necessary information of the request
				showCampusTravelListPreview(e.currentTarget.id)
				showCampusTravelItenerary(e.currentTarget.id)

			})
		})
	})
	
}






/*
|----------------------------------------------------------------------------
| Append Items to List
|---------------------------------------------------------------------------
|
| This is used inside show travel requests functions
| This allows to run script on success operations.
|
|
*/

function appendToList(callback=function(){}){

	//clear list
	$('.list-details').html('')

	//item count and pages
	$('.list-total-pages').html(travel.total_pages);
	$('.list-current_page').val(travel.current_page);

	//NO CONTENT MESSAGE
	var no_content_message=`<center class="content-section text-muted" id="no-content-message" style="margin-top:15vh;">
		<img src="img/bag.png" width="100px"/>
		<h2>No available content to load</h2>
		<p>Please try to refresh the page<p>
	</center>`;

	//empty variable
	var htm='';

	if(list.length<1){
		//$('.list-section').hide();
		$('.preview-section').html(no_content_message)
	}else{
		$('.list-section').show();
	}

	for(var x=0; x<list.length; x++){

		var purpose=list[x].purpose!=null?list[x].purpose:'';

		//cut the purpose length if too long
		if(purpose.length>100){
			purpose=purpose.substr(0,100);
		}

		var status_message='';
		var activeClass='';


		//get status
		if(typeof list[x].status!='undefined'){

			if(list[x].status==0) status_message='<i class="material-icons md-18" title="draft">drafts</i>'
		}


		//get travel request personal status
		if(typeof list[x].trp_status!='undefined'){
			if(list[x].trp_status==0) status_message='<i class="material-icons md-18" title="draft">drafts</i>'
		}

		if(list[x].status == 2){
			status_message='<span class="badge badge-sm badge-success" style="background: #00a093;"><i class="material-icons md-18" title="verified">check</i> Verified</span>'
		}



		if(list[x].status==4){
			activeClass='closed';
		}


		//for PERSONA LTRAVEL REQUEST ONLY
		if(list[x].trp_status==4){
			activeClass='closed';
		}

		if(localStorage.getItem('role')=='admin'){
			//append to the DIV
			htm+=`<dd id="`+list[x].id+`" class="`+activeClass+`">
			<span style="font-size: 12px;padding:4px;" class="pull-right">${status_message}</span>
				<h4><b>`+list[x].id+`</b></h4>
				<p><small><b>Date created : </b>`+list[x].date_created+`</small><br/>
					<small><b>Requested by : </b><span class="badge">`+list[x].profile_name+`</span></small>
				<p><div class="list-active-status" style="float:left;"></div></p>
				<div style="clear:both;"></div>
				`
		}else{
			htm+=`<dd id="`+list[x].id+`" class="`+activeClass+`">
			<span style="font-size: 12px;padding:4px;" class="pull-right">${status_message}</span>
			<h4><b>`+list[x].id+`</b></h4>
			
			<p>
				<small>${purpose}<br/><br/><b>${list[x].date_created}</b></small>
			</p>
			

			<p><div class="list-active-status" style="float:left;"></div></p>

			<div style="clear:both;"></div>

			`
		}


			htm+=`</dd>`

	}



	$('.list-details').append(htm)


	//run the callback
	callback();
	
	//--------------------------------------------
	//click the first item on the list
	//attachClickEventToList is required 
	//--------------------------------------------

	setTimeout(function(){
		try{ $('.list-details dd')[0].click(); }catch(e){}
	},300)
}





/*
|----------------------------------------------------------------------------
| Attach click event function on the list
|---------------------------------------------------------------------------
|
| This is used inside show travel requests functions
| This allows to run script on success operations
|
|
*/

function attachClickEventToList(url,callback){
	$('.list-details dd').click(function(e){
		var parent=this;
		e.preventDefault();

		//add selected style
		$('.list-details dd').removeClass('active')
		$(this).addClass('active');

		showActiveBar(this);

		//reset count
		passenger_count=0;


		//only allowed click for the unselected element	
		if(!(selectedElement==this)){
			//clear
			$('.preview-section').html('')
			
			//loading effect
			showLoading('.preview-section','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

			//mark this as selected
			selectedElement=this;


			setTimeout(function(){

				//get the current ID
				var param=$(parent).attr('id');

				//load the URL to the section
				$('.preview-section').load(url+''+param,function(){
					callback(e);
				});

			},100)
			
			
		}

	})
}






/*
|----------------------------------------------------------------------------
| Form Navigation
|---------------------------------------------------------------------------
|
| Load form within a section when an element is click
|
*/

function bindAddFormNavigationButton(){
	//$('.add-button').off('click');
	$('.add-button').on('click',function(){

		//clear section
		$('#editorTab').html();
		$('#editorTab').click();

		//loading
		showLoading('#editor','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

		var id=$(this).attr('data-content');
		var url='';

		switch(id){
			case 'official':
				url="forms/travel/official";
			break;

			case 'personal':
				url="forms/travel/personal";
			break;

			case 'campus':
				url="forms/travel/campus";
			break;
				
			default:
			break;

		}

		
			
			if(url.length>1){
				$('#editor').load(url,function(){
				
				})
			}
		
	})


}

//make available to window
window.trs=window.trs||{}
window.trs.showOfficialTravelList=window.trs.showOfficialTravelList||showOfficialTravelList;
window.trs.showPersonalTravelList=window.trs.showPersonalTravelList||showPersonalTravelList;
window.trs.showCampusTravelList=window.trs.showCampusTravelList||showCampusTravelList;


