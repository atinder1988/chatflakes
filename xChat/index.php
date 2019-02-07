<?php

    session_start();

    require_once 'xchat.php';
    require_once 'dconfig.php';
    
define("Domain1", $conf['Domain1']);
define("Domain2", $conf['Domain2']);
define("Domain3", $conf['Domain3']);
define("Domain4", $conf['Domain4']);
    
    $domain = htmlentities(strip_tags($_GET['domain']), ENT_QUOTES);
    
    // Get the url for the domain----------------------
    switch($domain){
				case ("Domain1"):
					$fdomain = Domain1;
					break;
				case ("Domain2"):
					$fdomain = Domain2;
					break;
				case ("Domain3"):
					$fdomain = Domain3;
					break;
				case ("Domain4"):
					$fdomain = Domain4;
					break;
	
			}
    //---------------------------------------------------

	//get the room name
    $name = htmlentities(strip_tags($_GET['name']), ENT_QUOTES);//$_GET['name'];
    // if domain name is not null, means we have a cross domain chat

    if (isset($name) && isset($_SESSION['userid'])): 
    
    //check for domain name, if it's not set - it's same domain chat
    if ($domain === "Home"){
    	// TODO - ../ - this works fine
	      require_once('../includes/dbcon.php');
	
	      $getRooms = "SELECT *
	  			           FROM chat_rooms
	  		             WHERE name = '$name'";
	  		         
	      $roomResults = mysql_query($getRooms);
			
	      	  	if (mysql_num_rows($roomResults) < 1) {
	  			header("Location: ../xchatrooms.php");
	  			die();
	  		}
	        	
	  	//need to check for the file for the chat as well, wheather that exists or not?
	      while ($rooms = mysql_fetch_array($roomResults)) {
	          $file =  $rooms['file'];
	      }
    }
    
    //i.e. it's cross domain chat
    else{
    	
    	$check = new xChat($domain);
    	//echo $name;
		// get the filename, passing $name-roomname
		$xfile = $check->getRoomFile($name, $domain);
		//echo $xfile;
		
    	//redirect back to chatrooms page, as chatroom not exist
    	if($xfile == ""){
    		header("Location: ../xchatrooms.php");
    	}
    }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Welcome to xChat: <?php echo $name; ?></title>
    
    <link rel="stylesheet" type="text/css" href="../main.css"/>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    <?php if ($domain === "Home"):?>
    	var chat = new Chat('<?php echo $file; ?>', '<?php echo $domain ?>', '<?php echo $domain ?>');
    	chat.init();
    	chat.getUsers(<?php echo "'" . $name ."','" .$_SESSION['userid'] . "'"; ?>);
    	var name = '<?php echo $_SESSION['userid'];?>';
    <?php else: ?>
    		var chat = new Chat('<?php echo $xfile; ?>', '<?php echo $domain; ?>', '<?php echo $fdomain; ?>');
    	   	chat.init();
        	chat.getUsers(<?php echo "'" . $name ."','" .$_SESSION['userid'] . "'"; ?>);
        	var name = '<?php echo $_SESSION['userid'];?>';
    <?php endif;?>
    </script>
    <script type="text/javascript" src="settings.js"></script>

	
<SCRIPT LANGUAGE="JavaScript">

var x = "http://localhost/ssl/images/x.jpg";
// Location of where you uploaded your site's x.jpg image

var o = "http://localhost/ssl/images/o.jpg";
// Location of where you uploaded your site's o.jpg image

var blank = "http://localhost/ssl/images/blank.jpg";
// Location of where you uploaded your site's blank.jpg image

var pause = 0;
var all = 0;
var a = 0;
var b = 0;
var c = 0;
var d = 0;
var e = 0;
var f = 0;
var g = 0;
var h = 0;
var i = 0;
var temp="";
var ok = 0;
var cf = 0;
var choice=9;
var aRandomNumber = 0;
var comp = 0; 
var t = 0;
var wn = 0;
var ls = 0;
var ts = 0;
function help() {
alert("Welcome to Tic-Tac-Toe!  You play as the X's and the computer is the O's.  Select the square you want to put your X into by clicking them.  You cannot occupy a square that is already occupied. The first player to get three squares in a row wins.  Good Luck!!")
}
function logicOne() {
if ((a==1)&&(b==1)&&(c==1)) all=1;
if ((a==1)&&(d==1)&&(g==1)) all=1;
if ((a==1)&&(e==1)&&(i==1)) all=1;
if ((b==1)&&(e==1)&&(h==1)) all=1;
if ((d==1)&&(e==1)&&(f==1)) all=1;
if ((g==1)&&(h==1)&&(i==1)) all=1;
if ((c==1)&&(f==1)&&(i==1)) all=1;
if ((g==1)&&(e==1)&&(c==1)) all=1;
if ((a==2)&&(b==2)&&(c==2)) all=2;
if ((a==2)&&(d==2)&&(g==2)) all=2;
if ((a==2)&&(e==2)&&(i==2)) all=2;
if ((b==2)&&(e==2)&&(h==2)) all=2;
if ((d==2)&&(e==2)&&(f==2)) all=2;
if ((g==2)&&(h==2)&&(i==2)) all=2;
if ((c==2)&&(f==2)&&(i==2)) all=2;
if ((g==2)&&(e==2)&&(c==2)) all=2;
if ((a != 0)&&(b != 0)&&(c != 0)&&(d != 0)&&(e != 0)&&(f != 0)&&(g != 0)&&(h != 0)&&(i != 0)&&(all == 0)) all = 3;
} 
function logicTwo() {
if ((a==2)&&(b==2)&&(c== 0)&&(temp=="")) temp="C";
if ((a==2)&&(b== 0)&&(c==2)&&(temp=="")) temp="B";
if ((a== 0)&&(b==2)&&(c==2)&&(temp=="")) temp="A";
if ((a==2)&&(d==2)&&(g== 0)&&(temp=="")) temp="G";
if ((a==2)&&(d== 0)&&(g==2)&&(temp=="")) temp="D";
if ((a== 0)&&(d==2)&&(g==2)&&(temp=="")) temp="A";
if ((a==2)&&(e==2)&&(i== 0)&&(temp=="")) temp="I";
if ((a==2)&&(e== 0)&&(i==2)&&(temp=="")) temp="E";
if ((a== 0)&&(e==2)&&(i==2)&&(temp=="")) temp="A";
if ((b==2)&&(e==2)&&(h== 0)&&(temp=="")) temp="H";
if ((b==2)&&(e== 0)&&(h==2)&&(temp=="")) temp="E";
if ((b== 0)&&(e==2)&&(h==2)&&(temp=="")) temp="B";
if ((d==2)&&(e==2)&&(f== 0)&&(temp=="")) temp="F";
if ((d==2)&&(e== 0)&&(f==2)&&(temp=="")) temp="E";
if ((d== 0)&&(e==2)&&(f==2)&&(temp=="")) temp="D";
if ((g==2)&&(h==2)&&(i== 0)&&(temp=="")) temp="I";
if ((g==2)&&(h== 0)&&(i==2)&&(temp=="")) temp="H";
if ((g== 0)&&(h==2)&&(i==2)&&(temp=="")) temp="G";
if ((c==2)&&(f==2)&&(i== 0)&&(temp=="")) temp="I";
if ((c==2)&&(f== 0)&&(i==2)&&(temp=="")) temp="F";
if ((c== 0)&&(f==2)&&(i==2)&&(temp=="")) temp="C";
if ((g==2)&&(e==2)&&(c== 0)&&(temp=="")) temp="C";
if ((g==2)&&(e== 0)&&(c==2)&&(temp=="")) temp="E";
if ((g== 0)&&(e==2)&&(c==2)&&(temp=="")) temp="G";
}
function logicThree() {
if ((a==1)&&(b==1)&&(c==0)&&(temp=="")) temp="C";
if ((a==1)&&(b==0)&&(c==1)&&(temp=="")) temp="B";
if ((a==0)&&(b==1)&&(c==1)&&(temp=="")) temp="A";
if ((a==1)&&(d==1)&&(g==0)&&(temp=="")) temp="G";
if ((a==1)&&(d==0)&&(g==1)&&(temp=="")) temp="D";
if ((a==0)&&(d==1)&&(g==1)&&(temp=="")) temp="A";
if ((a==1)&&(e==1)&&(i==0)&&(temp=="")) temp="I";
if ((a==1)&&(e==0)&&(i==1)&&(temp=="")) temp="E";
if ((a==0)&&(e==1)&&(i==1)&&(temp=="")) temp="A";
if ((b==1)&&(e==1)&&(h==0)&&(temp=="")) temp="H";
if ((b==1)&&(e==0)&&(h==1)&&(temp=="")) temp="E";
if ((b==0)&&(e==1)&&(h==1)&&(temp=="")) temp="B";
if ((d==1)&&(e==1)&&(f==0)&&(temp=="")) temp="F";
if ((d==1)&&(e==0)&&(f==1)&&(temp=="")) temp="E";
if ((d==0)&&(e==1)&&(f==1)&&(temp=="")) temp="D";
if ((g==1)&&(h==1)&&(i==0)&&(temp=="")) temp="I";
if ((g==1)&&(h==0)&&(i==1)&&(temp=="")) temp="H";
if ((g==0)&&(h==1)&&(i==1)&&(temp=="")) temp="G";
if ((c==1)&&(f==1)&&(i==0)&&(temp=="")) temp="I";
if ((c==1)&&(f==0)&&(i==1)&&(temp=="")) temp="F";
if ((c==0)&&(f==1)&&(i==1)&&(temp=="")) temp="C";
if ((g==1)&&(e==1)&&(c==0)&&(temp=="")) temp="C";
if ((g==1)&&(e==0)&&(c==1)&&(temp=="")) temp="E";
if ((g==0)&&(e==1)&&(c==1)&&(temp=="")) temp="G";
}
function clearOut() {
document.game.you.value="0";
document.game.computer.value="0";
document.game.ties.value="0";
}
function checkSpace() {
if ((temp=="A")&&(a==0)) {
ok=1;
if (cf==0) a=1;
if (cf==1) a=2;
}
if ((temp=="B")&&(b==0)) {
ok=1;
if (cf==0) b=1;
if (cf==1) b=2;
}
if ((temp=="C")&&(c==0)) {
ok=1;
if (cf==0) c=1;
if (cf==1) c=2;
}
if ((temp=="D")&&(d==0)) {
ok=1;
if (cf==0) d=1;
if (cf==1) d=2;
}
if ((temp=="E")&&(e==0)) {
ok=1;
if (cf==0) e=1;
if (cf==1) e=2;
}
if ((temp=="F")&&(f==0)) {
ok=1
if (cf==0) f=1;
if (cf==1) f=2;
}
if ((temp=="G")&&(g==0)) {
ok=1
if (cf==0) g=1;
if (cf==1) g=2;
}
if ((temp=="H")&&(h==0)) {
ok=1;
if (cf==0) h=1;
if (cf==1) h=2;
}
if ((temp=="I")&&(i==0)) {
ok=1;
if (cf==0) i=1; 
if (cf==1) i=2; 
}
}
function yourChoice(chName) {
pause = 0;
if (all!=0) ended();
if (all==0) {
cf = 0;
ok = 0;
temp=chName;
checkSpace();
if (ok==1) {
document.images[chName].src = x;
}
if (ok==0)taken();
process();
if ((all==0)&&(pause==0)) myChoice();
   }
}
function taken() {
alert("That square is already occupied.  Please select another square.")
pause=1;
}
function myChoice() {
temp="";
ok = 0;
cf=1;
logicTwo();
logicThree();
checkSpace();
while(ok==0) {
aRandomNumber=Math.random()
comp=Math.round((choice-1)*aRandomNumber)+1;
if (comp==1) temp="A";
if (comp==2) temp="B";
if (comp==3) temp="C";
if (comp==4) temp="D";
if (comp==5) temp="E";
if (comp==6) temp="F";
if (comp==7) temp="G";
if (comp==8) temp="H";
if (comp==9) temp="I";
checkSpace();
}
document.images[temp].src= o;
process();
}
function ended() {
alert("The game has already ended. To play a new game click the Play Again button.")
}
function process() {
logicOne();
if (all==1){ alert("You won, congratulations!"); wn++; }
if (all==2){ alert("Gotcha!  I win!"); ls++; }
if (all==3){ alert("We tied."); ts++; }
if (all!=0) {
document.game.you.value = wn;
document.game.computer.value = ls;
document.game.ties.value = ts;
   }
}
function playAgain() {
if (all==0) {
if(confirm("This will restart the game and clear all the current scores. OK?")) reset();
}
if (all>0) reset();
}
function reset() {
all = 0;
a = 0;
b = 0;
c = 0;
d = 0;
e = 0;
f = 0;
g = 0;
h = 0;
i = 0;
temp="";
ok = 0;
cf = 0;
choice=9;
aRandomNumber = 0;
comp = 0; 
document.images.A.src= blank;
document.images.B.src= blank;
document.images.C.src= blank;
document.images.D.src= blank;
document.images.E.src= blank;
document.images.F.src= blank;
document.images.G.src= blank;
document.images.H.src= blank;
document.images.I.src= blank;
if (t==0) { t=2; myChoice(); }
t--;
}
//  End -->
</script>
	
</head>

<body>


    <div id="page-wrap"> 
    
    	<div id="header">
    	
        	<h1><a href="#">Extreme Chat</a></h1>
        	
        	<div id="you" ><a href="../logout.php"><span>Logout: </span><?php echo $_SESSION['userid']; ?></a></div>
        	<div id="you1" style="float: right; position:relative; padding-right: 10px;"><span style="font: italic 12px Georgia, Serif;" >Back to </span><a href="../xchatrooms.php" style="color:white;">Chat Rooms</a></div>
        </div>
        
    	<div id="section">
    
            <h2>Room: <?php echo $name; ?></h2>
             <i>(Scroll below to play TIC TAC TOE) </i>        
            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>
            
            <div id="userlist"></div>
               
                <form id="send-message-area" action="">
                    <textarea id="sendie" maxlength='100'></textarea>
                </form>
						
		Smiley List:
	   :@ <img src='smiles/angry.gif'/>    :cool <img src='smiles/cool.gif'/>    :D<img src='smiles/biggrin.gif'/>    :o<img src='smiles/ohmy.gif'/>    :(<img src='smiles/sad.gif'/>     :)<img src='smiles/smile.gif'/>     :p<img src='smiles/tongue.gif'/>       ;)<img src='smiles/wink.gif'/> 
			
		          
        </div>
        
    <br><br><br>
	
<center>
<h3><i>Tic Tac Toe</i></h3>
<input type=button value="Start Game" onClick="playAgain();">
<form name=game>
<table border=0>
<td>
<table border=1>
<tr>
<td><a href="javascript:yourChoice('A')"><img src="blank.jpg" border=0 height=100 width=100 name=A alt="Top-Left"></a></td>
<td><a href="javascript:yourChoice('B')"><img src="blank.jpg" border=0 height=100 width=100 name=B alt="Top-Center"></a></td>
<td><a href="javascript:yourChoice('C')"><img src="blank.jpg" border=0 height=100 width=100 name=C alt="Top-Right"></a></td>
</tr>
<tr>
<td><a href="javascript:yourChoice('D')"><img src="blank.jpg" border=0 height=100 width=100 name=D alt="Middle-Left"></a></td>
<td><a href="javascript:yourChoice('E')"><img src="blank.jpg" border=0 height=100 width=100 name=E alt="Middle-Center"></a></td>
<td><a href="javascript:yourChoice('F')"><img src="blank.jpg" border=0 height=100 width=100 name=F alt="Middle-Right"></a></td>
</tr>
<tr>
<td><a href="javascript:yourChoice('G')"><img src="blank.jpg" border=0 height=100 width=100 name=G alt="Bottom-Left"></a></td>
<td><a href="javascript:yourChoice('H')"><img src="blank.jpg" border=0 height=100 width=100 name=H alt="Bottom-Center"></a></td>
<td><a href="javascript:yourChoice('I')"><img src="blank.jpg" border=0 height=100 width=100  name=I alt="Bottom-Right"></a></td>
</tr>
</table>
</td>
<td>
<table>
<tr><td><input type=text size=5 name=you></td><td>You</td></tr>
<tr><td><input type=text size=5 name=computer></td><td>Computer</td></tr>
<tr><td><input type=text size=5 name=ties></td><td>Ties</td></tr>
</table>
</td>
</table>
<input type=button value="Play Again" onClick="playAgain();">
  
<input type=button value="Game Help" onClick="help();">
</form>
</center>


  <div  style="position:absolute;top:150px;left:620px">
	   <form enctype="multipart/form-data" action="uploader.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="600000" />
Select file to upload <br>(less than 100KB): <input name="uploadedfile" type="file" />
<input type="submit" value="Upload" />
    </div> 
 <div  style="position:absolute;top:250px;left:620px">
 <i><b>List of Files :</b></i>
<?php	
	//list the files in the uploads directory

if ($handle = opendir('uploads/')) {
	while (false !== ($file = readdir($handle))) 
	{
	
		if ($file != "." && $file != "..") 
		{
			?>
			<a href="uploads/<?php echo $file;?>">
			<?php echo $file;?></a><?php  //format this to look the way you want it

		}
	} ?> </div><?php
	closedir($handle);
}
?>
</div>
</body>

</html>

<?php
    else:
            header('Location: ../xchatrooms.php');
    endif; 
    
?>