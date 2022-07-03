<?php


/* $list = array('upload_v1/files','upload_v1/files/mp4','upload_v1/files/pdf','upload_v1/files/avif','upload_v1/files/webm','upload_v1/files/'.$extension[$type].'/'.$hash); */


$list = array();
array_push($list, "upload_v1/");
array_push($list, "upload_v1/files");
array_push($list, "upload_v1/files/mp4");
array_push($list, "upload_v1/files/pdf");
array_push($list, "upload_v1/files/avif");
array_push($list, "upload_v1/files/jpg");
array_push($list, "upload_v1/files/".$extension[$type]."/".$hash);

foreach ($list as $value) {
  echo $value."<br>";
  if(!is_dir($value)){
    mkdir($value, 0777);
  }

}

?>