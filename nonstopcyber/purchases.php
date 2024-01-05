<!doctype html>
<html lang="en">
<?php include('connection.php'); ?>
 
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
	<link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/select2/css/select2.css">
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
                            <h2 class="pageheader-title">Purchases</h2>
                            <p class="pageheader-text">Purchase List </p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Purchase</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List</li>
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
								<div class="row">
									<div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4">
									<form id="filterform" name="filterform" method="post">
									  <div class="row">
										<div class="col">
										<?php
										if (isset($_REQUEST['filter']))
											{
												if (strtotime($_REQUEST['fromdate']))
												{
													$fromdate=date("Y-m-d",strtotime($_REQUEST['fromdate']));
												}
												else
												{
													$fromdate="";		
												}			
										?>
										<input type="date" class="form-control" value="<?php echo $fromdate;?>" id="fromdate" name="fromdate" placeholder="From Date" >
										<?php	
											}
											else
											{	
										?>	
										<input type="date" class="form-control" id="fromdate" name="fromdate" placeholder="From Date" >
										<?php
											}
										?>
										</div>
										<div class="col">
										  <?php
										if (isset($_REQUEST['filter']))
											{
												if (strtotime($_REQUEST['todate']))
												{
													$todate=date("Y-m-d",strtotime($_REQUEST['todate']));
												}
												else
												{
													$todate="";		
												}
										?>		
										<input type="date" class="form-control" value="<?php echo $todate; ?>" id="todate" name="todate" placeholder="To Date" >
										<?php
											}
											else
											{	
										?>
										<input type="date" class="form-control" id="todate" name="todate" placeholder="To Date">
										<?php
											}
										?>
										</div>
										<div class="col">
										  <input type="submit" class="form-control btn btn-primary" id="filter" name="filter" value="Filter" placeholder="">
										</div>
									  </div>
									</form>
									<form id="invoicefilterform" name="invoicefilterform" method="post">
									<div style="float:left;" id="custom-search" class="top-search-bar">
										<input class="form-control" id="searchinvoice" name="searchinvoice" type="text" placeholder="Search Invoice No....">
									</div>
									</form>
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
								#purchasetable_filter	{display:none;}
								#purchasetable_length{display:none;}
								</style>			
								   <table id="purchasetable" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SrNo</th>
												<th>Invoice No.</th>
												<th>Date</th> 
												<th>Quantity</th>
                                                <th>Product Value</th>
                                            	<th>Vat</th>
												<th>Total Amount</th>
												<th>View</th>
												<?php 
												if ($_SESSION['role']!='User') 
												{ 
												?>
												<th>Edit</th>
												<th>Delete</th>
												<?php 
												} 
												?>	
										   </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            /* Attempt MySQL server connection. Assuming you are running MySQL
                                            server with default setting (user 'root' with no password) */
                                            // Attempt select query execution
											$i = 0;
											if (isset($_REQUEST['filter']))
											{
												if (strtotime($_REQUEST['fromdate']))
												{
													$fromdate=date("Y-m-d",strtotime($_REQUEST['fromdate']));
												}
												else
												{
													$fromdate="";		
												}			
												if (strtotime($_REQUEST['todate']))
												{
													$todate=date("Y-m-d",strtotime($_REQUEST['todate']));
												}
												else
												{
													$todate="";		
												}			
												
													
													if ($_SESSION['role']=='Admin' OR $_SESSION['role']=='Superuser')
													{
														if ($fromdate=="" and $todate=="")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate 
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid";
														}
														if ($fromdate!="" and $todate=="")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate 
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.tdate >= '".$fromdate."'";
														}
														if ($fromdate=="" and $todate!="")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.tdate <= '".$todate."'";
														}
														if ($fromdate!="" and $todate!="")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.tdate>= '".$fromdate."' and a.tdate <= '".$todate."'";
														}
													}
													if ($_SESSION['role']=='User')
													{
														if ($fromdate=="" and $todate=="" )
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid";
														}
														if ($fromdate!="" and $todate=="" and $platform != "")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.tdate >= '".$fromdate."'";
														}
														if ($fromdate=="" and $todate!="" and $platform != "")
														{
															$query = "SELECT a.id,a.invoiceno,a.productv_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.tdate <= '".$todate."'";
														}
														if ($fromdate!="" and $todate!="" and $platform != "")
														{
															$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchse_products as b where a.id=b.purchaseid and purchase where a.tdate>= '".$fromdate."' and a.tdate <= '".$todate."'";
														}
													}
											}		
											else
											{
												if (isset($_REQUEST['searchorder']) and ($_SESSION['role']=='Admin' or $_SESSION['role']=='Superuser'))
													{
														$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.invoiceno='".$_REQUEST['searchinvoiceno']."'";
													}
												if (isset($_REQUEST['searchorder']) and ($_SESSION['role']=='User'))
													{	
														$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid and a.invoiceno='".$_REQUEST['searchinvoiceno']."'";
													}
												if (!isset($_REQUEST['searchorder']) and ($_SESSION['role']=='Admin' or $_SESSION['role']=='Superuser'))
													{
														$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid order by a.id ";
													}
												if (!isset($_REQUEST['searchorder']) and ($_SESSION['role']=='User'))
													{	
														$query = "SELECT a.id,a.invoiceno,a.product_value,a.vat,a.totalamount,a.addtinfo,a.username,a.tdate,
															b.id as prid,b.purchaseid,b.purchaseinvoiceno,b.barcode,b.nsinumber,b.productname,b.quantity,b.rate
															FROM purchase as a, purchase_products as b where a.id=b.purchaseid ";
													}
											}	
	$result=mysqli_query($conn,$query);
	$num=mysqli_num_rows($result);
	$invoiceno="";
		if ($num>0)
		{
				while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
									if ($invoiceno != $row['invoiceno'])
									{
										$i++;
							?>
					<tr>
					
					<td><?php echo $i; ?></td>
					<td><?php echo $row['invoiceno'];?></td>
					<td><?php echo date("d-m-Y",strtotime($row['tdate'])); ?></td>
					<td><?php echo $row['quantity'];?></td>
					<td><?php echo $row['product_value'];?></td>
					<td><?php echo $row['vat'];?></td>
					<td><?php echo $row['totalamount'];?></td>
					<td><a href="purchase-details-single.php?purchaseid=<?php echo $row['id'];?>" class='btn btn-rounded btn-primary btn-sm float-right'>View Details</a></td>
					<?php if ($_SESSION['role'] != 'User')
							{
					?>
					<td><a href="edit-purchase.php?purchaseid=<?php echo $row['id'];?>" class='btn btn-rounded btn-success btn-sm float-right'>Edit Details</a></td>
					<td><a href="" data-id="<?php echo $row['id']; ?>" class='btn btn-rounded btn-danger btn-sm float-right deletepurchase'>Delete Details</a></td>
					
					</tr>	
						<?php
							}
									}
					$invoiceno=$row['invoiceno'];	
				}
		}
			else
		{	
			echo "No data found.";	
		}
											// Close connection
                                            mysqli_close($conn);
                                            ?>
                                            </tbody>
										<tfoot>	
                                        </tfoot>
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
            <?php //include('assets/include/footer.php'); ?>
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
	<script src="assets/vendor/select2/js/select2.min.js"></script>
	<script> 
		$(document).ready(function()
		{ 
			$('#purchasetable').DataTable(
			{
			responsive: true,
				columnDefs: [
				  { responsivePriority: 1, targets: 1 },
				  { responsivePriority: 2, targets: 2 },
				  { responsivePriority: 3, targets: 3 }
							],
				fixedColumns: false,
				dom: 'Bfrtip',
				buttons: 
				[
					{text:'Add Purchase',className:'btn btn-primary addsale',
						action: function ( e, dt, node, config ) 
						{ location.href='purchase.php'
						}
				},
				'copy',
				{
                    extend: 'csv',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3]
                    },
                },
				{text:'excel',className:'btn btn-primary exportexcel',
						action: function ( e, dt, node, config ) 
						{ location.href='purchaseexcel.php'}
				},
				{
                    extend: 'pdf',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3]
                    },
                },
				{
                    extend: 'print',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3]
                    },
                }
				]
			});
			$("#filter").click(function()
			{
				if ($("#fromdate").val()=="" && $("#todate").val()=="" && $("#platform").val()!="")
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
		
		$(document).on("click",".deletepurchase",function(e)
			{
				var r = confirm("Are you sure of deleting this ?");
				if (r == true) 
				{
					e.preventDefault();
					purchaseid=$(this).attr("data-id");
					$.ajax({
					  method: "POST",
					  url: "ajax/deletepurchasedata.php",
					  data:{id:purchaseid}
					})
					  .done(function(deleter) 
					  {
						alert(deleter);
						location.href="purchases.php";
					});
				} 
				else 
				{
					alert("No changes made.");	
				}				
			});	
	</script>
</body>
 
</html>