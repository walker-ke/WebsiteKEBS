<?php 
//include("../connection.php"); 
include("includes/lib.php"); 
//include("../connection.php"); 
///Connect to Database
//mysql_connect("localhost", "sql_kebs", "datakebs") or die(mysql_error()); 
//mysql_select_db("kebs") or die(mysql_error()); 
?>

<table width="100%" border="0" cellpadding="3" cellspacing="0">

  <tr>
    <td  colspan="5"><span style="font-size:10pt; font-weight:bold">
        <? 
	
		if (isset($_GET['view'])) {
  $view = $_GET['view'];
	} 
//echo $view;
switch ($view) {
		case 'qms_firms' :
		case 'qms_firms&pageno=1':
		case 'qms_firms&pageno=2':
		case 'qms_firms&pageno=3':
		case 'qms_firms&pageno=4':
		case 'qms_firms&pageno=5':
		case 'qms_firms&pageno=6':
		case 'qms_firms&pageno=7':
		$type='qms';	
		$pg=qms_firms;
		echo 'ISO 9001:2008 Quality Management Systems ';
		break;	
			
		case 'ems_certfirms' :
		case 'ems_certfirms&pageno=2':
		case 'ems_certfirms&pageno=1':
		$type='ems';
		$pg=ems_certfirms;
		echo 'ISO 14001 Environmental Management systems';
		break;
		
		case 'fsm_certfirms':
		$type='fsm';
		$pg=fsm_certfirms;
		echo 'ISO 22000 Food Safety Management Systems';
		break;
		
		case 'haccp_certfirms':
		$type='haccp';
		$pg=haccp_certfirms;
		echo 'HACCPs';
		break;
		
		case 'knwa_certfirms':
		$type='knwa';
		$pg=knwa_certfirms;
		echo 'Hygiene in Food AND Catering Establishments';
		break;
		
		case 'ohsms_certfirms' :
		$type='ohsms';
		$pg=ohsms_certfirms;
		echo 'OHSAS 18001 Occupational Health and Safety Management Systems';
		break;
		
		case 'hpfe_certfirms' :
		$type='hpfe';
		$pg=ohsms_certfirms;
		echo 'HPFE Management Systems';
		break;
		
		case 'fssc_certfirms' :
		$type='fssc';
		$pg=fssc_certfirms;
		echo 'FSSC Certified Firms';
		
		break;
		case 'suspended_firms' :
		$type='sus';
		$pg=suspended_firms;
		echo 'Suspended Firms';
		
		break;
		case 'isms_firms' :
		$type='isms';
		$pg=isms_firms;
		echo 'ISMS Certified Firms';
				
			}
				?>
    </span></td>
	
  </tr>
  <tr>
    <td colspan="5">
	 <?php
///Connect to Database
//mysql_connect("localhost", "wwwkebs_kebsusrs", "1so27oo1") or die(mysql_error()); 
//mysql_select_db("wwwkebs_kebs") or die(mysql_error()); 
$query = "SELECT * FROM certification_department WHERE scheme = '$type' ORDER BY firm ASC";// WHERE SaleLease = 'lease'";
 
//// Prevent Injection Attack 
if(isset($_GET['pageno']))
{
    if(!is_numeric($_GET['pageno']))
    {
        echo 'Error.';
        exit();
    }
    $pageno = $_GET['pageno'];
}
else
{
    $pageno=1;
}
$queryCount = "SELECT count(*) FROM certification_department WHERE scheme = '$type' ORDER BY firm ASC";
$resultCount = mysql_query($queryCount);
$fetch_row = mysql_fetch_row($resultCount);
$numrows = $fetch_row[0];
 //echo $queryCount;
// if there are no results
if($numrows == 0)
{
    echo 'Please Use the Links on the Left to Select the Given Criteria.';
    exit();
}
 
$perPage = 20; // was 4, you want 10 items per page
$lastpage = ceil($numrows/$perPage);
$pageno = (int)$pageno;
if($pageno<1)
{
    $pageno=1;
}
elseif($pageno>$lastpage)
{
    $pageno=$lastpage;
}
 
///PAGE LINKS 
if($pageno==1)
{
    $pages .= 'FIRST | PREVIOUS ';
}
else
{
    $pages .= "<a href='{$_SERVER['PHP_SELF']}?opt=certification&pageno=1&view=$pg'>FIRST</a> | ";
    $prevpage=$pageno-1;
    $pages .= " <a href='{$_SERVER['PHP_SELF']}?opt=certification&pageno=$prevpage&view=$pg'>PREVIOUS</a> ";
}
$pages .= ' ( Page '.$pageno.' of '.$lastpage.' ) ';
if($pageno==$lastpage)
{
    $pages .= ' NEXT | LAST ';
}
else
{
    $nextpage = $pageno+1;
    $pages .= " <a href='".$_SERVER['PHP_SELF']."?opt=certification&pageno=$nextpage&view=$pg'>NEXT</a> | ";
    $pages .= " <a href='".$_SERVER['PHP_SELF']."?opt=certification&pageno=$lastpage&view=$pg'>LAST</a>";
}
 
// get and show data
$limit=' LIMIT '.($pageno-1)*$perPage.', '.$perPage;
 
$data = mysql_query($query . $limit) or die(mysql_error()); 
Print "<table width=100% border=0 cellspacing=1 cellpadding=4 style='font-family:arial,sans-serif,Halvetica;'>"; 
  
	
	 
	///Table to include property data 
	echo "<tr bgcolor=#336699 font-color=#FFFFFF cellpadding=3 valign=top style='font-family:arial,sans-serif,Halvetica;font-weight:bold;color:#ffffff;font-size:9pt;'>"; 
		echo "
      
        	<td width='87'>Firm Name</td>
		<td width='100'> Postal address </td>
		<td width='30'>  Cert No </td>
		<td width='150'>  Scope of Certification</td>
        	<td width='100'>  Date of Issue </td>
		<td width='100'>  Date of Expiry </td>
		<!--<td width='48'>  Scheme </td>-->
       "; 
	echo "<tr>";

 ?>      </td>
  </tr>
  <?php do { ?>
  
  <tr style="border-bottom-width:thin; border-bottom-color:#000066; border-bottom-style:dotted">
    <!--  <td valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php //echo $info['id']; ?></span></td>-->
    <td width="100" valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['firm']; ?></span></td>
        <td width="90" valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['postal_address']; ?></span></td>
        <td width="93" valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['certificate_no']; ?></span></td>
        <td valign="top" width="349"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['scope']; ?></span></td>
        <td width="105"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['start_date']; ?></span></td>
      	<td width="105"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['expiry_date']; ?></span></td>
      <!--<td valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;">
          <?php //echo $info['scheme']; ?>
        </span></td>-->
  </tr>
  <?php } while ($info = mysql_fetch_assoc($data)); ?>
 
 <?php  
echo "</table>"; 
//echo '<div style="width:100%; text-align: center; font-size: 8pt; color:#999;">""</div>';

echo '<div style="width:100%; text-align: center; font-size: 8pt; color:#999;">'.$pages.'</div>';
echo '<div style="width:100%; text-align: left; font-size: 9pt; color:#000000;"> Total number of firms: '.$numrows.'</div>';
 ?>
	</td>
  </tr>
</table>