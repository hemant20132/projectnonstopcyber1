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
	<link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/buttons.dataTables.min.css">
	<script src="assets/vendor/scanplugin/html5-qrcode.min.js"></script>
</head>
<body>
<style>
.form-control{width:100%;}
@media only screen and (max-width: 850px) 
{
	#returntable  
	{
	overflow: scroll;
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
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">FBA - Return</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">FBA - Return</li>
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
										
								$platform="select * from platform order by id";
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
                                    <h3 class="section-title">FBA - Return</h3>
                                    <p>Kindly Fill the form</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>
                                    <div class="card-body">
                                        <form id="returnform" name="returnform" method="post" action="" enctype="multipart/form-data">
											<div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image<span style="color: red;">*</span></label>
													<input type="file" class="form-control returnimg" name="returnimg[]" accept="image/*" ><br>
													<center><p><img class="output" src="" width="100" height="100" /></p></center>
												</div>
											</div>
											<div class="form-group">
												<input type="button" class="btn btn-success" value="Add Image" id="addimg" name="addimg">
												<input type="button" class="btn btn-danger" value="Remove Image" id="removeimg" name="removeimg">
										    </div>
											<div class="form-group">
                                                <label for="orderno" class="col-form-label">Order Number</label><span style="color: red;">*</span>
                                                <input id="orderno" id="orderno" name="orderno" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="platform" class="col-form-label">Return From</label><span style="color: red;">*</span>

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
											<style>
											#returntable_filter	{display:none;}
											#returntable_length{display:none;}
											</style>		
											<div style="width:300px" id="reader"></div>
											<div class="table-responsive">
											<table id="returntable" class="card-repeat table" >
                                                <thead>
												<tr>
                                                    <th>
                                                    <div class="form-group">
                                                           <label for="barcode">Barcode</label><span style="color: red;">*</span>
                                                        </div>
                                                    </th>
                                                    <th >
                                                    <div class="form-group">
                                                           <label for="nsinumber">NSI number</label><span style="color: red;">*</span>
                                                    </th>
                                                    <th>
                                                        <div class="form-group">
                                                        <label for="productname">Product name</label><span style="color: red;">*</span>
                                                    </th>
                                                    <th>
                                                        <div class="form-group">
                                                        <label for="qty">Quantity</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <div class="form-group">
                                                        <label for="qty">Damage Status</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <div class="form-group">
                                                        <label for="rate">Rate</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <div class="form-group">
                                                        <label for="subtotal">Sub Total</label><span style="color: red;">*</span> 
                                                    </th>
											    </tr>
												</thead>
												<tbody>
                                                <tr id='0'>
                                                    <td>
                                                    <div class="form-group">
                                                           <input type="text" name="barcode[]" class="form-control barcodeclass" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <div class="form-group">
                                                           <input type="text" name="nsinumber[]" class="form-control nsinumberclass" required>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                        <input type="text" name="productname[]" class="form-control productnameclass" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                        <input  type="number"  name="quantity" class="form-control quantityclass" required>  
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="form-group">
                                                        <select  class="form-control damagestatusclass" name="damagestatus[]" required>  
                                                        <option value=" ">--Select damage status--</option>
														<option value="damaged">Damaged</option>
														<option value="goodcondition" selected>Good Condition</option>
														</select>
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="form-group">
                                                        <input  type="number" name="rate[]" class="form-control rateclass" required>  
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="form-group">
                                                        <input  type="number" name="subtotal[]" class="form-control subtotalclass" required>  
                                                        </div>
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
                                                <label for="totalamount" class="col-form-label">Total Amount</label><span style="color: red;">*</span>
                                                <input id="totalamount" name="totalamount" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="adtinf" class="col-form-label">Additional information</label><span style="color: red;">*</span>
                                                <input id="adtinf" name="adtinf" type="text" class="form-control" required>
                                            </div>
                                            <button  id="savereturn" name="savereturn" type="submit" class="btn btn-primary btn-block">Submit</button>
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
	<audio id="audio" style="display:none;" src="assets\include\gesture-192.mp3" controls></audio>
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
	<script>
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
						playsound();
					    console.log(value1);
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
				addnew="<div class='imgadd'><label for='img' class='col-form-label'>Image</label><input class='returnimg' type='file' name='returnimg[]' class='form-control' accept='image/*'><br><center><p><img src='' class='class' width='100' height='100'/></p></center></div>";
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
				markup = '<tr id="'+lineNo+'"><td><div class="form-group"><input type="text" class="form-control barcodeclass" name="barcode[]" required></div></td><td><div class="form-group"><input type="text" name="nsinumber[]" class="form-control nsinumberclass" required></div></td><td><div class="form-group"><input type="text" name="productname[]" class="form-control productnameclass"></div></td><td><div class="form-group"><input type="number" name="quantity[]" class="form-control quantityclass"></div></td><td><div class="form-group"><select  name="damagestatus[]" class="form-control damagestatusclass"><option value="">--Select Damage Status--</option><option value="damaged">Damaged</option><option value="Good Condition" selected>Good Condition</option></select></div></td><td><div class="form-group"><input type="number" name="rate[]" class="form-control rateclass"></div></td><td><div class="form-group"><input type="number" name="subtotal[]" class="form-control subtotalclass"></div></td></tr>';
    			tableBody = $("table tbody");
                tableBody.append(markup);                
				lineNo++;
            });
             $('.remove-row').click(function(){ 
                findline = '#'+(lineNo-1);
                $(findline).remove(); 
                lineNo--;
                });
       
	   $("#orderno").change(function(e)
		{
				orderno=$("#orderno").val();
				e.preventDefault();
				$.ajax({
				  method: "POST",
				  url: "ajax/getfbasaledata.php",
				  dataType:"JSON",
				  data:{orderno:orderno}
				})
				  .done(function(ord) 
				  {
				lineNo=1;
					$("#totalamount").val(ord[0].totalamount);
						$("#productvalue").val(ord[0].product_value);
						$("#commissioncharges").val(ord[0].commissioncharges);
						$("#totalamount").val(ord[0].product_value-ord[0].commissioncharges);
						$("#adtinf").val(ord[0].addtinfo);
				for (i=0;i<ord.length;i++)
				{
					markup = '<tr id="'+lineNo+'"><td><div class="form-group"><input type="text" name="barcode[]" value="'+ord[i].barcode+'" class="form-control barcodeclass" required></div></td><td><div class="form-group"><input type="text" name="nsinumber[]" value="'+ord[i].nsinumber+'" class="form-control nsinumberclass" required></div></td><td><div class="form-group"><input type="text" name="productname[]" value="'+ord[i].productname+'" class="form-control productnameclass"></div></td><td><div class="form-group"><input type="number" name="quantity[]" value="'+ord[i].quantity+'" class="form-control quantityclass"></div></td><td><div class="form-group"><select class="form-control damagestatusclass" name="damagestatus[]" class="form-control damagestatusclass"><option value="">--Select Damage Status--</option><option value="damaged">Damaged</option><option value="goodcondition" selected>Good Condition</option></select></div></td><td><div class="form-group"><input type="number" name="rate[]" value="'+ord[i].rate+'" class="form-control rateclass"></div></td><td><div class="form-group"><input type="number" name="subtotal[]" value="'+ord[i].subtotal+'" class="form-control subtotalclass"></div></td></tr>';
					tableBody = $("table tbody");
					tableBody.html('');
					tableBody.append(markup);                
					lineNo++;
				}
				});
		});	
		
		$("#savereturn").click(function(e)
			{
				$(".returnimg").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("please select fbareturn image for upload.");
					return false;
					}	
				});
				if ($("#orderno").val()=="")
				{
					alert("Enter Order No.");
					return false;	
				}
				if ($("#platform").val()=="")
				{
					alert("Enter Platform No.");
					return false;	
				}
				$(".barcodeclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products barcode cannot be empty");
					return false;
					}	
				});
				$(".nsinumberclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products nsinumber cannot be empty");
					return false;
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products quantity cannot be empty");
					return false;	
					}	
				});
				$(".damagestatusclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products damage status not selected");
					return false;	
					}	
				});
				$(".rateclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products quantity cannot be empty");
						return false;	
					}	
				});
				$(".subtotalclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("fbareturn products subtotal cannot be empty");
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
				if ($("#totalamount").val()=="")
				{
					alert("please enter Total Amount.");
					return false;
				}
				if ($("#adtinf").val()=="")
				{
					alert("please enter Additional Information.");
					return false;
				}
				e.preventDefault();
				myform=document.getElementById('returnform');
				var data1 = new FormData(myform);
				$.ajax({
				  method: "POST",
				  url: "ajax/postfbareturndata.php",
				  cache: false,
				  datatype:'json',
				  contentType: false,
				  processData: false,
				  data:data1
				})
				  .done(function(returnr) 
				  {	
					  alert(returnr);
					  document.getElementById("returnform").reset();
					  location.href="fbareturns.php";
				  });
			});					
		});
	
		$(document).on("change", ".quantityclass", function(e)
		{
					quantity=$(this).val();
					rate=$(this).closest("tr").find(".rateclass").val();
					subtotal1=parseFloat(rate)*parseFloat(quantity);
					subtotal=0;
					$(this).closest("tr").find(".subtotalclass").val(subtotal1);
					$('.subtotalclass').each(function() 
					{
					subtotal=subtotal+parseFloat($(this).val());	
					});
					$("#productvalue").val(subtotal);
					$("#totalamount").val(subtotal-$("#commissioncharges").val());
		});		
	
		$(document).on("change", "#commissioncharges", function(e)
		{
					subtotal1=parseFloat(rate)*parseFloat(quantity);
					subtotal=0;
					$(this).closest("tr").find(".subtotalclass").val(subtotal1);
					$('.subtotalclass').each(function() 
					{
					subtotal=subtotal+parseFloat($(this).val());	
					});
					$("#productvalue").val(subtotal);
					$("#totalamount").val(subtotal-$("#commissioncharges").val());
		});
		
		$(document).on("change", ".barcodeclass", function(e)
			{
				e.preventDefault();
				barcode1=$(this).val();
				id=$(this).closest("tr").attr("id");
				$.ajax({
				  method: "GET",
				  datatype : "json",
				  cache: false,
				  url: "ajax/getfbabarcodeinfo.php",
				  data: {barcode:barcode1}
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
$(document).on("change",".returnimg",function(event)
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