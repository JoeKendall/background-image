<?php
	//Get site wide settings
	$config = require_once 'settings.php'; 
	
	//check there are no funny errors
	if($_FILES['file']['error'] > 0) die('An error occurred when uploading.');
	//check the file size is reasonable
	if($_FILES['file']['size'] > 500000) die('File uploaded exceeds maximum upload size.');
	//check that we can get dimentions, to ensure image is being uploaded.
	if(!getimagesize($_FILES['file']['tmp_name'])) die('Please ensure you are uploading an image.');
		//if the files array isnt emtpy, go ahead and upload.
		if (!empty($_FILES)) move_uploaded_file($_FILES['file']['tmp_name'], $config['root'] . $config['html'] . $config['uploads'] . $_FILES['file']['name']);
?>