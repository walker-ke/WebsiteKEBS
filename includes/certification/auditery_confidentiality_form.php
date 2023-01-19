<?

$msg="";

if(isset($_POST['action'])&& $_POST['action'] == 'submitform')
		{
		$email='certification@kebs.org';
               // $email='kibiiw@kebs.org';
		$auditor=$_REQUEST['proposed_auditor'];
		$org=$_REQUEST['organization'];
		$to = $email;
                $subject = "Auditor Confidentiality Form Submision";
		$criteria =$_REQUEST['criteria'];
		$scheme =$_REQUEST['schemes'];
		$date1 =$_REQUEST['date1'];
		$date2 =$_REQUEST['date2'];
		$audittype =$_REQUEST['audit-type'];
		$relation =$_REQUEST['relationship'];
		$employed =$_REQUEST['employed'];
		$mngt =$_REQUEST['mngt'];
		$business =$_REQUEST['business'];
		$assurance =$_REQUEST['assurance'];
		$contract =$_REQUEST['contract'];
		$description1 =$_REQUEST['description1'];
		$declaration =$_REQUEST['declaration'];
		//$criteria =$_REQUEST['criteria'];


 
$insert_query = "INSERT INTO `auditors` ( 
`id`,`auditor_name` ,`org` ,`schemes` ,`date1` ,`date2` ,`audit_type` ,`relationship` ,`employed` ,`mngt` ,`business` ,`assurance` ,`contract` ,`descriptin1` ,`declaration` )
	VALUES 
('' , '$auditor', '$org', '$scheme', '$date1', '$date2', '$audittype', '$relation', '$employed', 	'$mngt', '$business', '$assurance', '$contract', '$description1', '$declaration')";


	mysql_query($insert_query);	
	  $msg = "Submitted sussecfully";
	
        



		 $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";// More headers
		$headers .= 'From: <certification@kebs.org>' . "\r\n";
		$headers .= 'Cc: kibiiw@kebs.org' . "\r\n";
		$headers .= 'BCc: wkibii@gmail.com' . "\r\n";
		
		mail($email,$subject,$message,$headers);
		  $msg = "Submitted sussecfully, <br>Your iformation has been saved to database an a mail sent to  ".$to;
		 // $msg =$insert_query;
	 
		}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 
    <td><form id="form1" name="form1" method="post" action="default.php?view=confidentiality_form" >
      	   
   	    <fieldset style="padding:2px 2px 2px 2px; border-style:solid; border-width:1px">
		
		<div style="font-weight:bold"><fieldset style="color:#006699;font-size:14px; background-color:#CCCCCC; text-align:center; border-color:#000000; border-width:1px"><div>KENYA BUREAU OF STANDARDS<br>
MANAGEMENT SYSTEM CERTIFICATION</div><div style="font-size:9pt">CER/F/09: Declaration of confidentiality, impartiality and potential Conflict of interest</div></fieldset></div>
<div style="color:#FF0000; width:400px" ><? echo $msg; ?><br /><? echo $audittype; ?></div>
 <fieldset style="padding-top:3px; padding-left:3px;border-color:#000000; border-width:1px"><legend style="color:#0066CC"><strong>Section One: To be completed by the Proposed auditor</strong></legend>
		   	    <table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td width="44%">Name  of Proposed Auditor/Technical Expert: </td>
                    <td width="56%"><input name="proposed_auditor" type="text" id="proposed_auditor" size="40"></td>
                  </tr>
                  <tr>
                    <td>Name  of Organization to be audited: </td>
                    <td><input name="organization" type="text" id="organization" size="40"></td>
                  </tr>
                  <tr>
                    <td>Criteria  (basis) for the audit: </td>
                    <td><input name="criteria" type="text" id="criteria" size="40"></td>
                  </tr>
                  <tr>
                    <td>Schemes  to be audited: </td>
                    <td><input name="schemes" type="text" id="schemes" size="40"></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="middle">Audit  dates: 
                    <INPUT name="date1" id="date1" onclick="displayDatePicker('date1', this);" size="12" readonly=""> 
      to 
      <input name="date2" id="date2" onclick="displayDatePicker('date2', this);" size="12" readonly="" />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type  of audit: 
                    
                    <select name="audit-type" id="audit-type">
                      <option>ISO 9001:2008</option>
                      <option>ISO 27001</option>
                      <option>ISO 20000</option>
                      <option>ISO 14001&nbsp;EMS</option>
                      <option>ISO 22001 HACCP </option>
                      <option>ISO 22000 FSMS</option>
                      <option>OHSAS 18001</option>
                      <option>KNWA 01:2009</option>
                    </select>
                    </td>
                  </tr>
                </table>
   	    </fieldset>
	<fieldset style="border-color:#000000; border-width:1px"><legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC">Declaration:</legend>
	
	
	<table width="100%" border="0" cellspacing="3" cellpadding="2">

      <tr>
        <td width="100%">The  following constitute potential threats to impartiality. Please check (
          
          <input type="radio" checked value="no" name="contract" style="vertical-align:bottom">
          ) as appropriate against each.<br>
          Within  the last 24 months, have you:</td>
        </tr>

      <tr>
        <td><p>(i) had a personal relationship with a staff member of the organization? &nbsp;&nbsp;
            <input name="relationship" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;
          <input name="relationship" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          (ii) been employed by the organization? &nbsp;&nbsp;
          <input name="employed" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;
          <input name="employed" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          (iii) provided management system training and/or consultancy for the organization? 
          <input name="mngt" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;
          <input name="mngt" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;<br>
          (iv) had a business/commercial relationship with the organization? &nbsp;&nbsp;
          <input name="business" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;&nbsp;
          <input name="business" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          (v) carried out KEBS quality assurance activities in the organization?  &nbsp;
          <input name="assurance" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="assurance" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          (vi) had any other contact with the organization? &nbsp;
          <input name="contract" type="radio" value="yes" />
          <span class="style1">Yes</span> &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="contract" type="radio" value="no" />
          <span class="style1">No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
        </tr>
      <tr>
        <td>(If you&rsquo;ve ticked &lsquo;YES&rsquo;, under any of the above, briefly describe the nature of contact or potential threat:<br />
          <br>
          <textarea name="description1" cols="60" rows="3" id="description1"></textarea>
		  <div>
		    <p>If no threat to impartiality is found check the following option,<br>
		      <div style="display:inline">
		        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="38" valign="top"><input name="declaration" type="checkbox" id="declaration" value="agree"></td>
                    <td valign="top">I declare that I shall be impartial and treat all information obtained during and after the audit in a confidential manner.                      </td>
                  </tr>
                </table>
            </div>	        </td>
      </tr>
    </table>
	</fieldset>	   	    
	
		   	   &nbsp;</p>
				<span style="float:left">CER/F/09 Rev.2</span>													<span style="float:right">1/1</span><div style="padding-top:0px; text-align:center"><input type="hidden" id="action" name="action" value="submitform" /><input type="submit" name="Submit" value="Submit Form">
    </form>
   	    

	   
	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>