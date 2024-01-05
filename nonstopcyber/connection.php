<?php
 $dbhost = "sql211.epizy.com";
 $dbuser = "epiz_33239466";
 $dbpass = "Horizon2022";
 $dbname = "epiz_33239466_new";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 return $conn;
?>