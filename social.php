 <?php
    require_once 'assets/php/category.php';
    require_once 'assets/php/session.php';
    require_once 'assets/php/languages.php';
    require_once 'assets/php/logs.php';
    require_once 'assets/php/social.php';
    require_once 'assets/php/Group.php';
    require_once 'assets/php/users.php';

    $social = new Social;
    $lang = new lang();
    $logs = new Logs;
    $users = new Users;
    $Group = new Group;

    if (!isset($_SESSION['AuthTokenAdmin'])) {
        header('location: login.php');
    }

    $social->GetDataSocial();

    $SocialData = $social->SocialData;

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
                                 <div class="col-lg-12 col-12 mb-30">
                                     <label for="">facebook:</label>
                                     <input class="form-control" id="facebook" type="url" placeholder="facebook.com/example" value="<?php if (!empty($SocialData[0]['facebook'])) {
                                                                                                                                        echo $SocialData[0]['facebook'];
                                                                                                                                    } ?>">


                                     <div id="Errorfacebook" class="mt-5" style="display: none;">
                                         <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                         <span class="text-danger mb-5" id="ErrorfacebookText"></span>
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-12 mb-30">
                                     <label for="">twitter:</label>
                                     <input class="form-control" id="twitter" type="url" placeholder="twitter.com/example" value="<?php if (!empty($SocialData[0]['twitter'])) {
                                                                                                                                        echo $SocialData[0]['twitter'];
                                                                                                                                    } ?>">


                                     <div id="Errortwitter" class="mt-5" style="display: none;">
                                         <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                         <span class="text-danger mb-5" id="ErrortwitterText"></span>
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-12 mb-30">
                                     <label for="">youtube:</label>
                                     <input class="form-control" id="youtube" type="url" placeholder="youtube.com/example" value="<?php if (!empty($SocialData[0]['youtube'])) {
                                                                                                                                        echo $SocialData[0]['youtube'];
                                                                                                                                    } ?>">


                                     <div id="Erroryoutube" class="mt-5" style="display: none;">
                                         <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                         <span class="text-danger mb-5" id="ErroryoutubeText"></span>
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-12 mb-30">
                                     <label for="">Instagram:</label>
                                     <input class="form-control" id="Instagram" type="url" placeholder="Instagram.com/example" value="<?php if (!empty($SocialData[0]['instagram'])) {
                                                                                                                                            echo $SocialData[0]['instagram'];
                                                                                                                                        } ?>">


                                     <div id="ErrorInstagram" class="mt-5" style="display: none;">
                                         <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                         <span class="text-danger mb-5" id="ErrorInstagramText"></span>
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-12 mb-30">
                                     <label for="">TikTok:</label>
                                     <input class="form-control" id="TikTok" type="url" placeholder="TikTok.com/example" value="<?php if (!empty($SocialData[0]['TikTok'])) {
                                                                                                                                    echo $SocialData[0]['TikTok'];
                                                                                                                                } ?>">

                                     <div id="ErrorTikTok" class="mt-5" style="display: none;">
                                         <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                         <span class="text-danger mb-5" id="ErrorTikTokText"></span>
                                     </div>
                                 </div>
                             </div>
                             <!-- Button Group Start -->
                             <div class="row">
                                 <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                     <button id="SaveSocialLink" class="button button-outline button-primary">Save</button>
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
     <script src="assets/js/social.js"></script>
 </body>

 </html>