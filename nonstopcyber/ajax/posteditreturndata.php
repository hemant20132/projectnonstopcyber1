<?php
session_start();
include('connection.php');
$returnid=$_REQUEST['returnid'];
$orderno=$_REQUEST['orderno'];
$returndate=date("Y-m-d",strtotime($_REQUEST['returndate']));
$optgroup=$_REQUEST['optgroup'];
$platform=$_REQUEST['platform'];
$productvalue=$_REQUEST['productvalue'];
$commissioncharges=$_REQUEST['commissioncharges'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$id=$_REQUEST['id'];
$barcode=$_REQUEST['barcode'];
$nsinumber=$_REQUEST['nsinumber'];
$productname=$_REQUEST['productname'];
$quantity=$_REQUEST['quantity'];
$damagestatus=$_REQUEST['damagestatus'];
$rate=$_REQUEST['rate'];
$subtotal=$_REQUEST['subtotal'];
	$returnfiles=$_FILES['returnimg'];
	if ($returnfiles['name'][0] != "")
			{
					$multiplefile = $_FILES['returnimg']['name'];
					$count=0;
					$returnimgarr=array();
					for($a=0;$a<sizeof($multiplefile);$a++) 
					{
						$allowImg = array('png','jpeg','jpg','gif');	
						$fileExnt = explode('.', $multiplefile[$a]);
						$fileTmp = $_FILES['returnimg']['tmp_name'][$a];
						if ($count==0)
							{	
								$newFile = 	$orderno. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$orderno.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../returnimages/'.$newFile;
							if ($_FILES['returnimg']['size'][$a] > 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($returnimgarr,$newFile);
										}
								}
					}
				$returnimages=implode(",",$returnimgarr);
				$returnupdate="UPDATE return1 
				set return_image='".$returnimages."',
				totalamount='".$totalamount."',
				orderno='".$orderno."',
				platform='".$platform."',
				product_value='".$productvalue."',
				commissioncharges='".$commissioncharges."',
				totalamount='".$totalamount."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$returndate."' where id=".$returnid; 
	}
		else
	{	
				$returnupdate="UPDATE return1 
				set totalamount='".$totalamount."',
				orderno='".$orderno."',
				platform='".$platform."',
				product_value='".$productvalue."',
				commissioncharges='".$commissioncharges."',
				totalamount='".$totalamount."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$returndate."' where id=".$returnid; 
	}

	if (mysqli_query($conn,$returnupdate))
	{
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
				if (array_key_exists($i, $id))
				{
					$prevstock="select * from return_products where id=".$id[$i];
					$stockresult=mysqli_query($conn,$prevstock);
					$stockrow=mysqli_fetch_assoc($stockresult);
					$previousstock=$stockrow['quantity'];
					$querypr="update return_products 
					set barcode='".$barcode[$i]."',
					nsinumber='".$nsinumber[$i]."',
					productname='".$productname[$i]."',
					quantity='".$quantity[$i]."',
					isdamaged='".$damagestatus[$i]."', 
					rate='".$rate[$i]."', subtotal='".$subtotal[$i]."' where id=".$id[$i];
					if (mysqli_query($conn,$querypr))
					{
							if ($quantity[$i] > $previousstock)
							{
								$quantitydiff=floatval($quantity[$i])-floatval($previousstock);
								$updateproduct="update product set stocks_quantity=(stocks_quantity+".floatval($quantitydiff).") where nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
							if ($quantity[$i] < $previousstock)
							{
								$quantitydiff=floatval($previousstock)-floatval($quantity[$i]);
								$updateproduct="update product set stocks_quantity=(stocks_quantity-".floatval($quantitydiff).") where nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
					}
					$insertcount++;
				}
				else
				{
					$returnprinsert="INSERT INTO return_products(returnid,returnorderno, barcode, nsinumber, productname, quantity,isdamaged,rate) 
					VALUES ('".$returnid."','".$orderno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$damagestatus[$i]."','".$rate[$i]."')";		
					mysqli_query($conn,$returnprinsert);
							//stocks update 
					$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=$productstock+floatval($quantity[$i]);
					$updatestocks="update product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
					echo $updatestocks;
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