<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$strlen = strlen($_GET['content']);
	$display_count = $_GET['count'];

	$select = "select * from members where hr_no ='".$_GET['content']."'";
	$res = mysql_query($select);
	$rec_count = mysql_num_rows($res);
    if($display_count)
	{
		
	  echo "There are <font color='red' size='2'>".$rec_count."</font> matching records found.Click Search to view result.";
        }