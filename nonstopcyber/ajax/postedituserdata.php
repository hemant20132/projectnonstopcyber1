<?php
session_start();
include('connection.php');
$id=$_REQUEST['userid'];
$name=$_REQUEST['name'];
$username=$_REQUEST['username'];
$userpassword=$_REQUEST['userpassword'];
$useraddress=$_REQUEST['useraddress'];
$usercontactno=$_REQUEST['usercontactno'];
$useremail=$_REQUEST['useremail'];
$userrole=$_REQUEST['userrole'];
	if (isset($_FILES['file']['name']))
	{
		$userimg=$_FILES['file']['name'];
		$ext = pathinfo($userimg, PATHINFO_EXTENSION);
		$imagename=$username.".".$ext;
		$targetfile='../userimages/'.$username.".".$ext;
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetfile))
		{
		$uploaded=true;	
		$userupdate="UPDATE user set 
		user_image='".$imagename."',
		name='".$name."',
		username='".$username."', 
		password='".$userpassword."',
		useraddress='".$useraddress."',
		usercontactno='".$usercontactno."',
		useremail='".$useremail."',
		role='".$userrole."' where id='".$id."'";	
		}	
	}
	else
	{
		$userupdate="UPDATE user set 
		name='".$name."',
		username='".$username."', 
		password='".$userpassword."',
		useraddress='".$useraddress."',
		usercontactno='".$usercontactno."',
		useremail='".$useremail."',
		role='".$userrole."' where id='".$id."'";	
	}

		if (mysqli_query($conn,$userupdate))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>