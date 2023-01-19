<?php
error_reporting(0);

//define constants
define('host','kebsite.mysql.database.azure.com');
define('user','kebsite@kebsite');
define('password','k3bs@123');
define('db_name','kebs_kebsmain');

// Connect to server.
mysql_connect(host, user, password)or die("Error connecting to the database"); 

//Select Database
mysql_select_db('db_name')or die("<br>Error selecting the database ");
?>
