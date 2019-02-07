<?php
    session_start();
// TODO from "/includes/dbcon.php" to "./includes/dbcon.php" coz problem in yahoo hosting
require_once './includes/dbcon.php';//(dirname(__FILE__) . "/includes/dbcon.php");
require_once './includes/config.php'; //(dirname(__FILE__) . "/includes/config.php");//'include/config.php';
require_once './xChat/xchat.php';

$url_addroom = $conf['url_addroom']; //used for making ajax call, to add chatroom

if (checkVar($_SESSION['userid'])):
//if (1):

	$getRooms = "SELECT * FROM chat_rooms";
	$roomResults = mysql_query($getRooms);
	
	//for getting list of rooms from the other domains

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
    <title>Chat Rooms</title>
    
    <script type="text/javascript">
    $(function() {
		//-------------------------------------------------------------------------------------
    	$("#submitroom").click(function(){

    		var roomname = $("#addroom").val();
    		if(roomname != ""){
					$.ajax({
						type: "POST",
						//url: "http://localhost/workspace_eclipse/chalo_chat_karen/chatroom/addroom.php",
						url: "<?php echo $url_addroom; ?>",
						/*url: "http://test.ninadgolakiya.com/Chat/Chalo_Chat_Karen/chatroom/addroom.php",*/
						data: {
							'roomname' : roomname
							},
						success: function(data){
							if(data==1){
								$('<li><a href="xChat/?name=' + roomname + '&domain=Home>' +roomname + '</a></li>').appendTo('#hostDomain');
							}
							else{
								// TODO 
							}
							$("#addroom").val(''); //clears the text box
						},
					});
			}
				
        	});
			
			//--------------------------------------------------------------------------------------
		
		//animation of the list of rooms
		
		$('#page-wrap #section').animate({"opacity": .8 });

            $('#page-wrap #section').hover(function() {
                $(this).stop().animate({ "opacity": 1 }, "fast");
            }, function() {
                $(this).stop().animate({ "opacity": .8 }, "fast");
            });
		
        });
    
    </script>
    
    <link rel="stylesheet" type="text/css" href="main.css"/>

</head>

<body>
 <div style="position:absolute;top:10px;left:600px">
    <div id="page-wrap" style="width:90%"> 
    	<div id="header">
        	<h1><a href="#">Chat Rooms</a></h1>
        	<div id="you" ><a href="logout.php"><span>Logout: </span><?php echo $_SESSION['userid']; ?></a></div>
        </div>
        <table width="100%">
        <tr>
        <td width="200px" style="vertical-align: top;">
        	<div id="section">
    		<div id="rooms">
            	<h4>Chat Rooms</h4>
                <ul id="hostDomain">
                <?php 
                        while($roomsHome = mysql_fetch_array($roomResults)):
                    ?>
                    <li>
                        <a href="xChat/?name=<?php echo $roomsHome['name']."&domain=Home"?>" target="_blank"><?php echo $roomsHome['name']?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            
            <div style="padding-top: 5px">
            <form action="roomedit.php" method="post">
            	<input type="text" name="croom" value=""/>
            	<input class="button orange medium" type="submit" id="submitroom" name="submitroom" value="Create Room" /></form>
            </div>
			<form action="roomedit.php" method="post">
            	<input type="text" name="droom" value=""/>
            	<input class="button orange medium" type="submit" id="submitroom" name="submitroom" value="Delete Room" /></form>
            </div>
			
        </div>
        </td>
        
        <td width="200px" style="vertical-align: top;">
        	<div id="section">
    		<div id="rooms">
            	<h4>Rooms - Mounica's rooms</h4>
                <ul>
					<?php
					$getrooms = new xChat("Domain2");
					$rooms = $getrooms->getchatrooms();
					
					// this is for exception handling for cURL
					if(is_object(json_decode($rooms))){
						$rooms =  json_decode($rooms);
						if (!count($rooms->roomlist)){
							?>
							<li>No Rooms Available</li>
							<?php
						}
						else{
							foreach ($rooms->roomlist as $roomname){
								?>
								<li><a href="xChat/?name=<?php echo $roomname."&domain=Domain2"?>" target="_blank"><?php echo $roomname?></a></li>
								<?php
							}
						}
					}
					//TODO - here should be directed to error page with error message
					else{
						?>
						<li><?php echo $rooms;?></li>
						<?php
					}
					?>
                </ul>
            </div>
        </tr>
		<tr>
       </div>
        </td>
        <td width="200px" style="vertical-align: top;">
            <div id="section">
    		<div id="rooms">
            	<h4>Rooms - Shilpa's Rooms</h4>
                <ul>
					<?php
					$getrooms = new xChat("Domain3");
					$rooms = $getrooms->getchatrooms();
					
					// this is for exception handling for cURL
					if(is_object(json_decode($rooms))){
						$rooms =  json_decode($rooms);
						if (!count($rooms->roomlist)){
							?>
							<li>No Rooms Available</li>
							<?php
						}
						else{
							foreach ($rooms->roomlist as $roomname){
								?>
								<li><a href="xChat/?name=<?php echo $roomname."&domain=Domain3"?>" target="_blank"><?php echo $roomname?></a></li>
								<?php
							}
						}
					}
					//TODO - here should be directed to error page with error message
					else{
						?>
						<li><?php echo $rooms;?></li>
						<?php
					}
					?>
                </ul>
            </div>

        </div>
        </td>

		<td width="200px" style="vertical-align: top;">
			<div id="section">
    		<div id="rooms">
            	<h4>xRooms - kevin's Rooms</h4>
                <ul>
					<?php
					$getrooms = new xChat("Domain4");
					$rooms = $getrooms->getchatrooms();
					
					// this is for exception handling for cURL
					if(is_object(json_decode($rooms))){
						$rooms =  json_decode($rooms);
						if (!count($rooms->roomlist)){
							?>
							<li>No Rooms Available</li>
							<?php
						}
						else{
							foreach ($rooms->roomlist as $roomname){
								?>
								<li><a href="xChat/?name=<?php echo $roomname."&domain=Domain4"?>" target="_blank"><?php echo $roomname?></a></li>
								<?php
							}
						}
					}
					//TODO - here should be directed to error page with error message
					else{
						?>
						<li><?php echo $rooms;?></li>
						<?php
					}
					?>
                </ul>
            </div>

        </div>
        </td>
        </tr>
        </table>

        
    </div>
</div>
</body>

</html>

<?php 

else:
	header("Location: index.php");

endif;

?>