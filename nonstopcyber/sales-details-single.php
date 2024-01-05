<!doctype html>
<html lang="en">
<?php include('connection.php');?>
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
    <title>Non Stop Cyber</title>
</head>

<body>
<style>
@media only screen and (max-width: 850px) 
{
	#saletable  
	{
		overflow:scroll;
	}
}
</style>
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">E-commerce Sales </h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-coommerce</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Sales Details</li>
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
					$platform="select * from platform order by id";
					$platformresult=mysqli_query($conn,$platform);
					$platoformnum=mysqli_num_rows($platformresult);
					$platforms=array();
					while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
						{
							$platforms[]=$platformrow;
						}
					
					$saleid=$_GET['saleid'];
					$query="select * from `sale` where id=".$saleid;
					$result=mysqli_query($conn,$query);
					$numrows=mysqli_num_rows($result);
					if ($numrows>0)
					{
					$row=mysqli_fetch_assoc($result);
					}
					
					$querypr="select * from sale_products where saleid=".$saleid;
					$resultpr=mysqli_query($conn,$querypr);
					$numrowspr=mysqli_num_rows($resultpr);
					$rowpr=array();
					if ($numrowspr>0)
					{
						while($rowp=mysqli_fetch_array($resultpr,MYSQLI_ASSOC))
						{
						$rowpr[]=$rowp;	
						}
					}
					
					$userquery="select * from user";
					$userresult=mysqli_query($conn,$userquery);
					$numrowsuser=mysqli_num_rows($userresult);
					$users=array();
					if ($numrowsuser>0)
					{
						while($rowuser=mysqli_fetch_array($userresult,MYSQLI_ASSOC))
						{
						$users[]=$rowuser;	
						}
					}
					
					?>
											<style>
													.zoom {
													  left :-100px;	
													  padding: 50px;
													  transition: transform .2s; /* Animation */
													  width: 300px;
													  height: 300px;
													  margin: 0 auto;
													}

													.zoom:hover {
													  transform: scale(2.0); /* (200% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
													}
											</style>
				                        
										
					<div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
                                    <div class="product-details">
                                        <div class="border-bottom pb-3 mb-3">
											<center>
											<img class="zoom" src="saleimages/<?php echo $row['sale_image'];?>" width="240px" height="240px" style="max-height:150%; max-width:150%;margin-left:-10px;" alt="">
											</center>
											<br>
                                            <h3 class="mb-0 text-primary totalamount" style="margin-top:100px;">Total Amount : AED <?php echo $row['totalamount']; ?> </h3>
										</div>
                                        <div class="product-size border-bottom" style="margin-top:100px;">
                                         	<div class="table-responsive">
											<table class="table" id="saletable">
											<thead>
											<tr><th><h4>Order No</h4></th><th><h4>Platform</h4><th><h4>Product Value</h4></th><th><h4>Commissioncharges</h4></th><th><h4>Shippingcharges</h4></th><th><h4>Total Amount</h4></th><th><h4>User Name</h4></th></tr>
                                            </thead>
											<tbody>
											<?php
											for ($j=0;$j<sizeof($platforms);$j++)
												{
														if ($platforms[$j]["code"] == $row["platform"])
														{
															$platformname=$platforms[$j]["platformname"]." - ".$platforms[$j]["platformsub"];
														}	
												}
											?>
											<?php
											for ($k=0;$k<sizeof($users);$k++)
												{
														if ($users[$k]["username"] == $row["username"])
														{
															$username=$users[$k]["name"];
														}	
												}
											?>
											<tr><td><?php echo $row['orderno']; ?></td><td><?php echo $platformname; ?></td><td><?php echo $row['product_value']; ?></td><td><?php echo $row['commissioncharges']; ?></td><td><?php echo $row['shippingcharges']; ?></td><td><?php echo $row['totalamount']; ?></td><td><?php echo $username; ?></td></tr>
											</tbody>
											</table>
											</div>
										</div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
                                    <div class="simple-card" >
                                        <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active border-left-0" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="true">Descriptions</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="false">Sales Product Details</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent5" >
                                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                                <p><?php echo $row['addtinfo'];?></p>
											    <!--
												<p>Praesent et cursus quam. Etiam vulputate est et metus pellentesque iaculis. Suspendisse nec urna augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubiliaurae.</p>
											    <p>Nam condimentum erat aliquet rutrum fringilla. Suspendisse potenti. Vestibulum placerat elementum sollicitudin. Aliquam consequat molestie tortor, et dignissim quam blandit nec. Donec tincidunt dui libero, ac convallis urna dapibus eu. Praesent volutpat mi eget diam efficitur, a mollis quam ultricies. Morbi eu turpis odio.</p>
                                                <ul class="list-unstyled arrow">
                                                    <li>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Donec ut elit sodales, dignissim elit et, sollicitudin nulla.</li>
                                                    <li>Donec at leo sed nisl vestibulum fermentum.
                                                    </li>
                                                </ul>
												-->
                                            </div>
                                            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                                            <div class="review-block">
			                                <div class="table-responsive">
											<table class="table">
											<thead>
											<tr><th><h4>Order No</h4></th><th><h4>NSI No</h4><th><h4>Product Name</h4></th><th><h4>Quantity</h4></th><th><h4>Rate</h4></th><th><h4>Subtotal</h4></th></tr>
                                            </thead>
											<tbody>
											<?php 
											for($i=0;$i<sizeof($rowpr);$i++)
											{
											?>
											<tr><td><?php echo $rowpr[$i]['saleorderno']; ?></td><td><?php echo $rowpr[$i]['nsinumber']; ?></td><td><?php echo $rowpr[$i]['productname']; ?></td><td><?php echo $rowpr[$i]['quantity']; ?></td><td><?php echo $rowpr[$i]['rate']; ?></td><td><?php echo $rowpr[$i]['subtotal']; ?></td></tr>
											<?php
											}
											?>
											</tbody>
											</table>
											</div>	
												<!---
                                                    <p class="review-text font-italic m-0">“Vestibulum cursus felis vel arcu convallis, viverra commodo felis bibendum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin non auctor est, sed lacinia velit. Orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus.”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Virgina G. Lightfoot</span><small class="text-mute"> (Company name)</small>
                                                </div>
                                                <div class="review-block border-top mt-3 pt-3">
                                                    <p class="review-text font-italic m-0">“Integer pretium laoreet mi ultrices tincidunt. Suspendisse eget risus nec sapien malesuada ullamcorper eu ac sapien. Maecenas nulla orci, varius ac tincidunt non, ornare a sem. Aliquam sed massa volutpat, aliquet nibh sit amet, tincidunt ex. Donec interdum pharetra dignissim.”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Ruby B. Matheny</span><small class="text-mute"> (Company name)</small>
                                                </div>
                                                <div class="review-block  border-top mt-3 pt-3">
                                                    <p class="review-text font-italic m-0">“ Cras non rutrum neque. Sed lacinia ex elit, vel viverra nisl faucibus eu. Aenean faucibus neque vestibulum condimentum maximus. In id porttitor nisi. Quisque sit amet commodo arcu, cursus pharetra elit. Nam tincidunt lobortis augueat euismod ante sodales non. ”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Gloria S. Castillo</span><small class="text-mute"> (Company name)</small>
                                                -->
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>

    </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <!-- jquery 3.3.1 -->
        <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <!-- bootstap bundle js -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- slimscroll js -->
        <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
        <!-- main js -->
        <script src="assets/libs/js/main-js.js"></script>
        <script>
		 $(".zoom").hover(function() 
			{
				$(".totalamount").css("margin-top","200px");
				$(".product-size").css("margin-top","200px");
			}),
			function() 
			{
				$(this).css("width","300px");
				$(this).css("height","300px");
				$(".totalamount").css("margin-top","10px");
				$(".product-size").css("margin-top","10px");
		   });
		 
		jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });
        </script>
</body>

 
</html>