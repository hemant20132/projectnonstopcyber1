<?php 
include('connection.php');
 $pquery="select * from platform order by id";
 $presult=mysqli_query($conn,$pquery);
 $platform=array();
 while($prow=mysqli_fetch_array($presult,MYSQLI_ASSOC))
 {
	$platform[]=$prow;		
 }	 
 $purchaseid=$_REQUEST['purchaseid'];
 $query="select * from purchase where id=".$purchaseid;
 $purchase=mysqli_query($conn,$query);
 $numrows=mysqli_num_rows($purchase);
if ($numrows>0)
{
	$purchasedata=mysqli_fetch_assoc($purchase);
}
	$purchaseprquery="select * from purchase_products where purchaseid='".$purchasedata['id']."'";
	$prresult=mysqli_query($conn,$purchaseprquery);
	$purchaseproducts=array();
	while ($prodrow=mysqli_fetch_array($prresult,MYSQLI_ASSOC))
	{		
		$purchaseproducts[]=$prodrow;
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
                            <h2 class="pageheader-title">Purchase</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Purchase</li>
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
                                    <h3 class="section-title">Purchase</h3>
                                    <p>Kindly Fill the form</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Basic Form</h5>&nbsp;&nbsp;&nbsp;&nbsp;Current Time :<?php date_default_timezone_set("Asia/Dubai"); echo date("H:i:s");?>
                                    <div class="card-body">
									    <form id="purchaseform" name="purchaseform" method="post" action="" enctype="multipart/form-data">
                                           <input id="purchaseid" name="purchaseid" type="hidden" value="<?php echo $purchasedata['id']; ?>" class="form-control" required>
                                           <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Invoice No.</label><span style="color: red;">*</span>
                                                <input id="invoiceno" name="invoiceno" type="text" value="<?php echo $purchasedata['invoiceno'];?>" class="form-control">
                                           </div>
										   <div class="form-group">
                                                <label for="orderno" class="col-form-label">Purchase Date</label><span style="color: red;">*</span>
                                                <input id="purchasedate" name="purchasedate" type="date" value="<?php echo date("Y-m-d",strtotime($purchasedata['tdate'])); ?>" class="form-control" required>
                                            </div>
											<div style="width:300px" id="reader"></div>
											<table class="table">
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
                                                        <label for="qty">Rate</label><span style="color: red;">*</span> 
                                                    </th>
											 </tr>
                                            </thead>
											<tbody>
											    <?php
													for ($x=0;$x<sizeof($purchaseproducts);$x++)
													{
												?>
												<tr id="<?php echo $x; ?>">
                                                    <td>
														<input type="hidden" id="id" class="form-control idclass" value="<?php echo $purchaseproducts[$x]['id'];?>" >
														<input  type="text" value="<?php echo $purchaseproducts[$x]['barcode'];?>"  id="barcode" class="barcodeclass form-control" required>
                                                    </td>
                                                    <td>
														<input type="text" value="<?php echo $purchaseproducts[$x]['nsinumber'];?>"  id="nsinumber" class="nsinumberclass form-control" required>
													</td>
                                                    <td>
                                                        <input  type="text" value="<?php echo $purchaseproducts[$x]['productname'];?>"  id="productname" class="productnameclass form-control">
                                                    </td>
                                                    <td>
                                                        <input  type="number" value="<?php echo $purchaseproducts[$x]['quantity'];?>" class="quantityclass form-control">  
                                                    </td>
													<td>
                                                        <input  type="number" value="<?php echo $purchaseproducts[$x]['rate'];?>" class="rateclass form-control">  
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
                                                <label for="productvalue" class="col-form-label">Product Value</label><span style="color: red;">*</span>
                                                <input id="productvalue" value="<?php echo $purchasedata['product_value']; ?>" name="productvalue" type="number" class="form-control" required>
                                            </div>
											<div class="form-group">
                                                <label for="vat" class="col-form-label">Vat</label><span style="color: red;">*</span>
                                                <input id="vat"  value="<?php echo $purchasedata['vat']; ?>" name="vat" type="number" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="totalamount" class="col-form-label">Total Amount</label><span style="color: red;">*</span>
                                                <input id="totalamount" name="totalamount" value="<?php echo $purchasedata['totalamount'];?>"  type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="adtinf" class="col-form-label">Additional information (Serial Number for Electronics Product)</label><span style="color: red;">*</span>
                                                <input id="adtinf" name="adtinf" type="text" value="<?php echo $purchasedata['addtinfo'];?>" class="form-control" required>
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
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
	<audio id="audio" src="assets\include\gesture-192.mp3" style="display:none;" controls></audio>
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
			
		$(document).ready(function () 
		{
			$(".add-row").click(function () 
			{
				tableBody = $("table tbody");
               	lineNo = tableBody.find("tr:last").attr('id');
			    lineNo++;
				markup = '<tr id='+lineNo+' class="lineclass"><td><div class="form-group"><input type="text" value="" class="form-control barcodeclass" required></div></td><td><div class="form-group"><input value="" type="text" class="form-control nsinumberclass" required></div></td><td><div class="form-group"><input value="" type="text" class="form-control productnameclass"></div></td><td><div class="form-group"><input type="number" value="" class="form-control quantityclass"></div></td><td><div class="form-group"><input type="number" value="" class="form-control rateclass"></div></td></tr>';
                tableBody.append(markup);                
            });
			
			$('.remove-row').click(function()
				{ 
					tableBody=$("table tbody");
					lineNo=tableBody.find("tr:last").attr("id");
					deleteidnumber=tableBody.find("tr:last .idclass").val();
					alert(deleteidnumber);
					$.ajax({
					  method: "POST",
					  datatype : "JSON",
					  cache: false,
					  url: "ajax/deletepurchaseproductid.php",
					  data: {deletepurchaseid:deleteidnumber}
					})
					  .done(function(r) 
					  {
						  alert(r);	
					});
					findline = '#'+(lineNo);
					$(findline).remove(); 
					lineNo--;
					subtotal=0;
					$('.rateclass').each(function() 
					{
					quantity=$(this).closest("tr").find(".quantityclass").val();
					rate=$(this).val();
					subtotal=parseFloat(rate)*parseFloat(quantity);
					});
						$("#productvalue").val(subtotal);
						productval=$("#productvalue").val();
						taxescharges=$("#vat").val();
					if (productval!="" && taxescharges !="")
					{
						totalamount=parseFloat(productval)+parseFloat(taxescharges);
						$("#totalamount").val(totalamount);
					}
				});
		
		$("#productvalue, #commissioncharges").change(function()
		{
				productval=$("#productvalue").val();
				commissioncharges=$("#commissioncharges").val();
				if (productval!="" && commissioncharges !="")
				{
				totalamount=parseInt(productval)-parseInt(commissioncharges);
				$("#totalamount").val(totalamount);
				}
		});

		
		$("#saveedit").click(function(e)
			{
				$(".saleimg").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("purchase image  cannot be empty.");
					return false;
					}	
				});
				if ($("#invoiceno").val()=="")
				{
					alert("Enter Invoice No.");
					return false;
				}
				if ($("#purchasedate").val()=="")
				{
					alert("purchase date cannot be empty");
					return false;
				}
				$(".barcodeclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("purchase products barcode cannot be empty");
					return false;
					}	
				});
				$(".nsinumberclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("purchase products nsinumber cannot be empty");
					return false;
					}	
				});
				$(".quantityclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("purchase products quantity cannot be empty");
					return false;
					}	
				});
				$(".rateclass").each(function() 
				{
					if ($(this).val()=="")
					{
					alert("purchase products rate cannot be empty");
					return false;
					}	
				});
				if ($("#productvalue").val()=="")
				{
					alert("please enter product value.");
					return false;
				}
				if ($("#vat").val()=="")
				{
					alert("please enter Vat amount value.");
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
				var data1 = new FormData();
				data1.append('purchaseid',$('#purchaseid').val());
				data1.append('invoiceno',$('#invoiceno').val());
				data1.append('purchasedate',$('#purchasedate').val());
				data1.append('productvalue',$('#productvalue').val());
				data1.append('vat',$('#vat').val());
				data1.append('totalamount',$('#totalamount').val());
				data1.append('adtinf',$('#adtinf').val());
				var idarr=[];
					$('.idclass').each(function() 
					{
					   idarr.push($(this).val());
					});
				data1.append('id',idarr);
				var barcodearr = [];
					$('.barcodeclass').each(function() 
					{
					   barcodearr.push($(this).val());
					});
				data1.append('barcode',barcodearr);
					var nsinumberarr = [];
					$('.nsinumberclass').each(function() 
					{
					   nsinumberarr.push($(this).val());
					});
				data1.append('nsinumber',nsinumberarr);
					var productnamearr = [];
					$('.productnameclass').each(function() 
					{
					   productnamearr.push($(this).val());
					});
				data1.append('productname',productnamearr);
					var quantityarr = [];
					$('.quantityclass').each(function() 
					{
					   quantityarr.push($(this).val());
					});
				data1.append('quantity',quantityarr);
					var ratearr = [];
					$('.rateclass').each(function() 
					{
					   ratearr.push($(this).val());
					});
				data1.append('rate',ratearr);
				e.preventDefault();
				$.ajax({
				  method: "POST",
				  url: "ajax/posteditpurchasedata.php",
				  cache: false,
				  datatype:'json',
				  contentType: false,
				  processData: false,
				  data:data1
				})
				  .done(function(purchaser) 
				  {
					  alert(purchaser);
					location.href="purchases.php";	
				});
			});					
		});
		
		 $(document).on("change", "#vat", function(e)
		 {
			 totalamount=parseFloat($("#productvalue").val())+parseFloat($("#vat").val());
			 $("#totalamount").val(totalamount);
		 });
		 
		 $(document).on("change", "#productvalue", function(e)
		 {
			 totalamount=parseFloat($("#productvalue").val())+parseFloat($("#vat").val());
			 $("#totalamount").val(totalamount);
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
				  url: "ajax/getnsinumberinfo.php",
				  data: {nsinumber:nsinumber1}
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
							subtotal=0;
							$('.rateclass').each(function() 
							{
							quantity=$(this).closest("tr").find(".quantityclass").val();
							rate=$(this).val();
							subtotal=subtotal+parseFloat(rate)*parseFloat(quantity);
							});
							$("#productvalue").val(subtotal);
							productval=$("#productvalue").val();
							taxescharges=$("#vat").val();
							if (productval!="" && taxescharges !="")
							{
								totalamount=parseFloat(productval)+parseFloat(taxescharges);
								$("#totalamount").val(totalamount);
							}
				});

				
				$(document).on("change", ".quantityclass", function(e)
				{			
							subtotal=0;
							$('.rateclass').each(function() 
							{
							quantity=$(this).closest("tr").find(".quantityclass").val();
							rate=$(this).val();
							subtotal=subtotal+parseFloat(rate)*parseFloat(quantity);
							});
							$("#productvalue").val(subtotal);
							productval=$("#productvalue").val();
							taxescharges=$("#vat").val();
							if (productval!="" && taxescharges !="")
							{
								totalamount=parseFloat(productval)+parseFloat(taxescharges);
								$("#totalamount").val(totalamount);
							}
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
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

</body>
 
</html>