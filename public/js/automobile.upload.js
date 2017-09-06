

/*-----------------------------------------------------
| Uploading Automobile's thumbnails
|------------------------------------------------------*/
function uploadAutomobileImage(file,id,callback){

  //XHR
  var http=new window.XMLHttpRequest();

  http.upload.addEventListener("progress", function(evt){

    var percentComplete=0;
    if (evt.lengthComputable) {
       percentComplete = (evt.loaded / evt.total)*100.0;
    
       // download progress
       $('.automobile-upload-progress').css({width:percentComplete+'%'});

       if(percentComplete>=100){ }

   }

 });


    
   http.addEventListener("load", function (evt) {
      if (http.status === 200) {
        callback(http.responseText)
      }else{}

  });

  http.open('POST','api/automobile/image/'+id);
  http.send(file);

}



/*-----------------------------------------------------
| Uploading Automobile's thumbnails [INPUT]
|------------------------------------------------------*/

$('#auto-mobile-fie-input').change(function(e){

  //Form data
  var form_data=new FormData();
  form_data.append('attachment',e.target.files[0]);
  form_data.append('_token',$('input[name=_token]').val())

  //Reader
  var reader=new FileReader();
  var whitelistFileExtension=Array('image/png','image/jpg','image/jpeg','image/gif');


  reader.onload=function(){

    //5 MiB[MAXIMUM FILE SIZE]
    var tresholdFileSize=5242880; 

    
    if(e.target.files[0].size>tresholdFileSize){
      
      $('.output').html('<span class="text-danger">Oops!Maximum of 5MiB only</span>');
       
    }else if(whitelistFileExtension.indexOf(e.target.files[0].type)=='-1'){

      $('.output').html('<span class="text-danger">Oops!Invalid File name or extension</span>');

    }else{

      $('.output').html(`<p class="text-left"><b>Uploading</b></p>
                        <div class="progress">
                          <div class="progress-bar automobile-upload-progress" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0.9%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>`)

        
       var id=($(selectedAutomobile).attr('data-content'))

       if(id.length>1){
          //start uploading
          uploadAutomobileImage(form_data,id,function(response){

            var response=JSON.parse(response);
            var data=response.result;

            if(data==1){
              $('.modal-body').css({background:'#4cc34c',color:'rgb(255,255,255)'});
              $('.upload-image-section').html('<div class="col col-md-12"><i class="material-icons md-18">check</i>Uploaded Succefully!</div>');

              //remove all items in the list
              $('.automobile-list').html('')

              //update list on the background
              showAutomobileList(1,function(){});

            }else{
              $('.output').html('ops!Something went wrong.Please try again later');
            }
          
            
          })
       }
        
    }

      
  }

  reader.readAsDataURL(e.target.files[0]);

})
