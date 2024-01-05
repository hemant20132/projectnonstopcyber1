<?php
session_start();
include('connection.php');
$orderno=$_REQUEST['orderno'];
$saledate=date("Y-m-d H:i:s",strtotime($_REQUEST['saledate']));
$platform=$_REQUEST['platform'];
$productvalue=$_REQUEST['productvalue'];
$commissioncharges=$_REQUEST['commissioncharges'];
$shippingcharges=$_REQUEST['shippingcharges'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$barcode=$_REQUEST['barcode'];
$nsinumber=$_REQUEST['nsinumber'];
$productname=$_REQUEST['productname'];
$quantity=$_REQUEST['quantity'];
$rate=$_REQUEST['rate'];
$subtotal=$_REQUEST['subtotal'];
			if (!empty($_FILES['saleimg']['name'])) 
			{
				$multiplefile = $_FILES['saleimg'];
					$count=0;
					$saleimgarr=array();
					for($i=0;$i<sizeof($multiplefile['name']);$i++)
					{	
						$fileExnt = explode('.', $multiplefile['name'][$i]);
						$fileTmp = $multiplefile['tmp_name'][$i] ;
						if ($count==0)
							{	
								$newFile = 	$orderno. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$orderno.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../fbasaleimages/'.$newFile; 	
						$allowImg = array('png','jpeg','jpg','gif');	
						if (in_array($fileExnt[1], $allowImg)) 
						{
							if ($multiplefile['size'][$i] > 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($saleimgarr,$newFile);
										}
								}
						}
					}
			}
		$saleimages=implode(",",$saleimgarr);
		$saleinsert="INSERT INTO fbasale(sale_image, orderno, platform, product_value, commissioncharges, shippingcharges, totalamount, addtinfo, username, tdate) 
		VALUES ('".$saleimages."','".$orderno."','".$platform."','".$productvalue."','".$commissioncharges."','".$shippingcharges."','".$totalamount."','"
		.$adtinf."','".$_SESSION['username']."','".$saledate."')";
	if (mysqli_query($conn,$saleinsert))
	{
			$lastid=mysqli_insert_id($conn);
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
				$salesprinsert="INSERT INTO fbasale_products(saleid,saleorderno, barcode, nsinumber, productname, quantity, rate, subtotal) 
				VALUES ('".$lastid."','".$orderno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$rate[$i]."','".$subtotal[$i]."')";		
				mysqli_query($conn,$salesprinsert);
				//stocks update 
				$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
				$resultstock=mysqli_query($conn,$getstocks);
				while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
				{
				$productstock=floatval($rowstock['stocks_quantity']);	
				}
				$replacestock=$productstock-floatval($quantity[$i]);
				$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
				echo $updatestocks;
				mysqli_query($conn,$updatestocks);
				//stocks update
				$notetext="Added New FBA Sales for product ".$productname[$i]." - Quantity-" .$quantity[$i]." - By: ".$_SESSION['name'];
				//add notification
				$notepost="Insert into notification (notificationtext, username, tdate) values('".$notetext."','".$_SESSION['name']."',now())";
				mysqli_query($conn,$notepost);
				$insertcount++;
			}
			
			if ($count==$insertcount)
			{
			echo json_encode("success");
			}
			else
			{
			echo json_encode("error posting FBA productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>