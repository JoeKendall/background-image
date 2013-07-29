<?php
	//Get site wide settings
	$config = require_once 'app/settings.php'; ?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>Background Image - Repeat Checker</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['html']; ?>favicon.ico" />
    
    <link href="<?php echo $config['html']; ?>css/style.css" type="text/css" rel="stylesheet" />
    <script src="<?php echo $config['html']; ?>js/dropzone.min.js"></script>
    
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <div class="instructions animated" id="instructions">
    	<p>Drag and drop an image to see how well it repeats. This box needs to look smart.</p>
    </div>

  	<ul id="tools" class="tools animated">
	  	<li>
		  	<select id="background-repeat" name="background-repeat">
		  		<option value="repeat">repeat</option>
		  		<option value="repeat-x">repeat-x</option>
		  		<option value="repeat-y">repeat-y</option>
		  		<option value="no-repeat">no-repeat</option>
		  	</select>
	  	</li>
	  	<li>
	  		<input type="text" id="background-color" placeholder="Background Colour: Full Syntax">
	  	</li>
	  	<li>
		  	<select name="background-position" id="background-position">
		  		<option value="left top">left top</option>
		  		<option value="left center">left center</option>
		  		<option value="left bottom">left bottom</option>
		  		<option value="right top">right top</option>
		  		<option value="right center">right center</option>
		  		<option value="right bottom">right bottom</option>
		  		<option value="center top">center top</option>
		  		<option value="center center">center center</option>
		  		<option value="center bottom">center bottom</option>
		  	</select>
	  	</li>
  	</ul>
    
    <form action="<?php echo $config['html']; ?>app/upload.php" id="my-dropzone" class="dropzone"></form>

    <script>
		//set up ajax api
      var ajax = new XMLHttpRequest();
      
      	/* Tools */
      		//backgroundRepeat - on change of the select, add the style to body
	  		document.getElementById('background-repeat').onchange = function(){
	  		    document.body.style.backgroundRepeat = this.value;
	  		};
	  		//backgroundColor - on every key, add the style to body, when valid it will kick in. 
	  		//TODO: easier way for users to know they can use any syntax. tooltip?
	  		document.getElementById('background-color').onkeyup = function(){
	  		    document.body.style.backgroundColor = this.value;
	  		};
	  		//backgroundPosition - on change of the select, add the style to body
	  		document.getElementById('background-position').onchange = function(){
	  		    document.body.style.backgroundPosition = this.value;
	  		};


      	/* UPLOAD */
	  		Dropzone.options.myDropzone = {
	  		  init: function() {
	  		    this.on("complete", function(file) {
	  		     //changeBackground(Math.floor(new Date().getTime() / 1000) + file.name);
	  		     changeBackground(file.name);
	  		    });
	  		  }
	  		};
      	/* STYLE */
      		//changeBackground() passed file.name.
      		//add body style of the image, gets rid of the instructions, shows tools, and after half second, deletes the uploaded file.
      		//because called on(complete), however big the image delete will be called half second after it has COMPLETED uploading.
	  		function changeBackground(file) {
	  		  document.body.style.backgroundImage="url('<?php echo $config['html']; ?>uploads/" + file + "')";
	  		  document.getElementById('instructions').className += " rotateOutUpRight";
	  		  document.getElementById('tools').className += " bounceIn";
	  		  setTimeout(function() { deleteFile(file); }, 500);
	  		}
      	/* DELETE */
      		//utilise the ajax api, set post request with file name half second after it has uploaded.
	  		function deleteFile(file){
	  		    ajax.open("POST","<?php echo $config['html']; ?>app/delete.php",false);
	  		    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  		    ajax.send("deleteFile=" + file);
	  		}
    </script>
</body>
</html>
