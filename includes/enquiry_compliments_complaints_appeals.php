<?php
$msg="";
$objConnect = JFactory::getDbo();
function generate_frmid()
		 {
		print "KEBS".rand(1, 1000000); 
		 //$applicantid=mysql_query("SELECT id FROM job_adverts WHERE id = $id");
		 }	
      if(isset($_POST['action'])&& $_POST['action'] == 'submitform')
		{
		
	$receivedate= date("F j, Y");
	$repname=$_POST['namers'];
	$refno=$_POST['Reff_id'];
	$telephone=$_POST['telephone'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$fax=$_POST['fax'];
	$feedbacktype=$_POST['feedbacktype'];
	$details=$_POST['details'];
	
	
		//$msg="Trying to save ";
	
		

		//$msg=$name.",".$organization.",".$company.",".$address.",".$city.",".$telephone.",".$fax.",".$email;
		
		

if($names=="")

		{ 
		$msg ="Your names cannot be empty";
		}	

if(empty($complaint))
		{ 
		$msg ="Type your complaint";
		}
/*if(empty($telephone))
{ 
$msg "Telephone number cannot be empty";
}
if(empty($email))
{ 
$msg "Email is required";
}*/

if(!$email == "" && (!strstr($email,"@") || !strstr($email,"."))) 
{
echo "<h2>Use Back - Enter valid e-mail</h2>\n"; 
//$badinput = "<h2>Feedback was NOT submitted</h2>\n";
//echo $badinput;
die ("<a href='#' onclick='history.go(-1)'> Go back! !</a> ");
}

$todayis = date("l F d, Y, h:i A");
     $say="Complaint on ";
//$attn = $areaofenqury ; 
$subject = "Customer's ".$feedbacktype." from website"; 

$message = " $todayis\n
Type of Feedback: $feedbacktype\n 
Feedback Details: $details\n 
From: $namers ($email) \r";


$from = "From: $namers\n";

$feedback="INSERT INTO enquiries_coplaints_apeals_customers (
date_received ,refno ,respondentname ,tel ,email ,address ,fax ,feedback_type ,details
)
VALUES (
'$receivedate', '$refno', '$repname', '$telephone', '$email', '$address', '$fax', '$feedbacktype', '$details'
)";

$objConnect->setQuery($feedback);
$result = $objConnect->query();
if($result){
mail("wkibii@gmail.com", $subject, $message, $from);
//mail("wkibii@gmail.com", $subject, $message, $from);
//mail("kibiiw@kebs.org", $subject, $message, $from);


$msg="Thanks $namers, your enquiry message has been sent to certification@kebs.org on ".date("l F d, Y, h:i A");;
}
else
{
$msg="Not working";
}	
		
}
?>
  
  <form action="index.php?opt=certification&view=feedback&panel=1" method="post" enctype="multipart/form-data" name="jform" id="jform" onsubmit="return validateForm_1(this);">
 
		
		<div style="font-weight:bold; width:100%"><fieldset style="color:#006699;font-size:11pt; background-color:#CCCCCC; border-color:#000000; border-width:1px; line-height:20px">
		  KENYA BUREAU OF STANDARDS (KEBS) CERTIFICATION BODY (CB)<br />
<span style="font-weight:100; font-size:10pt; text-align:center">CER/FORM/04: ENQUIRIES, COMPLIMENTS,COMPLAINTS AND APPEALS</span>
		  
		</fieldset>
        </div>
 <fieldset style="padding-top:1px; padding-left:3px;border-color:#000000; border-width:1px; vertical-align:middle">
 
		   	    <table width="100%"  border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td  valign="middle" style="color:#000000"><? echo "<div style='color:#ff0000'>".$msg."</div>"; ?>
					<div align="left" style="display:inline; float:left; font-weight:bold; vertical-align:middle">
					<? 
					$today = date("F j, Y");
					PRINT "$today";
					?>
                     </div>
					<div style="display:inline; float:right">
					Refference Number:&nbsp;
				
					<input name="Reff_id" type="text" id="Reff_id"  style="text-align:center; color:#000; font-weight:bold" value="<? generate_frmid(); ?>" size="11" readonly/>
					
					</div></td>
                  </tr>
        </table>
    </fieldset>
        <fieldset style="padding-top:1px; padding-left:3px;border-color:#000000; border-width:1px; vertical-align:middle">
    <div >
      <table width="100%" border="0">
        <tr>
          <td width="33%"><label  id='h26f7_100_label' for='h26f7_100' style='width:137px;height:22px;color:#006; font-weight:bold;'>Names of Client/ Respondent</label></td>
          <td width="67%"><input  value='' name='namers' id='h26f7_100' style='width:250px;height:20px;' /></td>
        </tr>
        <tr>
          <td valign="middle" style="color:#006; font-weight:bold">Postal Address:
            <textarea name="address" cols="20" rows="3" id="address" style="font-size:10pt;color:#000000"></textarea>
          <br></td>
          <td><table width="300" border="0" cellspacing="0" cellpadding="2">
            
            <tr>
              <td width="76" style="color:#006; font-weight:bold;">Tel. No.</td>
              <td width="216"><input name='telephone' id='telephone' style='width:150px;height:20px;' value='' size="20" /></td>
            </tr>
            <tr>
              <td style="color:#006; font-weight:bold;">Email</td>
              <td><input name='email' id='email' style='width:200px;height:20px;' value='' size="20" /></td>
            </tr>
            <tr>
              <td style="color:#006; font-weight:bold;">Fax No.</td>
              <td><input name='fax' id='fax' style='width:120px;height:20px;' value='' size="20" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2"> <fieldset style="padding-top:1px; padding-left:3px;border-color:#999999; border-width:1px; vertical-align:middle"><span style="color:#666; font-weight:bold">Type of feedback: </span>
            <label>
              <input name="feedbacktype" type="radio" id="imp"  value="Enquiry" style="color:#006; font-weight:bold"/>
           <span style="color:#006; font-weight:bold"> Enquiry  </span>          </label>
&nbsp;&nbsp;&nbsp;
<label>
  <input name="feedbacktype" type="radio" id="imp"  value="Compiment" style="color:#006; font-weight:bold"/>
  <span style="color:#006; font-weight:bold; vertical-align:middle">Compiment</span></label>
&nbsp;&nbsp;
<label>
  <input name="feedbacktype" type="radio" id="imp" value="Complaint" style="color:#006; font-weight:bold"/>
  <span style="color:#006; font-weight:bold">Complaint</span></label>
&nbsp;
<label>
  <input name="feedbacktype" type="radio" id="imp"  value="Appeal" />
  <span style="color:#006; font-weight:bold">Appeal</span></label></fieldset></td>
          
        </tr>
        <tr>
          <td colspan="2" style="color:#006; font-weight:bold;">Details<span style="color:red">
            <textarea rows='4'  class='jftextarea' name='details' id='h2877_103' style='width:520px;height:150px;font-size:12pt; color:#000'></textarea>
          </span></td>
          
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
            <tr>
              <td width="200">&nbsp;</td>
              <td width="157" height="30"><label >
                <input type="submit" name="submit" id="submit" value="Submit Form Details" class="enquiry_submit"/>
              </label>
                <input type="hidden" id="action" name="action" value="submitform" /></td>
              <td width="327"><input type="reset" name="button2" id="button2" value="Reset Form" class="enquiry_submit" /></td>
            </tr>
          </table></td>
          
        </tr>
      </table>
      <span style="float:left">CER/FORM/045</span>													<span style="float:right">1/2</span>
    </div>
  </fieldset>
  </form>

