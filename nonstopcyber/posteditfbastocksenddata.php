
<?php
session_start();
include('connection.php');
$saleid=$_REQUEST['saleid'];
$receiptno=$_REQUEST['receiptno'];
$saledate=date("Y-m-d H:i:s",strtotime($_REQUEST['saledate']));
$platform=$_REQUEST['platform'];
$adtinf=$_REQUEST['adtinf'];
$id=$_REQUEST['id'];
$barcode=$_REQUEST['barcode'];
$nsinumber=$_REQUEST['nsinumber'];
$productname=$_REQUEST['productname'];
$quantity=$_REQUEST['quantity'];
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
								$newFile = 	$receiptno. '.'. $fileExnt[1];
							}
							else
							{	
								$newFile = 	$receiptno.'('.$count.')'.'.'.$fileExnt[1];
							}
						$count++;	
						$target_dir = '../fbastocksendimages/'.$newFile; 	
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
				$saleupdate="UPDATE fbastocksend 
				set sale_image='".$saleimages."',
				receiptno='".$receiptno."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$saledate."' where id=".$saleid; 
			}
			else
			{
				$saleupdate="UPDATE fbastocksend 
				set receiptno='".$receiptno."',
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
					$prevstock="select * from fbastocksend_products where id=".$id[$i];
					$stockresult=mysqli_query($conn,$prevstock);
					$stockrow=mysqli_fetch_assoc($stockresult);
					$previousstock=$stockrow['quantity'];
					$querypr="update fbastocksend_products 
					set barcode='".$barcode[$i]."',
					nsinumber='".$nsinumber[$i]."',
					productname='".$productname[$i]."',
					quantity='".$quantity[$i]."',
					where id=".$id[$i];
					mysqli_query($conn,$querypr);
			//stocks update 
			$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
			$resultstock=mysqli_query($conn,$getstocks);
			while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
			{
			$productstock=floatval($rowstock['stocks_quantity']);	
			}
			$replacestock=floatval($productstock)+floatval($previousstock)-floatval($quantity[$i]);
			$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
			mysqli_query($conn,$updatestocks);
			//stocks update 
			$insertcount++;
				}
				else
				{
					$saleprinsert="INSERT INTO fbastocksend_products(saleid,salereceiptno, barcode, nsinumber, productname, quantity) 
					VALUES ('".$saleid."','".$receiptno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$subtotal[$i]."')";		
					mysqli_query($conn,$saleprinsert);
							//stocks update 
					$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					$replacestock=$productstock-floatval($quantity[$i]);
					$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
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
			echo json_encode("error updating fba stocksend productdata");
			}
			
	}
	else
	{	
			echo json_encode("error");
	}
?>