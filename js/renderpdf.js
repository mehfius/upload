    const renderpdf = async function (page){

      var viewport = page.getViewport({scale:1});
      // height of the page
      var height = viewport.height;

      // width of the page
      var width = viewport.width;
      
      document.querySelector('#pdf-canvas').height = viewport.height;
      document.querySelector('#pdf-canvas').width = viewport.width;

      // holds viewport properties where page will be rendered
      var render_context = {
          canvasContext: document.querySelector('#pdf-canvas').getContext('2d'),
          viewport: viewport
      };
      
      // wait for the page to render
      await page.render(render_context).promise;
      
      var img = await document.querySelector('#pdf-canvas').toDataURL("image/jpeg", 0.8);
    
      
      return create_blob(img);
      
    }