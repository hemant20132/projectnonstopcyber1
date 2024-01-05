<?php
session_start();
include('connection.php');
$id=$_REQUEST['deleteid'];
	$count=0;
		$querygetpr="select * from fbasale_products where id=".$id;
		$queryrespr=mysqli_query($conn,$querygetpr);
		$numrows=mysqli_num_rows($queryrespr);
		while ($rowpr=mysqli_fetch_array($queryrespr,MYSQLI_ASSOC))
		{
			$productnsi=$rowpr['nsinumber'];
			$productqty=FloatVal($rowpr['quantity']);
			// product quantity add since deleted sale//
			$queryproduct="select * from fba_product where nsi_number='".$productnsi."'";
			$queryprresult=mysqli_Query($conn,$queryproduct);
			while($row=mysqli_fetch_array($queryprresult,MYSQLI_ASSOC))
			{
				$stockqty=FloatVal($row['stocks_quantity']);
				$replaceqty=$stockqty+$productqty;
				$update="update fba_product set stocks_quantity='".$replaceqty."' where nsi_number='".$productnsi."'";
				mysqli_query($conn,$update);
			}
			$saleproductdelete="Delete from fbasale_products where id=".$id;
			mysqli_query($conn,$saleproductdelete);
			$count++;
		}

			if ($count=$numrows)
			{
				
				echo "success";
			}
			else
			{
				echo "error";
			}	
?>