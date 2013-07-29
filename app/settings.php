<?php
return array(
										 //// REQUIRED
    'host' => '',				 // database host
    'db' => '',						 // database
    'user' => '',						 // database username
    'pass' => '',						 // database password
    'root' => '/Applications/MAMP/htdocs', // server base, with no trailing slash
    'html' => '/background-image/',					 // site base, with starting and trailing slash
    'uploads' => 'uploads/',					 // site base, with starting and trailing slash
   	 									 //// OPTIONAL
    'site' => 'Website',				 	 // site name
    'hex_email' => '',					 // email address with hex values http://www.swingnote.com/tools/texttohex.php
    'char_email' => '',					 // email address with char values http://www.wbwip.com/wbw/emailencoder.html
    'prerw' => '',						 // pre rewrite if set up in .htaccess
    'postrw' => '.html'					 // post rewrite if set up in .htaccess
); 