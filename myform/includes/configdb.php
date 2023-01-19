<?php


class connection {

    var $conn;

    function __construct() {
           $this->conn =mysql_connect("kebsite.mysql.database.azure.com","kebsite@kebsite","k3bs@123!"); 
        //$this->conn = mysqli_connect("localhost", "kebs", "kebs123", "kkebs");
         mysql_select_db( "kebs_kebsmain", $this->conn);
         
        
          //  $this->conn =mysql_connect("localhost","kebske_dolala","m*&xR515=!");   
  // mysql_select_db("kkebs",$this->conn);
   }

    function connectionClose() {
        mysql_close($this->conn);
    }

}

