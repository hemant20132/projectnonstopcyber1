<?php
session_start();
include('connection.php');
$name=$_REQUEST['name'];
$username=$_REQUEST['username'];
$password=$_REQUEST['userpassword'];
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
		}	
	}
	$userinsert="INSERT INTO user(user_image, name, username, password, useraddress, usercontactno, useremail, role) 
	VALUES ('".$imagename."','".$name."','".$username."','".$password."','".$useraddress."','".$usercontactno."','".$useremail."','".$userrole."')";
	
			if (mysqli_query($conn,$userinsert))
			{
			echo json_encode("success");
			}
			else
			{
			echo json_encode("error posting userdata");
			}
			
?>