<?php
require_once 'assets/php/session.php';

if (isset($_SESSION['AuthTokenAdmin'])) {
    header('location: index.php');
}
?>
<?Php require_once 'assets/php/logs.php';
$logs = new Logs; ?>
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
    <link rel="stylesheet" href="assets/css/vendor/material-design-iconic-font.min.css">
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

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Sign up</h1>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>

                            <div class="login-register-form">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-12 mb-20">
                                            <input class="form-control" id="Username" type="text" placeholder="Username">
                                          
                                            <div id="ErrorUsername" class="mt-5" style="display:none;">
                                                <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                                <span class="text-danger mb-5" id="ErrorUsernameText"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input class="form-control" id="Email" type="text" placeholder="Email">
                                         
                                            <div id="ErrorEmail" class="mt-5" style="display:none;">
                                                <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                                <span class="text-danger mb-5" id="ErrorEmailText"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input class="form-control" id="Password" type="password" placeholder="Password">
                                         
                                            <div id="ErrorPassword" class="mt-5" style="display:none;">
                                                <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                                <span class="text-danger mb-5" id="ErrorPasswordText"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input class="form-control" id="CPassword" type="password" placeholder="Retype Password">
                                       
                                            <div id="ErrorCPassword" class="mt-5" style="display:none;">
                                                <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                                <span class="text-danger mb-5" id="ErrorCPasswordText"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row justify-content-between">
                                                <div class="col-auto mb-15">Already have account? <a href="login.php">Login Now.
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-10"><button id="SignUp" class="button button-primary button-outline">sign up</button></div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
                        <div class="content">
                            <h1>Sign up</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- Content Body End -->

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/Auth.js"></script>
</body>

</html>