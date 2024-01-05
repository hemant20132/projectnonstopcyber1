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
                            <h2 class="pageheader-title">Edit User</h2>
                            <p class="pageheader-text">Please Fill the details for adding the product</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
									<?php 
										 // Create connection
										$id=$_REQUEST['userid'];
										$query = "SELECT * FROM user where id=".$id;
										$result = mysqli_query($conn,$query);
										if (mysqli_num_rows($result) > 0) 
												{
													while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
														{
										
									?>
                                        <form id="userform" name="userform" enctype="multipart/form-data"  method="POST" action="">
										<input type="hidden" id="userid" name="userid" value="<?php echo $row['id'];?>" >
										 <div class="form-group">
                                                <label for="userimage" class="col-form-label">User Image</label>
                                                <input id="userimg" name="userimg" type="file" class="form-control"  accept="image/*" onchange="loadFile(event)" required> <br>
												<center><p><img id="output" src="userimages/<?php echo $row['user_image'];?>" width="100" height="100" /></p></center>
											</div>
											<div class="form-group">
                                                <label for="name1" class="col-form-label">Name: </label>
                                                   <input id="name1" name="name1" type="text" value="<?php echo $row['name'];?>" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username" class="col-form-label">User Name: </label>
                                                <input id="username" name="username" type="text" value="<?php echo $row['username'];?>" class="form-control" required>
                                            </div>	
											<div class="form-group">
                                                <label for="userpassword" class="col-form-label">User Password: </label>
                                                <input id="userpassword" name="userpassword" value="<?php echo $row['password'];?>" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="useraddress" class="col-form-label">User Address: </label>
                                                <textarea id="useraddress" name="useraddress"   rows="4" cols="50" class="form-control">
												<?php echo $row['useraddress'];?>
												</textarea>	
                                            </div>
											<div class="form-group">
                                                <label for="usercontactno" class="col-form-label">User Contact No.: </label>
                                                <input id="usercontactno" name="usercontactno" type="text" 	value="<?php echo $row['usercontactno']; ?>" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="useremail" class="col-form-label">User Email: </label>
                                                <input id="useremail" name="useremail" type="email" value="<?php echo $row['useremail']; ?>" class="form-control" required>
                                            </div>
											<div class="form-group">
											    <label for="userrole"  class="col-form-label">Role: </label>
												<select id="userrole" name="userrole" class="form-control">
												<option value="">--Select User Role--</option>
												<?php
													if ($row['role']=='Admin')
													{
												?>
												<option value="Admin" selected>Admin</option>
												<option value="User" >User</option>
												<?php
													}
												?>	
												<?php
													if ($row['role']=='User')
													{
												?>
												<option value="Admin">Admin</option>
												<option value="User" selected>User</option>
												<?php
													}
												?>	
												</select>
											</div>
                                            <button id="saveuser" name="saveuser" type="submit" class="btn btn-primary btn-block">Save Edit</button>
                                        </form>
										<?php 
										}
											}
												
										?>
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
	
	var loadFile = function(event) 
	{
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
	};
	
$(document).ready(function()
{
				$("#saveuser").click(function(e)
				{
					var data1 = new FormData();
					data1.append('userid',$('#userid').val());
					data1.append('name',$('#name1').val());
					data1.append('username',$('#username').val());
					data1.append('userpassword',$('#userpassword').val());
					data1.append('useraddress',$('#useraddress').val());
					data1.append('usercontactno',$('#usercontactno').val());
					data1.append('useremail',$('#useremail').val());
					data1.append('userrole',$('#userrole').val());
					if ($("#userimage").val() != "")
					{
						data1.append('file', $('#userimg')[0].files[0]);
					}
					e.preventDefault();
					$.ajax({
					  method: "POST",
					  url: "ajax/postedituserdata.php",
					  cache: false,
					  datatype:'json',
					  contentType: false,
					  processData: false,
					  data: data1,
					})
					  .done(function(userr) 
					  {
						  alert(userr);
						 location.href="users.php";
					  
					  });
				});
				
});	
</script>
</body>
 
</html>


