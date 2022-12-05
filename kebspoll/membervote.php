
<link href="css/usercss.css" rel="stylesheet" type="text/css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "connectdb.php";
if (isset($_POST['action']) && $_POST['action'] == 'voteSubmit') {
       
    ?>
<script type="text/javascript">
    alert("Clicked");
    </script>
  <?php }
   


$hrn = $_REQUEST['membernrno'];

$statusMsg='';

$pollresults = mysqli_query($con,"select * from poll_options where status=1");
//$pollData= mysqli_fetch_row($pollresults)

 function getMembername($hrnum){
     include "connectdb.php";
    $memname = mysqli_query($con,"select firstname, lastname FROM `members` WHERE `hr_no`=$hrnum");
    $mname=mysqli_fetch_assoc($memname);
    
    return $mname['firstname'].' '.$mname['lastname'];
}
?>

<div class="container">
    <table style="width:100%">
        <tr>
            <td><img src="images/kebs_complex.gif" style="width: 100px"></td>
            <td><img src="images/poll-box.png" style="width: 100px"></td>
        </tr>
    </table>
    Welcome <?php echo getMembername($hrn); ?>, take a vote
    <div class="pollContent">
        <p class="stmsg"><?php echo $statusMsg ?></p>
        <span><?php //echo $pollData['poll']['subject']; ?></span>
        <span><?php //$hrno = $hrnumber; ?></span>
        <form  name="pollFrm" id="pollFrm" action="takevote.php">
            <ul style="list-style: none">
                <li>
                    <?php
                    while ($opt = mysqli_fetch_assoc($pollresults)) {
                        
                   
                        echo '<li><input type="radio" name="voteOpt" value="' . $opt['id'] . '" >' . $opt['name'] . '</li>';
                    }
                    ?>
                </li>
            </ul>
            <div class="send-button">
                <input type="hidden" name="voterID" value="<?php echo $hrn; ?>">
                <input type="submit" name="voteSubmit" class="button" value="Vote" >
                     
            </div>
        </form>
    </div>
</div>


