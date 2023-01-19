<table width="100%" hieght="100%" border="0" cellpadding="0" cellspacing="0">

          <td valign="top" ><script src="js/left_navbar.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryURLUtils.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<SCRIPT language=JavaScript src="js/date.js"></SCRIPT>
<script type="text/javascript" src="js/jquery.min.12.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/control.js"></script>
<script type="text/javascript">
var params = Spry.Utils.getLocationParamsAsObject();
</script>
<script language="javascript" src="js/fltmsgjquer.js"></script>
<script language="javascript" src="js/jquery.dimensions.js"></script>
<script language="javascript">
	var name = "#floatMess";
	var menuYloc = null;
	
		$(document).ready(function(){
			menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
			$(window).scroll(function () { 
				offset = menuYloc+$(document).scrollTop()+"px";
				$(name).animate({top:offset},{duration:500,queue:false});
			});
			
			$('#close_message').click(function()
			{
  			$(name).animate({ top:"+=15px",opacity:0 }, "slow");
			});
		}); 
	 </script>
     
<style type="text/css">
body {
		
	}
	#floatMess {
	position:absolute;
	top:260px;
	float:none;
	width:50%;
	border:1px solid #999;
	background-color:#456;
	color:#ccc;
	padding:5px 5px 5px 25px;
	text-align:center;
	
	
		}
		
			
</style>
<link href="css/date.css" rel="stylesheet" type="text/css" /><table   border="0" align="center" cellpadding="0" cellspacing="0">
           
            <tr>
             <td  align="center" valign="top">
			 <div id="TabbedPanels1" class="TabbedPanels">
                  <ul class="TabbedPanelsTabGroup">
                    <li class="TabbedPanelsTab" tabindex="0" >Feedback Questionnaire </li>
                    <li class="TabbedPanelsTab" tabindex="2">Enquiries, complaints and appeals form</li>
                  <li class="TabbedPanelsTab" tabindex="3">Our Feedback Procedure </li>
					<!--  <li class="TabbedPanelsTab" tabindex="4">Complaint</li>-->
                  </ul>
                <div class="TabbedPanelsContentGroup">
                  <div class="TabbedPanelsContent">
                      <?php include 'sqmt/certification/feedback.php' ?>
                  </div>
                  
				  <div class="TabbedPanelsContent">
                    <table width="100%"  height ="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                     
					  
                      <tr>
                        <td><? include 'sqmt/certification/enquiry_compliments_complaints_appeals.php' ?>
                        </td>
                      </tr>
                      
                    </table>
                  </div>
                  <div class="TabbedPanelsContent">
                    <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0">
                     
                      <tr>
                        <td class="page_overview"><div align="justify">
                          <div align="justify">
                          
                            
                            
                            <object data = "sqmt/certification/cb_downloads/CER_OP_02 PROCEDURE FOR HANDLING ENQUIRIES COMPLAINTS AND APPEALS Rev5_ ....pdf" 
type = "application/pdf"
width = "100%" height = "649px"  border="0" > 
</object>

                          </div>
                        </div>
</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="overview_in_grey">
                        </table></td>
                      </tr>
                    </table>
                  </div>
				  
               </div>
              </div></td>
            </tr>
</table>
		  
		  <script type="text/javascript">
<!--
//var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->

</script>
<script type="text/javascript"> 
<!-- 
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", {defaultTab:(params.panel ? params.panel : 0)}); 
//--> 
</script> 
		  
</td>
        </tr>
    </table>
