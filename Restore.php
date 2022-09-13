<?php require_once 'assets/php/session.php'; ?>
<?php require_once 'assets/php/languages.php'; ?>
<?php $lang = new lang(); ?>
<?php

if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

?>
<?Php
require_once 'assets/php/Group.php';
require_once 'assets/php/users.php';

$Group = new Group;
$users = new users;

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
            <!-- Add or Edit Product Start -->
            <div class="add-edit-product-wrap col-12">

                <div class="add-edit-product-form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h4 class="title">Restore</h4>
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-30" style="padding:0px;">
                                <div class="box">
                                    <div class="box-body">
                                        <ul id="ListError" class="list-group" style="align-items:center; justify-content:center; height: 250px; background-color:#1c1f2d;">
                                            <p class="p-2 h6"><i class="fa-solid fa-circle-exclamation h4"></i> after performing this action, the data such as group and stmp and site configurations will be reset</p>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 mb-30" id="Bar" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 mb-30">

                                <div class="d-flex justify-content-center col mbn-10">
                                    <button id="Restore" class="button button-outline button-primary ml-5">Restore</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Add or Edit Product End -->

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
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#Restore').click(function(e) {
                e.preventDefault()


                Swal.fire({
                    title: 'are you sure you want to perform this action?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        width = 0;
                        interval = setInterval(scene, 100);
                    }
                })

            })
        })

        function scene() {
            if (width == 100) {
                clearInterval(interval);
            } else {
                width++;
                $('#Bar').show();
                ProgressBar = $('#progress-bar');
                ProgressBar.css('width', width + "%");
            }
        }
    </script>
</body>

</html>