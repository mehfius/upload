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

$dire = isset($_REQUEST["directory"])?$_REQUEST["directory"]:null;
$type = isset($_FILES["file"]["type"])?$_FILES["file"]["type"]:null;
$size = isset($_FILES["file"]["size"])?$_FILES["file"]["size"]:null;
$name = isset($_REQUEST["filename"])?$_REQUEST["filename"]:null;

require "file_permissions.php";

if($dire and in_array($type,$valid_types)){


  require "mkdir.php";
  
  $file      = $_FILES["file"]["tmp_name"];
  $save_file = 'files/'.$extension[$type].'/'.$dire.'/'.$name.'.'.$extension[$type];
    
  $error["upload"] = move_uploaded_file($file,$save_file);
  
}else{
  
  $error["message"]   = "Formato não suportado";
  $error["hash"]      = $dire;
  $error["type"]      = $type;
  $error["size"]      = $size;

}

echo json_encode($error);

?>