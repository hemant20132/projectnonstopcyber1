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
				platform='".$platform."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$saledate."' where id=".$saleid; 
			}
			else
			{
				$saleupdate="UPDATE fbastocksend 
				set receiptno='".$receiptno."',
				platform='".$platform."',
				addtinfo='".$adtinf."', 
				username='".$_SESSION['username']."', 
				tdate='".$saledate."' where id=".$saleid; 
			}		
			
			function date_compare($a, $b)
												{
													$t1 = strtotime($a['tdate']);
													$t2 = strtotime($b['tdate']);
													return $t1 - $t2;
												}

	if (mysqli_query($conn,$saleupdate))
	{
			$count=sizeof($productname);
			$insertcount=0;
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
					$array1=array_key_exists($i,$id);
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
					quantity='".$quantity[$i]."' where id=".$id[$i];
					if (mysqli_query($conn,$querypr))
					{
							if ($quantity[$i] > $previousstock)
							{
								$quantitydiff=floatval($quantity[$i])-floatval($previousstock);
								$updateproduct="update product set stocks_quantity=(stocks_quantity-".floatval($quantitydiff).") where nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
							if ($quantity[$i] < $previousstock)
							{
								$quantitydiff=floatval($previousstock)-floatval($quantity[$i]);
								$updateproduct="update product set stocks_quantity=(stocks_quantity+".floatval($quantitydiff).") where nsi_number='".$nsinumber[$i]."'";	
								mysqli_query($conn,$updateproduct);
							}
					}	
							//stocks update 
							$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
							$resultstock=mysqli_query($conn,$getstocks);
							while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
							{
							$productstock=floatval($rowstock['stocks_quantity']);	
							}
							$replacestock=floatval($productstock)-floatval($previousstock)+floatval($quantity[$i]);
							$updatestocks="update fba_product set stocks_quantity='".$replacestock."' where nsi_number='".$nsinumber[$i]."'";
							mysqli_query($conn,$updatestocks);
							//stocks update 
							$insertcount++;
				}
				else
				{
					// new product entry in fba product
					$fbainsert="INSERT INTO fba_product select * from product where nsi_number='".$nsinumber[$i]."'";
					mysqli_query($conn,$fbainsert);
					//set initial stock of stock received quantity;	
					$fbastockinitial="update fba_product set stocks_quantity='".$quantity[$i]."' where nsi_number='".$nsinumber[$i]."'" ;
					mysqli_query($conn,$fbastockinitial);
					// insert new data in fbastocksend_products
					$saleprinsert="INSERT INTO fbastocksend_products(saleid,receiptno, barcode, nsinumber, productname, quantity,fiforate) 
					VALUES ('".$saleid."','".$receiptno."','".$barcode[$i]."','".$nsinumber[$i]."','".$productname[$i]."','".$quantity[$i]."','".$fifoprice."')";		
					mysqli_query($conn,$saleprinsert);
					//stocks update 
					$getstocks="select nsi_number,stocks_quantity from fba_product where nsi_number='".$nsinumber[$i]."'";
					$resultstock=mysqli_query($conn,$getstocks);
					while ($rowstock=mysqli_fetch_array($resultstock,MYSQLI_ASSOC))
					{
					$productstock=floatval($rowstock['stocks_quantity']);	
					}
					// update product table
					$quantitydiff=floatval($quantity[$i]);
					$updateproduct="update product set stocks_quantity=(stocks_quantity-".floatval($quantitydiff).") where nsi_number='".$nsinumber[$i]."'";	
					mysqli_query($conn,$updateproduct);
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