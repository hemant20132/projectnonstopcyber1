<?php
include('connection.php');
$query="select * from subcategory where categorycode='".$_REQUEST['catcode']."'";

$subcategory=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($subcategory);
if ($numrows>0)
{
	$categorydata=array();
	while ($row=mysqli_fetch_array($subcategory,MYSQLI_ASSOC))
	{
		$categorydata[]=$row;
	}
	echo json_encode($categorydata);
}
else
{
	echo json_encode("nodatafound");
}	
?>