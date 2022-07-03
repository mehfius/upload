<?php

header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
/* header("Access-Control-Allow-Headers: Authorization, Content-Type");
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400'); */

error_reporting(E_ALL);

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
ini_set('memory_limit', '256M');

$hash = isset($_REQUEST["hash"])?$_REQUEST["hash"]:null;
$type = isset($_FILES["file"]["type"])?$_FILES["file"]["type"]:null;
$size = isset($_FILES["file"]["size"])?$_FILES["file"]["size"]:null;

require "file_permissions.php";

if($hash and in_array($type,$valid_types)){

  require "uuid.php";
  require "mkdir.php";
  
  $file      = $_FILES["file"]["tmp_name"];
  $save_file = 'files/'.$extension[$type].'/'.$hash.'/'.$filename.'.'.$extension[$type];
    
  $error["upload"] = move_uploaded_file($file,$save_file);
  
}else{
  
  $error["message"]   = "Formato não suportado";
  $error["hash"]      = $hash;
  $error["type"]      = $type;
  $error["size"]      = $size;

}

echo json_encode($error);

?>