<link rel="stylesheet" type="text/css" href="sqmt/nqi/scripts/bootstrap/css/bootstrap.css">

<script type="text/javascript" src="sqmt/nqi/scripts/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="sqmt/nqi/scripts/jquery.js"></script>
<script language="javascript" src="js/fltmsgjquer.js"></script>
<script language="javascript" src="js/jquery.dimensions.js"></script>
<script language="javascript">
    var name = "#floatMess";
    var menuYloc = null;

    $(document).ready(function () {
        menuYloc = parseInt($(name).css("top").substring(0, $(name).css("top").indexOf("px")))
        $(window).scroll(function () {
            offset = menuYloc + $(document).scrollTop() + "px";
            $(name).animate({top: offset}, {duration: 500, queue: false});
        });

        $('#close_message').click(function ()
        {
            $(name).animate({top: "+=15px", opacity: 0}, "slow");
            window.location = "index.php?opt=nqi&view=trainingforumhandbook";
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
        width:98%;
        border:1px solid #999;
        background-color:#456;
        color:#ccc;
        padding:5px 5px 5px 25px;
        text-align:center;
        height: 250px;


    }


</style>
<link href="css/date.css" rel="stylesheet" type="text/css" />
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "Training Feed back!";
?>
<?php
$objConnect = new connection();

function generate_id() {
    print "KEBS" . rand(1, 1000000);
	//$applicantid=mysql_query("SELECT id FROM job_adverts WHERE id = $id");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$objConnect = new connection();
	

$msg = "";

if (isset($_POST['action']) && $_POST['action'] == 'submitfbform') {

    $today = date("F j, Y");
    $orgnature = $_REQUEST['orgnature'];
    $role = $_REQUEST['role'];
    $learn = $_REQUEST['learn'];

    $conf_quality = $_REQUEST['conf_quality'];
    $Usefulness = $_REQUEST['Usefulness'];
    $expectations = $_REQUEST['expectations'];
    $Duration = $_REQUEST['Duration'];
    $Organization = $_REQUEST['Organization'];
    $reg_process = $_REQUEST['reg_process'];
    $materials = $_REQUEST['materials'];
    $schedule = $_REQUEST['schedule'];
    $Secretariat = $_REQUEST['Secretariat'];
	
    $quality_journey = $_REQUEST['quality_journey'];
    $multi_mngt_systems = $_REQUEST['multi_mngt_systems'];
    $key_changes = $_REQUEST['key_changes'];
    $risk = $_REQUEST['risk'];
    $sixsigma = $_REQUEST['sixsigma'];
    $panel = $_REQUEST['panel'];
    $auditor_competence = $_REQUEST['auditor_competence'];
    $competence_matrix = $_REQUEST['competence_matrix'];
    $checklists_reports = $_REQUEST['checklists_reports'];
    $EmergingNCs = $_REQUEST['EmergingNCs'];
    $influencingandinspiring = $_REQUEST['influencingandinspiring'];
   
    $speaker_comment = $_REQUEST['speaker_comment'];
    $proposed_speaker = $_REQUEST['proposed_speaker'];
    $suggestions = $_REQUEST['suggestions'];
    $nqi_member = $_REQUEST['nqi_member'];


    $todayis = date("F j, Y, g:i a");
      

    //$insert_query = "INSERT INTO nqi_training_feedback (`id`, `org_name`, `role`, `learnabout`, `forum_quality`, `forum_relevance`, `forum_expectation`, `forum_duration`, `forum_organization`, `forum_regprocess`, `forum_materials`, `forum_schedule`, `forum_secretariat`, `topic_certjourney`, `topic_benefits`, `topic_earlyadopters`, `topic_topmngt`, `topic_panneldisc`, `topic_audits`, `topic_culture`, `facilitators_mutuku`, `facilitators_wachira`, `facilitators_keror`, `facilitators_njoroger`, `facilitators_outa`, `facilitators_kola`, `speaker_comment`, `next_speakers`, `improvement_suggestion`, `overall_rate`, `todaydate`) VALUES ('', '$orgnature', '$role', '$learn', '$conf_quality', '$Usefulness', '$expectations', '$Duration', '$Organization', '$reg_process', '$materials', '$schedule', '$Secretariat', '$cert_journey', '$benefits', '$early_adopter', '$top_mngt', '$panel', '$audits', '$culture', '$mutuku_nqi', '$wachira_helb', '$keror_nbibottlers', '$njoroge_cemastea', '$outa_cb', '$kola_nqi', '$speaker_comment',  '$proposed_speaker', '$suggestions', '$$nqi_member','$todayis')";
$insert_query = "INSERT INTO `nqi_training_feedback` (`id`, `org_name`, `role`, `learnabout`, `forum_quality`, `forum_relevance`, `forum_expectation`, `forum_duration`, `forum_organization`, `forum_regprocess`, `forum_materials`, `forum_schedule`, `forum_secretariat`, `quality_journey`, `multi_mngt_systems`, `key_changes`, `risks`, `sixsigma`, `pannel_discussion`, `auditor_competence`, `competence_matrix`, `checklist_reports`, `emergingNcs`, `influencingandinspiring`, `speaker_comment`, `next_speakers`, `improvement_suggestion`, `nqi_membership`, `todaydate`) VALUES ('', '$orgnature', '$role', '$learn', '$conf_quality', '$Usefulness', '$expectations', '$Duration', '$Organization', '$reg_process', '$materials', '$schedule', '$Secretariat', '$quality_journey', '$multi_mngt_systems', '$key_changes', '$risk', '$sixsigma', '$panel', '$auditor_competence', '$competence_matrix', '$checklists_reports','$EmergingNCs', '$influencingandinspiring','$speaker_comment',  '$proposed_speaker', '$suggestions', '$nqi_member','$todayis')";
    

    //mysql_query($insert_query);
if (mysql_query($insert_query)) {
    //if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] //) ) {
    //mysql_query($insert_query); 
    
      $msg = " <div id='floatMess'><img id='close_message' style='float:right;cursor:pointer'  src='images/cross.png' />
      Thank you for taking time to fill this form. <br>Your feedback is valuable to us.<br></div>";
/*
      mail("kibiiw@kebs.org", $subject, $message, $from); */
//unset($_SESSION['security_code']);
    // } else {
    // Insert your code for showing an error message here
    //$msg=  'Sorry, you have provided an invalid security code';
    //}
//}

  }
  else
  {
  $msg="<div id='floatMess'><img id='close_message' style='float:right;cursor:pointer'  src='images/cross.png' />
  Submision not succesfull! <br>".mysql_error()." </div>";
  //$msg=$insert_query;
  }
  } 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <td><form action="index.php?opt=nqi&view=trainingfeedback" method="post" enctype="multipart/form-data" name="form1" id="form1" >

            <fieldset style="padding:2px 2px 2px 2px; border-style:solid; border-width:1px">

                <div style="font-weight:bold"><fieldset style="color:#006699;font-size:12pt; background-color:#CCCCCC; text-align:center; border-color:#000000; border-width:1px"><div>
                            <div>2<sup>ND</sup> NATIONAL MANAGEMENT REPRESENTATIVES FORUM 2018<br />
                                <span style="font-weight:100; font-size:10pt; text-align:center">FEEDBACK</span></div>
                        </div>    
                    </fieldset>
                </div>

                <fieldset style="padding-top:1px; padding-left:3px;border-color:#000000; border-width:1px; vertical-align:middle">

                    <table width="100%"  border="0" cellpadding="0" cellspacing="3">
                        <tr>
                            <td  valign="middle" style="color:#000000">
                                <div align="center" style="display:inline; float:left; font-weight:bold; vertical-align:baseline">
                                    <?php
                                    $today = date("F j, Y");
                                    PRINT "$today";
                                    PRINT $msg;
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset style="padding-top:3px; padding-left:3px;border-color:#000000; border-width:1px">
                    <legend style="color:#0066CC"></legend>
                    <table width="100%" border="0" cellspacing="3" cellpadding="2">
                        <tr>
                            <td width="50%">What is the nature of you organization </td>
                            <td width="50%">

                                <select name="orgnature">
                                    <option value="">Select the nature of your organization</option>
                                    <option value="Public">Public</option>
                                    <option value="Private">Private</option>
                                    <option value="NGO">NGOs</option>
                                    <option value="County Goverment">County Goverment</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>How would you best describe your role in management system within your organization</td>
                            <td>

                                <select name="role" id="role">
                                    <option value="">Select your role in management system within your organization</option>
                                    <option value="Management Representatives">Management Representatives</option>
                                    <option value="Member of the ISO core team">Member of the ISO core team</option>
                                    <option value="Auditor">Auditor</option>
                                    <option value="Functional MR">Functional MR</option>
									<option value="Other">Other, Specify</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>How did you learn about this program </td>
                            <td> <select name="learn">
                                    <option value="">Select how you learnt</option>
                                    <option value="KEBS Invitation">KEBS Invitation</option>
                                    <option value="Call from KEBS staff">Call from KEBS staff</option>
                                    <option value="Call from a friend">Call from a friend</option>
                                    <option value="Appointment from my organization">Appointment from my organization</option>
                                    <option value="Social media">Social media </option>
									<option value="Other">Other, Specify</option>
                                </select> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"><span style="font-style: italic; font-weight: bold">Please rate the following aspects of the forum  (5=Excellent; 4=Good; 3=Satisfactory; 2=Poor; 1=Very Poor)</span>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0"  class="table">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center"> Excellent;</td>
                                        <td style="text-align: center">Good</td>
                                        <td style="text-align: center"> Satisfactory</td>
                                        <td style="text-align: center">Poor</td>
                                        <td style="text-align: center"> Very Poor</td>

                                    </tr>
                                    <tr>
                                        <td >Overall quality of the forum </td>
                                        <td style="text-align: center"><input name="conf_quality" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="conf_quality" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="conf_quality" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="conf_quality" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="conf_quality" type="radio" value="1" /></td>

                                    </tr>
                                    <tr>
                                        <td>Usefulness/ relevance of the content to your work </td>
                                        <td style="text-align: center"><input name="Usefulness" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="Usefulness" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="Usefulness" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="Usefulness" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="Usefulness" type="radio" value="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>Extent to which your expectations were met</td>
                                        <td style="text-align: center"><input name="expectations" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="expectations" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="expectations" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="expectations" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="expectations" type="radio" value="1" /></td>

                                    </tr>
                                    <tr>
                                        <td>Duration of the forum </td>
                                        <td style="text-align: center"><input name="Duration" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="Duration" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="Duration" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="Duration" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="Duration" type="radio" value="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>Organization of the forum </td>
                                        <td style="text-align: center"><input name="Organization" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="Organization" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="Organization" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="Organization" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="Organization" type="radio" value="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>Forum Registration Process </td>
                                        <td style="text-align: center"><input name="reg_process" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="reg_process" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="reg_process" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="reg_process" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="reg_process" type="radio" value="1" /></td>

                                    </tr>
                                    <tr>
                                        <td>Forum materials </td>
                                        <td style="text-align: center"><input name="materials" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="materials" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="materials" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="materials" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="materials" type="radio" value="1" /></td>

                                    </tr>
                                    <tr>
                                        <td>Overall Organization of the sessions</td>
                                        <td style="text-align: center"><input name="schedule" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="schedule" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="schedule" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="schedule" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="schedule" type="radio" value="1" /></td>

                                    </tr>

                                    <tr>
                                        <td>Secretariat </td>
                                        <td style="text-align: center"><input name="Secretariat" type="radio" value="5" /></td>
                                        <td  style="text-align: center"><input name="Secretariat" type="radio" value="4" /></td>
                                        <td style="text-align: center"><input name="Secretariat" type="radio" value="3" /></td>
                                        <td style="text-align: center"><input name="Secretariat" type="radio" value="2" /></td>
                                        <td style="text-align: center"><input name="Secretariat" type="radio" value="1" /></td>

                                    </tr>
                                </table></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset style="border-color:#000000; border-width:1px">
                    <legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC"><strong>Topics of Coverage</strong></legend>

                    <span style="font-style: italic; font-weight: bold">Please rate the topics coverage  (5=Excellent; 4=Good; 3=Satisfactory; 2=Poor; 1=Very Poor)</span>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                        <tr>
                            <td>&nbsp;</td>
                            <td style="text-align: center"> Excellent;</td>
                            <td style="text-align: center">Good</td>
                            <td style="text-align: center"> Satisfactory</td>
                            <td style="text-align: center">Poor</td>
                            <td style="text-align: center"> Very Poor</td>

                        </tr>
                        <tr>
                            <td >Quality Journey - The evolving role of Management Representatives</td>
                            <td style="text-align: center"><input name="quality_journey" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="quality_journey" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="quality_journey" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="quality_journey" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="quality_journey" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Managing multiple management systems -WHICH WAY?</td>
                            <td style="text-align: center"><input name="multi_mngt_systems" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="multi_mngt_systems" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="multi_mngt_systems" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="multi_mngt_systems" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="multi_mngt_systems" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >ISO 9011:2018 Key changes</td>
                            <td style="text-align: center"><input name="key_changes" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="key_changes" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="key_changes" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="key_changes" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="key_changes" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Risk based approach from theory to routine practice</td>
                            <td style="text-align: center"><input name="risk" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="risk" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="risk" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="risk" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="risk" type="radio" value="1" /></td>

                        </tr>
                    
                        <tr>
                            <td >Achieving Improvement using the six sigma methodology - Case Study</td>
                            <td style="text-align: center"><input name="sixsigma" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="sixsigma" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="sixsigma" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="sixsigma" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="sixsigma" type="radio" value="1" /></td>

                        </tr>		
						<tr>
                            <td >Panel discussion: Disruption, Innovation and Change</td>
                            <td style="text-align: center"><input name="panel" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="panel" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="panel" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="panel" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="panel" type="radio" value="1" /></td>
                        </tr>
                        <tr>
                            <td >Achieving auditor competence while monitoring individual auditor performance, ISO 19011:requirements</td>
                            <td style="text-align: center"><input name="auditor_competence" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="auditor_competence" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="auditor_competence" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="auditor_competence" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="auditor_competence" type="radio" value="1" /></td>
						</tr>
				
						<tr>
                            <td >Auditor Competence matrix monitoring tool - Excel modelling</td>
                            <td style="text-align: center"><input name="competence_matrix" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="competence_matrix" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="competence_matrix" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="competence_matrix" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="competence_matrix" type="radio" value="1" /></td>
                        </tr>
						<tr>
                            <td >Synchronizing audit checklists and audit reports using Excel for performance monitoring and measurements</td>
                            <td style="text-align: center"><input name="checklists_reports" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="checklists_reports" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="checklists_reports" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="checklists_reports" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="checklists_reports" type="radio" value="1" /></td>
                        </tr>
							<tr>
                            <td >Emerging NC’s with Implementation ISO 9001:2015</td>
                            <td style="text-align: center"><input name="EmergingNCs" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="EmergingNCs" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="EmergingNCs" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="EmergingNCs" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="EmergingNCs" type="radio" value="1" /></td>
                        </tr>
						</tr>
							<tr>
                            <td >Influencing and inspiring quality within the organization – World Quality day activities</td>
                            <td style="text-align: center"><input name="influencingandinspiring" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="influencingandinspiring" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="influencingandinspiring" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="influencingandinspiring" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="influencingandinspiring" type="radio" value="1" /></td>
                        </tr>



                    </table>

                </fieldset>	  
<!--				
                <fieldset style="border-color:#000000; border-width:1px">
                    <legend style="font-weight:bold;border-color:#000000; border-width:1px;color:#0066CC"><strong>Facilitators</strong></legend>


                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                           <tr>
                            <td>&nbsp;</td>
                            <td style="text-align: center"> Excellent;</td>
                            <td style="text-align: center">Good</td>
                            <td style="text-align: center"> Satisfactory</td>
                            <td style="text-align: center">Poor</td>
                            <td style="text-align: center"> Very Poor</td>

                        </tr>
                        <tr>
                            <td >Dr. Cecilia Mutuku- NQI</td>
                            <td style="text-align: center"><input name="mutuku_nqi" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="mutuku_nqi" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="mutuku_nqi" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="mutuku_nqi" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="mutuku_nqi" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Mike Koech - MR QMS & Safaricom team</td>
                            <td style="text-align: center"><input name="mikekoech_saf" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="mikekoech_saf" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="mikekoech_saf" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="mikekoech_saf" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="mikekoech_saf" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Walter Otieno - NQI</td>
                            <td style="text-align: center"><input name="WalterOtieno_NQI" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="WalterOtieno_NQI" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="WalterOtieno_NQI" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="WalterOtieno_NQI" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="WalterOtieno_NQI" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Ken Kaberia HOD Enter prise risk Management Safaricom</td>
                            <td style="text-align: center"><input name="kenkaberia_saf" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="kenkaberia_saf" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="kenkaberia_saf" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="kenkaberia_saf" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="kenkaberia_saf" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Purity Wangui – KEBS CB</td>
                            <td style="text-align: center"><input name="pwangui_cb" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="pwangui_cb" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="pwangui_cb" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="pwangui_cb" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="pwangui_cb" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td >Margaret Kola – NQI</td>
                            <td style="text-align: center"><input name="kola_nqi" type="radio" value="5" /></td>
                            <td  style="text-align: center"><input name="kola_nqi" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="kola_nqi" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="kola_nqi" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="kola_nqi" type="radio" value="1" /></td>

                        </tr>
						   <tr>
                            <td >Jackline Sagwe - Liberty</td>
                            <td style="text-align: center"><input name="JacklineSagwe_Liberty" type="radio" value="5" /></td>
                            <td style="text-align: center"><input name="JacklineSagwe_Liberty" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="JacklineSagwe_Liberty" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="JacklineSagwe_Liberty" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="JacklineSagwe_Liberty" type="radio" value="1" /></td>

                        </tr>
                        <tr>
                            <td>Samuel Mwagangi - Excel PRO</td>
                            <td style="text-align: center"><input name="SamuelMwagangi_ExcelPro" type="radio" value="5" /></td>
                            <td style="text-align: center"><input name="SamuelMwagangi_ExcelPro" type="radio" value="4" /></td>
                            <td style="text-align: center"><input name="SamuelMwagangi_ExcelPro" type="radio" value="3" /></td>
                            <td style="text-align: center"><input name="SamuelMwagangi_ExcelPro" type="radio" value="2" /></td>
                            <td style="text-align: center"><input name="SamuelMwagangi_ExcelPro" type="radio" value="1" /></td>

                        </tr>


                    </table>-->
                    
                    <div style="padding-top: 28px">
                        Any specific comment on the topics?<br> <textarea name="speaker_comment" cols="70" rows="3" id="speaker_comment"></textarea>

                    </div>
                    <div style="padding-top: 28px">
                        Kindly propose any topics you would like to be covered in the next MR forum <br> <textarea name="proposed_speaker" cols="70" rows="3" id="proposed_speaker"></textarea>

                    </div>

                    <div style="padding-top: 28px">
                        Kindly provide suggestions for improvement future MR forums <br> <textarea name="suggestions" cols="70" rows="3" id="suggestions"></textarea>

                    </div>
					
                    
                    <div style="padding-top: 28px">
                        Are you a registered member of NQI?       

                        <input name="nqi_member" type="radio" value="Yes" />  Yes
                        <input name="nqi_member" type="radio" value="No" />  No
                
                    </div>
                    
                </fieldset>	


                <br />
                <div>
                    Thank you very much for your time in completing this evaluation form.
                </div>
                <div style="padding-top:0px" align="center"><input type="hidden" id="action" name="action" value="submitfbform" /><input type="submit" name="Submit" value="Submit Form">
                    <input name="resetb" type="reset" id="resetb" value="Reset form" />
                </div>

        </form>




    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
</table>