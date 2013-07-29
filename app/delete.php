<?php
	//Get site wide settings
	$config = require_once 'settings.php'; 
	
	$file = $config['root'] . $config['html'] . $config['uploads'] . $_POST['deleteFile'];
	//if there is such a file, then delete it.
	if(file_exists($file)) unlink($file); 
?>