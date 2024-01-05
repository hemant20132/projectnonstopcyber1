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
</head>

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
                            <h2 class="pageheader-title">Add Notification</h2>
                            <p class="pageheader-text">Please Fill the details for adding the product</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Notification</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Notification</li>
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
                                    <h3 class="section-title">Notification Send</h3>
                                    <p>Please fill in following details</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Enter data for notifications</h5>
                                    <div class="card-body">
                                        <form id="notificationform" name="notificaitonform" enctype="multipart/form-data"  method="POST" action="">
                                            <div class="form-group" id="imagegroup">
                                                <div class="form-group imgadd">
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
                                                        <select name="category" class="form-control required-entry" id="category" required>
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
                                                    <select name="brand" id="brand" class="form-control" required>
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
                                                <label for="product_name" class="col-form-label">Size : </label>
                                                <input id="product_size" name="product_size" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="second_name"  class="col-form-label">Second Name: </label>
                                                <input id="second_name" name="second_name" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="shortdescription" class="col-form-label">Short Description: </label>
                                                <textarea id="shortdescription" rows="4" cols="50" name="shortdescription" type="text" class="form-control" required>
												</textarea>
                                            </div>
											<div class="form-group">
                                                <label for="longdescription"  class="col-form-label">Description: </label>
                                                <textarea id="longdescription" rows="4" cols="50" name="longdescription" type="text" class="form-control" required>
												</textarea>
                                            </div>
											<div class="form-group">
                                                <label for="purchase_date" name="purchase_date" class="col-form-label">Purchase Date: </label>
                                                <input id="purchase_date" name="purchase_date" type="date" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="purchase_qty" name="purchase_qty" class="col-form-label">Purchase Quantity: </label>
                                                <input id="purchase_qty" name="purchase_qty" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="purchase_price" name="purchase_price" class="col-form-label">Purchase Price: </label>
                                                <input id="purchase_price" name="purchase_price" type="number" class="form-control" required>
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
<script>
$(document).on("change",".productimg",function(event)
	{
		  var filename=URL.createObjectURL(event.target.files[0]);
		  $(this).closest(".imgadd").find("img").attr("src",filename);	
	});	
	
$(document).ready(function()
{
	CKEDITOR.replace('longdescription');
				$("#saveproduct").click(function(e)
				{
					e.preventDefault();
					/*
					var data1 = new FormData();
					data: new FormData(this),
					productimgarr=[];
					$.each($('input[type=file]'), function(index, file) 
					{
						arr1={};
						arr1.push=index;
						arr1.push=$('input[type=file]')[index].files[0];
						productimgarr.push(arr1);
					});
					data1.append('productimg', productimgarr);
					data1.append('category',$('#category').val());
					data1.append('subcategory',$('#subcategory').val());
					data1.append('brand',$('#brand').val());
					data1.append('nsinumber',$('#nsi_number').val());
					data1.append('barcode',$('#barcode').val());
					data1.append('productname',$('#product_name').val());
					data1.append('secondname',$('#second_name').val());
					data1.append('shortdescription',$('#shortdescription').val());
					data1.append('longdescription',$('#longdescription').val());
					data1.append('purchasedate',$('#purchase_date').val());
					data1.append('purchaseqty',$('#purchase_qty').val());
					data1.append('purchaseprice',$('#purchase_price').val());
					data1.append('shelfnumber',$('#shelf_number').val());
					*/
					let myForm = document.getElementById('productform');
					let formData = new FormData(myForm);
					$.ajax({
					  method: "POST",
					  url: "ajax/postproductdata.php",
					  cache: false,
					  datatype:'json',
					  contentType: false,
					  processData: false,
					  data: formData,
					})
					  .done(function(productr) 
					  {
					  alert(productr);
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


