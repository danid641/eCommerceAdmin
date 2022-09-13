<?php require_once 'assets/php/category.php'; ?>
<?php require_once 'assets/php/session.php'; ?>
<?php require_once 'assets/php/languages.php'; ?>
<?Php require_once 'assets/php/logs.php';
$logs = new Logs; ?>
<?php require_once 'assets/php/storeConfig.php'; ?>
<?php
$category = new Category();
$category->GetCategoryData();
$categoryData = $category->CategoryData;
?>
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
            <?php if ($perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true" && $perm['permissions'][0]['system/Settings/StoreDetails']['modify'] == "true") { ?>
                <!-- Add or Edit Product Start -->
                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <h4 class="title">Edit Settings</h4>

                            <div class="row">
                                <?Php

                                $StoreConfig->GetDataConfig();
                                $DataConfig = $StoreConfig->DataConfig;

                                ?>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Store Name']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Store Name']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Store URL']; ?>:</label>
                                    <input class="form-control" id="" type="text">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Secure Store URL']; ?>: </label>
                                    <input class="form-control" id="" type="text">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Title']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Title']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Meta Tag Description']; ?>: </label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Meta Tag Description']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Meta Keywords']; ?>: </label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Meta Keywords']; ?>">
                                </div>
                                <div class="col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Welcome Message']; ?>:</label>
                                    <textarea class="form-control" id="" value="<?Php echo $DataConfig[0]['Welcome Message']; ?>"></textarea>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Store Owner']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Store Owner']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Address']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Address']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['E-Mail']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['E-Mail']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Telephone']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Telephone']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for=""><?php echo $lang->words['Store Details']['Country']; ?>:</label>
                                    <input class="form-control" id="" type="text" value="<?Php echo $DataConfig[0]['Country']; ?>">
                                </div>
                            </div>
                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="SaveConfigData" class="button button-outline button-primary">Save</button>
                                    <a class="ml-5"><button class="button button-outline button-danger">Cancel</button></a>
                                </div>
                            </div>
                            <!-- Button Group End -->

                        </form>
                    </div>

                </div>
                <!-- Add or Edit Product End -->
            <?Php } else { ?>
                <div class="alert alert-outline-danger" role="alert">
                    <span class="alert-link">You do not have permission to access this page, please refer to your system administrator.</span>
                </div>
            <?php } ?>
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