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
                            <h2 class="pageheader-title">FBA - Returns</h2>
                            <p class="pageheader-text">FBA - Returns List </p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">FBA - Returns</a></li>
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
				<?php
										
								$platform="select * from platform order by id";
								$platformresult=mysqli_query($conn,$platform);
								$platoformnum=mysqli_num_rows($platformresult);
								$platforms=array();
								while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
									{
										$platforms[]=$platformrow;
									}
								?>
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
                    <!-- ============================================================== -->
                    <!-- data table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <!---
								<h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                                <a href="add-product.php" class="btn btn-primary btn-lg float-right">Add Product</a>
                                -->
								<div class="row">
									<div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4">
									<form id="filterform" name="filterform" method="post">
									  <div class="row">
										<div class="col">
										<select name="platform" id="platform" class="form-control">
												<?php
													$platform="";
													for ($j=0;$j<sizeof($platforms);$j++)
													{
														if ($platform != $platforms[$j]['platformname'])
														{														
														?>
														<optgroup label="<?php echo $platforms[$j]['platformname']; ?>">
														<?php
															for ($i=0;$i<sizeof($platforms);$i++)
															{
																if ($platforms[$j]['platformname']==$platforms[$i]['platformname'])
																{	
															?>
																<option value="<?php echo $platforms[$i]['code'];?>"><?php echo $platforms[$i]['platformsub'];?></option>
																<?php
																}
															}
															?>
														</optgroup>
														<?php
														}
														$platform=$platforms[$j]['platformname'];
																												
													}
													?>
								        </select>
										</div>
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
										<input type="date" class="form-control" id="fromdate" value="<?php echo $fromdate; ?>" name="fromdate" placeholder="From Date" >
										<?php
											}
											?>
										</div>
										<div class="col">
										  <?php
											}
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
										  <input type="date" class="form-control" id="todate" name="todate" value="<?php echo $todate; ?>" placeholder="To Date" >
											<?php
											}
											?>
										</div>
										<div class="col">
										  <input type="submit" class="form-control btn btn-primary" id="filter" name="filter" value="Filter" placeholder="">
										</div>
									  </div>
									</form>
									<div style="float:left;" id="custom-search" class="top-search-bar">
										<form id="orderfilterform" name="orderfilterform" method="post">
											<input class="form-control" id="searchorder" name="searchorder" type="text" placeholder="Search Order No....">
										</form>
									</div>
									</div>
								</div>
						    </div>
                            <div class="card-body">
                                <div class="table-responsive">
								<style>
								#returntable_filter	{display:none;}
								#returntable_length{display:none;}
								</style>			
								  <table id="returntable" class="table table-bordered " width="100%" style="">
                                        <thead>
                                            <tr>
                                                <th>SrNo</th>
                                                <th>Image</th>
                                                <th>Order No</th>
                                                <th>Platform</th>
                                                <th>Total Amount</th> 
												<th>Additinal Info</th> 
												<th>IsDamaged</th> 
												<th>View</th>
												<th>Edit</th>
												<th>Delete</th>
										    </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            /* Attempt MySQL server connection. Assuming you are running MySQL
                                            server with default setting (user 'root' with no password) */
                                            // Attempt select query execution
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
												
												$platform=$_REQUEST['platform'];
													if ($_SESSION['role']=='Admin' OR $_SESSION['role']=='Superuser')
													{
														if ($fromdate=="" and $todate=="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.platform='".$platform."' order by a.id";
														}
														if ($fromdate!="" and $todate=="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.tdate >= '".$fromdate."' order by a.id";
														}
														if ($fromdate=="" and $todate!="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.tdate <= '".$todate."' and a.platform='".$platform."' order by a.id";
														}
														if ($fromdate!="" and $todate!="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.tdate>= '".$fromdate."' and a.tdate <= '".$todate."' and a.platform='".$platform."' order by a.id";
														}	
													}
													
													if ($_SESSION['role']=='User')
													{
														if ($fromdate=="" and $todate=="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.platform='".$platform."' order by a.id";
														}
														if ($fromdate!="" and $todate=="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.id=b.returnid and a.tdate >= '".$fromdate."' and a.platform='".$platform."' order by a.id";
														}
														if ($fromdate=="" and $todate!="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.id=b.returnid and a.tdate <= '".$todate."' and a.platform='".$platform."' order by a.id";
														}
														if ($fromdate!="" and $todate!="" and $platform != "")
														{
															$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.id=b.returnid and a.tdate>= '".$fromdate."' and a.tdate <= '".$todate."' and a.platform='".$platform."' order by a.id";
														}	
													}
											}
											else
											{
												if (isset($_REQUEST['searchorder']) and ($_SESSION['role']=='Admin' or $_SESSION['role']=='Superuser'))
													{
														$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.orderno='".$_REQUEST['searchorder']."' and a.id=b.returnid order by a.id";
													}
												if (isset($_REQUEST['searchorder']) and ($_SESSION['role']=='User'))
													{	
														$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.orderno='".$_REQUEST['searchorder']."' and a.username='".$_SESSION['username']."' and a.id=b.returnid order by a.id";
													}
												if (!isset($_REQUEST['searchorder']) and ($_SESSION['role']=='Admin' or $_SESSION['role']=='Superuser'))
												{
														$query = "SELECT * FROM fbareturn1 as a, fbareturn_products as b where a.id=b.returnid order by a.id";
												}		
												if (!isset($_REQUEST['searchorder']) and ($_SESSION['role']=='User'))
												{
														$query = "SELECT a.*, b.* FROM fbareturn1 as a, fbareturn_products as b where a.id=b.returnid order by a.id";
												}	
											}
											$i = 0;
												$result = mysqli_query($conn,$query);
												if (mysqli_num_rows($result) > 0) 
												{
														while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
														{
															$i++;
															for ($j=0;$j<sizeof($platforms);$j++)
															{
																if ($platforms[$j]["code"] == $row["platform"])
																{
																	$platformname=$platforms[$j]["platformname"]." - ".$platforms[$j]["platformsub"];
																}	
															}			
															$images=explode(",", $row['return_image']);
													?>
													
														
<tr><td><?php echo $i; ?></td><td><div class="m-r-10"><img src="fbareturnimages/<?php echo $images[0]; ?>" alt="user" class="rounded" height="60" width="45"></div></td><td><?php echo $row['orderno'];?></td><td><?php echo $platformname;?></td><td><?php echo $row['totalamount'];?></td><td><?php echo $row['addtinfo']; ?></td><td><?php echo $row['isdamaged']; ?></td><td><a href="fba-return-details-single.php?returnid=<?php echo $row['id'];?>" class='btn btn-rounded btn-primary btn-sm  float-right'>View Details</a></td><?php if ($_SESSION['role']=='Superuser' OR $_SESSION['role']=='Admin' OR ($_SESSION['role'] == 'User' AND $_SESSION['username'] == $row['username'])){ ?><td><a href="edit-fba-return.php?returnid=<?php echo $row['returnid'];?>" class='btn btn-rounded btn-success btn-sm float-right'>Edit Details</a></td><td><a href="" data-id="<?php echo $row['returnid']; ?>" class='btn btn-rounded btn-danger btn-sm float-right deletereturn'>Delete Details</a></td><?php } ?></tr>	
													<?php
																			
														}
													   // Free result set
														mysqli_free_result($result);
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
    <!--
	<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    -->
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
	<script src="assets/vendor/select2/js/select2.full.js"></script>
	<script> 
		$(document).ready(function()
		{ 
			$("#returntable").DataTable(
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
				{text:'Add FBA return',className:'btn btn-primary addreturn',
						action: function ( e, dt, node, config ) 
						{ location.href='fbareturn.php'
						}
				},
				'copy',
				{
                    extend: 'csv',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3,4,5]
                    },
                },
						{text:'excel',className:'btn btn-primary excelreturn',
						action: function ( e, dt, node, config ) 
						{ location.href='returnfbaexcelreport.php'
						}
				},
				{
                    extend: 'pdf',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3,4,5]
                    },
                },
				{
                    extend: 'print',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3,4,5]
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
		
		$(document).on("click",".deletereturn",function(e)
			{
				var r = confirm("Are you sure of deleting this ?");
				if (r == true) 
				{
					returnid=$(this).attr("data-id");
					e.preventDefault();
					$.ajax({
					  method: "POST",
					  url: "ajax/deletefbareturndata.php",
					  data:{id:returnid}
					})
					  .done(function(deleter) 
					{
						alert(deleter);
						return false;
						location.href="fbareturns.php";
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