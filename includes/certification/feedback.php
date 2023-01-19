<?php
$objConnect = JFactory::getDbo();


function generate_id()
		 {
		print "KEBS".rand(1, 1000000); 
		 //$applicantid=mysql_query("SELECT id FROM job_adverts WHERE id = $id");
		 }		

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  }
	$objConnect =JFactory::getDbo();
	//$job=mysql_query("SELECT id,job_tittle FROM job_adverts WHERE id = $id");
			 // $jobtitle=mysql_fetch_assoc($job);	
			// $position_applied=$jobtitle['job_tittle'];		
 
$msg="";

if(isset($_POST['action'])&& $_POST['action'] == 'submitfbform')
		{
			
		
		$today = date("F j, Y");
		$ref=$_REQUEST['Reff_id'];
		$respname=$_REQUEST['respname'];
		$orgname=$_REQUEST['orgname'];
		$address=$_REQUEST['postaladdress'];
		$tel = $_REQUEST['telephone'];
        $email = $_REQUEST['email'];
		$fax =$_REQUEST['fax'];
		/*$standards_array =$_REQUEST['standards'];
		  foreach ($standards_array as $one_standards) 
		  {
		  $standardtype .= $one_standards.", ";
		  }
		  $standards = substr($standardtype, 0, -2);*/
		  
		  $standardtype_array = $_REQUEST['standards'];
		
		  foreach ($standardtype_array as $one_standardtype) 
		  {
		  $standardtype_source.= $one_standardtype.", ";
		  }
		  $standards = substr($standardtype_source, 0, -2);
		  
		$certified =$_REQUEST['certified'];
		$otherstandards =$_REQUEST['otherstandards'];
		$certified1 =$_REQUEST['certified1'];
		$explanation =$_REQUEST['explanation'];
		$valued=$_REQUEST['interact'];
		$explanation2 =$_REQUEST['explanation2'];
		$feedback =$_REQUEST['feedback'];
		$queries =$_REQUEST['queries'];
		$ontime =$_REQUEST['ontime'];
		$knowledge =$_REQUEST['knowledge'];
		$thorough =$_REQUEST['thorough'];
		$courteous =$_REQUEST['courteus'];
		$punctual =$_REQUEST['punctual'];
		$objective =$_REQUEST['objective'];
		$valadding =$_REQUEST['valadding'];
		
		
$todayis = date("l F d, Y, h:i A");
     //$say="Complaint on ";
//$attn = $areaofenqury ; 
$subject = "Customer's feed backtype from website"; 

$message = " $todayis\n
Dear KEBS CB\n 
A Customer by the name $respname has filled in a feedback form on the website through the reference number $ref\n 
From: $namers ($email) \r";


$from = "From: Web Administrator\n";		
			 
$insert_query = "INSERT INTO cert_feedback (
date ,refnum ,respondentname ,orgname ,address ,tel ,fax ,email ,certified ,standardtype ,otherstandard ,considercertification ,noexplain ,valued ,valuednoexplain ,timelyfeedback ,queries ,ontime ,audknowledge ,audthorough ,auditcourteous ,auditpactual ,auditobjective ,auditvalue)
VALUES (
'$today','$ref','$respname','$orgname','$address','$tel' ,'$fax','$email' ,	'$certified','$standards','$otherstandards','$certified1','$explanation','$valued','$explanation2','$feedback','$queries','$ontime','$knowledge','$thorough','$courteous','$punctual','$objective','$valadding' )";

$objConnect->setQuery($insert_query);
$result = $objConnect->query();
if($result)
{
 //if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] //) ) {
 //mysql_query($insert_query); 
	$msg =  " <div id='floatMess'><img id='close_message' style='float:right;cursor:pointer'  src='images/cross.png' />
      Thank you for taking time to fill this form. <br>Your feedback is valuable to us.<br>Your reference Number is $ref </div>";
      
mail("kibiiw@kebs.org", $subject, $message, $from);//unset($_SESSION['security_code']);
  // } else {
		// Insert your code for showing an error message here
		//$msg=  'Sorry, you have provided an invalid security code';
   }
  /**   else
  {
	$msg="<div id='floatMess'><img id='close_message' style='float:right;cursor:pointer'  src='images/cross.png' />
      Your message Goes here <br>".mysql_error()."
 </div>";  
 
 echo $msg;
 return;
  }**/
}	



		
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >
      	   
   	    <fieldset style="padding:2px 2px 2px 2px; border-style:solid; border-width:1px">
		
		<div style="font-weight:bold"><fieldset style="color:#006699;font-size:12pt; background-color:#CCCCCC; text-align:center; border-color:#000000; border-width:1px"><div>
		  <div>KENYA BUREAU OF STANDARDS (KEBS) CERTIFICATION BODY (CB)<br />
<span style="font-weight:100; font-size:10pt; text-align:center">QUESTIONNAIRE FOR CUSTOMER FEEDBACK</span></div>
		</div>    
		</fieldset>
        </div>

 <fieldset style="padding-top:1px; padding-left:3px;border-color:#000000; border-width:1px; vertical-align:middle">
 
		   	    <table width="100%"  border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td  valign="middle" style="color:#000000">
					<div align="left" style="display:inline; float:left; font-weight:bold; vertical-align:baseline">
					<?php
					$today = date("F j, Y");
					echo  "$today";
					echo $msg; 
					?>
                     </div>
					<div style="display:inline; float:right">
					Reference Number:&nbsp;
				
					<input name="Reff_id" type="text" id="Reff_id"  style="text-align:center;color:#000; font-weight:bold" value="<? generate_id(); ?>" size="11" readonly/>
					
					</div></td>
                  </tr>
        </table>
   	    </fieldset>
 <fieldset style="padding-top:3px; padding-left:3px;border-color:#000000; border-width:1px">
 <legend style="color:#0066CC"><strong>SECTION A (OPTIONAL): CUSTOMER DETAILS</strong></legend>
		   	    <table width="100%" border="0" cellspacing="3" cellpadding="2">
                  <tr>
                    <td width="20%"> Name of Respondent: </td>
                    <td width="80%"><input name="respname" id="respname"   size="55"/></td>
                    </tr>
                  <tr>
                    <td>Name of organization: </td>
                    <td><input name="orgname" id="orgname"  size="55" /></td>
                  </tr>
                  <tr>
                    <td> Postal Address: </td>
                    <td><textarea name="postaladdress" cols="35" rows="2" id="postaladdress"></textarea></td>
                  </tr>
                   
                    <tr>
                    <td>Telelephone Number: </td>
                    <td><input name="telephoneno" type="text" id="telephoneno" size="15" /></td>
                    </tr>
                    
                    <tr>
                    <td>Email Address: </td>
                    <td> <input name="email" type="email" id="email" size="25" /></td>
                    </tr>
<tr><td>Fax Number: </td><td>
                    <input name="fax" type="text" id="fax" size="12" /></td>
                  </tr>
                </table>
	<fieldset style="border-color:#000000; border-width:1px">
	<legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC"><strong>SECTION B: INFORMTION ON CERTIFICATION SYSTEM</strong></legend>
	
	
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td  valign="top">Is your Management System certified by the KEBS Certification Body ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="certified" type="radio" value="No" id="nei" class="aboveage2">No
        &nbsp;&nbsp;&nbsp;
        <input name="certified" type="radio" value="Yes" id="yes" class="aboveage2">
Yes 
          <blockquote>
            
            <fieldset id="parent2" style="border:none"> 
			<legend><span style="color:#FF0000; font-weight:bold">If yes, to what standard ?</span></legend>
                <input style="float:left" name="standards[]" type="checkbox" id="standards[]" value="ISO 9001">&nbsp;
                ISO 9001<br>
                <input style="float:left" type="checkbox" name="standards[]" value="ISO 14001"> &nbsp;
                ISO 14001<br>
                <input style="float:left" type="checkbox" name="standards[]" value="ISO 22000"> &nbsp;
                ISO 22000<br>
                <input style="float:left" type="checkbox" name="standards[]" value="HACCP"> &nbsp;
                HACCP 
                <br />
                <input style="float:left" type="checkbox" name="standards[]" value="OHSAS" />&nbsp;
                OHSAS<br />
                <input style="float:left" type="checkbox" name="standards[]" value="Other Standards" />
                Other, Specify <br />
                <input name="otherstandards" type="text" id="otherstandards" size="25" />
                <br />
              </fieldset>
              <fieldset  id="parent3" style="border:none"> 
			<legend  style="border:none"><span style="color:#FF0000; font-weight:bold">If NO, would you consider KEBS certification? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="certified1" type="radio" value="No" class="aboveage1"/>
                Yes
        &nbsp;&nbsp;&nbsp;
        <input name="certified1" type="radio" value="Yes" class="aboveage1"/>
         No
</span></legend> 
<span style="color:#333333; font-weight:bold" id="parent4">(If yes, it is mandatory you complete <b>"section A"</b> to enable us contact you) </span><br/><span style="color:#333333; font-weight:bold" id="parent5">If no, Kindly explain<br /><textarea name="explanation" cols="45" rows="1" id="explanation" style="font-size:10pt;color:#000"></textarea></span></fieldset>

          </blockquote></td>
        </tr>
      
    </table>
	</fieldset>	   	    
	<fieldset style="border-color:#000000; border-width:1px">
	<legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC"><strong>SECTION C: CUSTOMER CARE</strong></legend>
	
	
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="18%">When interacting with staff of the KEBS Certification Body: Do you feel valued ? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="interact" type="radio" value="No" class="aboveage1"/>
No
        &nbsp;&nbsp;&nbsp;
        <input name="interact" type="radio" value="Yes" class="aboveage1"/>
Yes <br />
         <span id="parent6"> If NO, please explain<br />          <textarea name="explanation2" cols="45" rows="1" id="explanation2" style="font-size:10pt;color:#000"></textarea></span></td>
      </tr>
      <tr>
        <td>Do you receive timely feedback when you communicate with us ? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="feedback" type="radio" value="No" />
No
        &nbsp;&nbsp;&nbsp;
        <input name="feedback" type="radio" value="Yes" />
Yes </td>
      </tr>
      <tr>
        <td>Do you get adequate information for any queries you make to the Certification Body ? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="queries" type="radio" value="No" />
No
        &nbsp;&nbsp;&nbsp;
        <input name="queries" type="radio" value="Yes" />
Yes </td>
      </tr>
     <!-- <tr>
        <td>Attach CV </td>
        <td><input name="cv" type="file" id="file" size="35" /></td>
        </tr>-->
    </table>
	</fieldset>	
	<fieldset style="border-color:#000000; border-width:1px">
	<legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC"><strong>SECTION D: COMPETENCE </strong>:</legend>
	
	
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="32%">Are Surveillance / Certification Audits carried out on time?  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="ontime" type="radio" value="No" />
No
        &nbsp;&nbsp;&nbsp;
        <input name="ontime" type="radio" value="Yes" />
Yes </td>
        </tr>

      <tr>
        <td>Concerning KEBS CB auditors, are they:
          <table width="57%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: center"> Yes&nbsp;</td>
              <td style="text-align: center">No</td>
            </tr>
            <tr>
              <td width="82%">Knowledgeable of basis documents?</td>
              <td width="8%" style="text-align: center"><input name="knowledge" type="radio" value="Yes" /></td>
              <td width="10%" style="text-align: center"><input name="knowledge" type="radio" value="No" /></td>
            </tr>
            <tr>
              <td>Thorough?</td>
              <td style="text-align: center"><input name="thorough" type="radio" value="Yes" /></td>
              <td style="text-align: center"><input name="thorough" type="radio" value="No" /></td>
            </tr>
            <tr>
              <td>Courteous and respectful</td>
              <td style="text-align: center"><input name="courteus" type="radio" value="Yes" /></td>
              <td style="text-align: center"><input name="courteus" type="radio" value="No" /></td>
            </tr>
            <tr>
              <td>Punctual</td>
              <td style="text-align: center"><input name="punctual" type="radio" value="Yes" /></td>
              <td style="text-align: center"><input name="punctual" type="radio" value="No" /></td>
            </tr>
            <tr>
              <td>Objective</td>
              <td style="text-align: center"><input name="objective" type="radio" value="Yes" /></td>
              <td style="text-align: center"><input name="objective" type="radio" value="No" /></td>
              </tr>
            <tr>
              <td>Value adding to the system</td>
              <td style="text-align: center"><input name="valadding" type="radio" value="Yes" /></td>
              <td style="text-align: center"><input name="valadding" type="radio" value="No" /></td>
            </tr>
          </table></td>
        </tr>
     <!-- <tr>
        <td>Attach CV </td>
        <td><input name="cv" type="file" id="file" size="35" /></td>
        </tr>-->
    </table>
	</fieldset>	
		 <!--<fieldset style="padding-top:3px; padding-left:3px;border-color:#000000; border-width:1px">
 <legend style="color:#0066CC"><strong>Security code  - This guards against  robotic code</strong></legend>  
 <table width="100%" border="0" cellspacing="0" cellpadding="2">
   <tr>
              <td colspan="2"><img src="includes/CaptchaSecurityImages.php?width=100&height=40&characters=5" align="absmiddle" />&nbsp;&nbsp;
		<label for="security_code">Security Code: </label><input id="security_code" name="security_code" type="text" /> 
		<? //echo $_SESSION['security_code'] ?></td>
    </tr>
            <tr>
              <td colspan="2">Thank you for taking time to fill this form. Your feedback is valuable to us.</td>
            </tr>
</table>

 </fieldset>
		   	   </p>--><br />
<div style="padding-top:0px" align="center"><input type="hidden" id="action" name="action" value="submitfbform" /><input type="submit" name="Submit" value="Submit Form">
  <input name="resetb" type="reset" id="resetb" value="Reset form" />
</div>
				<span style="float:left">HUR/OP/01/F1</span>													<span style="float:right">1/1</span>
               
    </form>
   	    

	   
	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>