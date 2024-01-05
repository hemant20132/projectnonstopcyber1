<!doctype html>
<html lang="en">
<?php include ('connection.php'); ?>
 
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
                            <h2 class="pageheader-title">Notifications</h2>
                            <p class="pageheader-text">Notifications List </p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Notifications</a></li>
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
							<!--
                                <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
                                <a href="add-product.php" class="btn btn-primary btn-lg float-right">Add Product</a>
                                -->
								<div class="row">
									<div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4">
									</div>
								</div>
								<!--
								<div style="float:left;" id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                                </div>
								-->
                            </div>
							<?php 
									$query="SELECT * FROM notification";
									$result=mysqli_query($conn,$query);
							?>
                            <div class="card-body">
                                <div class="table-responsive">
								<style>
								#notificationtable_filter	{display:none;}
								#notificationtable_length{display:none;}
								</style>			
								   <table id="notificationtable" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SrNo</th>
												<th>Date</th>
												<th>Notification Text</th>
												<th>User Name</th>
										    </tr>
                                        </thead>
                                        <tbody>
												<?php
												$srno=1;
												while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
												{
												?>
												<tr>
													<td><?php echo $srno; ?></td>
									    			<td><?php echo date("d-m-Y",strtotime($row['tdate'])); ?></td>
									    			<td><?php echo $row['notificationtext']; ?></td>
									    			<td><?php echo $row['username']; ?></td>
									    		</tr>
												<?php
												$srno=$srno+1;
												}
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
			$('#salestable').DataTable(
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
				{text:'Add Sale',className:'btn btn-primary addsale',
						action: function ( e, dt, node, config ) 
						{ location.href='sale.php'
						}
				},
				'copy',
				{
                    extend: 'csv',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
				{
                    extend: 'excel',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
				{
                    extend: 'pdf',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
				{
                    extend: 'print',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
				{text:'Daily Sales',className:'btn btn-primary dailysale',
						action: function ( e, dt, node, config ) 
						{ location.href='daily-sale.php'
						}
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
		$(document).on("click",".deletesale", function(e)
			{
					
				var r = confirm("Are you sure of deleting this ?");
				if (r == true) 
				{
					e.preventDefault();
					saleid=$(this).attr("data-id");
					$.ajax({
					  method: "POST",
					  url: "ajax/deletesaledata.php",
					  data:{id:saleid}
					})
					  .done(function(deleter) 
					  {
						alert(deleter);
						location.href="sales.php";
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