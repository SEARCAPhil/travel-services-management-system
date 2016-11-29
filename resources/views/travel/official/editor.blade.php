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
			d
	</div>
</div>

<div class="modal fade" id="passenger-modal">
	<div class="modal-dialog" id="passenger-modal-dialog">
			@include('travel/modal/passenger')
	</div>
</div>

<div class="row preview-content">
		<div class="col col-md-5 col-md-offset-2">
			<ul class="list-unstyled preview-menu-li">
				<li><strong>5691</strong></li>
				<li><span class="glyphicon glyphicon-share-alt"></span></li>
				<li><span class="glyphicon glyphicon-print"></span></li>
				<li class="preview-remove"><span class="glyphicon glyphicon-remove"></span></li>
			</ul>
			
		</div>
		<div class="col col-md-8  col-md-offset-2 preview-title">
			<div class="col col-md-3">
				<div class="profile-image profile-image-main" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
			</div>
			<div class="col col-md-9">
				<h4 class="preview-name">John Kenneth G. Abella</h4>
				<p class="preview-unit">Info Tech Services Unit</p>
				<p class="preview-created">2016-10-17</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-8 col-sm-12 col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Purpose</b> <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-floppy-disk"></span></button><p></p>
				<p class="purpose-content"> <textarea class="col col-md-12 col-sm-12  preview-purpose" rows="15">Lorem ipsum dolor sit amet, his populo malorum alienum ea, mei in semper albucius suavitate. Mea volutpat salutatus consetetur ea, at case audire nominati duo. Et tempor omittam pri, mel sonet dicant intellegam eu. Latine malorum liberavisse ei sit, commodo volutpat vel ea. Nec ut epicuri suscipit scaevola, eam nisl ipsum omittantur id. Sit ut dolores posidonium, maiorum civibus ad eum.<br>Ex lorem impetus insolens usu. Et sea omnes aperiri, ut vim ipsum legimus reformidans. Vix ad suas veniam fabulas, eos ut purto sonet principes. Est inimicus laboramus forensibus cu.<br><br>Virtute expetenda pri et. Pro dicunt delenit tincidunt in. Partiendo corrumpit cum ea, alii docendi sed at. Electram efficiendi mel ad, cu eos altera erroribus. Mei id atqui percipit molestiae, ea delenit oporteat pro. Usu te vero harum similique, ut vix reque dolorum recusabo.<br><br>Ea doming impetus pertinax sit, ut qui liber vulputate, cum ad diceret senserit. Et has falli tacimates, cu suas reprehendunt ius. Harum commodo sit an, duo congue reprehendunt et. Ut pro luptatum expetendis, cu nobis ubique abhorreant sit. Populo urbanitas has an, eu graecis atomorum cum.<br><br>Pro commodo maluisset salutatus eu, cetero convenire qui ne. Mea alii apeirian ut, ut quo zril veniam commodo, et porro soluta pertinax sit. Ne luptatum periculis temporibus mea, melius aliquando definitiones sed an, aeque commodo albucius nec an. Duo eu paulo partem iisque. In mei quas choro assueverit, cu iudico nonumy omittam mea, nec cu justo omnes.
				</textarea>	
				</p>	
			</div>

			<div class="col col-md-8  col-md-offset-2 preview-sections">
				<p></p><div class="mini-circle"></div> <b>Passengers</b> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#passenger-modal"><span class="glyphicon glyphicon-plus"></span></button><p></p>
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
				<p></p><div class="mini-circle"></div> <b>Itenerary</b><p></p>
				<div class="preview-itenerary">

				<details class="col col-md-12" id="official_travel_itenerary273">
					<summary>SEARCA - Cavite</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<tr><th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</tr></thead>
						<tbody>
							<tr>
								<td>SEARCA</td>
								<td>Cavite</td>
								<td>2016-11-30</td>
								<td>05:00:00</td>
							</tr>
						</tbody>
					</table>
				</details>
			<details class="col col-md-12" id="official_travel_itenerary274">
					<summary>Cabuyao - test</summary>
					<table class="table table-fluid" style="background:rgba(250,250,250,0.7);color:rgb(40,40,40);">
						<thead>
							<tr><th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</tr></thead>
						<tbody>
							<tr>
								<td>Cabuyao</td>
								<td>test</td>
								<td>2016-11-29</td>
								<td>05:00:00</td>
							</tr>
						</tbody>
					</table>
				</details>
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

});
</script>