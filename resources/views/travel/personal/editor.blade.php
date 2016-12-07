<div class="contextMenu" id="staffPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialPassengerButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="contextMenu" id="scholarPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialScholarButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="contextMenu" id="customPassengerMenu">
	<ul class="list-group">		
		<li class="list-group-item removeOfficialCustomButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>

<div class="contextMenu" id="iteneraryMenu">
	<ul class="list-group">		
		<li class="list-group-item removeIteneraryButton"><span class="glyphicon glyphicon-remove basket"></span> Remove</li>
	</ul>
</div>
<div class="modal fade" id="custom-passenger-modal">
	<div class="modal-dialog" id="passenger-modal-dialog">
			
	</div>
</div>

<div class="modal fade" id="passenger-modal">
	<div class="modal-dialog" id="passenger-modal-dialog">
			@include('travel/modal/passenger')
	</div>
</div>

<div class="modal fade" id="itenerary-modal">
	<div class="modal-dialog" id="itenerary-modal-dialog">
			@include('travel/modal/itenerary')
	</div>
</div>

<div class="row preview-content">
		<div class="col col-md-5 col-md-offset-2">
			<ul class="list-unstyled preview-menu-li">
				<li><strong>5691</strong>&emsp;<small>[R/W Mode]</small></li>
			</ul>
			
		</div>
		<div class="col col-xs-12 col-md-8  col-md-offset-2 preview-title">
			<div class="col col-md-2 col-sm-2">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9 col-xs-7">
				<h3 class="preview-name">John Kenneth G. Abella</h3>
				<p class="preview-unit">Info Tech Services Unit</p>
				<p class="preview-created">2016-10-17</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-8 col-sm-12 col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Purpose</b> 
					<span class="btn btn-success btn-xs" id="officialPurposeSaveButton"><span class="glyphicon glyphicon-floppy-disk"></span></span>
					<div id="officialPurposeSaveStatus" class="text-muted" style="float:right;height:20px;width:250px;overflow: hidden;position:relative;"></div>
					<p></p>
				<p class="purpose-content"> <textarea class="col col-md-12 col-sm-12 col-xs-12  preview-purpose" rows="15">Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nominati duo. Et tempor omittam pri, mel sonet dicant intellegam eu. Latine malorum liberavisse ei sit, commodo volutpat vel ea. Nec ut epicuri suscipit scaevola, eam nisl ipsum omittantur id. Sit ut dolores posidonium, maiorum civibus ad eum.<br>Ex lorem impetus insolens usu. Et sea omnes aperiri, ut vim ipsum legimus reformidans. Vix ad suas veniam fabulas, eos ut purto sonet principes. Est inimicus laboramus forensibus cu.<br><br>Virtute expetenda pri et. Pro dicunt delenit tincidunt in. Partiendo corrumpit cum ea, alii docendi sed at. Electram efficiendi mel ad, cu eos altera erroribus. Mei id atqui percipit molestiae, ea delenit oporteat pro. Usu te vero harum similique, ut vix reque dolorum recusabo.<br><br>Ea doming impetus pertinax sit, ut qui liber vulputate, cum ad diceret senserit. Et has falli tacimates, cu suas reprehendunt ius. Harum commodo sit an, duo congue reprehendunt et. Ut pro luptatum expetendis, cu nobis ubique abhorreant sit. Populo urbanitas has an, eu graecis atomorum cum.<br><br>Pro commodo maluisset salutatus eu, cetero convenire qui ne. Mea alii apeirian ut, ut quo zril veniam commodo, et porro soluta pertinax sit. Ne luptatum periculis temporibus mea, melius aliquando definitiones sed an, aeque commodo albucius nec an. Duo eu paulo partem iisque. In mei quas choro assueverit, cu iudico nonumy omittam mea, nec cu justo omnes.
				</textarea>	
				</p>	
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal"><span class="glyphicon glyphicon-plus"></span></button></p>
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


			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p><div class="mini-circle"></div> <b>Itenerary</b> <span class="btn btn-success btn-xs" id="officialIteneraryButton" data-toggle="modal" data-target="#itenerary-modal"><span class="glyphicon glyphicon-map-marker"></span></span></p>
				<div class="preview-itenerary">

				</div>
				
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p><div class="mini-circle"></div> <b>Type of Vehicle</b></p>
				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" disabled="disabled" > SUV 
					<input type="radio" name="vtype" value="2" select-mobi="2" checked="checked"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"> Pick-up	
				</p>
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p><div class="mini-circle"></div> <b>Mode of Payment</b></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" checked="checked"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled"></span>
				</p>
			</div>
				
			</div>

		</div>


	</div>

<script type="text/javascript">	

$(document).ready(function(){

showOfficialTravelListPreview()
showOfficialTravelPassengerStaffPreview()
showOfficialTravelPassengerScholarsPreview()
showOfficialTravelPassengerCustomPreview()
showOfficialTravelItenerary()
bindRemoveStaff();
bindRemoveItenerary();
bindRemoveOfficialScholar();
bindRemoveOfficialCustom();

$('#officialPurposeSaveButton').click(function(e){
	e.preventDefault();
	 showLoading('#officialPurposeSaveStatus',' <span>saving . . .</span>&emsp;<span><img src="img/loading.png" class="loading-circle" width="10px"/></span>')
		setTimeout(function(){  showLoading('#officialPurposeSaveStatus') },1000)
	//$('#officialPurposeSaveStatus')
})

});
</script>