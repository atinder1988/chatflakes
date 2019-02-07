<?php 

  //  CONSIDER THIS SECURITY MEASURE ON WHERE THE
  //  FILE CAN ONLY BE CALLED VIA AJAX AND FROM SPECIFIC LOCATIONS
  // 
  // if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_REFERER']!="http://your-site.com/path/to/chat.js") {
  //   die();
  // } 

?>
  
  
<?php
function sendChatUpdate($state, $file){    
	
	//TODO - a different folder for all the chatroom file
$file = "../xChat/".$file;
	function getfile($f) {
    
    	if (file_exists($f)) {
            $lines = file($f);
        }	
        
        return $lines; 
        
    }
    
    function getlines($fl){
          return count($fl);	
    }
   			
    //TODO can be reduced to 40 - 50 causes connection timeput some times
    $finish = time() + 45;
    $count = getlines(getfile($file));
    
    while ($count <= $state) {
    
        $now = time();
        //TODO can be reduced to 5000 - for more prompt message update
        usleep(10000); //increased to 15000, just in case updates are clashing with write
        
        if ($now <= $finish) {
            $count = getlines(getfile($file));
        } else {
            break;	
        }  
         
    }		 
    
    if ($state == $count) {
    
        $log['state'] = $state;
        $log['t'] = "continue";
        
    } else {
    
        $text= array();
        $log['state'] = $state + getlines(getfile($file)) - $state;
        
        foreach (getfile($file) as $line_num => $line) {
            if ($line_num >= $state) {
                $text[] =  $line = str_replace("\n", "", $line);
            }
    
            $log['text'] = $text; 
        }
    }
    
    echo json_encode($log);	
}
	   
?>