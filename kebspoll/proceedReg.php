<?php

include 'Poll.class.php';
$user = new Poll();
if (isset($_POST['loginSubmit'])) {
    //check whether login details are empty
    if (!empty($_POST['hrno'])) {
        //get user data from user class
        $conditions = $_POST['hrno'];

        $userData = $user->getMemberDetails($conditions);
        echo $userData;
        //set user data and status based on login credentials
        if ($userData) {
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['hr_no'];
            //$sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome ' . $userData['firstname'] . '!';
        } else {
            //$sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong HR No, please try again.';
        }
    } else {
        //$sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter HR No.';
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
} elseif (!empty($_REQUEST['logoutSubmit'])) {
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
} else {
    //redirect to the home page
    header("Location:index.php");
}

