<?php
session_start();
include('connection.php');
$note=$_REQUEST['notetext1'];
$notedate=date("Y-m-d H:i:s");
		$noteinsert="INSERT INTO notification (notificationtext,username,tdate) values('".$note."','".$_SESSION['username']."','".$notedate."')";
		if (mysqli_query($conn,$noteinsert))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>