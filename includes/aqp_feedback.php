<table border="1" align="center" style="width:50%;">
	<tr>
		<th>Id</th>
		<th>Partner State</th>
		<th>Name</th>
		<th>Organization/Entity</th>
		<th>Clause</th>
		<th>Paragraph/Figure/Table/Note(e.g. Table 1)</th>
		<th>Type of comment</th>
		<th>Comment (justification for change) by the Organization</th>
		<th>Proposed change by the Organization</th>
		<th>Secretariat Observations on all comments</th>
		<th>Date Submitted</th>
	</tr><tr>
<?php
$con=mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite');
$result = mysqli_query($con,"SELECT * FROM eu3nr_african_quality_policy");
while($row = mysqli_fetch_array($result))
{
echo "<td>".$row['id']."</font></td>";
echo "<td>".$row['partner_state']."</font></td>";
echo "<td>".$row['name']."</font></td>";
echo "<td>".$row['org_entity']."</font></td>";


echo "<td>".$row['clause']."</font></td>";
echo "<td>".$row['pftn']."</font></td>";
echo "<td>".$row['type_of_comment']."</font></td>";

echo "<td>".$row['justification']."</font></td>";
echo "<td>".$row['proposed_change']."</font></td>";
echo "<td>".$row['observation']."</font></td>";
echo "<td>".$row['date_submitted']."</font></td></tr>";

$df="African_Quality_Policy";
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename='$df'.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
echo "</table>";
mysqli_close($con);
?>