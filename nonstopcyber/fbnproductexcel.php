<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=fbnproductexcel.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include ('connection.php'); 
$today1=date('Y-m-d'); 
$today=date('d-m-Y');

					$brand1=urldecode($_GET['brand']);
					$category1=urldecode($_GET['category']);
					$subcategory1=urldecode($_GET['subcategory']);
					$platform1=urldecode($_GET['platform']);
							
					$query="select * from category order by id" ;
					 $category=mysqli_query($conn,$query);
					 $numrows=mysqli_num_rows($category);
					 $categorylist=array();
					if ($numrows>0)
					{
						while ($rowcat=mysqli_fetch_array($category, MYSQLI_ASSOC))
						{
							$categorylist[]=$rowcat;
						}	
					}	

					 $query1="select * from subcategory order by id" ;
					 $subcategory=mysqli_query($conn,$query1);
					 $numrows1=mysqli_num_rows($subcategory);
					 $subcategorylist=array();
					if ($numrows1>0)
					{
						while ($rowsubcat=mysqli_fetch_array($subcategory, MYSQLI_ASSOC))
						{
							$subcategorylist[]=$rowsubcat;
						}	
					}	


					 $querybrand="select * from brand order by id" ;
					 $brand=mysqli_query($conn,$querybrand);
					 $numrowsb=mysqli_num_rows($brand);
					 $brandlist=array();
					if ($numrowsb>0)
					{
						while ($rowbrand=mysqli_fetch_array($brand, MYSQLI_ASSOC))
						{
							$brandlist[]=$rowbrand;
						}	
					}

					$platform="select * from platform order by id";
						$platformresult=mysqli_query($conn,$platform);
						$platoformnum=mysqli_num_rows($platformresult);
						$platforms=array();
						while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
							{
								$platforms[]=$platformrow;
							}
				
if ($platform1 !="" and $brand1 !="" and $category1 !="" and $subcategory1 != "")
{
	$product="select * from fbn_product where platform='".$platform1."'  AND brand='".$brand1."' 
	AND category='".$category1."' AND subcategory='".$subcategory1."' order by s_no";
}
if ($platform1 !="" and $brand1 =="" and $category1 =="" and $subcategory1 == "")
{
	$product="select * from fbn_product where platform='".$platform1."' order by s_no";
}
if ($platform1 =="" and $brand1 !="" and $category1 =="" and $subcategory1 == "")
{
	$product="select * from fbn_product where brand='".$brand1."' order by s_no";
}
if ($platform1 =="" and $brand1 =="" and $category1 !="" and $subcategory1 == "")
{
	$product="select * from fbn_product where category='".$category1."' order by s_no";
}
if ($platform1 =="" and $brand1 =="" and category1 =="" and $subcategory1 != "")
{
	$product="select * from fbn_product where subcategory='".$subcategory1."' order by s_no";
}
if ($platform1 !="" and $brand1 !="" and $category1 =="" and $subcategory1 == "")
{
	$product="select * from fbn_product where  platform='".$platform1."'  and brand='".$brand1."' order by s_no";
}
if ($platform1 =="" and $brand1 =="" and $category1 !="" and $subcategory1 != "")
{
	$product="select * from fbn_product where category='".$category1."' and subcategory='".$subcategory1."' order by s_no";
}
if ($platform1 =="" and $brand1 =="" and $category1 =="" and $subcategory1 == "")
{
	$product="select * from fbn_product order by s_no";
}

$productresult=mysqli_query($conn,$product);
$productarr=array();
while($rowproduct=mysqli_fetch_array($productresult,MYSQLI_ASSOC))
{
	$productarr[]=$rowproduct;
}
$productreport="<center><p style='font-size:15pt;'>NonStopCyber -- FBN Stocks List -- ".$today."</p><br/></center>";
$productreport.="<table border='1'>";
$productreport.="<tr style='font-size:12pt;'><th>SrNo</th><th>Category</th><th>SubCategory</th><th>Brand</th><th>NsiNumber</th><th>BarCode</th><th>ProductName</th><th>ProductImages</th><th>SecondName</th><th>ShortDescription</th><th>QuantityInStock</th><th>Cost Price As Fifo</th><th>Shelf Number</th></tr>";

												function date_compare($a, $b)
													{
														$t1 = strtotime($a['tdate']);
														$t2 = strtotime($b['tdate']);
														return $t1 - $t2;
													}    
for ($i=0;$i<sizeof($productarr);$i++)
{
													//fifo price calculation	
								$fbnstockreceipt="select a.nsinumber,a.receiptno, a.quantity, a.fiforate as rate, 
													b.receiptno, b.tdate  
													from fbnstocksend_products as a, fbnstocksend as b 
													where b.id=a.saleid 
													and a.nsinumber='".$productarr[$i]['nsi_number']."' order by b.id desc";
													$fifoprice=0;
													$fbnstocksendresult=mysqli_query($conn,$fbnstockreceipt);
													$fbnstocksendarr=array();
													while($fbnstocksendrow=mysqli_fetch_array($fbnstocksendresult,MYSQLI_ASSOC))
													{
													$fbnstocksendarr[]=$fbnstocksendrow;	
													}
													$fbnreturn1="select a.nsinumber,a.returnorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbnreturn_products as a, fbnreturn1 as b 
													where b.id=a.returnid 
													and a.nsinumber='".$productarr[$i]['nsi_number']."' order by b.id desc";
													$fbnreturnresult=mysqli_query($conn,$fbnreturn1);
													if (mysqli_affected_rows($conn) > 0)
													{
														$fbnreturnarr=array();
														while($fbnreturnrow=mysqli_fetch_array($fbnreturnresult,MYSQLI_ASSOC))
														{
														$fbnreturnarr[]=$fbnreturnrow;	
														}
													}
													else
													{
														$fbnreturnarr=array();
													}
													
													$mixed=array();
													if (!empty($fbnreturnarr))
													{
													$mixed=array_merge($fbnstocksendarr, $fbnreturnarr);
													$sorted=usort($mixed, 'date_compare');
													}
													else
													{
													$mixed=$fbnstocksendarr;
													$sorted=usort($mixed, 'date_compare');
													}
													$fbnsales1="select a.nsinumber,a.saleorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbnsale_products as a, fbnsale as b 
													where b.id=a.saleid 
													and a.nsinumber='".$productarr[$i]['nsi_number']."' order by b.id";
													$fbnsaleresult1=mysqli_query($conn,$fbasales1);
													$fbnsalearr1=array();
													while($fbnsalerow=mysqli_fetch_array($fbnsaleresult1,MYSQLI_ASSOC))
													{
													$fbnsalearr1[]=$fbnsalerow;	
													}
													$fbntotalstocksend=0;
													for ($l=0;$l<sizeof($mixed);$l++)
													{
													$fbntotalstocksend=$fbntotalstocksend+$mixed[$l]['quantity'];
													}
													$fbntotalsale=0;
													for ($k=0;$k<sizeof($fbnsalearr1);$k++)
													{
													$fbntotalsale=$fbntotalsale+$fbnsalearr1[$k]['quantity'];
													}				
													$diff=$fbntotalstocksend-$fbntotalsale;
													//calculation of fifo price
												$categoryname='';
												for ($m=0;$m<sizeof($categorylist);$m++)
												{
													if ($categorylist[$m]['code']==$productarr[$i]['category'])
													{
													 $categoryname=$categorylist[$m]['categoryname'];
													}
												}
												$subcategoryname='';
												for ($n=0;$n<sizeof($subcategorylist);$n++)
												{
													if ($subcategorylist[$n]['subcategorycode']==$productarr[$i]['sub_category'])
													{
													 $subcategoryname=$subcategorylist[$n]['subcategoryname'];
													}
												}
												$brandname='';
												for ($l=0;$l<sizeof($brandlist);$l++)
												{
													if ($brandlist[$l]['code']==$productarr[$i]['brand'])
													{
													 $brandname=$brandlist[$l]['brand'];
													}
												}
			$productreport.="<tr><td>".($i+1)."</td><td>".$categoryname."</td><td>".$subcategoryname."</td><td>".$brandname."</td>";
			$productreport.="<td>".$productarr[$i]['nsi_number']."</td><td>".$productarr[$i]['barcode']."</td><td>".$productarr[$i]['product_name']."</td><td>".$productarr[$i]['product_images']."</td>";
			$productreport.="<td>".$productarr[$i]['second_name']."</td><td>".$productarr[$i]['short_description']."</td><td>".$productarr[$i]['stocks_quantity']."</td><td>".$fifoprice."</td></td><td>".$productarr[$i]['shelf_number']."</td></tr>";
			$firstrow=1;
}	
$productreport.="</table>";
echo $productreport;
?>