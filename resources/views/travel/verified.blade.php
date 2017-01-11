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
<script type="text/javascript">

var trips= {};
var selectedTrips;
/*
|----------------------------------------------------------------------------
| AJAX Update status
|---------------------------------------------------------------------------
|
| Update status of the travel request
|
|
*/

function ajax_getVerifiedTravel(url,page,callback){
	$.get(url+''+page,function(json){
		trips=json
		callback(json);
	}).fail(function(){
		alert('Oops! Something went wrong');
	})
}


function ajax_updateVerifiedTravel(url,id,status,type,callback){
	$.ajax({
		url:url+''+id,
		method:'PUT',
		data: { _token: $("input[name=_token]").val(),id:id,status:status,type:type},
		success:function(data){
			if(data>0){

				//callback
				callback(data)

	    		$('#preview-modal').modal('hide');

			}else{
				alert('Something went wrong.Please try again later')
				//back to original
				$(this).attr('enabled','enabled')
				$('#preview-modal').modal('hide');
			}
		},
		error:function(){
			
			alert('Oops! Something went wrong');
	
		}
	})
}


function bindVerifiedRecentTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/scheduled/',page,function(json){

		appendToList(json);
		
		//next page
		setTimeout(function(){
			tripsPager(function(val){
				bindVerifiedRecentTravel(val)
			});

		},800)


	})

}


function bindVerifiedOngoingTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/ongoing/',page,function(json){

		appendToList(json);

		//next page
		setTimeout(function(){
			tripsPager(function(val){
				bindVerifiedOngoingTravel(val)
			});

		},800)
		
	})

}


function bindVerifiedFinishedTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/finished/',page,function(json){

		appendToList(json);

		//next page
		setTimeout(function(){
			tripsPager(function(val){
				bindVerifiedFinishedTravel(val)
			});

		},800)
		
	})

}

function appendToList(json){

		var htm='';

		var json=JSON.parse(json);

		//update total pages
		$('.list-total-pages').html(json.pages)

		for(var x=0; x<json.data.length; x++){
			var data=json.data[x];

			var departure_date=new Date(data.departure_date).getDate();

			htm+=`<div class="row `+data.type+``+data.id+`" style="margin-bottom: 50px;">
			 	<div class="col col-md-1 col-sm-1 ">
					 <div class="text-center col trip-date `+data.type+`">
					 	`+departure_date+`
					 </div>
				</div>
				 <div class="col col-md-10 col-sm-10">
				 	<p><b><u>`+data.location+`</u></b> - <b><u>`+data.destination+`</u></b></p>
				 	<p><b>`+data.departure_date+`</b>  - `+data.departure_time+`</p>
				 	<p><small>`+data.requester+`</small></p>

				 </div>

				 <div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11" style="border-bottom:1px solid rgb(250,250,250);">
					 <small>
					 	<ul class="list-unstyled trip-list">`;

					 		if(data.type=='official'){
								htm+=`<li><a href="#" class="travel-link pull-left" data-type="official"> Link <span class="glyphicon glyphicon-link"></span> </a> </li>`
							}
							

							htm+=`<li> <a href="#" class="travel-link pull-left dropdown-toggle mark-as-menu" data-type="personal" data-target=".mark-as-dropdownmenu" data-toggle="dropdown" data-content='`+JSON.stringify(data)+`' aria-haspopup="true" aria-expanded="true">
								 Mark As <span class="glyphicon glyphicon-chevron-down"></span>
								 </a>

								 <ul class="dropdown-menu marks-as-dropdownmenu">`;


								if(data.status!='scheduled'){
								 	htm+=`<li class="mark-as-link" data-mark="scheduled"><a href="#">Scheduled</a></li>`
								}

								if(data.status!='ongoing'){
								    
								    htm+=`<li class="mark-as-link" data-mark="ongoing"><a href="#">Ongoing</a></li>`
								}


								if(data.status!='finished'){
								    htm+='<li class="mark-as-link" data-mark="finished"><a href="#">Finished</a></li>'
								}






							htm+=`</ul>

							</li>
							<li class="dropdown"> <a href="#" class="travel-link pull-left dropdown-toggle" data-type="personal" data-toggle="dropdown"  data-content="`+JSON.stringify(data)+`" aria-haspopup="true" aria-expanded="true">Advance Options
								 <span class="glyphicon glyphicon-option-vertical"></span> </span>
								 </a>
								
									<ul class="dropdown-menu advance-menu">
										<li><a href="#">Assign <b>SEARCA</b> Vehicle</a></li>
										<li><a href="#"><b>Rent</b> a Car</a></li>
									    <li><a href="#">Assign Driver</a></li>
									    <li><a href="#">Charge</a></li>
									  </ul>
								
							</li>
						</ul>
					</small>

					<div style="clear:both"><br/></div>
					
				 	
				 </div>`;

				var official_staff=JSON.parse(data.passengers.staff);
				var official_scholars=JSON.parse(data.passengers.scholars);
				var official_custom=JSON.parse(data.passengers.custom);
				
				

				if(official_staff!=null){
					
					 for(var a=0;a<official_staff.length;a++){
					 	var office=official_staff[a].office!=null?official_staff[a].office:'';
					 	var designation=official_staff[a].designation!=null?official_staff[a].designation:'';
					 	htm+=` <div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11  verified-travel-passenger-section">
						 

						 <div class="row  verified-travel-passenger">
							<div class="col col-md-1 col-sm-1">
						 		<div class="profile-image  profileImage profile-image-requester" display-image="`+official_staff[a].profile_image+`" data-mode="staff" style="background: url(&quot;/profiler/profile/`+official_staff[a].profile_image+`&quot;) center center / cover no-repeat;"></div>
						 	</div>

						 	<div class="col col-md-10 col-sm-10">
						 		<p><b>`+official_staff[a].name+`</b><br/>`+designation+`<br/>`+office+`</p>
						 	</div>
						 </div>

					 </div>`;

					 }
				}


				if(official_scholars!=null){
					 for(var b=0;b<official_scholars.length;b++){
					 	var nationality=official_scholars[b].nationality!=null?official_scholars[b].nationality:'';
					 	htm+=` <div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11 verified-travel-passenger-section">
						 

						 <div class="row  verified-travel-passenger">
							<div class="col col-md-1 col-sm-1">
						 		<div class="profile-image  profileImage profile-image-requester" display-image="`+official_scholars[b].profile_image+`" data-mode="staff" style="background: url(&quot;/profiler/profile/`+official_scholars[b].profile_image+`&quot;) center center / cover no-repeat;"></div>
						 	</div>

						 	<div class="col col-md-10 col-sm-10">
						 		<p><b>`+official_scholars[b].full_name+`</b><br/>`+nationality+`<br/>SEARCA Scholar</p>
						 	</div>
						 </div>

					 </div>`;

					 }
				}


				if(official_custom!=null){
				 for(var c=0;c<official_custom.length;c++){
				 	var designation=official_custom[c].designation!=null?official_custom[c].designation:'';
				 	htm+=` <div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11  verified-travel-passenger-section">
					 

					 <div class="row  verified-travel-passenger">
						<div class="col col-md-1 col-sm-1">
					 		<div class="profile-image  profileImage profile-image-requester" display-image="`+official_custom[c].profile_image+`" data-mode="staff" style="background: url(&quot;/profiler/profile/`+official_custom[c].profile_image+`&quot;) center center / cover no-repeat;"></div>
					 	</div>

					 	<div class="col col-md-10 col-sm-10">
					 		<p><b>`+official_custom[c].full_name+`</b><br/>`+designation+`</p>
					 	</div>
					 </div>

				 </div>`;

				 }
				}
				



			htm+=`</div>`;




		}
		

	
	

	$('.verified_travel_result').html(htm)


	$('.mark-as-menu').off('click');
	$('.mark-as-menu').on('click',function(){
		selectedTrips=this;
		
	})



	bindMarkMenu()




}


function bindMarkMenu(){

	$('.mark-as-link').off('click');
	$('.mark-as-link').on('click',function(e){
		e.preventDefault();

		var content=$(selectedTrips).attr('data-content');
		var json=JSON.parse(content);
		var id=json.id;
		var current_status=json.status;
		var set_status=$(this).attr('data-mark');
		var type=json.type;
		
		updateVerifiedTravel(id,set_status,type)

		
	})
}


function updateVerifiedTravel(id,status,type){
	showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/status',function(){

		$('.modal-submit').on('click',function(){

			ajax_updateVerifiedTravel('api/travel/official/verified/',id,status,type,function(){
				if(type=='official') $('.official'+id).slideUp();
				if(type=='personal') $('.personal'+id).slideUp();
				if(type=='campus') $('.campus'+id).slideUp();
			})

		})
		

	})

}





function tripsPager(callback){
	var timeOut;



	$('.list-current-page').off('change');
	$('.list-current-page').on('change',function(){

		var that=this
		
			if($(that).val()>JSON.parse(trips).pages||$(that).val()<1){
				$(that).css({'background-color':'#a94442','color':'#fff'})
			}else{
				$(that).css({'background-color':'#fff','color':'#000'})

				clearTimeout(timeOut)
				timeOut=setTimeout(function(){
					callback($(that).val())
				},800)
			}
	
	})
}



bindVerifiedRecentTravel(1)

$(document).ready(function(){


	$('.trip-link').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		//change title
		var type=$(this).attr('data-type');
		$('.verified_travel_title').html(type);

		//show loading
		$('.verified_travel_result').html('Loading . . .');

		//display result
		switch(type){
			case 'Scheduled':
				bindVerifiedRecentTravel()
			break;
			case 'Ongoing':
				bindVerifiedOngoingTravel()
			break;
			case 'Finished':
				bindVerifiedFinishedTravel()
			break;
			default:
			break;


		}

		return false;
	})











})

</script>
