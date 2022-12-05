
<link href="css/usercss.css" rel="stylesheet" type="text/css" media="all">

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "connectdb.php";
$statusMsg='';
if (isset($_GET['voteOpt'])) {
    $voteoption = $_GET['voteOpt'];
}
if (isset($_GET['voterID'])) {
    $votemember = $_GET['voterID'];
}
$memberstatus = mysqli_query($con,"select vote_status from members where hr_no=$votemember");

$mstatus=mysqli_fetch_assoc($memberstatus);
//if ($memberstatus[''])
$memberVoteStatus = $mstatus['vote_status'];

 function getPollResults(){
     include "connectdb.php";
    $votescasted= mysqli_query($con,"select * FROM `members` WHERE `vote_status`=1");
    $votes= mysqli_num_rows($votescasted);
    $totalpopulation=  mysqli_query($con,"select * FROM `members`");
    $totalvotes= mysqli_num_rows($totalpopulation);
   $votingstatus=   (($votes/$totalvotes)*100);
    return round($votingstatus, 2)."%";
}

function getLocalIPs(){
    exec("ipconfig /all", $output);
        foreach($output as $line){
            if (preg_match("/(.*)IPv4 Address(.*)/", $line)){
                $ip = $line;
                $ip = str_replace("IPv4 Address. . . . . . . . . . . :","",$ip);
                $ip = str_replace("(Preferred)","",$ip);
            }
        }
    return $ip;
}

 //$ip = getLocalIP();
 
 // Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

function get_IP_address()
{
    foreach (array('HTTP_CLIENT_IP',
                   'HTTP_X_FORWARDED_FOR',
                   'HTTP_X_FORWARDED',
                   'HTTP_X_CLUSTER_CLIENT_IP',
                   'HTTP_FORWARDED_FOR',
                   'HTTP_FORWARDED',
                   'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                $IPaddress = trim($IPaddress); // Just to be safe

                if (filter_var($IPaddress,
                               FILTER_VALIDATE_IP,
                               FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                    !== false) {

                    return $IPaddress;
                }
            }
        }
    }
}

 $ip = get_IP_address();

if ($memberVoteStatus==1){
    $statusMsg = "<span class='stmsg'>You are marked as Voted, Thank you</span>";
}else{
    if ($memberVoteStatus==0){
        
        $sql = "INSERT INTO poll_votes ( member_id, poll_option_id, vote_count, ip_address)
VALUES ('$votemember', '$voteoption', 1, '$ip')";

if (mysqli_query($con,$sql) === TRUE) {
   mysqli_query($con,"UPDATE `members` SET `vote_status`=1 WHERE `hr_no`=$votemember");
   $statusMsg ="Voting was Succesfull and you have been marked as voted";
 
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
    }
}


$con->close();



 function getMembername($hrnum){
     include "connectdb.php";
    $memname = mysqli_query($con,"select firstname, lastname FROM `members` WHERE `hr_no`=$hrnum");
    $mname=mysqli_fetch_assoc($memname);
    
    return $mname['firstname'].' '.$mname['lastname'];
}
?>

   


<div class="container pollContent">
    <table style="width:100%">
        <tr>
          <td><img src="images/poll-box.png" style="width: 100px" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
            <td width="100%" colspan="2" style="vertical-align: top">
            <div style="display: block; float: left; vertical-align: top;width: 70%;padding-right: 5px">
    <div>Welcome <?php echo getMembername($votemember)." "; ?></div>
    <div class="stmsg" style="padding-top: 15px">
       <?php echo $statusMsg ?>               
    </div>
    </div>
    <div style="display: block; float: right; vertical-align: top;width: 28%">
        So far <?php echo " ".getPollResults()." of the total votes have been cast"  ?>
    </div>
            </td>
        </tr>
    </table>
    <p>&nbsp;<a href="http://www.kebs.org">Back to the KEBS website.</a></p>
</div>


