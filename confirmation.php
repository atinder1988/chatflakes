<?php

$con=mysql_connect("mysql","atinder1988","asdfgh");
if(!$con)
{die('error in connection'.mysql_error());}

if(mysql_select_db("chat2_db",$con))
{}
else
{echo"No db selected";}

// Passkey that got from link 
$passkey=$_GET['passkey'];

// Retrieve data from table where row that match this passkey 
$sql1="SELECT * FROM temp_new WHERE code ='$passkey'";
$result1=mysql_query($sql1);
// If successfully queried 
if($result1){

// Count how many row has this passkey
$count=mysql_num_rows($result1);

// if found this passkey in our database, retrieve data from table "temp_members_db"
if($count==1){

$rows=mysql_fetch_array($result1);
$fname=$rows['first_name'];
$lname=$rows['last_name']; 
$username=$rows['username'];
$password=$rows['password'];
$gender=$rows['gender'];
$email=$rows['email'];

$tbl_name2="registered_members";

// Insert data that retrieves from "temp_members_db" into table "registered_members" 
$sql2="insert into new(first_name,last_name,username,password,gender,email) values('$fname','$lname','$username',
        '$password','$gender','$email')";
$result2=mysql_query($sql2);
}

// if not found passkey, display message "Wrong Confirmation code" 
else {
echo "Wrong Confirmation code";
}

// if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
if($result2){

echo "Your account has been activated..  Login to continue..";
?>
      <a href="index.php">Go Back</a>
      <?php

// Delete information of this user from table "temp_members_db" that has this passkey 
$sql3="DELETE FROM temp_new WHERE code = '$passkey'";
$result3=mysql_query($sql3);

}

}
?>