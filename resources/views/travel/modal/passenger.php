<div class="modal-content">
	<div class="modal-body">
		<h3>Passenger</h3>
		<p>Select person you want to include on this trip</p>

		<div class="row">
			<div class="col col-md-12">
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#staff" aria-controls="staff" role="tab" data-toggle="tab" data-page="automobile">Staff</a></li>
				    <li role="presentation"><a href="#scholars" aria-controls="scholars" role="tab" data-toggle="tab"  data-page="calendar">Scholars</a></li>
				    <li role="presentation"><a href="#custom" aria-controls="custom" role="tab" data-toggle="tab"   data-page="travel">Custom</a></li>
				  </ul>
			</div>
	  </div>

  	<div class="tab-content" style="margin-top: 20px;">
	 	<!--staff-->
	    <div role="tabpanel" class="tab-pane active" id="staff">
	    	    <div class="col col-md-12 ng-scope" style="margin-bottom: 30px;">
	                <div class="col col-md-2 pull-right ng-binding">/ 6</div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control ng-pristine ng-untouched ng-valid" ng-value="1" ng-model="searcaStaffDirectoryCurrentPage" pager-directory="staff" value="1"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find" search-directory="staff"> </div>
	                <div class="col col-md-1 pull-right text-right"><span class="glyphicon glyphicon-search"></span> </div>
	            </div>
            
	    	<form class="row">

                <div class="form-group">
                    <div class="col col-md-12 staff-list-directory">
                       
                    </div>


                </div>
                <div class="form-group text-right">
                    
                </div>
           </form>
	    </div>















	    <div role="tabpanel" class="tab-pane" id="scholars">
	    	<div class="col col-md-12 ng-scope" style="margin-bottom: 30px;">
	                <div class="col col-md-2 pull-right ng-binding">/ 6</div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control ng-pristine ng-untouched ng-valid" ng-value="1" ng-model="searcaStaffDirectoryCurrentPage" pager-directory="staff" value="1"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find" search-directory="staff"> </div>
	                <div class="col col-md-1 pull-right text-right"><span class="glyphicon glyphicon-search"></span> </div>
	            </div>
            
	    	<form class="row">

                <div class="form-group">
                    <div class="col col-md-12 scholar-list-directory">
                       
                    </div>


                </div>
                <div class="form-group text-right">
                    
                </div>
           </form>
	    </div>


	    <div role="tabpanel" class="tab-pane text-center row" id="custom">
	    	<div class="row" id="custom-dialog-content">
		    	<div class="col col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
		    		<div class="profile-image profile-image-lg" display-image="" data-mode="staff" style="background: url(&quot;/profiler/profile/user.png&quot;) center center / cover no-repeat;"></div>
		    	</div>
		    	<div class="col col-md-12">
	            	<h3 class="ng-scope">Custom Passenger</h3>
	            	<p class="ng-scope">Passenger that is not employed in this organization</p>
		            <form class="form col col-md-10 col-md-offset-1">
		                <div class="form-group "><br/>
		                    
		                        <label class="">Full Name</label>
		                    <input type="text" class="form-control" id="customFullName">
		                </div>

		                <div class="form-group">
		                    <label class="">Designation</label>
		                    <input type="text" class="form-control" id="customDesignation">
		                </div>


		                <div class="form-group text-right">
		                     <button class="btn btn-success" type="button" onclick="appendCustomListPreviewConfirmation()">Add</button>
		                    <button class="btn btn-default" type="button">Cancel</button>
		                </div>
		            </form> 
	            </div>
	        </div>
            <div class="col col-md-12" id="custom-confirmation"></div>

	    </div>
   	</div>

	</div>
</div>





<script type="text/javascript">
	var staff_list={};
	var scholar_list={};

	function ajax_getStaffList(page=1,func){


		staff_list={"current_page":1,"total_pages":6,"data":[{"uid":"1","name":"Administrator","email":"johnkenne@gmail","designation":"administrator","office":"Accounting Unit","profile_image":"1.jpg"},{"uid":"3","name":"FMU","email":null,"designation":null,"office":"Facilities Management Unit","profile_image":"3.jpg"},{"uid":"4","name":"ICU","email":null,"designation":"Accounting Head","office":"Accounting Unit","profile_image":null},{"uid":"10","name":"KRU","email":null,"designation":"","office":null,"profile_image":null},{"uid":"12","name":"MSU","email":null,"designation":null,"office":"Management Services Unit","profile_image":null},{"uid":"24","name":"Adah Sofia A. Renovilla","email":null,"designation":null,"office":"Office of the Director","profile_image":null},{"uid":"25","name":"Adoracion T. Robles","email":null,"designation":null,"office":"Planning and Budget Unit","profile_image":null},{"uid":"26","name":"Aldwin H. Escobin","email":null,"designation":null,"office":null,"profile_image":null},{"uid":"27","name":"Alicia D. Revilla","email":null,"designation":null,"office":"Information Technology Services Unit","profile_image":null},{"uid":"28","name":"Alvin G. Tallada","email":null,"designation":null,"office":null,"profile_image":null},{"uid":"29","name":"Amy A. Antonio","email":null,"designation":null,"office":"Project Development and Technical Services","profile_image":null},{"uid":"30","name":"Angelito R. Menguito","email":null,"designation":null,"office":"General Services Unit","profile_image":null},{"uid":"31","name":"Annalyn P. Flores","email":null,"designation":null,"office":null,"profile_image":null},{"uid":"32","name":"Anthony L. Sarino","email":null,"designation":null,"office":"Treasury Services Unit","profile_image":null},{"uid":"33","name":"Arlene A. Nadres","email":null,"designation":null,"office":"Knowledge Resources Unit","profile_image":null},{"uid":"34","name":"Arnel R. Oabina","email":null,"designation":null,"office":"Accounting Unit","profile_image":null},{"uid":"35","name":"Avril DG. Madrid","email":null,"designation":null,"office":"Knowledge Resources Unit","profile_image":null},{"uid":"36","name":"Bernisse Sabina R. Almazan","email":null,"designation":null,"office":null,"profile_image":null},{"uid":"37","name":"Bessie M. Burgos","email":null,"designation":null,"office":"Research and Development Department","profile_image":null},{"uid":"38","name":"Blessie P. Saez","email":null,"designation":null,"office":"Graduate Education and Institutional Development Department","profile_image":null}]}

		func();
		return staff_list;
	}

	function ajax_getScholarList(page=1,func){

		scholar_list={"current_page":1,"total_pages":75,"data":[{"uid":"1","full_name":"Chart Changmi-Ngam","nationality":"Thai","profile_image":""},{"uid":"2","full_name":"Pensook Ratisoontorn-Tauthong","nationality":"Thai","profile_image":""},{"uid":"3","full_name":"Ngamchuen Kaowichian-Ratanadilok","nationality":"Thai","profile_image":""},{"uid":"4","full_name":"Pairoj Juangbanich","nationality":"Thai","profile_image":""},{"uid":"5","full_name":"Yupa Vorayos","nationality":"Thai","profile_image":""},{"uid":"6","full_name":"Candido V. Rosario, Sr. (DECEASED)","nationality":"Filipino","profile_image":""},{"uid":"7","full_name":"Chya Suthiwanith","nationality":"Thai","profile_image":""},{"uid":"8","full_name":"Yuwat Vuthimedhi","nationality":"Thai","profile_image":""},{"uid":"9","full_name":"Bliss A. Aday","nationality":"Filipino","profile_image":""},{"uid":"10","full_name":"Paulina D. Pages","nationality":"Filipino","profile_image":""},{"uid":"11","full_name":"Honorato L. Angeles","nationality":"Filipino","profile_image":""},{"uid":"12","full_name":"Nguyen Tri Khiem","nationality":"Vietnamese","profile_image":""},{"uid":"13","full_name":"Adul Apinantara","nationality":"Thai","profile_image":""},{"uid":"14","full_name":"Truong Hoai Xuan","nationality":"Vietnamese","profile_image":""},{"uid":"15","full_name":"Romeo V. Saure","nationality":"Filipino","profile_image":""},{"uid":"16","full_name":"Pham Ngoc Hiep","nationality":"Vietnamese","profile_image":""},{"uid":"17","full_name":"Wipit Chaisrisongkram","nationality":"Thai","profile_image":""},{"uid":"18","full_name":"Ly Tung","nationality":"Vietnamese","profile_image":""},{"uid":"19","full_name":"Boonrawd Supa-Udomlerk (DECEASED)","nationality":"Thai","profile_image":""},{"uid":"20","full_name":"Manas Sanmaneechai","nationality":"Thai","profile_image":""}]}

		func();
		return scholar_list;

	}


	function showStaffList(){
		ajax_getStaffList(1,function(){

			var htm='';

			var staffList=staff_list.data

			for(var x=0;x<staffList.length;x++){

				htm+=`<div class="form-group"> <div class="col col-md-1">
	                        <input type="checkbox" name="staff" value="1" add-staff-passenger-trp="" data-json='`+JSON.stringify(staffList[x])+`' ng-if="selectedLists=='trp'" class="staffListCheckbox">
	                    </div>
	                    <div class="col col-md-11">
	                        <div class="col col-md-2">
	                        	<div class="profile-image profile-image-tr" display-image="1.jpg" data-mode="staff" style="background: url('/profiler/profile/`+staffList[x].profile_image+`') center center cover no-repeat;"></div>
	                        </div>`+staffList[x].name+`
	                    </div></div>`
				
			}

			$('.staff-list-directory').html(htm)

			setTimeout(function(){
				$('.staffListCheckbox').change(function(){
					if(this.checked){
						$(this).attr('disabled','disabled')
						$(this).parent().parent().css({'font-weight':'bold'})
						appendStaffToListPreview($(this).attr('data-json'))
					}
				})
			},800)

		})
		
	}


	function showScholarList(){
		ajax_getScholarList(1,function(){

			var htm='';

			var scholarList=scholar_list.data

			for(var x=0;x<scholarList.length;x++){

				htm+=`<div> <div class="col col-md-1">
	                        <input type="checkbox" name="staff" value="`+scholarList[x].uid+`"  data-json='`+JSON.stringify(scholarList[x])+`' class="scholarListCheckbox">
	                    </div>
	                    <div class="col col-md-11">
	                        <div class="col col-md-2">
	                        	<div class="profile-image profile-image-tr" display-image="1.jpg" data-mode="staff" style="background: url('/profiler/profile/`+scholarList[x].profile_image+`') center center cover no-repeat;"></div>
	                        </div>`+scholarList[x].full_name+`&emsp;<small><b>(`+scholarList[x].nationality+`)</b></small>
	                    </div></div>`
				
			}

			$('.scholar-list-directory').html(htm)

			setTimeout(function(){
				$('.scholarListCheckbox').change(function(){
					if(this.checked){
						$(this).attr('disabled','disabled')
						$(this).parent().parent().css({'font-weight':'bold'})
						appendScholarToListPreview($(this).attr('data-json'))
					}
				})
			},800)


		})
		
	}

	function appendStaffToListPreview(jsonData){
		var data=JSON.parse(jsonData)

		var htm=` <tr data-menu="staffPassengerMenu" context="0" data-selection="`+data.uid+`" id="official_travel_staff_passenger_tr`+data.uid+`" class="contextMenuSelector official_travel_staff_passenger_tr`+data.uid+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+data.profile_image+`" data-mode="staff"></div></div>
								<div class="col col-md-9"><b>`+data.name+`</b></div></td>

							
							<td>`+data.designation+`</td>
							<td>`+data.office+`</td>
						</tr>`
		$('.preview-passengers').append(htm)

		setTimeout(function(){ unbindContext(); context(); },1000);
	}

	function appendScholarToListPreview(jsonData){
		var data=JSON.parse(jsonData)

		var htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+data.id+`" id="official_travel_scholars_passenger_tr`+data.id+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+data.id+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+data.profile_image+`" data-mode="scholars"></div></div>
								<div class="col col-md-9"><b>`+data.full_name+`</b></div></td>

							
							<td>`+data.nationality+`</td>
							<td>N/A</td>
						</tr>`
		$('.preview-passengers').append(htm)

		setTimeout(function(){ unbindContext(); context(); },1000);
	}


	function appendCustomToListPreview(jsonData){
		var a={}
		a={id:1,full_name:'kenneth',designation:'director'}
		a.id=1;
		a.full_name='kenneth'
		a.designation="IT Director"
		var data=JSON.parse(JSON.stringify(jsonData))
		var htm=`<tr data-menu="customPassengerMenu" data-selection="`+data.id+ `" id="official_travel_custom_passenger_tr`+data.id+`" class="contextMenuSelector official_travel_custom_passenger_tr`+data.id+`">
							<td>
								<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="" data-mode="custom"></div></div>
								<div class="col col-md-9"><b>`+data.full_name+`</b></div></td>
							<td>`+data.designation+`</td>
							<td>N/A</td>
						</tr>`
		$('.preview-passengers').append(htm)

		setTimeout(function(){ unbindContext(); context(); },1000);
	}


	function appendCustomListPreviewConfirmation(){
		var htm=`<br/><br/><div class="col col-md-12"><h4>Are you sure you want to add this to the passenger list?</h4>
			<button class="btn btn-danger" id="customPassengerConfirmationButton"><span class="glyphicon glyphicon-ok"></span>&nbsp;Yes</button> <button class="btn btn-default" id="customPassengerConfirmationButtonCancel">No</button>
		</div>`


		var fullName=$('#customFullName').val();
		var designation=$('#customDesignation').val();

		if(fullName.length>0&&designation.length>0){
			$('#custom-dialog-content').hide();
			$('#custom-confirmation').html(htm)
		}


		$('#customPassengerConfirmationButton').click(function(){
			
			$(this).html('saving . . .')

			//insert to view
			var data={full_name:fullName,designation:designation,id:0}


			appendCustomToListPreview(data)

			//show form
			setTimeout(function(){

				$('#passenger-modal').modal('hide');
				//clear form
				$('#customFullName').val('')
				$('#customDesignation').val('')

				//display default view
				$('#custom-dialog-content').show();
				$('#custom-confirmation').html('')
			},1200)
		})

		//cancel
		$('#customPassengerConfirmationButtonCancel').click(function(){
			//show form
			setTimeout(function(){

				//display default view
				$('#custom-dialog-content').show();
				$('#custom-confirmation').html('')
			},1200)
		});
	}


	$(document).ready(function(){
		showStaffList();
		showScholarList();
	})
</script>

