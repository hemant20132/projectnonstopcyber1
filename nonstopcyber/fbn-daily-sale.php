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
                            <h2 class="pageheader-title">Todays FBN Sale </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Todays Sale</li>
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
                        <a  class="btn btn-primary" href="downloadfbndailysale.php">DownloadExcel</a>
						<div class="card">
						<center>
						<h5 class="card-header">Daily FBN Sales Report -<?php $today=date('d-m-Y'); echo $today; ?></h5><div class="float-right">
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
                                                <th class="border-0">Price</th>
												<th class="border-0">commissioncharges</th>
                                                <th class="border-0">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
										 $today1=date('Y-m-d'); 
										 $dsales="Select a.id, a.orderno, a.commissioncharges, b.productname as item, b.nsinumber, b.quantity as quantity, 
										 b.rate as rate from fbnsale as a, fbnsale_products as b, fbn_product as c  
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
											 $commtotal=$commtotal+$row['commissioncharges'];
											 $tqty=0;
												//calculation of fifo price
													$fbnstockreceipt="select a.nsinumber,a.receiptno, a.quantity, a.fiforate, 
													b.receiptno, b.tdate  
													from fbnstocksend_products as a, fbnstocksend as b 
													where b.id=a.saleid 
													and a.nsinumber='".$row['nsinumber']."' order by b.id desc";
													$fifoprice=0;
													$fbnstocksendresult=mysqli_query($conn,$fbnstocksend);
													$fbnstocksendarr=array();
													while($fbnstocksendrow=mysqli_fetch_array($fbnstocksendresult,MYSQLI_ASSOC))
													{
													$fbnstocksendarr[]=$fbnstocksendrow;	
													}
													
													$fbnreturn1="select a.nsinumber,a.returnorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbnreturn_products as a, fbn_return1 as b 
													where b.id=a.returnid 
													and a.nsinumber='".$row['nsinumber']."' order by b.id desc";
													$fbnreturnresult=mysqli_query($conn,$return1);
													if (mysqli_affected_rows($conn) > 0)
													{
														$fbnreturnarr=array();
														while($fbnreturnrow=mysqli_fetch_array($fbnreturnresult,MYSQLI_ASSOC))
														{
														$fbnreturnarr[]=$fbnreturnrow;	
														}
													}
													else
													{
														$fbnreturnarr=array();
													}
													
													$mixed=array();
													if (!empty($fbnreturnarr))
													{
													$mixed=array_merge($fbnstocksendarr, $fbnreturnarr);
													$sorted=usort($mixed, 'date_compare');
													}
													else
													{
													$mixed=$purarr;
													$sorted=usort($mixed, 'date_compare');
													}
													
													$fbnsales1="select a.nsinumber,a.saleorderno, a.quantity, a.rate, 
													b.orderno, b.tdate  
													from fbnsale_products as a, sale as b 
													where b.id=a.saleid 
													and a.nsinumber='".$row['nsinumber']."' order by b.id";
													$fbnsaleresult1=mysqli_query($conn,$fbnsales1);
													$fbnsalearr1=array();
													while($fbnsalerow=mysqli_fetch_array($fbnsaleresult1,MYSQLI_ASSOC))
													{
													$fbnsalearr1[]=$fbnsalerow;	
													}
													$fbntotalstocksend=0;
													for ($l=0;$l<sizeof($mixed);$l++)
													{
													$fbntotalstocksend=$fbntotalstocksend+$mixed[$l]['quantity'];
													}
													$fbntotalsale=0;
													for ($k=0;$k<sizeof($fbnsalearr1);$k++)
													{
													$fbntotalsale=$fbntotalsale+$fbnsalearr1[$k]['quantity'];
													}				
													$diff=$fbntotalstocksend-$fbntotalsale;
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
										?>	
											  <tr>
                                             	<td><?php echo $count; ?></td>
                                                <td><?php echo $row['orderno']; ?></td>
                                                <td><?php echo $row['item'];?></td>
                                                <td><?php echo $row['quantity'];?></td>
                                                <td><?php echo $row['rate'];?></td>
												<td><?php echo $row['commissioncharges'];?></td>
												<td><?php $total1=floatval($row['rate'])*floatval($row['quantity']); $total=$total+$total1; echo $total1;?></td>
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
										 <tr><td></td><td>TOTAL: <?php echo $count; ?></td><td></td><td><?php echo $qtytotal; ?></td><td></td><td><?php echo $commtotal; ?></td><td><?php echo number_format($total,2);?></td></tr>
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