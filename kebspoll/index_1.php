<link href="css/usercss.css" rel="stylesheet" type="text/css" media="all">

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//if (isset($_POST['action']) && $_POST['loginSubmit'] == 'loginSubmit') {
//    $statusMsg= "Clicked";
//}

session_start();


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<div class="container">
    <?php
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            include 'Poll.class.php';
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
            );
            //$conditions['return_type'] = 'single';
            $userData = $user->getMemberDetails($conditions);
    ?>
    <h2>Welcome <?php echo $userData['firstname']; ?>!</h2>
    <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
    <div class="regisFrm">
        <p><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p><b>Email: </b><?php echo $userData['email']; ?></p>
        <p><b>Phone: </b><?php echo $userData['phone']; ?></p>
    </div>
    <?php }else{ ?>
    <h2>Provide your KEBS HR No.</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="confirmdetails.php" method="post">
            <input type="hrno" name="hrno" placeholder="HR No" required="" size="10" maxlength="4">
            <!--<input type="password" name="password" placeholder="PASSWORD" required="">-->
            <div class="send-button">
                <input type="submit" name="loginSubmit" value="Proceed to Confirm Details">
            </div>
        </form>
        <p>Don't have an account? <a href="registration.php">Register</a></p>
    </div>
    <?php } ?>
</div>