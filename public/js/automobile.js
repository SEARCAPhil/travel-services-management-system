/*
* AUTOMOBILE SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
* 
*/	


var selectedAutomobile;


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

function showAutmobileList(page=1,callback=function(){}){


	ajax_getAutmobileList(page,function(json){

		var auto=JSON.parse(json);
		var priv=(window.localStorage.getItem('priv'));


		for(var x=0;x<auto.length;x++){

				var automobile_json=JSON.stringify(auto[x]);

				console.log(auto[x].brand)
				var brand=auto[x].brand.length>1?auto[x].brand:'<br/>';
				var is_unavailable=auto[x].status=='in_use'||auto[x].status=='under_maintenance'?'active':'';
				var click_event_for_admin=priv=='admin'?'modalOpen(this)':'';


				var htm=`<div class="col col-md-3 col-sm-4 col-xs-6 " onclick="`+click_event_for_admin+`" data-content="`+auto[x].id+`" data-json='`+automobile_json+`'><div class="automobile-list-item">
				    					<img src="/laravel/public/uploads/automobile/`+auto[x].image+`" onerror="this.src='/laravel/public/img/no-photo-available.jpg'"/>
				    					<div class="col col-md-12">
				    						<h4 class="page-header">`+brand+`</h4>

				    						<p><div class="marker marker-danger `+is_unavailable+`">`+auto[x].id+`</div></p>`

				   if(auto[x].status=='in_use'||auto[x].status=='under_maintenance'){
				   		htm+=`<p><center class="text-muted"><b>Unavailable</b></ceter></p>`
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
				var plate_number=$('#plate_number').val()
				var color=$('#color').val();


				if(brand.length>0&&plate_number.length>0){

						ajax_postAutomobile(brand,plate_number,color,function(res){

							if(res>0&&res.length<50){

								$('.modal').modal('hide');

								showAutmobileList(1,function(){
									setTimeout(function(){ window.document.body.scrollTop=document.body.scrollHeight; },700);
								});
								
							}else{
								alert('Oops something went wrong!Automobile plate number is not available or system is temporarily down.Try to refresh the page or try again later.')
							}

						})



				}

				
			})
		});
	})

}