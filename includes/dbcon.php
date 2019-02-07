<?php
//Connection Page
require_once 'config.php';
define("HOST", $conf['db_hostname']);
define("USERNAME", $conf['db_username']);
define("PASSWORD", $conf['db_password']);
define("DB", $conf['db_name']);

   mysql_connect( HOST, USERNAME, PASSWORD) or die("Could not connect");
   mysql_select_db (DB)or die('Cannot connect to the database because: ' . mysql_error());

//functions
function checkVar($var)
{
	$var = str_replace("\n", " ", $var);
	$var = str_replace(" ", "", $var);
	if(isset($var) && !empty($var) && $var != '')
	{
		return true;
	}
	else
	{
		return false;	
	}
}
function hasData($query)
{	$rows = mysql_query($query)or die("somthing is wrong");
	$results = mysql_num_rows($rows);
	if($results == 0)
	{
		return false;  
	}
	else
	{
		return true;  
	}
}
function isAjax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
		{
	     	return true; 
		}	
		else
		{
			return false;
		}
		
	}


?>