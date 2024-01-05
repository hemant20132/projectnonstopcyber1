<?php
$url="/home/639380.cloudwaysapps.com/zzezcecvhx/public_html/productimages/CMFCHGL1001.jpg";
$img="/home/639380.cloudwaysapps.com/zzezcecvhx/public_html/fbnproductimages/CMFCHGL1001.jpg";
$content=file_get_contents($url);
//move_uploaded_file($content, $img);
if (file_put_contents($img,$content))
{
echo "image copied";	
}	
?>
	