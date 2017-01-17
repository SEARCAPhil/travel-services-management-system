
/**
* CHARGE SCRIPT
* Kenneth Abella <johnkennethgibasabella@gmail.com>
*
*
*/  


var charge={}


function ajax_getGasolineCharge(){
    $.get('api/travel/gc',function(data){
        
        var gasoline_charge=JSON.parse(data)
     
        for(var x=0;x<gasoline_charge.length; x++){
            var gc=gasoline_charge[x].base!=null?gasoline_charge[x].base:'';

           $('#gasoline_charge').append('<option value="'+gasoline_charge[x].id+'">'+gasoline_charge[x].destination+'&emsp;(BASE Km *'+gc+')</option>');
        }

        
    })
}






function ajax_getDriversCharge(){
    $.get('api/travel/dc',function(data){
      
        var drivers_charge=JSON.parse(data)
     
        for(var x=0;x<drivers_charge.length; x++){

           $('#drivers_charge').append('<option value="'+drivers_charge[x].id+'">'+drivers_charge[x].days+'&emsp;(RATE *'+drivers_charge[x].rate+')</option>');
        }

       
    })
}




function ajax_getCharge(id,callback){
        
  $.get('api/travel/official/verified/charges/'+id,function(data){
    callback(data)
  })      
}





function ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,callback){

    $.post('api/travel/official/charge/'+id,{id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val()},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}







function ajax_putCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,callback){

    var obj={id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment, _token: $("input[name=_token]").val()}
    
    $.ajax({
        url: 'api/travel/official/verified/charges/'+id,
        method:'PUT',
        data:obj,
        success:function(data){
            if(data==1){
                callback(data)
            }else{
               alert('Oops Something went wrong.Please try again later');   
            }
        },
        error:function(){
            alert('Oops Something went wrong.Please try again later'); 
        }
    })

   
}


function gasolineCharge(){
    var content=$(selectedTrips).attr('data-content');
    var json=JSON.parse(content);
    var id=json.id;


    bindGasolineCharge()

    ajax_getGasolineCharge()
    ajax_getDriversCharge()

        ajax_getCharge(id,function(json){
            var data=JSON.parse(json);
            
            $('#start_km').val(data[0].start)
            $('#end_km').val(data[0].end)

            if(typeof data[0].start!='undefined'){
                $('#action').val(data[0].id)
            }

            
            //gasoline
            var gasoline_charge=data[0].gasoline_charge
            var gasoline_charge_select=document.getElementById('gasoline_charge');

            setTimeout(function(){
                for(var x=0;x<gasoline_charge_select.options.length;x++){
                    if(gasoline_charge_select.options[x].value==gasoline_charge){
                        gasoline_charge_select.options[x].setAttribute('selected','selected')
                    }
                }
            },800)

            //driver

            var driver_charge=data[0].drivers_charge
            var driver_charge_select=document.getElementById('drivers_charge');

            setTimeout(function(){
                for(var y=0;y<driver_charge_select.options.length;y++){
                    if(driver_charge_select.options[y].value==driver_charge){
                        driver_charge_select.options[y].setAttribute('selected','selected')
                    }
                }
            },800)
                
                
            
        })


        




}






function bindGasolineCharge(){
    
    //bind submit
    $('.modal-submit').off('click');
    $('.modal-submit').on('click',function(e){
      
    var gasoline_charge=($('#gasoline_charge').val());
          

    var content=$(selectedTrips).attr('data-content');
        var json=JSON.parse(content);
        var id=json.id;
        var mileage_in=$('#start_km').val()
        var mileage_out=$('#end_km').val()
        var gasoline_charge=$('#gasoline_charge').val()
        var drivers_charge=$('#drivers_charge').val()
        var appointment=$('#appointment').val()

        var action=$('#action').val()


      if(action!=''&&action>0){
        //insert
         ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,function(data){
            //open print page
           window.open('travel/official/print/'+id);
         }) 
      }else{
        ajax_putCharge(action,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,function(data){
            //open print page
           window.open('travel/official/print/'+id);
         }) 
      }

       
    });

}