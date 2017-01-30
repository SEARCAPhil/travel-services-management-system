	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span> Maintenance</h1>
		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/repair"><span class="glyphicon glyphicon-wrench"></span> Repair</span></p>

		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/oil" id="changeOilButton" oil-dialog=""><span class="glyphicon glyphicon-oil"></span> Change Oil Schedule/Due Date</span></p>

		<p><span class="btn btn-primary ajaxload" data-toggle="modal" data-target="#info-modal" data-section="#info-modal-dialog" data-content="automobile/modal/replace" replace-dialog=""><span class="glyphicon glyphicon-wrench"></span> Replace parts</span></p>
	</div>
<script type="text/javascript">

function ajax_postReplaceParts(item,details,amount,receipt,supplier,plate_no,callback){
	$.post('automobile/replace/'+plate_no,{_token:$('input[name=_token]').val(),item:item,details:details,amount:amount,receipt:receipt,supplier:supplier,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}
	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}


function ajax_postRepairParts(item,details,amount,receipt,supplier,plate_no,callback){
	$.post('automobile/repair/'+plate_no,{_token:$('input[name=_token]').val(),item:item,details:details,amount:amount,receipt:receipt,supplier:supplier,plate_no:plate_no},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}


	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}


function ajax_postOil(oil,amount,receipt,station,mileage,plate_no,callback){
	$.post('automobile/oil/'+plate_no,{_token:$('input[name=_token]').val(),oil:oil,amount:amount,receipt:receipt,station:station,plate_no:plate_no,mileage:mileage},function(data){
					
		if(data>0&&data.length<50){
			callback(data)
		}else{
			alert('Something went wrog.Please try again later')
		}

	}).fail(function(){
		alert('Something went wrog.Please try again later')
	})
}

function formCompleted(){
	$('#form').hide();
	var htm=`<center>
				<div style="width:60px;height:60px;background:rgb(0,200,150);color:rgb(255,255,255);border-radius:50%;text-align:center;overflow:hidden;font-size:3em;" class="text-success"><span class="glyphicon glyphicon-ok"></span></div>
				<h3 class="text-success">Added Succefully!</h3>
				<button class="btn btn-success" id="add-more">Add more + </button>
			</center>`;
	$('#form-status').html(htm)

	$('#add-more').click(function(){
		$('#form')[0].reset();
		$('#form-status').html(' ');
		$('#form').slideDown();

	})
}


$(document).ready(function(){
	unbindAjaxLoad();
	ajaxLoad(function(content){

		//replace
		if(content=='automobile/modal/replace'){
			$('#add-button').on('click',function(){
				var item=$('#item').val();
				var details=$('#details').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var supplier=$('#supplier').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))

				ajax_postReplaceParts(item,details,amount,receipt,supplier,plate_no,function(){
					formCompleted()
				})

			})
		}


		//repair
		if(content=='automobile/modal/repair'){
			$('#add-button').on('click',function(){
				var item=$('#item').val();
				var details=$('#details').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var supplier=$('#supplier').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))

				ajax_postRepairParts(item,details,amount,receipt,supplier,plate_no,function(){
					formCompleted()
				})

			})
		}


		//oil
		if(content=='automobile/modal/oil'){
			$('#add-button').on('click',function(){
				var oil=$('#oil').val();
				var amount=$('#amount').val();
				var receipt=$('#receipt_number').val();
				var station=$('#station').val();
				var mileage=$('#mileage').val();
				var plate_no=($(selectedAutomobile).attr('data-content'))

				ajax_postOil(oil,amount,receipt,station,mileage,plate_no,function(){
					formCompleted()
				})

			})
		}


	});
})
</script>