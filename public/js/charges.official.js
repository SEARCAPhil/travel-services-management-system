
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







function ajax_getChargesOfficial(id,callback){
        
  $.get('api/travel/official/charges/'+id,function(data){
    callback(data)
  })      
}

function ajax_getChargesPersonal(id,callback){
        
  $.get('api/travel/personal/charges/'+id,function(data){
    callback(data)
  })      
}


function ajax_getChargesCampus(id,callback){
        
  $.get('api/travel/campus/charges/'+id,function(data){
    callback(data)
  })      
}



function ajax_getAdvanceChargesOfficial(id,callback){
        
  $.get('api/travel/official/charge/advance/'+id,function(data){
    callback(data)
  })      
}

function ajax_getAdvanceChargesPersonal(id,callback){
        
  $.get('api/travel/personal/charge/advance/'+id,function(data){
    callback(data)
  })      
}


function ajax_getAdvanceChargesCampus(id,callback){
        
  $.get('api/travel/campus/charge/advance/'+id,function(data){
    callback(data)
  })      
}




function ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){
    $.post('api/travel/official/charge/'+id,{id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}


function ajax_postChargePersonal(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){

    $.post('api/travel/personal/charge/'+id,{id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}

function ajax_postChargeCampus(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){

    $.post('api/travel/campus/charge/'+id,{id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}




function ajax_postAdvanceCharge(id,gasoline_charge,drivers_charge,additional_charge,notes,callback){
    $.post('api/travel/official/charge/advance/'+id,{id:id,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,additional_charge:additional_charge,notes:notes,_token: $("input[name=_token]").val()},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}

function ajax_postAdvanceChargePersonal(id,gasoline_charge,drivers_charge,additional_charge,notes,callback){
    $.post('api/travel/personal/charge/advance/'+id,{id:id,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,additional_charge:additional_charge,notes:notes,_token: $("input[name=_token]").val()},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}


function ajax_postAdvanceChargeCampus(id,gasoline_charge,drivers_charge,additional_charge,notes,callback){
    $.post('api/travel/campus/charge/advance/'+id,{id:id,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,additional_charge:additional_charge,notes:notes,_token: $("input[name=_token]").val()},function(data){
             callback(data)
    }).fail(function(){
        alert('Oops Something went wrong.Please try again later');
    })
}





function ajax_putCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){

    var obj={id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time}
    
    $.ajax({
        url: 'api/travel/official/charges/'+id,
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



function ajax_putChargePersonal(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){

    var obj={id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time}
    
    $.ajax({
        url: 'api/travel/personal/charges/'+id,
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


function ajax_putChargeCampus(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,callback){

    var obj={id:id,in:mileage_in,out:mileage_out,gasoline_charge:gasoline_charge,drivers_charge:drivers_charge,appointment:appointment,_token: $("input[name=_token]").val(),departure_date:departure_date,departure_time:departure_time,arrival_date:arrival_date,arrival_time:arrival_time}
    
    $.ajax({
        url: 'api/travel/campus/charges/'+id,
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


function showCharges(data){

    $('#start_km').val(data[0].start)
    $('#end_km').val(data[0].end)

    if(typeof data[0].start!='undefined'){
        $('#action').val(data[0].id)
    }


    //gasoline
    var gasoline_charge=data[0].gc
    var gasoline_charge_select=document.getElementById('gasoline_charge');

    setTimeout(function(){
        for(var x=0;x<gasoline_charge_select.options.length;x++){
            if(gasoline_charge_select.options[x].value==gasoline_charge){
                gasoline_charge_select.options[x].setAttribute('selected','selected')
            }
        }
    },800)

    //driver
    var driver_charge=data[0].dc
    var driver_charge_select=document.getElementById('drivers_charge');

    setTimeout(function(){
        for(var y=0;y<driver_charge_select.options.length;y++){
            if(driver_charge_select.options[y].value==driver_charge){
                driver_charge_select.options[y].setAttribute('selected','selected')
            }
        }
    },800)
    

    //appointment
    var appointment=data[0].appointment
    var appointment_select=document.getElementById('appointment'); 

    setTimeout(function(){
        for(var y=0;y<appointment_select.options.length;y++){
            if(appointment_select.options[y].value==appointment){
                appointment_select.options[y].setAttribute('selected','selected')
            }
        }
    },800)

                
            
}





function showChargesOfficial(id){
    ajax_getChargesOfficial(id,function(json){
        var data=JSON.parse(json);
        showCharges(data)
    })
}

function showChargesPersonal(id){
    ajax_getChargesPersonal(id,function(json){
        var data=JSON.parse(json);
        showCharges(data)
    })
}

function showChargesCampus(id){
    ajax_getChargesCampus(id,function(json){
        var data=JSON.parse(json);
        showCharges(data)
    })
}



function showAdvanceChargesOfficial(id){
    ajax_getAdvanceChargesOfficial(id,function(json){
        var data=JSON.parse(json);

        if(typeof data[0].gasoline_charge!='undefined') $('#gasoline_charge').val(data[0].gasoline_charge)
        if(typeof data[0].additional_charge!='undefined') $('#additional_charge').val(data[0].additional_charge)
        if(typeof data[0].drivers_charge!='undefined') $('#drivers_charge').val(data[0].drivers_charge)
        if(typeof data[0].notes!='undefined') $('#notes').html(data[0].notes)
    

        
    })
}


function showAdvanceChargesPersonal(id){
    ajax_getAdvanceChargesPersonal(id,function(json){
        var data=JSON.parse(json);

        if(typeof data[0].gasoline_charge!='undefined') $('#gasoline_charge').val(data[0].gasoline_charge)
        if(typeof data[0].additional_charge!='undefined') $('#additional_charge').val(data[0].additional_charge)
        if(typeof data[0].drivers_charge!='undefined') $('#drivers_charge').val(data[0].drivers_charge)
        if(typeof data[0].notes!='undefined') $('#notes').html(data[0].notes)
    

        
    })
}

function showAdvanceChargesCampus(id){
    ajax_getAdvanceChargesCampus(id,function(json){
        var data=JSON.parse(json);

        if(typeof data[0].gasoline_charge!='undefined') $('#gasoline_charge').val(data[0].gasoline_charge)
        if(typeof data[0].additional_charge!='undefined') $('#additional_charge').val(data[0].additional_charge)
        if(typeof data[0].drivers_charge!='undefined') $('#drivers_charge').val(data[0].drivers_charge)
        if(typeof data[0].notes!='undefined') $('#notes').html(data[0].notes)
    

        
    })
}


function showAdvanceGasolineCharge(){
    var content=$(selectedTrips).attr('data-content');
    var json=JSON.parse(content);
    var id=json.id;
    var type=json.type; 

    

    if(type=='official'){
        showAdvanceChargesOfficial(id)
    }

    if(type=='personal'){
        showAdvanceChargesPersonal(id)
    }

    if(type=='campus'){
        showAdvanceChargesCampus(id)
    }
    
}

function gasolineCharge(){

    var content=$(selectedTrips).attr('data-content');
    var json=JSON.parse(content);
    var id=json.id;
    var type=json.type;


    bindGasolineCharge(type)

    ajax_getGasolineCharge()
    ajax_getDriversCharge()

    if(type=='official'){
        showChargesOfficial(id)
    }

    if(type=='personal'){
        showChargesPersonal(id)
    }

    if(type=='campus'){
        showChargesCampus(id)
    }


}


function advanceGasolineCharge(type){

    var content=$(selectedTrips).attr('data-content');
    var json=JSON.parse(content);
    var id=json.id;
    var type=json.type;

  
    bindAdvanceGasolineCharge(type)
    


}

function changeTimeDetails(id,departure_time,returned_date,returned_time){
    $('.travel-other-details-returned-date-'+id).html(returned_date)
    $('.travel-other-details-returned-time-'+id).html(returned_time)
    $('.travel-other-details-departure-time-'+id).html(departure_time)
}


function bindGasolineCharge(type){
    
    //bind submit
    $('.modal-submit').off('click');
    $('.modal-submit').on('click',function(e){
        
        if(confirm('Are you sure you wanto tocontinue?')){
            var gasoline_charge=($('#gasoline_charge').val());
                  

            var content=$(selectedTrips).attr('data-content');
            var json=JSON.parse(content);
            var id=json.id;
            var type=json.type;
            var mileage_in=$('#start_km').val()
            var mileage_out=$('#end_km').val()
            var gasoline_charge=$('#gasoline_charge').val()
            var drivers_charge=$('#drivers_charge').val()
            var appointment=$('#appointment').val()

            //includes date and time settings

            var departure_date=$('#departure-date-input').val();
            var departure_time=$('#departure-time-input').val();

            var arrival_date=$('#arrival-date-input').val();
            var arrival_time=$('#arrival-time-input').val();

            var action=$('#action').val()


            if(action!=''&&action>0){

                if(type=='official'){  
                    //insert
                    ajax_putCharge(action,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                       window.open('travel/official/print/trip_ticket/'+id);
                       changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                       //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }


                if(type=='personal'){  
                    //insert
                    ajax_putChargePersonal(action,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                       window.open('travel/personal/print/statement_of_account/'+id);
                       changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                       //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }



                if(type=='campus'){  
                    //insert
                    ajax_putChargeCampus(action,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                       window.open('travel/campus/print/notice_of_charges/'+id);
                       changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                       //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }

                 
            }else{


                if(type=='official'){
                    ajax_postCharge(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                       window.open('travel/official/print/trip_ticket/'+id);
                       changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                       //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }

                if(type=='personal'){
                    ajax_postChargePersonal(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                        window.open('travel/personal/print/statement_of_account/'+id);
                        changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                        //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }


                if(type=='campus'){
                    ajax_postChargeCampus(id,mileage_in,mileage_out,gasoline_charge,drivers_charge,appointment,departure_date,departure_time,arrival_date,arrival_time,function(data){
                        //open print page
                       window.open('travel/campus/print/notice_of_charges/'+id);
                       changeTimeDetails(id,departure_time,arrival_date,arrival_time)
                       //prevent from values not changing due to ajax caching
                       changeDateAndTimeSettings()
                     })
                }

            }
        }
    });
}


function bindAdvanceGasolineCharge(type){
  
    //bind submit
    $('.modal-submit').off('click');
    $('.modal-submit').on('click',function(e){
      
        
        if(confirm('Are you sure you wanto to overide the default computation?')){       

            var content=$(selectedTrips).attr('data-content');
            var json=JSON.parse(content);
            var id=json.id;
            var type=json.type
            var gasoline_charge=$('#gasoline_charge').val()
            var drivers_charge=$('#drivers_charge').val()
            var additional_charge=$('#additional_charge').val()
            var notes=$('#notes').val()

            console.log(type)

            if(type=='official'){
                ajax_postAdvanceCharge(id,gasoline_charge,drivers_charge,additional_charge,notes,function(){
                     window.open('travel/official/print/trip_ticket/'+id);
                });
            }

            if(type=='personal'){
                ajax_postAdvanceChargePersonal(id,gasoline_charge,drivers_charge,additional_charge,notes,function(){
                     window.open('travel/personal/print/statement_of_account/'+id);
                });
            }

            if(type=='campus'){
                ajax_postAdvanceChargeCampus(id,gasoline_charge,drivers_charge,additional_charge,notes,function(){
                    window.open('travel/campus/print/notice_of_charges/'+id);
                });
            }
        }
        
    });
}