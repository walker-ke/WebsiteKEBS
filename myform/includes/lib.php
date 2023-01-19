<?php 
//=============================Library File============================
/*
 * Functin that return all schem from table certification_department
 * Used on file certificate_client_search.php
*/
function getCertificateScheme()
{
 $objConnect = new connection();
 $arrScheme = array();
 $disschemes="SELECT DISTINCT `scheme` FROM `certification_department`";
 $schemes=mysql_query($disschemes) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
 while($row = mysql_fetch_assoc($schemes))
  {
   $arrScheme[] =$row['scheme'];  
  }
  return $arrScheme;
}
/*
 * Functin that get records from table certification_department based on condition
 * Used on file certificate_client_search_result.php
*/
function getCertificateDataListing($certificatenumber, $firm, $schemeorstandard, $licencescope,$fromlimit='', $maxresults='' , $type='')
{
 $arrScheme = array();
 $addSql = '';
 $chkUser = '';
 $objConnect = new connection();
 if($schemeorstandard == 'Scheme or standard')
 {
  $schemeorstandard = '';
 } 
	if($certificatenumber != '' && $firm != '' && $schemeorstandard != '' && $licencescope != '')
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' and firm like '%".$firm."%' and  scheme like '%".  $schemeorstandard."%' and scope_of_certification like '%".$licencescope."%'";
	}
	elseif($certificatenumber != '' && $firm != '')
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' and firm like '%".$firm."%' ";
	}
	elseif($certificatenumber != '' && $firm != '' && $schemeorstandard != '')
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' and firm like '%".$firm."%' and  scheme like '%".              $schemeorstandard."%' ";
	}
	elseif($certificatenumber != '' && $schemeorstandard != '' )
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' and scheme like '%".$schemeorstandard."%' ";
	}
	elseif($certificatenumber != '' && $schemeorstandard != '' && $licencescope != '')
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' and  scheme like '%".$schemeorstandard."%' and  scope_of_certification like '%".$licencescope."%'";
	}
	elseif($certificatenumber != '' && $licencescope != '')
	{
	$addSql = " WHERE certificate_no like '%".$certificatenumber."%' and scope_of_certification like '%".$licencescope."%'";
	}elseif($firm != '' && $schemeorstandard != ''){
	 $addSql = " WHERE firm like '%".$firm."%' and scheme like '%".$schemeorstandard."%'";
	}elseif($firm != '' && $licencescope != ''){
	 $addSql = " WHERE firm like '%".$firm."%' and scope_of_certification like '%".$licencescope."%'";
	}elseif($certificatenumber != '')
	{
	 $addSql = " WHERE certificate_no like '%".$certificatenumber."%' ";
	}elseif($firm != ''){
	 $addSql = " WHERE firm like '%".$firm."%' ";
	}elseif($schemeorstandard != ''){
	 $addSql = " WHERE scheme like '%".$schemeorstandard."%' ";
	}
	elseif($licencescope != ''){
	 $addSql = " WHERE scope_of_certification like '%".$licencescope."%' ";
	}
	if($type=='paging')
	{
	 $chkUser =" SELECT * FROM `certification_department` ".$addSql."  LIMIT $fromlimit, $maxresults";
	}
	else
	{
	 $chkUser =" SELECT * FROM `certification_department` $addSql ";
	}
 $userRecord=mysql_query($chkUser) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
 if (mysql_num_rows($userRecord))
 {
  while($row = mysql_fetch_assoc($userRecord))
  {
   $arrScheme[]=$row;
  }
 }
  return $arrScheme; 
}

/*
 * Functin that get records from table ism based on condition
 * Used on file ismoutput.php
*/
function getIsmDataListing($importer_name,$product_name, $fromlimit='', $maxresults='' , $type='')
{
 $objConnect = new connection(); 
 $arrScheme = array();
 if($importer_name != '' && $product_name != '' )
 {
  $addSql = " WHERE importer_name like '%".$importer_name."%' and product_name like '%".$product_name."%' ";
 }
 elseif($importer_name != '')
 {
  $addSql = " WHERE importer_name like '%".$importer_name."%' ";
 }
 elseif($product_name != '')
 {
  $addSql = " WHERE product_name like '%".$product_name."%' ";
 }
 else{
  $addSql = '';
 }
   if($type=='paging')
	{
	 $chkUser =" SELECT * FROM `ism` ".$addSql."  LIMIT $fromlimit, $maxresults";
	}
	else
	{
	 $chkUser="SELECT * FROM `ism` $addSql ";
	}
	$userRecord=mysql_query($chkUser) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
	
	if (mysql_num_rows($userRecord))
 {
  while($row = mysql_fetch_assoc($userRecord))
  {
   $arrScheme[]=$row;
  }
 }
 	 return $arrScheme; 
}


function userdata($companyname, $standardization_product, $fromlimit='', $maxresults='' , $type='')
{
 $objConnect = new connection();
 $arrFirmDetails = array();
 if($companyname != '' && $standardization_product != '' ){
  $addSql = " WHERE FIRMNAME like '%".$companyname."%' and PRODUCTDESC like '%".$standardization_product."%' ";
 }
 elseif($companyname != '')
 {
 $addSql = " WHERE FIRMNAME like '%".$companyname."%' ";
 }
 elseif($standardization_product != '')
 {
 $addSql = " WHERE PRODUCTDESC like '%".$standardization_product."%' ";
 }else{
  $addSql = '';
 }
	if($type=='paging')
	{
	    $chkUser =" SELECT * FROM `sm` ".$addSql."  LIMIT $fromlimit, $maxresults";
	}
	else
	{
	  $chkUser =" SELECT * FROM `sm` $addSql ";
	}
 $userRecord=mysql_query($chkUser) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__. mysql_error());
 if (mysql_num_rows($userRecord))
 {
  while($row = mysql_fetch_assoc($userRecord))
  {
   $arrFirmDetails[]=$row;
  }
 }
  return $arrFirmDetails; 
}
/*
 * Function that get records from table DMARK based on condition
 * Used on file dmarkoutput.php
*/
function getDmarkDataListing($firm_name, $product, $fromlimit='', $maxresults='' , $type='')
{
 $objConnect = new connection();
 $arrFinalData = array();
 if($firm_name != '' && $product != '' ){
  $addSql = " WHERE firm_name like '%".$firm_name."%' and product like '%".$product."%' ";
 }
 elseif($firm_name != '')
 {
  $addSql = " WHERE firm_name like '%".$firm_name."%' ";
 }
 elseif($product != '')
 {
  $addSql = " WHERE product like '%".$product."%' ";
 }else{
  $addSql = '';
 }
	if($type=='paging')
	{
	 $chkUser =" SELECT * FROM `dmark` ".$addSql."  LIMIT $fromlimit, $maxresults";
	}
	else
	{
	  $chkUser =" SELECT * FROM `dmark` $addSql ";
	}
 $userRecord=mysql_query($chkUser) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
 if (mysql_num_rows($userRecord))
 {
  while($row = mysql_fetch_assoc($userRecord))
  {
   $arrFinalData[]=$row;
  }  
 }
  return $arrFinalData; 
}


/*
 *   Function that print pagignation
 *	 Used on each search_result page 	
*/
function printPagination($numofrows,$maxresult,$page,$url='')
{

	$str='';    
	$NEXT = 'Next';
	$LAST = 'Last';
	$PREV = 'Prev';
	$FIRST = 'First';
	$numofpage =ceil($numofrows/$maxresult);   
	$start=floor(($page-1)/10)*10+1;							//$page-1;
	$end =($start+9>=$numofpage)?$numofpage:$start+9;			//$page+1;
	$prev=($start-10)>0?$start-10:1;//$page-1;
	$next =$end+1;
	$self=$_SERVER['PHP_SELF'];
	$prevpage =$page-1;
	$nextpage =$page+1;
	if($start !=1)//$prev !=0
	{
		$str .="<a href='$self?page=$prev$url'>".$FIRST."</a>&nbsp;&nbsp;";
	}
	if($page !=1)//$prev !=0
	{
		$str .="<a href='$self?page=$prevpage$url'>".$PREV."</a>";
	}
	if($numofpage>1)
	{
		for($i=$start;$i<=$end;$i++)//$i=1;$i<=$numofpage;$i++
		{
		
		if($i==$page)
		{
			$str .= "&nbsp;&nbsp;<b>$i</b>";
		}
		else
			{
			$str .= "&nbsp;&nbsp;<a href='$self?page=$i$url'>$i</a>";
			}
		}
	}
	if($nextpage <=$numofpage)//
	{
		$str .="&nbsp;&nbsp;<a href='$self?page=$nextpage$url'>".$NEXT."</a>";
	}
	if($next <=$numofpage)//$next <=$numofpage
	{
		$str .="&nbsp;&nbsp;<a href='$self?page=$next$url'>".$LAST."</a>";
	}
	if($str)
	{
		return $str;
	}
}
//***************************************************ISM*********************************************************//
//***************************************************************************************************************//
/*
 * Function to INSERT record to ISM table
*/
function insertIntoISM($POST)
{ 
 $objConnect = new connection(); 
  if(!empty ($POST))
  {
    if(isset($POST['ismId']) && $POST['ismId'] != ''){
	 $sqlInsert = " UPDATE ism set `importer_name` ='".$POST['firmname']."',`product_name`='".$POST['product']."',`product_code`='".$POST['productcode']."', `approved`='".$POST['approved']."' WHERE `id` =".$POST['ismId'];
	}else{
    $sqlInsert = " INSERT INTO ism set `importer_name` ='".$POST['firmname']."',`product_name`='".$POST['product']."',`product_code`='".$POST['productcode']."', `approved`='".$POST['approved']."'";
	}
	mysql_query($sqlInsert) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());	
  }  
}
/*
 * Function to get record from ISM table
*/
function getIsmRecordsOnId($ismId)
{
 $objConnect = new connection(); 
 $objIsmRecord = new stdClass();
  if(!empty ($ismId))
  {
    $sqlRecord="SELECT * FROM `ism` WHERE `id`=$ismId ";	
	$resRecord=mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());	
	if (mysql_num_rows($resRecord))
	{
	 $objIsmRecord = mysql_fetch_object($resRecord);	
	}
  }    
  return $objIsmRecord;
}

//************************//For Deleting the Records ISM//////////
function deletefromism($delIsmId)
{
 $objConnect = new connection();
 if(!empty ($delIsmId))
 {
 $sqlRecord="delete FROM `ism` WHERE `id`=$delIsmId ";
 mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());		
 return true;
 }else{
  return false;
 }
}

//***************************************************SM*********************************************************//
//**************************************************************************************************************//
/*
 * Function to INSERT record to SM table
*/
function insertIntoSM($POST)
{
 $objConnect = new connection(); 
  if(!empty ($POST))
  {  if(isset($POST['smId']) && $POST['smId'] != ''){
    $sqlInsert = " update sm set `FIRMNAME` ='".$POST['firmname']."',`PRODUCTDESC`='".$POST['product']."',`KSBRAND`='".$POST['brand']."', `ISSDATE`='".$POST['issuedate']."', `EXPIRYDATE`='".$POST['expirydate']."' WHERE `STDMARK` =".$POST['smId'];
	} else {
	 $sqlInsert = " INSERT INTO sm set `FIRMNAME` ='".$POST['firmname']."',`PRODUCTDESC`='".$POST['product']."',`KSBRAND`='".$POST['brand']."', `ISSDATE`='".$POST['issuedate']."', `EXPIRYDATE`='".$POST['expirydate']."'";
	}
	mysql_query($sqlInsert) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
  } 
}
/*
 * Function to get record from SM table
*/
function getsmRecordsOnId($smId)
{
 $objConnect = new connection(); 
 $objsmRecord = new stdClass();
  if(!empty ($smId))
  {
    $sqlRecord="SELECT * FROM `sm` WHERE `STDMARK`=$smId ";	
	$resRecord=mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());	
	if (mysql_num_rows($resRecord))
	{
	 $objsmRecord = mysql_fetch_object($resRecord);	
	}
  }    
  return $objsmRecord;
}
//***************************************************Dmark*********************************************************//
//*****************************************************************************************************************//
/*
 * Function to INSERT record to Dmark table
*/
function insertIntoDmark($POST)
{
 $objConnect = new connection(); 
  if(!empty ($POST))
  {  
    if(isset($POST['dmarkId']) && $POST['dmarkId'] != ''){
    $sqlInsert = " UPDATE dmark set `firm_name` ='".$POST['firmname']."',`product`='".$POST['product']."',`region`='".$POST['region']."', `issue_date`='".$POST['issuedate']."', `expiry_date`='".$POST['expirydate']."' WHERE `firm_id` =".$POST['dmarkId'];
	} else {
	$sqlInsert = " INSERT INTO dmark set `firm_name` ='".$POST['firmname']."',`product`='".$POST['product']."',`region`='".$POST['region']."', `issue_date`='".$POST['issuedate']."', `expiry_date`='".$POST['expirydate']."'";
	}
	mysql_query($sqlInsert) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
  }  
}
/*
 * Function to get record from Dmark table
*/
function getdmarkRecordsOnId($dmarkId)
{
 $objConnect = new connection(); 
 $objdmarkRecord = new stdClass();
  if(!empty ($dmarkId))
  {
    $sqlRecord="SELECT * FROM `dmark` WHERE `firm_id`=$dmarkId ";	
	$resRecord=mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());	
	if (mysql_num_rows($resRecord))
	{
	 $objdmarkRecord = mysql_fetch_object($resRecord);	
	}
  }    
  return $objdmarkRecord;
}
//***************************************************Certificate*********************************************************//
//***********************************************************************************************************************//
/*
 * Function to INSERT record to Certificate Client Directory table
*/
function insertIntoCertificate($POST)
{
 $objConnect = new connection(); 
  if(!empty ($POST))
  {  
    if(isset($POST['certificateId']) && $POST['certificateId'] != ''){
     $sqlInsert = " UPDATE certification_department set `firm` ='".$POST['firmname']."',`postal_address`='".$POST['postaladdress']."',`region`='".$POST['region']."', `certificate_no`='".$POST['certificateno']."', `scope_of_certification`='".$POST['scopecertification']."', `date_certificate_expires`='".$POST['certificationexpiry']."', `status`='".$POST['status']."', `scheme`='".$POST['scheme']."' WHERE `id` =".$POST['certificateId'];
	} else {
	 $sqlInsert = " INSERT INTO  certification_department set `firm` ='".$POST['firmname']."',`postal_address`='".$POST['postaladdress']."',`region`='".$POST['region']."', `certificate_no`='".$POST['certificateno']."', `scope_of_certification`='".$POST['scopecertification']."', `date_certificate_expires`='".$POST['certificationexpiry']."', `status`='".$POST['status']."', `scheme`='".$POST['scheme']."'";
	}
	mysql_query($sqlInsert) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
  }  
}
/*
 * Function to get record from certificate table
*/
function getcertificateRecordsOnId($certificateId)
{
 $objConnect = new connection(); 
 $objcertificateRecord = new stdClass();
  if(!empty ($certificateId))
  {
    $sqlRecord="SELECT  * FROM `certification_department` WHERE `id`=$certificateId ";	
	$resRecord=mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());	
	if (mysql_num_rows($resRecord))
	{
	 $objcertificateRecord = mysql_fetch_object($resRecord);	
	}
  }    
  return $objcertificateRecord;
}
//************************//For Deleting the Records Certificate//////////
function deletefromcertificate($delcertificateId)
{
 $objConnect = new connection();
 if(!empty ($delcertificateId))
 {
 $sqlRecord="delete FROM `certification_department` WHERE `id`=$delcertificateId ";
 mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());		
 return true;
 }else{
  return false;
 }
}

//************************//For Deleting the Records Dmark//////////
function deletefromdmark($deldmarkId)
{
 $objConnect = new connection();
 if(!empty ($deldmarkId))
 {
 $sqlRecord="delete FROM `dmark` WHERE `firm_id`=$deldmarkId ";
 mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());		
 return true;
 }else{
  return false;
 }
}
//************************//For Deleting the Records sm//////////
function deletefromsm($delsmId)
{
 $objConnect = new connection();
 if(!empty ($delsmId))
 {
 $sqlRecord="delete FROM `sm` WHERE `STDMARK`=$delsmId ";
 mysql_query($sqlRecord) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());		
 return true;
 }else{
  return false;
 }
}

function searchpvoc($hscode, $product, $fromlimit='', $maxresults='' , $type='')
{
 $objConnect = new connection();
 $arrFinalData = array();
 if($hscode != '' && $product != '' ){
  $addSql = " WHERE hs_code like '%".$hscode."%' and product_desc like '%".$product."%' ";
 }
 elseif($hscode != '')
 {
  $addSql = " WHERE hs_code like '%".$hscode."%' ";
 }
 elseif($product != '')
 {
  $addSql = " WHERE product_desc like '%".$product."%' ";
 }else{
  $addSql = '';
 }
	if($type=='paging')
	{
	 $chkUser =" SELECT * FROM `pvoc_list` ".$addSql."  LIMIT $fromlimit, $maxresults";
	}
	else
	{
	  $chkUser =" SELECT * FROM `pvoc_list` $addSql ";
	}
 $userRecord=mysql_query($chkUser) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
 if (mysql_num_rows($userRecord))
 {
  while($row = mysql_fetch_assoc($userRecord))
  {
   $arrFinalData[]=$row;
  }  
 }
  return $arrFinalData; 
}

?>