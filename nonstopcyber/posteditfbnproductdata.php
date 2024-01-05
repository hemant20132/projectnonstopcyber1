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
$secondname=$_REQUEST['second_name'];
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
$productfiles=$_FILES['multipleFile'];
	if ($productfiles['name'][0] != "")
			{
					$multiplefile = $_FILES['multipleFile']['name'];
					$count=0;
					$productimgarr=array();
					for($a=0;$a<sizeof($multiplefile);$a++) 
					{
						$allowImg = array('png','jpeg','jpg','gif');	
						$fileExnt = explode('.', $multiplefile[$a]);
						$fileTmp = $_FILES['multipleFile']['tmp_name'][$a];
						if ($count==0)
							{	
								$newFile = 	$nsinumber. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$nsinumber.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../fbnstocksendimages/'.$newFile;
							if ($_FILES['multipleFile']['size'][$a] > 0) 
								{
									if (move_uploaded_file($fileTmp, $target_dir)) 
										{
										array_push($productimgarr,$newFile);
										}
								}
					}
					$productimages=implode(",",$productimgarr);
					
						if ($productimages=='')
						{
						$productupdate="update fbn_product 
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
						$productupdate="update fbn_product 
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
			}
			else
			{
						$productupdate="update fbn_product 
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
		
		if (mysqli_query($conn,$productupdate))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}		
?>