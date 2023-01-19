<table border="1" align="center" style="width:50%;">
	<tr>
<th>	id	</th>
<th>	job_position	</th>
<th>	manager	</th>
<th>	manager_job </th>
<th>	principal </th>
<th>	principal_job </th>
<th>	degree_holder	</th>
<th>	degree_job	</th>
<th>	diploma_holder</th>
<th>	diploma_job</th>
<th>	certificate_holder</th>
<th>	certificate_job</th>
<th>	f_name	</th>
<th>	s_name	</th>
<th>	surname</th>
<th>	dob	</th>
<th>	pin	</th>
<th>	id_number	</th>
<th>	gender	</th>
<th>	nationality	</th>
<th>	tribe	</th>
<th>	county	</th>
<th>	m_status	</th>
<th>	disability	</th>
<th>	disability_type	</th>
<th>	email	</th>
<th>	phone_number	</th>
<th>	address</th>
<th>	phd	</th>
<th>	doctrate</th>
<th>	masters</th>
<th>	bachelors</th>
<th>	diploma</th>
<th>	certificate</th>
<th>	prof_qualifications	</th>
<th>	prof_membership	</th>
<th>	work_membership	</th>
<th>	relevant_experience	</th>
<th>	sup_man_exp	</th>
<th>	competencies	</th>
<th>	achievements	</th>
<th>	id_pin_copy	</th>
<th>	cover_letter	</th>
<th>	cv	</th>
<th>	academic_certs	</th>
<th>	prof_certs	</th>
<th>	membership_certs	</th>
<th>	constitutional_certs	</th>
<th>	documents	</th>
<th>	submission_date	</th>

		
	</tr><tr>
<?php
$con=mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite');
$result = mysqli_query($con,"SELECT * FROM eu3nr_job_applicants");
while($row = mysqli_fetch_array($result))
{
echo "<td>".$row['id']."</font></td>";
echo "<td>".$row['job_position']."</font></td>";
echo "<td>".$row['manager']."</font></td>";
echo "<td>".$row['manager_job']."</font></td>";
echo "<td>".$row['principal']."</font></td>";
echo "<td>".$row['principal_job']."</font></td>";
echo "<td>".$row['degree_holder']."</font></td>";
echo "<td>".$row['degree_job']."</font></td>";
echo "<td>".$row['diploma_holder']."</font></td>";
echo "<td>".$row['diploma_job']."</font></td>";
echo "<td>".$row['certificate_holder']."</font></td>";
echo "<td>".$row['certificate_job']."</font></td>";
echo "<td>".$row['f_name']."</font></td>";
echo "<td>".$row['s_name']."</font></td>";
echo "<td>".$row['surname']."</font></td>";
echo "<td>".$row['dob']."</font></td>";
echo "<td>".$row['pin']."</font></td>";
echo "<td>".$row['id_number']."</font></td>";
echo "<td>".$row['gender']."</font></td>";
echo "<td>".$row['nationality']."</font></td>";
echo "<td>".$row['tribe']."</font></td>";
echo "<td>".$row['county']."</font></td>";
echo "<td>".$row['m_status']."</font></td>";
echo "<td>".$row['disability']."</font></td>";
echo "<td>".$row['disability_type']."</font></td>";
echo "<td>".$row['email']."</font></td>";
echo "<td>".$row['phone_number']."</font></td>";
echo "<td>".$row['address']."</font></td>";
echo "<td>".$row['phd']."</font></td>";
echo "<td>".$row['doctrate']."</font></td>";
echo "<td>".$row['masters']."</font></td>";
echo "<td>".$row['bachelors']."</font></td>";
echo "<td>".$row['diploma']."</font></td>";
echo "<td>".$row['certificate']."</font></td>";
echo "<td>".$row['prof_qualifications']."</font></td>";
echo "<td>".$row['prof_membership']."</font></td>";
echo "<td>".$row['work_membership']."</font></td>";
echo "<td>".$row['relevant_experience']."</font></td>";
echo "<td>".$row['sup_man_exp']."</font></td>";
echo "<td>".$row['competencies']."</font></td>";
echo "<td>".$row['achievements']."</font></td>";
echo "<td>".$row['id_pin_copy']."</font></td>";
echo "<td>".$row['cover_letter']."</font></td>";
echo "<td>".$row['cv']."</font></td>";
echo "<td>".$row['academic_certs']."</font></td>";
echo "<td>".$row['prof_certs']."</font></td>";
echo "<td>".$row['membership_certs']."</font></td>";
echo "<td>".$row['constitutional_certs']."</font></td>";
echo "<td>".$row['documents']."</font></td>";
echo "<td>".$row['submission_date']."</font></td></tr>";

$df="Jobs Application Details-Report";
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename='$df'.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
echo "</table>";
mysqli_close($con);
?>