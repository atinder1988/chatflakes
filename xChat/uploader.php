<html>
<body>
<?PHP

// Where the file is going to be placed
$target_path = "uploads/";

/* Add the original filename to our target path.
Result is “uploads/filename.extension” */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

//all this does is move the file from the temporary directory to the actual uploads directory. you really don’t hafta worry about it, but it’s needed.
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

echo "The file ".  basename( $_FILES['uploadedfile']['name'])." has been uploaded<BR><BR>";
} else{
echo "There was an error uploading the file, please try again!<BR><BR>";

}
?>
<div id="you1" style="float: right; position:relative; padding-right: 10px;"><span style="font: italic 12px Georgia, Serif;" >Back to </span><a href="../xchatrooms.php" >Chat Rooms</a></div>
</body>
</head>



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

