<?php


/* $list = array('upload_v1/files','upload_v1/files/mp4','upload_v1/files/pdf','upload_v1/files/avif','upload_v1/files/webm','upload_v1/files/'.$extension[$type].'/'.$hash); */


$list = array();

array_push($list, "files");
array_push($list, "files/mp4");
array_push($list, "files/pdf");
array_push($list, "files/avif");
array_push($list, "files/jpg");
array_push($list, "files/".$extension[$type]."/".$dire);

foreach ($list as $value) {

  if(!is_dir($value)){
    mkdir($value, 0777);
  }

}

?>