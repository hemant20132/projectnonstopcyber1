<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=purchasereport.xls");  //File name extension was wrong
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

$purchase="select * from purchase order by id";
$purchaseresult=mysqli_query($conn,$purchase);
$purchasearr=array();
while($rowpurchase=mysqli_fetch_array($purchaseresult,MYSQLI_ASSOC))
{
	$purchasearr[]=$rowpurchase;
}

$purchasepro="select * from purchase_products order by id";
$purchaseprresult=mysqli_query($conn,$purchasepro);
$purchaseprarr=array();
while($rowpurchasepr=mysqli_fetch_array($purchaseprresult,MYSQLI_ASSOC))
{
	$purchaseprarr[]=$rowpurchasepr;
}
$purchasereport="<center><p style='font-size:15pt;'>NonStopCyber -- Purchase Report-</p></center><br/>";
$purchasereport.="<table border='1'>";
$purchasereport.="<tr style='font-size:12pt;'><th>SrNo</th><th>InvoiceNo</th><th>Date</th><th>BarCode</th><th>NsiNumber</th><th>ProductName</th><th>AdditionalInfo</th><th>Quantity</th><th>Rate</th><th>ProductValue</th><th>Vat</th><th>TotalAmount</th><th>FiFoPrice</th><th>UserName</th></tr>";
$purchaseid='';
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
for ($i=0;$i<sizeof($purchasearr);$i++)
{
			$firstrow=0;
			for ($j=0;$j<sizeof($purchaseprarr);$j++)
			{
													//calculation of fifo price
													$purchase="select a.nsinumber,a.purchaseinvoiceno, a.quantity, a.rate, 
													b.invoiceno, b.tdate  
													from purchase_products as a, purchase as b 
													where b.id=a.purchaseid 
													and a.nsinumber='".$purchaseprarr[$j]['nsinumber']."' order by b.id desc";
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
													and a.nsinumber='".$purchaseprarr[$j]['nsinumber']."' order by b.id desc";
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
													and a.nsinumber='".$purchaseprarr[$j]['nsinumber']."' order by b.id";
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
							if ($userarr[$r]['username']==$purchasearr[$i]['username'])
							{
								$username=$userarr[$r]['name'];
							}
					}
					
				if ($firstrow==1 and ($purchasearr[$i]['id']==$purchaseprarr[$j]['purchaseid']))
				{
					$purchasereport.="<tr><td colspan='6'></td><td>".$purchaseprarr[$j]['barcode']."</td><td>".$purchaseprarr[$j]['nsinumber']."</td><td>".$purchaseprarr[$j]['productname']."</td><td>".$purchasearr[$i]['addtinfo']."</td><td>".$purchaseprarr[$j]['quantity']."</td><td>".$purchaseprarr[$j]['rate']."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$purchaseprarr[$j]['quantity'];	    
				}
				if ($firstrow==0 and ($purchasearr[$i]['id']==$purchaseprarr[$j]['purchaseid']))
				{
					$purchasereport.="<tr><td>".($i+1)."</td><td>".$purchasearr[$i]['invoiceno']."</td><td>".date('d-m-Y',strtotime($purchasearr[$i]['tdate']))."</td>";
					$purchasereport.="<td>".$purchaseprarr[$j]['barcode']."</td><td>".$purchaseprarr[$j]['nsinumber']."</td><td>".$purchaseprarr[$j]['productname']."</td><td>".$purchasearr[$i]['addtinfo']."</td><td>".$purchaseprarr[$j]['quantity']."</td><td>".$purchaseprarr[$j]['rate']."</td><td>".$purchasearr[$i]['product_value']."</td><td>".$purchasearr[$i]['vat']."</td><td>".$purchasearr[$i]['totalamount']."</td><td>".$fifoprice."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$purchaseprarr[$j]['quantity'];	    
					$totalprval=$totalprval+$purchasearr[$i]['product_value'];
					$totalcomm=$totalcomm+$purchasearr[$i]['vat'];
					$totalamt=$totalamt+$purchasearr[$i]['totalamount'];
					$firstrow=1;
				}
			}
			
}	
$purchasereport.="<tr style='font-size:12pt;'><td colspan='4'></td><td colspan=3></td><td>".$totalqty."</td><td></td><td>".$totalprval."</td><td>".$totalcomm."</td><td>".$totalamt."</td><td></td><td></td></tr>";
$purchasereport.="</table>";
echo $purchasereport;
?>