<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Non Stop Cyber</title>
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap-4/css/bootstrap.min.css">
	<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/all.css">
	<script src="assets/vendor/scanplugin/html5-qrcode.min.js"></script>
	<script src="assets/vendor/scanplugin/jsqrcode-combined.min.js"></script>
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
                            <h2 class="pageheader-title">Sale</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Sale</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <?php
								$platform="select * from platform where platformname='FBN' order by id";
								$platformresult=mysqli_query($conn,$platform);
								$platoformnum=mysqli_num_rows($platformresult);
								$platforms=array();
								while ($platformrow=mysqli_fetch_array($platformresult,MYSQLI_ASSOC))
									{
										$platforms[]=$platformrow;
									}
								?>
				<div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="basicform">
                                    <h3 class="section-title">FBN - Sale</h3>
                                    <p>Kindly Fill the form</p>
                                </div>
                                <div class="card">
                                    <h6 class="card-header">(Fields marked with <span style="color:red;">*</span> are compulsory.)</h6>
                                    <div class="card-body">
                                        <form id="saleform" name="saleform" method="post" action="" enctype="multipart/form-data">
											 <div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image<span style="color: red;">*</span></label>
													<input type="file" class="form-control saleimg" name="saleimg[]" accept="image/*" ><br>
													<center><p><img class="output" src="" width="100" height="100" /></p></center>
												</div>
											</div>
											<div class="form-group">
												<input type="button" class="btn btn-success" value="Add Image" id="addimg" name="addimg">
												<input type="button" class="btn btn-danger" value="Remove Image" id="removeimg" name="removeimg">
										    </div>
											
											<div class="form-group">
                                                <label for="inputText3" class="col-form-label">Order Number<span style="color: red;">*</span></label>
                                                <input id="orderno" name="orderno" type="text" class="form-control" required>
                                            </div>
											<div class="form-group">
											<?php date_default_timezone_set('Asia/Dubai'); $dt = new DateTime(); $dt= $dt->format('Y-m-d\TH:i:s');
											?>		
                                                <label for="saledate" class="col-form-label">Sale Date<span style="color: red;">*</span></label>
                                                <input id="saledate" name="saledate"  value="<?php echo $dt ; ?>" type="datetime-local" class="form-control" required>
                                            </div>
									        <div class="form-group">
                                                <label for="platform" class="col-form-label">Platform<span style="color: red;">*</span></label>
												 <select name="platform" id="platform" class="form-control" required>
													<?php
													$platform="";
													for ($j=0;$j<sizeof($platforms);$j++)
													{
														if ($platform != $platforms[$j]['platformname'])
														{														
														?>
														<optgroup label="<?php echo $platforms[$j]['platformname']; ?>">
														<?php
															for ($i=0;$i<sizeof($platforms);$i++)
															{
																if ($platforms[$j]['platformname']==$platforms[$i]['platformname'])
																{	
															?>
																<option value="<?php echo $platforms[$i]['code'];?>"><?php echo $platforms[$i]['platformsub'];?></option>
																<?php
																}
															}
															?>
														</optgroup>
														<?php
														}
														$platform=$platforms[$j]['platformname'];
																												
													}
													?>
												</select>
								             </div>
                                            <!--
											<table class="card-repeat">
                                            -->    
											<div style="width: 300px" id="reader"></div>
											<div class="table-responsive">
											<table class="table" >
											<thead>
											<tr>
                                                    <th>
                                                           <label for="barcode">Barcode<span style="color: red;">*</span></label>
                                                    </th>
                                                    <th>
                                                           <label for="nsinumber">NSI number<span style="color: red;">*</span></label>
                                                    </th>
                                                    <th>
                                                        <label for="productname">Product name<span style="color: red;">*</span></label>
                                                    </th>
                                                    <th>
                                                        <label for="qty">Quantity<span style="color: red;">*</span></label> 
                                                    </th>
													<th>
                                                        <label for="rate">Rate<span style="color: red;">*</span></label> 
                                                    </th>
													<th>
                                                        <label for="subtotal">subtotal<span style="color: red;">*</span></label> 
                                                    </th>
										     </tr>
                                            </thead>
											<tbody>
											    <tr id="0">
                                                    <td>
												    <input  type="text" value="" name="barcode[]" class="barcodeclass form-control" required>
                                                    </td>
                                                    <td>
                                                  	<input type="text" value=""  name="nsinumber[]" class="nsinumberclass form-control" required>
													</td>
                                                    <td>
                                                        <input  type="text" value=""  name="productname[]" class="productnameclass form-control" required>
                                                    </td>
                                                    <td>
                                                        <input  type="number" value="" name="quantity[]" class="quantityclass form-control" required>  
                                                    </td>
													<td>
                                                        <input  type="number" value="" name="rate[]" class="rateclass form-control">  
                                                    </td>
													<td>
                                                        <input  type="number" value="" name="subtotal[]" class="subtotalclass form-control">  
                                                    </td>
											    </tr>
												</tbody>
                                            </table>
											</div>
                                            <button type="button" class="add-row"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add Product</button>
                                            <button type="button" class="remove-row"><i class="fas fa-minus-square"></i>&nbsp;&nbsp;Remove Product</button>
                                            <div class="form-group">
                                                <label for="productvalue" class="col-form-label">Product Value</label><span style="color: red;">*</span>
                                                <input id="productvalue" value="" name="productvalue" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="commissioncharges" class="col-form-label">Commision and Charges</label><span style="color: red;">*</span>
                                                <input id="commissioncharges" value="" name="commissioncharges" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="shippingcharges" class="col-form-label">Shipping Charges</label><span style="color: red;">*</span>
                                                <input id="shippingcharges" value="" name="shippingcharges" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="totalamount" class="col-form-label">Total Amount</label><span style="color: red;">*</span>
                                                <input id="totalamount" name="totalamount" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="adtinf" class="col-form-label">Additional information (Serial Number for Electronics Product)<span style="color: red;">*</span></label>
                                                <input id="adtinf" name="adtinf" type="text" class="form-control" required>
                                            </div>
                                            <button name="savesale" id="savesale" type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </form>
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
	<audio id="audio" src="assets\include\gesture-192.mp3" style="display:none;" controls></audio>
	<!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
	<script src="assets/vendor/jquery/jquery-latest.min.js"></script>
	<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/dist/html5-qrcode.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
	<script src="assets/libs/js/main-js.js"></script>
	<script type="text/javascript">
		function playsound() 
		{
		  document.getElementById("audio").play();
		}
		
		$(document).on("change",".quantityclass",function(e)
				{
					productnsi=$(this).closest("tr").find(".nsinumberclass").val();
					platform=$("#platform").val();
					productqty=$(this).val();
					e.preventDefault();
					$.ajax({
					  method: "POST",
					  url: "ajax/getfbnproductstock.php",
					  cache: false,
					  dataType:'JSON',
					  data:{productnsi:productnsi,productplatform:platform}
					})
					  .done(function(productstock) 
					  {
						if (productstock[0].error=="nosuccess")
						{	
							alert("Stock for this product is finished");
							window.stockfinished=true;
						} 
						else
						{		
							stocksqty=parseInt(productstock[0].stocks_quantity);
							if (productqty > stocksqty)
							{
							alert("Stock for this product is finished");
							window.stockfinished=true;
							}
							else
							{
							window.stockfinished=false;	
							}
						}	
					});
				});
				
				$(document).on("focus",".barcodeclass",function()
				{
					id=$(this).closest("tr").attr("id");
					Html5Qrcode.getCameras().then(devices => {
						  /**
						   * devices would be an array of objects of type:
						   * { id: "id", label: "label" }
						   */
						   
						  if (devices && devices.length) {
							var cameraId = devices[0].id;
							// .. use this to start scanning.
						  }
						}).catch(err => 
						{
						  // handle err
						});

					function onScanSuccess(decodedText, decodedResult)
					{
						value1='';
						for (var key in decodedText) 
						{
						   var obj = decodedText[key];
						   for (var prop in obj) 
						   {
							  value1=value1+obj[prop];
						   }
						}
					//	alert(value1);
					   $("table tbody tr#"+id).find(".barcodeclass").val(value1);
					    console.log(value1);
						playsound();
						html5QrcodeScanner.clear();
						$(".barcodeclass").change();
						
					}

				function stopscan()
				{
				html5QrCode.stop().then(ignore => {
						  // QR Code scanning is stopped.
						  console.log("QR Code scanning stopped.");
						}).catch(err => {
						  // Stop failed, handle it.
						  console.log("Unable to stop scanning.");
						});
				}	
					function onScanFailure(error) 
					{
					  // handle scan failure, usually better to ignore and keep scanning.
					  // for example:
					  return false;
					  console.warn(`Code scan error = ${error}`);
					}

					let html5QrcodeScanner = new Html5QrcodeScanner(
						"reader", { fps: 10, qrbox: 250 }, /* verbose= */ false);
				
				
				html5QrcodeScanner.render(onScanSuccess, onScanFailure);
				});
		
		var lineNo = 1;
        $(document).ready(function () 
		{
			$("#addimg").click(function()
			{
				addnew="<div class='imgadd'><label for='img' class='col-form-label'>Image</label><input class='saleimg' type='file' name='saleimg[]' class='form-control' accept='image/*'><br><center><p><img src='' class='class' width='100' height='100'/></p></center></div>";
				$("#imagegroup").append(addnew);	
			});
			$("#removeimg").click(function()
			{
				$(".imgadd").last().remove();	
			});
			
		$(".add-row").click(function () 
			{
				tableBody = $("table tbody");
				lineNo=tableBody.find("tr:last").attr("id");
				lineNo++;
				markup = '<tr id='+lineNo+' class="lineclass"><td><div class="form-group"><input type="text" value="" name="barcode[]" class="form-control barcodeclass" onfocus="qrcodescan()" required></div></td><td><div class="form-group"><input value="" type="text" class="form-control nsinumberclass" name="nsinumber[]" required></div></td><td><div class="form-group"><input value="" type="text" name="productname[]" class="form-control productnameclass"></div></td><td><div class="form-group"><input type="number" value="" name="quantity[]" class="form-control quantityclass"></div></td><td><div class="form-group"><input type="number" name="rate[]" value="" class="form-control rateclass"></div></td><td><div class="form-group"><input type="number" value="" name="subtotal[]" class="form-control subtotalclass"></div></td></tr>';
                tableBody = $("table tbody");
                tableBody.append(markup);                
            });
                
				$('.remove-row').click(function()
				{ 
						tableBody = $("table tbody");
						lineNo=tableBody.find("tr:last").attr("id");
						findline = '#'+(lineNo-1);
						productvalue=$(findline).find('.subtotalclass').val();
						productvalue1=$("#productvalue").val();
						$("#productvalue").val(parseFloat(productvalue1)-parseFloat(productvalue));
						lineNo--;
						commissioncharges=$("#commissioncharges").val();
						shippingcharges=$("#shippingcharges").val();
						productval=$("#productvalue").val();
						if (productval=='')
						{
							productval=0;
						}
						if (commissioncharges=='')
						{
							commissioncharges=0;
						}
						if (shippingcharges=='')
						{
							shippingcharges=0;
						}
						totalamount=parseFloat(productval)-parseFloat(commissioncharges)-parseFloat(shippingcharges);
						$("#totalamount").val(totalamount);
					$(findline).remove(); 
				});
		
		$("#productvalue, #commissioncharges, #shippingcharges").change(function()
		{
				productval=$("#productvalue").val();
				commissioncharges=$("#commissioncharges").val();
				shippingcharges=$("#shippingcharges").val();
				if (productval!="" && commissioncharges !="" && shippingcharges !="")
				{
				totalamount=parseFloat(productval)-parseFloat(commissioncharges)-parseFloat(shippingcharges);
				$("#totalamount").val(totalamount);
				}
		});
		
		$("#savesale").click(function(e)
			{
				$(".saleimg").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("please upload fbnsale image.");
					return false;
					}	
				});
				
				if ($("#orderno").val()=="")
				{
					alert("please enter fbnsale order no.");
					return false;
				}
				if ($("#platform").val()=="")
				{
					alert("please select fbnsale platform.");
					return false;
				}
				$(".barcodeclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbnsale products barcode cannot be empty");
					return false;
					}	
				});
				$(".nsinumberclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbnsale products nsinumber cannot be empty");
					return false;
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbnsale products quantity cannot be empty");
					return false;
					}	
				});
				$(".rateclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbnsale products rate cannot be empty");
					return false;
					}	
				});
				$(".subtotalclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbnsale products subtotal cannot be empty");
					return false;
					}	
				});
				if ($("#productvalue").val()=="")
				{
					alert("please enter product value.");
					return false;
				}
				if ($("#commissioncharges").val()=="")
				{
					alert("please enter Commission charges value.");
					return false;
				}
				if ($("#shippingcharges").val()=="")
				{
					alert("please enter shipping charges value.");
					return false;
				}
				if ($("#adtinf").val()=="")
				{
					alert("please enter Additional Information.");
					return false;
				}
				if (window.stockfinished==true)
				{
				alert('stock finished for the sale product');
				return false;
				}
				myform=document.getElementById('saleform');
				var data1 = new FormData(myform);
				e.preventDefault();
				$.ajax({
				  method: "POST",
				  url: "ajax/postfbnsaledata.php",
				  cache: false,
				  datatype:'json',
				  contentType: false,
				  processData: false,
				  data:data1
				})
				  .done(function(saler) 
				  {
					  alert(saler);
					  document.getElementById("saleform").reset();
					  location.href="fbnsales.php";
				  });
			});					
		});
		 
		$(document).on("change", ".barcodeclass", function(e)
			{
				e.preventDefault();
				barcode1=$(this).val();
				platform=$("#platform").val();
				id=$(this).closest("tr").attr("id");
				$.ajax({
				  method: "POST",
				  datatype : "JSON",
				  cache: false,
				  url: "ajax/getfbnbarcodeinfo.php",
				  data: {barcode:barcode1,productplatform:platform}
				})
				  .done(function(r) 
				  {
					  obj=JSON.parse(r);
					  if (obj[0].error=="nosuccess")
					  {
					  alert("product not found");
					  }
					  else	
					  {	
					  $("table tbody tr#"+id).find(".nsinumberclass").val(obj[0].nsi_number);
					  $("table tbody tr#"+id).find(".productnameclass").val(obj[0].product_name);
					  }	
				});
			});					
        
		 
		$(document).on( "change", ".nsinumberclass", function(e)
			{
				e.preventDefault();
				nsinumber1=$(this).val();
				platform=$("#platform").val();
				id=$(this).closest("tr").attr("id");
				$.ajax({
				  method: "POST",
				  datatype : "JSON",
				  cache: false,
				  url: "ajax/getfbnnsinumberinfo.php",
				  data: {nsinumber:nsinumber1,productplatform:platform}
				})
				  .done(function(r) 
				  {
					 obj=JSON.parse(r);
 					  $("table tbody tr#"+id).find(".barcodeclass").val(obj[0].barcode);
					  $("table tbody tr#"+id).find(".productnameclass").val(obj[0].product_name);
			
				});
			});

		$(document).on("change", ".rateclass", function(e)
		{
			
					rate=$(this).val();
					quantity=$(this).closest("tr").find(".quantityclass").val();
					subtotal1=parseFloat(rate)*parseFloat(quantity);
					$(this).closest("tr").find(".subtotalclass").val(subtotal1);
					subtotal=0;
					$('.subtotalclass').each(function() 
					{
					subtotal=subtotal+parseFloat($(this).val());	
					});
					$("#productvalue").val(subtotal);
					commissioncharges=$("#commissioncharges").val();
					shippingcharges=$("#shippingcharges").val();
					productval=$("#productvalue").val();
					if (productval=='')
					{
						productval=0;
					}
					if (commissioncharges=='')
					{
						commissioncharges=0;
					}
					if (shippingcharges=='')
					{
						shippingcharges=0;
					}
					totalamount=parseFloat(productval)-parseFloat(commissioncharges)-parseFloat(shippingcharges);
					$("#totalamount").val(totalamount);		
		});
		
		$(document).on("change", ".quantityclass", function(e)
		{
					quantity=$(this).val();
					rate=$(this).closest("tr").find(".rateclass").val();
					subtotal1=parseFloat(rate)*parseFloat(quantity);
					$(this).closest("tr").find(".subtotalclass").val(subtotal1);
					subtotal=0;
					$('.subtotalclass').each(function() 
					{
					subtotal=subtotal+parseFloat($(this).val());	
					});
					$("#productvalue").val(subtotal);
					productvalue=$("#productvalue").val();
					commissioncharges=$("#commissioncharges").val();
					shippingcharges=$("#commissioncharges").val();
					totalamount=productvalue-commissioncharges-shippingcharges;
					$("#totalamount").val(totalamount);
		});		
		
		$(document).on( "change", "#commissioncharges #shippingcharges", function(e)
			{
					$("#productvalue").val(subtotal1);
					commissioncharges=$("#commissioncharges").val();
					shippingcharges=$("#commissioncharges").val();
					totalamount=productvalue-commissioncharges-shippingcharges;
					$("#totalamount").val(totalamount);
			});
    </script>
    <script>
   function increment() {
      document.getElementById('qty').stepUp();
   }
   function decrement() {
      document.getElementById('qty').stepDown();
   }
</script>
<script>
$(document).on("change",".saleimg",function(event)
	{
		  var filename=URL.createObjectURL(event.target.files[0]);
		  $(this).closest(".imgadd").find("img").attr("src",filename);	
	});	
	
/*
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
*/
</script>




</body>
 
</html>