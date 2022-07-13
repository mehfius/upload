/* const imageToBlobJPG = async function (page){

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
  
} */


  img = new Image();
  
  img.crossOrigin = "Anonymous";
  
  img.onload = function() {
    
    var width = 200;
    stepped_scale(img, width, 0.5)
    
  }
  
  img.src = "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/A_woman_with_red_hair.jpg/685px-A_woman_with_red_hair.jpg";



function stepped_scale(img, width, step) {


  
  var canvas = document.createElement('canvas'),
      ctx    = canvas.getContext("2d"),
      oc     = document.createElement('canvas'),
      octx   = oc.getContext('2d');

  // -- stepped scaling --
  var start = window.performance.now();

      canvas.width = width; // destination canvas size
      canvas.height = canvas.width * img.height / img.width;

  if (img.width * step > width) { // For performance avoid unnecessary drawing
    
      var mul = 1 / step;
      var cur = {width: Math.floor(img.width * step),height: Math.floor(img.height * step)}

          oc.width = cur.width;
          oc.height = cur.height;

          octx.drawImage(img, 0, 0, cur.width, cur.height);  
  
      while (cur.width * step > width) {
        cur = {width: Math.floor(cur.width * step),height: Math.floor(cur.height * step)};
        octx.drawImage(oc, 0, 0, cur.width * mul, cur.height * mul, 0, 0, cur.width, cur.height);
      }

    ctx.drawImage(oc, 0, 0, cur.width, cur.height, 0, 0, canvas.width, canvas.height);
    
  } else {
    
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    
  }


  
/*
  // -- display canvas used for scaling --
  document.getElementById("scale-canvas").src = oc.toDataURL(); */
console.log(canvas.toDataURL("image/jpeg", 0.8));

  
}