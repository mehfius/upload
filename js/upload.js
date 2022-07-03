    const upload = async function(data) {
      
      const url="https://php.mehfius.repl.co/upload_v1/";
      
      const rawResponse = await fetch(url, {
      
        method: 'POST',    
        body:data
      
      });
      
      return post = await rawResponse.json();
    
    }