<!doctype html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
	<link rel="manifest" href="manifest.json">
    <style>
    html,
    body 
	{
        height: 100%;
    }
	
    body 
	{
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
	
	
</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
	    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="index.php"><img style="max-width: 100%; max-height: 100%;" class="logo-img" src="assets/images/logo.png" alt="logo"></a></div>
            <div class="card-body">
                <form id="userform" name="userform" method="post" action="">
                    <div class="form-group">
                        <input class="form-control form-control-lg" style="width:300px;" name="username" id="username" type="text" placeholder="wifiwifi" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" style="width:300px;" name="password" id="password" type="password" placeholder="wifiwifi" required>
                    </div>
                    <div class="form-group passwordrow">
                        <label class="custom-control custom-checkbox">
						<!--
					   <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        -->
						</label>
                    </div>
					<span id="status"></span>
                    <button type="submit" id="signin" name="signin" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
					<!--
					<a href="#" class="footer-link">Create An Account</a></div>
					-->
				<div class="card-footer-item card-footer-item-bordered">
                    <!--
					<a href="#" class="footer-link">Forgot Password</a>
					-->
				</div>
            </div>
        </div>
    </div>
	</div>
	
	<!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
	
	<script>
		if ("serviceWorker" in navigator) {
		  window.addEventListener("load", function() {
			navigator.serviceWorker
			  .register("/serviceWorker.js")
			  .then(res => console.log("service worker registered"))
			  .catch(err => console.log("service worker not registered", err));
		  });
		}

        $(document).ready(function () 
		{
			$("#signin").click(function(e)
				{
					
					e.preventDefault();
					username1=$("#username").val();
					userpassword1=$("#password").val();
					$.ajax({
					  method: "POST",	
					  url: "ajax/checklogin.php",
					  data: {username:username1,userpassword:userpassword1}
					})
					  .done(function(response) 
					  {
							if (response=="success")
							{
							location.href="home.php";
							}
							else
							{
							alert("Wrong user name or password");
							}
					});
				});					
		});
	</script>
</body>
</html>