<?php
require_once 'RemoteConfig.php';
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

class Product extends RemoteDataBase
{
    public function AddProduct(
        $status,
        $stock,
        $ProductName,
        $category,
        $ProductDescription,
        $ProductPrice,
        $Tags,
        $ImageId
    ) {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['catalog/Products']['access'] == "true" && $perm['permissions'][0]['catalog/Products']['modify'] == "true") {
            $sql = "INSERT INTO `products` (`status`,`stock`,`Product Name`, `Product Price`, `Product Description`, `Category`, `tags`,`image_id`) VALUES 
            ('$status','$stock','$ProductName', '$ProductPrice', '$ProductDescription', '$category', '$Tags','$ImageId')";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();

            echo 'success';
        }
    }

    public function EditProduct(
        $status,
        $stock,
        $ProductName,
        $category,
        $ProductDescription,
        $ProductPrice,
        $Tags,
        $ImageId,
        $InitialProductName
    ) {
        $sql = "UPDATE `products` SET `status` = '$status',`stock` = '$stock',`Product Name` = '$ProductName', `Product Price` = '$ProductPrice', `Product Description` = '$ProductDescription', `Category` = '$category',  `tags` = '$Tags', `image_id` = '$ImageId' WHERE `Product Name` = '$InitialProductName'";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();

        echo 'success';
    }

    public function DeleteProduct($ProductId)
    {
        $Group = new Group;
        $users = new Users;

        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');

        $perm = $Group->GroupData[0]['permission'];

        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['catalog/Products']['access'] == "true" && $perm['permissions'][0]['catalog/Products']['modify'] == "true") {
            $sql = "DELETE FROM products WHERE id = '$ProductId'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }


    public function GetProductData()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->data = $data;
    }



    public function GetProductDataCondition($condition)
    {
        $sql = "SELECT * FROM products $condition";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->data = $data;
    }
}
