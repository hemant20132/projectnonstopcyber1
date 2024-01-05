<?php ob_start(); 
 include("connection.php");
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
	<script src="assets/vendor/ckeditor/ckeditor.js"></script>
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
                            <h2 class="pageheader-title">Add Product</h2>
                            <p class="pageheader-text">Please Fill the details for adding the product</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                                            <div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image</label>
													<input type="file" class="form-control productimg" name="multipleFile[]" accept="image/*" ><br>
													<center><p><img class="output" src="" width="100" height="100" /></p></center>
												</div>
											</div>
											<div class="form-group">
												<input type="button" class="btn btn-success" value="Add Image" id="addimg" name="addimg">
												<input type="button" class="btn btn-danger" value="Remove Image" id="removeimg" name="removeimg">
										    </div>
											<div class="form-group">
                                                    <div class="category_div" id="category_div">Please specify Category:
                                                        <select name="category" class="form-control required-entry js-example-basic-single" id="category" required>
                                                            <option value="">Select Category</option>
															<?php
															for ($i=0;$i<sizeof($categorylist);$i++)
															{
															?>
															<option value="<?php echo $categorylist[$i]['code'];?>"><?php echo $categorylist[$i]['categoryname'];?></option>
															<?php
															}	
															?>
													    </select>
                                                    </div>
                                                    <br>
                                                <div class="sub_category_div" id="sub_category_div">Please select Subcategory:
                                                            <select name="subcategory" id="subcategory" class="form-control" required>
                                                                <option value="">Please select Subcategory</option>
                                                            </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="brand" class="col-form-label">Brand: </label>
                                                    <select name="brand" id="brand" class="form-control .js-example-basic-single" required>
                                                        <option selected>--Select Brand--</option>
                                                            <?php
															for ($i=0;$i<sizeof($brandlist);$i++)
															{
														    ?> 
															<option value="<?php echo $brandlist[$i]['code'];?>"><?php echo $brandlist[$i]['brand'];?></option>
															<?php
															}
															?>		
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nsi_number" class="col-form-label">NSI Number: </label>
                                                <input id="nsi_number" name="nsi_number" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="barcode"  class="col-form-label">Barcode: </label>
                                                <input id="barcode" name="barcode" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_name" class="col-form-label">Product Name: </label>
                                                <input id="product_name" name="product_name" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="product_size" class="col-form-label">Size : </label>
                                                <input id="product_size" name="product_size" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="second_name"  class="col-form-label">Second Name: </label>
                                                <input id="second_name" name="second_name" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="shortdescription" class="col-form-label">Short Description: </label>
                                                <textarea id="shortdescription" rows="4" cols="50" name="shortdescription"  class="form-control" required>
												</textarea>
                                            </div>
											<div class="form-group">
                                                <label for="longdescription"  class="col-form-label">Description: </label>
                                                <textarea id="longdescription" rows="4" cols="50" name="longdescription" class="form-control" required>
												</textarea>
                                            </div>
										    <div class="form-group">
                                                <label for="shelf_number" name="shelf_number" class="col-form-label">Shelf Number: </label>
                                                <input id="shelf_number" name="shelf_number" type="number" class="form-control" required>
                                            </div>
                                            <button id="saveproduct" name="saveproduct" type="submit" class="btn btn-primary btn-block">Submit</button>
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
	<script src="assets/vendor/ckeditor/ckeditor.js"></script>
	
<script>
//	CKEDITOR.replace('longdescription');

$('.js-example-basic-single').select2();
$(document).on("change",".productimg",function(event)
	{
		  var filename=URL.createObjectURL(event.target.files[0]);
		  $(this).closest(".imgadd").find("img").attr("src",filename);	
	});	
	
$(document).ready(function()
{
	$("#barcode").change(function()
	{
	return false;
	});	
	
	$('#category').select2({
    theme: 'bootstrap4',
	});
	
	$('#subcategory').select2({
    theme: 'bootstrap4',
	});
	
	$('#brand').select2({
    theme: 'bootstrap4',
	});
	
				$("#saveproduct").click(function(e)
				{
					
					if ($('.productimg').get(0).files.length === 0) 
					{
						alert("Please Select Uplaod Images.");
					}
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
					/*
					var data1 = new FormData();
					data1.append('category',$('#category').val());
					data1.append('subcategory',$('#subcategory').val());
					data1.append('brand',$('#brand').val());
					data1.append('nsi_number',$('#nsi_number').val());
					data1.append('barcode',$('#barcode').val());
					data1.append('productname',$('#product_name').val());
					data1.append('productsize',$('#product_size').val());
					data1.append('secondname',$('#second_name').val());
					data1.append('shortdescription',$('#shortdescription').val());
					data1.append('longdescription',$('#longdescription').val());
					data1.append('purchasedate',$('#purchase_date').val());
					data1.append('purchaseqty',$('#purchase_qty').val());
					data1.append('purchaseprice',$('#purchase_price').val());
					data1.append('shelfnumber',$('#shelf_number').val());
					filesarr=[];
					$.each($(".productimg")[0].files, 
					function(i, file) 
					{
						filesarr.push(file);
					});
					data1.append('files',filesarr);
					*/
					myform=document.getElementById('productform');
					var data1 = new FormData(myform);
					e.preventDefault();
					$.ajax({
					  method: "POST",
					  url: "ajax/postproductdata.php",
					  cache: false,
					  datatype:'json',
					  contentType: false,
					  processData: false,
					  data:data1
					})
					  .done(function(productr) 
					  {
					  alert(productr);
					  $(".productimg").val("");
					  $("#category").val("");
					  $("#subcategory").val("");
					  $("#brand").val("");
					  $(".output").attr("src","");
					  document.getElementById("productform").reset();
					  location.href="stocks.php";
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
							optionlist="<option value=''>--Select Subcategory--</option>";	
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


