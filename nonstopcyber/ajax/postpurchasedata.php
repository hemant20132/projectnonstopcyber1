<?php
session_start();
include('connection.php');
$invoiceno=$_REQUEST['invoiceno'];
$purchasedate=date("Y-m-d H:i:s",strtotime($_REQUEST['purchasedate']));
$productvalue=$_REQUEST['productvalue'];
$vat=$_REQUEST['vat'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$barcode=explode(",",$_REQUEST['barcode']);
$nsinumber=explode(",",$_REQUEST['nsinumber']);
$productname=explode(",",$_REQUEST['productname']);
$quantity=explode(",",$_REQUEST['quantity']);
$rate=explode(",",$_REQUEST['rate']);	
	//check for duplicate 
	$select="select * from purchase where invoiceno='".$invoiceno."'";
	$result=mysqli_query($conn,$select);
	$numrows=mysqli_num_rows($result);
	//check for duplicate 
	if ($numrows > 0)
	{
		echo json_encode("Purchase Entry already Exist.");
	}
	else
	{
			$purchaseinsert="INSERT INTO purchase(invoiceno, product_value, vat, totalamount, addtinfo, username, tdate) 
			VALUES ('".$invoiceno."','".$productvalue."','".$vat."','".$totalamount."','".$adtinf."','".$_SESSION['username']."','".$purchasedate. "')";
			if (mysqli_query($conn,$purchaseinsert))
			{
					$lastid=mysqli_insert_id($conn);
					$count=sizeof($productname);
					$insertcount=0;
					for ($i=0;$i<sizeof($productname);$i++)
					{
					$purchaseprinsert="INSERT INTO purchase_products(purchaseid,purchaseinvoiceno, barcode, nsinumber, productname, quantity, rate) 
					VALUES ('".$lastid."','".$invoiceno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$rate[$i]."')";		
					mysqli_query($conn,$purchaseprinsert);
					//stocks update 
					$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=$productstock+floatval($quantity[$i]);
					$updatestocks="update product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
					mysqli_query($conn,$updatestocks);
					//stocks update 
					$insertcount++;
					}	
					
					if ($count==$insertcount)
					{
								
								echo json_encode("success");
					}
					else
					{
					echo json_encode("error posting productdata");
					}
			}
			else
			{	
					echo json_encode("error");
			}
	}
?>