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
							
							<th>Title</th>
                        				<th>Category</th>
						   	<th>Target Group</th>
							<th>Venue</th>
							<th>Fees</th>
                       					 <th>Start date</th>
							<th>End date</th>
							<th>Duration</th>
						 	 
							
						</tr>
					</thead>
					<tbody>
					    <?php
                     	$query = "SELECT * FROM training_calender ORDER BY Start_date";
							
                            mysqli_query($conn, $query) or die('Error querying database.');
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            
                                        echo "<tr>";
                                        
                                      
                                        					                                      					
										echo "<td><span>".$row['Title']."</span></td>";
										echo "<td style='width:20px;'><span >".$row['Category']."</span></td>";
                                        					echo "<td style='width:20px;'><span >".$row['Target_group']."</span></td>";
										echo "<td> <span>".$row['Venue']."</span></td>";
                                        					echo "<td> <span>".$row['Fees']."</span></td>";
										echo "<td style='width:80px'><span >".$row['Start_date']."</span></td>";
										echo "<td style='width:80px'><span >".$row['End_date']."</span></td>";
										echo "<td><span>".$row['Duration']."</span></td>";
																				
										

                                        echo "</tr>";
					                      
                                        echo "<tr>";
                                       		echo "<td colspan='8'> <a href='".$row['Link']."'>Apply here</a></td>"; 			

                                        echo "</tr>";
                            
                                                        
                            }
                            mysqli_close($conn);
                        ?>
						
					</tbody>
					
</table>
<p>

</p>
</div>
</body>

</html>