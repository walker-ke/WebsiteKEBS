<?php 
include("../connection.php"); 
include("includes/lib.php"); 
//include("../connection.php"); 
///Connect to Database
//mysql_connect("localhost", "sql_kebs", "datakebs") or die(mysql_error()); 
//mysql_select_db("kebs") or die(mysql_error()); 
?>

<table width="100%" border="0" cellpadding="3" cellspacing="0">

  <tr>
  <?
  if (($_REQUEST['searchfirm']!='') AND ($_REQUEST['certificate_no']!=''))
  {
  echo '<td width="570" colspan="5">
  <span style="font-size:10pt; font-weight:bold">Type something
        								?>
    </span></td>';
  }
  else
  {
  ?>
    <td width="570" colspan="5"><span style="font-size:10pt; font-weight:bold">Search results for
        <? 
		if ($_REQUEST['searchfirm']!='')
		{
		echo ' Company "'.$searchfirm=$_REQUEST['searchfirm'].'"';
		}
		if ($_REQUEST['certificate_no']!='')
		{
		echo ' Certificate No. "'.$certificate_no=$_REQUEST['certificate_no'].'"';
		}
		/*else
		{	
		
		}*/										?>
    </span></td>
	
  </tr>
  <tr>
    <td colspan="5">
	 <?php
	/*if ($_REQUEST['scheme']=='Select certification'){
	echo "Select cetification type";
	}
	else
	{*/
$searchfirm = $_REQUEST['searchfirm'];

$searchscheme = $_REQUEST['scheme'];
$searchcert = $_REQUEST['certificate_no'];


///Connect to Database

mysql_connect("localhost", "wwwkebs_kebsusr","1so27oo1") or die(mysql_error()); 
mysql_select_db("wwwkebs_kebs") or die(mysql_error()); 


$query = "SELECT * FROM `certification_department`WHERE firm LIKE '%$searchfirm%' OR certificate_no LIKE '%certificate_no%'";
 
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
$rowCount = "SELECT * FROM certification_department WHERE firm like '%$searchfirm%' OR %certificate_no% = '$searchcert' ";
$serchCount = mysql_query($rowCount);
$fetch_row = mysql_fetch_row($serchCount);
$numrows = $fetch_row[0];
 //echo $rowCount;
// if there are no results
if($numrows == 0)
{
    echo 'Sorry, we have no properties that meet the given criteria at this time.';
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
    $pages .= "<a href='{$_SERVER['PHP_SELF']}?pageno=1&view=$pg'>FIRST</a> | ";
    $prevpage=$pageno-1;
    $pages .= " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&view=$pg'>PREVIOUS</a> ";
}
$pages .= ' ( Page '.$pageno.' of '.$lastpage.' ) ';
if($pageno==$lastpage)
{
    $pages .= ' NEXT | LAST ';
}
else
{
    $nextpage = $pageno+1;
    $pages .= " <a href='".$_SERVER['PHP_SELF']."?pageno=$nextpage&view=$pg'>NEXT</a> | ";
    $pages .= " <a href='".$_SERVER['PHP_SELF']."?pageno=$lastpage&view=$pg'>LAST</a>";
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
		<td width='47'>  Cert No </td>
		<td width='150'>  Scope </td>
		<td width='100'>  Date of Expiry </td>
       "; 
	echo "<tr>";

 ?>      </td>
  </tr>
  <?php do { ?>
  
  <tr style="border-bottom-width:thin; border-bottom-color:#000066; border-bottom-style:dotted">
    <!--<td valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php //echo $info['id']; ?></span></td>-->
        <td width="100" valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['firm']; ?></span></td>
        <td width="90" valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['postal_address']; ?></span></td>
        <td valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['certificate_no']; ?></span></td>
        <td valign="top" width="150"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['scope']; ?></span></td>
      <td width="100"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;"><?php echo $info['expiry_date']; ?></span></td>
      <!--<td valign="top"><span style="font-family:arial,sans-serif,Halvetica;font-size:8pt;">
          <?php //echo $info['scheme']; ?>
        </span></td>-->
  </tr>
  <?php } while ($info = mysql_fetch_assoc($data)); ?>
 
 <?php  
echo "</table>"; 
//echo '<div style="width:100%; text-align: center; font-size: 8pt; color:#999;">""</div>';

//echo '<div style="width:100%; text-align: center; font-size: 8pt; color:#999;">'.$pages.'</div>';
//echo '<div style="width:100%; text-align: left; font-size: 9pt; color:#000000;"> Total number of firms: '.$numrows.'</div>';
//}
 ?>
	</td>
	<?
	}
	?>
  </tr>
</table>

