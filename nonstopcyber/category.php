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
                            <h2 class="pageheader-title">Category & Subcategory Code </h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Category & Subcategory</li>
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
                    <!-- ============================================================== -->
                        <!-- contextual table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Category & Subcategory</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Category Code</th>
                                                <th>Sub Category</th>
                                                <th>Sub Category Code</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Animals & Pets Supplies</td>
                                                <td>AP</td>
                                                <td>Animal Food <br>Animal Accessories</td>
                                                <td>APAF <br> APAA</td>
                                            </tr>
                                            <tr>
                                                <td>Apparel & Accessories</td>
                                                <td>AA</td>
                                                <td>Clothing <br> Clothing Accessories</td>
                                                <td>AACL <br> AACA</td>
                                            </tr>
                                            <tr>
                                                <td>Arts & Entertainment</td>
                                                <td>AE</td>
                                                <td>Hobbies & Creative Arts <br> Party & Celebration</td>
                                                <td>AEHC <br> AEPC</td>
                                            </tr>
                                            <tr>
                                                <td>Baby & Toddler</td>
                                                <td>BT</td>
                                                <td>Baby Bathing & Body <br> Baby Gift Sets <br> Baby Safety <br> Baby Toys & Activity Equipment <br>Baby Transport Accessories <br> Diaperring <br> Nursing & Feeding </td>
                                                <td>BTBB <br> BTBG <br> BTBS <br> BTBE <br> BTBT <br> BTDI <br> BTNE</td>
                                            </tr>
                                            <tr>
                                                <td>Business & Industrial</td>
                                                <td>BI</td>
                                                <td>Medical <br> Retail <br> Agriculture </td>
                                                <td>BIMD <br> BIRE <br> BIAG </td>
                                            </tr>
                                            <tr>
                                                <td>Cameras & Optics</td>
                                                <td>CO</td>
                                                <td>Cameras & Optics Categories <br> Cameras <br> Optics <br> Photography </td>
                                                <td>COCA <br> COCR <br> COOP <br> COPH </td>
                                            </tr>
                                            <tr>
                                                <td>Electronics</td>
                                                <td>EL</td>
                                                <td>Audio & Video Accessories <br> Mobile Phones & Tablets <br> Computers <br> Print, Copy, Scan & Fax <br> Networking </td>
                                                <td>ELAV <br> ELMT <br> ELCP <br> ELCS <br> ELNT </td>
                                            </tr>
                                            <tr>
                                                <td>Food, Beverages & Tobacco</td>
                                                <td>FB</td>
                                                <td>Beverages <br> Food Items <br> Tobacco </td>
                                                <td>FBBG <br> FBFI <br> FBTB </td>
                                            </tr>
                                            <tr>
                                                <td>Furniture</td>
                                                <td>FR</td>
                                                <td>Beds & Accessories <br> Dinig Furniture & Accessories <br> Cabinet & Storage <br> Sofa & Accessories </td>
                                                <td>FRBA <br> FRDA <br> FRCS <br> FRSA </td>
                                            </tr>
                                            <tr>
                                                <td>Hardware</td>
                                                <td>HW</td>
                                                <td>Building Materials <br> Hardware Accessories <br> Tools & Tools Accessories <br> Locks & Keys <br> Power & Electrical Supplies </td>
                                                <td>HWBM <br> HWHA <br> HWTA <br> HWLK <br> HWPE </td>
                                            </tr>
                                            <tr>
                                                <td>Health & Beauty</td>
                                                <td>HB</td>
                                                <td>Health Care <br> Gift Sets <br> Lotions & Moisturisers <br> Perfumes <br> Hand Care <br> Hand Sanitizers <br> Body Care <br> Hair Care </td>
                                                <td>HBHC <br> HBGS <br> HBLM <br> HBPF <br> HBCR <br> HBHS <br> HBBC <br> HBHR </td>
                                            </tr>
                                            <tr>
                                                <td>Home & Garden</td>
                                                <td>HG</td>
                                                <td>Bathroom Accessories <br> Decor <br> Air Freshner <br> Household Appliances <br> Household Supplies <br> Kitchen & Dining <br> Lawn & Garden </td>
                                                <td>HGBA <br> HGDC <br> HGAF <br> HGHA <br> HGHS <br> HGKD <br> HGLG </td>
                                            </tr>
                                            <tr>
                                                <td>Luggage & Bags</td>
                                                <td>LB</td>
                                                <td>Luggage <br> Bags <br> Luggage & Bags Accessories</td>
                                                <td>LBLG <br> LBBG <br> LBLA </td>
                                            </tr>
                                            <tr>
                                                <td>Mature</td>
                                                <td>MR</td>
                                                <td>Erotic <br> Weapons </td>
                                                <td>MRER <br> MRWP </td>
                                            </tr>
                                            <tr>
                                                <td>Media</td>
                                                <td>MD</td>
                                                <td>Prints <br> Audio <br> Videos </td>
                                                <td>MDPR <br> MDAU <br> MDVI </td>
                                            </tr>
                                            <tr>
                                                <td>Office Supplies</td>
                                                <td>OS</td>
                                                <td>Office Accessories <br> General Office Supplies <br> Office Equipments </td>
                                                <td>OSOA <br> OSGS <br> OSOE </td>
                                            </tr>
                                            <tr>
                                                <td>Religious & Ceremonial</td>
                                                <td>RC</td>
                                                <td>Religious Items <br> Memorial Ceremony Items </td>
                                                <td>RCRI <br> RCMC </td>
                                            </tr>
                                            <tr>
                                                <td>Software</td>
                                                <td>SW</td>
                                                <td>Computer Software <br> Antivirus </td>
                                                <td>SWCS <br> SWAV </td>
                                            </tr>
                                            <tr>
                                                <td>Sporting Goods</td>
                                                <td>SG</td>
                                                <td>Athletics <br> Excercise & Fitness <br> Indoor Games <br> Outdoor Recreation <br> Sporting Supplements </td>
                                                <td>SGAT <br> SGEF <br> SGIG <br> SGOR <br> SGSP </td>
                                            </tr>
                                            <tr>
                                                <td>Toys & Games</td>
                                                <td>TG</td>
                                                <td>Games <br> Video Games <br> Outdoor Play Equipment <br> Toys </td>
                                                <td>TGGM <br> TGVG <br> TGOP <br> TGTS </td>
                                            </tr>
                                            <tr>
                                                <td>Vehicles & Parts</td>
                                                <td>VP</td>
                                                <td>Vehicles Parts & Accesories <br> Vehicle maintainance, care & Decor <br> Vehicle Safety & Security </td>
                                                <td>VPVA <br> VPVM <br> VPVS </td>
                                            </tr>
                                            <tr>
                                                <td>Fragrance</td>
                                                <td>FG</td>
                                                <td>Candles <br> Mists </td>
                                                <td>FGCD <br> FGMS </td>
                                            </tr>
                                            <tr>
                                                <td>Cosmetics</td>
                                                <td>CM</td>
                                                <td>Eye <br> Face <br> Lip <br> Makeup Remover & Cleanser </td>
                                                <td>CMEY <br> CMFC <br> CMLP <br> CMRC </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Category</th>
                                                <th>Category Code</th>
                                                <th>Sub Category</th>
                                                <th>Sub Category Code</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
</body>
 
</html>