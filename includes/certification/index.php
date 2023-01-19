<style>
    .nqifooter{
        display: block;
        float: left;
        padding: 20px
    }
    .nqifooter.div{
        display: block;
        float: left;
/*        padding-left: 20px;*/
            background-color: #0066FF;
    }
    
</style>
<script src="js/left_navbar.js" type="text/javascript"></script>
<link href="css/left_navbar.css" rel="stylesheet" type="text/css" />
<link href="css/kebs.css" rel="stylesheet" type="text/css" />
<?php
if (!isset($_GET['opt'])) {
//if    (isset($_GET['opt']) && $_GET['opt'] != '')
    //{
    include '../includes/myauth.php';

    if (!CheckAccess()) {

        //show the access denied message and exit script
        header('HTTP/1.0 404 Not Found');
        echo "Access denied";

        exit;
    }
}
include("sqmt/certification/cert_link.php");
$objConnect = new connection();

//function certfirms() {
//    if ($myview=='itm_certfirms'||$myview=='qms_firms'||$myview=='ems_certfirms'||$myview=='haccp_certfirms'||$myview=='fsm_certfirms'||$myview=='knwa_certfirms'||$myview=='ohsms_certfirms'||$myview=='fssc_certfirms'||$myview=='energy_certfirms'){
//        
//    }

?>

<div class="content">

    <div class="content_resize"  >
        <table width="100%" border="0">
            <tr>
                <td style="vertical-align: top"><?php require $leftcontent; ?></td>
                <td style="padding-left: 10px;vertical-align: top; width:850px">
                    <div><?php //echo $pageTitle." ";
                            if ($view=='itm_certfirms'||$view=='qms_firms'||$view=='ems_certfirms'||$view=='haccp_certfirms'||$view=='fsm_certfirms'||$view=='knwa_certfirms'||$view=='ohsms_certfirms'||$view=='fssc_certfirms'||$view=='energy_certfirms'||$view=='certified_firms'){
        echo "";
    }
    else{
       echo '<h1 class="page_heading">'.$pageTitle.'</h1>' ;
    }
                             ?></div>
                    <div class="middlecontent"><?php require_once $content ?></div>
                </td>
                <td style="vertical-align: top"><?php require $rightcontent ?></td>
            </tr>
            <tr>
                <td colspan="3" allign="center" valign="top">
                    <hr>
                    <div class="nqifooter">

                        <strong>Physical Location:</strong><br />
                        Certification Body<br />
                        Kenya Bureau of Standards  Headquarters<br />
                        Popo Road, Off Mombasa Road<br />
                        South C area, Nairobi<br />
                        <strong>
                    </div>
                    <div class="nqifooter">
                        Postal Address:</strong><br />
                        P.O. Box 54974-00200<br />
                        Nairobi<br />
                        <strong>
                            Email &ndash; General enquiries</strong><br />
                        <a href="mailto:cbstaffkebs.org">cbstaff@kebs.org</a>
                    </div>
                    <div class="nqifooter"><strong>
                         Telephone:</strong><br />
                        
                        Office:(254 20) 6948506<br />
                        
                    </div>

                    <div class="nqifooter"><strong>
                            Specific Contacts</strong><br />
                        <strong>Caroline Outa </strong><br />
                        Head of the KEBS Certification Body<br />
                        Tel: (254 20) 6948324/263<br />
                        E-mail: <a href="mailto:outac@kebs.org">outac@kebs.org</a>
                    </div>
                        
                </td>
            </tr>
        </table>
    
    
        
        
        </div>
    
</div>
