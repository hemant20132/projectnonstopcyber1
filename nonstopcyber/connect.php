<?php
include('connection.php');
$name = $_POST['brand_name'];
$code = $_POST['brand_code'];
$sql = "INSERT INTO brand (brand,code) VALUES ('$name','$code')";
$rs = mysqli_query($conn, $sql);
if($rs)
{
	header("Location:brand.php"); 
}
?>



