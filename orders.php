<?php
require_once 'assets/php/order.php';
require_once 'assets/php/currency.php';
require_once 'assets/php/session.php';
require_once 'assets/php/languages.php';
?>
<?php $order = new Order(); ?>
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
            <?php if ($perm['permissions'][0]['sale/Orders']['access'] == "true") { ?>
                <div class="row">

                    <!--Order List Start-->
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-vertical-middle">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang->words['Orders']['Order ID']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Date']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Status']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Customer']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Address']; ?></th>
                                        <th><?php echo $lang->words['Orders']['country/region']; ?></th>
                                        <th><?php echo $lang->words['Orders']['city']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Postal Code']; ?></th>
                                        <th><?php echo $lang->words['Orders']['phone number']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Product Name']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Quantity']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Delivery cost']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Sub Total']; ?></th>
                                        <th><?php echo $lang->words['Orders']['Total']; ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $order->GetDataOrder(''); ?>
                                    <?php $_SESSION['curency'] = 'RON'; ?>

                                    <?php foreach ($order->OrderData as $data) { ?>
                                        <tr id="column" data-OrderColumnId="<?php echo $data['id']; ?>">
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['Placed on']; ?></td>
                                            <td><span class="badge badge-danger"><?php echo $data['status']; ?></span></td>
                                            <td><?php echo $data['From']; ?></td>
                                            <td><?php echo $data['Address']; ?></td>
                                            <td><?php echo $data['country/region']; ?></td>
                                            <td><?php echo $data['city']; ?></td>
                                            <td><?php echo $data['Postal Code']; ?></td>
                                            <td><?php echo $data['phone number']; ?></td>
                                            <td><?php echo $data['Product Name']; ?></td>
                                            <td><?Php echo $data['Quantity']; ?></td>
                                            <td><?php echo $data['Delivery cost']; ?></td>
                                            <td><?php echo $data['Sub Total']; ?></td>
                                            <td><?php echo $data['Total']; ?></td>
                                            <?php if (
                                                $perm['permissions'][0]['sale/Orders']['access'] == "true" &&
                                                $perm['permissions'][0]['sale/Orders']['modify'] == "true"
                                            ) { ?>
                                                <td class="action h4">
                                                    <div class="table-action-buttons">
                                                        <button id="DelteOrder" data-OrderId="<?php echo $data['id']; ?>" class="delete button button-box button-xs button-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            <?Php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--Order List End-->

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
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/order.js"></script>

</body>

</html>