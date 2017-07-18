
	<div class="col col-md-12 row">
		<h1 style="color:#ff9933">
			<span class="glyphicon glyphicon-menu-right"></span> 
			Information 
			<small style="position: relative;">
				<i class="material-icons dropdown-toggle mark-as-menu" data-type="personal" data-target=".mark-as-dropdownmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">expand_more</i> 


				<ul class="dropdown-menu marks-as-dropdownmenu" style="font-size: 12px;">
					<li class="info-menu" data-mark="details"><a href="#"><i class="material-icons md-18">mode_edit</i> Update details</a></li>
					<li class="info-menu" data-mark="image"><a href="#"><i class="material-icons md-18">add_a_photo</i> Change Image</a></li>
				</ul>
								 </small>
			
		</h1>

	</div>

	<div class="col col-md-12 row">
		<p>Plate number : <span id="plate_number" style="color:#ff9933"></span></p>

		<p>Brand/Make/Model : <span id="brand" style="color:#ff9933"></span></p>

		<p>Color : <input type="color" id="color" class="automobile-color" style="border:none !important;-webkit-appearance:none !important;" disabled="disabled"/></p>
	</div>


	<canvas id="myChart3" width="400" height="250"></canvas>
<script type="text/javascript" src="js/chart.info.js"></script>
<script>

function showAutomobileDetails(){
	
		showBootstrapDialog('#preview-modal','#preview-modal-dialog','automobile/modal/automobile',function(){
			var json=JSON.parse($(selectedAutomobile).attr('data-json'))
			
			$('#add-button').html('Update')
			$('#automobile').val(json.brand)
			$('#plate_number_input').val(json.id)
			$('#plate_number_input').attr('disabled','disabled')
			$('#color').val(json.color)

			//add click event to add button
			$('#add-button').click(function(){

				$.ajax({
					url:'api/automobile/'+plate_no,
					method:'PUT',
					data: { _token: $("input[name=_token]").val(),brand:$('#automobile').val(),color:$('#color').val(),plate_no:plate_no},
					success:function(data){
						if(data==1){
							
							$('#brand').html($('#automobile').val())
							$('.automobile-color').val($('#color').val())
				    		$('#preview-modal').modal('hide');

				    		//update list on the background
				    		showAutomobileList(1,function(){});

						}else{
							alert('Oops! Something went wrong.Try to refresh the page')
						}
					}
				})

			})

		});
	
}




$(document).ready(function(){

	for(var y=2015;y<2018;y++){
		show_automobileExpenses(plate_no,y);
	}

	$('.info-menu').click(function(){
		var mark=$(this).attr('data-mark');

		if(mark=='details'){
			showAutomobileDetails();
		}


		if(mark=='image'){
			showBootstrapDialog('#preview-modal','#preview-modal-dialog','automobile/modal/automobile-image',function(){

			});
		}
	});

})
</script>

