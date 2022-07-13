const openpdf = async function(url,directory,name) {
  
  var reader    = new FileReader();
    
    reader.onload = async function(e) {

      pdf_doc = await pdfjsLib.getDocument({ data: e.target.result }).promise;
      page    = await pdf_doc.getPage(1);

      
      var img = await renderpdf(page);
      
      var data = new FormData();
          data.append('directory',directory);
          data.append('filename',name);
          data.append('file', img);
        
          upload(data); 
      
    };
    
    reader.onerror = function(e) {
    
      console.log('Error : ' + e.type);
      
    };
    
  reader.readAsBinaryString(url);

}