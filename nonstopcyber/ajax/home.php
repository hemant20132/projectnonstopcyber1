<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
   	<link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
	<script src="assets/vendor/jquery/jquery-latest.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/vendor/phpfreechat/client/themes/default/pfc.min.css" />
    <script src="assets/vendor/phpfreechat/client/pfc.min.js" type="text/javascript"></script>
	<title>Non Stop Cyber</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <?php include('connection.php'); ?>
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Dashboard </h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <!--
											<li class="breadcrumb-item active" aria-current="page">Dashboard	</li>
											-->
										</ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    	<?php
							     		 $today=date("Y-m-d");
										 $dsales="Select a.id, a.orderno, b.productname as item, b.quantity as quantity, 
										 c.purchase_price as price from sale as a, sale_products as b, product as c  
										 where a.id=b.saleid and b.nsinumber=c.nsi_number and DATE(a.tdate)='".$today."'";
										 $result=mysqli_query($conn,$dsales); 
										 $numrows=mysqli_num_rows($result);
										 $count=0;
										 $totalsalestoday=0;
										 if ($numrows>0)
										 {
											 while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
											 {
												 $total1=floatval($row['price'])*floatval($row['quantity']);
												 $totalsalestoday=$totalsalestoday+$total1;
											 }	
										 }
										 
										 $tsales="Select a.id, a.orderno, b.productname as item, b.quantity as quantity, 
										 c.purchase_price as price from sale as a, sale_products as b, product as c  
										 where a.id=b.saleid and b.nsinumber=c.nsi_number";
										 $tresult=mysqli_query($conn,$tsales); 
										 $tnumrows=mysqli_num_rows($tresult);
										 $tcount=0;
										 $totalsales=0;
										 if ($tnumrows>0)
										 {
											 while($trow=mysqli_fetch_array($tresult,MYSQLI_ASSOC))
											 {
												 $total2=floatval($trow['price'])*floatval($trow['quantity']);
												 $totalsales=$totalsales+$total2;
											 }	
										 }
										
										$tr="Select a.id, a.orderno, b.productname as item, b.quantity as quantity, 
										 c.purchase_price as price from return1 as a, return_products as b, product as c  
										 where a.id=b.returnid and b.nsinumber=c.nsi_number";

										 $trresult=mysqli_query($conn,$tr); 
										 $trnumrows=mysqli_num_rows($tresult);
										 $trcount=0;
										 $trtotal=0;
										 if ($trnumrows>0)
										 {
											 while($trrow=mysqli_fetch_array($trresult,MYSQLI_ASSOC))
											 {
												 $trtotal2=floatval($trrow['price'])*floatval($trrow['quantity']);
												 $trtotal=$trtotal+$trtotal2;
											 }	
										 }
																				
										?>
                    <div class="ecommerce-widget">
                     <div class="row">
                              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
									<center>
                                        <h5 class="text-muted"><a class="btn btn-primary btn-sm btn-rounded" width="200px" href='sale.php'>Add Sale</a></h5>
                                        <h5 class="text-muted"><a class="btn btn-primary btn-sm btn-rounded" width="200px" href='return.php'>Add Return</a></h5>
						            </center>
									</div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>

							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted"><a href='daily-sale.php'>Sales Today</a></h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">AED.<?php echo $totalsalestoday; ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>
						    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Sales </h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">AED.<?php echo $totalsales; ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
										      <span></span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue2"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Return</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">AED.<?php echo $trtotal; ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- recent orders  -->
                            <?php
										 $salesquery="select a.id, a.orderno, a.totalamount, a.sale_image, a.tdate, 
										 b.productname, b.nsinumber, b.quantity, c.purchase_price 
										 as price from sale as a, 
										 sale_products as b , 
										 product as c  
										 where a.id=b.saleid and b.nsinumber=c.nsi_number order by a.id desc LIMIT 4";
										 $salesresult=mysqli_query($conn,$salesquery);
										 $numrows=mysqli_num_rows($salesresult);
							?>				
							<!-- ============================================================== -->
                            <style>
							#recentorders_info{display:none;}
							#recentorders_paginate{display:none;}
							#recentorders_length{display:none;}
							#recentorders_filter{display:none;}
							</style>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Orders</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="recentorders" width="100%">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Image</th>
                                                        <th class="border-0">Order No</th>
                                                        <th class="border-0">Date</th>
                                                        <th class="border-0">Total Amount</th>
                                                        <th class="border-0">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
										<?php
										$count=0;
										if ($numrows>0)
										 {
											while ($row=mysqli_fetch_array($salesresult,MYSQLI_ASSOC))
											{
													$count=$count+1;
										?>
													<tr>
                                                        <td><?php echo $count;?></td>
                                                        <td>
                                                            <div class="m-r-10"><img src="saleimages/<?php echo $row['sale_image'];?>" alt="user" class="rounded" width="45"></div>
                                                        </td>
                                                        <td><?php echo $row['orderno'];?></td>
                                                        <td><?php echo date("d-m-Y H:i:s" ,strtotime($row['tdate'])); ?></td>
                                                        <td><?php echo $row['totalamount'];?></td>
                                                        <td  text-align="left">
														<a href="sales-details-single.php?saleid=<?php echo $row['id'];?>" class='btn btn-rounded btn-primary btn-sm float-left'>View Details</a></td>
                                                    </tr>
										<?php
											}	
										 }
										?>					
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- customer acquistion  -->
                            <!-- ============================================================== -
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Customer Acquisition</h5>
                                    <div class="card-body">
                                        <div class="ct-chart ct-golden-section" style="height: 354px;"></div>
                                        <div class="text-center">
                                            <span class="legend-item mr-2">
                                                    <span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Returning</span>
                                            </span>
                                            <span class="legend-item mr-2">

                                                    <span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">First Time</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end customer acquistion  -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
              				                        <!-- product category  -->
                            <!-- ============================================================== 
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Product Category</h5>
                                    <div class="card-body">
                                        <div class="ct-chart-category ct-golden-section" style="height: 315px;"></div>
                                        <div class="text-center m-t-40">
                                            <span class="legend-item mr-3">
                                                    <span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full "></i></span><span class="legend-text">Man</span>
                                            </span>
                                            <span class="legend-item mr-3">
                                                <span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Woman</span>
                                            </span>
                                            <span class="legend-item mr-3">
                                                <span class="fa-xs text-info mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Accessories</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product category  -->
                                   <!-- product sales  -->
                            <!-- ============================================================== 
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <div class="float-right">
                                                <select class="custom-select">
                                                    <option selected>Today</option>
                                                    <option value="1">Weekly</option>
                                                    <option value="2">Monthly</option>
                                                    <option value="3">Yearly</option>
                                                </select>
                                            </div> 
											<h5 class="mb-0"> Product Sales</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="ct-chart-product ct-golden-section"></div>
                                    </div>
                                </div>
                            </div>
							<!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -
                            <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- top perfomimg  -->
                                <!-- ============================================================== -
                                <div class="card">
                                    <h5 class="card-header">Top Performing Campaigns</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table no-wrap p-table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Campaign</th>
                                                        <th class="border-0">Visits</th>
                                                        <th class="border-0">Revenue</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Campaign#1</td>
                                                        <td>98,789 </td>
                                                        <td>$4563</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#2</td>
                                                        <td>2,789 </td>
                                                        <td>$325</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#3</td>
                                                        <td>1,459 </td>
                                                        <td>$225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#4</td>
                                                        <td>5,035 </td>
                                                        <td>$856</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a href="#" class="btn btn-outline-light float-right">Details</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end top perfomimg  -->
                                <!-- ============================================================== -
                            </div>
                        </div>
						<div class="row">
								<!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== 
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Sales</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">$12099</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== 
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">New Customer</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1245</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== 
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Visitor</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">13000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
							<!--						
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1340</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== 
							</div>
							<div class="row">
                            <!-- ============================================================== -->
                            <!-- total revenue  -->
                            <!-- ============================================================== -->
  
                            
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- category revenue  -->
                            <!-- ============================================================== 
    						<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Revenue by Category</h5>
                                    <div class="card-body">
                                        <div id="c3chart_category" style="height: 420px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end category revenue  -->
                            <!-- ============================================================== -->
							<!--
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Total Revenue</h5>
                                    <div class="card-body">
                                        <div id="morris_totalrevenue"></div>
                                    </div>
                                    <div class="card-footer">
                                        <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">$26,000</span><span class="text-success float-right">+9.45%</span></p>
                                    </div>
                                </div>
                            </div>
                        -->
						</div>
					<div class="row">
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- sales by Products  -->
                                <?php
								$fast="Select * from sale where tdate <= DATE(NOW()) and DATE(tdate) >= DATE(NOW()-INTERVAL 7 DAY)";
								$resultfast=mysqli_query($conn,$fast);
								$fcount=array();
								while ($rowfast=mysqli_fetch_array($resultfast,MYSQLI_ASSOC))
								{
									$countsale="select nsinumber, sum(quantity) as totalcount from sale_products where saleid='".$rowfast['id']."' group by nsinumber ";
									$resultsale=mysqli_query($conn,$countsale);
									while ($rowsale=mysqli_fetch_array($resultsale,MYSQLI_ASSOC))
									{
											$countsales=array();
											$countsales["nsi_number"]=$rowsale["nsinumber"];
											$countsales["total_count"]=$rowsale["totalcount"];
											array_push($fcount,$countsales);
									}	
								}
								$unfcount2=array();
								$unfcount1=array();
								for ($k=0;$k<sizeof($fcount);$k++)
								{
										$nsinum=$fcount[$k]["nsi_number"];
										$scount=0;
										for ($l=0;$l<sizeof($fcount);$l++)
										{
												if ($nsinum==$fcount[$l]["nsi_number"])
												{
													$scount=$scount+$fcount[$l]["total_count"];	
												}
										}
										$unfcount1["nsi_number"]=$nsinum;
										$unfcount1["total_count"]=$scount;
										array_push($unfcount2,$unfcount1);
								}
								$unfcount=array_unique($unfcount2);
								$queryproduct="select * from product";
								$productres=mysqli_query($conn,$queryproduct);
								?>				
								<!-- ============================================================== -->								
							    <div class="card">
                                    <h5 class="card-header">Sales By Fast Moving Products</h5>
                                    <div class="card-body p-0">
                                        <ul class="traffic-sales list-group list-group-flush">
                                            <?php
											while ($rowspr=mysqli_fetch_array($productres,MYSQLI_ASSOC))
											{
												for ($s=0;$s<sizeof($unfcount);$s++)
												{
													if ($unfcount[$s]['nsi_number']==$rowspr['nsi_number'])
													{
											?>
											<li class="traffic-sales-content list-group-item "><span class="traffic-sales-name"><?php echo $rowspr['product_name']; ?></span><span class="traffic-sales-amount">AED<?php echo $unfcount[$s]['total_count']*$rowspr['purchase_price'];?><span class="icon-circle-small icon-box-xs text-success ml-4 bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span></li>
                                            <?php
													}
												}
											}
											?>
											<!--
											<li class="traffic-sales-content list-group-item"><span class="traffic-sales-name">Search<span class="traffic-sales-amount">$3123.00  <span class="icon-circle-small icon-box-xs text-success ml-4 bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1 text-success">5.86%</span></span>
                                                </span>
                                            </li>
                                            <li class="traffic-sales-content list-group-item"><span class="traffic-sales-name">Social<span class="traffic-sales-amount ">$3099.00  <span class="icon-circle-small icon-box-xs text-success ml-4 bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1 text-success">5.86%</span></span>
                                                </span>
                                            </li>
                                            <li class="traffic-sales-content list-group-item"><span class="traffic-sales-name">Referrals<span class="traffic-sales-amount ">$2220.00   <span class="icon-circle-small icon-box-xs text-danger ml-4 bg-danger-light"><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1 text-danger">4.02%</span></span>
                                                </span>
                                            </li>
                                            <li class="traffic-sales-content list-group-item "><span class="traffic-sales-name">Email<span class="traffic-sales-amount">$1567.00   <span class="icon-circle-small icon-box-xs text-danger ml-4 bg-danger-light"><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1 text-danger">3.86%</span></span>
                                                </span>
                                            </li>
											-->
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="sales.php" class="btn-primary-link">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales traffice source  -->
                            <!-- ============================================================== -->
                                                 
						 <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- social source  -->
                                <?php
								$salesbypt="SELECT a.platform, sum(a.totalamount) as platformtotal, count(a.platform) as countsales,
								b.platformname as platformname, b.platformsub as platformsub  FROM sale as a, platform as b  where a.platform=b.code
								group by a.platform";
								$salesresultbypt=mysqli_query($conn,$salesbypt);
								$numrowspt=mysqli_num_rows($salesresultbypt);
								?>				
								<!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header"> Sales By Platforms</h5>
                                    <div class="card-body p-0">
                                        <ul class="social-sales list-group list-group-flush">
                                    	<?php
											while ($rowplat=mysqli_fetch_array($salesresultbypt,MYSQLI_ASSOC))
											{
										?>
										<li class="list-group-item social-sales-content"><?php echo $rowplat['platformname']." - ".$rowplat['platformsub']; ?><span class="social-sales-count text-dark"><?php echo $rowplat['countsales']; ?> Sales</span>
                                        </li>
											<?php
											}
											?>
										</ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="sales.php" class="btn-primary-link">View Details</a>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end social source  -->
                                <!-- ============================================================== -->
                            </div>
						    <!-- ============================================================== -->
                            <!-- sales by platform source  -->
                                <?php
								$salesbypt="SELECT a.platform, sum(a.totalamount) as platformtotal, 
								count(a.platform) as countsales,
								b.platformname as platformname, 
								b.platformsub as platformsub  
								FROM sale as a, platform as b  where a.platform=b.code
								group by a.platform";
								$salesresultbypt=mysqli_query($conn,$salesbypt);
								$numrowspt=mysqli_num_rows($salesresultbypt);
							?>
							<!-- ============================================================== -->
                        	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Sales By Platform</h5>
                                    <div class="card-body p-0">
                                        <ul class="country-sales list-group list-group-flush">
										<?php
											while ($rowplat=mysqli_fetch_array($salesresultbypt,MYSQLI_ASSOC))
											{
										?>
										<li class="country-sales-content list-group-item"><span class="mr-2"><?php echo $rowplat['platformname']."-".$rowplat['platformsub']; ?></span>
                                                <span class=""></span><span class="float-right text-dark"><?php echo $rowplat['platformtotal']; ?></span>
                                        </li>
                                        <?php
											}
										?>
										<!--
                                            <li class="country-sales-content list-group-item"><span class="mr-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> </span>
                                                <span class="">United States</span><span class="float-right text-dark">78%</span>
                                            </li>
                                            <li class="list-group-item country-sales-content"><span class="mr-2"><i class="flag-icon flag-icon-ca" title="ca" id="ca"></i></span><span class="">Canada</span><span class="float-right text-dark">7%</span>
                                            </li>
                                            <li class="list-group-item country-sales-content"><span class="mr-2"><i class="flag-icon flag-icon-ru" title="ru" id="ru"></i></span><span class="">Russia</span><span class="float-right text-dark">4%</span>
                                            </li>
                                            <li class="list-group-item country-sales-content"><span class=" mr-2"><i class="flag-icon flag-icon-in" title="in" id="in"></i></span><span class="">India</span><span class="float-right text-dark">12%</span>
                                            </li>
                                            <li class="list-group-item country-sales-content"><span class=" mr-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i></span><span class="">France</span><span class="float-right text-dark">16%</span>
                                            </li>
										-->		
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="sales.php" class="btn-primary-link">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales by platform  -->
                            <!-- ============================================================== -->
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
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div id="mychat"><a href="http://www.phpfreechat.net">Creating chat rooms everywhere - phpFreeChat</a></div>
	<!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
	<script type="text/javascript">
	$('#mychat').phpfreechat({ serverUrl: 'phpfreechat/server' });
	</script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
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
		$('#recentorders').DataTable(
			{
			responsive: true,
			fixedColumns: false
			});
		</script>
</body>
 
</html>