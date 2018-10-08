/*
* AUTOMOBILE SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
* 
*/	


var selectedAutomobile;
window.tsis={}



function modalOpen(target){
	selectedAutomobile=target;

	$('.modalx').load('automobile-preview/'+1,function(){
		//add menu event
		$('.vehicle-menu dd a').click(function(){
			$('.modal-subcontent').load($(this).attr('data-content'))
		})

		console.log($('#preview-vehicle-info').click())
	});
	$("body").css("overflow", "hidden");
	$('.backdrop').css({marginTop:0}).click(function(e){
		if(this==e.target){
			modalClose()
		}
	})

	return this;
}

function modalClose(){
	$('.backdrop').css({marginTop:'-200%'})
	$("body").css("overflow", "auto");
	return this;
}

function showAutomobileList(page=1,callback=function(){}){


	ajax_getAutmobileList(page,function(json){

		var auto=JSON.parse(json);
		var priv=(window.localStorage.getItem('role'));

		//$('.automobile-list').html('Loading . . .');

		for(var x=0;x<auto.length;x++){

				var automobile_json=JSON.stringify(auto[x]);

				console.log(auto[x].brand)
				var brand=auto[x].brand.length>1?auto[x].brand:'<br/>';
				var is_unavailable=auto[x].status=='in_use'||auto[x].status=='under_maintenance'?'active':'';
				var click_event_for_admin=priv=='admin'?'modalOpen(this)':'';


				var htm=`<div class="col col-md-4 col-sm-6 col-xs-12 col-lg-2 " onclick="`+click_event_for_admin+`" data-content="`+auto[x].id+`" data-json='`+automobile_json+`'>
							<div class="automobile-list-item" id="automobile-list-item-`+auto[x].id+`" style="box-shadow: 0px 0px 10px rgba(200,200,200,0.2);">
				    					<img src="uploads/automobile/`+auto[x].image+`" onerror="this.remove()"/>
				    					<div class="col col-md-12" style="background:rgba(200,200,200,0.1);border-top:1px solid rgba(200,200,200,0.2);">
				    						<h5 class="page-header">`+auto[x].brand+`</h5>
				    						<p><small><b>Plate No.</b> <span class="text-muted">`+auto[x].plate_no+`</span></small></p>

				    						<!--<p><div class="marker marker-danger `+is_unavailable+`">`+auto[x].plate_no+`</div></p>-->`

				   if(auto[x].status=='in_use'||auto[x].status=='under_maintenance'){
				   		htm+=`<p class="text-danger"><b>Unavailable</b></p>`
				   }
				    						
				htm+=`
				    					</div></div>
				    				</div>`
				$('.automobile-list').append(htm)
			}

			
	});

	callback()

}

function ajax_postAutomobile(brand,plate_number,color,callback){
	$.post('api/automobile',{brand:brand,plate_number:plate_number,color:color,_token: $("input[name=_token]").val()},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}


function bindAddAutomobile(){
	$('.vehicle').off('click');
	$('.vehicle').on('click',function(){
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','automobile/modal/automobile',function(){
			$('#add-button').click(function(){

				var brand=$('#automobile').val()
				var plate_number=$('#plate_number_input').val()
				var color=$('#color').val();


				var error=[];

				$('.automobile-brand-status').html('')
				$('.automobile-no-status').html('')


				if(validator.isEmpty(brand)){
					$('.automobile-brand-status').html('<div class="alert alert-danger">This field could not be empty!</div>')
					error.push('Brand');
				}

				
				if(validator.isEmpty(plate_number)){
					$('.automobile-no-status').html('<div class="alert alert-danger">Plate number could not be empty!</div>')
					error.push('Plate number');
				}

			
				



				if(brand.length>0&&plate_number.length>0&&error.length===0){

						ajax_postAutomobile(brand,plate_number,color,function(res){

							if(res>0&&res.length<50){

								$('.modal').modal('hide');


								//new item in list
								var data=`<div class="col col-md-3 col-sm-4 col-xs-6 " onclick="modalOpen(this)" data-content="`+plate_number+`" data-json="{id:`+plate_number+`,brand:`+brand+`,color:`+color+`,image:null}"><div class="automobile-list-item">
				    					<img src="/laravel/public/img/no-photo-available.jpg" onerror="this.src='/laravel/public/img/no-photo-available.jpg'">
				    					<div class="col col-md-12">
				    						<h4 class="page-header">`+brand+`</h4>

				    						<p></p><div class="marker marker-danger ">`+plate_number+`</div><p></p>
				    					</div></div>
				    				</div>`

								$('.automobile-list').append(data)

								//preselect automobile for uploading
								selectedAutomobile=data;
								window.tsis.selectedAutomobile=data

								//scroll to the last page then show upload cover dialog
								setTimeout(function(){
									 window.document.body.scrollTop=document.body.scrollHeight;
									 showBootstrapDialog('#preview-modal','#preview-modal-dialog','automobile/modal/automobile-image',function(){});
								},700);
								

								
								
							}else{
								alert('Oops something went wrong!Automobile plate number is not available or system is temporarily down.Try to refresh the page or try again later.')
							}

						})



				}

				
			})
		});
	})

}