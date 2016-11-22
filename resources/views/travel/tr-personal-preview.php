<div class="row">
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
				<h4>Lorem ipsum dolor sit amet</h4>
				<p>Management Services Unit</p>
				<p>1/17/16</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Purpose</b></p>
				<p class="purpose-content">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>	
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Passengers</b></p>
				<table class="table table-striped passenger-table preview-table" id="table-passenger" ng-show="passengersX.length>=1||passengersScholar.length>=1||passengersCustom.length>=1">
					<thead>
						<tr>
							<th>Name</th><th>Designation</th><th>Office/Unit</th>
						</tr>
					</thead>
					<tbody>
						<!-- ngRepeat: (key, value) in passengersX --><tr ng-repeat="(key, value) in passengersX" id="tr0" class="tr-passenger ng-scope" data-menu="removePassengerMenu" context="0" data-selection="13">
							<td id="passenger0">
								<div class="col col-md-2"><div class="profile-image profile-image-tr" display-image="67.PNG" data-mode="staff" style="background: url(&quot;/profiler/profile/67.PNG&quot;) center center / cover no-repeat;"></div></div>
								<div class="col col-md-10"><b class="ng-binding">John Kenneth G. Abella</b></div></td>

							
							<td id="designation0" class="ng-binding">programmer</td>
							<td id="office0" class="ng-binding">ITSU<input type="hidden" id="passengerId0" value="13"></td>
						</tr><!-- end ngRepeat: (key, value) in passengersX --><tr ng-repeat="(key, value) in passengersX" id="tr1" class="tr-passenger ng-scope" data-menu="removePassengerMenu" context="1" data-selection="14">
							<td id="passenger1">
								<div class="col col-md-2"><div class="profile-image profile-image-tr" display-image="3.jpg" data-mode="staff" style="background: url(&quot;/profiler/profile/3.jpg&quot;) center center / cover no-repeat;"></div></div>
								<div class="col col-md-10"><b class="ng-binding">FMU</b></div></td>

							
							<td id="designation1" class="ng-binding"></td>
							<td id="office1" class="ng-binding">FMU<input type="hidden" id="passengerId1" value="14"></td>
						</tr><!-- end ngRepeat: (key, value) in passengersX -->
						<!-- ngRepeat: (key, value) in passengersScholar -->

						<!-- ngRepeat: (key, value) in passengersCustom -->

					</tbody>
				</table>
			</div>


			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Itenerary</b></p>
				<details class="col col-md-12">
					<summary>SEARCA - Manila</summary>
					<table class="table table-fluid">
						<thead>
							<th>Origin</th> <th>Destination</th>  <th>Date</th> <th>Time</th>
						</thead>
						<tbody>
							<tr>
								<td>SEARCA</td>
								<td>Manila</td>
								<td>10/5/16</td>
								<td>5:00 AM</td>
							</tr>
						</tbody>
					</table>
				</details>

				
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Type of Vehicle</b></p>
				<p class="col col-md-12">
					<input type="radio" name="vtype" value="1" select-mobi="1" disabled="disabled" > SUV 
					<input type="radio" name="vtype" value="2" select-mobi="2" checked="checked"> Van
					<input type="radio" name="vtype" value="3" select-mobi="3" disabled="disabled"> Pick-up	
				</p>
			</div>

			<div class="col col-md-12 preview-sections">
				<p><div class="mini-circle"></div> <b>Mode of Payment</b></p>
				<p class="col col-md-12">
					<span>Cash <input type="radio" name="mode-of-payment" disabled="disabled" checked="checked"></span>
					<span>Salary Deduction <input type="radio" name="mode-of-payment" disabled="disabled"></span>
				</p>
			</div>

		</div>


	</div>

