<?php
 include('connection.php');
 $pquery="select * from platform order by id";
 $presult=mysqli_query($conn,$pquery);
 $platform=array();
 while($prow=mysqli_fetch_array($presult,MYSQLI_ASSOC))
 {
	$platform[]=$prow;		
 }	 
 $returnid=$_REQUEST['returnid'];
 $query="select * from return1 where id=".$returnid;
 $return=mysqli_query($conn,$query);
 $numrows=mysqli_num_rows($return);
	if ($numrows>0)
	{
		$returndata=mysqli_fetch_assoc($return);
	}
		$returnprquery="select * from return_products where returnid='".$returnid."'";
		$prresult=mysqli_query($conn,$returnprquery);
		$returnproducts=array();
		while ($prodrow=mysqli_fetch_array($prresult,MYSQLI_ASSOC))
		{		
			$returnproducts[]=$prodrow;
		}			
?>
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
	<link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="assets/vendor/datatable/css/buttons.dataTables.min.css">
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
                            <h2 class="pageheader-title">Return</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Return</li>
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
                                    <h3 class="section-title">Return</h3>
                                    <p>Kindly Fill the form</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>
                                    <div class="card-body">
                                        <form id="returnform" name="returnform" method="post" action="" enctype="multipart/form-data">
                                            <input id="returnid"  name="returnid" type="hidden" value="<?php echo $returndata['id']; ?>" class="form-control"> 
   											<?php 
											$images=explode(",",$returndata['return_image']);
											for ($m=0; $m < sizeof($images);$m++)
											{
											?>
											<div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image<span style="color: red;">*</span></label>
													<input type="file" class="form-control returnimg" name="returnimg[]" accept="image/*" ><br>
													<center><p><img class="output" src="returnimages/<?php echo $images[$m];?>" width="100" height="100" /></p></center>
												</div>
											</div>
											<?php 
											}
											?>
   											<div class="form-group">
												<input type="button" class="btn btn-success" value="Add Image" id="addimg" name="addimg">
												<input type="button" class="btn btn-danger" value="Remove Image" id="removeimg" name="removeimg">
										    </div>
                                            <div class="form-group">
                                                <label for="orderno" class="col-form-label">Order Number</label><span style="color: red;">*</span>
                                                <input id="orderno" id="orderno" name="orderno" type="text" value="<?php echo $returndata['orderno']; ?>" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="returndate" class="col-form-label">Return Date</label><span style="color: red;">*</span>
                                                <input id="returndate"  name="returndate" type="date" value="<?php echo date("Y-m-d",strtotime($returndata['tdate'])); ?>" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="platform" class="col-form-label">Return From</label><span style="color: red;">*</span>
											    <select name="platform" id="platform" class="form-control">
                                        			<?php 
											$platformname="";
											for ($i=0;$i<sizeof($platform);$i++)
												{
												if ($platformname != $platform[$i]['platformname'])
													{		
													?>
													<optgroup label="<?php echo $platform[$i]['platformname'];?>"><?php echo $platform[$i]['platformname'];?>
													<?php
														for ($j=0;$j<sizeof($platform);$j++)
														{	
															if ($returndata['platform']==$platform[$j]['code'] and $platform[$j]['platformname']==$platform[$i]['platformname'])
															{
														?>
														<option value="<?php echo $platform[$j]['code'];?>" selected><?php echo $platform[$j]['platformsub'];?></option>
                                                		<?php
															}
															else
															{
														?>
														<option value="<?php echo $platform[$j]['code'];?>"><?php echo $platform[$j]['platformsub'];?></option>
                                                		<?php
															}	
														}
														?>
													</optgroup>
													<?php
													}
													$platformname=$platform[$i]['platformname'];
												}
												?>
													</select>
											</div>
                                            <div style="width: 300px" id="reader"></div>
												<style>
												#returntable_filter	{display:none;}
												#returntable_length{display:none;}
												</style>		
												<div class="table-responsive">												
												<table class="card-repeat table" id="returntable">
                                                <thead>
												<tr>
                                                    <th>
                                                           <label for="barcode">Barcode</label><span style="color: red;">*</span>
                                                    </th>
                                                    <th>
                                                           <label for="nsinumber">NSI number</label><span style="color: red;">*</span>
                                                    </th>
                                                    <th>
                                                        <label for="productname">Product name</label><span style="color: red;">*</span>
                                                    </th>
                                                    <th>
                                                        <label for="qty">Quantity</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <label for="damagestatus">Damage Status</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <label for="rate">rate</label><span style="color: red;">*</span> 
                                                    </th>
													<th>
                                                        <label for="subtotal">subtotal</label><span style="color: red;">*</span> 
                                                    </th>
											    </tr>
												</thead>
												<tbody>
                                                 <?php
													for ($x=0;$x<sizeof($returnproducts);$x++)
													{
												?>
												<tr id="<?php echo $x; ?>">
                                                    <td>
														<input  type="hidden"  name="id[]" value="<?php echo $returnproducts[$x]['id'];?>"  class="idclass form-control" required>
                                            			<input  type="text"  name="barcode[]" value="<?php echo $returnproducts[$x]['barcode'];?>"  class="barcodeclass form-control" required>
                                                    </td>
                                                    <td>
														<input type="text" name="nsinumber[]" value="<?php echo $returnproducts[$x]['nsinumber'];?>"  class="nsinumberclass form-control" required>
													</td>
                                                    <td>
                                                        <input  type="text" name="productname[]" value="<?php echo $returnproducts[$x]['productname'];?>"  class="productnameclass form-control">
                                                    </td>
                                                    <td>
                                                        <input  type="number" name="quantity[]" value="<?php echo $returnproducts[$x]['quantity'];?>" class="quantityclass form-control">  
                                                    </td>
											    	<td>
                                                        <select  name="damagestatus[]" class="form-control damagestatusclass">  
														<option value="">--Select damage status--</option>
														<?php 
														if ($returnproducts[$x]['isdamaged']=="damaged")
														{
														?>	
														<option value="damaged" selected>Damaged</option>
														<option value="goodcondition">Good Condition</option>
														<?php
														}
														?>
														<?php 
														if ($returnproducts[$x]['isdamaged']=="goodcondition")
														{
														?>	
														<option value="damaged">Damaged</option>
														<option value="goodcondition" selected>Good Condition</option>
														<?php
														}
														?>
														</select>
                                                    </td>
													<td>
                                                        <input  name="rate[]" type="number" value="<?php echo $returnproducts[$x]['rate'];?>" class="rateclass form-control">  
                                                    </td>
													<td>
                                                        <input  name="subtotal[]" type="number" value="<?php echo $returnproducts[$x]['subtotal'];?>" class="subtotalclass form-control">  
                                                    </td>
											    </tr>
												<?php 
													}
												?>
												</tbody>
                                            </table>
											</div>
                                            <button type="button" class="add-row"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add Product</button>
                                            <button type="button" class="remove-row"><i class="fas fa-minus-square"></i>&nbsp;&nbsp;Remove Product</button>
                                            <div class="form-group">
                                                <label for="productvalue" class="col-form-label">Product Value</label><span style="color: red;">*</span>
                                                <input id="productvalue"  name="productvalue" value="<?php echo $returndata['product_value']; ?>" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="commissioncharges" class="col-form-label">Commision and Charges</label><span style="color: red;">*</span>
                                                <input id="commissioncharges"  name="commissioncharges" value="<?php echo $returndata['commissioncharges']; ?>" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="totalamount" class="col-form-label">Total Amount</label><span style="color: red;">*</span>
                                                <input id="totalamount" name="totalamount" type="number" class="form-control" value="<?php echo $returndata['totalamount']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="adtinf" class="col-form-label">Additional information</label><span style="color: red;">*</span>
                                                <input id="adtinf" name="adtinf" type="text" class="form-control" value="<?php echo $returndata['addtinfo']; ?>" required>
                                            </div>
                                            <button  id="editsave" name="edutsave" type="submit" class="btn btn-primary btn-block">Edit Save</button>
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
	<audio style="display:none;" id="audio" src="assets\include\gesture-192.mp3" controls ></audio>
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
				$('#returntable').DataTable(
				{	
				});
		$("#addimg").click(function()
			{
				addnew="<div class='imgadd'><label for='img' class='col-form-label'>Image</label><input class='saleimg' type='file' name='saleimg[]' class='form-control' accept='image/*'><br><center><p><img src='' class='class' width='100' height='100'/></p></center></div>";
				$("#imagegroup").append(addnew);	
			});
			$("#removeimg").click(function()
			{
				$(".imgadd").last().remove();	
			});
		    $(".add-row").click(function () {
                tableBody = $("table tbody");
				lineNo=tableBody.find("tr:last").attr("id");
				lineNo=lineNo++;
				markup = '<tr id="'+lineNo+'"><td><div class="form-group"><input type="text" class="form-control barcodeclass" name="barcode[]" required></div></td><td><div class="form-group"><input type="text" class="form-control nsinumberclass" name="nsinumber[]" required></div></td><td><div class="form-group"><input type="text" name="productname[]" class="form-control productnameclass"></div></td><td><div class="form-group"><input type="number" name="quantity[]" class="form-control quantityclass"></div></td><td><div class="form-group"><select name="damagestatus[]" class="form-control damagestatusclass"><option value"">--Select Damage Status--</option><option value"damaged">Damaged</option><option value="notdamaged">Not Damaged</option></select></div></td><td><div class="form-group"><input type="text" name="rate[]" class="form-control rateclass"></div></td><td><div class="form-group"><input type="text" name="subtotal[]" class="form-control subtotalclass"></div></td></tr>';
                tableBody = $("table tbody");
                tableBody.append(markup);                
            });
             $('.remove-row').click(function(){ 
                tableBody = $("table tbody");
				lineNo=tableBody.find("tr:last").attr("id");
				findline = '#'+(lineNo);
				$(findline).remove(); 
                lineNo--;
                });
        
		$("#editsave").click(function(e)
			{
				$(".output").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("upload return image required.");
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("return products quantity cannot be empty");
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
				$(".nsinumberclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("return products cannot be empty");
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("return products quantity cannot be empty");
					}	
				});
				$(".rateclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("return products quantity cannot be empty");
					}	
				});
				$(".subtotalclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("return products subtotal cannot be empty");
					}	
				});
				if ($("#productvalue").val()=="")
				{
					alert("return product value cannot be empty.");
					return false;
				}
				if ($("#commissioncharges").val()=="")
				{
					alert("commissioncharges value cannot be empty");
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

				myform=document.getElementById('returnform');
				var data1 = new FormData(myform);
				e.preventDefault();
				$.ajax({
				  method: "POST",
				  url: "ajax/posteditreturndata.php",
				  cache: false,
				  datatype:'json',
				  contentType: false,
				  processData: false,
				  data:data1
				})
				  .done(function(returnr) 
				  {
					alert(returnr);
					location.href="returns.php";
				});
			});					
		});
		 
		$(document).on( "change", ".barcodeclass", function(e)
			{
				e.preventDefault();
				barcode1=$(this).val();
				$.ajax({
				  method: "GET",
				  datatype : "json",
				  cache: false,
				  url: "ajax/getbarcodeinfo.php",
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
</script>
    
</body>
 
</html>