<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=fbnsendstockexcelreport.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include ('connection.php'); 
$platform=$_REQUEST['platform'];
$fromdate=date("Y-m-d",strtotime($_REQUEST['fromdate']));
$todate=date("Y-m-d",strtotime($_REQUEST['todate']));
$users="select name,username from user";
$userresult=mysqli_query($conn,$users);
$userarr=array();
while($rowuser=mysqli_fetch_array($userresult,MYSQLI_ASSOC))
{
	$userarr[]=$rowuser;
}
$sales="select * from fbnstocksend where platform='".$platform."' and tdate >='".$fromdate."' and tdate <='".$todate."' order by id";
$saleresult=mysqli_query($conn,$sales);
$salearr=array();
while($rowsale=mysqli_fetch_array($saleresult,MYSQLI_ASSOC))
{
	$salearr[]=$rowsale;
}

$salepro="select * from fbnstocksend_products order by id";
$saleprresult=mysqli_query($conn,$salepro);
$saleprarr=array();
while($rowsalepr=mysqli_fetch_array($saleprresult,MYSQLI_ASSOC))
{
	$saleprarr[]=$rowsalepr;
}
$salereport="<center><p style='font-size:15pt;'>NonStopCyber -- FBN Stock Send Report-</p></center><br/>";
$salereport.="<table border='1'>";
$salereport.="<tr style='font-size:12pt;'><th>SrNo</th><th>ReceiptNo</th><th>Date</th><th>BarCode</th><th>NsiNumber</th><th>AdditionalInfo</th><th>ProductName</th><th>Quantity</th><th>FiFoPrice</th><th>UserName</th></tr>";
$saleid='';
			$totalqty=0;
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
													$purchase="select a.nsinumber,a.purchaseinvoiceno, a.quantity, a.rate, 
													b.invoiceno, b.tdate  
													from purchase_products as a, purchase as b 
													where b.id=a.purchaseid 
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id desc";
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
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id desc";
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
													and a.nsinumber='".$saleprarr[$j]['nsinumber']."' order by b.id";
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
					for ($r=0;$r<sizeof($userarr);$r++)
					{
							if ($userarr[$r]['username']==$salearr[$i]['username'])
							{
								$username=$userarr[$r]['name'];
							}
					}
				if ($firstrow==1 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td colspan=3></td><td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$salearr[$i]['addtinfo']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$fifoprice."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
				}
				if ($firstrow==0 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td>".($i+1)."</td><td>".$salearr[$i]['receiptno']."</td><td>".date('d-m-Y',strtotime($salearr[$i]['tdate']))."</td>";
					$salereport.="<td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$salearr[$i]['addtinfo']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$fifoprice."</td><td>".$username."</td></tr>";
					$firstrow=1;
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
				}
			}
			
}	
$salereport.="<tr style='font-size:12pt;'><td colspan='4'></td><td colspan=3></td><td>".$totalqty."</td><td></td><td></td></tr>";
$salereport.="</table>";
echo $salereport;
?>