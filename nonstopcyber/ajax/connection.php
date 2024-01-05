<?php
 $dbhost = "localhost";
 $dbuser = "zzezcecvhx";
 $dbpass = "3TVKybjS5N";
 $dbname = "zzezcecvhx";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 return $conn;
?>