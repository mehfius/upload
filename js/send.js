const send = async function(e) {

  var directory = 'hash-hash-hash';
  
       Object.entries(e.files).forEach(([key, value]) => {

      var type = value.type;
      var name = uuidv4();
      var data = new FormData();
          data.append('directory',directory);
          data.append('filename',name);
          data.append('file', value);
    
          switch(value.type) {
              
            case "application/pdf":
              
              upload(data);
              openpdf(value,directory,name);
              
              break;
              
            case "image/jpeg":

              var img = imageToBlobJPG(value);
              console.log(img);
              
              break;
          
          }


            
            
     /*          var data = new FormData();
                  data.append('directory',directory);
                  data.append('filename',name);
                  data.append('file', value);
            
                  upload(data); */
            
     
    
          document.querySelector('#log').innerHTML = JSON.stringify(value.type);
    
  });
  
    
}