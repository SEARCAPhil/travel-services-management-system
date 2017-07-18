 <span class="col col-md-12 page-header visible-sm visible-xs"><a href="#" class="list-hidden-menu"><span class="glyphicon glyphicon-th"></span> List</a></span>

		



<div class="col col col-md-3 col-sm-3 hidden-xs hidden-lg">
	<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
	<ul class="list-unstyled travel-link-ul">
		<li><a href="#" class="travel-link pull-left" data-type="official">Official</a> <span class="add-button" data-content="official"><span class="glyphicon glyphicon-plus" ></span></li>
		<li><a href="#" class="travel-link pull-left" data-type="personal">Personal</a> <span class="add-button" data-content="personal"><span class="glyphicon glyphicon-plus"></span></span></li>
		<li><a href="#" class="travel-link pull-left" data-type="campus">Campus</a> <span class="add-button" data-content="campus"><span class="glyphicon glyphicon-plus"></span></span></li>
	</ul>
	<p class="page-header"><b>Options</b></p>
	<div class="col col-md-12 row pull-left">
		<div><span class="glyphicon glyphicon-search basket" search=""></span> Find</div> 
		<div>
			<input type="text" class="form-control" placeholder="travel request number" id="searchInput" autofocus="">
		</div>
	</div>
	<div style="clear:both;"></div><!--
	<br/>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="false"> Sort up <span class="glyphicon glyphicon-chevron-up"></span></a></span></p>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="true"> Sort down <span class="glyphicon glyphicon-chevron-down"></span></a></span></p>-->
</div>


<div class=" list-section col col col-md-2 col-sm-9 hidden-sm hidden-xs row">
	<div class="col col-md-12 content-section">
		<dl class="row list-details">	
			<!--<dd>
				<h4 class="page-header"><b>5690</b></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
			</dd>-->
			
		</dl>

		<p class="row hidden-lg">
				<b class="text-danger">Page /<span class="list-total-pages">40</span></b>
				<input type="number" class="form-control list-current-page" value="1">
		</p>
	</div>
</div>


<div class="col col-md-6 col-sm-9 preview-section">
	
</div>

<script type="text/javascript" src="js/common.js"></script>


<script type="text/javascript">	

$(document).ready(function(){

//showOfficialTravelList();




$('.list-hidden-menu').click(function(e){
	e.preventDefault();
	$('.list-section.hidden-sm').addClass('modal-list')	
})



$('.list-current-page').change(function(){

	if($(this).val()>travel.total_pages||$(this).val()<1){
		$(this).css({'background-color':'#a94442','color':'#fff'})
	}else{
		$(this).css({'background-color':'#fff','color':'#000'})
		//next page
		//official
		if(active_list=='official') showOfficialTravelList($(this).val())

		//personal
		if(active_list=='personal') showPersonalTravelList($(this).val())

		//campus
		if(active_list=='campus') showCampusTravelList($(this).val())
		
	}
})

var timeOut;
$('#searchInput').keyup(function(){
	var that=this
	clearTimeout(timeOut)
	timeOut=setTimeout(function(){
		//next page
		if($(that).val().length>1)

			//bind search function for active list
			if(active_list=='official') searchOfficialTravelList($(that).val())
			if(active_list=='personal') searchPersonalTravelList($(that).val())
			if(active_list=='campus') searchCampusTravelList($(that).val())

		
	},1000)
		
	
})

//bindAddFormNavigationButton();

	
});
</script>
