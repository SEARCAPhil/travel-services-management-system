

 <div class="col col-md-7 col-sm-8 col-lg-5 col-lg-offset-1" style="height: 100vh; overflow: auto;"><br/>
	<div class="col col-md-12 content-section">
		<h1>Today's Trips</h1>
		<p><small>All land travel scheduled today <span id="today-span" class="text-danger"></span></small></p>
		<hr/>
	</div>

	<div class="col col-md-12 content-section" id ="todays-trip-section"></div>
</div>

<script>
	var d = new Date()
	var month = d.getMonth() < 10 ? `0${d.getMonth()}` : d.getMonth()+1
	var day = d.getDate() < 10 ? `0${d.getDate()}` : d.getDate()	
	var todaysDate = `${d.getFullYear()}-${month}-${day}`

	function getReserved(res){

		return new Promise((resolve, reject) => {
			$.get('api/travel/calendar/'+res,function(json){
				var data = JSON.parse(json);

				resolve(data)
			})
		})
	}

	$(document).ready(function() { 
		document.getElementById('today-span').innerHTML = todaysDate
		getReserved(d.getFullYear()+'-'+(d.getMonth()+1)+'-'+1).then(res => {
			const targ = document.getElementById('todays-trip-section')
			targ.innerHTML = ''
			let num = 0
			
				
				res.forEach((trip, index) => {
					if (trip.departure_date == todaysDate) {
						targ.innerHTML += `<div class="col-sm-12 row">
							<p style="color: green;">${trip.location} - ${trip.destination}</p>
							<p class="text-muted">${trip.departure_date}emsp; ${trip.departure_time}</p>
							<p><span class="badge">#${trip.tr_id}</span>&emsp;<span class="text-muted">John Kenneth Abella</span></p>
							<hr/>
						</div>`
						num++
					}
				})
			
				setTimeout(() => {
					if(num == 0) {
						targ.innerHTML = `<section  style="padding:10px;text-align: center;">
						<img src="img/bag.png" width="150px"/>
						<h3 class="text-muted">No trip scheduled for today.</h3>
						<span class="text-muted"> Have a nice day!</span></section>`
					}
				}, 600);
		})
	})
</script>