<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=dailyfbastocksend.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
include ('connection.php'); 
$today1=date('Y-m-d'); 
$today=date('d-m-Y');
								$platform="select * from platform order by id";
								$platformresult=mysqli_query($conn,$platform);
								$platoformnum=mysqli_num_rows($platformresult);
								$platforms=array();
								while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
									{
										$platforms[]=$platformrow;
									}
							

$sales="select * from fbastocksend where DATE(tdate)='".$today1."' order by id";
$saleresult=mysqli_query($conn,$sales);
$salearr=array();
while($rowsale=mysqli_fetch_array($saleresult,MYSQLI_ASSOC))
{
	$salearr[]=$rowsale;
}

$salepro="select * from fbastocksend_products order by id";
$saleprresult=mysqli_query($conn,$salepro);
$saleprarr=array();
while($rowsalepr=mysqli_fetch_array($saleprresult,MYSQLI_ASSOC))
{
	$saleprarr[]=$rowsalepr;
}
$salereport="<center><p style='font-size:15pt;'>NonStopCyber -- Daily FBA Stock Send Report- ".$today."</p><br/></center>";
$salereport.="<table border='1'>";
$salereport.="<tr style='font-size:12pt;'><th>SrNo</th><th>ReceiptNo</th><th>Date</th><th>Platform Name</th><th>BarCode</th><th>NsiNumber</th><th>ProductName</th><th>Quantity</th><th>FiFoPrice</th></tr>";
$saleid='';
$totalqty=0;
		
for ($i=0;$i<sizeof($salearr);$i++)
{
			$firstrow=0;
			for ($j=0;$j<sizeof($saleprarr);$j++)
			{

				$platformname="";
				for ($k=0;$k<sizeof($platforms);$k++)
				{
					if($platforms[$k]["code"]==$salearr[$i]['platform'])
					{
					$platformname=$platforms[$k]["platformname"]." - ".$platforms[$k]["platformsub"];	
					}
				}	
				if ($firstrow==1 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td colspan='3'></td><td>".$platformname."</td><td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$saleprarr[$j]['fiforate']."</td></tr>";
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
				}
				if ($firstrow==0 and ($salearr[$i]['id']==$saleprarr[$j]['saleid']))
				{
					$salereport.="<tr><td>".($i+1)."</td><td>".$salearr[$i]['receiptno']."</td><td>".date('d-m-Y',strtotime($salearr[$i]['tdate']))."</td><td>".$platformname."</td>";
					$salereport.="<td>".$saleprarr[$j]['barcode']."</td><td>".$saleprarr[$j]['nsinumber']."</td><td>".$saleprarr[$j]['productname']."</td><td>".$saleprarr[$j]['quantity']."</td><td>".$saleprarr[$j]['fiforate']."</td></tr>";
					$totalqty=$totalqty+$saleprarr[$j]['quantity'];	    
					$firstrow=1;
				}
			}
			
}	
$salereport.="<tr style='font-size:12pt;'><td colspan='4'></td><td colspan=3></td><td>".$totalqty."</td><td></td></tr>";
$salereport.="</table>";
echo $salereport;
?>