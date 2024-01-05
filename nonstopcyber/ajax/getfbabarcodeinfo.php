<?php
include('connection.php');
$query="select product_name, barcode, nsi_number from fba_product where platform='".$_REQUEST['productplatform']."' and FIND_IN_SET ('".$_REQUEST['barcode']."', barcode)";
$fbaproducts=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($fbaproducts);
if ($numrows > 0)
{
	$productdetails=array();
	while ($row=mysqli_fetch_array($fbaproducts,MYSQLI_ASSOC))
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