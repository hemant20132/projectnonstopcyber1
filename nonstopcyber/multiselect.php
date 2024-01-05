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
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/multi-select/css/multi-select.css">
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
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Multiselect </h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Multiselect</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- multiselects  -->
                <!-- ============================================================== -->
                
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- boxed multiselect  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Boxed Multiselect</h5>
                                <div class="card-body">
                                    <select multiple="multiple" id="my-select" name="my-select[]">
                                        <option value='elem_1'>Elements 1</option>
                                        <option value='elem_2'>Elements 2</option>
                                        <option value='elem_3'>Elements 3</option>
                                        <option value='elem_4'>Elements 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end boxed multiselect  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- pre multiselectd options  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Pre-selected options</h5>
                                <div class="card-body">
                                    <select id='pre-selected-options' multiple='multiple'>
                                        <option value='elem_1' selected>Elements 1</option>
                                        <option value='elem_2'>Elements 2</option>
                                        <option value='elem_3'>Elements 3</option>
                                        <option value='elem_4' selected>Elements 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end pre multiselectd options  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- callbacks multiselectd  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Callbacks</h5>
                                <div class="card-body">
                                    <select id='callbacks' multiple='multiple'>
                                        <option value='elem_1'>Elements 1</option>
                                        <option value='elem_2'>Elements 2</option>
                                        <option value='elem_3'>Elements 3</option>
                                        <option value='elem_4'>Elements 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end callbacks multiselectd  -->
                        <!-- ============================================================== -->
                    </div>
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- keep over multiselectd  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Keep Over</h5>
                                <div class="card-body">
                                    <select id='keep-order' multiple='multiple'>
                                        <option value='elem_1'>Elements 1</option>
                                        <option value='elem_2'>Elements 2</option>
                                        <option value='elem_3'>Elements 3</option>
                                        <option value='elem_4'>Elements 4</option>
                                        <option value='elem_5'>Elements 5</option>
                                        <option value='elem_6'>Elements 6</option>
                                        <option value='elem_7'>Elements 7</option>
                                        <option value='elem_8'>Elements 8</option>
                                        <option value='elem_9'>Elements 9</option>
                                        <option value='elem_10'>Elements 10</option>
                                        <option value='elem_11'>Elements 11</option>
                                        <option value='elem_12'>Elements 12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end keep over multiselectd  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- optgroup multiselectd  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Optgroup</h5>
                                <div class="card-body">
                                    <select id='optgroup' multiple='multiple'>
                                        <optgroup label='Friends'>
                                            <option value='1'>Yoda</option>
                                            <option value='2' selected>Obiwan</option>
                                        </optgroup>
                                        <optgroup label='Enemies'>
                                            <option value='3'>Palpatine</option>
                                            <option value='4' disabled>Darth Vader</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end optgroup multiselectd  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- disabled multiselectd  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Disabled attribute</h5>
                                <div class="card-body">
                                    <select id='disabled-attribute' disabled='disabled' multiple='multiple'>
                                        <option value='elem_1'>Elements 1</option>
                                        <option value='elem_2'>Elements 2</option>
                                        <option value='elem_3'>Elements 3</option>
                                        <option value='elem_4'>Elements 4</option>
                                        <option value='elem_5'>Elements 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- disabled multiselectd  -->
                        <!-- ============================================================== -->
                    </div>
              
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include('assets/include/footer.php'); ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script>
    $('#my-select, #pre-selected-options').multiSelect()
    </script>
    <script>
    $('#callbacks').multiSelect({
        afterSelect: function(values) {
            alert("Select value: " + values);
        },
        afterDeselect: function(values) {
            alert("Deselect value: " + values);
        }
    });
    </script>
    <script>
    $('#keep-order').multiSelect({ keepOrder: true });
    </script>
    <script>
    $('#public-methods').multiSelect();
    $('#select-all').click(function() {
        $('#public-methods').multiSelect('select_all');
        return false;
    });
    $('#deselect-all').click(function() {
        $('#public-methods').multiSelect('deselect_all');
        return false;
    });
    $('#select-100').click(function() {
        $('#public-methods').multiSelect('select', ['elem_0', 'elem_1'..., 'elem_99']);
        return false;
    });
    $('#deselect-100').click(function() {
        $('#public-methods').multiSelect('deselect', ['elem_0', 'elem_1'..., 'elem_99']);
        return false;
    });
    $('#refresh').on('click', function() {
        $('#public-methods').multiSelect('refresh');
        return false;
    });
    $('#add-option').on('click', function() {
        $('#public-methods').multiSelect('addOption', { value: 42, text: 'test 42', index: 0 });
        return false;
    });
    </script>
    <script>
    $('#optgroup').multiSelect({ selectableOptgroup: true });
    </script>
    <script>
    $('#disabled-attribute').multiSelect();
    </script>
    <script>
    $('#custom-headers').multiSelect({
        selectableHeader: "<div class='custom-header'>Selectable items</div>",
        selectionHeader: "<div class='custom-header'>Selection items</div>",
        selectableFooter: "<div class='custom-header'>Selectable footer</div>",
        selectionFooter: "<div class='custom-header'>Selection footer</div>"
    });
    </script>
</body>
 
</html>