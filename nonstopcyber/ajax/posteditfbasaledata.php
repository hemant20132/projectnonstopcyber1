
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
$id=$_REQUEST['id'];
$barcode=$_REQUEST['barcode'];
$nsinumber=$_REQUEST['nsinumber'];
$productname=$_REQUEST['productname'];
$quantity=$_REQUEST['quantity'];
$rate=$_REQUEST['rate'];
$subtotal=$_REQUEST['subtotal'];
	if ($_FILES['saleimg']['name'][0]!="") 
			{
					$multiplefile = $_FILES['saleimg']['name'];
					$count=0;
					$saleimgarr=array();
					foreach ($multiplefile as $name => $value) 
					{
						$allowImg = array('png','jpeg','jpg','gif');	
						$fileExnt = explode('.', $multiplefile[$name]);
						$fileTmp = $_FILES['saleimg']['tmp_name'][$name];
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
						if (in_array($fileExnt[1], $allowImg)) 
						{
							if ($_FILES['saleimg']['size'][$name] > 0 && $_FILES['saleimg']['error'][$name]== 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($saleimgarr,$newFile);
										}
								}
						}				
					}
				$saleimages=implode(",",$saleimgarr);
				$saleupdate="UPDATE fbasale 
				set 
				sale_image='".$saleimages."',
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
				$saleupdate="UPDATE fbasale 
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
					$prevstock="select * from fbasale_products where id=".$id[$i];
					$stockresult=mysqli_query($conn,$prevstock);
					$stockrow=mysqli_fetch_assoc($stockresult);
					$previousstock=$stockrow['quantity'];
					$querypr="update fbasale_products 
					set barcode='".$barcode[$i]."',
					nsinumber='".$nsinumber[$i]."',
					productname='".$productname[$i]."',
					quantity='".$quantity[$i]."',
					rate='".$rate[$i]."',
					subtotal='".$subtotal[$i]."' 
					where id=".$id[$i];
					if (mysqli_query($conn,$querypr))
					{
							if ($quantity[$i] > $previousstock)
							{
								$quantitydiff=floatval($quantity[$i])-floatval($previousstock);
								$updateproduct="update fba_product set stocks_quantity=(stocks_quantity-".floatval($quantitydiff).") where  platform='".$platform."' and nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
							if ($quantity[$i] < $previousstock)
							{
								$quantitydiff=floatval($previousstock)-floatval($quantity[$i]);
								$updateproduct="update fba_product set stocks_quantity=(stocks_quantity+".floatval($quantitydiff).") where  platform='".$platform."' and nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
					}
				//stocks update 
				$insertcount++;
				}
				else
				{
					$saleprinsert="INSERT INTO fbasale_products(saleid,saleorderno, barcode, nsinumber, productname, quantity,rate,subtotal) 
					VALUES ('".$saleid."','".$orderno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$rate[$i]."','".$subtotal[$i]."')";		
					mysqli_query($conn,$saleprinsert);
							//stocks update 
					$getstocks="select nsi_number,stocks_quantity from fbaproduct where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$quantitydiff=floatval($quantity[$i]);
					$updatestocks="update fba_product set stocks_quantity=(stocks_quantity-".floatval($quantitydiff).") where platform='".$platform."' and nsi_number='".$nsinumber[$i]."'";
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
			echo json_encode("error updating fba productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>