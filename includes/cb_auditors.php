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
		"order": [[ 3, "desc" ]]
	} );
} );

</script>

</head>

<body>
<div class="table-responsive">
<table id="example" class="display" style="width:100%;">
					<thead>
						<tr>
							<th>Sn. No.</th>
                           <th>Auditor Reg. No.</th>
						   <th>Auditor Name</th>
                            <th>MS Approved to audit *(see note below)</th>
                         <!-- <th>Email Contact</th> -->
							
						</tr>
					</thead>
					<tbody>
					    <?php
                     	$query = "SELECT * FROM cb_auditors ORDER BY id";
							
                            mysqli_query($conn, $query) or die('Error querying database.');
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            
                                        echo "<tr>";
                                        
                                        echo "<td><span >".$row['id']."</span></td>";
                                        echo "<td><span >".$row['reg_no']."</span></td>";
										echo "<td><span >".$row['auditor_name']."</span></td>";
                                        echo "<td><span >".$row['approve_audit']."</span></td>";
                                     //echo "<td><span >".$row['email']."</span></td>";
                                        echo "</tr>";
                            
                            }
                            mysqli_close($conn);
                        ?>
						
					</tbody>
					
</table>
<p>
<b style="color:red;">*Note:</b> The auditor is approved to audit certain industry sector(s) for the MS(s). </br>
This information can be obtained by sending email to CBManagement@kebs.org or call +254206948299. </br>
Toll Free 1545 ask for KEBS-Certification Body

</p>
</div>
</body>

</html>