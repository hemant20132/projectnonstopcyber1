<!doctype html>
<html lang="en">
<?php include('connection.php');?>
 
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
                            <h2 class="pageheader-title">Brands</h2>
                            <p class="pageheader-text">Available Brands</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="brandtable" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            </tr>
                                                <th>S. No.</th>
                                                <th>Brand</th>
                                                <th>Code</th>
                                                <th>Number of items available</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            /* Attempt MySQL server connection. Assuming you are running MySQL
                                            server with default setting (user 'root' with no password) */
                                            // Attempt select query execution
                                            $sql = "SELECT * FROM brand order by id";
                                            $i = 0;
                                            if($result = mysqli_query($conn, $sql))
											{
                                            if(mysqli_num_rows($result) > 0) 
											{
													while($row = mysqli_fetch_array($result))
													{
													?>
													<tr>
													<td><?php echo ++$i ;?></td>
													<td><?php echo $row['brand'];?></td>
													<td><?php echo $row['code']; ?></td>
													<?php
													$brandname=$row['code'];
													$pr="select count(brand) as countpro from product where brand='".$brandname."' group by brand";
													$prr=mysqli_query($conn,$pr);
													$prrnumrows=mysqli_num_rows($prr);
													if ($prrnumrows > 0)
													{
														while ($prr1=mysqli_fetch_array($prr,MYSQLI_ASSOC))
														{
															?>
															<?php if ($prr1['countpro']!="")
															{
															?>
															<td><?php echo $prr1['countpro']; ?></td>
															<?php
															}
														}
													}
													else
													{	
													?>
															<td>00</td>
													<?php
													}
													?>
													</tr>
												<?php
												}
											} 
											}
										    mysqli_close($conn);
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>S. No.</th>
                                            <th>Brand</th>
                                            <th>Code</th>
                                            <th>Number of items available</th>
                                            </tr>
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
	<script>
	$(document).ready(function()
	{
			$('#brandtable').DataTable(
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
				{text:'Add Brand',className:'btn btn-primary addbrand',
						action: function ( e, dt, node, config ) 
						{ 
						location.href='add-brand.php'
						}
				},
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
	});
	</script>
</body>
 
</html>