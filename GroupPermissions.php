<?php
require_once 'assets/php/session.php';
require_once 'assets/php/languages.php';
require_once 'assets/php/Group.php';
require_once 'assets/php/users.php';
require_once 'assets/php/logs.php';

$page_permsion_name = 'user/user_permission';

?>
<?php $Group = new Group; ?>
<?php $lang = new lang; ?>
<?php $users = new Users; ?>
<?php $logs = new Logs; ?>
<?php

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

</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php require_once 'assets/php/header.php'; ?>
        <!-- Content Body Start -->
        <div class="content-body">
            <?php if ($perm['permissions'][0]['user/user_permission']['access'] == "true" && $perm['permissions'][0]['user/user_permission']['modify'] == "true") { ?>
                <div class="row">

                    <!--Order List Start-->
                    <?php $Group->GetGroupData('WHERE ' . '`User Group Name` = '  . '"' . $_GET['GroupName'] . '"'); ?>
                    <div class="col-lg-12 col-12 mb-30" style="padding:0px;">
                        <div class="box">
                            <div class="box-body">
                                <ul class="list-group" style="overflow-y: scroll; height: 250px;">
                                    <?php foreach ($Group->GroupData as $data) {
                                        foreach ($data as $permission) {
                                            $permission = json_decode($data['permission'], true);
                                        }
                                    };
                                    ?>
                                    <li class="d-none">
                                        <input type="hidden" id="GroupName" value="<?php echo $_GET['GroupName']; ?>">
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">dashboard
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="DashBoardAccess" <?php if ($permission['permissions'][0]['dashboard']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="DashBoardModify" <?php if ($permission['permissions'][0]['dashboard']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">catalog/Categories
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="CategoriesAccess" <?php if ($permission['permissions'][0]['catalog/Categories']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="CategoriesModify" <?php if ($permission['permissions'][0]['catalog/Categories']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">catalog/Products
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="ProductsAccess" <?php if ($permission['permissions'][0]['catalog/Products']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="ProductsModify" <?php if ($permission['permissions'][0]['catalog/Products']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">sale/Orders
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="OrdersAccess" <?php if ($permission['permissions'][0]['sale/Orders']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="OrdersModify" <?php if ($permission['permissions'][0]['sale/Orders']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">sale/Customers
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="CustomersAccess" <?php if ($permission['permissions'][0]['sale/Customers']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="CustomersModify" <?php if ($permission['permissions'][0]['sale/Customers']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">sale/Coupons
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="CouponsAccess" <?php if ($permission['permissions'][0]['sale/Coupons']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="CouponsModify" <?php if ($permission['permissions'][0]['sale/Coupons']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">sale/SendMail
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="SendMailAccess" <?php if ($permission['permissions'][0]['sale/SendMail']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="SendMailModify" <?php if ($permission['permissions'][0]['sale/SendMail']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Settings/StoreDetails
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="StoreDetailsAccess" <?php if ($permission['permissions'][0]['system/Settings/StoreDetails']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="StoreDetailsModify" <?php if ($permission['permissions'][0]['system/Settings/StoreDetails']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Settings/Mail
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="MailAccess" <?php if ($permission['permissions'][0]['system/Settings/Mail']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="MailModify" <?php if ($permission['permissions'][0]['system/Settings/Mail']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Settings/System
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="SystemAccess" <?php if ($permission['permissions'][0]['system/Settings/System']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="SystemModify" <?php if ($permission['permissions'][0]['system/Settings/System']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Localization/Currencies
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="CurrenciesAccess" <?php if ($permission['permissions'][0]['system/Localization/Currencies']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="CurrenciesModify" <?php if ($permission['permissions'][0]['system/Localization/Currencies']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Localization/Countries
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="CountriesAccess" <?php if ($permission['permissions'][0]['system/Localization/Countries']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="CountriesModify" <?php if ($permission['permissions'][0]['system/Localization/Countries']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/data/BackupRestore
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="BackupRestoreAccess" <?php if ($permission['permissions'][0]['system/data/BackupRestore']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="BackupRestoreModify" <?php if ($permission['permissions'][0]['system/data/BackupRestore']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/data/Datasets
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="DatasetsAccess" <?php if ($permission['permissions'][0]['system/data/Datasets']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="DatasetsModify" <?php if ($permission['permissions'][0]['system/data/Datasets']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/data/ImportExport
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="ImportExportAccess" <?php if ($permission['permissions'][0]['system/data/ImportExport']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="ImportExportModify" <?php if ($permission['permissions'][0]['system/data/ImportExport']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/logs/InstallUpgradeHistory
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="InstallUpgradeHistoryAccess" <?php if ($permission['permissions'][0]['system/logs/InstallUpgradeHistory']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="InstallUpgradeHistoryModify" <?php if ($permission['permissions'][0]['system/logs/InstallUpgradeHistory']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/logs/ErrorLogs
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="ErrorLogsAccess" <?php if ($permission['permissions'][0]['system/logs/ErrorLogs']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="ErrorLogsModify" <?php if ($permission['permissions'][0]['system/logs/ErrorLogs']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/logs/ScheduledTasks
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="ScheduledTasksAccess" <?php if ($permission['permissions'][0]['system/logs/ScheduledTasks']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="ScheduledTasksModify" <?php if ($permission['permissions'][0]['system/logs/ScheduledTasks']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/users/Users
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="UsersAccess" <?php if ($permission['permissions'][0]['system/users/Users']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="UsersModify" <?php if ($permission['permissions'][0]['system/users/Users']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/users/UserGroups
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="UserGroupsAccess" <?php if ($permission['permissions'][0]['system/users/UserGroups']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="UserGroupsModify" <?php if ($permission['permissions'][0]['system/users/UserGroups']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/user/user_permission
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="user_permissionAccess" <?php if ($permission['permissions'][0]['user/user_permission']['access'] == "true") { ?> <?php if ($permission['permissions'][0]['user/user_permission']['access'] == "true") { ?> checked="" <?php } ?> <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="user_permissionModify" <?php if ($permission['permissions'][0]['user/user_permission']['modify'] == "true") { ?> <?php if ($permission['permissions'][0]['user/user_permission']['access'] == "true") { ?> checked="" <?php } ?> <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <input type="checkbox">system/Messages
                                            </div>
                                            <div class="d-flex">
                                                <label class="adomx-switch primary">
                                                    <input type="checkbox" id="MessagesAccess" <?php if ($permission['permissions'][0]['system/Messages']['access'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Access</span>
                                                </label>
                                                <label class="adomx-switch primary ml-10">
                                                    <input type="checkbox" id="MessagesModify" <?php if ($permission['permissions'][0]['system/Messages']['modify'] == "true") { ?> checked="" <?php } ?>>
                                                    <i class="lever"></i>
                                                    <span class="text">Modify</span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--Order List End-->
                </div>
                <div class="row">
                    <div class="col-lg-12 col-12 mb-30">
                        <div class="d-flex justify-content-center col mbn-10">
                            <button id="SavePermissions" class="button button-outline button-primary ml-5">Save</button>
                        </div>
                    </div>
                </div>
            <?Php } else { ?>
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
    <script src="assets/js/test.js"></script>
</body>

</html>