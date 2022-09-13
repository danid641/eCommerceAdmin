<?php require_once 'assets/php/session.php'; ?>
<?php
require_once 'assets/php/Coupons.php';
require_once 'assets/php/currency.php';
require_once 'assets/php/languages.php';
?>
<?php $cupons = new Coupons(); ?>
<?php $curr = new Convert(); ?>
<?php $lang = new lang(); ?>
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

</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php require_once 'assets/php/header.php'; ?>

        <!-- Content Body Start -->
        <div class="content-body">
            <?php if ($perm['permissions'][0]['sale/Coupons']['access'] == "true") { ?>
                <div class="row">

                    <!--Manage Product List Start-->
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-vertical-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $lang->words['Coupons']['Status']; ?></th>
                                        <th><?php echo $lang->words['Coupons']['Coupon Name']; ?></th>
                                        <th><?php echo $lang->words['Coupons']['Discount']; ?></th>
                                        <th><?php echo $lang->words['Coupons']['Date Start']; ?></th>
                                        <th><?php echo $lang->words['Coupons']['Date End']; ?></th>
                                        <?php if ($perm['permissions'][0]['sale/Coupons']['access'] == "true" && $perm['permissions'][0]['sale/Coupons']['modify'] == "true") { ?>
                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                            <a href="insert/Coupons.php"><i class="fa-solid fa-plus text-success h2 cursor-pointer"></i></a>
                                        </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cupons->GetDataCoupons(); ?>
                                    <?php foreach ($cupons->CouponData as $data) { ?>
                                        <tr data-CouponColumnId="<?php echo $data['id']; ?>">
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?Php echo $data['Status']; ?></td>
                                            <td><?php echo $data['Coupon Name']; ?></td>
                                            <td><?php echo $data['Discount']; ?></td>
                                            <td><?php echo $data['Date Start']; ?></td>
                                            <td><?php echo $data['Date End']; ?></td>
                                            <?php if ($perm['permissions'][0]['sale/Coupons']['access'] == "true" && $perm['permissions'][0]['sale/Coupons']['modify'] == "true") { ?>
                                                <td>
                                                    <div class="table-action-buttons">
                                                        <a class="edit button button-box button-xs button-info" href="#"><i class="fa-solid fa-pen"></i></a>
                                                        <a class="delete button button-box button-xs button-danger" id="DeleteCoupon" data-CouponId="<?php echo $data['id']; ?>" href="#"><i class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--Manage Product List End-->

                </div>
            <?php } else { ?>
                <div class="alert alert-outline-danger" role="alert">
                    <span class="alert-link">You do not have permission to access this page, please refer to your system administrator.</span>
                </div>
            <?php } ?>
        </div>
        <!-- Content Body End -->

        <?php require_once 'assets/php/footer.php'; ?>
    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Coupons.js"></script>

</body>

</html>