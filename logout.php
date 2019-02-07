<?php

require_once './includes/dbcon.php';

session_start();

$username = $_SESSION['userid'];

$updateUser = "UPDATE  chat_users SET `status` = '0' 
			WHERE username = '$username'";
    			mysql_query($updateUser) or die(mysql_error());

session_unset();
session_destroy();

header("Location: ./index.php");
    			
?>