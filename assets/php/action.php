<?php
require_once 'Auth.php';
require_once 'product.php';
require_once 'order.php';
require_once 'Customers.php';
require_once 'category.php';
require_once 'logs.php';
require_once 'smtp.php';
require_once 'group.php';
require_once 'currency.php';
require_once 'Countries.php';
require_once 'Coupons.php';
require_once 'users.php';
require_once 'image.php';
require_once 'social.php';

$Auth = new Auth();
$Product = new Product();
$order = new Order();
$Customer = new Customers();
$Category = new Category;
$logs = new Logs;
$smtp = new SmtpCon;
$group = new Group;
$currency = new Convert;
$country = new Countries;
$cupon = new Coupons;
$users = new Users;
$image = new Image;
$social = new Social;

// Auth.php

if (isset($_POST['action']) && $_POST['action'] == 'SignUp') {
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $password = $_POST['Password'];
    $CPassword = $_POST['CPassword'];

    if ($Auth->CheckExistUser($Email) == false) {
        echo $Auth->Register($Username, $Email, $password);
    } else {
        echo 'UserExist';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'SignIn') {
    $Email = $_POST['Email'];
    $password = $_POST['Password'];
    if ($Auth->CheckExistUser($Email) == true) {
        $Auth->login($Email, $password);
    } else {
        echo 'UserNotExist';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'RecoverAccount') {
    $email = $_POST['Email'];


    if ($Auth->CheckExistUser($email) == true) {
        $token = uniqid();
        $token = str_shuffle($token);

        $Auth->forgot_pass($email, $token);

        $mail->setFrom($email, 'Mailer');
        $mail->addAddress($email, 'Joe User');

        $mail->isHTML(true);
        $mail->Subject = 'Reset password';
        $mail->Body    = '
            <p>Someone just requested to change your monchercosmetics account`s credentials. If this was you, click on the link below to reset them.</p>
            <a href="localhost/admin/ResetPassword.php?email=' . $Auth->data['email'] . '&token=' .  $Auth->data['token'] . '">Link to reset password</a>
            <p>This link will expire within 10 minutes.</p>
            <p>If you don`t want to reset your password, just ignore this message and nothing will be changed.</p>';

        $mail->send();
    } else {
        echo 'UserNotExist';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'ResetPassword') {
    if (isset($_POST['Email']) && isset($_POST['Token']) && !empty($_POST['Email']) && !empty($_POST['Token'])) {

        $email = $_POST['Email'];
        $token = $_POST['Token'];

        if ($Auth->CheckExistUser($email) == true) {
            $sql = "SELECT * FROM `admin` WHERE email = '$email' AND token = '$token' AND token_expire > NOW()";
            $stmt = $Auth->conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $password = $_POST['Password'];

                $NewPass = password_hash($password, PASSWORD_DEFAULT);
                $Auth->Set_New_Pass($email, $NewPass);
            } else {
                echo 'IncorectSession';
            }
        } else {
            echo 'EmailNotFound';
        }
    } else {
        echo 'IncorectSession';
    }
}

// Customer.php

if (isset($_POST['action']) && $_POST['action'] == 'AddCustomer') {
    $Username = $_POST['Username'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $EMail = $_POST['EMail'];
    $Telephone = $_POST['Telephone'];
    $Fax = $_POST['Fax'];
    $Password = $_POST['Password'];
    $Newsletter = $_POST['Newsletter'];
    $Customer->AddCustomer($Username, $FirstName, $LastName, $EMail, $Telephone, $Fax, $Password, $Newsletter);
}


if (isset($_POST['action']) && $_POST['action'] == 'DeleteCustomer') {
    $CustomerId = $_POST['CustomerId'];
    $Customer->DeleteCustomer($CustomerId);
}

// Category.php

if (isset($_POST['action']) && $_POST['action'] == 'AddCategory') {
    $CategoryName = $_POST['CategoryName'];
    $Description = $_POST['Description'];
    $MetaTagKeywords = $_POST['MetaTagKeywords'];
    $MetaTagDescription = $_POST['MetaTagDescription'];
    $Category->AddCategory($CategoryName, $Description, $MetaTagKeywords, $MetaTagDescription);
}

if (isset($_POST['action']) && $_POST['action'] == 'DeleteCategory') {
    $CategoryId = $_POST['CategoryId'];
    $Category->DeleteCategory($CategoryId);
}

// Products.php

if (isset($_POST['action']) && $_POST['action'] == 'AddProducts') {
    $ProductName = $_POST['ProductName'];
    $Category = $_POST['Category'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductPrice = $_POST['ProductPrice'];
    $Status = $_POST['Status'];
    $stock = $_POST['stock'];
    $Tags = $_POST['Tags'];
    $file = $_FILES['file'];

    for ($i = 0; $i < count($file['name']); $i++) {
        $FileName = $file['name'][$i];
        $full_path = $file['full_path'][$i];
        $type = $file['type'][$i];
        $tmp_name = $file['tmp_name'][$i];
        $error = $file['error'][$i];
        $size = $file['size'][$i];
        $imageId = uniqid();

        $image->AddImage($FileName, $full_path, $type, $tmp_name, $error, $size, $imageId);
        $Image_List[] = $imageId;
    }

    $ListImage = implode(',', $Image_List);

    $Product->AddProduct(
        $Status,
        $stock,
        $ProductName,
        $Category,
        $ProductDescription,
        $ProductPrice,
        $Tags,
        $ListImage
    );
}

if (isset($_POST['action']) && $_POST['action'] == 'DeleteProducts') {
    $ProductId = $_POST['ProductId'];
    $Product->DeleteProduct($ProductId);
}

// Order.php

if (isset($_POST['action']) && $_POST['action'] == 'DelteOrder') {
    $OrderId = $_POST['OrderId'];

    $order->DeleteOrder($OrderId);
}

// Logs.php

if (isset($_POST['action']) && $_POST['action'] == 'ClearLogs') {
    $logs->ClearLogs();
}

// smtp.php

if (isset($_POST['action']) && $_POST['action'] == 'SmtpConfig') {
    $Host = $_POST['Host'];
    $SMTPAuth = $_POST['Auth'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Port = $_POST['Port'];

    $smtp->AddConfigSmtp($Host, $SMTPAuth, $Username, $Password, $Port);
}

if (isset($_POST['action']) && $_POST['action'] == 'SendMail') {

    $subject = $_POST['subject'];
    $MessageBody = $_POST['MessageBody'];
    $to = $_POST['to'];
    $customers = $_POST['customers'];

    switch ($to) {
        case 'AllCustomers':

            $Customer->GetDataCustomers();
            foreach ($Customer->CustomersData as $mails) {
                $mail->setFrom($mails['email'], 'Mailer');
                $mail->addAddress($mails['email'], 'Joe User');

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $MessageBody;
                echo $mail->send();
            }
            break;
        case 'ManualySelectedCustomers':
            $Customer->GetDataCustomers("WHERE username in ('$customers')");

            foreach ($Customer->CustomersData as $mails) {
                $mail->addAddress($mails['email']);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $MessageBody;
                echo $mail->send();
            }
            break;

        case 'ToCustomersSelectedProducts':
            $mail->setFrom($mails['email'], 'Mailer');
            $mail->addAddress($mails['email'], 'Joe User');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $MessageBody;
            echo $mail->send();
            break;
        case 'newsletter':
            break;
    }
}
// Group.php

if (isset($_POST['action']) && $_POST['action'] == 'ChangeGroupPermissions') {
    $GroupName = $_POST['GroupName'];
    $Permissions = $_POST['Permissions'];
    $group->ChangeGroupPermissions($GroupName, $Permissions);
}

//

if (isset($_POST['action']) && $_POST['action'] == 'config') {
}

if (isset($_POST['action']) && $_POST['action'] == 'ConfigCancel') {
    $log = 'ConfigCancel = true;';
    $file = fopen('../js/configCancel.js', 'a');
    fwrite($file, $log);
    fclose($file);
}

// users.php
if (isset($_POST['action']) && $_POST['action'] == 'AddGroup') {
    $GroupName = $_POST['GroupName'];
    if ($group->CheckExistGroup($GroupName) == false) {
        $group->AddGroup($GroupName);
    } else {
        echo 'UserGroupNameExist';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'AddUsers') {
    $Username = $_POST['Username'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $password = $_POST['Password'];
    $UserGroup = $_POST['UserGroup'];
    $Email = $_POST['EMail'];

    if ($Auth->CheckExistUser($Email) == false) {
        $users->AddUser($Username, $Email, $password, $UserGroup);
    } else {
        echo 'EmailExist';
    }
}

//

if (isset($_POST['action']) && $_POST['action'] == 'AddCurencies') {
    $CurrencyTitle = $_POST['CurrencyTitle'];
    $Code = $_POST['Code'];
    $value = $_POST['value'];

    $currency->AddCurency($CurrencyTitle, $Code, $value);
}

// 

if (isset($_POST['action']) && $_POST['action'] == 'AddCountry') {
    $CountryName = $_POST['CountryName'];
    $ISOCode = $_POST['ISOCode'];
    $country->AddCountry($CountryName, $ISOCode);
}

//

if (isset($_POST['action']) && $_POST['action'] == 'AddCupon') {
    $CouponName = $_POST['CouponName'];
    $Code = $_POST['Code'];
    $CouponDescription = $_POST['CouponDescription'];
    $Type = $_POST['Type'];
    $Discount = $_POST['Discount'];
    $FreeShipping = $_POST['FreeShipping'];
    $DateStart = $_POST['DateStart'];
    $DateEnd = $_POST['DateEnd'];
    $Categories = $_POST['Categories'];

    $cupon->AddCoupon($CouponName, $Discount, $DateStart, $DateEnd);
}

if (isset($_POST['action']) && $_POST['action'] == 'DeleteCoupon') {
    $CouponId = $_POST['CouponId'];

    $cupon->DelteCoupon($CouponId);
}

// 

if (isset($_POST['action']) && $_POST['action'] == 'DeleteUser') {
    $UserId = $_POST['UserId'];

    $users->DeleteUser($UserId);
}

// 

if (isset($_POST['action']) && $_POST['action'] == 'DeleteGroup') {
    $GroupId = $_POST['GroupId'];

    $group->DeleteGroup($GroupId);
}

//

if (isset($_POST['action']) && $_POST['action'] == 'DeleteCountry') {
    $CountryId = $_POST['CountryId'];

    $country->DeleteCountry($CountryId);
}

//

if (isset($_POST['action']) && $_POST['action'] == 'DeleteCurrency') {
    $CurrencyId = $_POST['CurrencyId'];

    $currency->DeleteCurrency($CurrencyId);
}

// Update

if (isset($_POST['action']) && $_POST['action'] == 'UpdateCategory') {
    $InitialCategoryName = $_POST['InitialCategoryName'];
    $CategoryName = $_POST['CategoryName'];
    $Description  = $_POST['Description'];
    $MetaTagKeywords = $_POST['MetaTagKeywords'];
    $MetaTagDescription = $_POST['MetaTagDescription'];

    $Category->EditCategory($InitialCategoryName, $CategoryName, $Description, $MetaTagKeywords, $MetaTagDescription);
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateCountry') {
    $InitialCountryName = $_POST['InitialCountryName'];
    $CountryName = $_POST['CountryName'];
    $ISOCode = $_POST['ISOCode'];

    $country->EditCountry($CountryName, $ISOCode, $InitialCountryName);
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateCupon') {
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateCurrency') {
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateCustomer') {

    $InitialUsername = $_POST['InitialUsername'];
    $Username = $_POST['Username'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $EMail = $_POST['EMail'];
    $Telephone = $_POST['Telephone'];
    $Fax = $_POST['Fax'];
    $Password = $_POST['Password'];
    $Newsletter = $_POST['Newsletter'];

    $Customer->EditCustomer($InitialUsername, $Username, $FirstName, $LastName, $Email, $Telephone, $Fax, $password, $Newsletter);
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateProduct') {
    print_r($_POST);
    $InitialProductName = $_POST['InitialProductName'];
    $ProductName = $_POST['ProductName'];
    $Category = $_POST['Category'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductPrice = $_POST['ProductPrice'];
    $Status = $_POST['Status'];
    $stock = $_POST['stock'];
    $Tags = $_POST['Tags'];
    $file = $_FILES['file'];

    for ($i = 0; $i < count($file['name']); $i++) {
        $FileName = $file['name'][$i];
        $full_path = $file['full_path'][$i];
        $type = $file['type'][$i];
        $tmp_name = $file['tmp_name'][$i];
        $error = $file['error'][$i];
        $size = $file['size'][$i];
        $imageId = uniqid();

        $image->AddImage($FileName, $full_path, $type, $tmp_name, $error, $size, $imageId);
        $Image_List[] = $imageId;
    }

    $ListImage = implode(',', $Image_List);

    $Product->EditProduct(
        $Status,
        $stock,
        $ProductName,
        $Category,
        $ProductDescription,
        $ProductPrice,
        $Tags,
        $ListImage,
        $InitialProductName
    );
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateGroup') {
    $InitialGroupName = $_POST['InitialGroupName'];
    $GroupName = $_POST['GroupName'];

    if ($group->CheckExistGroup($GroupName) == false) {
        $group->EditGroup($InitialGroupName, $GroupName);
    } else {
        echo 'GroupNameExist';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'UpdateUser') {
}

// Social.php

if (isset($_POST['action']) && $_POST['action'] == 'ConfigSocial') {
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $TikTok = $_POST['TikTok'];
    // $phone = $_POST['phone'];

    $social->EditSocialMediaLink($facebook, $twitter, $youtube, $instagram, $TikTok);
}
