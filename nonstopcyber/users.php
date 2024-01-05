<!doctype html>s

<html lang="en">
<?php include('connection.php') ?>;
 
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
                            <h2 class="pageheader-title">Users</h2>
                            <p class="pageheader-text">Users List </p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Users</a></li>
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
                                <!---
								<h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
								-->
							</div>
                            <div class="card-body">
                                <div class="table-responsive">
								<style>
								#usertable_length{display:none;}
								#usertable_filter{display:none;}
								.adduser{background-color:blue;}
								</style>			
								   <table id="usertable" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SrNo</th>
                                                <th>Name</th>
                                                <th>UserName</th>
                                                <th>Role</th>
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
										$query = "SELECT * FROM user order by id";
										$i = 0;
												$result = mysqli_query($conn,$query);
												if (mysqli_num_rows($result) > 0) 
												{
														while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
														{
													if ($row['role']!='Superuser')
													{
																$i++;
												
													?>
<tr><td width="50px"><?php echo $i; ?></td><td><?php echo $row['name'];?></td><td><?php echo $row['username'];?></td><td><?php echo $row['role'];?></td><td><a href="view-profile.php?userid=<?php echo $row['id'];?>" class='btn btn-rounded btn-primary btn-sm float-right'>View Details</a></td><td><a href="edit-user.php?userid=<?php echo $row['id'];?>" class='btn btn-rounded btn-success btn-sm float-right'>Edit Details</a></td><td><a href="" data-id="<?php echo $row['id'];?>" class='deleteuser btn btn-rounded btn-danger btn-sm float-right'>Delete Details</a></td></tr>	
													<?php
													}					
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
			$('#usertable').DataTable(
			{	
				responsive: true,
				columnDefs: [
				{ width: 200, targets: 0 }
							],
				fixedColumns: true,
				dom: 'Blfrtip',
				buttons: 
				[
					<?php 
					if ($_SESSION['role']=="Superuser")
					{
					?>
					{	text:'Add User',className:'btn-primary adduser',
						action: function ( e, dt, node, config ) 
						{ location.href='add-user.php'
						}
					},
					<?php 
					}
					?>
				'copy',
				{
                    extend: 'csv',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3]
                    },
                },
				{
                    extend: 'excel',
                    exportOptions: 
					{
                        columns: [ 0, 1, 2, 3]
                    },
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
			
			$(".deleteuser").click(function(e)
			{
				var r = confirm("Are you sure of deleting this ?");
				if (r == true) 
				{
					e.preventDefault();
					userid=$(this).attr("data-id");
					$.ajax({
					  method: "POST",
					  url: "ajax/deleteuserdata.php",
					  data:{id:userid}
					})
					  .done(function(deleter) 
					  {
						alert(deleter);
						location.href="users.php";
					});
				} 
				else 
				{
					alert("No changes made.");	
				}				
			});	
			
		});
	</script>
</body>
 
</html>