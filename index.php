<?php
require_once 'assets/php/session.php';
require_once 'assets/php/languages.php';
require_once 'assets/php/Group.php';
require_once 'assets/php/users.php';
require_once 'assets/php/logs.php';
require_once 'assets/php/order.php';
require_once 'assets/php/currency.php';
require_once 'assets/php/Customers.php';

$Group = new Group;
$lang = new lang;
$users = new Users;
$logs = new Logs;
$order = new Order;
$curr = new Convert;
$customer = new Customers;


if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

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
        .swal-wide {
            width: 50em !important;
            height: 36em;
        }

        .swal2-html-container {
            overflow-x: hidden !important;
        }

        .swal2-html-container .row {
            margin: 10px !important;
        }

        .swal2-container {
            z-index: 9999 !important;
        }

        @media (max-width: 991px) {

            .swal-wide {
                width: 55em !important;
            }

            .swal2-html-container .row {
                margin: 5px;
            }
        }
    </style>
</head>

<body class="skin-dark">

    <div class="main-wrapper">


        <?php require_once 'assets/php/header.php'; ?>
        <!-- Content Body Start -->
        <div class="content-body">
            <?php if ($perm['permissions'][0]['dashboard']['access'] == "true") { ?>
                <!-- Top Report Wrap Start -->
                <div class="row">
                    <style>
                        .image {
                            border-radius: 50%;
                            margin-left: 105px;
                            margin-bottom: 20px;
                            background-color: #fff;
                        }

                        .box-body {
                            padding: 50px !important;
                        }

                        @media (max-width: 480px) {
                            .image {
                                margin-left: 0px;
                            }
                        }
                    </style>
                    <?php if (
                        $perm['permissions'][0]['dashboard']['access'] == "true" &&
                        $perm['permissions'][0]['catalog/Categories']['access'] == "true" or
                        $perm['permissions'][0]['catalog/Products']['access'] == "true" or
                        $perm['permissions'][0]['sale/Customers']['access'] == "true" or
                        $perm['permissions'][0]['system/Messages']['access'] == "true" or
                        $perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true"
                    ) { ?>
                        <div class="col-lg-12 col-12 mb-30">
                            <div class="box">
                                <div class="box-body">

                                    <div class="widget-chat-wrap custom-scroll ps ">
                                        <ul class="widget-chat-list">
                                            <li>
                                                <div class="widget-chat">

                                                    <div class="body" style="flex-wrap:wrap;">
                                                        <?php if ($perm['permissions'][0]['catalog/Categories']['access'] == "true") { ?><div class="image"><a href="Categories.php"><img src="assets/images/categories/categories_icon.svg" alt=""></a></div><?php } ?>
                                                        <?php if($perm['permissions'][0]['catalog/Products']['access'] == "true"){ ?><div class="image"><a href="products.php"><img src="assets/images/categories/products_icon.svg" alt=""></a></div><?php } ?>
                                                        <?php if($perm['permissions'][0]['sale/Customers']['access'] == "true"){ ?><div class="image"><a href="Customers.php"><img src="assets/images/categories/customers_icon.svg" alt=""></a></div><?php } ?>
                                                        <?php if(1 == 2){ ?><div class="image"><a href="#"><img src="assets/images/categories/languages_icon.svg" alt=""></a></div><?php } ?>
                                                        <?php if($perm['permissions'][0]['system/Messages']['access'] == "true"){ ?><div class="image"><a href="message.php"><img src="assets/images/categories/icon_messages.svg" alt=""></a></div><?php } ?>
                                                        <?php if($perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true"){ ?><div class="image"><a href="StoreDetails.php"><img src="assets/images/categories/settings_icon.svg" alt=""></a></div><?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 3px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 429px; right: 3px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 360px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>


                </div>
                <!-- Top Report Wrap End -->

                <div class="row mbn-30">


                    <!-- Daily Sale Report Start -->
                    <div class="col-lg-6 col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <h4 class="title"><?Php echo $lang->words['DashBoard']['Latest 10 Orders']; ?></h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table daily-sale-report">

                                        <!-- Table Head Start -->
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?Php echo $lang->words['DashBoard']['Customer Name']; ?></th>
                                                <th><?Php echo $lang->words['DashBoard']['Total']; ?></th>
                                                <?php if ($perm['permissions'][0]['dashboard']['access'] == "true" && $perm['permissions'][0]['dashboard']['modify'] == "true") { ?>
                                                    <th><?Php echo $lang->words['DashBoard']['Action']; ?></th>
                                                <?Php } ?>
                                            </tr>
                                        </thead>
                                        <!-- Table Head End -->

                                        <!-- Table Body Start -->
                                        <tbody>
                                            <?php $order->GetDataOrder("ORDER BY id LIMIT 10"); ?>
                                            <?Php foreach ($order->OrderData as $OrderData) { ?>
                                                <tr data-OrderColumnId="<?php echo $OrderData['id']; ?>">
                                                    <td><?php echo $OrderData['id']; ?></td>
                                                    <td><?php echo $OrderData['From']; ?></td>
                                                    <td><?php echo $curr->GetConvertPrice($OrderData['Total']); ?></td>
                                                    <?php if ($perm['permissions'][0]['dashboard']['access'] == "true" && $perm['permissions'][0]['dashboard']['modify'] == "true") { ?>
                                                        <td>
                                                            <div class="table-action-buttons">
                                                                <a>
                                                                    <button class="delete button button-box button-xs button-danger" id="DelteOrder" data-OrderId="<?php echo $OrderData['id']; ?>" href="#">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    <?Php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <!-- Table Body End -->

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Daily Sale Report End -->



                    <!-- Daily Sale Report Start -->
                    <div class="col-lg-6 col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <h4 class="title"><?Php echo $lang->words['DashBoard']['Latest Registrations']; ?></h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table daily-sale-report">

                                        <!-- Table Head Start -->
                                        <thead>
                                            <tr>
                                                <th><?Php echo $lang->words['DashBoard']['Customer Name']; ?></th>
                                                <th><?Php echo $lang->words['DashBoard']['Email']; ?></th>
                                                <?php if ($perm['permissions'][0]['dashboard']['access'] == "true" && $perm['permissions'][0]['dashboard']['modify'] == "true") { ?>
                                                    <th><?Php echo $lang->words['DashBoard']['Action']; ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <!-- Table Head End -->

                                        <!-- Table Body Start -->
                                        <tbody>
                                            <?php $customer->GetDataCustomersCondition("ORDER BY id LIMIT 10"); ?>
                                            <?php foreach ($customer->CustomersData as $CustomersData) { ?>
                                                <tr data-CustomerColumnId="<?Php echo $CustomersData['id']; ?>">
                                                    <td><?Php echo $CustomersData['username']; ?></td>
                                                    <td><?php echo $CustomersData['email']; ?></td>
                                                    <?php if ($perm['permissions'][0]['dashboard']['access'] == "true" && $perm['permissions'][0]['dashboard']['modify'] == "true") { ?>

                                                        <td>
                                                            <div class="table-action-buttons">
                                                                <a class="edit button button-box button-xs button-info" href="update/Customers.php?CustomerName=<?Php echo $CustomersData['username']; ?>">
                                                                    <i class="fa-solid fa-pen"></i>
                                                                </a>
                                                                <a>
                                                                    <button class="delete button button-box button-xs button-danger" id="DeleteCustomer" data-CustomerId="<?Php echo $CustomersData['id']; ?>" href="#">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    <?Php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <!-- Table Body End -->

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Daily Sale Report End -->

                </div>
            <?php } else { ?>
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
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="assets/js/plugins/moment/moment.min.js"></script>

    <!--Daterange Picker-->
    <script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>

    <!--Echarts-->
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="assets/js/plugins/chartjs/chartjs.active.js"></script>

    <!--VMap-->
    <script src="assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/plugins/vmap/vmap.active.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/configCancel.js"></script>
    <script src="assets/js/config.js"></script>
    <script src="assets/js/order.js"></script>
    <script src="assets/js/Customers.js"></script>

</body>

</html>