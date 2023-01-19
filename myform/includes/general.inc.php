<?php
function displayNewDetails()
{
	$sqlNews=" SELECT * FROM  news_t_newsdetails WHERE active='Y' ORDER BY `newsdate` DESC";
	$qrNews=mysql_query($sqlNews)or die(mysql_error());
	if(mysql_num_rows($qrNews)>0)
	{
		while($row=mysql_fetch_assoc($qrNews))
        {
         $newsDetails[]=$row;
		}
	}
return $newsDetails;	
}
//----------------------------------------------------------
function displayParticularNewDetails($Id)
{
	$sqlNews=" SELECT * FROM  news_t_newsdetails WHERE id='$Id'";
	$qrNews=mysql_query($sqlNews)or die(mysql_error());
	if(mysql_num_rows($qrNews)>0)
	{
		$rowdtl=mysql_fetch_assoc($qrNews);
        
	}
return $rowdtl;	
}
//----------------------------------------------------------------------

function displayallNewDetails()
	{
	$sqlNews=" SELECT * FROM  news_t_newsdetails ";
	$qrNews=mysql_query($sqlNews)or die(mysql_error());
	while($rowdtl=mysql_fetch_assoc($qrNews))
		{
	return $rowdtl;	
	}
	}
// ----------------------------------------------------------------------
function displayAllNewsDetail($fromlimit='', $maxresults='' , $type='')
{
//echo $type;
	/*$sql="SELECT * FROM news_t_newsdetails";
	$qr=mysql_query($sql)or die(mysql_error());
	if(mysql_num_rows($qr)>0)
	{
	while($row=mysql_fetch_assoc($qr))
	{
	$allNewDtl[]=$row;
	}
	}
	return $allNewDtl;*/	
	
// $objConnect = new connection();
 $arrFinalData = array();
 
	if($type=='paging')
	{
	//echo krishna;
	  $chkNews =" SELECT * FROM `news_t_newsdetails` ORDER BY `newsdate` DESC LIMIT $fromlimit, $maxresults";
	}
	else
	{
	//echo shukla;
	    $chkNews =" SELECT * FROM `news_t_newsdetails` ORDER BY `newsdate` DESC";
	}
 $newsRecord=mysql_query($chkNews) or die("ERROR IN FILE ::".__FILE__." FUNCTION NAME ::".__FUNCTION__." LINE NO ::".__LINE__.mysql_error());
 if (mysql_num_rows($newsRecord)>0)
 {
  while($row = mysql_fetch_assoc($newsRecord))
  {
    $arrFinalData[]=$row;
  }  
 }
  //echo '<pre>';print_r($arrFinalData);
  return $arrFinalData; 
}
//---------------------------------
function printPaginationGn($numofrows,$maxresult,$page,$url='')
{
	$str='';    
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
		$str .="<a href='$self?page=$prev$url'>".First."</a>&nbsp;&nbsp;";
	}
	if($page !=1)//$prev !=0
	{
		$str .="<a href='$self?page=$prevpage$url'>".Prev."</a>";
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
		$str .="&nbsp;&nbsp;<a href='$self?page=$nextpage$url'>".Next."</a>";
	}
	if($next <=$numofpage)//$next <=$numofpage
	{
		$str .="&nbsp;&nbsp;<a href='$self?page=$next$url'>".Last."</a>";
	}
	if($str)
	{
		return $str;
	}
}

function banned_pruducts()
{
$queryupdate = mysql_query("select * from banned_products ORDER BY date DESC");
//$nums=mysql_num_rows($banned);
$max=mysql_fetch_assoc($queryupdate);
$maxdate=$max['date'];

return " (Last update ".$maxdate.")";

}

function speeches()
{
$queryupdate = mysql_query("select * from speeches ORDER BY dateposted DESC");
//$nums=mysql_num_rows($banned);
$max=mysql_fetch_assoc($queryupdate);
$maxdateposted=$max['dateposted'];

return " (Last update ".$maxdateposted.")";
}

function events()
{
$queryupdate = mysql_query("select * from news_t_newsdetails where category='event' AND active=1 ORDER BY dateposted DESC");
//$nums=mysql_num_rows($banned);
$max=mysql_fetch_assoc($queryupdate);
$maxdateposted=$max['dateposted'];

return " (Last update ".$maxdateposted.")";
}

function upcoming_events()
{
$eventqueryupdate = mysql_query("select * from news_t_newsdetails where category='event' AND active=1");
//$nums=mysql_num_rows($banned);
$events=mysql_fetch_assoc($eventqueryupdate);
$eventscount=  mysql_num_rows($eventqueryupdate);
//$eventsno=$events['dateposted'];

return $eventscount;
}

function currentnews()
{
$currentnews = mysql_query("SELECT * FROM news_t_newsdetails WHERE (category='news' OR category='pvoc' OR category='press' OR category='careers')  AND active='1' ");
$cnewscount = mysql_num_rows($currentnews);

return $cnewscount;
}

function press_release()
{
$queryupdate = mysql_query("select * from the_press ORDER BY upload_date DESC");
//$nums=mysql_num_rows($banned);
$pmax=mysql_fetch_assoc($queryupdate);
$pressdateposted=$pmax['upload_date'];

return " (Last update ".$pressdateposted.")";
}

function public_notices()
{
$queryupdate = mysql_query("select * from public_notices ORDER BY date_updated DESC");
//$nums=mysql_num_rows($banned);
$notice=mysql_fetch_assoc($queryupdate);
$lastdatenotice=$notice['date_updated'];

return " (Last update ".$lastdatenotice.")";
}


function job_vacancies($newsAD)
{
    $alljobs=" SELECT * FROM  news_t_newsdetails where category='careers'  AND active='1'";

$vacancies=mysql_query($alljobs)or die(mysql_error());
$countrows=mysql_num_rows($vacancies);
 
if ($countrows ==0)
{
echo "(No vacancies available)";
}
 else {
//$queryupdate = mysql_query("select * from job_adverts where active_status=1");
 $sumOfPositions = 0;
 
$queryupdate = mysql_query("select SUM(no_positions) as no_positions  from job_adverts where Advert_id = '".$newsAD."' AND active_status=1");
//$nums=mysql_num_rows($banned);
//while($countpos = mysql_fetch_array($queryupdate)){
//$jobs=mysql_num_rows($queryupdate);
while($countpos = mysql_fetch_array($queryupdate)){

           $sumOfPositions +=  $countpos['no_positions'];

      }
$jobcount=$sumOfPositions;

if ($jobcount<=1)
{
$vacance="Vacancy";
}
elseif ($jobcount>1)
{
$vacance="Vacancies";
}


return " (".$jobcount." ".$vacance." )";
}
}

function job_closing()
{
$daysRem=mysql_query("SELECT *  FROM  news_t_newsdetails where category='careers' AND active='1'");
$Remaining_days=mysql_fetch_assoc($daysRem);
$Rem_days=$Remaining_days['days_left'];
if ($Rem_days==1)
{
$Rem_days="today midnight";

return "Closing ".$Rem_days;
}
else
{
return "Closing in the next ".$Rem_days." days";
}
}


function bids_tenders()
{
$queryupdate = mysql_query("select * from news_t_newsdetails where category='tenders' AND active=1 ORDER BY newsdate DESC");
//$nums=mysql_num_rows($banned);
$tenders=mysql_num_rows($queryupdate);
$tenderscount=$tenders;

return " ( ".$tenderscount." Bids/Tenders )";
}

function tender_closing()
{
$daysRem=mysql_query("SELECT *  FROM  news_t_newsdetails where category='tenders' AND active='1'");
$Remaining_days=mysql_fetch_assoc($daysRem);
$Rem_days=$Remaining_days['days_left'];
if ($Rem_days==1)
{
$Rem_days="today";

return "Closing ".$Rem_days;
}
else
{
return "Closing in the next ".$Rem_days." days";
}
}

function eois()
{
$queryupdate = mysql_query("select * from news_t_newsdetails where category='eoi' AND active=1 ORDER BY newsdate DESC");
//$nums=mysql_num_rows($banned);
$eoi=mysql_num_rows($queryupdate);
$eoiscount=$eoi;

return " ( ".$eoiscount." EOI )";

//.if($eoiscount==1){echo "EOI"}else{echo "EOIs"}.
}

function bids(){
    $currentbids = mysql_query("SELECT * FROM news_t_newsdetails WHERE category='eoi' OR category='tenders' AND active=1 ");
$bidsscount = mysql_num_rows($currentbids);

return $bidsscount;
}

function review_stds()
{
//$queryupdate = mysql_query("select * from review_stds");
$queryupdate = mysql_query("select distinct(draft_name) from  review_stds where active_status = 1");

//$nums=mysql_num_rows($banned);
$review=mysql_num_rows($queryupdate);
$reviewcount=$review;

return " ( ".$reviewcount." drafts )";

//.if($eoiscount==1){echo "EOI"}else{echo "EOIs"}.
}

function adoption_frms()
{
$queryupdate = mysql_query("select distinct(title) from  adoption_forms where active_status = 1");
//$nums=mysql_num_rows($banned);
$adoption=mysql_num_rows($queryupdate);
$adoptioncount=$adoption;

return " (".$adoptioncount." forms)";

//.if($eoiscount==1){echo "EOI"}else{echo "EOIs"}.
}

function visitor()
{
$queryupdatevisit = mysql_query("select * from `t_log_visit`  ORDER BY idvisit DESC");

$visitors=mysql_num_rows($queryupdatevisit);
$visitscount=$visitors;

return "  ".$visitscount." Visits";
}

function mostreadupdate()
{
	if (isset($_GET['id'])) {
  $newsid = $_GET['id'];
} 
$myquerry="SELECT * FROM news_slides WHERE id='$newsid'";

 		$relatednewsm=mysql_query($myquerry);
		$readnewsm=mysql_fetch_assoc($relatednewsm);
		
		$hitsnow= $readnewsm['hits'];
		$totalshitsnow= $hitsnow+1;
mysql_query("UPDATE news_slides SET hits = '$totalshitsnow' WHERE id =".$newsid);
return " ( ".$hitsnow." )";
}


function newsupdate()
{
	
$updatedate=mysql_query("select id, Advert_id, expirydate, active, days_left from  news_t_newsdetails");

if (! $updatedate){
   die(mysql_error());
}
while ($exp_date=mysql_fetch_assoc($updatedate))
{
$recid=$exp_date['id'];
$jobid = $exp_date['Advert_id'];
$expiry=$exp_date['expirydate'];
$today=date("Y-m-d");
$datediff = strtotime($expiry) - strtotime($today); 
$leftdays=$exp_date['days_left'];
 
$rem_days=floor($datediff / (60*60*24));

mysql_query("UPDATE news_t_newsdetails SET days_left = '$rem_days' WHERE id =".$recid);

if ($leftdays<=0)
{
mysql_query("UPDATE news_t_newsdetails SET active = 0 WHERE id =".$recid);
mysql_query("UPDATE job_adverts SET active_status = 0 WHERE Advert_id =".$jobid);
}
else if ($leftdays>0)
{
mysql_query("UPDATE news_t_newsdetails SET active = 1 WHERE id =".$recid);
mysql_query("UPDATE job_adverts SET active_status = 1 WHERE Advert_id =".$jobid);
}
}
}	
/*//$getdate2=mysql_query("select expiry_date, active_status from  review_stds");
$newsupdate=mysql_query("SELECT * FROM news_t_newsdetails WHERE category='news' OR category='careers' OR category='tenders' OR category='eoi' AND active=1");
//$newsupdate=mysql_query("SELECT * FROM news_t_newsdetails WHERE  active=1");

while ($newsdata=mysql_fetch_assoc($newsupdate))
{
$recid=$newsdata['id'];
$expday=$newsdata['expirydate'];
$today=date("Y-m-d");
$datediff = strtotime($days) - strtotime($today); 
 
$rem_days=floor($datediff / (60*60*24));
//mysql_query("UPDATE adoption_forms SET days_left = '$rem_days' WHERE id =".$recid);

if ($rem_days<=0)
{
mysql_query("UPDATE news_t_newsdetails SET active = 0 WHERE id =".$recid);
//echo $recid $rem_days;
}
}*/

?>