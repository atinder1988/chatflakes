<?php

try{

	//get the data from the POST request from calling domain
	$message = $_POST['message'];
	$file = $_POST['file'];
	$nickname = $_POST['nickname'];

	$file = "../xChat/".$file;
	$log = array();

	$patterns = array("/:\@/", "/:cool/","/:D/", "/:o/", "/:\(/", "/:\)/", "/:p/","/:P/", "/;\)/" );
	$replacements = array("<img src='smiles/angry.gif'/>", "<img src='smiles/cool.gif'/>", "<img src='smiles/biggrin.gif'/>", "<img src='smiles/ohmy.gif'/>", "<img src='smiles/sad.gif'/>", "<img src='smiles/smile.gif'/>", "<img src='smiles/tongue.gif'/>", "<img src='smiles/tongue.gif'/>", "<img src='smiles/wink.gif'/>");
		//$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$blankexp = "/^\n/";

	if (!preg_match($blankexp, $message)) {
		/*
		 if (preg_match($reg_exUrl, $message, $url)) {
		 $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
		 } */
		$message = preg_replace($patterns, $replacements, $message);

		fwrite(fopen($file, 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n");
	}
	$log['state'] = "sent"; 
	//$stateData = json_encode($log);//not encoded
	//$stateData = $log;//not encoded
	//echo $stateData;
}

catch (Exception $ex){
	echo $ex;
}



?>