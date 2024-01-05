<?php
include('connection.php');
$query="select a.id as saleid, a.sale_image, a.orderno, a.platform, a.product_value,a.totalamount, a.addtinfo,
a.commissioncharges, b.* from fbnsale as a, fbnsale_products as b 
where a.id=b.saleid and a.orderno='".$_REQUEST['orderno']."'";
$sales=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($sales);
if ($numrows>0)
{
	$salesdetail=array();
	while ($row=mysqli_fetch_array($sales,MYSQLI_ASSOC))
	{
		$salesdetail[]=$row;
	}
	echo json_encode($salesdetail);
}
else
{
	$salesdetail[0]["error"]="nosuccess";
	echo json_encode($salesdetail);
}	
?>