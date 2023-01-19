<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title>KEBS - Standards, Training, Testing and Certification</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/kebs.css" rel="stylesheet" type="text/css" />

<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
<!-- CuFon ends -->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
        <script type="text/javascript" src="jquery.js"></script>
<!--    <script type="text/javascript" src="js/location2.js"></script> -->


	<!--    
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        -->

<script type="text/javascript">
// Require https
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
</script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.myMenu > li').bind('mouseover', openSubMenu);
                $('.myMenu > li').bind('mouseout', closeSubMenu);


                function openSubMenu() {
                    $(this).find('ul').css('visibility', 'visible');
                }
                ;

                function closeSubMenu() {
                    $(this).find('ul').css('visibility', 'hidden');
                }
                ;

            });
</script>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #039;
    color: white;
}
</style>
</head>
   
<body class ="body">
 
<div align="center">
<table id="customers">
  <tr>
    <th colspan='3'>
            <div> 
            <strong>
                    <a href="https://www.kebs.org/career/index.php?opt=aboutkebs&view=careers" style="font-size:18px; color:#FFFFFF;">Home</a>
            </strong>
            </div
    </th>
  </tr>
  <tr>
    <td colspan='3'><b>Kenya Bureau of Standards</b></td>
  </tr>
</table>
    <?php
        include_once 'includes/configdb.php';
        include("includes/general.inc.php");
        ?>
                            
                            
                            