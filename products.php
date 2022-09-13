<?php require_once 'assets/php/session.php'; ?>
<?php
require_once 'assets/php/product.php';
require_once 'assets/php/currency.php';
require_once 'assets/php/languages.php';
?>
<?php $product = new Product(); ?>
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
            <?php if ($perm['permissions'][0]['catalog/Products']['access'] == "true") { ?>
                <div class="row">

                    <!--Manage Product List Start-->
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-vertical-middle">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang->words['Products']['Product ID']; ?></th>
                                        <th><?php echo $lang->words['Products']['Product Name']; ?></th>
                                        <th><?php echo $lang->words['Products']['Price']; ?></th>
                                        <th><?php echo $lang->words['Products']['In Stock']; ?></th>
                                        <th><?php echo $lang->words['Products']['Date']; ?></th>
                                        <th><?php echo $lang->words['Products']['visibility']; ?></th>
                                        <?php if (
                                            $perm['permissions'][0]['catalog/Products']['access'] == "true" &&
                                            $perm['permissions'][0]['catalog/Products']['modify'] == "true"
                                        ) { ?>
                                            <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                <a href="insert/products.php"><i class="fa-solid fa-plus text-success h2 cursor-pointer"></i></a>
                                            </th>
                                        <?Php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $product->GetProductData(); ?>
                                    <?php foreach ($product->data as $data) { ?>
                                        <tr data-ProductColumnId="<?php echo $data['id']; ?>">
                                            <td><?php echo $data['id']; ?></td>
                                            <td><a href="https://monchercosmetics.com/products.php?product=<?php echo $data['Product Name']; ?>"><?php echo $data['Product Name']; ?></a></td>
                                            <td><?php echo $curr->GetConvertPrice(
                                                    $data['Product Price']
                                                ); ?></td>
                                            <td><?php echo $data['stock']; ?></td>
                                            <td><?php echo $data['created on']; ?></td>
                                            <td><span class="badge badge-danger"><?php echo $data['status']; ?></span></td>
                                            <?php if (
                                                $perm['permissions'][0]['catalog/Products']['access'] == "true" &&
                                                $perm['permissions'][0]['catalog/Products']['modify'] == "true"
                                            ) { ?>
                                                <td>
                                                    <div class="table-action-buttons">
                                                        <a class="edit button button-box button-xs button-info" href="update/products.php?ProductName=<?php echo $data['Product Name']; ?>">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>
                                                        <a>
                                                            <button class="delete button button-box button-xs button-danger" id="DeleteProduct" data-ProductId="<?php echo $data['id']; ?>" href="#">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            <?Php } ?>
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
    <script src="assets/js/product.js"></script>

</body>

</html>