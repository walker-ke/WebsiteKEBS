<?php

function CheckAccess() {

    $result = isset($_GET['opt']);

    if (!$result) {

  header('HTTP/1.0 404 Not Found');
        echo "Access denied";

   exit;
    
       //return false;
    } 
}

?> 