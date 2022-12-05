<link href="css/generalstyle.css" rel="stylesheet" type="text/css" media="all">

    <?php
    //include and initialize Poll class 
    include 'Poll.class.php';
    $poll = new Poll;

    //get poll and options data
    $pollData = $poll->getPolls();
?>
<?php
//if vote is submitted
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
    );
    //insert vote data
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){
        //store in $_COOKIE to signify the user has voted
        setcookie($_POST['pollID'], 1, time()+60*60*24*365);
        
        $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote already had submitted.';
    }
}



?>
<div class="pollContent">
    <?php echo !empty($statusMsg)?'<p class="stmsg">'.$statusMsg.'</p>':''; ?>
    <span><?php echo $pollData['poll']['subject']; ?></span>
    <span><?php    $hrno= $hrnumber; ?></span>
    <form  name="pollFrm" id="pollFrm">
        <ul>
            <li>
        <?php foreach($pollData['options'] as $opt){
            echo '<li><input type="radio" name="voteOpt" value="'.$opt['id'].'" >'.$opt['name'].'</li>';
        } ?>
            </li>
    </ul>
    <div class="send-button">
    <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
    <input type="submit" name="voteSubmit" class="button" value="Vote" >
    <button>Submit</button>
   
    </div>
       <!--<a href="results.php?pollID=<?php //echo $pollData['poll']['id']; ?>">Results</a>-->
        
    </form>
</div>
