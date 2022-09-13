<?php require_once 'assets/php/category.php'; ?>
<?php require_once 'assets/php/session.php'; ?>
<?php require_once 'assets/php/languages.php'; ?>
<?Php require_once 'assets/php/logs.php';
$logs = new Logs; ?>
<?php

if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}
require_once 'assets/php/Group.php';
require_once 'assets/php/users.php';

$users = new Users;
$Group = new Group;

$users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

$Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
$perm = $Group->GroupData[0]['permission'];

$perm = json_decode($perm, true);

?>
<?php
$category = new Category();
$category->GetCategoryData();
$categoryData = $category->CategoryData;
?>
<?php $lang = new lang(); ?>
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
            <?php if ($perm['permissions'][0]['system/Settings/Mail']['access'] == "true" && $perm['permissions'][0]['system/Settings/Mail']['modify'] == "true") { ?>
                <!-- Add or Edit Product Start -->
                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h4 class="title"><?php echo $lang->words['Mail']['Edit Settings']; ?></h4>
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['Mail Protocol']; ?>:</label>
                                    <select class="form-control select2" id="MailProtocol">
                                        <option value="mail"><?php echo $lang->words['Mail']['Mail']; ?></option>
                                        <option value="smtp"><?php echo $lang->words['Mail']['SMTP']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="mail">
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['Mail Parameters']; ?>:</label>
                                    <input class="form-control" id="Subject" type="text">
                                </div>
                            </div>
                            <div class="row" id="smtp">
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['SMTP Host']; ?>:</label>
                                    <input class="form-control" id="SmtpHost" type="text">
                                </div>
                                <div class="col-lg-6  col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['SMTP Username']; ?>:</label>
                                    <input class="form-control" id="SmtpUsername" type="text">
                                </div>
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['SMTP Password']; ?>:</label>
                                    <input class="form-control" id="SmtpPassword" type="text">
                                </div>
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['SMTP Port']; ?>:</label>
                                    <input class="form-control" id="SmtpPort" type="text">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['SMTP Timeout']; ?>:</label>
                                    <input class="form-control" id="SmtpTimeout" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['Alert Mail']; ?>:</label>
                                    <textarea class="form-control" id="AlertMail"></textarea>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Mail']['Additional Alert E-Mails']; ?>:</label>
                                    <input class="form-control" id="AdditionalAlert" type="text">
                                </div>
                            </div>
                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="SaveSmtpConfigData" class="button button-outline button-primary">Save</button>
                                    <a class="ml-5"><button class="button button-outline button-danger">Cancel</button></a>
                                </div>
                            </div>
                            <!-- Button Group End -->

                        </form>
                    </div>

                </div>
                <!-- Add or Edit Product End -->
            <?php } else { ?>
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
    <script src="assets/js/Mail.js"></script>
</body>

</html>