<?php
include_once 'includes/configdb.php';

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
//if ($conn->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO subscribe (email)
VALUES ('$_POST[email]')";

if ($conn->query($sql) === TRUE) {
	
  #echo "THANK YOU! <br> You have now been added to the Subscription List.";  
      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://www.kebs.org/index.php">';    
    exit;
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
