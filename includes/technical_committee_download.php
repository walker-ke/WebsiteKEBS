<table border="1" align="center" style="width:50%;">
	<tr>
		<th>Id</th>
		<th>Name of the Technical Committtee</th>
			<th>Please select where your Organization/entity falls in the classification</th>
			<th>Organisation</th>
	
		<th>Nominee</th>
		<th>Position</th>
		<th>Postal Address</th>
		<th>Number</th>
		<th>Email Address</th>
		<th>Authorising Person </th>
		<th>Authorising Persons Position</th>
		<th>Authorising Persons Email</th>
		<th>Qualification and Experiences</th>
		<th>Statement of Commitment</th>		
		<th>Date Submitted </th>
		
	</tr><tr>
<?php
$con=mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite');
$result = mysqli_query($con,"SELECT * FROM tc_normination");
while($row = mysqli_fetch_array($result))
{
echo "<td>".$row['id']."</font></td>";
echo "<td>".$row['name_of_the_technichal_committee_tc_']."</font></td>";
echo "<td>".$row['entity']."</font></td>";
echo "<td>".$row['organisation_']."</font></td>";

echo "<td>".$row['nominee_']."</font></td>";
echo "<td>".$row['position_']."</font></td>";
echo "<td>".$row['postal_address_']."</font></td>";

echo "<td>".$row['number_']."</font></td>";
echo "<td>".$row['email_']."</font></td>";
echo "<td>".$row['authorising_person_']."</font></td>";

echo "<td>".$row['Aposition_']."</font></td>";
echo "<td>".$row['A_email_']."</font></td>";
echo "<td>".$row['qualifications_and_experience_']."</font></td>";
echo "<td>".$row['checkbox_']."</font></td>";
echo "<td>".$row['date']."</font></td></tr>";

$df="TC_Summary-Report";
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename='$df'.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
echo "</table>";
mysqli_close($con);
?>