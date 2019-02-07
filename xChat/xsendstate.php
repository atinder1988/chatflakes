<?php 
//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_REFERER']!="http://localhost/workspace_eclipse/fChat/xChat/chat.js") {
//   die();
//}

?>

<?php

try {
	require_once 'xchat.php';
	$function = htmlentities(strip_tags($_POST['function']), ENT_QUOTES);
	//if getstate option, then message is empty...
	 
	$message = ( isset($_POST['message'] ) ? htmlentities(strip_tags($_POST['message']), ENT_QUOTES) : "");
	//TODO - a different folder for all the chatroom file
	$file = htmlentities(strip_tags($_POST['file']), ENT_QUOTES);

	//if getstate option, then no nickname is passed
	$nickname = ( isset($_POST['nickname'] ) ? htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES) : ""); // for send option
	$domain = htmlentities(strip_tags($_POST['domain']), ENT_QUOTES);

	if($domain==="Home"){

		$log = array();

		switch ($function) {

			case ('getState'):

				if (file_exists($file)) {
					$lines = file($file);
				}
				$log['state'] = count($lines);

				break;

			case ('send'):
				//$patterns = array("/:\)/", "/:D/", "/:p/", "/:P/", "/:\(/");
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
			  
			 break;
			  
		}

		echo json_encode($log);
	}
	//for the xChat
	else{
		
		//TODO xChat()
		$sendstate = new xChat($domain);

		$state = $sendstate->getSendState($function, $message, $file, $nickname, $domain);
		

		echo $state;//echo back to chat.js json encoded data - coming from the called domain
	}

}
catch (Exception $ex){
	echo "Exception Message - ".$ex->getMessage();
}

?>