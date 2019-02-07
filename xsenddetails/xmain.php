<?php

// THIS is the only page which will listen to the cross domain chat request
try {

	require_once '../includes/dbcon.php';
	require_once 'xsendusers.php';
	require_once 'xsendsendstate.php';
	require_once 'xsendchatupdate.php';

	/*required details
	 * getstate - sendstate.php
	 * send - sendstate.php
	 * number of users in a chat room to get the user list - users.php
	 *
	 *
	 */

	$details = $_POST['details'];

	function getRoomDetails(){
		$roomname = $_POST['roomname'];
		$returnData = array();
		$getRooms = "SELECT *
	  			           FROM chat_rooms
	  		             WHERE name = '$roomname'";

		$roomResults = mysql_query($getRooms);

		if (mysql_num_rows($roomResults) < 1) {
			$value = 0; // no rooms found
			echo json_encode($value);
			die();
		}

		//need to check for the file for the chat as well, wheather that exists or not?
		/*while ($rooms = mysql_fetch_array($roomResults)) {
		echo $rooms['file'];
		}*/

		//get it into the array
		$rooms = mysql_fetch_array($roomResults);
		$filename = $rooms['file'];

		//TODO - a different folder for all the chatroom file
		$checkFile = "../xChat/$filename";
		//if file not exist, then create one
		if(!file_exists($checkFile)){
			$file = fopen($checkFile, "x");
			fclose($file);
		}

		//encode it to the json
		echo json_encode($rooms);

	}

	function getUsersData(){

		$current = $_POST['current'];
		$room = $_POST['room'];
		$username = $_POST['username'];
		$userData = sendUserData($current, $room, $username);

		echo $userData; //this json encoded from the called function

	}

	function getSendState(){

		//get the data from the POST request from calling domain
		$function = $_POST['function'];
		$message = $_POST['message'];
		$file = $_POST['file'];
		$nickname = $_POST['nickname'];

		//call this function from xsendsendstate.php
		//TODO - a different folder for all the chatroom file
		$file = "../xChat/".$file;
		$log = array();

		switch ($function) {

			case ('getState'):

				if (file_exists($file)) {
					$lines = file($file);
				}
				$log['state'] = count($lines);

				break;

			case ('send'):

				//not required as this be passed in function argument from xmain.php
				//$nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
				$patterns = array("/:\)/", "/:D/", "/:p/", "/:P/", "/:\(/");
			 $replacements = array("<img src='smiles/smile.gif'/>", "<img src='smiles/bigsmile.png'/>", "<img src='smiles/tongue.png'/>", "<img src='smiles/tongue.png'/>", "<img src='smiles/sad.png'/>");
			 //$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			 $blankexp = "/^\n/";

			 //not required as this be passed in function argument from xmain.php
			 //$message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);

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

		$stateData = json_encode($log);


		//echo back to the calling domain with json encoded state data
		echo $stateData;

	}

	function getChatUpdate(){

		//get the data from the POST request from calling domain
		$state = $_POST['state'];
		$file = $_POST['file'];

		//get the json encoded data from this function
		$dataChatUpdate = sendChatUpdate($state, $file);

		//echo back to the calling domain with jsone encoded data
		echo $dataChatUpdate;

	}

	function getChatRooms(){

		$getRooms = "SELECT * FROM chat_rooms";
		$roomResults = mysql_query($getRooms);

		$rooms['roomlist'] = array();

		while($room = mysql_fetch_array($roomResults)){
			$rooms['roomlist'][] = $room['name'];
			//echo $room['name'];
		}

		echo json_encode($rooms);

	}

	switch ($details){

		case ('roomdetails'):
			//call the getRoomDetails function
			getRoomDetails();
			break;

			// for userlist in the chatroom
		case ('userdetails'):
			getUsersData();
			break;
			//for sendstate
		case ('sendstate'):
			getSendState();
			break;

		case ('chatupdate'):
			getChatUpdate();
			break;

		case ('getrooms'):
			getChatRooms();
			break;
	}
}
catch(Exception $ex){
	//throw $ex;
	echo "Exception Message - ".$ex->getMessage();
}
?>