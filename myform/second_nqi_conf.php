
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript" src="js/fltmsgjquer.js"></script>
<script language="javascript" src="js/jquery.dimensions.js"></script>

   
<script language="javascript">
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;
        document.getElementById('attendees').value = "" + (rowCount);

        var fees = document.getElementById('fees').value;

        var totalfeespaid = rowCount * fees;

        document.getElementById('totalfees').value = "" + (totalfeespaid);

//alert (rowCount);
        for (var i = 0; i < colCount; i++) {

            var newcell = row.insertCell(i);

            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch (newcell.childNodes[0].type) {
                case "text":
                    newcell.childNodes[0].value = "";
                    break;
                case "checkbox":
                    newcell.childNodes[0].checked = false;
                    break;
                case "select-one":
                    newcell.childNodes[0].selectedIndex = 0;
                    break;
            }
        }
    }
    
    function totalfees(){
        //document.getElementById('attendees').value = "" + (rowCount)-1;
                        var fees = document.getElementById('fees').value;

                        var attendees = document.getElementById('attendees').value;

            var totalfeespay = fees * attendees;
            document.getElementById('totalfees').value = "" + (totalfeespay);

        }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 2) {
                        alert("Cannot delete all the rows.");
                        break;
                    } else {
                        table.deleteRow(i);
                        rowCount--;

                        i--;

                        document.getElementById('attendees').value = "" + (rowCount)-1;
                        var fees = document.getElementById('fees').value;

                        var totalfeespaid = (rowCount-1) * fees;

                        document.getElementById('totalfees').value = "" + (totalfeespaid);
                    }
                }


            }
        } catch (e) {
            alert(e);
        }
    }

</SCRIPT>



<style type="text/css">
    body {

    }
    #floatMess {
        position:absolute;
        top:260px;
        float:none;
        width:98%;
        border:1px solid #999;
        background-color:#456;
        color:#ccc;
        padding:5px 5px 5px 25px;
        text-align:center;
        height: 250px;


    }

    th, td {
        padding: 5px;
        text-align: left;
    }
    .error {
        color: #FF0000;
        font-family: fantasy;
        font-size:small;
        font-weight: normal;
        text-transform: lowercase;
    }
    .error img { 
        vertical-align:top; 
    }

    input.wrong {
        border-color: rgb(180, 207, 94);
        background-color: rgb(255, 183, 183);
        background:url(images/iconCaution.gif) no-repeat 2px;
        padding-left:20px;

    }
    input.correct {
        border-color: rgb(180, 207, 94);
        background-color: rgb(220, 251, 164);
        background:url(images/success.png) no-repeat 2px;
        padding-left:20px;
    }
    select.wrong {
        border-color: rgb(180, 207, 94);
        background-color: rgb(255, 183, 183);
        background:url(images/iconCaution.gif) no-repeat 2px;
        padding-left:20px;

    }

    select.correct {
        border-color: rgb(180, 207, 94);
        background-color: rgb(220, 251, 164);
        background:url(images/success.png) no-repeat 2px;
        padding-left:20px;

    }

</style>


<link href="css/date.css" rel="stylesheet" type="text/css" />
<style type="text/css">

  input:required:invalid, input:focus:invalid {
    background-image: url(images/invalids.png);
    background-position: right top;
    background-repeat: no-repeat;
  }
  input:required:valid {
    background-image: url(/images/valid.png);
    background-position: right top;
    background-repeat: no-repeat;
  }

</style>
<?php
$objConnect = new connection();

function generate_id() {
     rand(1, 1000000);
   
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//$objConnect = new connection();


$msg = "";
$resp="";
//$insert_query ="";
//$txtErr = $pemail = $orgnameErr = $contactErr = $emailErr = "";
if (isset($_POST['action']) && $_POST['action'] == 'submitfbform') {

    $appID = rand(1, 1000000);
    $today = date("F j, Y");
    $organization = $_POST['orgname'];
    $address = $_POST['address'];
    $town = $_POST['town'];
    $email = $_POST['email'];
    $postalcode = $_POST['postalcode'];
    $country = $_POST['country'];
    $contact = $_POST['contact'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $interest = $_POST['specialInterest'];
    $atendees = $_POST['attendees'];
    $fees = 70000 * $atendees;

    $todayis = date("F j, Y, g:i a");

    $txtbox = $_POST['name'];
    $role = $_POST['role'];
    $pcontact = $_POST['phonecontact'];
    $pemail = $_POST['pemail'];

       // $insert_query = mysql_query("INSERT INTO hrm_reg_organization (`id`, `appid`, `org_name`, `address`, `town`, `postcode`, `country`, `contact`, `telephone`, `email`, `Special_interest`, `fee_paid`, `attendeesNo`) VALUES ('', '$organization', '$address', '$town', '$postalcode', '$country', '$contact', '$phone', '$email', '$interest', '$fees', '$atendees')");
		$insert_query = mysql_query("INSERT INTO nqi_reg_organization (`id`, `appid`, `org_name`, `address`, `town`, `postcode`, `country`, `contact`, `telephone`, `email`, `fee_paid`, `attendeesNo`) VALUES ('', '$appID', '$organization', '$address', '$town', '$postalcode', '$country', '$contact', '$phone', '$email', '$fees', '$atendees')");
        $orgID = mysql_insert_id();
        foreach ($txtbox as $a => $b):
            $insert_querys = mysql_query("INSERT INTO `nqi_reg_participants` (`id`, `appid`, `participant_name`, `role`, `contact`, `email`, `org`, `application_date`) VALUES (NULL, '$appID', '$txtbox[$a]', '$role[$a]', '$pcontact[$a]', '$pemail[$a]', '$orgID', '$todayis')");
        endforeach;
   
    
    if ($insert_query) {

        $msg = "  <br>Thank you " . $contact . " for showing interest in the seminar. You shall receive an email for further communication. Your application ID is ". $appID;
        $regnumbers = mysql_num_rows(mysql_query("SELECT * FROM nqi_reg_participants"));
        $regmembers = mysql_query("SELECT * FROM nqi_reg_participants WHERE appid='$appID'");
        
     
       $variabele = ""; 
                $arrayp = array();

// look through query
while($row = mysql_fetch_assoc($regmembers)){

  // add each row returned into an array
  //$array[] = $row;

  // OR just echo the data:
 //echo  $name= $row['participant_name']. " ".$name= $row['role'];
  //$arrayp= $row['participant_name'];
  if($row['participant_name']){
        $variabele .= "<li>".$row['participant_name'] . "</li>";
    }
  $reges= rtrim($variabele);
}


//Mail to KEBS

       $message = '
                <html><body>
                
                <h3 style="color:#000;">Dear NQI</h3>
                
                <p style="color:#000;font-size:14px;"> Here is one more registration through the website </p>
                <p style="color:#000;font-size:14px;">' . $contact . ' from ' . $organization . ' under application number '.$appID .' has registered for the Annual NQI Membership Conference on behalf of the following participants:</p>
                <p>'.$reges.' </p>
                
                <p style="color:#000;font-size:14px;"> You may communicate futher to the customer through this email: ' . $email . ' </p>
                <p style="color:#000;font-size:14px;"> There are <span style="font-weight:bold">' . $regnumbers . '</span> Members have so far registered for the conference</p>
                
              <p style="color:#000;font-size:14px;">Note that this is a computer generated email and you dont need to reply</p>  
                
                <p> Please paste this link https://www.kebs.org/conf-registrationData.php on to your web browser so as to download the registration records in excel sheet format</p>
                
                <p style="color:#000;font-size:14px;">Thank you</p>
                </body></html>';


        $to = 'wkibii@gmail.com';
        $from = "KEBS WebSite generated Email";
        $subject = "Registration for the Annual NQI Membership Conference";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; // More headers
        $headers .= 'From: <nqimembership@kebs.org>' . "\r\n";
        $headers .= 'Cc: kibiiw@kebs.org' . "\r\n";
        $headers .= 'Cc: wangechiv@kebs.org' . "\r\n";
        mail($to, $subject, $message, $headers);
        
       // Mesage to the client
       
         $Replymessage = '
                <html><body>
                
                <h3 style="color:#000;">Dear ' . $contact . '</h3>
                
                <p style="color:#000;font-size:14px;"> Thank you for registering for the Annual NQI Membership Conference through our website </p>
                <p style="color:#000;font-size:14px;">You have made the application for the following participant(s) under the application number '.$appID .' :</p>
                <p>'.$reges.' </p>
                <p>The toal cost required is <b>KES'.number_format($fees).'</b></p>
                
                <p style="color:#000;font-size:14px;"> You may communicate futher to us through this email: nqimembership@kebs.org and copy to kolam@kebs.org
 for any clarifications</p>
 
 <p>Please request for Authorization to attend this training from your supervisor:</p>
<p>Authorizing Signature:_______________________  Date _____________________ </p>
<p>This booking is invalid without  authorization and stamp. Strictly  upfront payment or LSO for clients with credit facilities with KEBS </p>
<h3>PAYING THROUGH BANK</h3>
<table width="658" height="190" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="229" ><strong>ACC NAME</strong></td>
    <td width="346" >KENYA BUREAU OF STANDARDS</td>
  </tr>
  <tr>
    <td width="229" ><strong>BANK NAME</strong></td>
    <td width="346" >NATIONAL BANK OF KENYA</td>
  </tr>
  <tr>
    <td width="229" ><strong>ACC NUMBER</strong></td>
    <td width="346" >1003002830602</td>
  </tr>
  <tr>
    <td width="229"><strong>BANK CODE</strong></td>
    <td width="346">12-068</td>
  </tr>
  <tr>
    <td width="229" ><strong>SWIFT CODE</strong></td>
    <td width="346" >NBKEKENXXXX</td>
  </tr>
  <tr>
    <td width="229" ><strong>BRANCH</strong></td>
    <td width="346" >NAIROBI, SOUTH C</td>
  </tr>
</table>
<h3>PAYING  FOR KEBS GOODS AND SERVICES WITH MPESA (Safaricom)</h3>
<ol>
  <li>Select &ldquo;Pay Bill&rdquo; from the M-Pesa  menu.</li>
  <li>Enter the Kenya Bureau of  Standards business number <strong>804700.</strong></li>
  <li>Enter <strong>KEBS account number</strong> for the service e.g. <strong>10150</strong> for NQI Membership Training </li>
  <li>Enter the amount you wish to pay which is KES  70,000 per pax.</li>
  <li>Enter your M-Pesa PIN.</li>
  <li>Confirm that all details are  correct.</li>
  <li>You will receive a confirmation of  the transaction via SMS.</li>
</ol>
                
              <p style="color:#000;font-size:14px;">Note that this is a computer generated email through KEBS website and you do not need to reply</p>  
                
                <p style="color:#000;font-size:14px;">Thank you</p>
                </body></html>';
       
       
        $toc = $email;
        $from = "KEBS WebSite generated Email";
        $subject = "Registration for the Annual NQI Membership Conference";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; // More headers
        $headers .= 'From: <nqimembership@kebs.org>' . "\r\n";
        $headers .= 'Cc: kibiiw@kebs.org' . "\r\n";
        $headers .= 'Cc: wangechiv@kebs.org' . "\r\n";
        
        mail($toc, $subject, $Replymessage, $headers);
       
    } else {
        $msg = "<br> Submision not succesfull!,  Please try again <br>" . mysql_error();
        echo "<br>";
       
    }
}
?>
<form action="https://www.kebs.org/myform/index.php?opt=nqiconf" method="post" enctype="multipart/form-data" name="form1" id="form1" >
    <table width="100%" border="2" cellspacing="3" cellpadding="3" >
        <tr>
            <td>

                <div style="font-weight:bold"><fieldset style="color:#006699;background-color:#CCCCCC; text-align:center; border-color:#000000; border-width:1px"><div>
                            <div style="text-transform: uppercase; font-size: 12pt">2<sup>nd</sup>National Management Representatives Congress<br />
                                <span style="font-weight:100; font-size:12pt; text-align:center">REGISTRATION FORM</span></div>
                        </div>    
                    </fieldset>
                </div>
                <span style="font-size: 9pt; color: #FF0000"><?php echo $msg;?></span>
                <div style="padding-right: 30px">
                    <p><kbd style="background-color: #999; text-transform: uppercase">Participants Details </kbd></p>
                      <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

                    <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

                    <table id="dataTable"  border="1">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th width="23%">Full Name</th>
                                <th width="30%">Designation</th>
                                <th width="20%">Phone</th>
                                <th width="25%"> Email</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><input type="checkbox" name="chk"/></td>
                            <td><input type="text" name="name[]" id="pname" required placeholder="Enter Participant Name"  /></td>
                            <td><input  type="text" name="role[]"  /></td>
                            <td><input  type="text" name="phonecontact[]"  /></td>
                            <td><input  type="text" name="pemail[]" id="pemail" required pattern="[^ @]*@[^ @]*" placeholder="Enter valid email"/></td>


                        </tr>
                    </table>

                    <div style="display:inline;float:left; font-size: 11pt">
                        <table width="100%" border="0">
                            <tr>
                                <td colspan="2"><kbd style="background-color: #999;text-transform: uppercase">Organization details</kbd></td>

                            </tr>
                            <tr>
                                <td>Company Name</td>
                                <td><input name="orgname" type="text" id="orgname" required size="35" placeholder="Enter Organization name" /></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><input name="address" type="text" id="address" size="35" required placeholder="Enter Address"/></td>
                            </tr>
                            <tr>
                                <td>Town</td>
                                <td><input name="town" type="text" id="town" size="35" /></td>
                            </tr>
                            <tr>
                                <td>Post Code</td>
                                <td><input name="postalcode" type="text" id="postalcode" size="35" /></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><input name="country" type="text" id="country" size="35" /></td>
                            </tr>
                            <tr>
                                <td>Oranization Official Contact</td>
                                <td><input name="contact" type="text" id="contact" size="35" required placeholder="Enter sponsor contact"/></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><input name="phone" type="text" id="phone" size="35"  required placeholder="Enter Sponsor phone contact" /></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input name="email" type="text" id="email" size="35" required pattern="[^ @]*@[^ @]*" placeholder="Enter valid email" /></td>
                            </tr>
                            <!--<tr>
                                <td>Special Interest/need</td>
                                <td><textarea name="specialInterest" id="specialInterest" cols="30" rows="2"></textarea></td>
                            </tr>-->
                        </table>

                    </div>
                    <div  style="display:inline;float:right">

                        <table width="100%" border="0">
                            <tr>
                                <td colspan="2" style="padding-right: 20px; text-align:left "><kbd style="background-color: #999;text-transform: uppercase">Registration Fees</kbd></td>

                            </tr>
                            <tr>
                                <td style="font-weight: bold">Seminar Fee (KES)</td>
                                <td style="width: 100px"><input type="text" id="fees" name="fees" value="70000" readonly="true" size="4"/></td>
                            </tr>
                            <tr>
                                <td>x Number of Attendees:</td>
                                <td><input type="text" id="attendees" name="attendees" value="1" readonly="true" size="4"/></td>
                            </tr>
                            <tr>
                                <td>Subtotal (KES):</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Total Due (KES):</td>
                                <td><input type="text" id="totalfees" name="totalfees" readonly="true" size="6" value="70000" /></td>
                            </tr>
                        </table>
                    </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2"><div style="padding-top:0px" align="center">
                    <input type="hidden" id="action" name="action" value="submitfbform" />
                    <input type="submit" name="Submit" value="Submit Form" />
                    <input name="resetb" type="reset" id="resetb" value="Reset form" />
                </div></td>
        </tr>

    </table>
</form>

<script type="text/javascript">

  // ref: http://diveintohtml5.org/detect.html
  function supports_input_placeholder()
  {
    var i = document.createElement('input');
    return 'placeholder' in i;
  }

  if(!supports_input_placeholder()) {
    var fields = document.getElementsByTagName('INPUT');
    for(var i=0; i < fields.length; i++) {
      if(fields[i].hasAttribute('placeholder')) {
        fields[i].defaultValue = fields[i].getAttribute('placeholder');
        fields[i].onfocus = function() { if(this.value == this.defaultValue) this.value = ''; }
        fields[i].onblur = function() { if(this.value == '') this.value = this.defaultValue; }
      }
    }
  }

</script>