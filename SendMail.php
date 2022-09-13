<?php require_once 'assets/php/category.php'; ?>
<?php require_once 'assets/php/session.php'; ?>
<?php require_once 'assets/php/languages.php'; ?>
<?php
$category = new Category();
$category->GetCategoryData();
$categoryData = $category->CategoryData;
?>
<?Php require_once 'assets/php/logs.php';
$logs = new Logs; ?>
<?php $lang = new lang(); ?>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- BS5.1.1 CSS/JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Latest BS-Select compiled and minified CSS/JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

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
            <?Php if ($perm['permissions'][0]['sale/SendMail']['access'] == "true" && $perm['permissions'][0]['sale/SendMail']['modify'] == "true") { ?>
                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <h4 class="title"><?php echo $lang->words['SendMail']['Send Mail']; ?></h4>

                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['SendMail']['To']; ?>:</label>
                                    <select class="form-control select2" id="to">
                                        <option value=""><?php echo $lang->words['SendMail']['To']; ?>:</option>
                                        <option value="ManualySelectedCustomers"><?php echo $lang->words['SendMail']['Manualy selected customers']; ?></option>
                                        <option value="AllCustomers"><?php echo $lang->words['SendMail']['All Customers']; ?></option>
                                        <option value="ToCustomersSelectedProducts"><?php echo $lang->words['SendMail']['To customers who ordered selected products']; ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-12 mb-30" id="TypingCustomerName">
                                    <label for=""></label>
                                    <select class="form-control bSelect selectpicker" id="SelectUser" title="<?php echo $lang->words['SendMail']['select customers']; ?>" multiple tabindex="-9 8">
                                        <?php $users->GetDataUsers(''); ?>
                                        <?php foreach ($users->UsersData as $data) { ?>
                                            <option value="<?php echo $data['username']; ?>"><?php echo $data['username']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-12 mb-30" id="TypingProductName">
                                    <label for=""></label>
                                    <input class="form-control" id="" type="text" id placeholder="<?php echo $lang->words['SendMail']['Start typing product name to look up and select']; ?>">
                                </div>

                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""></label>
                                    <input class="form-control" id="Subject" type="text">
                                </div>
                                <div class="col-12 mb-30">
                                    <label for=""></label>
                                    <textarea class="form-control" id="Body"></textarea>
                                </div>
                            </div>
                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="SendMail" class="button button-outline button-primary"><?php echo $lang->words['SendMail']['Send']; ?></button>
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
    <script src="assets/js/SendMail.js"></script>
</body>

</html>