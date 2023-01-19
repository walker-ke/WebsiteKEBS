<html>
<head><title></title>

<?php
include 'dbconnect.php';
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>



<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#example').DataTable( {
		"order": [[ 7, "desc" ]]
	} );
} );

</script>

</head>

<body>
<div class="table-responsive">
<table id="example" class="display" style="width:100%;">
					<thead>
						<tr>
							<th>Id</th>
						   <th>Welder Reg. No.</th>
                           			   <th>Welder Name</th>
						   
						   <th>email</th>
						   <th>scope</th>
						   <th>reg_date</th>
                           			   <th>expiry_date</th>
							
						</tr>
					</thead>
					<tbody>
					    <?php
						
                     	$query = "SELECT * FROM `cb_welders` WHERE 1";
							
                            mysqli_query($conn, $query) or die('Error querying database.');
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            
                                        echo "<tr>";
                                        
                                        echo "<td><span >".$row['id']."</span></td>";
                                        echo "<td><span >".$row['reg_no']."</span></td>";
					echo "<td><span >".$row['welder_name']."</span></td>";
                                        echo "<td><span >".$row['email']."</span></td>";
                                        echo "<td><span >".$row['scope']."</span></td>";
					echo "<td><span >".$row['reg_date']."</span></td>";
					echo "<td><span >".$row['expiry_date']."</span></td>";
                                        echo "</tr>";
                            
                            }
                            mysqli_close($conn);
                        ?>
						
					</tbody>
					
</table>
<p>
<b style="color:red;">*Note:</br>
This information can be obtained by sending email to CBManagement@kebs.org or call +254206948299. </br>
Toll Free 1545 ask for KEBS-Certification Body

</p>
</div>
</body>

</html>