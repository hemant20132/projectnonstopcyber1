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
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
	<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
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
                            <h2 class="pageheader-title">Import Product CSV</h2>
                            <p class="pageheader-text">Please Fill the details for adding the product</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Import Product</li>
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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="basicform">
                                    <h3 class="section-title">Basic Form Elements</h3>
                                    <p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>
                                    <div class="card-body">
                                        <!---
										<div class="d-block d-sm-none">
										<form id="importform" name="importform" enctype="multipart/form-data"  method="POST" action="">
                                           <div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="importfile" class="col-form-label">Import CSV File </label>
													<input type="file" class="form-control" name="importfile" id="importfile" ><br>
												</div>
											</div>
											<button id="saveimport" name="saveimport" type="submit" class="btn btn-primary btn-block">Import CSV</button>
                                        </form>
										</div>
										-->
										<div class="d-none d-sm-block">
										<form id="importform" name="importform" enctype="multipart/form-data"  method="POST" action="">
                                           <div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="importfile" class="col-form-label">Import CSV File </label>
													<input type="file" class="form-control" name="importfile" id="importfile" ><br>
												</div>
											</div>
											<button id="saveimport" name="saveimport" type="submit" class="btn btn-primary btn-block">Import CSV</button>
                                        </form>
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
<script>
$(document).ready(function()
{
		$("#saveimport").click(function(e)
				{
					myForm = document.getElementById('importform');
					data1 = new FormData(myForm);
					e.preventDefault();
					$.ajax({
					  method: "POST",
					  url: "ajax/postimportcsvdata.php",
					  cache: false,
					  datatype:'json',
					  contentType: false,
					  processData: false,
					  data:data1,
					})
					  .done(function(importr) 
					  {
					  alert(importr);
					  });
				});
});
</script>
</body>
 
</html>


