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

	$platform1="select * from platform  where platformname like '%FBA%' order by id";
	$platformresult=mysqli_query($conn,$platform1);
	$platoformnum=mysqli_num_rows($platformresult);
	$platforms=array();
	while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
		{
			$platforms[]=$platformrow;
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
                            <h2 class="pageheader-title">FBA Stocks</h2>
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
											
									<div class="row">
									<div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4">
									<?php	
											if (isset($_REQUEST['filter']))
											{
												$platform=$_REQUEST['platform'];
											} 
									?>
									<form id="filterform" name="filterform" method="post">
									  <div class="row">
											<div class="col">
											<div class="form-group">
                                			   <label for="category" class="col-form-label">Platform : </label>
												<select name="platform" id="platform" class="form-control">
												<option value="">--Select Platform--</option>
												<?php
													for ($j=0;$j<sizeof($platforms);$j++)
													{
														if ($platform==$platforms[$j]['code'])
														{	
													?>
												<option value="<?php echo $platforms[$j]['code'];?>" selected><?php echo $platforms[$j]['platformsub'];?></option>
												<?php
														}
														else
														{	
														?>
												<option value="<?php echo $platforms[$j]['code'];?>" ><?php echo $platforms[$j]['platformsub'];?></option>
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
											<?php
											if (isset($_REQUEST['filter']))
											{
											$category=$_REQUEST['category'];
											}
											?>
										<select name="category" class="form-control required-entry" id="category">
											<option value="">Select Category</option>
											<?php
											for ($i=0;$i<sizeof($categorylist);$i++)
											{
												if ($category==$categorylist[$i]['code'])
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
											<?php
											if (isset($_REQUEST['filter']))
											{
											$brand=$_REQUEST['brand'];
											}
											?>			
						<select name="brand" id="brand" class="form-control" >
                        <option value="">--Select Brand--</option>
									<?php
									for ($i=0;$i<sizeof($brandlist);$i++)
									{
										if ($brand==$brandlist[$i]['code'])
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
									<div class="row" style="margin-top:20px;">
										<?php if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin') 
												{
										?>
											<input  id="stocksendfba" name="stocksendfba" style="margin-left:15px;" type="button" class="btn btn-default" value="Stock Send FBA">
												<?php 
												} 
												?>
											<input  id="excel" name="excel" style="margin-left:10px;" type="button" class="btn btn-default" value="Excel">
											<input  id="pdf" name="pdf" style="margin-left:10px;" type="button" class="btn btn-default" value="PDF">
											<input  id="print" name="print" style="margin-left:10px;" type="button" class="btn btn-default" value="Print">
									</div>
					        </div>
                            <div class="card-body">
                                <style>
								#producttable_filter	{display:none;}
								#producttable_length{display:none;}
								</style>
								<div class="table-responsive">
							        <table id="producttable" class="table table-striped table-bordered second" style="">
                                        <thead>
                                            <tr>
                                                <th>Item Number</th>
                                                <th>Image</th>
                                                <th>NSI Number</th>
                                                <th>Brand</th>
                                                <th>Barcode</th>
												<th>Platform</th>
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
								
												$platform=$_REQUEST['platform'];
												$category=$_REQUEST['category'];
												$subcat=$_REQUEST['subcategory'];
												$brand=$_REQUEST['brand'];
												if ($platform !="" and ($category=="" and $subcat=="") and $brand == "")
												{
													$query = "select * from fba_product where platform='".$platform."'";
												}
												if ($platform !="" and ($category!="" and $subcat!="") and $brand == "")
												{
													$query="SELECT * from fba_product where platform='".$platform."' 
													and category= '".$category."' and sub_category = '".$subcat."'"; 
												}
												
												if ($platform !="" and ($category!="" and $subcat!="") and $brand != "")
												{
													$query="SELECT * from fba_product where
													platform='".$platform."' 
													and category= '".$category."' and sub_category = '".$subcat."' 
													and brand='".$brand."'";
												}
												
												if ($platform =="" and ($category=="" and $subcat=="") and $brand != "")
												{
													$query="SELECT * from fba_product where 
													a.nsi_number=c.nsinumber and b.id=c.saleid and a.brand='".$brand."'";
												}
												
												if ($platform=="" and ($category=="" and $subcat=="") and $brand == "")
												{
													$query = "SELECT * FROM fba_product";
												}
												
											}
											else if (isset($_REQUEST['searchorder']))
													{
													$query = "select * from fba_product like '%".$_REQUEST['searchorder']."%' 
													or a.nsi_number like '%".$_REQUEST['searchorder']."%' 
													or a.product_name like '%".$_REQUEST['searchorder']."%'";
													}
											else
													{	
														$query = "SELECT * from fba_product";
													}
											// Attempt select query execution
											$i = 0;
                                            $result = mysqli_query($conn, $query);
										    $numrows=mysqli_num_rows($result);
											if ($numrows>0)	
											{
												while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
												{
													$fifoprice=0;
													
													//calculation of fifo price
													$fbastockreceipt="select a.nsinumber,a.receiptno, a.quantity, a.fiforate as rate, 
													b.receiptno, b.tdate  
													from fbastocksend_products as a, fbastocksend as b 
													where b.id=a.saleid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id desc";
													$fbastocksendresult=mysqli_query($conn,$fbastockreceipt);
													$fbastocksendarr=array();
													while($fbastocksendrow=mysqli_fetch_array($fbastocksendresult,MYSQLI_ASSOC))
													{
													$fbastocksendarr[]=$fbastocksendrow;	
													}
													$fbareturn1="select a.nsinumber,a.returnorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbareturn_products as a, fbareturn1 as b 
													where b.id=a.returnid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id desc";
													$fbareturnresult=mysqli_query($conn,$fbareturn1);
													if (mysqli_affected_rows($conn) > 0)
													{
														$fbareturnarr=array();
														while($fbareturnrow=mysqli_fetch_array($fbareturnresult,MYSQLI_ASSOC))
														{
														$fbareturnarr[]=$fbareturnrow;	
														}
													}
													else
													{
														$fbareturnarr=array();
													}
													
													$mixed=array();
													if (!empty($fbareturnarr))
													{
													$mixed=array_merge($fbastocksendarr, $fbareturnarr);
													$sorted=usort($mixed, 'date_compare');
													}
													else
													{
													$mixed=$fbastocksendarr;
													$sorted=usort($mixed, 'date_compare');
													}
													
													$fbasales1="select a.nsinumber,a.saleorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbasale_products as a, fbasale as b 
													where b.id=a.saleid 
													and a.nsinumber='".$row['nsi_number']."' order by b.id";
													$fbasaleresult1=mysqli_query($conn,$fbasales1);
													$fbasalearr1=array();
													while($fbasalerow=mysqli_fetch_array($fbasaleresult1,MYSQLI_ASSOC))
													{
													$fbasalearr1[]=$fbasalerow;	
													}
													$fbatotalstocksend=0;
													for ($l=0;$l<sizeof($mixed);$l++)
													{
													$fbatotalstocksend=$fbatotalstocksend+$mixed[$l]['quantity'];
													}
													$fbatotalsale=0;
													for ($k=0;$k<sizeof($fbasalearr1);$k++)
													{
													$fbatotalsale=$fbatotalsale+$fbasalearr1[$k]['quantity'];
													}
													$diff=$fbatotalstocksend-$fbatotalsale;
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
													//fifo price calculation	
												for($s=0;$s<sizeof($platforms);$s++)
												{
													if 	($platforms[$s]['code']==$row['platform'])
													{
														$platformname=$platforms[$s]['platformsub'];		
													}
												}	
												?>												
<tr>
<td><?php echo ++$i;?></td>
<td><?php $images=explode(",",$row['product_images']); ?><div class='m-r-10'><img src='/fbaproductimages/<?php echo $images[0];?>' alt='productimage' class='' width='80' height='80'></div></td>
<td><?php echo $row['nsi_number'];?></td>
<td><?php for ($l=0;$l<sizeof($brandlist);$l++){if ($brandlist[$l]['code']==$row['brand']){echo $brandlist[$l]['brand'];}}?></td>
<td><?php echo $row['barcode'];?></td>
<td><?php echo $platformname; ?></td>
<td><?php echo $row['product_name'] ;?></td>
<td><?php if ($row['stocks_quantity'] != ''){echo $row['stocks_quantity'];}else{echo 0;}?></td>
<td><?php echo $fifoprice; ?></td>
<td><?php echo $row['shelf_number'];?></td>
<td><a href='ecommerce-fba-product-single.php?s_no=<?php echo $row['s_no'];?>' class='btn btn-rounded btn-primary btn-sm float-right'>View Details</a></td>
<?php 
if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin')
{
?>
<td><a href='edit-fba-product.php?s_no=<?php echo $row['s_no'];?>' class='btn btn-rounded btn-success btn-sm float-right'>Edit Details</a></td>
<?php 
} 
?>
<?php 
if ($_SESSION['role']=='Superuser' or $_SESSION['role']=='Admin')
{
?>
<td><a data-id='<?php echo $row['s_no'];?>' href='' class=' btn btn-rounded btn-danger btn-sm float-right deleteproduct'>Delete Details</a></td><?php } ?>
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
				responsive: true
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
		
		$(document).on("click","#stocksendfba",function(e)
			{
				location.href='sendstockfba.php';
			});
		
		$(document).on("click","#excel",function(e)
			{
				brand1=$('#brand').val();
				category1=$('#category').val();
				subcategory1=$('#subcategory').val();
				platform1=$('#platform').val();
				location.href="fbaproductexcel.php?brand="+brand1+"&category="+category1+"&subcategory="+subcategory1+"&platform="+platform1;
			});

		$(document).on("click","#print",function(e)
			{
				brand1=$('#brand').val();
				category1=$('#category').val();
				subcategory1=$('#subcategory').val();
				platform1=$('#platform').val();
				location.href="fbaproductprint.php?brand="+brand1+"&category="+category1+"&subcategory="+subcategory1+"&platform="+platform1;
			});
			
			$(document).on("click","#pdf",function(e)
			{
				brand1=$('#brand').val();
				category1=$('#category').val();
				subcategory1=$('#subcategory').val();
				platform1=$('#platform').val();
				location.href="fbaproductpdf.php?brand="+brand1+"&category="+category1+"&subcategory="+subcategory1+"&platform="+platform1;
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
					  url: "ajax/deletefbaproductdata.php",
					  data:{id:productid}
					})
					  .done(function(deleter) 
					  {
						alert(deleter);
						location.href="fbastocks.php";
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