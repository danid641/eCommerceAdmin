<?php
require_once '../assets/php/session.php';
require_once '../assets/php/languages.php';
require_once '../assets/php/logs.php';
require_once '../assets/php/Group.php';
require_once '../assets/php/users.php';
require_once '../assets/php/Coupons.php';


$logs = new Logs;
$lang = new lang;
$users = new Users;
$Group = new Group;
$cupon = new Coupons;


if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

$users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

$Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
$perm = $Group->GroupData[0]['permission'];

$perm = json_decode($perm, true);

if (isset($_GET['CuponName'])) {
    $CuponName = $_GET['CuponName'];
}

$cupon->GetDataCouponsCondition("WHERE `Coupon Name` = '$CuponName'");
$CuponData = $cupon->CouponData;

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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="../assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="..assets/css/vendor/cryptocurrency-icons.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../assets/css/plugins/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="../assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Custom Style CSS Only For Demo Purpose -->
    <link id="cus-style" rel="stylesheet" href="../assets/css/style-primary.css">
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


        <?php require_once '../assets/php/header.php'; ?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="row justify-content-between align-items-center mb-10">
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3>Edit Coupon</h3>
                    </div>
                </div>
            </div>
            <?php if ($perm['permissions'][0]['sale/Coupons']['access'] == "true" && $perm['permissions'][0]['sale/Coupons']['modify'] == "true") { ?>

                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Coupon Name:</label>
                                    <input class="form-control" id="CouponName" type="text" value="<?php echo $CuponData[0]['Coupon Name']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Code:</label>
                                    <input class="form-control" id="Code" type="text" value="<?php echo $CuponData[0]['Code']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Coupon Description:</label>
                                    <textarea class="form-control" id="CouponDescription" type="text"><?php echo $CuponData[0]['Coupon Description']; ?></textarea>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Type:</label>
                                    <select class="form-control select2" id="type">
                                        <option value="<?Php echo $CuponData[0]['Type']; ?>"><?Php echo $CuponData[0]['Type']; ?></option>
                                        <option value="Percentage">Percentage</option>
                                        <option value="Fixed Amount">Fixed Amount</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Discount:</label>
                                    <input class="form-control" id="Discount" type="number" value="<?Php echo $CuponData[0]['Discount']; ?>" placeholder="">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Free Shipping:</label>
                                    <select class="form-control select2" id="FreeShipping">
                                        <option value="<?Php echo $CuponData[0]['Free Shipping']; ?>"><?Php echo $CuponData[0]['Free Shipping']; ?></option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Date Start:</label>
                                    <input class="form-control" id="DateStart" type="date" value="<?Php echo $CuponData[0]['Date Start']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Date End:</label>
                                    <input class="form-control" id="DateEnd" type="date" value="<?Php echo $CuponData[0]['Date End']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Categories:</label>
                                    <select class="form-control select2" id="Categories">
                                        <option value="<?Php echo $CuponData[0]['Categories']; ?>"><?Php echo $CuponData[0]['Categories']; ?></option>
                                        <option value="1">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="UpdateCupon" class="button button-outline button-primary">Save</button>
                                    <a href="index.php" class="ml-5"><button class="button button-outline button-danger">Cancel</button></a>
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

        <?php require_once '../assets/php/footer.php'; ?>

    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="../assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="../assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <!--Plugins JS-->
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="../assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->
    <script src="../assets/js/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../assets/js/plugins/nice-select/niceSelect.active.js"></script>
    <script src="../assets/js/plugins/filepond/filepond.min.js"></script>
    <script src="../assets/js/plugins/filepond/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="../assets/js/plugins/filepond/filepond-plugin-image-preview.min.js"></script>
    <script src="../assets/js/plugins/filepond/filepond.active.js"></script>
    <script src="../assets/js/Coupons.js"></script>
</body>

</html>