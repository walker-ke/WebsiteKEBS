<html>
<head><title></title>
<?php
//Step1
// $conn = mysqli_connect('kebsite.mysql.database.azure.com','kebsite@kebsite','k3bs@123','kebsite')
// or die('Error connecting to MySQL server.');
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
    $('#contact-detail3').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
		"order": [[ 6, "desc" ]],

        "processing": true,
        "serverSide": true,
        "ajax": "../includes/server3.php"
    } );
} );

	</script>
</head>

<body>
<div class="table-responsive">
<table id="contact-detail3" class="display" style="width:100%">
					<thead>
						<tr>
						    <th>ID</th>						    
						    <th>Firm Name</th>
						    <th>Product</th>
						    <th>Brand</th>
							<th>Permit No</th>
							<th>Issue Date</th>
							<th>Expiry Date</th>
							<th>Status</th>
						</tr>
					</thead>
					
					
</table>
</div>
</body>

</html>