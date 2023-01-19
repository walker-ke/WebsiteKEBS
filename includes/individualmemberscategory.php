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
							<th>Member Name</th>
                           <th>Membership Number</th>
						   <th>Category of Membership</th>
                            <th>Membership Expiry Date</th>
                          <th>&nbsp;</th>
							
						</tr>
					</thead>
					<tbody>
					    <?php
                            //$query = "SELECT * FROM eu3nr_imcategory";
							$query = "SELECT * FROM eu3nr_imcategory ORDER BY memberName";
							
                            mysqli_query($conn, $query) or die('Error querying database.');
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            
                                        echo "<tr>";
                                        
                                        echo "<td><span >".$row['memberName']."</span></td>";
                                        echo "<td><span >".$row['membership_no']."</span></td>";
										echo "<td><span >".$row['category']."</span></td>";
                                        echo "<td><span >".$row['validity_status']."</span></td>";
                                     echo "<td><span >".$row['']."</span></td>";
                                        echo "</tr>";
                            
                            }
                            mysqli_close($conn);
                        ?>
						
					</tbody>
					
</table>
</div>
</body>

</html>