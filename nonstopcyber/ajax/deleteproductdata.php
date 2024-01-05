<?php
session_start();
include('connection.php');
$id=$_REQUEST['id'];
		$userdelete="Delete from product where s_no=".$id;	
		if (mysqli_query($conn,$userdelete))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>