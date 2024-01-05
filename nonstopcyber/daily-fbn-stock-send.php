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
                            <h2 class="pageheader-title">Todays FBN Stock Send Report</h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">FBN Send</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Todays Send Report</li>
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
                    <!-- top selling products  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <a  class="btn btn-primary" href="downloaddailyfbnstocksend.php">DownloadExcel</a>
						<div class="card">
						<center>
						<h5 class="card-header">Daily FBN Send Stock Report -<?php $today=date('d-m-Y'); echo $today; ?></h5><div class="float-right">
						</center>
						</div>
					        <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
										<thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">#</th>
                                                <th class="border-0">Order Number</th>
                                                <th class="border-0">Items</th>
                                                <th class="border-0">Qauntity</th>
                                                <th class="border-0">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
										 $today1=date('Y-m-d'); 
										 $dsales="Select a.id, a.receiptno,  b.productname as item, b.nsinumber, 
										 b.quantity as quantity, b.fiforate	 from fbnstocksend as a, fbnstocksend_products as b, product as c  
										 where a.id=b.saleid and b.nsinumber=c.nsi_number and DATE(a.tdate)='".$today1."'";
										 $result=mysqli_query($conn,$dsales); 
										 $numrows=mysqli_num_rows($result);
										 $count=0;
										 $total=0;
										 if ($numrows>0)
										 {
											 while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
											 {
												 $count=$count+1;
												 $qtytotal=$qtytotal+$row['quantity'];
												 $total = $total + ($row['quantity']*$row['fiforate']);
											?>	
													<tr>
													<td><?php echo $count; ?></td>
													<td><?php echo $row['receiptno']; ?></td>
													<td><?php echo $row['item'];?></td>
													<td><?php echo $row['quantity']; ?></td>
													<td><?php echo $row['quantity']*$row['fiforate']; ?></td>
												  </tr>
											 <?php 
											 }
										 }
										 else
										 {	 
										 ?>
										 	  <tr>
                                             	<td colspan='6' style='text-align:center;'>--No data found--</td>
                                              </tr>
										<?php		
										 }
										 ?>
										 <tr><td></td><td>TOTAL: <?php echo $count; ?></td><td></td><td><?php echo $qtytotal; ?></td><td><?php echo number_format($total,2);?></td><td></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end top selling products  -->
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
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
</body>
 
</html>