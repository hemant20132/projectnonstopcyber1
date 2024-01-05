<?php
include('connection.php');
$query="select * from user where username='".$_REQUEST['username']."' and password='".$_REQUEST['userpassword']."'";
$result=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($result);
if ($numrows>0)
{
	session_start();
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$_SESSION['name']=$row['name'];
		$_SESSION['username']=$row['username'];
		$_SESSION['role']=$row['role'];
		$_SESSION['userimage']=$row['user_image'];
		
	}
	echo "success";
}
else
{
	echo "error";
}	
?>