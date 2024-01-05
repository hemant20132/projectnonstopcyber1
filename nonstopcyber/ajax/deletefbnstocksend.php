<?php
session_start();
include('connection.php');
$id=$_REQUEST['id'];
	$count=0;
		$querygetpr="select * from fbnstocksend_products where saleid='".$id."'";
		$queryrespr=mysqli_query($conn,$querygetpr);
		$numrows=mysqli_num_rows($queryrespr);
		while ($rowpr=mysqli_fetch_array($queryrespr,MYSQLI_ASSOC))
		{
			$productnsi=$rowpr['nsinumber'];
			$productqty=FloatVal($rowpr['quantity']);
			$queryproduct1="select * from product where nsi_number='".$productnsi."'";
			$queryprresult1=mysqli_Query($conn,$queryproduct1);
			while($row1=mysqli_fetch_array($queryprresult1,MYSQLI_ASSOC))
			{
				$stockqty1=FloatVal($row1['stocks_quantity']);
				$replaceqty1=$stockqty1+$productqty;
				$update1="update product set stocks_quantity='".$replaceqty1."' where nsi_number='".$productnsi."'";
				mysqli_query($conn,$update1);
			}	
			$queryproduct="select * from fbn_product where nsi_number='".$productnsi."'";
			$queryprresult=mysqli_Query($conn,$queryproduct);
			while($row=mysqli_fetch_array($queryprresult,MYSQLI_ASSOC))
			{
				$stockqty=FloatVal($row['stocks_quantity']);
				$replaceqty=$stockqty+$productqty;
				$update="update fbn_product set stocks_quantity='".$replaceqty."' where nsi_number='".$productnsi."'";
				mysqli_query($conn,$update);
				$saleproductdelete="Delete from fbnstocksend_products where saleid='".$id."'";
				mysqli_query($conn,$saleproductdelete);
			}
			$count++;
		}
		$saledelete="delete from fbnstocksend where id=".$id;
			if (mysqli_query($conn,$saledelete))
			{
				
				echo "success";
			}
			else
			{
				echo "error";
			}	
?>