var total_automobile=0;
var in_use_automobile=0;
var under_maintenance_automobile=0;
var available_automobile=0;

function getautomobileStatus(callback){
	ajax_getAutmobileList(1,function(json){

		data=JSON.parse(json);
		total_automobile=data.length;
		in_use_automobile=0;
		under_maintenance_automobile=0;
		available_automobile=0;

		for(var x=0;x<data.length;x++){
			if(data[x].status=='in_use'||data[x].status=='under_maintenance') in_use_automobile++;
			//if(data[x].status=='under_maintenance') under_maintenance_automobile++;
			if(data[x].status=='available') available_automobile++;
		}

	
		callback(json)
	});
}


//global function
function previewLoadingEffect(){
	$('.preview-content').css({opacity:'0.3','user-select':'none'});
	$('.preview-content').append('<img src="img/loading.png" class="loading-circle" style="width: 80px !important;top:20%;" />');
}

function previewLoadingEffect(panel){
	$(panel).css({opacity:'0.3','user-select':'none'});
	$(panel).append('<img src="img/loading.png" class="loading-circle" style="width: 80px !important;top:50%;" />');
}

function previewLoadingEffectFade(panel){
	$(panel).css({opacity:'1','user-select':'auto'});
}





/*-------------------
| Main MENU
|
|--------------------*/
$(document).ready(function(){

	//move onclick event to callback
	//this will prevent loading of JSON first before the page loads
	//resulting to empty list
	$(".automobile-tab").each(function(index,el){
		var onclick=$(this).attr('onclick');
	 	$(this).attr('data-callback',onclick);
	 	$(this).removeAttr('onclick')
	})


	 $(".automobile-tab").on('click',function(){

	 	var target=$(this).attr('href');
	 	var panel=document.querySelector(target);

	 	$(this).removeAttr('onclick')

	 	//show loading effect
	 	previewLoadingEffect(panel)

	 	//callback
	 	var callback=$(this).attr('data-callback');

	
	 	$(panel).load($(this).attr('data-page'),function(){
	 		previewLoadingEffectFade(panel)
	 		
	 		//callback
	 		if(typeof callback!='undefined'&&window.trs[callback]){
	 			window.trs[callback]()
	 		}
	 		
	 		
	 	})

	 	
	 })


	 //preselect first child
	 $('.automobile-tab')[0].click()
})

