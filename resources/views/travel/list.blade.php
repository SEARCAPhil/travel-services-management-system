<div class="col col-md-12"></div>
<div class="col col col-md-3 col-sm-3 hidden-xs">
	<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
	<ul class="list-unstyled">
		<li><a href="#">Official</a></li>
		<li><a href="#">Personal</a></li>
		<li><a href="#">Campus</a></li>
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


<div class="col col col-md-2 col-sm-9 hidden-sm hidden-xs">
	<dl class="row list-details">
		
		<dd>
			<h4 class="page-header"><b>5690</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		</dd>

		
	</dl>

	<p class="row">
			<b class="text-danger">Page /<span class="list-total-pages">40</span></b>
			<input type="number" class="form-control" value="1" pagers="" class="list-current-page">
		</p>
</div>




<div class="col col-md-6 col-md-offset-1 col-sm-9 pull-right">
	@include('travel/tr-preview')
</div>

<script type="text/javascript">	

//travel placeholder
var travel;
var list;

//get list
function ajax_getOfficialTravelList(){

	travel={"current_page":1,"total_pages":1,"data":[{"id":"290","purpose":null,"source_of_fund":"opf","requested_by":"16","approved_by":null,"date_approved":"","date_created":"2016-11-09 16:08:58","date_modified":"2016-11-09 16:15:43","plate_no":null,"status":"2"},{"id":"284","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nom. . . ","source_of_fund":"opf","requested_by":"1","approved_by":null,"date_approved":"","date_created":"2016-10-17 09:36:42","date_modified":"2016-11-09 15:27:26","plate_no":null,"status":"2"}]}
	list= typeof travel.data!=undefined?travel.data:[];

	return travel;

}

function showOfficialTravelList(){
	ajax_getOfficialTravelList();
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
}



$(document).ready(function(){

showOfficialTravelList();

$('.list-details dd').click(function(){
	$('.list-details dd').removeClass('active')
	$(this).addClass('active');
})
	
});
</script>
