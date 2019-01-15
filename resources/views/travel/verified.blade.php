
<section class="col-lg-10 text-right" style="margin-top: 1vh;margin-bottom: 10px;box-shadow: 0px 10px 25px rgba(200,200,200,0.2);padding-bottom:15px;padding-left: 50px;border-bottom:1px solid rgba(200,200,200,0.5);">

	<ul class="list-unstyled travel-link-ul">
		<li class="active"><a href="#" class="trip-link" data-type="Scheduled">Scheduled</a> </li>
		<li><a href="#" class="trip-link" data-type="Ongoing">Ongoing</a> </li>
		<li><a href="#" class="trip-link" data-type="Finished">Finished</a></li>
		<li style="width: 50%;"><div class="col col-md-1"><i class="material-icons">search</i></div>
		<div class="col col-md-5"><input type="text" class="form-control" placeholder="Search" id="travel-search-input"/></div></li>
	</ul>
</section>

<div class="col col-md-9 col-sm-10 col-lg-8 col-lg-offset-1" style="height: 90vh; overflow-y: auto;padding-bottom: 5vh;">
	
	<div class="col col-md-12 trip-section content-section">
		
		<br/><br/>
		 <h3 class="page-header"><span class="verified_travel_title">Scheduled</span> trips and travels</h3><br/>

		 <div class="col col-md-12">
		 	<div class="verified_travel_result"></div>
		 	<div class="col col-md-8 col-sm-8">
				<p class="row col col-md-10">
					<b class="text-danger">Page /<span class="list-total-pages">1</span></b>
					<input type="number" class="form-control list-current-page" value="1">
				</p>

			</div>
		 </div>
	</div>
</div>
{{csrf_field()}}

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/trips.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	showVerifiedRecentTravel(1)
	bindTravelLinkNavigation()
	bindSearchTrips()
})
</script>
