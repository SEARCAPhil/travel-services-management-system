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
			if(data[x].status=='in_use') in_use_automobile++;
			if(data[x].status=='under_maintenance') under_maintenance_automobile++;
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

$(document).ready(function(){
	 $(".automobile-tab").on('click',function(){
	 	var target=$(this).attr('href');

	 	var panel=document.querySelector(target);
	 	previewLoadingEffect(panel)
	 	$(panel).load($(this).attr('data-page'),function(){
	 		previewLoadingEffectFade(panel)
	 	})

	 	
	 })


	 //preselect first child
	 $('.automobile-tab')[0].click()
})

