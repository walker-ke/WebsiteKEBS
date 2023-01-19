<html>
<head><title></title>
<?php
//Step1
 //$conn = mysqli_connect('localhost','techmate_kebs','M8[2PcnOLeQd','techmate_kebs')
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
    $('#contact-detail2').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
		"order": [[ 5, "desc" ]],

        "processing": true,
        "serverSide": true,
        "ajax": "../includes/server2.php"
    } );
} );
</script>
</head>

<body>
<div class="table-responsive">
<table id="contact-detail2" class="display" style="width:100%">
					<thead>
						<tr>
						        <th>Permit No</th>
							<th>Firm Name</th>
							<th>Product</th>
							<th>Issue Date</th>
							<th>Expiry Date</th>
							<th>Status</th>
						</tr>
					</thead>
				
					
</table>
</div>
</body>

</html>