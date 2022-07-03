<?php


$array["uploads"]			= "../uploads/";
$array["jpg"]					= "../uploads/jpg/";
$array["jpg300"]			= "../uploads/jpg/300/";
$array["jpg1280"]			= "../uploads/jpg/1280/";
$array["jpg500"]			= "../uploads/jpg/500/";
$array["jpgoriginal"]	= "../uploads/jpg/original/";
$array["png"]					= "../uploads/png/";
$array["pdf"]					= "../uploads/pdf/";
$array["mp4"]					= "../uploads/mp4/";

$uploadOk 					= 1;

$error[0] = "Arquivo muito grande";
$error[1] = "Seu arquivo não foi enviado";
$error[2] = "Ocorreu um erro no envio";

foreach ($array as $key => $value) {

	createDir($value);

}

if($type=='image/jpeg' or $type=='image/png'){
	
	$newfilename 				= md5(microtime()).".jpg";

	if ($size > 50000000) {
	
		echo $error[0];
		$uploadOk = 0;
	
	}
	
	$newnametarget_file 		= $array["jpgoriginal"].$newfilename;

	if ($uploadOk == 0){
		
   		echo $error[1];

	} else {

		if (move_uploaded_file($tmpname, $newnametarget_file)) {

			thumbnailjpg($array["jpgoriginal"],$newfilename,$array["jpg1280"],1280);
			thumbnailjpg($array["jpgoriginal"],$newfilename,$array["jpg500"],500);
			thumbnailjpg($array["jpgoriginal"],$newfilename,$array["jpg300"],300);
			//thumbnailjpg($array["jpgoriginal"],$newfilename,$array["jpgoriginal"],null);
			
			echo json_encode(array('url' => $newnametarget_file, 'ext' => 'jpg','filename' => $newfilename));

		} else {

			echo $error[2];

		}

	}

	
}elseif($type=='application/pdf'){
	
	$newfilename 				= md5(microtime());
	
	if ($size > 50000000) {
	
		echo $error[0];
		
		$uploadOk = 0;
	
	}
	
	$newnametarget_file 		= $array["pdf"].$newfilename.".pdf";

	if ($uploadOk == 0) {
		
		$error[1]="Seu arquivo não foi enviado";

	} else {

		if (move_uploaded_file($tmpname, $newnametarget_file)) {

			echo json_encode(array('url' => $newnametarget_file, 'ext' => 'pdf','filename' => $newfilename.".pdf"));

   //  if(file_put_contents($array["jpgoriginal"].$newfilename.".jpg", fopen("http://pdftojpg.tk/pdftojpg.php?file=".$newfilename, 'r'))){
 
        //require "../classes/pdf-to-image-master/Pdf.php";

        //$url=$array["pdf"].$newfilename.".pdf";
      
        //$pdf = new Spatie\PdfToImage\Pdf($url);
        //$pdf->setCompressionQuality(70);
        //$pdf->setPage(1)->saveImage($array["jpgoriginal"].$newfilename.".jpg");
      
        $image   = new Imagick();
        $image->readimage("https://albi.ga/src/pdftojpg.php?url=https://suite8.com.br/uploads/pdf/".$newfilename.".pdf"); 
        $image->writeImage($array["jpgoriginal"].$newfilename.".jpg");
      
        thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg300"],300);
        thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg500"],500);
        thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg1280"],1280);  
       
    //  }
      

      
			//$im = new imagick($newnametarget_file);
			//$im->setImageFormat('jpg');
			//file_put_contents($array["jpgoriginal"].$newfilename.".jpg", $im);
			
			//thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg300"],300);
      //thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg500"],500);
      //thumbnailjpg($array["jpgoriginal"],$newfilename.".jpg",$array["jpg1280"],1280);      
      
		} else {
			
			echo $error[2];
			
		}
	}
	
	
}elseif($type=='image/png'){
	
	$newfilename 				= md5(microtime()).".jpg";
	
	if ($size > 50000000) {
	
		echo $error[0];
		
		$uploadOk = 0;
	
	}
	
	$newnametarget_file 		= $array["png"].$newfilename;

	if ($uploadOk == 0) {
		
		$error[1]="Seu arquivo não foi enviado";

	} else {

		if (move_uploaded_file($tmpname, $newnametarget_file)) {
			
			thumbnailjpg($array["png"],$newfilename,$array["jpg1280"],1280);
			thumbnailjpg($array["png"],$newfilename,$array["jpg500"],500);
			thumbnailjpg($array["png"],$newfilename,$array["jpg300"],300);
			
			echo json_encode(array('url' => $newnametarget_file, 'ext' => 'jpg','filename' => $newfilename));

		} else {
			
			echo $error[2];
			
		}

	}	

}elseif($type=='video/mp4'){
	
	$newfilename 				= md5(microtime()).".mp4";
	
	if ($size > 500000000) {
	
		echo $error[0];
		
		$uploadOk = 0;
	
	}
	
	$newnametarget_file 		= $array["mp4"].$newfilename;

	if ($uploadOk == 0) {
		
		$error[1]="Seu arquivo não foi enviado";

	} else {

		if (move_uploaded_file($tmpname, $newnametarget_file)) {
			/*
			thumbnailjpg($array["png"],$newfilename,$array["jpg1280"],1280);
			thumbnailjpg($array["png"],$newfilename,$array["jpg500"],500);
			thumbnailjpg($array["png"],$newfilename,$array["jpg300"],300);
			*/
			echo json_encode(array('url' => $newnametarget_file, 'ext' => 'mp4','filename' => $newfilename));

		} else {
			
			echo $error[2];
			
		}

	}
}else{
	
	echo "error:".$type;
	
}

?>