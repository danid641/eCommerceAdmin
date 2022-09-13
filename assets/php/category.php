<?php
require_once 'RemoteConfig.php';
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

class Category extends RemoteDataBase
{
    public function GetCategoryData()
    {
        $sql = 'SELECT * FROM category';
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CategoryData = $data;
    }

    public function GetCategoryDataCondition($condition)
    {
        $sql = "SELECT * FROM category $condition";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CategoryData = $data;
    }

    public function DeleteCategory($CategoryId)
    {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['catalog/Categories']['access'] == "true" && $perm['permissions'][0]['catalog/Categories']['modify'] == "true") {
            $sql = "DELETE FROM category WHERE id = '$CategoryId'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }

    public function AddCategory($CategoryName, $Description, $MetaTagKeywords, $MetaTagDescription)
    {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);
        if ($perm['permissions'][0]['catalog/Categories']['access'] == "true" && $perm['permissions'][0]['catalog/Categories']['modify'] == "true") {
            $sql = "INSERT INTO category (`Category Name`,`Category Val`) VALUE ('$CategoryName', '$CategoryName')";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();

            echo 'success';
        }
    }

    public function EditCategory($initialCategoryName, $CategoryName, $Description,  $MetaTagKeywords, $MetaTagDescription)
    {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);
        if ($perm['permissions'][0]['catalog/Categories']['access'] == "true" && $perm['permissions'][0]['catalog/Categories']['modify'] == "true") {
            $sql = "UPDATE category SET `Category Name` = '$CategoryName', `Description` = '$Description', `Meta Tag Keywords`  = '$MetaTagKeywords', `Meta Tag Description` = '$MetaTagDescription' WHERE `Category Name` = '$initialCategoryName'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }
}
