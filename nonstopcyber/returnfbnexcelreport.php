<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=fbareturnreport.xls");  //File name extension was wrong
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

$returns="select * from fbnreturn1 order by id";
$returnresult=mysqli_query($conn,$returns);
$returnarr=array();
while($rowreturn=mysqli_fetch_array($returnresult,MYSQLI_ASSOC))
{
	$returnarr[]=$rowreturn;
}
$returnpro="select * from fbnreturn_products order by id";
$returnprresult=mysqli_query($conn,$returnpro);
$returnprarr=array();
while($rowreturnpr=mysqli_fetch_array($returnprresult,MYSQLI_ASSOC))
{
	$returnprarr[]=$rowreturnpr;
}
$returnreport="<center><p style='font-size:15pt;'>NonStopCyber -- FBN Return Report-</p></center><br/>";
$returnreport.="<table border='1'>";
$returnreport.="<tr style='font-size:12pt;'><th>SrNo</th><th>OrderNo</th><th>Date</th><th>BarCode</th><th>NsiNumber</th><th>ProductName</th><th>AdditionalInfo</th><th>Quantity</th><th>IsDamaged</th><th>Rate</th><th>TotalAmount</th><th>UserName</th></tr>";
$returnid='';
			$totalqty=0;
			$totalprval=0;
			$totalcomm=0;
			$totalamt=0;

		
for ($i=0;$i<sizeof($returnarr);$i++)
{
					for ($r=0;$r<sizeof($userarr);$r++)
					{
							if ($userarr[$r]['username']==$returnarr[$i]['username'])
							{
								$username=$userarr[$r]['name'];
							}
					}
	
			$firstrow=0;
			for ($j=0;$j<sizeof($returnprarr);$j++)
			{
				if ($firstrow==1 and ($returnarr[$i]['id']==$returnprarr[$j]['returnid']))
				{
					$returnreport.="<tr><td colspan=3></td><td>".$returnprarr[$j]['barcode']."</td><td>".$returnprarr[$j]['nsinumber']."</td><td>".$returnprarr[$j]['productname']."</td><td>".$returnprarr[$j]['quantity']."</td><td>".$returnarr[$j]['addtinfo']."</td><td>".$returnprarr[$j]['isdamaged']."</td><td>".$returnprarr[$j]['rate']."</td><td>".$returnarr[$i]['totalamount']."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$returnprarr[$j]['quantity'];	    
				}
				if ($firstrow==0 and ($returnarr[$i]['id']==$returnprarr[$j]['returnid']))
				{
					$returnreport.="<tr><td>".($i+1)."</td><td>".$returnarr[$i]['orderno']."</td><td>".date('d-m-Y',strtotime($returnarr[$i]['tdate']))."</td>";
					$returnreport.="<td>".$returnprarr[$j]['barcode']."</td><td>".$returnprarr[$j]['nsinumber']."</td><td>".$returnprarr[$j]['productname']."</td><td>".$returnarr[$j]['addtinfo']."</td><td>".$returnprarr[$j]['quantity']."</td><td>".$returnprarr[$j]['isdamaged']."</td><td>".$returnprarr[$j]['rate']."</td><td>".$returnarr[$i]['totalamount']."</td><td>".$username."</td></tr>";
					$totalqty=$totalqty+$returnprarr[$j]['quantity'];	    
					$totalprval=$totalprval+$returnarr[$i]['product_value'];
					$totalamt=$totalamt+$returnarr[$i]['totalamount'];
					$firstrow=1;
				}
			}
			
}	
$returnreport.="<tr style='font-size:12pt;'><td colspan='4'></td><td colspan=3></td><td>".$totalqty."</td><td colspan=2></td><td>".$totalamt."</td></tr>";
$returnreport.="</table>";
echo $returnreport;
?>