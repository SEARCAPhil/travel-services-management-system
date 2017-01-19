/*
* VERIFIED TRAVEL/TRIP/ITINERARY SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*/	



/*
|----------------------------------------------------------------------------
| Append Items to List
|---------------------------------------------------------------------------
|
| This is used inside show travel requests functions
| This allows to run script on success operations
|
|
*/


var trips= {};
var selectedTrips;


/*
|----------------------------------------------------------------------------
| AJAX Verified travel
|---------------------------------------------------------------------------
|
| GET list of merged travel of official,personal and campus
*/

function ajax_getVerifiedTravel(url,page,callback){
	$.get(url+''+page,function(json){
		trips=json
		callback(json);
	}).fail(function(){
		alert('Oops! Something went wrong');
	})
}


/*
|----------------------------------------------------------------------------
| AJAX Link travel list
|---------------------------------------------------------------------------
|
| GET list of official travel excluding the selected item
*/
function ajax_getVerifiedTravelForLinking(url,page,id,callback){
	$.get(url+''+page+'/'+id,function(json){
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





/*
|----------------------------------------------------------------------------
| AJAX Link travel Official travel
|---------------------------------------------------------------------------
|
| GET linked travel
*/
function ajax_getLinkedOfficialTravel(id,callback){
	$.get('api/travel/official/verified/scheduled/'+id,function(json){
		callback(json);
	}).fail(function(){
		alert('Oops! Something went wrong');
	})
}

function ajax_linkOfficialTravel(parentId,childId,callback){
	$.post('api/travel/official/verified/scheduled/'+childId,{ _token: $("input[name=_token]").val(),parent:parentId,child:childId},function(json){
		callback(json);
	}).fail(function(){
		alert('Oops! Something went wrong');
	})
}


function ajax_unlinkOfficialTravel(id,callback){
	$.ajax({

		url:'api/travel/official/verified/scheduled/'+id,
		method:'DELETE',
		data: { _token: $("input[name=_token]").val()},
		success:function(data){
			if(data==1){
				callback(data)
	    		$('#preview-modal').modal('hide');

			}else{
				alert('Oops! Something went wrong.Try to refresh the page')
			}
		},
		error:function(){
			
			alert('Oops! Something went wrong');
	
		}
	})
}




/*
|----------------------------------------------------------------------------
| Link travel list
|---------------------------------------------------------------------------
|
| Link/Unlink travel to another travel
*/

function linkOfficialTravel(parentId,childId,callback){
	ajax_linkOfficialTravel(parentId,childId,function(id){
		if(id!=null&&id.length>0&&id>0){

			callback(id)
		}else{
			alert('Bad Request!')
		}

	});
}


function unlinkOfficialTravel(id,callback){
	ajax_unlinkOfficialTravel(id,function(id){
		if(id!=null&&id.length>0&&id>0){
			callback(id)
		}else{
			alert('Bad Request!')
		}

	});
}





/*
|----------------------------------------------------------------------------
| Linked Travel List
|---------------------------------------------------------------------------
|
| Display all travel linked on the item
*/

function showLinkedOfficialTravel(id,callback){
	ajax_getLinkedOfficialTravel(id,function(json){
		callback(json);
	})
}







/*
|----------------------------------------------------------------------------
| Verified Travel
|---------------------------------------------------------------------------
|
| Display all verified travel on the list
*/

function showVerifiedRecentTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/scheduled/',page,function(json){

		appendToList(json);
		
		//next page
		setTimeout(function(){
			tripsPager(function(val){
				showVerifiedRecentTravel(val)
			});

		},800)


	})

}


function showVerifiedOngoingTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/ongoing/',page,function(json){

		appendToList(json);

		//next page
		setTimeout(function(){
			tripsPager(function(val){
				showVerifiedOngoingTravel(val)
			});

		},800)
		
	})

}


function showVerifiedFinishedTravel(page=1){

	//clear result section
	$('.verified_travel_result').html('Loading . . .');

	ajax_getVerifiedTravel('travel/verified/finished/',page,function(json){

		appendToList(json);

		//next page
		setTimeout(function(){
			tripsPager(function(val){
				showVerifiedFinishedTravel(val)
			});

		},800)
		
	})

}




/*
|----------------------------------------------------------------------------
| Verified Travel Status
|---------------------------------------------------------------------------
|
| Change status to scheduled,ongoing or finished
*/

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



/*
|----------------------------------------------------------------------------
| Trips pagination
|---------------------------------------------------------------------------
*/

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












/*
|----------------------------------------------------------------------------
| Append linked data under the travel section
|---------------------------------------------------------------------------
|
| Display all item on the list. This is used inside the show* function
*/

function appendToLinkedTravel(json,target){
var htm='';

		var json=JSON.parse(json);

		if(typeof json.data=='undefined') return false;

		for(var x=0; x<json.data.length; x++){
			var data=json.data[x];

			var departure_date=new Date(data.departure_date).getDate();

			htm+=`<div class="row `+data.type+``+data.id+` linked-travel-item linked-travel-item-`+data.id+`">
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
					 `;

					htm+=`<p>&nbsp;<a href="#" data-link="`+data.id+`" class="travel-unlink-button">Unlink <span class="glyphicon glyphicon-link"></span></a></p>`;
				


				htm+=`</div></div>`;
		}


		
		$(target).html(htm)
		

}





/*
|----------------------------------------------------------------------------
| Append data on the preview
|---------------------------------------------------------------------------
|
| Display all item on the list. This is used inside the show* function
*/

function appendToList(json){

		var htm='';

		var json=JSON.parse(json);

		//update total pages
		$('.list-total-pages').html(json.pages)

		for(var x=0; x<json.data.length; x++){
			var data=json.data[x];

			var departure_date=new Date(data.departure_date).getDate();
			var plate_no=data.plate_no!=null?data.plate_no:'N/A'

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



				 	<div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11">
						<small>
							<a href="#" class="travel-link advance-menu pull-left  travel-other-details-read-more travel-other-details-read-more-`+data.id+`" title="Read other details" data-target="travel-other-details-`+data.id+`">
								<span class="glyphicon glyphicon-option-horizontal"></span>
							</a>
						</small>
					</div>


					<div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11 travel-other-details travel-other-details-`+data.id+`">
						<p><label>Driver : <u class="travel-other-details-driver-`+data.id+`">`+data.driver+`</u></label> </p>
						<p><label>Vehicle Plate Number : <u class="travel-other-details-vehicle-`+data.id+`">`+plate_no+`</u></label> </p>
						<p><label>Departure Time(Actual) : <u>`+data.actual_time+`</u></label> </p>
						<p><label>Returned Date : <u>`+data.departure_date+`</u></label> </p>
						<p><label>Returned Time : <u>`+data.departure_time+`</u></label> </p>
						<p><hr/></p>
					</div>



				 <div class="col col-md-offset-1 col-md-11 col-sm-offset-1 col-sm-11" style="border-bottom:1px solid rgb(250,250,250);">
					 <small>
					 	<ul class="list-unstyled trip-list">`;



					 		if(data.type=='official'&&data.status=='scheduled'){
								htm+=`<li><a href="#" class="travel-link travel-link-button pull-left" data-type="official" data-link="`+data.id+`"> Link <span class="glyphicon glyphicon-link"></span> </a> </li>`
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
							<li class="dropdown"> <a href="#" class="travel-link advance-menu pull-left dropdown-toggle" data-type="personal" data-toggle="dropdown"  data-content='`+JSON.stringify(data)+`' aria-haspopup="true" aria-expanded="true">Advance Options
								 <span class="glyphicon glyphicon-option-vertical"></span> </span>
								 </a>
								
									<ul class="dropdown-menu advance-menu-dropdpwn">
										<li><a href="#" class="advance-menu-selector" id="vehicle">Assign <b>SEARCA</b> Vehicle</a></li>
										<li><a href="#" class="advance-menu-selector" id="rent"><b>Rent</b> a Car</a></li>
									    <li><a href="#" class="advance-menu-selector" id="driver">Assign Driver</a></li>
									    <li><a href="#" class="advance-menu-selector"  id="charge" data-charge="`+data.id+`">Charge</a></li>
									  </ul>
								
							</li>`;

							
							if(data.type=='official'){

								htm+=`<li> <a href="travel/official/print/travel_request/`+data.id+`" target="_blank" class="travel-link"><span class="glyphicon glyphicon-print"></span></a></li>`
	
							}

							if(data.type=='personal'){

								htm+=`<li> <a href="travel/personal/print/travel_request/`+data.id+`" target="_blank" class="travel-link"><span class="glyphicon glyphicon-print"></span></a></li>`
	
							}


							if(data.type=='campus'){

								htm+=`<li> <a href="travel/campus/print/travel_request/`+data.id+`" target="_blank" class="travel-link"><span class="glyphicon glyphicon-print"></span></a></li>`
	
							}


						htm+=`</ul>
					</small>

					<div style="clear:both"><br/></div>

				 	
				 </div>
				 
				 `;

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
				


			htm+='<div class="col col-md-10 col-md-offset-1  linked-section linked-section'+data.id+'"></div>';
			htm+=`</div>`;

			if(data.type=='official'){
				var parentId=data.id
				showLinkedOfficialTravel(parentId,function(json){

					appendToLinkedTravel(json,'.linked-section'+parentId)
					bindTravelUnlinkButton();
				});
			}




		}
		

	
	

	$('.verified_travel_result').html(htm)

	//mark the travel as selected
	$('.mark-as-menu , .advance-menu').off('click');
	$('.mark-as-menu , .advance-menu').on('click',function(){
		selectedTrips=this;
		
	})


	$('.travel-other-details-read-more').off('click');
	$('.travel-other-details-read-more').on('click',function(e){
		e.preventDefault();
		//hide
		$(this).hide();
		var target=$(this).attr('data-target');
		$('.'+target).slideDown();
	})


	//bind options
	bindMarkMenu()
	bindTravelLinkButton()
	bindAdvanceSelector();

}




/*
|----------------------------------------------------------------------------
| Append data in modal
|---------------------------------------------------------------------------
|
| Display all available travel for linking
*/

function appendToListInLinkModal(json,target){

		var htm='';

		var json=JSON.parse(json);

		//loading
		$('.link-list-section').html('Loading . . .')

		//update total pages
		//$('.list-total-pages').html(json.pages)

		for(var x=0; x<json.data.length; x++){
			var data=json.data[x];

			var departure_date=new Date(data.departure_date).getDate();

			htm+=`<div class="row link-list" id="`+data.id+`">
			 	<div class="col col-md-1 col-sm-1 col-xs-2">
					 <div class="text-center col trip-date `+data.type+`">
					 	`+departure_date+`
					 </div>
				</div>
				 <div class="col col-md-10 col-sm-10 co-xs-10 link-list-detail">
				 	<p>&nbsp;<b><u>`+data.location+`</u></b> - <b><u>`+data.destination+`</u></b></p>
				 	<p>&nbsp;<b>`+data.departure_date+`</b>  - `+data.departure_time+`</p>
				 	<p>&nbsp;<small>`+data.requester+`</small></p>

				 </div>

				 `;
			htm+=`</div>`;




		}
		


	$('.link-list-section').html(htm)
	bindLinkToListInTravelModal(target);

}





/*
|----------------------------------------------------------------------------
| Bind mark
|---------------------------------------------------------------------------
|
|Update status of the travel
*/

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

function bindAdvanceSelector(){
	$('.advance-menu-selector').off('click');
	$('.advance-menu-selector').on('click',function(e){
		e.preventDefault();
		
		var content=JSON.parse($(selectedTrips).attr('data-content'))
		var id=content.id
		var type=content.type

		var menu=$(this).attr('id')
		if(menu=='vehicle') advanceMenuVehicle();
		if(menu=='driver') advanceMenuDriver();
		if(menu=='charge'){
			var charge=$(this).attr('data-charge')
			advanceMenuCharge(charge);
		} 
		if(menu=='rent') advanceMenuRentACar();


	})
}


function advanceMenuVehicle(){
	showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/vehicle',function(){

			
	});	
}

function advanceMenuDriver(){
	showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/driver',function(){

			
	});	
}

function advanceMenuCharge(id){
	showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/charge',function(){

		


			
	});	
}

function advanceMenuRentACar(){
	showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/rent',function(){

			
	});	
}







/*
|----------------------------------------------------------------------------
| Bind Link
|---------------------------------------------------------------------------
|
| Call link/unlink function for click event 
*/

function bindUnlink(target){
	$('.modal-submit').on('click',function(){

		var id=$(target).attr('data-link');

		unlinkOfficialTravel(id,function(){
			$('.linked-travel-item-'+id).fadeOut();
		});

	});
}

function bindTravelLinkButton(){

	$('.travel-link-button').off('click')
	$('.travel-link-button').on('click',function(e){
		e.preventDefault();
		var target=this;
		var id=$(target).attr('data-link');
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/link',function(){

			ajax_getVerifiedTravelForLinking('api/travel/official/verified/scheduled/',1,id,function(json){
				appendToListInLinkModal(json,target);
			});
		});
	})
}

function bindTravelUnlinkButton(){

	$('.travel-unlink-button').off('click')
	$('.travel-unlink-button').on('click',function(e){
		e.preventDefault();
		var target=this;
		var id=$(target).attr('data-link');
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','travel/modal/unlink',function(){

			bindUnlink(target)
		});
	})
}



function bindLinkToListInTravelModal(target){
	
	$('.link-list').off('click')
	$('.link-list').on('click',function(){
		var selectedElement;
		$('.link-list').removeClass('active');

		selectedElement='';
		selectedElement=$(this);

		$(this).addClass('active')
		var id=$(this).attr('id');

		$('.modal-submit').off('click')
		$('.modal-submit').on('click',function(){
			//hide linked item
			$(selectedElement).slideUp();


			//copy selected element
			var newSelectedItem=$(selectedElement).clone();


			//reset selected item
			selectedElement='';

				//modify selected element
			$(newSelectedItem).removeClass('active link-list') 

			$(newSelectedItem).addClass('col-md-12') 
			$(newSelectedItem).addClass('linked-travel-item')
			$(newSelectedItem).css({display:'none'})


			linkOfficialTravel($(target).attr('data-link'),id,function(newSelectedItemId){

				//success
				setTimeout(function(){
					//change id
					$(newSelectedItem).addClass('linked-travel-item-'+newSelectedItemId)	
					//add menu
					var menu_htm=`<p>&nbsp;<a href="#" data-link="`+newSelectedItemId+`" class="travel-unlink-button">Unlink <span class="glyphicon glyphicon-link"></span></a></p>`;
					$(newSelectedItem).children('.link-list-detail').append(menu_htm)


					$('.official'+$(target).attr('data-link')).children('.linked-section').append(newSelectedItem)
					$(newSelectedItem).slideDown()


					$('.official'+id).slideUp().remove();

					//bind unlink
					setTimeout(function(){ bindTravelUnlinkButton(); },1000);


				},600)

			});

			
				
			




		});
	})
}



/*
|----------------------------------------------------------------------------
| Bind Travel Navigation
|---------------------------------------------------------------------------
|
| Navigate page by travel's status 
*/


function bindTravelLinkNavigation(){
	$('.trip-link').off('click');
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
				showVerifiedRecentTravel()
			break;
			case 'Ongoing':
				showVerifiedOngoingTravel()
			break;
			case 'Finished':
				showVerifiedFinishedTravel()
			break;
			default:
			break;


		}

		return false;
	})
}



