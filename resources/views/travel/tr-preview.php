<div class="row preview-content">
		<div class="col col-md-12 row">
			<ul class="list-unstyled preview-menu-li">
				<li><strong>5691</strong></li>
				<li><span class="glyphicon glyphicon-share-alt"></span></li>
				<li><span class="glyphicon glyphicon-print"></span></li>
			</ul>
			
		</div>
		<div class="col col-md-12 preview-title" >
			<div class="col col-md-3">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9">
				<h4 class="preview-name"></h4>
				<p class="preview-unit">Management Services Unit</p>
				<p class="preview-created">1/17/16</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Purpose</b></p>
				<p class="purpose-content preview-purpose"> . . .</p>	
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Passengers</b></p>
				<table class="table table-striped passenger-table preview-table table-fluid" id="table-passenger" ng-show="passengersX.length>=1||passengersScholar.length>=1||passengersCustom.length>=1">
					<thead>
						<tr>
							<th>Name</th><th>Designation</th><th>Office/Unit</th>
						</tr>
					</thead>
					<tbody class="preview-passengers">
						

					</tbody>
				</table>
			</div>


			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Itenerary</b></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

		</div>


	</div>


<script type="text/javascript">	

// placeholder
var preview;
var scholars;
var staff;
var official_travel_custom_passenger;
var official_travel_itenerary;


function ajax_getOfficialTravelListPreview(page_number=1){
	preview=[{"id":"1","0":"284","purpose":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nominati duo. Et tempor omittam pri, mel sonet dicant intellegam eu. Latine malorum liberavisse ei sit, commodo volutpat vel ea. Nec ut epicuri suscipit scaevola, eam nisl ipsum omittantur id. Sit ut dolores posidonium, maiorum civibus ad eum.<br/>Ex lorem impetus insolens usu. Et sea omnes aperiri, ut vim ipsum legimus reformidans. Vix ad suas veniam fabulas, eos ut purto sonet principes. Est inimicus laboramus forensibus cu.<br/><br/>Virtute expetenda pri et. Pro dicunt delenit tincidunt in. Partiendo corrumpit cum ea, alii docendi sed at. Electram efficiendi mel ad, cu eos altera erroribus. Mei id atqui percipit molestiae, ea delenit oporteat pro. Usu te vero harum similique, ut vix reque dolorum recusabo.<br/><br/>Ea doming impetus pertinax sit, ut qui liber vulputate, cum ad diceret senserit. Et has falli tacimates, cu suas reprehendunt ius. Harum commodo sit an, duo congue reprehendunt et. Ut pro luptatum expetendis, cu nobis ubique abhorreant sit. Populo urbanitas has an, eu graecis atomorum cum.<br/><br/>Pro commodo maluisset salutatus eu, cetero convenire qui ne. Mea alii apeirian ut, ut quo zril veniam commodo, et porro soluta pertinax sit. Ne luptatum periculis temporibus mea, melius aliquando definitiones sed an, aeque commodo albucius nec an. Duo eu paulo partem iisque. In mei quas choro assueverit, cu iudico nonumy omittam mea, nec cu justo omnes.","1":"Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nominati duo. Et tempor omittam pri, mel sonet dicant intellegam eu. Latine malorum liberavisse ei sit, commodo volutpat vel ea. Nec ut epicuri suscipit scaevola, eam nisl ipsum omittantur id. Sit ut dolores posidonium, maiorum civibus ad eum.<br/><br/>Ex lorem impetus insolens usu. Et sea omnes aperiri, ut vim ipsum legimus reformidans. Vix ad suas veniam fabulas, eos ut purto sonet principes. Est inimicus laboramus forensibus cu.<br/><br/>Virtute expetenda pri et. Pro dicunt delenit tincidunt in. Partiendo corrumpit cum ea, alii docendi sed at. Electram efficiendi mel ad, cu eos altera erroribus. Mei id atqui percipit molestiae, ea delenit oporteat pro. Usu te vero harum similique, ut vix reque dolorum recusabo.<br/><br/>Ea doming impetus pertinax sit, ut qui liber vulputate, cum ad diceret senserit. Et has falli tacimates, cu suas reprehendunt ius. Harum commodo sit an, duo congue reprehendunt et. Ut pro luptatum expetendis, cu nobis ubique abhorreant sit. Populo urbanitas has an, eu graecis atomorum cum.<br/><br/>Pro commodo maluisset salutatus eu, cetero convenire qui ne. Mea alii apeirian ut, ut quo zril veniam commodo, et porro soluta pertinax sit. Ne luptatum periculis temporibus mea, melius aliquando definitiones sed an, aeque commodo albucius nec an. Duo eu paulo partem iisque. In mei quas choro assueverit, cu iudico nonumy omittam mea, nec cu justo omnes.","source_of_fund":"opf","2":"opf","requested_by":"1","3":"1","approved_by":null,"4":null,"date_approved":"","5":"","date_created":"2016-10-17 09:36:42","6":"2016-10-17 09:36:42","date_modified":"2016-09-29 10:08:01","7":"2016-11-09 15:27:26","plate_no":null,"8":null,"status":"2","9":"2","10":"1","uid":"67","11":"67","profile_name":"John Kenneth G. Abella","12":"John Kenneth G. Abella","last_name":"Abella","13":"Abella","first_name":"John Kenneth","14":"John Kenneth","middle_name":null,"15":null,"profile_email":null,"16":null,"department":"Info Tech Services Unit","17":"Info Tech Services Unit","department_alias":"ITSU","18":"ITSU","position":"programmer","19":"programmer","profile_image":"67.PNG","20":"67.PNG","21":"2016-09-29 10:08:01"}]

	return preview;
}


function ajax_getOfficialTravelPassengerScholarsPreview(){
	scholars=[{"full_name":"Chya Suthiwanith","uid":"7","id":"303","nationality":"Thai","profile_image":"","office":"scholar"},{"full_name":"Yuwat Vuthimedhi","uid":"8","id":"304","nationality":"Thai","profile_image":"","office":"scholar"},{"full_name":"Ngamchuen Kaowichian-Ratanadilok","uid":"3","id":"305","nationality":"Thai","profile_image":"","office":"scholar"},{"full_name":"Pensook Ratisoontorn-Tauthong","uid":"2","id":"306","nationality":"Thai","profile_image":"","office":"scholar"}]

	return scholars;
}

function ajax_getOfficialTravelPassengerStaffPreview(){
	staff=[{"name":"ICU","uid":"4","id":"299","designation":"Accounting Head","office":"Accounting Unit","profile_image":null,"allias":"AcU"},{"name":"FMU","uid":"3","id":"300","designation":null,"office":"Facilities Management Unit","profile_image":"3.jpg","allias":"FMU"},{"name":"Administrator","uid":"1","id":"301","designation":"administrator","office":"Accounting Unit","profile_image":"1.jpg","allias":"AcU"},{"name":"Amy A. Antonio","uid":"29","id":"302","designation":null,"office":"Project Development and Technical Services","profile_image":null,"allias":"PDTS"}]

	return staff;
}

function ajax_getOfficialTravelPassengerCustomPreview(){
	official_travel_custom_passenger=[{"id":"1","0":"1","tr_id":"291","1":"291","full_name":"john","2":"john","designation":"test","3":"test"}]

	return official_travel_custom_passenger;
}


function ajax_getOfficialTravelItenerary(){
	official_travel_itenerary=[{"id":"273","0":"273","tr_id":"291","1":"291","res_id":null,"2":null,"location":"SEARCA","3":"SEARCA","destination":"Cavite","4":"Cavite","departure_time":"05:00:00","5":"05:00:00","actual_departure_time":"00:00:00","6":"00:00:00","returned_time":"00:00:00","7":"00:00:00","departure_date":"2016-11-30","8":"2016-11-30","returned_date":"0000-00-00","9":"0000-00-00","status":"scheduled","10":"scheduled","plate_no":null,"11":null,"driver_id":"0","12":"0","linked":"no","13":"no","date_created":"2016-11-21 13:36:24","14":"2016-11-21 13:36:24"},{"id":"274","0":"274","tr_id":"291","1":"291","res_id":null,"2":null,"location":"Cabuyao","3":"Cabuyao","destination":"test","4":"test","departure_time":"05:00:00","5":"05:00:00","actual_departure_time":"00:00:00","6":"00:00:00","returned_time":"00:00:00","7":"00:00:00","departure_date":"2016-11-29","8":"2016-11-29","returned_date":"0000-00-00","9":"0000-00-00","status":"scheduled","10":"scheduled","plate_no":null,"11":null,"driver_id":"0","12":"0","linked":"no","13":"no","date_created":"2016-11-21 14:02:03","14":"2016-11-21 14:02:03"}]
	return official_travel_itenerary;
}



function showOfficialTravelListPreview(){
	ajax_getOfficialTravelListPreview()
	
	$('.preview-name').html(preview[0].profile_name)
	$('.preview-unit').html(preview[0].department)
	$('.preview-created').html(((preview[0].date_created).split(' '))[0])
	$('.preview-purpose').html(preview[0].purpose)
}

function showOfficialTravelPassengerStaffPreview(){
	ajax_getOfficialTravelPassengerStaffPreview();
	for(var x=0;x<staff.length;x++){
		var htm=`<tr data-menu="removePassengerMenu" context="0" data-selection="`+staff[x].id+`" id="official_travel_staff_passenger_tr`+staff[x].id+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+staff[x].profile_image+`" data-mode="staff"></div></div>
								<div class="col col-md-9"><b>`+staff[x].name+`</b></div></td>

							
							<td>`+staff[x].designation+`</td>
							<td>`+staff[x].office+`</td>
						</tr>`

		$('.preview-passengers').append(htm)
	}
}


function showOfficialTravelPassengerScholarsPreview(){
	ajax_getOfficialTravelPassengerScholarsPreview();
	for(var x=0;x<scholars.length;x++){
		var htm=`<tr data-menu="removePassengerMenu" context="0" data-selection="`+scholars[x].id+`" id="official_travel_scholars_passenger_tr`+scholars[x].id+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+scholars[x].profile_image+`" data-mode="scholars"></div></div>
								<div class="col col-md-9"><b>`+scholars[x].full_name+`</b></div></td>

							
							<td>`+scholars[x].nationality+`</td>
							<td>`+scholars[x].office+`</td>
						</tr>`

		$('.preview-passengers').append(htm)
	}	
}


function showOfficialTravelPassengerCustomPreview(){
	ajax_getOfficialTravelPassengerCustomPreview();
	for(var x=0;x<official_travel_custom_passenger.length;x++){
		var htm=`<tr data-menu="removePassengerMenu" data-selection="`+official_travel_custom_passenger[x].id+ `" id="official_travel_custom_passenger_tr`+official_travel_custom_passenger[x].id+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="" data-mode="custom"></div></div>
								<div class="col col-md-9"><b>`+official_travel_custom_passenger[x].id+`</b></div></td>
							<td>`+official_travel_custom_passenger[x].designation+`</td>
							<td>N/A</td>
						</tr>`

		$('.preview-passengers').append(htm)
	}
}


function showOfficialTravelItenerary(){
	ajax_getOfficialTravelItenerary();
	for(var x=0; x<official_travel_itenerary.length;x++){
		var htm=`<details class="col col-md-12" id="official_travel_itenerary`+official_travel_itenerary[x].id+`">
					<summary>`+official_travel_itenerary[x].location+` - `+official_travel_itenerary[x].destination+`</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>`+official_travel_itenerary[x].location+`</td>
								<td>`+official_travel_itenerary[x].destination+`</td>
								<td>`+official_travel_itenerary[x].departure_date+`</td>
								<td>`+official_travel_itenerary[x].departure_time+`</td>
							</tr>
						</tbody>
					</table>
				</details>
			`

		$('.preview-itenerary').append(htm)
	}
}


function removeOfficialTravelPassengerCustom(id){
	
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){

	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		//ajax here
	    		$('#official_travel_custom_passenger_tr'+id).fadeOut()
	    		$('#preview-modal').modal('hide');

	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerScholar(id){

	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){

	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		//ajax here
	    		$('#official_travel_scholars_passenger_tr'+id).fadeOut()
	    		$('#preview-modal').modal('hide');

	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');

	
}

function removeOfficialTravelPassengerStaff(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){

	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		//ajax here
	    		$('#official_travel_staff_passenger_tr'+id).fadeOut()
	    		$('#preview-modal').modal('hide');

	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}

function removeOfficialTravelItenerary(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){

	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		//ajax here
	    		$('#official_travel_itenerary'+id).fadeOut()
	    		$('#preview-modal').modal('hide');

	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}


function removeOfficialTravel(id){
	$('#preview-modal').on('show.bs.modal', function (e) {
	    $('#preview-modal-dialog').load('travel/modal/remove',function(data){
	    	$('.modal-submit').on('click',function(){

	    		//loading
	    		previewLoadingEffect()
	    		
	    		//disable onclick
	    		$(this).attr('disabled','disabled')

	    		//ajax here
	    		setTimeout(function(){

	    			$('.preview-content').fadeOut()
	    			$(selectedElement).remove();
	    			
	    		},1000)

	    		$('#preview-modal').modal('hide');

	    		//back to original
	    		$(this).attr('disabled','enabled')
	    	})
	    })
	});

	$('#preview-modal').modal('toggle');
	
}




$(document).ready(function(){


showOfficialTravelListPreview()
showOfficialTravelPassengerStaffPreview()
showOfficialTravelPassengerScholarsPreview()
showOfficialTravelPassengerCustomPreview()
showOfficialTravelItenerary()
	
});
</script>