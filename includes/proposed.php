<table border="1" align="center" style="width:50%;">
	<tr>
		<th>ID</th>
		<th>Full Names</th>
		<th>Organisation</th>
		<th>Email Address</th>
		<th>Telephone Number</th>
		<th>Sector</th>
		<th>Field</th>
		<th>Subject</th>
		<th>Potential to contribute to economic efficiency</th>
		<th>Potential to safeguard health and safety </th>
		<th>Potential to preserve the environment</th>
		<th>Potential to facilitate the local exchange of products and industrial integration</th>
		<th>Potential to facilitate access to export markets </th>
		<th>Type of Standard required</th>
		<th>Attach any additional information</th>		
		<th>Date Submitted </th>
		<th>Status</th>
		
	</tr><tr>
<?php
$con=mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite');
$result = mysqli_query($con,"SELECT * FROM proposing_subjects_std");
while($row = mysqli_fetch_array($result))
{
echo "<td>".$row['id']."</font></td>";
echo "<td>".$row['text8']."</font></td>";
echo "<td>".$row['text10']."</font></td>";
echo "<td>".$row['text9']."</font></td>";


echo "<td>".$row['Telephone']."</font></td>";
echo "<td>".$row['sector']."</font></td>";
echo "<td>".$row['fields']."</font></td>";

echo "<td>".$row['subjects']."</font></td>";
echo "<td>".$row['radio12']."</font></td>";
echo "<td>".$row['radio13']."</font></td>";

echo "<td>".$row['radio14']."</font></td>";
echo "<td>".$row['radio15']."</font></td>";
echo "<td>".$row['radio16']."</font></td>";
echo "<td>".$row['type_of_standard_required']."</font></td>";
echo "<td>".$row['attachment']."</font></td>";
echo "<td>".$row['date']."</font></td></tr>";

$df="Total_Summary-Report";
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename='$df'.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
echo "</table>";
mysqli_close($con);
?>