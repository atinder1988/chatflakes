<?php
session_start();



require_once '../includes/dbcon.php';
require_once 'xChat.php';
$check = new xChat();
/*---------------- Room File Name-------------------------
$roomname = "css";



// get the json encoded data
$roomdetails = $check->getRoomFile($roomname);

//decode the json data 
//$roomdetails = json_decode($roomdetails);

//get the file elemet from the json array
echo $roomdetails;
*/
//-----------------------------------------

//get user details
/*
$current = 0;
$room = "css";
$username = "ninad";
$domain = "";//this is not used here
$userData = $check->getUsersData($current, $room, $username, $domain);

$userDataDecoded = json_decode($userData);

foreach ($userDataDecoded->userlist as $user){
	echo $user."<br>";
}*/
//--------------------------------------

//send state
/*
$_SESSION['userid'] = "ninad";
$xfile = "chatroom-css.txt";
$domain = "Domain1";
*/
//

//check - file exists??
/*
$file = "../xChat/chatroom-css.txt";
if(file_exists($file)){
	echo "It's there...";
}
else{
	echo "N O";
}*/

?>

<html>
<head>
<title>This is TEST</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="test.js"></script>
    <script type="text/javascript">
        		var chat = new Chat('chatroom-asd.txt', 'Domain1');
    	   	//chat.init();
        	chat.getUsers('asd','fd');
        	var name = 'fd';

    </script>
</head>

<body>

<div id="userlist">
<ul>
<li>Chattt</li>
</ul>
</div>

                <form id="send-message-area" method="post"  action="xsendstate.php">
                	<input type="text" id="function" name="function" value="send" />
                	<textarea id="message" name="message" maxlength='100'></textarea>
                	<input type="text" id="file" name="file" value="chatroom-css.txt" />
                	<input type="text" id="nickname" name="nickname" value="ninad" />
                	<input type="text" id="domain" name="domain" value="Domain1" />
                    
                    <input type="submit"  value="Send it baby" id="btnSend">
                </form>

</body>
</html>