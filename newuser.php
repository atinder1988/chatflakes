<html>

<head>
<title>CHATFLAKES</title>

</head>


<div id"bar" style="position:absolute;color:orange">
<h2> Welcome to Chat-Flakes </h2>
</div>

<body>

<div style="position:absolute;left:150px;top:140px">
<img src=logo.png>
</div>


<div style="position:absolute;top:100px;left:600px">

<b>------------------- NEW USER -------------------</b>
<form action="register.php" method="post">

 <table border="0">
<tr><td>First Name:</td><td>
 <input type="text" name="first_name" maxlength="20">
 </td></tr>
<tr><td>Last Name:</td><td>
 <input type="text" name="last_name" maxlength="20">
 </td></tr>
 <tr><td>Username:</td><td>
 <input type="text" name="username" maxlength="20">
 </td></tr>
 <tr><td>Password:</td><td>
 <input type="password" name="password1" maxlength="20">
 </td></tr>
 <tr><td>Confirm Pass:</td><td>
 <input type="password" name="password2" maxlength="20">
 </td></tr>
<tr><td>Gender</td><td>
<select name='gender'>
<option value='select'>Select Gender</option>
<option value='male'>Male</option>
<option value='female'>Female</option>
 </td></tr>
 <tr><td>Email id:</td><td>
 <input type="email" name="email" maxlength="30">
 </td></tr>
 <tr><th colspan=2><input type="submit" name="submit" 
value="Register"></th></tr> </table>
</form>
</div>

</body>
</html>