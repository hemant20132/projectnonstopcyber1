<?php
session_start();
include('connection.php');
$purchaseid=$_REQUEST['purchaseid'];
$invoiceno=$_REQUEST['invoiceno'];
$purchasedate=date("Y-m-d H:i:s",strtotime($_REQUEST['purchasedate']));
$productvalue=$_REQUEST['productvalue'];
$vat=$_REQUEST['vat'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$id=explode(",",$_REQUEST['id']);
$barcode=explode(",",$_REQUEST['barcode']);
$nsinumber=explode(",",$_REQUEST['nsinumber']);
$productname=explode(",",$_REQUEST['productname']);
$quantity=explode(",",$_REQUEST['quantity']);
$rate=explode(",",$_REQUEST['rate']);	
			$purchaseupdate="UPDATE purchase 
				set product_value='".$productvalue."',
				invoiceno='".$invoiceno."',
				vat='".$vat."',
				totalamount='".$totalamount."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$purchasedate."' where id=".$purchaseid; 
	
	if (mysqli_query($conn,$purchaseupdate))
	{
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
				if (array_key_exists($i, $id))
				{
					$prevstock="select * from purchase_products where id=".$id[$i];
					$stockresult=mysqli_query($conn,$prevstock);
					$stockrow=mysqli_fetch_assoc($stockresult);
					$previousstock=$stockrow['quantity'];
					$querypr="update purchase_products 
					set barcode='".$barcode[$i]."',
					nsinumber='".$nsinumber[$i]."',
					productname='".$productname[$i]."',
					quantity='".$quantity[$i]."',
					rate='".$rate[$i]."' where id=".$id[$i];
					mysqli_query($conn,$querypr);
					//stocks update 
					$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=floatval($productstock)-floatval($previousstock)+floatval($quantity[$i]);
					$updatestocks="update product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
					mysqli_query($conn,$updatestocks);
					//stocks update 
					$insertcount++;
				}
				else
				{
						$purchaseprinsert="INSERT INTO purchase_products(purchaseid,purchaseinvoiceno, barcode, nsinumber, productname, quantity,rate) 
						VALUES ('".$purchaseid."','".$invoiceno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$rate[$i]."')";		
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
			
			}	
			if ($count==$insertcount)
			{
			echo json_encode("success");
			}
			else
			{
			echo json_encode("error updating productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>