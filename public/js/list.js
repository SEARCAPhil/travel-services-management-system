
//travel placeholder
var travel;
var list;
var selectedElement;

//get list
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



function ajax_searchOfficialTravelList(param,callback){
	$.get('api/travel/official/search/'+param,function(json){
		travel=JSON.parse(json)
		list= typeof travel.data!=undefined?travel.data:[];
		callback();
		return travel;
	})

}






function attachClickEventToList(url,callback){
	$('.list-details dd').click(function(e){
		var parent=this;
		e.preventDefault();
		//add selected style
		$('.list-details dd').removeClass('active')
		$(this).addClass('active');

		//reset count
		passenger_count=0;


		

		//only allowed ne click for the current element	
		if(!(selectedElement==this)){
			//clear
			$('.preview-section').html('')
			
			//get preview
			//loading
			//previewLoadingEffect();
			showLoading('.preview-section','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

			selectedElement=this;
			setTimeout(function(){
				console.log($(parent).attr('id'))
				var param=$(parent).attr('id');
				$('.preview-section').load(url+''+param,function(){
					callback(e);
				});
			},100)
			
			
		}

	})
}


function appendToList(callback){
	$('.list-details').html('') //clear
	$('.list-total-pages').html(travel.total_pages);
	$('.list-current_page').val(travel.current_page);
	var htm='';
	for(var x=0; x<list.length; x++){
		var purpose=list[x].purpose!=null?list[x].purpose:'';

		//cut the purpose
		if(purpose.length>100){
			purpose=purpose.substr(0,100);
		}
		htm+=`<dd id="`+list[x].id+`">
			<h4 class="page-header"><b>`+list[x].id+`</b></h4>
			<p><small>`+purpose+`</small></p>
		</dd>`
	}

	$('.list-details').append(htm)

	callback();
	
	setTimeout(function(){
		$('.list-details dd')[0].click()
	},300)
}



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
				//set active page
				active_page='official_preview';
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
			attachClickEventToList('travel/personal/preview/',function(e){

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
				active_page='personal_preview';
				showPersonalTravelListPreview(targetId)
				showPersonalTravelPassengerStaffPreview(targetId)
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
			attachClickEventToList('travel/campus/preview/',function(e){

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
				active_page='personal_preview';
				showCampusTravelListPreview(targetId)
				showCampusTravelItenerary(targetId)
			})
		});
	});
	
}




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

function bindAddFormNavigationButton(){
	$('.add-button').off('click');
	$('.add-button').on('click',function(){

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
				bindAddFormNavigationButton();
			})
		}
	})


}

function changeButtonState(target,state='disabled'){
	console.log(state)
	if(state=='enabled'){
		$(target).removeAttr('disabled');
		$(target).attr('enabled','enabled');	
	}else{
		$(target).attr('disabled','disabled');
	}
	
}


function changeCircleState(target,state='enabled'){

	if(state=='enabled'){
		$(target).addClass('done');	
	
	}else{
		$(target).removeClass('done');
	}
	
}



