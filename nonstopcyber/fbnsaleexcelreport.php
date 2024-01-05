<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=fbnsalesreport.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include ('connection.php'); 

$users="select name,username from user";
$userresult=mysqli_query($conn,$users);
$userarr=array();
while($rowuser=mysqli_fetch_array($userresult,MYSQLI_ASSOC))
{
	$userarr[]=$rowuser;
}

$sales="select * from fbnsale order by id";
$saleresult=mysqli_query($conn,$sales);
$salearr=array();
while($rowsale=mysqli_fetch_array($saleresult,MYSQLI_ASSOC))
{
	$salearr[]=$rowsale;
}

$salepro="select * from fbnsale_products order by id";
$saleprresult=mysqli_query($conn,$salepro);
$saleprarr=array();
while($rowsalepr=mysqli_fetch_array($saleprresult,MYSQLI_ASSOC))
{
	$saleprarr[]=$rowsalepr;
}
$salereport="<center><p style='font-size:15pt;'>NonStopCyber -- FBN Sale Report-</p></center><br/>";
$salereport.="<table border='1'>";
$salereport.="<tr style='font-size:12pt;'><th>SrNo</th><th>OrderNo</th><th>Date</th><th>BarCode</th><th>NsiNumber</th><th>AdditionalInfo</th><th>ProductName</th><th>Quantity</th><th>Rate</th><th>ProductValue</th><th>Commission</th><th>TotalAmount</th><th>FiFoPrice</th><th>UserName</th></tr>";
$saleid='';
			$totalqty=0;
			$totalprval=0;
			$totalcomm=0;
			$totalamt=0;
											function date_compare($a, $b)
												{
													$t1 = strtotime($a['tdate']);
													$t2 = strtotime($b['tdate']);
													return $t1 - $t2;
												}	

			
for ($i=0;$i<sizeof($salearr);$i++)
{
			$firstrow=0;
			for ($j=0;$j<sizeof($saleprarr);$j++)
			{
											//calculation of fifo price
													$fbnstockreceipt="select a.nsinumber,a.receiptno, a.quantity, a.fiforate as rate, 
													b.receiptno, b.tdate  
													from fbnstocksend_products as a, fbnstocksend as b 
													where b.id=a.saleid 
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id desc";
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
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id desc";
													$fbnreturnresult=mysqli_query($conn,$return1);
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
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id";
													$fbnsaleresult1=mysqli_query($conn,$fbnsales1);
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
					for ($r=0;$r<sizeof($userarr);$r++)
					{
							if ($userarr[$r]['username']==$salearr[$i]['username'])
							{
								$username=$userarr[$r]['name'];
							}
					}
				if ($firstrow==1 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td colspan=3></td><td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$salearr[$i]['addtinfo']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$saleprarr[$j]['rate']."</td><td>".$salearr[$i]['product_value']."</td><td>".$salearr[$i]['commissioncharges']."</td><td>".$salearr[$i]['totalamount']."</td><td>".$fifoprice."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
				}
				if ($firstrow==0 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td>".($i+1)."</td><td>".$salearr[$i]['orderno']."</td><td>".date('d-m-Y',strtotime($salearr[$i]['tdate']))."</td>";
					$salereport.="<td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$salearr[$i]['addtinfo']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$saleprarr[$j]['rate']."</td><td>".$salearr[$i]['product_value']."</td><td>".$salearr[$i]['commissioncharges']."</td><td>".$salearr[$i]['totalamount']."</td><td>".$fifoprice."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
					$totalprval=$totalprval+$salearr[$i]['product_value'];
					$totalcomm=$totalcomm+$salearr[$i]['commissioncharges'];
					$totalamt=$totalamt+$salearr[$i]['totalamount'];
					$firstrow=1;
				}
			}
}	
$salereport.="<tr style='font-size:12pt;'><td colspan='4'></td><td colspan=3></td><td>".$totalqty."</td><td></td><td>".$totalprval."</td><td>".$totalcomm."</td><td>".$totalamt."</td><td></td><td></td></tr>";
$salereport.="</table>";
echo $salereport;
?>