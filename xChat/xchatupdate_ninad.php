<?php

//  CONSIDER THIS SECURITY MEASURE ON WHERE THE
//  FILE CAN ONLY BE CALLED VIA AJAX AND FROM SPECIFIC LOCATIONS
//
// if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_REFERER']!="http://your-site.com/path/to/chat.js") {
//   die();
// }

?>


<?php

try {


	require_once 'xchat.php';
	$state = htmlentities(strip_tags($_GET['state']), ENT_QUOTES);
	//TODO - a different folder for all the chatroom file
	$file = htmlentities(strip_tags($_GET['file']), ENT_QUOTES);
	$domain = htmlentities(strip_tags($_GET['domain']), ENT_QUOTES);

	if($domain === "Home"){

		function getfile($f) {

			if (file_exists($f)) {
				$lines = file($f);
			}

			return $lines;

		}

		function getlines($fl){
			return count($fl);
		}

		//TODO can be reduced to 40 - 50 causes connection timeput some times
		$finish = time() + 40;
		$count = getlines(getfile($file));

		while ($count <= $state) {

			$now = time();
			//TODO can be reduced to 5000 - for more prompt message update
			usleep(5000);

			if ($now <= $finish) {
				$count = getlines(getfile($file));
			} else {
				break;
			}
			 
		}

		if ($state == $count) {

			$log['state'] = $state;
			$log['t'] = "continue";

		} else {

			$text= array();
			$log['state'] = $state + getlines(getfile($file)) - $state;

			foreach (getfile($file) as $line_num => $line) {
				if ($line_num >= $state) {
					$text[] =  $line = str_replace("\n", "", $line);
				}

				$log['text'] = $text;
			}
		}

		echo json_encode($log);
	}

	//for the xchat
	else{
		//TODO xChat()
		$xchatUpdate = new xChat($domain);
		$dataChatUpdate = $xchatUpdate->getChatUpdate($state, $file, $domain);

		echo $dataChatUpdate;//echo back to chat.js - the json encoded data coming from called function

	}


}
catch (Exception $ex){
	echo "Exception Message - ".$ex->getMessage();
}
?>