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
	                <div class="col col-md-2 pull-right">/ <span class="list-total-pages-staff">0</span></div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control" ng-value="1" value="1" id="pagerPassenger"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find" id="searchInputPassenger"> </div>
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
	                <div class="col col-md-2 pull-right ng-binding">/ <span class="list-total-pages-scholar">0</span></div>
	                <div class="col col-md-4 pull-right text-right"><input type="number" class="form-control" value="1" id="pagerScholar"></div>
	                <div class="col col-md-2 pull-right text-right">Page : </div>
	                <div class="col col-md-3 pull-right text-right"><input type="text" class="form-control" placeholder="Find"  id="searchInputScholar"> </div>
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

	function ajax_getStaffList(page=1,callback){

		$.get('api/directory/staff/'+page,function(json){
			staff_list=JSON.parse(json)
			callback(staff_list);
			return staff_list;
		})
		
	}

	function ajax_searchStaffList(param,page=1,callback){

		$.get('api/directory/staff/search/'+param,function(json){
			staff_list=JSON.parse(json)
			callback(staff_list);
			return staff_list;
		})
		
	}

	function ajax_getScholarList(page=1,callback){

		$.get('api/directory/scholars/'+page,function(json){
			scholar_list=JSON.parse(json)
			callback(scholar_list);
			return scholar_list;
		})

	}

	function ajax_searchScholarList(param,page=1,callback){

		$.get('api/directory/scholars/search/'+param,function(json){
			scholar_list=JSON.parse(json)
			callback(scholar_list);
			return scholar_list;
		})

	}


	function showStaffList(page=1){
		//loading
		showLoading('.staff-list-directory','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

		ajax_getStaffList(page,function(){

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

			//show taff total pages
			$('.list-total-pages-staff').html(staff_list.total_pages)

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



	function searchStaffList(param,page=1){
		//loading
		showLoading('.staff-list-directory','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

		ajax_searchStaffList(param,page,function(){

			var htm='';

			var staffList=staff_list.data

			//loading
			showLoading('.staff-list-directory','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')

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

			//show taff total pages
			$('.list-total-pages-staff').html(staff_list.total_pages)

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


	function showScholarList(page=1){
		//loading
		showLoading('.scholar-list-directory','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		ajax_getScholarList(page,function(){

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
			//show scholar total pages
			$('.list-total-pages-scholar').html(scholar_list.total_pages)

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


	function searchScholarList(param,page=1){
		//loading
		showLoading('.scholar-list-directory','<div><img src="img/loading.png" class="loading-circle" style="width: 80px !important;" /></div>')
		ajax_searchScholarList(param,1,function(){

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

		//ajax here
		$.post('api/directory/staff',{id:$(selectedElement).attr('id'),_token:$('input[name=_token]').val(),uid:data.uid},function(res){

			if(res>0){

				var htm=` <tr data-menu="staffPassengerMenu" context="0" data-selection="`+res+`" id="official_travel_staff_passenger_tr`+res+`" class="contextMenuSelector official_travel_staff_passenger_tr`+res+`">
									<td>
										<div class="col col-md-3"><div class="profile-image profile-image-tr" display-image="`+data.profile_image+`" data-mode="staff"></div></div>
										<div class="col col-md-9"><b>`+data.name+`</b></div></td>

									
									<td>`+data.designation+`</td>
									<td>`+data.office+`</td>
								</tr>`
				$('.preview-passengers').append(htm)

				setTimeout(function(){ unbindContext(); context(); },1000);


			}
	
		})

		


	}

	function appendScholarToListPreview(jsonData){
		var data=JSON.parse(jsonData)

		var htm=`<tr data-menu="scholarPassengerMenu"  context="0" data-selection="`+data.uid+`" id="official_travel_scholars_passenger_tr`+data.uid+`" class="contextMenuSelector official_travel_scholars_passenger_tr`+data.uid+`">
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
		showStaffList(1);
		showScholarList(1);


		$('#pagerPassenger').on('change',function(){
			var input=$(this).val();
			if($(this).val()>staff_list.total_pages||$(this).val()<1){
				$(this).css({'background-color':'#a94442','color':'#fff'})
			}else{
				$(this).css({'background-color':'#fff','color':'#000'})
				//next page
				showStaffList(input);
			}


			
		})


		var timeOut;
		$('#searchInputPassenger').on('keyup',function(){
			var that=this
			clearTimeout(timeOut)
			timeOut=setTimeout(function(){
				//next page
				if($(that).val().length>1){
					searchStaffList($(that).val())
				}else{
					//show staff list if empty search input
					showStaffList(1);
				}
				
			},1000)
		
		})


		$('#searchInputScholar').on('keyup',function(){
			var that=this
			clearTimeout(timeOut)
			timeOut=setTimeout(function(){
				//next page
				if($(that).val().length>1){
					searchScholarList($(that).val())
				}else{
					//show staff list if empty search input
					showScholarList(1);
				}
				
			},1000)
		
		})


		$('#pagerScholar').on('change',function(){
			var input=$(this).val();
			if($(this).val()>scholar_list.total_pages||$(this).val()<1){
				$(this).css({'background-color':'#a94442','color':'#fff'})
			}else{
				$(this).css({'background-color':'#fff','color':'#000'})
				//next page
				showScholarList(input)
			}


			
		})


	})
</script>

