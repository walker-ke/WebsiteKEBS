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
<table id="example" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Firm Name</th>
							<th>Postal Address</th>
							<th>Cert No</th>
							<th>Scope Cert</th>
							<th>Issue Date</th>
							<th>Expiry Date</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
 $query = "SELECT * FROM eu3nr_ems";
mysqli_query($conn, $query) or die('Error querying database.');
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {

echo "<tr>";
echo "<td><span >".$row['firmName']."</span></td>";
echo "<td><span >".$row['postalAddress']."</span></td>";
echo "<td><span >".$row['certNo']."</span></td>";
echo "<td><span >".$row['scopeCert']."</span></td>";
echo "<td><span >".$row['issueDate']."</span></td>";
echo "<td><span >".$row['expiryDate']."</span></td>";

echo "</tr>";

}
mysqli_close($conn);
?>
						
					</tbody>
					
</table>
</div>
</body>

</html>