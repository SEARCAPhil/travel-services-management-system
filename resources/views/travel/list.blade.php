 <span class="col col-md-12 page-header visible-sm visible-xs"><a href="#" class="list-hidden-menu"><span class="glyphicon glyphicon-th"></span> List</a></span>
<div class="col col-md-12"></div>
<div class="col col col-md-3 col-sm-3 hidden-xs">
	<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
	<ul class="list-unstyled">
		<li><a href="#" class="travel-link" data-type="official">Official</a></li>
		<li><a href="#" class="travel-link" data-type="personal">Personal</a></li>
		<li><a href="#" class="travel-link" data-type="campus">Campus</a></li>
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
			<input type="number" class="form-control" value="1" pagers="" class="list-current-page">
		</p>
</div>


<div class="col col-md-6 col-md-offset-1 col-sm-9 pull-right preview-section">
	<!--@include('travel/tr-preview')-->
</div>

<script type="text/javascript">	

//travel placeholder
var travel;
var list;
var selectedElement;

//get list
function ajax_getOfficialTravelList(){

	travel={"current_page":1,"total_pages":1,"data":[{"id":"290","purpose":null,"source_of_fund":"opf","requested_by":"16","approved_by":null,"date_approved":"","date_created":"2016-11-09 16:08:58","date_modified":"2016-11-09 16:15:43","plate_no":null,"status":"2"},{"id":"284","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nom. . . ","source_of_fund":"opf","requested_by":"1","approved_by":null,"date_approved":"","date_created":"2016-10-17 09:36:42","date_modified":"2016-11-09 15:27:26","plate_no":null,"status":"2"}]}
	list= typeof travel.data!=undefined?travel.data:[];

	return travel;

}

function showOfficialTravelList(){
	ajax_getOfficialTravelList();
	appendToList();
	attachClickEventToListOfficial()
}

function appendToList(){
	$('.list-details').html('') //clear
	$('.list-total-pages').html(travel.total_pages);
	$('.list-current_page').val(travel.current_page);
	var htm='';
	for(var x=0; x<list.length; x++){
		var purpose=list[x].purpose!=null?list[x].purpose:'';
		htm+=`<dd>
			<h4 class="page-header"><b>`+list[x].id+`</b></h4>
			<p>`+purpose+`</p>
		</dd>`
	}

	$('.list-details').append(htm)
	setTimeout(function(){
		$('.list-details dd')[0].click()
	},1000)
}


function ajax_getPersonalTravelList(){

	travel={"current_page":1,"total_pages":1,"data":[{"id":"8","purpose":null,"mode_of_payment":"cash","requested_by":"1","approved_by":null,"departure_date":"2016-10-29","departure_time":"03:00:00","returned_date":"0000-00-00","returned_time":"00:00:00","location":"SEARA","destination":"Tagaytay","charge_to":null,"vehicle_type":"3","date_created":"2016-10-11 09:21:39","date_modified":"2016-11-21 09:35:33","plate_no":"AXA 1341","driver_id":"141","status":"scheduled","trp_status":"2"}]}
	list= typeof travel.data!=undefined?travel.data:[];

	return travel;

}

function showPersonalTravelList(){
	ajax_getPersonalTravelList();
	appendToList();
	attachClickEventToListPersonal()
}

function attachClickEventToListOfficial(){
	$('.list-details dd').click(function(e){
		e.preventDefault();
		//add selected style
		$('.list-details dd').removeClass('active')
		$(this).addClass('active');
		

		//only allowed ne click for the current element	
		if(!(selectedElement==this)){
			//get preview
			//loading
			previewLoadingEffect();


			$('.preview-section').load('travel/official/preview/1');
			selectedElement=this;
		}

	})
}


function attachClickEventToListPersonal(){
	$('.list-details dd').click(function(e){
		e.preventDefault();
		//add selected style
		$('.list-details dd').removeClass('active')
		$(this).addClass('active');
		

		//only allowed ne click for the current element	
		if(!(selectedElement==this)){
			//get preview
			//loading
			previewLoadingEffect();


			$('.preview-section').load('travel/personal/preview/1');
			selectedElement=this;
		}

	})
}


function ajax_getCampusTravelList(){

	travel={"current_page":1,"total_pages":1,"data":[{"id":"112","purpose":null,"source_of_fund":"opf","requested_by":"16","approved_by":null,"date_approved":"","date_created":"2016-11-09 16:08:58","date_modified":"2016-11-09 16:15:43","plate_no":null,"status":"2"},{"id":"657","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nom. . . ","source_of_fund":"opf","requested_by":"1","approved_by":null,"date_approved":"","date_created":"2016-10-17 09:36:42","date_modified":"2016-11-09 15:27:26","plate_no":null,"status":"2"}]}
	list= typeof travel.data!=undefined?travel.data:[];

	return travel;

}


function showCampusTravelList(){
	ajax_getCampusTravelList();
	appendToList();
	attachClickEventToList()
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


	
});
</script>
