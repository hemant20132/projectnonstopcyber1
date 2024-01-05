<?php ob_start(); 
 include('connection.php');
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

 $query="select * from subcategory order by id" ;
 $subcategory=mysqli_query($conn,$query);
 $numrowssub=mysqli_num_rows($subcategory);
 $subcategorylist=array();
if ($numrowssub>0)
{
	while ($rowsub=mysqli_fetch_array($subcategory, MYSQLI_ASSOC))
	{
		$subcategorylist[]=$rowsub;
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
if (isset($_REQUEST['s_no']))
{
	$sno=$_REQUEST['s_no'];
	$queryproduct="select * from fba_product where s_no=".$sno;
	$result=mysqli_query($conn,$queryproduct);
	$row=mysqli_fetch_assoc($result);
}	
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Non Stop Cyber</title>
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
	<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
	<link rel="stylesheet" href="assets/vendor/select2/css/select2.css">
	<link rel="stylesheet" href="assets/vendor/select2/css/select2-bootstrap4.css">
</head>
<style>
.form-control{width:100%;}
</style>
<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php include('assets/include/navbar.php'); ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php include('assets/include/sidebar.php'); ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Edit Product</h2>
                            <p class="pageheader-text">Please Fill the details for adding the product</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="basicform">
                                    <h3 class="section-title">Basic Form Elements</h3>
                                    <p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>
                                    <div class="card-body">
                                        <form id="productform" name="productform" enctype="multipart/form-data"  method="POST" action="">
                                            <input type="hidden" id="s_no" name="s_no" value="<?php echo $row['s_no']; ?>" >
											<?php 
											$images=explode(",",$row['product_images']);
											for ($m=0; $m < sizeof($images);$m++)
											{
												
											?>
											<div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image</label>
													<input type="file" class="form-control productimg" name="multipleFile[]" accept="image/*" ><br>
													<center><p><img class="output" src="fbaproductimages/<?php echo $images[$m];?>" width="100" height="100" /></p></center>
												</div>
											</div>
											<?php 
											}
											?>
											<div class="form-group">
												<input type="button" class="btn btn-success" value="Add Image" id="addimg" name="addimg">
												<input type="button" class="btn btn-danger" value="Remove Image" id="removeimg" name="removeimg">
										    </div>
											<div class="form-group">
                                                    <div class="category_div" id="category_div">Please specify Category:
                                                     	<select name="category" class="form-control js-example-basic-single" id="category" required>
                                                            <option value="">Select Category</option>
															<?php
															for ($i=0;$i<sizeof($categorylist);$i++)
															{
																if ($row['category']==$categorylist[$i]['code'])
																{
																$categorycode=$categorylist[$i]['code'];		
															?>
															<option value="<?php echo $categorylist[$i]['code'];?>" selected><?php echo $categorylist[$i]['categoryname'];?></option>
															<?php
																}
																else
																{
															?>
															<option value="<?php echo $categorylist[$i]['code'];?>"><?php echo $categorylist[$i]['categoryname'];?></option>
															<?php
																}
															}															
															?>
													    </select>
                                                    </div>
                                                    <br>
                                                <div class="sub_category_div" id="sub_category_div">Please select Subcategory:
                                                            <select name="subcategory" id="subcategory" class="form-control js-example-basic-single" required>
															<option value="">Please select Subcategory</option>
                                                        	<?php
															for ($j=0;$j<sizeof($subcategorylist);$j++)
															{
																if ($row['sub_category']==$subcategorylist[$j]['subcategorycode'])
																{	
															?>	
															<option value="<?php echo $subcategorylist[$j]['subcategorycode'];?>" selected><?php echo $subcategorylist[$j]['subcategoryname'];?></option>
															<?php
																}
																if ($row['sub_category']!=$subcategorylist[$j]['subcategorycode'])
																{	
															?>					
																<option value="<?php echo $subcategorylist[$j]['subcategorycode'];?>" ><?php echo $subcategorylist[$j]['subcategoryname'];?></option>
															<?php		
															}
															}
															?>
															</select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="brand" class="col-form-label">Brand: </label>
                                                    <select name="brand" id="brand" class="form-control" required>
                                                        <option selected>--Select Brand--</option>
                                                            <?php
															for ($k=0;$k<sizeof($brandlist);$k++)
															{
																if ($brandlist[$k]['code']==$row['brand'])
																{	
														    ?> 
															<option value="<?php echo $brandlist[$k]['code'];?>" selected><?php echo $brandlist[$k]['brand'];?></option>
															<?php
																}
																else
																{	
															?>
															<option value="<?php echo $brandlist[$k]['code'];?>" ><?php echo $brandlist[$k]['brand'];?></option>
															<?php 
																}
															}
															?>	
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nsi_number"  class="col-form-label">NSI Number: </label>
                                                <input id="nsi_number" name="nsi_number" type="text" class="form-control" value="<?php echo $row['nsi_number'];?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="barcode"  class="col-form-label">Barcode: </label>
                                                <input id="barcode" name="barcode" type="text" class="form-control"  value="<?php echo $row['barcode'];?>"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_name" class="col-form-label">Product Name: </label>
                                                <input id="product_name" name="product_name" type="text" class="form-control"  value="<?php echo $row['product_name'];?>"  required>
                                            </div>
											<div class="form-group">
                                                <label for="second_name"  class="col-form-label">Second Name: </label>
                                                <input id="second_name" name="second_name" type="text" class="form-control"  value="<?php echo $row['second_name'];?>"  required>
                                            </div>
											<div class="form-group">
                                                <label for="shortdescription" class="col-form-label">Short Description: </label>
                                                <textarea id="shortdescription" rows="4" cols="50" name="shortdescription" type="text" class="form-control" required>
												<?php echo $row['short_description'];?> 
												</textarea>
                                            </div>
											<div class="form-group">
                                                <label for="longdescription"  class="col-form-label">Description: </label>
                                                <textarea id="longdescription" rows="4" cols="50" name="longdescription" type="text" class="form-control" required>
												<?php echo  stripslashes($row['long_description']);?> 
												</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="shelf_number" name="shelf_number" class="col-form-label">Shelf Number: </label>
                                                <input id="shelf_number" name="shelf_number" type="number" class="form-control" value="<?php echo $row['shelf_number'];?>" required>
                                            </div>
                                            <button id="saveedit" name="saveedit" type="submit" class="btn btn-primary btn-block">Edit Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include('assets/include/footer.php'); ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-latest.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
	<script src="assets/vendor/select2/js/select2.full.js"></script>

<script>
$('.js-example-basic-single').select2();
$(document).on("change",".productimg",function(event)
	{
		  var filename=URL.createObjectURL(event.target.files[0]);
		  $(this).closest(".imgadd").find("img").attr("src",filename);	
	});	
	
$(document).ready(function()
{
	$('#category').select2({
    theme: 'bootstrap4',
	});
	
	$('#subcategory').select2({
    theme: 'bootstrap4',
	});
	
	$('#brand').select2({
    theme: 'bootstrap4',
	});
	
		//		CKEDITOR.replace('longdescription');
				$("#saveedit").click(function(e)
				{
					if($("#category").val()=="")
					{
					alert("Please Select Category.");	
					return false;
					}	
					if ($("#subcategory").val()=="")
					{
					alert("Please Select Sub-Category.");	
					return false;
					}	
					if ($("#brand").val()=="")
					{
					alert("Please Select Brand.");	
					return false;
					}
					if ($("#nsi_number").val()=="")
					{
					alert("Please Enter Nsi Number.");	
					return false;
					}
					if ($("#barcode").val()=="")
					{
					alert("Please Enter Barcode.");	
					return false;
					}
					if ($("#product_name").val()=="")
					{
					alert("Please Enter Product Name.");	
					return false;
					}
					if ($("#product_size").val()=="")
					{
					alert("Please Enter Product Size.");	
					return false;
					}
					if ($("#second_name").val()=="")
					{
					alert("Please Enter Second Name.");	
					return false;
					}
					if ($("#longdescription").val()=="")
					{
					alert("Please Enter Long Description of Product.");	
					return false;
					}
					if ($("#shelf_number").val()=="")
					{
					alert("Please Enter Shelf Number.");	
					return false;
					}
					e.preventDefault();
					let myForm = document.getElementById('productform');
					let formData = new FormData(myForm);
					$.ajax({
					  method: "POST",
					  url: "ajax/posteditfbaproductdata.php",
					  cache: false,
					  datatype:'json',
					  contentType: false,
					  processData: false,
					  data: formData,
					})
					  .done(function(productr) 
					  {
						  alert(productr);
			//			  location.href="stocks.php";
					  });
			});
		
	$("#brand").change(function(){
		category=$("#category").val();
		subcat=$("#subcategory").val();
		brand=$("#brand").val();
		if (category!="" && subcat!="" && brand!="")
		{
			//getlastinsertid
				$.ajax({
				  method: "POST",
				  url: "ajax/getprlastinsertid.php",
				  data: {categorycode:categorycode1}
				})
				  .done(function(r) 
				  {
					nsinum=subcat+brand+r;
					$("#nsi_number").val(nsinum);
				});
			//getlastinsertid		
		}	
	});
	
	$("#addimg").click(function()
	{
		addnew="<div class='imgadd'><label for='img' class='col-form-label'>Image</label><input class='productimg' type='file' name='multipleFile[]' class='form-control' accept='image/*'><br><center><p><img src='' class='class' width='100' height='100'	 /></p></center></div>";
		$("#imagegroup").append(addnew);	
	});
	$("#removeimg").click(function()
	{
		$(".imgadd").last().remove();	
	});	
		
});	

$(document).on("change","#category",function(e)
		{
				e.preventDefault();
				categorycode1=$(this).val();
				console.log(categorycode1);
				$.ajax({
				  method: "POST",
				  datatype : "json",
				  cache: false,
				  url: "ajax/getcategorydata.php",
				  data: {catcode:categorycode1}
				})
				  .done(function(r) 
				  {
						if (r=="")
						{
							$("#subcategory").html("");
							optionlist="<option value=''>No Subcategory Found</option>";	
							$("#subcategory").append(optionlist);
						}
						else						
						{
							sc=JSON.parse(r);
							$("#subcategory").html("");
							for (i=0;i<sc.length;i++)
							{
							optionlist="<option value='"+sc[i].subcategorycode+"'>"+sc[i].subcategoryname+"</option>";	
							$("#subcategory").append(optionlist);
							}
						}
				});
				
		});	
</script>
</body>
 
</html>


