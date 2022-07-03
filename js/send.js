const send = async function(e) {

  Object.entries(e.files).forEach(([key, value]) => {

      var type = value.type;
      var data = new FormData();
          data.append('hash','hash-hash-hash');
          data.append('file', value);
    
          upload(data);

          if(type=="application/pdf"){
            
              openpdf(value);
            
          }
    
          document.querySelector('#log').innerHTML = JSON.stringify(value.type);
    
  });
  
    
}