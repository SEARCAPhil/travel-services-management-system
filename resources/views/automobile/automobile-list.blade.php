{{csrf_field()}}
<p><a href="#"><div class="status-box status-box-sm gray">+</div>Vehicle</a></p>
<section class="automobile-list"></section>

<div class="backdrop">
		<div class="modalx">
			@includeif('layouts/automobile-preview')
		</div>
	</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/directory.js"></script>	
<script type="text/javascript">
var selectedAutomobile;
function modalOpen(target){
	selectedAutomobile=target;
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


$(document).ready(function(){

	




	ajax_getAutmobileList(1,function(json){

		var auto=JSON.parse(json);
		for(var x=0;x<auto.length;x++){
				console.log(auto[x].brand)
				var brand=auto[x].brand.length>1?auto[x].brand:'<br/>';
				var htm=`<div class="col col-md-3 col-sm-4 col-xs-6 " onclick="modalOpen(this)" data-content="`+auto[x].id+`"><div class="automobile-list-item">
				    					<img src="/laravel/public/uploads/automobile/`+auto[x].image+`" onerror="this.src='/laravel/public/img/no-photo-available.jpg'"/>
				    					<div class="col col-md-12">
				    						<h4 class="page-header">`+brand+`</h4>
				    						<p><div class="marker marker-danger">`+auto[x].id+`</div></p>`
				   if(auto[x].status=='in_use'){
				   	htm+=`<p><center class="text-muted"><b>Unavailable</b></ceter></p>`
				   }
				    						
				htm+=`
				    					</div></div>
				    				</div>`
				$('.automobile-list').append(htm)
			}
	});

	


})
</script>

