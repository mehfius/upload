const upload = async function(data,filename) {
  
  const url="https://php.mehfius.repl.co/upload_v1/";
  
  const rawResponse = await fetch(url, {method: 'POST',body:data});
  
  return post = await rawResponse.json();

}

const formFileToBinary = async function(e){

  for (const value of e.files) {

    const fileToBase64  = await fileToBase64(value);
    const base64toImg   = await base64toImg(fileToBase64);
    
    console.log(create_blob(base64toImg));
     
  }
  
}

const fileToBase64 = async (file) =>
  new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = () => resolve(reader.result)
    reader.onerror = (e) => reject(e)
  })

const base64toImg = async (file) =>
  
  new Promise((resolve, reject) => {
    
    const img = new Image();
          img.crossOrigin = "Anonymous";
          img.onload = () =>  resolve(stepped_scale(img));
          img.src = file;
   
  })



function stepped_scale(img) {

  var width = 900;
  var step  = "0.5"
  
  var canvas = document.createElement('canvas');
      ctx    = canvas.getContext("2d");
      oc     = document.createElement('canvas');
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

  return canvas.toDataURL("image/jpeg", 0.6);
  
}

function create_blob(dataURL) {
  var BASE64_MARKER = ';base64,';
  if (dataURL.indexOf(BASE64_MARKER) == -1) {
    var parts = dataURL.split(',');
    var contentType = parts[0].split(':')[1];
    var raw = decodeURIComponent(parts[1]);
    return new Blob([raw], { type: contentType });
  }
  var parts = dataURL.split(BASE64_MARKER);
  var contentType = parts[0].split(':')[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;

  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}