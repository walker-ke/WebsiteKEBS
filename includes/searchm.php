<?php
//Step1
 include 'dbconnect.php';
?>
<html>
 <head>
  <meta charset="utf-8" />
        <title></title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
         <style type="text/css">
           #form-search #container{
               width:800px;
               margin:0 auto;
            }

          #form-search #search{
               width:400px;
               padding:10px;
            }

           #form-search #button{
               display: block;
               width: 100px;
               height:30px;
               border:solid #366FEB 1px;
               background: #91B2FA;
            }

           #form-search  ul{
            	margin-left:-40px;
            }

           #form-search ul li{
            	list-style-type: none;
            	border-bottom: dotted 1px black;
              height: 50px;
            }

          #form-search  li:hover{
            	background: #A592E8;
            }

          #form-search   a{
            	text-decoration: none;
              font-size: 18px;
            }
  	    </style>
 </head>
 <body>
 Please use your chasis number to find Inspection Details:
 <form id="form-search" action="" method="post"> 
 <div class="form-group"> 
<input type="text" id="search" class="form-control" name="term" /> 
</div>
<input type="submit" id="button" value="Search" />  
</form>  
<table id="example" class="display" style="width:100%">
<thead>
<tr></tr>
</thead>
<tbody>
 <?php
 $term = $_POST['term'];
 if (!empty($_POST['term'])) {
 $query = "SELECT * FROM pvoc_motovehicles_inspection WHERE Chassis LIKE '%".$term."%'";
 if($resultEvent = mysqli_query($conn, $query)){
 	if(mysqli_num_rows($resultEvent) > 0){
 		while($row = mysqli_fetch_array($resultEvent)){
 			echo "
<tr>
<td colspan='4'><b>CHAISIS NUMBER : </b>".$row['Chassis']."</td></td>
			
<td colspan='3'></td>
			
			
</tr>";
 			
 			
 			echo "
   <tr style='background-color:#0166B1; color:#FFF;'>
    <th>Certificate Number</th>
    <th>Make</th>
    <th>Model</th>
    <th>Engine Number</th>
    <th>CC Rating</th>
    <th>Inspection Date</th>
    <th>Country Of Origin</th>
    <th>Date of first Inspection</th>
    <th>Issue Date</th>
 </tr>
";
 			//Step 4
 			
 			echo "
            		
<tr>
            		
	<td>".$row['CORNo']."</td>
               		
	<td><span >".$row['Make']."</span></td>
               		
	<td><span >".$row['Model']."</span></td>
               		
	<td><span >".$row['Engine_Number']."</span></td>
           		
	<td><span >".$row['ccRating']."</span></td>          		
            		
	<td><span >".$row['Inspection_Date']." </span></td>
            			
	<td><span >".$row['Country']."</span></td>
            		
 	<td><span >".$row['FirstInspection']."</span></td>
            			
	<td><span >".$row['Date_of_Issue']."</span></td>
</tr>
            			
<tr>
<td colspan='12'>&nbsp;</td>
</tr>
            			
<tr>
<!-- <td colspan='3'><b>STATUS<br> (After the Inspection Date)</b></td>
<td colspan='11'style='text-align:left; color:#FF0000;'><strong><span >".$row['status']." </span></strong></td>
-->
<tr>
		
</tr>
<!--
<td colspan='3'><b>REMARKS: </b></td>
<td colspan='11' style='color:#0099FF;'><strong><span >".$row['Remarks']."</span></strong></td>
-->
</tr>";
 			?>

<?php } }else {
	echo "<div style='color:red;'><strong>No record Found</strong></div>";
	
}}}
?>
</tbody>
</table>

<script>
$("#button").click(function(){
$("#nairobi").toggle();
}); 
</script>

</html>