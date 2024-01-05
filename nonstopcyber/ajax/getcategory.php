<?php
include('connection.php');
$query="select * from category order by id" ;
$category=mysqli_query($conn,$query);
$numrows=mysqli_num_rows($category);
if ($numrows>0)
{
	$results=array();
	while ($row=mysqli_fetch_array($catgory,MYSQLI_ASSOC))
	{
			$category=new stdClass();
			$category->text=$row['categoryname'];
			$querysub="select * from subcategory where categorycode='".$row['code']."'";
			$subcat=mysqli_query($conn,$querysub);
			$children=array();
			while ($rowsub=mysqli_fetch_array($subcat,MYSQLI_ASSOC))
			{
					$subcat1=new stdClass();
					$subcat1->id=$rowsub['id'];
					$subcat1->text=$rowsub['subcategoryname'];
					array_push($children,$subcat1);
			}
			$category->children=$children;		
			array_push($results,$category);
	}
	return json_encode($results);
}
else
{
	$productdetails[0]["error"]="No Data Found.";
	echo json_encode($productdetails);
}	
/*

{
  "results": 
  [
    { 
      "text": "Group 1", 
      "children" : [
        {
            "id": 1,
            "text": "Option 1.1"
        },
        {
            "id": 2,
            "text": "Option 1.2"
        }
      ]
    },
    { 
      "text": "Group 2", 
      "children" : [
        {
            "id": 3,
            "text": "Option 2.1"
        },
        {
            "id": 4,
            "text": "Option 2.2"
        }
      ]
    }
  ],
  "pagination": {
    "more": true
  }
}
*/
?>