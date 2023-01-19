<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("kebsite.mysql.database.azure.com", "kebsite@kebsite", "k3bs@123", "kebsite");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT * FROM tc_divisions where division = 'Services'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<b>Technical Committee : Services</b>";
        echo "<table>";

            echo "<tr>";
                echo "<th>TC NUMBER</th>";
                echo "<th>TITLE</th>";
				echo "<th>STATUS</th>";
				
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['tc_no'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>