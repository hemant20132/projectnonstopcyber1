<?php
session_start();
include('connection.php');
$category=$_REQUEST['category'];
$subcategory=$_REQUEST['subcategory'];
$brand=$_REQUEST['brand'];
$nsinumber=$_REQUEST['nsi_number'];
$barcode=$_REQUEST['barcode'];
$productname=$_REQUEST['productname'];
$productsize=$_REQUEST['productsize'];
$secondname=$_REQUEST['secondname'];
$shortdescription=$_REQUEST['shortdescription'];
$longdescription=$_REQUEST['longdescription'];
$longdescription=str_replace("'","\'",$longdescription);
$longdescription=str_replace('"','\"',$longdescription);
$purchasedate=date("Y-m-d",strtotime($_REQUEST['purchasedate']));
$purchaseqty=$_REQUEST['purchaseqty'];
$purchaseprice=$_REQUEST['purchaseprice'];
$shelfnumber=$_REQUEST['shelfnumber'];
			$files=$_REQUEST['files'];
			print_r($files);
			exit;
			if (!empty($_FILES['multipleFile']['name'])) 
			{
				$multiplefile = $_FILES['multipleFile']['name'];
					$count=0;
					$productimgarr=array();
					foreach ($multiplefile as $name => $value) 
					{
						$allowImg = array('png','jpeg','jpg','gif');	
						$fileExnt = explode('.', $multiplefile[$name]);
						$fileTmp = $_FILES['multipleFile']['tmp_name'][$name];
						if ($count==0)
							{	
								$newFile = 	$nsinumber. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$nsinumber.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../productimages/'.$newFile; 	
						if (in_array($fileExnt[1], $allowImg)) 
						{
							if ($_FILES['multipleFile']['size'][$name] > 0 && $_FILES['multipleFile']['error'][$name]== 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($productimgarr,$newFile);
										}
								}
						}				
					}
			}
		$productimages=implode(",",$productimgarr);
		$productinsert="INSERT INTO product(category, sub_category, brand, nsi_number, barcode, product_name,size,product_images,second_name, short_description,long_description,stocks_quantity,purchase_date,purchase_qty, purchase_price, shelf_number) VALUES ('$category','$subcategory','$brand','$nsinumber',$barcode,'$productname',
		'$productsize','$productimages','$secondname','$shortdescription','$longdescription','0','$purchasedate','$purchaseqty','$purchaseprice','$shelfnumber')";	
		echo $productinsert;
		if (mysqli_query($conn,$productinsert))
		{
			//add notification
			$notetext="Added New Product ".$productname." - By: ".$_SESSION['name'];
			$notepost="Insert into notification (notificationtext, username, tdate) values('".$notetext."','".$_SESSION['name']."',now())";
			mysqli_query($conn,$notepost);
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>