<?php
session_start();
include('connection.php');
$id=$_REQUEST['id'];
		$userdelete="Delete from user where id=".$id;	
		if (mysqli_query($conn,$userdelete))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>