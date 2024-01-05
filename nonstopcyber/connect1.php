	<?php
$con = mysqli_connect('localhost', 'root', '','nonstopcyber');
$category = $_POST['category'];
$sub_category = $_POST['sub_category'];
$brand = $_POST['brand'];
$nsi_number = $_POST['nsi_number'];
$barcode = $_POST['barcode'];
$product_name = $_POST['product_name'];
$second_name = $_POST['seocnd_name'];
$short_descript =$_POST['shortdescription'];
$long_descript =$_POST['longdescription'];
$purchase_date = date("Y-m-d",strtotime($_POST['purchase_date']));
$purchase_qty = $_POST['purchase_qty'];
$purchase_price = $_POST['purchase_price'];
$shelf_number = $_POST['shelf_number'];
 /* var_dump( $_POST );  */ 
$sql = "INSERT INTO product (category, sub_category, brand, nsi_number, barcode, product_name,second_name, shortdescription, 
logndescription,purchase_date, purchase_qty, purchase_price,shelf_number) 
VALUES ('$category', '$sub_category', '$brand', '$nsi_number', '$barcode', '$product_name','$second_name','$short_descript',
'$long_descript','$purchase_date', '$purchase_qty', '$purchase_price','$shelf_number')";
$rs = mysqli_query($con, $sql);
if($rs)
{
	header("Location: stocks.php"); 
}
?>