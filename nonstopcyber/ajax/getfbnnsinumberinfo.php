<?php
include('connection.php');
$query="select product_name, barcode, nsi_number from fbn_product where platform='".$_REQUEST['platform']."' and nsi_number='".$_REQUEST['nsinumber']."'";
$products=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($products);
if ($numrows>0)
{
	$productdetails=array();
	while ($row=mysqli_fetch_array($products,MYSQLI_ASSOC))
	{
		$productdetails[]=$row;
	}
	echo json_encode($productdetails);
}
else
{
	$productdetails[0]["error"]="nosuccess";
	echo json_encode($productdetails);
}	
?>