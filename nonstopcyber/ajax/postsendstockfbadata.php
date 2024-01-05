<?php
session_start();
include('connection.php');
$receiptno=$_REQUEST['receiptno'];
$saledate=date("Y-m-d H:i:s",strtotime($_REQUEST['saledate']));
$platform=$_REQUEST['platform'];
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
						$target_dir = '../fbastocksendimages/'.$newFile; 	
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
			
	$saleinsert="INSERT INTO fbastocksend (sale_image, receiptno, platform, addtinfo, username, tdate) 
	VALUES ('".$saleimages."','".$receiptno."','".$platform."','".$adtinf."','".$_SESSION['username']
	."','".$saledate."')";
	
	if (mysqli_query($conn,$saleinsert))
	{
			$lastid=mysqli_insert_id($conn);
			$count=sizeof($productname);
			$insertcount=0;
													function date_compare($a, $b)
													{
														$t1 = strtotime($a['tdate']);
														$t2 = strtotime($b['tdate']);
														return $t1 - $t2;
													}    
			for ($i=0;$i<sizeof($productname);$i++)
			{
				//calculation of fifo price
													$purchase="select a.nsinumber,a.purchaseinvoiceno, a.quantity, a.rate, 
													b.invoiceno, b.tdate  
													from purchase_products as a, purchase as b 
													where b.id=a.purchaseid 
													and a.nsinumber='".$nsinumber[$i]."' order by b.id desc";
													$fifoprice=0;
													$purresult=mysqli_query($conn,$purchase);
													$purarr=array();
													while($purrow=mysqli_fetch_array($purresult,MYSQLI_ASSOC))
													{
													$purarr[]=$purrow;	
													}
													
													$return1="select a.nsinumber,a.returnorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from return_products as a, return1 as b 
													where b.id=a.returnid 
													and a.nsinumber='".$nsinumber[$i]."' order by b.id desc";
													$retresult=mysqli_query($conn,$return1);
													if (mysqli_affected_rows($conn) > 0)
													{
														$retarr=array();
														while($retrow=mysqli_fetch_array($retresult,MYSQLI_ASSOC))
														{
														$retarr[]=$retrow;	
														}
													}
													else
													{
														$retarr=array();
													}
													
													$mixed=array();
													if (!empty($retarr))
													{
													$mixed=array_merge($purarr, $retarr);
													$sorted=usort($mixed, 'date_compare');
													}
													else
													{
													$mixed=$purarr;
													$sorted=usort($mixed, 'date_compare');
													}
													
													$sales1="select a.nsinumber,a.saleorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from sale_products as a, sale as b 
													where b.id=a.saleid 
													and a.nsinumber='".$nsinumber[$i]."' order by b.id";
													$saleresult1=mysqli_query($conn,$sales1);
													$salearr1=array();
													while($salerow=mysqli_fetch_array($saleresult1,MYSQLI_ASSOC))
													{
													$salearr1[]=$salerow;	
													}
													$totalpur=0;
													for ($l=0;$l<sizeof($mixed);$l++)
													{
													$totalpur=$totalpur+$mixed[$l]['quantity'];
													}
													$totalsale=0;
													for ($k=0;$k<sizeof($salearr1);$k++)
													{
													$totalsale=$totalsale+$salearr1[$k]['quantity'];
													}				
													$diff=$totalpur-$totalsale;
													
													//calculation of fifo price
													$tqty=0;
													for ($s=0;$s<sizeof($mixed);$s++)
													{
													  $tqty=$tqty+$mixed[$s]['quantity'];
														if ($tqty >= $diff)
														{
														$fifoprice=$mixed[$s]['rate'];
														break;
														}
														else
														{
														}
													}
					//fifo price calculation
				
					$salesprinsert="INSERT INTO fbastocksend_products(saleid,receiptno, barcode, nsinumber, productname, quantity, fiforate) 
					VALUES ('".$lastid."','".$receiptno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$fifoprice ."')";		
					mysqli_query($conn,$salesprinsert);
					// check for fba stock entry 
					$fbastock="SELECT * FROM fba_product where nsi_number='".$nsinumber[$i]."'";
					$resultfba=mysqli_query($conn,$fbastock);
					$fbanumrows=mysqli_num_rows($resultfba);
					echo $fbanumrows;
					// check for fba stock entry 
					// if entry is found 
					if ($fbanumrows>0)
					{	
						//stocks update product 
						$getstocks="select nsi_number,stocks_quantity from product where nsi_number='".$nsinumber[$i]."'";
						$resultstock=mysqli_query($conn,$getstocks);
						while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
						{
						$productstock=floatval($rowstock['stocks_quantity']);	
						}
						$replacestock=$productstock-floatval($quantity[$i]);
						$updatestocks="update product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
						mysqli_query($conn,$updatestocks);
						// stocks update product
						
						//stocks update fba product 
						$fbastockset="update fba_product set stocks_quantity=stocks_quantity+".floatval($quantity[$i])." where nsi_number='".$nsinumber[$i]."'" ;
						mysqli_query($conn,$fbastockset);
						//stocks update fba product
					}
					else
					{		// if entry is not found create product entry
							$fbainsert="INSERT INTO fba_product (s_no,category,sub_category,brand,nsi_number,barcode,product_name,product_images,size,
							second_name,short_description,long_description,shelf_number) SELECT s_no,category,sub_category,brand,nsi_number,barcode,product_name,
							product_images,size,second_name,short_description,long_description,shelf_number FROM product where nsi_number='".$nsinumber[$i]."'";
							if (mysqli_query($conn,$fbainsert))
							{
									// copy images
										$productimg="select * from product where nsi_number='".$nsinumber[$i]."'";
										$resultproductimg=mysqli_query($conn,$productimg);
										while ($rowproductimg=mysqli_fetch_array($resultproductimg,MYSQLI_ASSOC))
										{
											$productimgs1=$rowproductimg['product_images'];
										}	
										$productimgs=explode(",",$productimgs1);
										for ($x=0;$x<sizeof($productimgs);$x++)
										{	
											$imagepath="/home/639380.cloudwaysapps.com/zzezcecvhx/public_html/productimages/".$productimgs[$x];
											$newname="/home/639380.cloudwaysapps.com/zzezcecvhx/public_html/fbaproductimages/".$productimgs[$x];
											$image1 = file_get_contents($imagepath);
											file_put_contents($newname, $image1);
										}
									 // copy images
									
								//set initial stock of stock received quantity;	
								$fbastockinitial="update fba_product set platform='".$platform."', stocks_quantity='".$quantity[$i]."' where nsi_number='".$nsinumber[$i]."'" ;
								mysqli_query($conn,$fbastockinitial);
								
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
					$notetext="Added New FBA Stock Send for product ".$productname[$i]." - Quantity-" .$quantity[$i]." - By: ".$_SESSION['name'];
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