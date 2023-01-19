<?php
//include("header.php");
//include("../includes/header.php");
//include("certification/configurl.php");
include("certification/cert_link.php");
//$link =curPageURL();
///Connect to Database
/*mysql_connect("localhost", "sql_kebs", "datakebs") or die(mysql_error()); 
mysql_select_db("kebs") or die(mysql_error()); */	
$fill_combo = mysql_query("SELECT distinct scheme FROM certification_department");			
?>
<script src="js/left_navbar.js" type="text/javascript"></script>
<link href="css/left_navbar.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #000066;
	font-weight: bold;
}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="breadCrumbs"><ul>

				<li><a href="index.php">Home</a></li>
		
				<li class="first">
					<span class="level">&nbsp;</span> Certification </li>
                <li class="levev">>>&nbsp;<? echo $title?></li>
          </ul>
</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="middle">
        <tr>
          <td valign="top"><table width="160" border="0" cellspacing="0" cellpadding="0">
            
            
            <tr>
              <td valign="top">
             <Div>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><img src="images/kebs-cb.gif"  width="160" height="105"/></td>
  </tr>
</table><hr />
	<span style="font-weight:700; color:#0066FF; text-align:left;">
		Accredited to <b>ISO 17021:2011</b> by the Dutch Accreditation Council, RVA. </br>
		For More Information <a href="http://www.rva.nl"> <u>Click Here</u>.</a><br>
	</span>	
	<hr/>


	 <table width="160" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td style="padding-top:5px">
				  
				  <div class="dhtmlgoodies_question"><a href="index.php?opt=certification&view=schemes">Certification Schemes </a></div>
                      <div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=qms_steps">Steps to certification </a></div>
                    <div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=application">Application process </a></div>
         <div class="dhtmlgoodies_question">
           <div style="padding-top:2px">Certified firms on </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=qms_firms"><strong>ISO 9001:2008&nbsp; QMS</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ems_certfirms"><strong>ISO 14001&nbsp;EMS</strong></a> </div>
 <!-- <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<strong><a href="index.php?opt=certification&view=haccp_certfirms">ISO 22001 HACCP </a></strong></div> -->
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<strong><a href="index.php?opt=certification&view=fsm_certfirms">ISO 22000 FSMS</a></strong></div>
  <div style="padding-top:2px"> &nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ohsms_certfirms"><strong>OHSAS 18001</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=knwa_certfirms"><strong>KNWA 01:2009</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fssc_certfirms"><strong>FSSC 22000:2013</strong></a></div>
            
         </div>                
              <!--<div class="dhtmlgoodies_question_static"><a href="default.php?view=feedback">Management </a></div>-->
			   <div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=statement">Statement of impartiality</a></div>
                    <div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=feedback">Feedback, Enquiries, Complaints and Appeals</a></div>
					<div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=confidentiality_form">Auditor Confidentiality Form</a></div>
                    <!--<div class="dhtmlgoodies_question_static"><a href="index.php?opt=certification&view=contacts">Contact us</a></div>-->
	<div class="dhtmlgoodies_question"><a href="index.php?opt=certification&view=faqs">FAQs on Certification</a></div> </td>
                </tr>
              </table></Div></td>
            </tr>
            <tr>
              <td valign="top"><table width="100%"><tr>
                <td>Company Search</td>
              </tr>
                <tr>
                  <td height="154"><form id="form1" name="form1" method="post" action="index.php?opt=certification&amp;view=search">
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                     <!-- <tr>
                        <td width="70%"><span class="style1">Cerification type </span></td>
                      </tr>
                      <tr>
                        <td> <select name="scheme">
                         <option>Select certification</option>
						  <?php //while ($get_opt = mysql_fetch_assoc($fill_combo)){?>
			  <option >
			  <? /*switch ($get_opt[scheme]){
			  					case 'qms': echo "ISO 9001:2008&nbsp; QMS";break; echo'<br>';
								case 'ems': echo "ISO 14001&nbsp;EMS";break; echo'<br>';
								case 'fsm': echo "ISO 22000 FSMS";break; echo'<br>';
								case 'haccp': echo "ISO 22001 HACCP";break; echo'<br>';
								case 'ohsms': echo "OSHAS 18001";break; 
																
								}
											*/					?>
			</option>
								
								<? // } ?>
                            </select></td>
                      </tr>-->
                      <tr>
                        <td class="style1">Firm Name </td>
                      </tr>
                      <tr>
                        <td><input name="searchfirm" type="text" id="searchfirm" /></td>
                      </tr>
                      <tr>
                        <td class="style1">Cert No </td>
                      </tr>
                      <tr>
                        <td><input name="certificate_no" type="text" id="certificate_no" /></td>
                      </tr>
                      
                      <tr>
                        <td><input type="submit" name="Submit" value="Search Firm" /></td>
                      </tr>
                      
                    </table>
                                    </form>                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="3" valign="top"><img src="images/spacer.gif" alt="spacer" width="3" height="20" /></td>
          <td width="100%" valign="top"><?php require_once $content;?></td>
          <td valign="top"><img src="images/spacer.gif" alt="spacer" width="3" height="20" /></td>
		  <?
		 
		   switch ($view)
		   {
			  					case 'qms_firms':
								case 'ems_certfirms':
								case 'fsm_certfirms':
								case 'haccp_certfirms':
								case 'knwa_certfirms':
								case 'ohsms_certfirms' :
								case 'fssc_certfirms' :
								case 'search' :
								echo "";
								break;
								
								default:
			//echo '				
		  ?>
   <td valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="right_padding_bottom"><A HREF="javascript:window.print()" class="print">Print this page</a></td>
            </tr>
            
            <tr>
              <td valign="top" class="right_padding_bottom2"><div align="right"><img src="images/banner_iso_9001.gif" alt="banner" width="150" height="130" /></div></td>
            </tr>
            
            <tr>
              <td valign="top" >&nbsp;</td>
            </tr>
            <tr>
              <td valign="top" ><table width="150" border="0" cellspacing="0" cellpadding="0">
                <tr >
                  <td class="dotted_border"><img src="images/grey_box_left.gif" alt="cor" width="11" height="29" /></td>
                  <td width="100%" class="greybox"><img src="images/downloads.gif" width="28" height="18" border="0"  align="absmiddle"/> Downloads&nbsp;</td>
                  <td><img src="images/grey_box_rt.gif" alt="cor" width="11" height="29" /></td>
                </tr>
                <tr>
                  <td class="greybox_lft">&nbsp;</td>
                  <td valign="top" class="grey_content"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                      <td valign="top"><div class="dhtmlgoodies_question_static"><strong>KEBS-CB POLICIES</strong></div> 
					  		<div class="dhtmlgoodies_question"><a href="certification/files/download.php?file=CER_POL_1_USE_OF_MARKS.pdf">CER_POL_1 Use of KEBS marks policy</a>
          </div>
                          <div class="dhtmlgoodies_question_static"><a href="certification/files/download.php?file=CER_POL_2_CONFIDENTIALITY.pdf">CER_POL_2 Confidentiality policy</a></div>
                          <div class="dhtmlgoodies_question_static"><a href="certification/files/download.php?file=CER_POL_3_CERTIFICATION_FEES_AND_TERMS_OF_PAYMENT.pdf">CER_POL_3 Certification fees and terms of payment </a></div>     
						  <div class="dhtmlgoodies_question_static"><a href="certification/files/download.php?file=CER_POL_4_HANDLING_AUDIT_NONCONFORMITIES.pdf">CER_POL_4 Handling audit nonconformities  </a></div> 
                          
						  <div class="dhtmlgoodies_question_static"><a href="certification/files/download.php?file=CER_POL_5 MAINTENANCE_SUSPENSION_TERMINATION_ANNULMENT OF CERTIFICATION.pdf">CER_POL_5 Maintenance Suspension Termination Annulment of Certification</a></div> 
                          
						  <div class="dhtmlgoodies_question_static"><a href="certification/files/download.php?file=CER_POL_6_MANAGEMENT_OF_IMPARTIALITY.pdf">CER_POL_6 Management of Impartiality</a></div>                  
                          
                          </td>
                    </tr>
                    
                  </table>                  </td>
                  <td class="greybox_right">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="bottom"><img src="images/grey_box_bt_left.gif" alt="cor" width="11" height="5" /></td>
                  <td class="greybox_botoom"><img src="images/spacer.gif" alt="spacer" width="1" height="1" /></td>
                  <td valign="bottom"><img src="images/grey_box_bt_rt.gif" alt="cor" width="11" height="5" /></td>
                </tr>
              </table>
              <div align="center"></div></td>
            </tr>
            <tr>
              <td valign="top" >&nbsp;</td>
            </tr>
            <tr>
              <td valign="top" class="right_padding_bottom2"><table width="150" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr >
                  <td class="dotted_border"><img src="images/grey_box_left.gif" alt="cor" width="11" height="29" /></td>
                  <td width="100%" class="greybox">Contact Details</td>
                  <td><img src="images/grey_box_rt.gif" alt="cor" width="11" height="29" /></td>
                </tr>
                <tr>
                  <td class="greybox_lft">&nbsp;</td>
                  <td class="grey_content"><p>Tel:254 20-6948263<br />
                      <a href="mailto:Email:outac@kebs.org">Email:outac@kebs.org</a></p></td>
                  <td class="greybox_right">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="bottom"><img src="images/grey_box_bt_left.gif" alt="cor" width="11" height="5" /></td>
                  <td class="greybox_botoom"><img src="images/spacer.gif" alt="spacer" width="1" height="1" /></td>
                  <td valign="bottom"><img src="images/grey_box_bt_rt.gif" alt="cor" width="11" height="5" /></td>
                </tr>
              </table></td>
			  <!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://localhost/kkebs/piwik/" : "http://localhost/kkebs/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://localhost/kkebs/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
			  <?
			 // ';
			  }
			  ?>
            </tr>
            
            
            
          </table>
          </td>
        </tr>
      </table>

      </td>
  </tr>
</table>