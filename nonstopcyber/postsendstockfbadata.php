<?php
session_start();
include('connection.php');
$receiptno=$_REQUEST['receiptno'];
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
print_r($_FILES); exit;
		if (!empty($_FILES['saleimg']['name'])) 
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
								$newFile = 	$nsinumber. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$nsinumber.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../fbasendstockimages/'.$newFile; 	
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
			}
		$saleimages=implode(",",$saleimgarr);
			echo $saleimages;
			exit;
			
	$saleinsert="INSERT INTO fbastocksend (sale_image, receiptno, platform, addtinfo, username, tdate) 
	VALUES ('".$saleimages."','".$receiptno."','".$platform."','".$adtinf."','".$_SESSION['username']
	."','".$saledate."')";
	echo $saleinsert;
	if (mysqli_query($conn,$saleinsert))
	{
			$lastid=mysqli_insert_id($conn);
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
			$salesprinsert="INSERT INTO fbastocksend_products(saleid,saleorderno, barcode, nsinumber, productname, quantity) 
			VALUES ('".$lastid."','".$orderno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."')";		
			echo $salesprinsert;
			mysqli_query($conn,$salesprinsert);
			//stocks update 
			$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
			$resultstock=mysqli_query($conn,$getstocks);
			while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
			{
			$productstock=floatval($rowstock['stocks_quantity']);	
			}
			$replacestock=$productstock-floatval($quantity[$i]);
			$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
			mysqli_query($conn,$updatestocks);
			//stocks update
			$notetext="Added New FBA Stock Send for product ".$productname[$i]." - Quantity-" .$quantity[$i]." - By: ".$_SESSION['name'];
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
			echo json_encode("error posting fbastocksend productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>