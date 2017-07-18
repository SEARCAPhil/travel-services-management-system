<div class="col col-md-8 col-sm-8">
	<p class="row col col-md-10" style="display: none;">
		<b class="text-danger">Page /<span class="list-total-pages">1</span></b>
		<input type="number" class="form-control list-current-page" value="1">
	</p>

</div>
<div class="col col-md-9 col-sm-10 col-lg-6 col-lg-offset-2" style="margin-top: 50px;">
	<ul class="list-unstyled travel-link-ul">
		<li class="active"><a href="#" class="trip-link" data-type="Scheduled">Scheduled</a> </li>
		<li><a href="#" class="trip-link" data-type="Ongoing">Ongoing</a> </li>
		<li><a href="#" class="trip-link" data-type="Finished">Finished</a></li>
	</ul>
	<div class="col col-md-12 trip-section content-section">
		 <h3 class="page-header"><span class="verified_travel_title">Scheduled</span> trips and travels</h3><br/>

		 <div class="col col-md-12">
		 	<div class="verified_travel_result"></div>
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
})
</script>
