<?php
/* 
Author: Kenrick Beckett
Author URL: http://kenrickbeckett.com
Name: Chat Engine 2.0

*/
try {
	

require_once("../includes/dbcon.php");

function sendUserData($current, $room, $username){
//Start Array
$data = array();
// Get data to work with - not required as this is for xChat. will get the data in arguments
/*
		$current = $_GET['current'];
		$room = $_GET['room'];
		$username = $_GET['username'];*/
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
			//mysql_query("UPDATE `chat_users` SET `time_mod` = '$now' WHERE `username` = '$username'");
			$olduser = time() - 8;
			//$eraseuser = time() - 300;//increased from 30 to 300
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
		
		//this should be return statement, not the echo
		return json_encode($data);
		
}
	
}
catch (Exception $ex){
	echo 'Error Message - '.$ex->getMessage();
}


?>