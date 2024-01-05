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
								$newFile = 	$receiptno. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$receiptno.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../fbnstocksendimages/'.$newFile; 	
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
			
	$saleinsert="INSERT INTO fbnstocksend (sale_image, receiptno, platform, addtinfo, username, tdate) 
	VALUES ('".$saleimages."','".$receiptno."','".$platform."','".$adtinf."','".$_SESSION['username']
	."','".$saledate."')";
	if (mysqli_query($conn,$saleinsert))
	{
			$lastid=mysqli_insert_id($conn);
			$count=sizeof($productname);
			$insertcount=0;
			for ($i=0;$i<sizeof($productname);$i++)
			{
					$salesprinsert="INSERT INTO fbnstocksend_products(saleid,receiptno, barcode, nsinumber, productname, quantity) 
					VALUES ('".$lastid."','".$receiptno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."')";		
					mysqli_query($conn,$salesprinsert);
					// check for fbn stock entry 
					$fbnstock="SELECT * FROM fbn_product where nsi_number='".$nsinumber[$i]."'";
					$resultfbn=mysqli_query($conn,$fbnstock);
					$fbnnumrows=mysqli_num_rows($resultfbn);
					// check for fba stock entry 
					// if entry is found 
					if ($fbnnumrows>0)
					{	
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
					}
					else
					{		// if entry is not found create product entry
							$fbninsert="INSERT INTO fbn_product select * from product where nsi_number='".$nsinumber[$i]."'" ;
							if (mysqli_query($conn,$fbninsert))
							{
								//set initial stock of stock received quantity;	
								$fbnstockinitial="update fbn_product set stocks_quantity='".$quantity[$i]."' where nsi_number='".$nsinumber[$i]."'" ;
								mysqli_query($conn,$fbnstockinitial);
								
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
							}
					}
					
					//add notification
					$notetext="Added New FBN Stock Send for product ".$productname[$i]." - Quantity-" .$quantity[$i]." - By: ".$_SESSION['name'];
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
			echo json_encode("error posting fbnstocksend productdata");
			}
	}
	else
	{	
			echo json_encode("error");
	}
?>