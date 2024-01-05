<?php
session_start();
include('connection.php');
$returnid=$_REQUEST['returnid'];
$orderno=$_REQUEST['orderno'];
$optgroup=$_REQUEST['optgroup'];
$platform=$_REQUEST['platform'];
$totalamount=$_REQUEST['totalamount'];
$adtinf=$_REQUEST['adtinf'];
$barcode=$_REQUEST['barcode'];
$nsinumber=$_REQUEST['nsinumber'];
$productname=$_REQUEST['productname'];
$quantity=$_REQUEST['quantity'];
$rate=$_REQUEST['rate'];
$subtotal=$_REQUEST['subtotal'];
print_r($_FILES);
/*
			if (!empty($_FILES['returnimg']['name'])) 
			{
				$multiplefile = $_FILES['returnimg'];
					$count=0;
					$returnimgarr=array();
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
						$target_dir = '../fbareturnimages/'.$newFile; 	
						$allowImg = array('png','jpeg','jpg','gif');	
						if (in_array($fileExnt[1], $allowImg)) 
						{
							if ($multiplefile['size'][$i] > 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($returnimgarr,$newFile);
										}
								}
						}
					}
			}
		$returnimages=implode(",",$returnimgarr);
		$returninsert="INSERT INTO fbareturn1(return_image, orderno, platform, totalamount, addtinfo, username, tdate) 
		VALUES ('".$returnimages."','".$orderno."','".$platform."','".$totalamount."','".$adtinf."','".$_SESSION['username']."',now())";
		echo $returninsert;
	if (mysqli_query($conn,$returninsert))
	{
			$lastid=mysqli_insert_id($conn);
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
			$returnprinsert="INSERT INTO fbareturn_products(returnid,returnorderno, barcode, nsinumber, productname, quantity, isdamaged, rate) 
			VALUES ('".$lastid."','".$orderno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i].
			"','".$damagestatus[$i]."','".$rate[$i]."')";
			echo $returnprinsert;
			mysqli_query($conn,$returnprinsert);
			//stocks update 
			if ($damagestatus[$i]=="notdamaged")
			{	
					$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=$productstock+floatval($quantity[$i]);
					$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
					echo $updatestocks;
					mysqli_query($conn,$updatestocks);
					//stocks update
					$notetext="Added New FBA-Return for product ".$productname[$i]." - Quantity-" .$quantity[$i]." - By: ".$_SESSION['name'];
					//add notification
					$notepost="Insert into notification (notificationtext, username, tdate) values('".$notetext."','".$_SESSION['name']."',now())";
					mysqli_query($conn,$notepost);
			
			}
			//stocks update 
			$insertcount++;
			}	
			
			if ($count==$insertcount)
			{
			echo json_encode("success");
			}
			else
			{
			echo json_encode("error posting fba return productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>