<?php

$con=mysql_connect("localhost","root","");
if(!$con)
{die('error in connection'.mysql_error());}

if(mysql_select_db("chat2_db",$con))
{}
else
{echo"No db selected";}


// Random confirmation code 
$confirm_code=md5(uniqid(rand()));

if($_POST[first_name]!='' && $_POST[last_name]!='' && $_POST[username]!='' && $_POST[password1]!='' && $_POST[email]!='')
{
   if($_POST[password1]==$_POST[password2])
   {
        //$sql=mysql_query("insert into new(first_name,last_name,username,password,gender,email) values('$_POST[first_name]','$_POST[last_name]','$_POST[username]',
        //'$_POST[password1]','$_POST[gender]','$_POST[email]')",$con);
		$sql=mysql_query("insert into temp_new(code,first_name,last_name,username,password,gender,email) values('$confirm_code','$_POST[first_name]','$_POST[last_name]','$_POST[username]',
        '$_POST[password1]','$_POST[gender]','$_POST[email]')",$con);
		// send e-mail to ...
		if($sql)
		{
$recipients=$_POST[email];

// Your subject
$subject="Your confirmation link here";

// From
$header="from: Atinder Sohal";

// Your message
$message="Your Comfirmation link \r\n";
$message.="Click on this link to activate your account \r\n";
$message.="http://www.chatflakes.com/dev1/confirmation.php?passkey=$confirm_code";

if (mail($recipients, $header, $message)) {
   echo("<p>Message successfully sent! Please check your email for sign-in link... </p>");
  } else {
   echo("<p>Message delivery failed...  Enter valid e-mail address..</p>");
  }
        ?>
      <a href="index.php">Go Back</a>
      <?php
	  }
	  else
	  {
	  echo "Username already exists..  Please enter different username";
      }
    }
    else
    { echo "Password donot match..  re-enter data";
	?>
      <a href="index.php">Go Back</a>
      <?php
    }
}	
else
{ echo "Please fill all the entries..  Blank entries not accepted ";
?>
      <a href="index.php">Go Back</a>
      <?php
}
mysql_close($con);

?>