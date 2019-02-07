 <?php
$con=mysql_connect("mysql","atinder1988","asdfgh");
if(!$con)
{die('error in connection'.mysql_error());}
if(mysql_select_db("chat2_db",$con))
{}
else
{echo"No db selected";}
$filename2 = "chatroom-$_POST[droom].txt";
$filename1 = "chatroom-$_POST[croom].txt";
$x=0;
$y=0;
$result = mysql_query("SELECT * FROM chat_rooms");
while($row = mysql_fetch_array($result))
  {
       if( $row['name'] == $_POST[croom])
       { $x=1;
        }
	}	
if($_POST[croom]!= '' && $x==0)
{  $sql=mysql_query("insert into chat_rooms(name,file) values('$_POST[croom]', '$filename1')",$con);
   
}
$result = mysql_query("SELECT * FROM chat_rooms");
while($row = mysql_fetch_array($result))
  {
       if( $row['name'] == $_POST[droom])
       { $y=1;
        }
	}	
if($_POST[droom]!=''|| $y==1)
{  $xyz=mysql_query("DELETE FROM `chat_rooms` WHERE file='$filename2'",$con);
   $abc=mysql_query("DELETE FROM `chat_rooms` WHERE name='$_POST[droom]'",$con);
     
 }
  header("Location: xchatrooms.php");
?>