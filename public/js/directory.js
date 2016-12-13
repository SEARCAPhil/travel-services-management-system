	
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

	
	function pagerPassenger(){

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

	}


	function searchInputPassenger(){

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
	}


	function searchInputScholar(){
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
	}

	function pagerScholar(){
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
	}

