<?php
session_start();
error_reporting(E_ALL);
include('connection.php');
include('SimpleXLSX.php');
 
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
 $querysub="select * from subcategory order by id" ;
 $subcategory=mysqli_query($conn,$querysub);
 $numrows=mysqli_num_rows($subcategory);
 $subcategorylist=array();
if ($numrows>0)
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
    	 	$target_dir = "../importuploads/";
            $target_file = $target_dir.$_FILES["importfile"]["name"];
            if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_file)) 
            {
                $inputFileName = $target_file;
                if ($row=SimpleXLSX::parse($inputFileName)) 
                {
                    $rows=$row->rows();
					for ($i=1;$i<sizeof($rows);$i++)
                    {
					$productbrand=$rows[$i][0];
					$productsecondname=$rows[$i][1];
					$productbarcode=$rows[$i][2];
					$productname=$rows[$i][3];
					$productcategory=$rows[$i][4];
					$productsubcategory=$rows[$i][5];
					
					$productshort=str_replace("'","\'",$rows[$i][6]);
					$productshort=str_replace('"','\"',$productshort);
					$productshort=str_replace('"','\"',$productshort);
					$productshort=str_replace("`","\`",$productshort);
					$productshort=str_replace("•","&#8226;",$productshort);
					$productshort=str_replace("®","&circledR;",$productshort);
					
					$productlong=$rows[$i][7];
					$productlong=str_replace('"','\"',$productlong);
					$productlong=str_replace('"','\"',$productlong);
					$productlong=str_replace("`","\`",$productlong);
					$productlong=str_replace("•","&#8226;",$productlong);
					$productlong=str_replace("®","&circledR;",$productlong);
					
					$productquantity=$rows[$i][8];
					$productprice=$rows[$i][9];

					$productsize=$rows[$i][11];
					$productshelf=$rows[$i][12];
					$productimages=$rows[$i][13];
					if ($productbarcode=="")
					{
						$productbarcode=0;
					}	
					$productnsinumber="";
					$productimage="";
					$insertidquery="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'zzezcecvhx' AND TABLE_NAME = 'product'";
					$relastid=mysqli_query($conn,$insertidquery);
					$rowid=mysqli_fetch_assoc($relastid);
					for ($m=0; $m<sizeof($categorylist); $m++)
					{
						if (trim($productcategory)==trim($categorylist[$m]['categoryname']))
						{
								$categorycode=$categorylist[$m]['code'];
						}	
					}	
					for ($j=0;$j<sizeof($subcategorylist);$j++)
					{
						if (trim($productsubcategory)==trim($subcategorylist[$j]['subcategoryname']) and trim($categorycode)==trim($subcategorylist[$j]['categorycode']))
						{
								$subcategorycode=$subcategorylist[$j]['subcategorycode'];
						}
					}
					for ($k=0;$k<sizeof($brandlist);$k++)
					{
						if (trim($productbrand)==trim($brandlist[$k]['brand']))
						{
								$brandcode=$brandlist[$k]['code'];
						}
					}
								$productnsinumber=$subcategorycode.$brandcode.$rowid['AUTO_INCREMENT'];
								$productimages1=array();
								$count=0;
								for ($s=0;$s<6;$s++)
								{	
									if ($count==0)
									{	
										$newFile = 	$productnsinumber.'.'.'png';
									}
									else
									{	
										$newFile = 	$productnsinumber.'('.$count.')'.'.'.'png';
									}
								array_push($productimage1,$newFile);
								$count++;
								}
					$productimages1=implode(",",$productimages);
					$purchasedate=NULL;
					
					$productinsert="Insert Into product (product_name,barcode,category,sub_category,brand,nsi_number,product_images,size,second_name,
					short_description, long_description, purchase_qty, purchase_price, shelf_number, purchase_date) 
					values('".$productname."',".$productbarcode.",'".$categorycode."','".$subcategorycode."','".$brandcode."','".$productnsinumber."','".$productimages1
					."','".$productsize."','".$productsecondname."','".$productshort."','".$productlong."','" .$productquantity."','".$productprice."','".$productshelf.
					"','".($purchasedate==NULL?"NULL":"'$purchasedate'")."')";
					mysqli_query($conn,$productinsert);
					}
				}	
			echo "success";
			}
			else
			{
			echo "error";
			}		
?>