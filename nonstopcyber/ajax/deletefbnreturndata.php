<?php
session_start();
include('connection.php');
$id=$_REQUEST['id'];
		$count=0;
		$querygetpr="select * from fbnreturn_products where returnid='".$id."'";
		$queryrespr=mysqli_query($conn,$querygetpr);
		$numrows=mysqli_num_rows($queryrespr);
		while ($rowpr=mysqli_fetch_array($queryrespr,MYSQLI_ASSOC))
		{
			$productnsi=$rowpr['nsinumber'];
			$productqty=FloatVal($rowpr['quantity']);
			$queryproduct="select * from fbn_product where nsi_number='".$productnsi."'";
			$queryprresult=mysqli_Query($conn,$queryproduct);
			while($row=mysqli_fetch_array($queryprresult,MYSQLI_ASSOC))
			{
				$stockqty=FloatVal($row['stocks_quantity']);
				$replaceqty=$stockqty-$productqty;
				$update="update fbn_product set stocks_quantity='".$replaceqty."' where nsi_number='".$productnsi."'";
				mysqli_query($conn,$update);
				$returnproductdelete="Delete from fbnreturn_products where returnid='".$id."'";
				echo $returnproductdelete;
				mysqli_query($conn,$returnproductdelete);
			}
			$count=$count+1;
		}
		if (Floatval($count)==Floatval($numrows))
		{
			$returndelete="delete from fbnreturn1 where id=".$id;
		}	
			if (mysqli_query($conn,$returndelete))
			{
				
				echo "success";
			}
			else
			{
				echo "error";
			}	
?>