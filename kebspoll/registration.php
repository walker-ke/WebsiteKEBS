
<link href="css/usercss.css" rel="stylesheet" type="text/css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
$voted=$memberDetails['vote_status'];
//$result = mysqli_query($con,"select firstname, lastname, vote_status from members where hr_no=".$hrnumber);

?>
<div class="container">
    <table style="width:100%">
        <tr>
            <td><img src="images/kebs_complex.gif" style="width: 100px"></td>
            <td><img src="images/poll-box.png" style="width: 100px"></td>
        </tr>
    </table>
    <h2>Confirm your voting Details</h2>
   <?php
   function getLocalIP(){
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

echo $ip = getLocalIP();
   ?>
    
    <div class="regisFrm">
        
      <form action="membervote.php" method="post">
                   
                        
                    <input type="text" name="first_name" placeholder="FIRST NAME" readonly="true" value="<?php echo $memberDetails['firstname']; ?>">
            <input type="text" name="last_name" placeholder="LAST NAME" readonly="true"  value="<?php echo $memberDetails['lastname'] ?>">
            
            <input type="text" value="<?php echo $memberDetails['hr_no']; ?>" name="membernrno">
            
            
            <div class="send-button">
                <?php if($voted==0){?>
                
                <div class="send-button">You have not Voted
                <input type="submit" name="confirmdetails" value="Confirm Details and Proceed to vote ">
            </div>
                 <?php }else{  if($voted==1)?>
                  <div>You are marked as Voted. Thank you</div>
                  <?php
                  }
                    ?>
                
               
            </div>
        </form> 
                
     </div>
    
</div>
        
        
       