<?php
//TODO this paths need to be confirmed!!!
require_once ('../includes/config.php');
require_once ('../includes/dbcon.php');
//require_once '../config.php';

$success = 0;

if(isset($_POST['roomname'])){
	$roomname = htmlentities(strip_tags($_POST['roomname']), ENT_QUOTES);//$_POST['roomname'];
	$roomname = mysql_escape_string($roomname);
	$filename = "chatroom-$roomname.txt";

	//file should be created in a different folder
	//$filename = "";
	if($roomname != NULL && $roomname != " "){
		$query_check = "select * from chat_rooms where name = '$roomname'";
		$checkRooms = mysql_query($query_check) or die(mysql_error()) ;

		//only if no rooms found with $roomname
		if(mysql_num_rows($checkRooms) < 1){

			$query = "INSERT INTO `chat_rooms` (`id`, `name`, `numofuser`, `file`) VALUES (NULL, '$roomname', '0', '$filename');";

			mysql_query($query) or die(mysql_error());

			if(file_exists($filename)){
				//do nothing
			}
			else {
				$file = fopen($filename, "x");
				fclose($file);

			}
			$success = 1;
			//header("Location: ssl/xchatrooms.php");
		}

		//else return failed
		else{
			$success = 0;
		}
	}
}
	echo $success;

?>