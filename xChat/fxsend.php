<?php

try {
	require_once 'xchat.php';
//time start -----------------
$time = explode(' ', microtime());
$time = $time[1] + $time[0]; // return array
$begintime = $time; //define begin time
//---------------------------		 
	$message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);
	$file = htmlentities(strip_tags($_POST['file']), ENT_QUOTES);
	$nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
	$fdomain = htmlentities(strip_tags($_POST['fdomain']), ENT_QUOTES); //this is fast xchat send

			//prepare the post data
			$post_data = array (
			"message"=>$message,
			"file"=>$file,
			"nickname"=>$nickname
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $fdomain);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$outputSend = curl_exec($ch);

			curl_close($ch);

// time finish -----------------------------
$time = explode(" ", microtime());
$time = $time[1] + $time[0];
$endtime = $time; //define end time
$totaltime = ($endtime - $begintime); //decrease to get total time
//--------------------------------------------			
			//$outputSend['ttime'] = $endtime;//$totaltime;
			echo $outputSend; //json encoded here instead of @fxsendsend
			
}
catch (Exception $ex){
	echo "Exception Message - ".$ex->getMessage();
}

?>