
<?php
session_start();
include('connection.php');
$saleid=$_REQUEST['saleid'];
$orderno=$_REQUEST['orderno'];
$saledate=date("Y-m-d H:i:s",strtotime($_REQUEST['saledate']));
$platform=$_REQUEST['platform'];
$productvalue=$_REQUEST['productvalue'];
$commissioncharges=$_REQUEST['commissioncharges'];
$shippingcharges=$_REQUEST['shippingcharges'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$id=explode(",",$_REQUEST['id']);
$barcode=explode(",",$_REQUEST['barcode']);
$nsinumber=explode(",",$_REQUEST['nsinumber']);
$productname=explode(",",$_REQUEST['productname']);
$quantity=explode(",",$_REQUEST['quantity']);
$rate=explode(",",$_REQUEST['rate']);
$subtotal=explode(",",$_REQUEST['subtotal']);
			if (isset($_FILES['file']['name']))
			{
				$salesimg=$_FILES['file']['name'];
				$ext = pathinfo($salesimg, PATHINFO_EXTENSION);
				$imagename=$orderno.".".$ext;
				$targetfile='../saleimages/'.$orderno.".".$ext;
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetfile))
				{
				$uploaded=true;	
				}
				$saleupdate="UPDATE sale 
				set 
				sale_image='".$imagename."',
				product_value='".$productvalue."',
				orderno='".$orderno."',
				commissioncharges='".$commissioncharges."',
				shippingcharges='".$shippingcharges."',
				totalamount='".$totalamount."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$saledate."' where id=".$saleid; 
			}
			else
			{
				$saleupdate="UPDATE sale 
				set product_value='".$productvalue."',
				orderno='".$orderno."',
				commissioncharges='".$commissioncharges."',
				shippingcharges='".$shippingcharges."',
				totalamount='".$totalamount."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$saledate."' where id=".$saleid; 
			}		
	
	if (mysqli_query($conn,$saleupdate))
	{
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
				if (array_key_exists($i, $id))
				{
					$prevstock="select * from sale_products where id=".$id[$i];
					$stockresult=mysqli_query($conn,$prevstock);
					$stockrow=mysqli_fetch_assoc($stockresult);
					$previousstock=$stockrow['quantity'];
					$querypr="update sale_products 
					set barcode='".$barcode[$i]."',
					nsinumber='".$nsinumber[$i]."',
					productname='".$productname[$i]."',
					quantity='".$quantity[$i]."',
					rate='".$rate[$i]."',
					subtotal='".$subtotal[$i]."' 
					where id=".$id[$i];
					mysqli_query($conn,$querypr);
			//stocks update 
			$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
			$resultstock=mysqli_query($conn,$getstocks);
			while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
			{
			$productstock=floatval($rowstock['stocks_quantity']);	
			}
			$replacestock=floatval($productstock)+floatval($previousstock)-floatval($quantity[$i]);
			$updatestocks="update product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
			mysqli_query($conn,$updatestocks);
			//stocks update 
			$insertcount++;
				}
				else
				{
					$saleprinsert="INSERT INTO sale_products(saleid,saleorderno, barcode, nsinumber, productname, quantity,rate,subtotal) 
					VALUES ('".$saleid."','".$invoiceno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$rate[$i]."','".$subtotal[$i]."')";		
					mysqli_query($conn,$saleprinsert);
							//stocks update 
					$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=$productstock-floatval($quantity[$i]);
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