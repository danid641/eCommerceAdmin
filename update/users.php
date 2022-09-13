<?php
require_once '../assets/php/session.php';
require_once '../assets/php/languages.php';
require_once '../assets/php/logs.php';
require_once '../assets/php/Group.php';
require_once '../assets/php/users.php';

$logs = new Logs;
$lang = new lang;
$users = new Users;
$Group = new Group;

if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}


$users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

$Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
$perm = $Group->GroupData[0]['permission'];

$perm = json_decode($perm, true);

if (isset($_GET['UserName'])) {
    $UserName = $_GET['UserName'];
}
$users->GetDataUsersCondition("WHERE `username` = '$UserName'");
$UsersData = $users->UsersData;

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
        input[type=text] {
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
                        <h3>Edit User</h3>
                    </div>
                </div>
            </div>
            <?php if ($perm['permissions'][0]['system/users/Users']['access'] == "true" && $perm['permissions'][0]['system/users/Users']['modify'] == "true") { ?>

                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Username:</label>
                                    <input class="form-control" id="Username" type="text" value="<?Php echo $UsersData[0]['username']; ?>">
                                    <div id="ErrorUsernameName" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorUsernameNameText"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">Password:</label>
                                    <input class="form-control" id="Password" type="Password" value="<?Php echo $UsersData[0]['password']; ?>">
                                    <input class="form-control" id="CPassword" type="Password" value="<?Php echo $UsersData[0]['password']; ?>">
                                    <div id="ErrorPassword" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorPasswordText"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">User Group:</label>
                                    <select class="form-control select2" id="UserGroup">
                                        <option value="<?Php echo $UsersData[0]['Group']; ?>"><?Php echo $UsersData[0]['Group']; ?></option>
                                        <?Php
                                        $Group->GetGroupData('');
                                        foreach ($Group->GroupData as $data) {
                                        ?>
                                            <option value="<?Php echo $data['User Group Name'] ?>"><?Php echo $data['User Group Name'] ?></option>
                                        <?Php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <label for="">E-Mail:</label>
                                    <input class="form-control" id="EMail" type="text" value="<?Php echo $UsersData[0]['email']; ?>">
                                    <div id="ErrorEMail" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorEMailText"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="UpdateUser" class="button button-outline button-primary">Save</button>
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
    <script src="../assets/js/users.js"></script>
</body>

</html>