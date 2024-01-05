<?php
include('connection.php');
$query="select * from notification where tdate > (now() - interval 10 minute) order by id" ;
$note=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($note);
if ($numrows > 0)
{
	$results=array();
	while ($row=mysqli_fetch_array($note,MYSQLI_ASSOC))
	{
	$results[]=$row;
	}
	for ($i=0;$i<sizeof($results);$i++)
	{
		$results[$i]['notificationtext']=urldecode($results[$i]['notificationtext']);
	}
	echo json_encode($results);
}
else
{
	echo json_encode("error");
}	
?>