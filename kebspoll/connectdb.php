<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//class connection {
//
//    var $conn;
//
//    function __construct() {
//
//        //$this->conn =mysqli_connect("localhost","root",""); 
//        //$this->conn = mysqli_connect("localhost", "root", "", "kebs_poll");
//        //mysqli_select_db( $this->conn, "kebs_poll");
//        // $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DATABASE);
//        //  $this->conn =mysql_connect("localhost","kebske_dolala","m*&xR515=!");   
//        // mysql_select_db("kkebs",$this->conn);
//
//
//        $con = mysqli_connect("localhost", "kebs_kebspoll", "", "kebs_kebspoll");
//
//// Check connection
//        if (mysqli_connect_errno()) {
//            echo "Failed to connect to MySQL: " . mysqli_connect_error();
//        }
//    }
//
//    function connectionClose() {
//        mysqli_close($this->conn);
//    }
//
//}

$myHost = "kebsite.mysql.database.azure.com"; // use your real host name
$myUserName = "kebs_kebspoll";   // use your real login user name
$myPassword = "kebspoll123?";   // use your real login password
$myDataBaseName = "kebs_kebspoll"; // use your real database name

$con = mysqli_connect( "$myHost", "$myUserName", "$myPassword", "$myDataBaseName" );

if( !$con ) // == null if creation of connection object failed
{ 
    // report the error to the user, then exit program
    die("connection object not created: ".mysqli_error($con));
}

if( mysqli_connect_errno() )  // returns false if no error occurred
{ 
    // report the error to the user, then exit program
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}

 