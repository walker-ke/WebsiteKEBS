<table border="1" align="center" style="width:50%;">
	<tr>
		<th>s/n</th>
		<th>Technical Committtee</th>
		<th>Timeliness in sending notifications for meetings, including postponements/cancellations</th>
		<th>Availing documents (drafts standards, reference materials) in time</th>
		<th>The TC secretary&#44;s preparedness during the meeting</th>
		<th>The level of engagement of TC members</th>
		<th>Accuracy of meeting minutes/resolutions</th>
		<th>Circulating minutes after meetings</th>
		<th>Any other comments regarding Secretariat’s administrative support</th>
		
			
		<th>How satisfied are you with the use of ISOlutions system for TC work?</th>
		<th>Mandatory comments required for the selected option</th>
		<th>Voluntary comments allowed</th>
		
		<th>What is your experience in the use of online Meeting platforms and what is your suggestion for improvement (if any)</th>
		<th>On a scale of 1 to 5 where one (1) is the lowest and five (5) the highest, please indicate your satisfaction level with the Technical Committee facilities, including virtual meetings:</th>
		<th>Please give any suggestions for improvement</th>
		
		<th>In your opinion and experience what is your view regarding restricting the choice of TC chair from institutions without commercial/business interests as opposed to leaving it open to the entire sector representatives</th>
		<th>Full Names</th>
		
		<th>Organisation</th>		
		<th>Postal Address</th>
		<th>Telephone Number</th>
		<th>Email Address</th>
		<th>Date</th>
		
	</tr><tr>
<?php
$con=mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite');
$result = mysqli_query($con,"SELECT * FROM eu3nr_tc_feedback_form");
while($row = mysqli_fetch_array($result))
{
echo "<td>".$row['id']."</font></td>";
echo "<td>".$row['technical_committee']."</font></td>";
echo "<td>".$row['timelines']."</font></td>";
echo "<td>".$row['availing']."</font></td>";

echo "<td>".$row['management']."</font></td>";
echo "<td>".$row['engagement']."</font></td>";
echo "<td>".$row['minutes']."</font></td>";
echo "<td>".$row['circulating']."</font></td>";
echo "<td>".$row['other_comments']."</font></td>";


echo "<td>".$row['switcher']."</font></td>";
echo "<td>".$row['mytextfield']."</font></td>";
echo "<td>".$row['mytextfield2']."</font></td>";

echo "<td>".$row['meeting_platforms']."</font></td>";
echo "<td>".$row['satisfaction_level']."</font></td>";
echo "<td>".$row['improvement']."</font></td>";

echo "<td>".$row['your_view']."</font></td>";


echo "<td>".$row['your_names']."</font></td>";
echo "<td>".$row['organisation']."</font></td>";
echo "<td>".$row['postal_address']."</font></td>";
echo "<td>".$row['telephone_number']."</font></td>";
echo "<td>".$row['email']."</font></td>";
echo "<td>".$row['date']."</font></td></tr>";

$df="TC_Feedback_Form-Report";
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename='$df'.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
echo "</table>";
mysqli_close($con);
?>