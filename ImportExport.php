<?php require_once 'assets/php/category.php'; ?>
<?php require_once 'assets/php/session.php'; ?>
<?php require_once 'assets/php/languages.php'; ?>
<?Php require_once 'assets/php/logs.php';
$logs = new Logs; ?>
<?php $lang = new lang(); ?>
<?php

if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

require_once 'assets/php/group.php';
require_once 'assets/php/users.php';

$Group = new Group;
$users = new Users;

$users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

$Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');

$perm = $Group->GroupData[0]['permission'];

$perm = json_decode($perm, true);


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Adomx - Responsive Bootstrap 4 Admin Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/cryptocurrency-icons.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Custom Style CSS Only For Demo Purpose -->
    <link id="cus-style" rel="stylesheet" href="assets/css/style-primary.css">
    <script src="https://kit.fontawesome.com/d070063326.js" crossorigin="anonymous"></script>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>

<body class="skin-dark">

    <div class="main-wrapper">


        <?php require_once 'assets/php/header.php'; ?>

        <!-- Content Body Start -->
        <div class="content-body">
            <?php if ($perm['permissions'][0]['system/data/ImportExport']['access'] == "true" && $perm['permissions'][0]['system/data/ImportExport']['modify'] == "true") { ?>
                <!-- Add or Edit Product Start -->
                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h4 class="title">Upload Import File</h4>
                            <p>You can upload CSV or Text file to import data. For data structure, you can follow proprietary format (see export) </p>
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for="">Backup Tables:</label>
                                    <div class="d-flex">
                                        <input class="form-control" id="SessionExpiration" type="text" placeholder="Click to browse file" disabled>
                                        <label for="RestoreBtn" style="margin: 0px;">
                                            <button style="margin: 0px;" class="form-control button button-outline button-primary">Browse</button>
                                        </label>
                                        <input type="file" id="RestoreBtn" name="RestoreBtn" class="d-none">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="d-flex justify-content-center col mbn-10">
                                    <button id="SaveSystemData" class="button button-outline button-primary">Import</button>
                                    <button id="SaveSystemData" class="button button-outline button-primary ml-5">Reset</button>
                                </div>
                            </div>
                            <hr>
                            <h4 class="title">Tables</h4>
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30" style="padding:0px;">

                                    <div class="box">
                                        <div class="box-body">
                                            <ul class="list-group" style="overflow-y: scroll; height: 250px;">
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                                <li class="list-group-item disabled"><input type="checkbox">gsdagd</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <hr>
                                    <div class="d-flex justify-content-center col mbn-10">
                                        <button id="SaveSystemData" class="button button-outline button-primary">Export</button>
                                        <button id="SaveSystemData" class="button button-outline button-primary ml-5">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- Add or Edit Product End -->
            <?Php } else { ?>
                <div class="alert alert-outline-danger" role="alert">
                    <span class="alert-link">You do not have permission to access this page, please refer to your system administrator.</span>
                </div>
            <?Php } ?>
        </div>
        <!-- Content Body End -->

        <!-- Footer Section Start -->
        <div class="footer-section">
            <div class="container-fluid">

                <div class="footer-copyright text-center">
                    <p class="text-body-light">2019 &copy; <a href="https://themeforest.net/user/codecarnival">Codecarnival</a></p>
                </div>

            </div>
        </div>
        <!-- Footer Section End -->

    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->
    <script src="assets/js/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/nice-select/niceSelect.active.js"></script>
    <script src="assets/js/plugins/filepond/filepond.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond.active.js"></script>
</body>

</html>