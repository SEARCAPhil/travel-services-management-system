<div class="modal-content">
	<div class="modal-body">

		
		<h3>Charge</h3>
		<p>This will serve as a basis for the total computation for this travel.</p>
	
		<div class="col col-md-12"><hr/></div>
    	

		<div class="row">
			<div class="col col-md-12 driver-section">
				<form class="form">
        	

        
	    	<div class="form-group">
	    		
        		<label>Mileage In (Start km)</label>
        		<input type="text" placeholder="km" class="form-control" id="start-km">
        	</div>

        	<div class="form-group">
        		<label>Mileage Out (End km)</label>
        		<input type="text" placeholder="km" class="form-control" id="end-km">
        	</div>
        	


        	<div class="form-group">
        		<label>Vehicle/Gasoline Charge</label>
           		<select class="form-control" id="gasoline_charge">
				</select>
	    	</div>

        	<div class="form-group">
        		<label>Drivers Overtime Charge</label>
        		<select class="form-control"  id="drivers_charge"></select>
        	</div>

            <div class="form-group">
                <label>Drivers Appointment</label>
                <select class="form-control">
                   <option value="contracted">Contracted  </option>
                   <option value="emergency">Emergency</option>
                </select>
            </div>

        	
        </form>
			</div>
			<div class="col col-md-12">
					<button class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
					<button class="btn btn-success modal-submit pull-right"  data-dismiss="modal" aria-label="Proceed" style="margin-right:10px;">Proceed</button>
					
					<div style="clear: both"></div>
				
			</div>

	  	</div>

	</div>

</div>



<script type="text/javascript" src="js/itenerary.official.js"></script>
<script type="text/javascript">

    function ajax_getGasolineCharge(){
        $.get('api/travel/gc',function(data){
            var htm='';
            var gasoline_charge=JSON.parse(data)
         
            for(var x=0;x<gasoline_charge.length; x++){
                var gc=gasoline_charge[x].base!=null?gasoline_charge[x].base:'';
                htm+='<option value="'+gasoline_charge[x].id+'">'+gasoline_charge[x].destination+'&emsp;(BASE Km *'+gc+')</option>';
            }

            $('#gasoline_charge').html(htm)
        })
    }


    function ajax_getDriversCharge(){
        $.get('api/travel/dc',function(data){
            var htm='';
            var drivers_charge=JSON.parse(data)
         
            for(var x=0;x<drivers_charge.length; x++){

                htm+='<option value="'+drivers_charge[x].id+'">'+drivers_charge[x].days+'&emsp;(RATE *'+drivers_charge[x].rate+')</option>';
            }

            $('#drivers_charge').html(htm)
        })
    }

    function ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,callback){

        $.post('api/travel/official/charge/'+id,{id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val()},function(data){
                 callback(data)
        }).fail(function(){
            alert('Oops Something went wrong.Please try again later');
        })
    }


    ajax_getGasolineCharge()
    ajax_getDriversCharge()


    //bind submit
    $('.modal-submit').off('click');
    $('.modal-submit').on('click',function(e){
        var id=293;
        var mileage_in=10
        var mileage_out=20
        var gasoline_charge=10
        var drivers_charge=10
        var appointment='contractual'
       ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,function(data){
            //open print page
            window.open('dummy_page/travel/official/print/'+id);
       }) 
    });



</script>

