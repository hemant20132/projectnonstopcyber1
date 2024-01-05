<?php
include('connection.php');
$query="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'zzezcecvhx' AND TABLE_NAME = 'product'";
$prautoid=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($prautoid);
if ($numrows>0)
{
	while ($row=mysqli_fetch_array($prautoid,MYSQLI_ASSOC))
	{
	echo $row['AUTO_INCREMENT'];	
	}
}
?>