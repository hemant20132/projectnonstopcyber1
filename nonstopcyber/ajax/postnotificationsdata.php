<?php
session_start();
include('connection.php');
$category=$_REQUEST['category'];
$subcategory=$_REQUEST['subcategory'];
$brand=$_REQUEST['brand'];
$nsinumber=$_REQUEST['nsi_number'];
$barcode=$_REQUEST['barcode'];
$productname=$_REQUEST['product_name'];
$productsize=$_REQUEST['product_size'];
$secondname=$_REQUEST['second_name'];
$shortdescription=$_REQUEST['shortdescription'];
$longdescription=filter_var($_REQUEST['longdescription'], FILTER_SANITIZE_ENCODED);
$purchasedate=date("Y-m-d",strtotime($_REQUEST['purchase_date']));
$purchaseqty=$_REQUEST['purchase_qty'];
$purchaseprice=$_REQUEST['purchase_price'];
$shelfnumber=$_REQUEST['shelf_number'];
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
		$productinsert="INSERT INTO product(category, sub_category, brand, nsi_number, barcode, product_name,size,product_images,second_name, short_description,long_description,purchase_date,purchase_qty, purchase_price, shelf_number) VALUES ('$category','$subcategory','$brand','$nsinumber',$barcode,'$productname',
		'$productsize','$productimages','$secondname','$shortdescription','$longdescription','$purchasedate','$purchaseqty','$purchaseprice','$shelfnumber')";	
		
		if (mysqli_query($conn,$productinsert))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>