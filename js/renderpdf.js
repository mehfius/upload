const renderpdf = async function (page){

  var canvas   = document.createElement('canvas');
  
  var viewport = page.getViewport({scale:1});
  var height   = viewport.height;
  var width    = viewport.width;

      canvas.height = viewport.height;
      canvas.width  = viewport.width;

  var render_context = {canvasContext: canvas.getContext('2d'),viewport: viewport};
  
  await page.render(render_context).promise;
  
  var img = await canvas.toDataURL("image/jpeg", 0.8);
  
  return create_blob(img);
  
}