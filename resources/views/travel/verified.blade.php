<div class="col col-md-3">
	<h3>Itinerary</h3>
	<ul class="list-unstyled travel-link-ul">
		<li><a href="#" class="trip-link pull-left" data-type="Scheduled">Scheduled</a> </li>
		<li><a href="#" class="trip-link pull-left" data-type="Ongoing">Ongoing</a> </li>
		<li><a href="#" class="trip-link pull-left" data-type="Finished">Finished</a></li>
	</ul>
	<div style="clear:both;"><br/><br/></div>
	<p class="row col col-md-10">
		<b class="text-danger">Page /<span class="list-total-pages">1</span></b>
		<input type="number" class="form-control list-current-page" value="1">
	</p>

</div>
<div class="col col-md-9 trip-section">
	 <h3><span class="verified_travel_title">Scheduled</span> trips and travels</h3><br/>
	 <div class="verified_travel_result"></div>
</div>
{{csrf_field()}}

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/trips.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	showVerifiedRecentTravel(1)
	bindTravelLinkNavigation()
})
</script>
