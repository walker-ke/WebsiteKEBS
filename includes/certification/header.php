<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
KEBS</title>
<link href="../css/kebs.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/news.js"></script>
<script type="text/javascript" src="../js/search.js"></script>
<script type="text/javascript" src="../user/datetimepicker.js"></script>
<script type="text/javascript" src="../user/user.js"></script>

<link href="../css/left_navbar.css" rel="stylesheet" type="text/css" />
<script src="../js/left_navbar.js" type="text/javascript"></script>

<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<?php 
$pageactive = basename($_SERVER['SCRIPT_NAME']);
?>
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<!-- Main table wrapper start here -->
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <!-- header start -->
	<table width="106%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="55%"><img src="../images/logo.gif" alt="Kenya Bureau of Standards" width="417" height="84" /></td>
        <td width="45%" class="header">
        <ul>
        	<li><span><a href="../index.php">Home</a></span></li>
			<li><a href="http://mail.kebs.org/exchange" target="_blank">Email</a></li>
            <li><a href="../about_kebs_contacts.php">Contact us</a></li>        
            <li class="last"><a href="../sitemap.php">Site Map</a></li>
		</ul>
		</td>
      </tr>
    </table>
    <!-- header end -->
    <!-- top navbar start -->
    <table width="890" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5" valign="top"><img src="../images/nav_left_cor.gif" alt="navbar_corner_left" width="5" height="40" /></td>
        <td width="600" class="navbar"><table width="650" border="0" cellpadding="0" cellspacing="0" class="navbar_table">
            <tr valign="middle">
              <td align="center"  width="60"><a href="../about_kebs.php" <?php if ($pageactive == '../about_kebs.php') { ?>class="about_kebs_down"<?php } ?>>About Us</a></td>
              <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="0" height="40" /></td>
              <td width="60" align="center"><a href="../standards.php" <?php if ($pageactive == '../standards.php') { ?>class="standards_down"<?php } ?>>Standards</a></td>
            
              <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="0" height="40" /></td>
              
              <td width="60" align="center"><a href="../metrology.php" <?php if ($pageactive == '../metrology.php') { ?>class="metrology_down"<?php } ?>>Metrology</a></td>
              <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="1" height="40" /></td>
              <td width="144" align="center"><a href="../quality_assessment_inspection.php" <?php if ($pageactive == '../quality_assessment_inspection.php') { ?>class="quality_down"<?php } ?>>Quality Assuarance and Inspection</a></td>
              <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="1" height="40" /></td>
              <td width="47" align="center"><a href="../product_testing.php" <?php if ($pageactive == '../product_testing.php') { ?>class="product_down"<?php } ?>>Testing</a></td>
              <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="1" height="40" /></td>
			  <td width="89" align="center"><a href="default.php" <?php if ($pageactive == 'default.php') { ?>class="standards_down"<?php } ?>>Certification</a></td>
			  <td width="1" align="center" class="nav_line"><img src="../images/primarynav_separator.gif" alt="seprator" width="1" height="40" /></td>
			  <td width="124" align="center"><a href="../nqi/home.php" <?php if ($pageactive == 'home.php') { ?>class="nqi_down"<?php } ?>>Natinal Quality Institute</a></td>
              <td width="10" align="center" class="nav_line"><img src="images/primarynav_separator.gif" alt="seprator" width="1" height="40" /></td>
            </tr>
        </table></td>
        <td width="212" align="right" valign="top" class="search_form"><form >
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><select name="selectid" id="selectid" onchange="sentTo();">
                    <option value="index.php">Search</option>
                    <option  value="standardization_mark_search.php?val=sm" <?php if(array_key_exists('val', $_REQUEST))if($_REQUEST['val']=='sm') echo 'selected="selected"';?> >Standardization mark</option>
                    <option value="diamond_mark_search.php?val=dm" <?php if(array_key_exists('val', $_REQUEST))if($_REQUEST['val']=='dm') echo 'selected="selected"';?> >Diamond mark</option>
                    <option value="import_standardization_mark_search.php?val=im" <?php if(array_key_exists('val', $_REQUEST))if($_REQUEST['val']=='im') echo 'selected="selected"';?> >Import Standardization Mark</option>
					<option value="certificate_client_directory_search.php?val=cd" <?php if(array_key_exists('val', $_REQUEST))if($_REQUEST['val']=='cd') echo 'selected="selected"';?> >Certificate client Directory</option>
                </select></td>
              </tr>
            </table>
        </form></td>
        <td width="5" valign="top"><img src="../images/nav_right_cor.gif" alt="navbar_corner_right" width="5" height="40" /></td>
      </tr>
    </table>
    <!-- top navbar end -->