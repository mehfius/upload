    const openpdf = async function(url) {
    var reader    = new FileReader();
      
    reader.onload = async function(e) {

      pdf_doc = await pdfjsLib.getDocument({ data: e.target.result }).promise;
      
      page = await pdf_doc.getPage(1);
      console.log(renderpdf(page));

    };
      
    reader.onerror = function(e) {
      // error occurred
      console.log('Error : ' + e.type);
    };
      
    reader.readAsBinaryString(url);
      
    }