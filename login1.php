<?php

session_start();

$con=mysql_connect("mysql","atinder1988","asdfgh");
if(!$con)
{die('error in connection'.mysql_error());}

if(mysql_select_db("chat2_db",$con))
{}
else
{echo"No db selected";}

$x=0;
$user="";
$result = mysql_query("SELECT * FROM new");

while($row = mysql_fetch_array($result))
  {
       if( $row['username'] == $_POST[username] && $row['password'] == $_POST[password])
       {   $_SESSION['userid'] = $_POST[username];
	       header('Location: xchatrooms.php');
           $x=1;
           
			}
}
if($x==0)
{
die('Not a user');
}





mysql_close($con);

?>
