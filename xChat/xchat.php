<?php
//TODO this path is causing problems - resolve it!
//require_once './includes/config.php'';

try {

	class xChat{

		//private	$url = "http://localhost/workspace_eclipse/fChat/xsenddetails/xmain.php";
		private  $url;
		
		function __construct($val){
			
		switch($val){
				case ("Domain1"):
					$this->url = "http://chatflakes.com/dev1/xsenddetails/xmain.php";
					break;
				case ("Domain2"):
					$this->url = "http://penu1551.com/dev1/xsenddetails/xmain.php";
					break;
				case ("Domain3"):
					$this->url = "http://shilpananduri.com/dev1/xsenddetails/xmain.php";
					break;
				case ("Domain4"):
					$this->url = "http://patelkevin.com/dev1/xsenddetails/xmain.php";
					break;
	
			}
					
		}
		
		// TODO - need to provide all the domain names
		
		public function getchatrooms(){
			//prepare the post data
			$post_data = array (
			"details"=>"getrooms"
			);
			//echo "Hi";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$outputRooms = curl_exec($ch);

			curl_close($ch);
			//echo "Hi";
			return $outputRooms;
		}

		//TODO need to get the domain name here
		function getRoomFile($roomname, $domain){

			// this will be decided from the argument passed to this function form the callinf php file
			//$url = "http://localhost/workspace_eclipse/fChat/xsenddetails/xmain.php";
			//$url = "http://ninadgolakiya.com/dev/xsenddetails/xmain.php";

			//prepare the post data
			$post_data = array (
			"details"=>"roomdetails",
			"roomname"=>$roomname
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);

			curl_close($ch);

			//decode the json data
			$roomdetails = json_decode($output);

			if(isset($roomdetails->file)){
				//get the file elemet from the json array
				return $roomdetails->file;
			}
			else{
				return "";// no rooms available
			}

		}

		//this is up and running...
		function getUsersData($current, $room, $username, $domain){

			//$domain is used for getting url from the config file
			// TODO get these URLs from config files
			//$url = "http://localhost/workspace_eclipse/fChat/xsenddetails/xmain.php";
			//$url = "http://ninadgolakiya.com/dev/xsenddetails/xmain.php";

			//prepare the post data
			$post_data = array (
			"details"=>"userdetails",
			"current"=>$current,
			"room"=>$room,
			"username"=>$username
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);

			curl_close($ch);
			return $output;
		}

		function getSendState($function, $message, $file, $nickname, $domain){

			// TODO get these URLs from config files
			//$url = "http://localhost/workspace_eclipse/fChat/xsenddetails/xmain.php";
			//$url = "http://ninadgolakiya.com/dev/xsenddetails/xmain.php";

			//prepare the post data
			$post_data = array (
			"details"=>"sendstate",
			"function"=>$function,
			"message"=>$message,
			"file"=>$file,
			"nickname"=>$nickname
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$outputSendState = curl_exec($ch);

			curl_close($ch);

			return $outputSendState;

		}

		function getChatUpdate($state, $file, $domain){

			// TODO get these URLs from config files
			//$url = "http://localhost/workspace_eclipse/Chalo_Chat_Karen/xsenddetails/xmain.php";
			//$url = "http://ninadgolakiya.com/dev/xsenddetails/xmain.php";

			//prepare the post data
			$post_data = array (
			"details"=>"chatupdate",
			"state"=>$state,
			"file"=>$file
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$outputChatUpdate = curl_exec($ch);

			curl_close($ch);

			return $outputChatUpdate;//this the json encoded data from the called domain


		}

	}

}
catch (Exception $ex){
	echo "Exception Message - ".$ex->getMessage();
}
?>