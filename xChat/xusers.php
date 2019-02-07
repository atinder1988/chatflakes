<?php 
//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_REFERER']!="http://localhost/workspace_eclipse/fChat/xChat/chat.js") {
//   die();
//}
?>

<?php
/*
 Author: Kenrick Beckett
 Author URL: http://kenrickbeckett.com
 Name: Chat Engine 2.0

 */

try {



	//TODO ../- this works fine
	require_once("../includes/dbcon.php");
	require_once 'xchat.php';

	//get all the required data
	$domain = htmlentities(strip_tags($_GET['domain']), ENT_QUOTES);		//required for xchat
	$current = htmlentities(strip_tags($_GET['current']), ENT_QUOTES);;//$_GET['current'];
	$room = htmlentities(strip_tags($_GET['room']), ENT_QUOTES);;//$_GET['room'];
	$username = htmlentities(strip_tags($_GET['username']), ENT_QUOTES);;//$_GET['username'];

	if($domain === "Home"){
		//Start Array
		$data = array();
		// Get data to work with

		$now = time();
		// INSERT your data (if is not already there)
		$findUser = "SELECT * FROM `chat_users_rooms` WHERE `username` = '$username' AND `room` ='$room' ";

		if(!hasData($findUser))
		{
			$insertUser = "INSERT INTO `chat_users_rooms` (`id`, `username`, `room`, `mod_time`) VALUES ( NULL , '$username', '$room', '$now')";
			mysql_query($insertUser) or die(mysql_error());
		}
		$findUser2 = "SELECT * FROM `chat_users` WHERE `username` = '$username'";
		if(!hasData($findUser2))
		{
			$insertUser2 = "INSERT INTO `chat_users` (`id` ,`username` , `status` ,`time_mod`)
					VALUES (NULL , '$username', '1', '$now')";
			mysql_query($insertUser2);
			$data['check'] = 'true';
		}
		$finish = time() + 7;
		$getRoomUsers = mysql_query("SELECT * FROM `chat_users_rooms` WHERE `room` = '$room'");
		$check = mysql_num_rows($getRoomUsers);
		 
		//it checks for users, every 10ms for seven seconds(finish = time() + 7)
		//control will be in this function tille 7 seconds, unless some chage occurs
		while(true)
		{
			usleep(10000);
			//TODO removes this query, cause we don want to touch chat_users table
			//mysql_query("UPDATE `chat_users` SET `time_mod` = '$now' WHERE `username` = '$username'");
			
			//TODO changed from 5 to 7, for more stable users list
			$olduser = time() - 8;
			//$eraseuser = time() - 30;
			mysql_query("DELETE FROM `chat_users_rooms` WHERE `mod_time` <  '$olduser'");
			//mysql_query("DELETE FROM `chat_users` WHERE `time_mod` <  '$eraseuser'");
			$check = mysql_num_rows(mysql_query("SELECT * FROM `chat_users_rooms` WHERE `room` = '$room' "));
			$now = time();
			if($now <= $finish)
			{
				mysql_query("UPDATE `chat_users_rooms` SET `mod_time` = '$now' WHERE `username` = '$username' AND `room` ='$room'  LIMIT 1") ;
				if($check != $current){
				 break;
				}
			}
			else
			{
				break;
			}
		}
		// Get People in chat
		if(mysql_num_rows($getRoomUsers) != $current)
		{
			$data['numOfUsers'] = mysql_num_rows($getRoomUsers);
			// Get the user list (Finally!!!)
			$data['userlist'] = array();
			while($user = mysql_fetch_array($getRoomUsers))
			{
				$data['userlist'][] = $user['username'];
			}
			$data['userlist'] = array_reverse($data['userlist']);
		}
		else
		{
			$data['numOfUsers'] = $current;
			while($user = mysql_fetch_array($getRoomUsers))
			{
				$data['userlist'][] = $user['username'];
			}
			$data['userlist'] = array_reverse($data['userlist']);
		}
		echo json_encode($data);
	}

	//for the xchat
	else {
		//TODO xChat()
		$usersData = new xChat($domain);
		$data = $usersData->getUsersData($current, $room, $username, $domain);
		//$data = $usersData;
		echo $data; //this is json encode already

	}
}
catch (Exception $ex){
	echo "Exception Message - ".$ex->getMessage();
}
?>