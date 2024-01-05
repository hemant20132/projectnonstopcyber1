<?php
 ob_start(); 
 include('connection.php'); 
 $querycategory="select * from category order by id" ;
 $category=mysqli_query($conn,$querycategory);
 $numrows=mysqli_num_rows($category);
 $categorylist=array();
if ($numrows>0)
{
	while ($rowcat=mysqli_fetch_array($category, MYSQLI_ASSOC))
	{
		$categorylist[]=$rowcat;
	}	
}	

 $query1="select * from subcategory order by id" ;
 $subcategory=mysqli_query($conn,$query1);
 $numrows1=mysqli_num_rows($subcategory);
 $subcategorylist=array();
if ($numrows1>0)
{
	while ($rowsubcat=mysqli_fetch_array($subcategory, MYSQLI_ASSOC))
	{
		$subcategorylist[]=$rowsubcat;
	}	
}	


 $querybrand="select * from brand order by brand" ;
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
	<link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="phpfreechat-2.1.1/client/themes/default/pfc.min.css" />
	<script src="phpfreechat-2.1.1/client/pfc.min.js" type="text/javascript"></script>
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
                            <h2 class="pageheader-title">Stocks</h2>
                            <p class="pageheader-text">Currently Available Stocks</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Stocks</li>
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
                    <!-- ============================================================== -->
                    <!-- data table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
								<!--
							   <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                               <a href="add-product.php" class="btn btn-primary btn-lg float-right">Add Product</a>
								-->	
										<?php
										if (isset($_REQUEST['filter']))
											{
												$category=$_REQUEST['category'];
												$subcat=$_REQUEST['subcategory'];
												$brand=$_REQUEST['brand'];
											}
										?>
									<div class="row">
									<div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4">
									<form id="filterform" name="filterform" method="post">
									  <div class="row">
										<div class="col">
											<div class="form-group">
                                                <label for="category" class="col-form-label">Category: </label>
												<Style>
												@media only screen and (max-width: 850px) 
												{
												.form-control 
												{
												/* width: 100%; */
												width:300px;
												}
												}
                                        		</style>		
														<select name="category" class="form-control required-entry" id="category">
                                                            <option value="">Select Category</option>
															<?php
															for ($i=0;$i<sizeof($categorylist);$i++)
															{
															if($categorylist[$i]['code']==$category)
															{		
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
										</div>
										<div class="col">
											<div class="form-group">
                                                <label for="category" class="col-form-label">Category: </label>
															<select name="subcategory" id="subcategory" class="form-control">
                                                                <option value="">Please select Subcategory</option>
                                                            </select>
                                            </div>
										  </div>	
										<div class="col">
										<div class="form-group">
                                                <label for="brand" class="col-form-label">Brand: </label>
                                                    <select name="brand" id="brand" class="form-control" >
                                                        <option value="">--Select Brand--</option>
                                                            <?php
															for ($i=0;$i<sizeof($brandlist);$i++)
															{
															if ($brandlist[$i]['code']==$brand)
															{		
														    ?> 
															<option value="<?php echo $brandlist[$i]['code'];?>" selected><?php echo $brandlist[$i]['brand'];?></option>
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $brandlist[$i]['code'];?>"><?php echo $brandlist[$i]['brand'];?></option>
															<?php			
															}
															}
															?>		
                                                    </select>
                                        </div>
										</div>
										<div class="col">
												<div class="form-group">
													<label for="filter" class="col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;</label>
													<input type="submit" class="form-control btn btn-primary" id="filter" name="filter" value="Filter" placeholder="">
												</div>
									  </div>
									  </div>
									  </form>
									<div class="row">
									<div class="col-3">
									
									<form id="orderfilterform" name="orderfilterform" method="post">
									<div style="" id="custom-search" class="top-search-bar">
										<input class="form-control" id="searchorder" name="searchorder" type="text" placeholder="Search product by name, nsi_number or barcode....">
									</div>
									</form>
									
									</div>
									<div class="col-9">
									</div>
									</div>
								</div>
							    <!--
								<div style="float:left;" id="custom-search" class="top-search-bar">
                               <input class="form-control" type="text" placeholder="Search..">
                                </div>
								-->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
									<style>
								#producttable_filter	{display:none;}
								#producttable_length{display:none;}
								</style>		
                                    <table id="producttable" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Item Number</th>
                                                <th>Image</th>
                                                <th>NSI Number</th>
                                                <th>Brand</th>
                                                <th>Barcode</th>
                                                <th>Product Name</th>
                                                <th>Quantity in Stock</th>
                                                <th>Cost Price As FIFO</th>
                                                <th>Shelf Number</th>
												<th>View</th>
												<?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin'){?>
												<th>Edit</th>
												<?php } ?>
												<?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin'){?>
												<th>Delete</th>
												<?php } ?>
											</tr>
                                        </thead>
                                        <tbody>
                                        <?php
												function date_compare($a, $b)
													{
														$t1 = strtotime($a['tdate']);
														$t2 = strtotime($b['tdate']);
														return $t1 - $t2;
													}    
													
                                         	if (isset($_REQUEST['filter']))
											{
												$category=$_REQUEST['category'];
												$subcat=$_REQUEST['subcategory'];
												$brand=$_REQUEST['brand'];
												if (($category=="" and $subcat=="") and $brand != "")
												{
													$query = "SELECT * FROM product where brand='".$brand."'";
												}
												if ($category!="" and $subcat!="" and $brand != "")
												{
													$query = "SELECT * FROM product where category= '".$category."' and sub_category = '".$subcat."' and brand='".$brand."'";
												}
												if (($category!="" and $subcat!="") and $brand == "")
												{
													$query = "SELECT * FROM product where category= '".$category."' and sub_category = '".$subcat."'" ;
												}
												if (($category=="" and $subcat=="") and $brand == "")
												{
													$query = "SELECT * FROM product";
												}
												
											}
											else if (isset($_REQUEST['searchorder']))
													{
														$query = "SELECT * FROM product where barcode like '%".$_REQUEST['searchorder']."%' or nsi_number like '%".$_REQUEST['searchorder']."%' or product_name like '%".$_REQUEST['searchorder']."%'";
													}
											else
													{	
														$query = "SELECT * FROM product";
													}
											// Attempt select query execution
											$i = 0;
                                            $result = mysqli_query($conn, $query);
										    $numrows=mysqli_num_rows($result);
											if ($numrows>0)	
											{
												while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
												{
													//calculation of fifo price
													$purchase="select a.nsinumber,a.purchaseinvoiceno, a.quantity, a.rate, 
													b.invoiceno, b.tdate  
													from purchase_products as a, purchase as b 
													where b.id=a.purchaseid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id desc";
													$fifoprice=0;
													$purresult=mysqli_query($conn,$purchase);
													$purarr=array();
													while($purrow=mysqli_fetch_array($purresult,MYSQLI_ASSOC))
													{
													$purarr[]=$purrow;	
													}
													
													$return="select a.nsinumber,a.returnorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from return_products as a, return1 as b 
													where b.id=a.returnid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id desc";
													$retresult=mysqli_query($conn,$return);
													$retarr=array();
													while($retrow=mysqli_fetch_array($retresult,MYSQLI_ASSOC))
													{
													$retarr[]=$retrow;	
													}
													$mixed=array_merge($purarr, $retarr);
													$sorted=usort($mixed, 'date_compare');
											
													$sales="select a.nsinumber,a.saleorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from sale_products as a, sale as b 
													where b.id=a.saleid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id";
													$saleresult=mysqli_query($conn,$sales);
													$salearr=array();
													while($salerow=mysqli_fetch_array($saleresult,MYSQLI_ASSOC))
													{
													$salearr[]=$salerow;	
													}
													$totalpur=0;
													$totalsale=0;
													for ($j=0;$j<sizeof($mixed);$j++)
													{
													$totalpur=$totalpur+$mixed[$j]['quantity'];
													}
													for ($k=0;$k<sizeof($salearr);$k++)
													{
													$totalsale=$totalsale+$salearr[$k]['quantity'];
													}								
													$diff=$totalpur-$totalsale;
													//calculation of fifo price
													$tqty=0;
													for ($s=0;$s<sizeof($mixed);$s++)
													{
													  $tqty=$tqty+$mixed[$s]['quantity'];
														if ($tqty >= $diff)
														{
														$fifoprice=$mixed[$s]['rate'];
														break;
														}
														else
														{
														}
													}
													$barcodes2=$row['barcode'];
													$barcodes1=explode(",",$barcodes2);
													$barcodes=implode(",",$barcodes1);
													//fifo price calculation	
												?>		
<tr><td><?php echo ++$i;?></td>
<td><?php $images=explode(",",$row['product_images']); ?><div class='m-r-10'><img src='/productimages/<?php echo $images[0];?>' alt='productimage' class='' width='80' height='80'></div></td><td><?php echo $row['nsi_number'];?></td><td><?php for ($l=0;$l<sizeof($brandlist);$l++){if ($brandlist[$l]['code']==$row['brand']){echo $brandlist[$l]['brand'];}}?></td><td><?php echo $barcodes;?><td><?php echo $row['product_name'] ;?></td><td><?php if ($row['stocks_quantity'] != ''){echo $row['stocks_quantity'];}else{echo 0;}?></td><td><?php echo $fifoprice; ?></td><td><?php echo $row['shelf_number'];?></td><td><a href='ecommerce-product-single.php?s_no=<?php echo $row['s_no'];?>' class='btn btn-rounded btn-primary btn-sm float-right'>View Details</a></td><?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin') {?><td><a href='edit-product.php?s_no=<?php echo $row['s_no'];?>' class='btn btn-rounded btn-success btn-sm float-right'>Edit Details</a></td><?php } ?>
<?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin'){?><td><a data-id='<?php echo $row['s_no'];?>' href='' class=' btn btn-rounded btn-danger btn-sm float-right deleteproduct'>Delete Details</a></td><?php } ?>
</tr>
												<?php
													}
                                            // Free result set
										    mysqli_free_result($result);
											}
											else
											{
												echo "No records matching your query were found.";
                                            }
                                            // Close connection
                                            mysqli_close($conn);
                                            ?>
											</tbody>
								    </table>
							    </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php // include('assets/include/footer.php'); ?>
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
	<script src="assets/vendor/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/vendor/datatable/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/vendor/datatable/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/vendor/datatable/js/dataTables.responsive.min.js"></script>
	<script src="assets/vendor/datatable/js/dataTables.buttons.min.js"></script>
	<script src="assets/vendor/datatable/js/jszip.min.js"></script>
	<script src="assets/vendor/datatable/js/pdfmake.min.js"></script>
	<script src="assets/vendor/datatable/js/vfs_fonts.js"></script>
	<script src="assets/vendor/datatable/js/buttons.html5.min.js"></script>
	<script src="assets/vendor/datatable/js/buttons.print.min.js"></script>
	<script>
	$(document).ready(function()
		{ 
		$('#producttable').DataTable(
				{	
				responsive: true,
				columnDefs: [
				{
                "targets": [0],
                "width": "100px"
					},
				 ],
				fixedColumns: true,
				dom: 'Bfrtip',
				buttons: 
				[
					<?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin') {?>
					{text:'Add Product',className:'btn-primary addproduct',
							action: function ( e, dt, node, config ) 
							{ location.href='add-product.php'
							}
					},
				<?php } ?>
					'copy', 'csv', 
					{text:'excel',className:'btn-primary excelproduct',
							action: function ( e, dt, node, config ) 
							{ 
							location.href='productexcel.php'
							}
					}
					,
					{
						extend: 'pdf',
						exportOptions: 
						{
							columns: [ 0, 1, 2,3,4,5 ]
						}
					}, 'print'
				]
				});
			$("#filter").click(function()
			{
				if ( ($("#category").val()=="" && $("#subcategory").val()=="") || $("#brand").val()!="" )
				{
					return true;		
				}
				else
				{
					
				}
			});
			$("#searchorder").change(function()
			{
				$("#orderfilterform").submit();	
			});		
			
		});
		
		
			$(document).on("click",".deleteproduct",function(e)
			{
				var r = confirm("Are you sure of deleting this ?");
				if (r == true) 
				{
						e.preventDefault();
					productid=$(this).attr("data-id");
					$.ajax({
					  method: "POST",
					  url: "ajax/deleteproductdata.php",
					  data:{id:productid}
					})
					  .done(function(deleter) 
					  {
						alert(deleter);
						location.href="stocks.php";
					});
				} 
				else 
				{
					alert("No changes made.");	
				}
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