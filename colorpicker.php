<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Background repeat checker</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['html']; ?>images/favicon.ico" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
 
    <script src="dropzone.min.js"></script>
    <script src="js/colorpicker.min.js"></script>

    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="Joe Kendall" />
    <meta name="geo.region" content="GB" />
    <meta name="distribution" content="Global" /> 
    <meta name="language" content="en-uk" />  
    <meta name="robots" content="index,follow,archive" />
    <!-- Mobile Specific Metas-->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- /Mobile Specific Metas-->
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="instructions animated" id="instructions"><p>Drag and drop an image to see how well it repeats. This box needs to look smart.</p></div>
    
    <form action="upload.php?t=<?php echo time(); ?>" id="my-dropzone" class="dropzone">
  	<ul id="tools" class="tools animated">
	  	<li id="repeat-x">Repeat-x</li>
	  	<li id="repeat-y">Repeat-y</li>
	  	<li id="bg-color">Background Color</li>
	  	<li id="align">Align</li>
  	</ul>
        <div id="color-picker" class="cp-small">
        </div>	        
        <input class="animated bg-input" type="text" id="bg-color-input">

    </form>

    <script>

      var ajax = new XMLHttpRequest();
      
      document.getElementById('repeat-x').onclick = function(){ 
		  document.body.style.backgroundRepeat="repeat-x"; 
	  } 
      document.getElementById('repeat-y').onclick = function(){ 
		  document.body.style.backgroundRepeat="repeat-y"; 
	  } 
      document.getElementById('bg-color').onclick = function(){ 
		 document.getElementById('color-picker').style.display = "block";
		 document.getElementById('bg-color-input').style.display = "block";
	  } 
	  
	  document.getElementById('bg-color-input').onkeyup = function(){
		  document.body.style.backgroundColor = this.value;
	  };

          ColorPicker(

            document.getElementById('color-picker'),

            function(hex, hsv, rgb) {
                //console.log(hsv.h, hsv.s, hsv.v);         // [0-359], [0-1], [0-1]
                //console.log(rgb.r, rgb.g, rgb.b);         // [0-255], [0-255], [0-255]
                document.body.style.backgroundColor = hex;        // #HEX
            });
     
                                
      function changeBackground(file) {
        document.body.style.backgroundImage="url('uploads/" + file + "')";
        document.getElementById('instructions').className += " rotateOutUpRight";
        document.getElementById('tools').className += " bounceIn";
        setTimeout(function() { deleteFile(file); }, 500);
        }

      function deleteFile(file){
          ajax.open("POST","delete.php",false);
          ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          ajax.send("deleteFile=" + file);
      }

      Dropzone.options.myDropzone = {
        init: function() {
          this.on("complete", function(file) {
           //changeBackground(Math.floor(new Date().getTime() / 1000) + file.name);
           changeBackground('<?php echo time(); ?>' + file.name);
          });
        }
      };
    </script>
</body>
</html>
