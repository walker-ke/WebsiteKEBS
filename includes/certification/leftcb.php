<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_GET['view'])) {
  $myview = $_GET['view'];
} 
?>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><img src="images/kebs-cb.gif"  width="160" height="105"/></td>
  </tr>
  <tr>
      <td valign="top" class="right_padding_bottom2">
          <div align="right"><img src="images/banner_iso_9001.gif" alt="banner" width="160" height="130" /></div></td>
  </tr>

</table>-->
<div align="right"><img src="images/banner_iso_9001.gif" alt="banner" width="160"  /></div>
<hr />
<?php

if ($myview=='schemes'||$myview=='qms'||$myview=='isms'||$myview=='fsms'||$myview=='ohsas'||$myview=='ems'||$myview=='knwa'||$myview=='fssc'||$myview=='haccp'||$myview=='energy'||$myview=='itms'||$myview=='isms'){
    ?>
<div class="dhtmlgoodies_question">
<!--           <div style="padding-top:2px; font-size: 10pt; font-weight: bold">Certification Schemes on </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href=""><strong>ISO 9001:2008&nbsp; QMS</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href=""><strong>ISO 14001&nbsp;EMS</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=isms"><strong>ISO 27001&nbsp;</strong></a> </div> 
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<strong><a href="">HACCP </a></strong></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<strong><a href="index.php?opt=certification&view=fsms">ISO 22000 FSMS</a></strong></div>
  <div style="padding-top:2px"> &nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ohsms"><strong>OHSAS 18001</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=knwa"><strong>KS 2573</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fssc"><strong>FSSC</strong></a></div>
  -->
  <div style="padding-top:2px; font-size: 10pt; font-weight: bold">Certification Schemes </div>
   <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ems"><strong>ISO 14001 (EMS)</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fsms"> <strong>ISO 22000 (FSMS)</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=qms"> <strong>ISO 9001 - QMS </strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ohsas"><strong>ISO 18001 - OHSAS</a></strong></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=knwa"><strong>KS 2573</a></strong></div>
 <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fssc"><strong>FSSC</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=energy"><strong> ISO 50001- Energy </strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=isms"> <strong>ISO 27001 ISMS</a></strong></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=itms"><strong> ISO 20000 ITMS</a></strong></div>       
         </div>   
<?php
}
if ($myview=='cert_process'||$myview=='certified_firms'||$myview=='qms_firms'||$myview=='ems_certfirms'||$myview=='haccp_certfirms'||$myview=='fsm_certfirms'||$myview=='knwa_certfirms'||$myview=='ohsms_certfirms'||$myview=='fssc_certfirms'||$myview=='energy_certfirms'||$myview='fssc_certfirms'){
    ?>
<div style="padding-top:2px; font-size: 11pt; color: #000; font-weight: bold">Certified Firms Lists </div>
<div class="dhtmlgoodies_question">
<!--  <div style="padding-top:2px; font-size: 11pt; color: #000; font-weight: bold">Certified firms on </div>-->
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=qms_firms"><strong>ISO 9001&nbsp; QMS</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ems_certfirms"><strong>ISO 14001&nbsp;EMS</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=isms_firms"><strong>ISO 27001&nbsp;</strong></a> </div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=haccp_certfirms"><strong> HACCP </a></strong></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fsm_certfirms"><strong>ISO 22000 FSMS</a></strong></div>
  <div style="padding-top:2px"> &nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=ohsms_certfirms"><strong>OHSAS 18001</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=knwa_certfirms"><strong>KS 2573</strong></a></div>
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=fssc_certfirms"><strong>FSSC</strong></a></div>
 
 <!--
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=suspended_firms"><strong>Suspended Firms</strong></a></div>
 -->
          
</div> 

<!--
<div style="padding-top:2px; font-size: 11pt; color: #000; font-weight: bold">Suspended Firms </div>
<div class="dhtmlgoodies_question">
  <div style="padding-top:2px">&nbsp;&nbsp;&rArr;<a href="index.php?opt=certification&view=suspended_firms"><strong>List Firms</strong></a></div>        
</div> 
-->   
   
   <div style="padding-top:2px; font-size: 11pt; color: #000; font-weight: bold">Certification Policies </div>
<div class="dhtmlgoodies_question">

  <div style="padding-top:2px">
    <ul type="square">
      <li >&rArr;
        <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_1 USE OF MARKS_REV 1-30 NOV. 2015.pdf" style="color:#ff0000; ">
        <strong>
        Use Of Marks
      </strong></a></li>
      <li>&rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_2 CONFIDENTIALITY_ REV.0 - 30 NOV. 2015.pdf" style="color:#ff0000; "> <strong> Confidentiality </strong></a></li>
      <li><a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_1 USE OF MARKS_REV 1-30 NOV. 2015.pdf" style="color:#ff0000; ">
        </a>
      &rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_3 CERTIFICATION FEES AND TERMS OF PAYMENT_Rev 01_30.11.2015.pdf" style="color:#ff0000; "> <strong> Certification Fees and Terms of Payment </strong></a>&nbsp;</li>
      <li>&rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_4 HANDLING NONCONFORMITIES_Rev 1 - 30 NOV. 2015.pdf" style="color:#ff0000; "> <strong> Handling Audit Nonconformities </strong></a>&nbsp;&nbsp;</li>
      

      
      <li>&rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_5 GRANT_REFUSE_MAINTAIN_RENEW_SUSPEND_RESTORE_WITHDRAW_EXPAND_REDUCE SCOPE OF CERTIFICATION Rev 02_30 11 2015.pdf" style="color:#ff0000; "> <strong>Granting, Refusing, Maintaining, Renewing, suspending, Restoring, Withdrawing, Expanding and Reducing of scope of certification </strong></a>&nbsp;&nbsp;</li>
      <li>&rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_6 MANAGEMENT OF IMPARTIALITY_Rev 2-20-01-2017.pdf" style="color:#ff0000;"> <strong> Management of Impartiality </strong></a></li>
     <li>&rArr; <a href="sqmt/certification/cb_downloads/download.php?file=CER_POL_7- RETENTION OF CLIENT CERTIFICATION RECORDS- Rev. 00- 20 Jan. 2....pdf" style="color:#ff0000;"> <strong> Retention of Certification Records </strong></a></li>
    </ul>
  </div>
  NB: Click on the respective polices above to download.
</div> 
<?php
}

 else {
     ?>
<hr />
   <table width="160" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><img src="images/rva_logo.png"  height="105"/><br>
        <span style="font-weight:700; color:#0066FF; text-align:left;width:160px">
		Accredited to <b>ISO 17021:2011</b> by the Dutch Accreditation Council, RVA. </br>
		For More Information <a href="http://www.rva.nl"> <u><br>Click Here for RVA info</u>.</a><br>
	</span>	</td>
  </tr>
</table>
<?php
}
?>