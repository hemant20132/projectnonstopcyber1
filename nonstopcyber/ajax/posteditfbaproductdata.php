<?php
session_start();
include('connection.php');
$sno=$_REQUEST['s_no'];
$category=$_REQUEST['category'];
$subcategory=$_REQUEST['subcategory'];
$brand=$_REQUEST['brand'];
$nsinumber=$_REQUEST['nsi_number'];
$barcode=$_REQUEST['barcode'];

$productname=$_REQUEST['product_name'];
$productname=str_replace("'","\'",$productname);
$productname=str_replace('"','\"',$productname);
$productname=str_replace("`","\`",$productname);
$productname=str_replace("•","&#8226;",$productname);
$productname=str_replace("®","&circledR;",$productname);

$secondname=$_REQUEST['second_name'];
$secondname=str_replace("'","\'",$secondname);
$secondname=str_replace('"','\"',$secondname);
$secondname=str_replace("`","\`",$secondname);
$secondname=str_replace("•","&#8226;",$secondname);
$secondname=str_replace("®","&circledR;",$secondname);

$shortdescription=$_REQUEST['shortdescription'];
$shortdescription=str_replace("'","\'",$shortdescription);
$shortdescription=str_replace('"','\"',$shortdescription);
$shortdescription=str_replace("`","\`",$shortdescription);
$shortdescription=str_replace("•","&#8226;",$shortdescription);
$shortdescription=str_replace("®","&circledR;",$shortdescription);

//$longdescription=filter_var($_REQUEST['longdescription'], FILTER_SANITIZE_ENCODED);
$longdescription=$_REQUEST['longdescription'];
$longdescription=str_replace("'","\'",$longdescription);
$longdescription=str_replace('"','\"',$longdescription);
$longdescription=str_replace("`","\`",$longdescription);
$longdescription=str_replace("•","&#8226;",$longdescription);
$longdescription=str_replace("®","&circledR;",$longdescription);
$shelfnumber=$_REQUEST['shelf_number'];
			if ($_FILES['multipleFile']['name'][0] != '') 
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
						$target_dir = '../fbaproductimages/'.$newFile; 	
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
				if ($productimages=='')
						{
						$productupdate="update fba_product 
						set category='".$category."', 
						sub_category='".$subcategory."', 
						brand='".$brand."', 
						nsi_number='".$nsinumber."', 
						barcode='".$barcode."', 
						product_name='".$productname."',
						second_name='".$secondname."', 
						short_description='".$shortdescription."',
						long_description='".$longdescription."',
						shelf_number ='".$shelfnumber."' where s_no=".$sno;
						}
						else
						{		
						$productupdate="update fba_product 
						set category='".$category."', 
						sub_category='".$subcategory."', 
						brand='".$brand."', 
						nsi_number='".$nsinumber."', 
						barcode='".$barcode."', 
						product_name='".$productname."',
						product_images='".$productimages."',
						second_name='".$secondname."', 
						short_description='".$shortdescription."',
						long_description='".$longdescription."',
						shelf_number ='".$shelfnumber."' where s_no=".$sno;
						}
		if (mysqli_query($conn,$productupdate))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>