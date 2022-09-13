<?php
require_once '../assets/php/category.php';
require_once '../assets/php/session.php';
require_once '../assets/php/languages.php';
require_once '../assets/php/logs.php';
require_once '../assets/php/product.php';

$logs = new Logs;
$lang = new lang;
$category = new Category();
$category->GetCategoryData();
$categoryData = $category->CategoryData;
$product = new product;


if (!isset($_SESSION['AuthTokenAdmin'])) {
    header('location: login.php');
}

require_once '../assets/php/Group.php';
require_once '../assets/php/users.php';

$users = new Users;
$Group = new Group;

$users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

$Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
$perm = $Group->GroupData[0]['permission'];

$perm = json_decode($perm, true);

if (isset($_GET['ProductName'])) {
    $productName = $_GET['ProductName'];
}

$product->GetProductDataCondition("WHERE `Product Name` = '$productName'");
$dataProduct = $product->data;

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

        .filepond--credits {
            display: none !important;
        }
    </style>

</head>

<body class="skin-dark">

    <div class="main-wrapper">


        <?php require_once '../assets/php/header.php'; ?>

        <div class="content-body">
            <div class="row justify-content-between align-items-center mb-10">
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3>Edit Product</h3>
                    </div>
                </div>
            </div>
            <?php if ($perm['permissions'][0]['catalog/Products']['access'] == "true" && $perm['permissions'][0]['catalog/Products']['modify'] == "true") { ?>

                <div class="add-edit-product-wrap col-12">

                    <div class="add-edit-product-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="Product-Form" method="POST" enctype="multipart/form-data">

                            <h4 class="title">General</h4>

                            <div class="row">
                                <div class="col-lg-12 col-12 mb-30 d-none">
                                    <input class="form-control" id="InitialProductName" type="hidden" value="<?Php echo $dataProduct[0]['Product Name']; ?>">
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <input class="form-control" id="ProductName" type="text" placeholder="Product Name" value="<?Php echo $dataProduct[0]['Product Name']; ?>">
                                    <div id="ErrorProductName" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorProductNameText"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 mb-30">
                                    <select class="form-control select2" id="category">
                                        <option value="<?php echo $dataProduct[0]['Category'];  ?>"><?php echo $dataProduct[0]['Category'];  ?></option>
                                        <?php foreach ($categoryData as $data) { ?>
                                            <option value="<?php echo $data['Category Name']; ?>"><?php echo $data['Category Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-30">
                                    <textarea class="form-control" id="ProductDescription"><?php echo $dataProduct[0]['Product Description'];  ?></textarea>
                                    <div id="ErrorProductDescription" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorProductDescriptionText"></span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="title">Data</h4>
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-30">
                                    <input class="form-control" id="ProductPrice" type="number" value="<?php echo $dataProduct[0]['Product Price'];  ?>">
                                    <div id="ErrorProductPrice" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorProductPriceText"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-30">
                                    <input class="form-control" id="Stock" type="number" value="<?php echo $dataProduct[0]['stock'];  ?>">
                                    <div id="ErrorProductStock" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorProductStockText"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-30" style="display: none;">
                                    <input class="form-control" id="ProductDiscount" type="hidden" id placeholder="Product Discount: Beta" disabled>
                                </div>
                                <div class="col-lg-6 col-12 mb-30">
                                    <select class="form-control select2" id="status">
                                        <option value="<?php echo $dataProduct[0]['status'];  ?>"><?php echo $dataProduct[0]['status'];  ?></option>
                                        <option value="publish">Publish</option>
                                        <option value="Invisible">Invisible</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-12 mb-30">
                                    <input class="form-control" id="Tags" type="text" value="<?php echo $dataProduct[0]['tags'];  ?>">
                                    <div id="ErrorTags" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorTagsText"></span>
                                    </div>
                                </div>
                            </div>

                            <h4 class="title">Product Gallery</h4>

                            <div class="product-upload-gallery row flex-wrap">
                                <div class="col-12 mb-30">
                                    <p class="form-help-text mt-0">Upload Maximum 800 x 800 px.</p>
                                    <input class="my-pond" id="ProductImage" type="file" multiple>
                                    <div id="ErrorProductImage" class="mt-5" style="display: none;">
                                        <i class="fa-solid fa-circle-exclamation text-danger h4 mr-1"></i>
                                        <span class="text-danger mb-5" id="ErrorProductImageText"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Group Start -->
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                    <button id="UpdateProduct" class="button button-outline button-primary">Add Product</button>
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
    <!-- Plugins & Activation JS For Only This Page -->
    <script src="../assets/js/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../assets/js/plugins/nice-select/niceSelect.active.js"></script>
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <!-- include FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <!-- include FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script>
        img = [
            <?php
            $sssss = explode(',', $dataProduct[0]['image_id']);
            foreach ($sssss as $image) {
                echo "'" . $image . "',";
            }
            ?>
        ];
    </script>
    <script src="../assets/js/product.js"></script>
</body>

</html>