<section class="automobile-list"></section>
<div class="backdrop">
		<div class="modalx">
			@includeif('automobile.ledger')
		</div>
	</div>
<script type="text/javascript">
function modalOpen(){
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

	


	var auto=[{"id":"0EV-21859","brand":"Toyota Corolla GLI","color":"Gray","status":"in_use","image":null},{"id":"1598fd","brand":"Toyota Camry LE","color":"#004040","status":"available","image":"1598fd.png"},{"id":"4589df","brand":"","color":"#000000","status":"available","image":"4589df.png"},{"id":"abc1315","brand":"Honda CR-V","color":"black","status":"available","image":"abc1315.png"},{"id":"asd","brand":"","color":"","status":"available","image":null},{"id":"asdasd","brand":"","color":"","status":"available","image":null},{"id":"AXA 1341","brand":"Toyota Fortuner 4x2 SUV","color":"#ffdbb7","status":"available","image":"asdasdasdas.png"},{"id":"new","brand":"Toyota Wigo 13.0 GMT","color":"#ffffff","status":"available","image":"new.png"},{"id":"no plate 2","brand":"Toyota Innova 2.5J MT","color":"white","status":"available","image":"35603A.png"},{"id":"OEV-22436","brand":"Mitsubishi L300 cab","color":"#ff9900","status":"available","image":null},{"id":"OEV-24469","brand":"Toyota Hi-ACE Grandia GL 2.5 DSL 5s","color":"#f7f7f7","status":"available","image":"OEV-24469.png"},{"id":"OEV-24498","brand":"Toyota Hi-Lux J M\/T 4x2","color":"#ffffff","status":"available","image":"OEV-24498.jpg"},{"id":"OEV-26782","brand":"Honda Accord 3.5 S AT","color":"#000000","status":"available","image":"OEV-26782.png"},{"id":"OEV-28050","brand":"Hyundai Grand Starex GL","color":"#ffffff","status":"available","image":"OEV-28050.png"},{"id":"po435","brand":"","color":"#800000","status":"available","image":null},{"id":"RENT A CAR","brand":"RENT A CAR","color":"#000000","status":"available","image":"RENT A CAR.png"},{"id":"sdfsdf","brand":"","color":"#000000","status":"available","image":null},{"id":"TQE 247","brand":"SUZUKI multicab","color":"#ffffd7","status":"available","image":null}];

	for(var x=0;x<auto.length;x++){
		console.log(auto[x].brand)
		var brand=auto[x].brand.length>1?auto[x].brand:'<br/>';
		var htm=`<div class="col col-md-3 col-sm-4 col-xs-6 " onclick="modalOpen()"><div class="automobile-list-item">
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




})
</script>

