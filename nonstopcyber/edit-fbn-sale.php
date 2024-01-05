<?php 
 include('connection.php');
 $pquery="select * from platform order by id";
 $presult=mysqli_query($conn,$pquery);
 $platform=array();
 while($prow=mysqli_fetch_array($presult,MYSQLI_ASSOC))
 {
	$platform[]=$prow;		
 }	 
 $saleid=$_REQUEST['saleid'];
 $query="select * from fbnsale where id=".$saleid;
 $sale=mysqli_query($conn,$query);
 $numrows=mysqli_num_rows($sale);
if ($numrows>0)
{
	$saledata=mysqli_fetch_assoc($sale);
}	
	$saleprquery="select * from fbnsale_products where saleid='".$saledata['id']."'";
	$prresult=mysqli_query($conn,$saleprquery);
	$saleproducts=array();
	while ($prodrow=mysqli_fetch_array($prresult,MYSQLI_ASSOC))
	{		
		$saleproducts[]=$prodrow;
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
                            <h2 class="pageheader-title">FBA Sale</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">FBA Sale</li>
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
                                    <h3 class="section-title">Sale</h3>
                                    <p>Kindly Fill the form</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>
                                    <div class="card-body">
									    <form id="saleform" name="saleform" method="post" action="" enctype="multipart/form-data">
                                           <input id="saleid" name="saleid" type="hidden" value="<?php echo $saledata['id']; ?>" class="form-control" required>
   											<?php 
											$images=explode(",",$saledata['sale_image']);
											for ($m=0; $m < sizeof($images);$m++)
											{
											?>
											<div class="form-group" id="imagegroup">
                                                <div class="imgadd">
													<label for="img" class="col-form-label">Image<span style="color: red;">*</span></label>
													<input type="file" class="form-control saleimg" name="saleimg[]" accept="image/*" ><br>
													<center><p><img class="output" src="fbnsaleimages/<?php echo $images[$m];?>" width="100" height="100" /></p></center>
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
                                                <label for="inputText3" class="col-form-label">Order Number</label>
                                                <input id="orderno" name="orderno" type="text" value="<?php echo $saledata['orderno']; ?>" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="inputText3" class="col-form-label">Sale Date</label>
                                                <input id="saledate" name="saledate" type="date" value="<?php echo date("Y-m-d",strtotime($saledata['tdate'])); ?>" class="form-control" required>
                                            </div>
								<div class="form-group">
                                <label for="platform" class="col-form-label">Platform</label>
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
										if ($platform[$i]['platformname']==$platform[$j]['platformname'])
										{
											if($saledata['platform']==$platform[$j]['code'])
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
								<?php
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
                                            <!--
											<table class="card-repeat">
                                            -->    
											<div style="width: 300px" id="reader"></div>
											<table class="table" >
											<thead>
											<tr>
                                                    <th>
                                                           <label for="barcode">Barcode</label>
                                                    </th>
                                                    <th>
                                                           <label for="nsinumber">NSI number</label>
                                                    </th>
                                                    <th>
                                                        <label for="productname">Product name</label>
                                                    </th>
                                                    <th>
                                                        <label for="qty">Quantity</label> 
                                                    </th>
													<th>
                                                        <label for="rate">Rate</label> 
                                                    </th>
													<th>
                                                        <label for="subtotal">Subtotal</label> 
                                                    </th>
										   </tr>
                                            </thead>
											<tbody>
											    <?php
													for ($x=0;$x<sizeof($saleproducts);$x++)
													{
												?>
												<tr id="<?php echo $x; ?>">
                                                    <td>
													<input type="hidden" id="id" name="id[]" class="form-control idclass" value="<?php echo $saleproducts[$x]['id'];?>" >
													<input  type="text"  value="<?php echo $saleproducts[$x]['barcode'];?>"  name="barcode[]" class="barcodeclass form-control" required>
                                                    </td>
                                                    <td>
														<input type="text" value="<?php echo $saleproducts[$x]['nsinumber'];?>" name="nsinumber[]"  class="nsinumberclass form-control" required>
													</td>
                                                    <td>
                                                        <input  type="text" value="<?php echo $saleproducts[$x]['productname'];?>"  name="productname[]" class="productnameclass form-control">
                                                    </td>
                                                    <td>
                                                        <input  type="number" value="<?php echo $saleproducts[$x]['quantity'];?>" name="quantity[]" class="quantityclass form-control">  
                                                    </td>
													<td>
                                                        <input  type="number" value="<?php echo $saleproducts[$x]['rate'];?>" name="rate[]" class="rateclass form-control">  
                                                    </td>
													<td>
                                                        <input  type="number" value="<?php echo $saleproducts[$x]['subtotal'];?>" name="subtotal[]" class="subtotalclass form-control">  
                                                    </td>
											    </tr>
												<?php 
													}
												?>
												</tbody>
                                            </table>
                                            <button type="button" class="add-row"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add Product</button>
                                            <button type="button" class="remove-row"><i class="fas fa-minus-square"></i>&nbsp;&nbsp;Remove Product</button>
                                            
                                            <div class="form-group">
                                                <label for="productvalue" class="col-form-label">Product Value</label>
                                                <input id="productvalue" value="<?php echo $saledata['product_value'];?>" name="productvalue" type="number" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="commissioncharges" class="col-form-label">Commision and Charges</label>
                                                <input id="commissioncharges" value="<?php echo  $saledata['commissioncharges'];?>" name="commissioncharges" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="shippingcharges" class="col-form-label">Shipping Charges</label>
                                                <input id="shippingcharges" value="<?php echo  $saledata['shippingcharges'];?>" name="shippingcharges" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="totalamount" class="col-form-label">Total Amount</label>
                                                <input id="totalamount" name="totalamount" value="<?php echo $saledata['totalamount'];?>" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="adtinf" class="col-form-label">Additional information (Serial Number for Electronics Product)</label>
                                                <input id="adtinf" name="adtinf" type="text" value="<?php echo $saledata['addtinfo'];?>" class="form-control" required>
                                            </div>
                                            <button name="saveedit" id="saveedit" type="submit" class="btn btn-primary btn-block">Save Edit</button>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
	<script src="assets/libs/js/main-js.js"></script>
	<script type="text/javascript">
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
                tableBody.append(markup);                
                commissioncharges=$("#commissioncharges").val();
					shippingcharges=$("#shippingcharges").val();
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
					totalamount=parseFloat(productval)-parseFloat(commissioncharges)+parseFloat(shippingcharges);
					$("#totalamount").val(totalamount);
            });
			
				$('.remove-row').click(function()
				{ 
					tableBody = $("table tbody");
					lineNo=tableBody.find("tr:last").attr("id");
					findline = '#'+(lineNo);
					deleteid1=tableBody.find("tr:last .idclass").val();
					$.ajax({
					  method: "POST",
					  url: "ajax/deletefbnsaleproduct.php",
					  cache: false,
					  datatype:'json',
					  data:{deleteid:deleteid1}
					})
					  .done(function(r) 
					{
						  alert(r);
					});
					productvalue=$(findline).find('.subtotalclass').val();
					productvalue1=$("#productvalue").val();
					$("#productvalue").val(parseFloat(productvalue1)-parseFloat(productvalue));
					$(findline).remove(); 
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
		
		$("#productvalue, #commissioncharges, #shippingcharges").change(function()
		{
				productval=$("#productvalue").val();
				commissioncharges=$("#commissioncharges").val();
				shippingcharges=$("#shippingcharges").val();
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

		
		$("#saveedit").click(function(e)
			{
				if ($("#orderno").val()=="")
				{
					alert("please enter order no.");
					return false;
				}
				if ($("#platform").val()=="")
				{
					alert("please select platform.");
					return false;
				}
				$(".nsinumberclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("sale products cannot be empty");
					return false;
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("sale products quantity cannot be empty");
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
					alert("please enter Shipping Charges value.");
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
				myform=document.getElementById('saleform');
				var data1 = new FormData(myform);
				e.preventDefault();
				$.ajax({
				  method: "POST",
				  url: "ajax/posteditfbnsaledata.php",
				  cache: false,
				  datatype:'json',
				  contentType: false,
				  processData: false,
				  data:data1
				})
				.done(function(saler) 
				{
					alert(saler);
					location.href="fbasales.php";	
				});
			});					
		});
		 
		$(document).on("change", ".barcodeclass", function(e)
			{
					 
				e.preventDefault();
				barcode1=$(this).val();
				id=$(this).closest("tr").attr("id");
				$.ajax({
				  method: "POST",
				  datatype : "JSON",
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
        
		 
		$(document).on( "change", ".nsinumberclass", function(e)
			{
				e.preventDefault();
				nsinumber1=$(this).val();
				id=$(this).closest("tr").attr("id");
				$.ajax({
				  method: "POST",
				  datatype : "JSON",
				  cache: false,
				  url: "ajax/getfbnnsinumberinfo.php",
				  data: {nsinumber:nsinumber1}
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
        
		$(document).on("change", ".rateclass", function(e)
		{
					rate=$(this).val();
					quantity=$(this).closest("tr").find(".quantityclass").val();
					subtotal=parseFloat(rate)*parseFloat(quantity);
					$(this).closest("tr").find(".subtotalclass").val(subtotal);
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
					subtotal=parseFloat(rate)*parseFloat(quantity);
					$(this).closest("tr").find(".subtotalclass").val(subtotal);
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
</script>




</body>
 
</html>