<?php
function curPageURL() {
			 $pageURL = 'http';
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 return $pageURL;
	}  
			
	 /* if (curPageURL()=='http://localhost/4k-website/index.php?view=home'){
			  	
			include('home/default.php')	;
			  		}
	if (curPageURL()=='http://localhost/4k-website/index.php'){
			  	
			include('home/default.php')	;
			  		}*/


?>