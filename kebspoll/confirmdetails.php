
<?php
include "connectdb.php";

$hrnumber = $_REQUEST['hrno'];

$result = mysqli_query($con,"select hr_no, firstname, lastname, vote_status from members where hr_no=".$hrnumber);

//while ($row = $result->fetch_assoc())
//{
//    //foreach($row as $value) echo "<td>$value</td>";
//    
//    echo $row['firstname'];
//}
$rowcount= mysqli_num_rows($result);
if ($rowcount==0){
    $server=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    //echo $server;
    $recordstus= "No record";
    
    require_once('index.php');
}else{
$memberDetails=$result->fetch_assoc();
require_once('registration.php');

//echo $memberDetails['firstname'];
}
?>

