 <span class="col col-md-12 page-header visible-sm visible-xs"><a href="#" class="list-hidden-menu"><span class="glyphicon glyphicon-th"></span> List</a></span>
<div class="col col-md-12"></div>
<div class="col col col-md-3 col-sm-3 hidden-xs">
	<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
	<ul class="list-unstyled travel-link-ul">
		<li><a href="#" class="travel-link pull-left" data-type="official">Official</a> <span class="add-button" data-content="official"><span class="glyphicon glyphicon-plus" ></span></li>
		<li><a href="#" class="travel-link pull-left" data-type="personal">Personal</a> <span class="add-button" data-content="personal"><span class="glyphicon glyphicon-plus"></span</span></li>
		<li><a href="#" class="travel-link pull-left" data-type="campus">Campus</a> <span class="add-button" data-content="campus"><span class="glyphicon glyphicon-plus"></span></span></li>
	</ul>
	<p class="page-header"><b>Options</b></p>
	<div class="col col-md-12 row pull-left">
		<div class="col col-md-1"><span class="glyphicon glyphicon-search basket" search=""></span> </div> 
		<div class="col col-md-10">
			<input type="text" class="form-control" placeholder="search" id="searchInput" autofocus="">
		</div>
	</div>
	<div style="clear:both;"></div>
	<br/>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="false"> Sort up <span class="glyphicon glyphicon-chevron-up"></span></a></span></p>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="true"> Sort down <span class="glyphicon glyphicon-chevron-down"></span></a></span></p>
</div>


<div class=" list-section col col col-md-2 col-sm-9 hidden-sm hidden-xs">
	<dl class="row list-details">	
		<!--<dd>
			<h4 class="page-header"><b>5690</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		</dd>-->
		
	</dl>

	<p class="row">
			<b class="text-danger">Page /<span class="list-total-pages">40</span></b>
			<input type="number" class="form-control list-current-page" value="1">
		</p>
</div>


<div class="col col-md-6 col-md-offset-1 col-sm-9 pull-right preview-section">
	
</div>

<script type="text/javascript">	

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
		htm+=`<dd id="`+list[x].id+`">
			<h4 class="page-header"><b>`+list[x].id+`</b></h4>
			<p>`+purpose+`</p>
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
		appendToList(function(){
			//attach click event
			attachClickEventToList('travel/official/preview/',function(e){

				//get all necessary information of the request
				showOfficialTravelListPreview(e.currentTarget.id)
				showOfficialTravelPassengerStaffPreview(e.currentTarget.id)
				showOfficialTravelPassengerScholarsPreview(e.currentTarget.id)
				showOfficialTravelPassengerCustomPreview(e.currentTarget.id)
				showOfficialTravelItenerary(e.currentTarget.id)

			})

		});
	});
	
	
}


function showPersonalTravelList(page=1){
	ajax_getPersonalTravelList(page,function(){
		appendToList(function(){
			//attach click event
			attachClickEventToList('travel/personal/preview/',function(e){
				showPersonalTravelPassengerStaffPreview(e.currentTarget.id)
			})
		});
	});
	
}



function showCampusTravelList(page=1){
	ajax_getCampusTravelList(page,function(){
		appendToList(function(){
			attachClickEventToList('travel/campus/preview/',function(){
			//alert('campus')
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




$(document).ready(function(){

showOfficialTravelList();




$('.list-hidden-menu').click(function(e){
	e.preventDefault();
	$('.list-section.hidden-sm').addClass('modal-list')	
})

$('.travel-link').click(function(e){
	e.preventDefault();
	var type=$(this).attr('data-type');

	switch(type){
		case 'official':
			showOfficialTravelList();
		break;
		case 'personal':
			showPersonalTravelList()
		break;
		case 'campus':
			showCampusTravelList()
		break;
		default:
		break;
	}
	console.log()
	


	
})

$('.list-current-page').change(function(){

	if($(this).val()>travel.current_page||$(this).val()<travel.current_page){
		$(this).css({'background-color':'#a94442','color':'#fff'})
	}else{
		$(this).css({'background-color':'#fff','color':'#000'})
		//next page
		showOfficialTravelList($(this).val())
	}
})

var timeOut;
$('#searchInput').keyup(function(){
	var that=this
	clearTimeout(timeOut)
	timeOut=setTimeout(function(){
		//next page
		if($(that).val().length>1)
		searchOfficialTravelList($(that).val())
	},1000)
		
	
})

bindAddFormNavigationButton();

	
});
</script>
