<?php
require_once 'RemoteConfig.php';
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

class Customers extends RemoteDataBase
{
    public function GetDataCustomers()
    {
        $sql = "SELECT * FROM Customers";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CustomersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CustomersData = $CustomersData;
    }

    public function GetDataCustomersCondition($condition)
    {
        $sql = "SELECT * FROM Customers $condition";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CustomersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CustomersData = $CustomersData;
    }

    public function AddCustomer($Username, $FirstName, $LastName, $EMail, $Telephone, $Fax, $Password, $Newsletter)
    {
        $Password = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO customers (`username`, `First Name`, `Last Name`, `email`,`Phone`,`password`,`newsletter`) VALUE ('$Username', '$FirstName', '$LastName', '$EMail','$Telephone','$Password',$Newsletter)";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();

        if ($Newsletter == 1) {
            $sql2 = "INSERT INTO newsletter (`name`, `email`) VALUE ('$Username', '$EMail')";
            $stmt = $this->RemoteConn->prepare($sql2);
            $stmt->execute();

            echo 'success';
        }
    }

    public function DeleteCustomer($CustomerId)
    {
        $Group = new Group;
        $users = new Users;

        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');

        $perm = $Group->GroupData[0]['permission'];

        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['sale/Customers']['modify'] == "true" && $perm['permissions'][0]['sale/Customers']['access']) {
            $sql = "DELETE FROM Customers WHERE id = '$CustomerId'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }


    public function EditCustomer($InitialCustomerName, $Username, $FirstName, $LastName, $EMail, $Telephone, $Fax, $Password, $Newsletter)
    {
        $Group = new Group;
        $users = new Users;

        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');

        $perm = $Group->GroupData[0]['permission'];

        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['sale/Customers']['modify'] == "true" && $perm['permissions'][0]['sale/Customers']['access']) {
            $Password = password_hash($Password, PASSWORD_DEFAULT);

            $sql = "UPDATE Customers SET `First Name` = '$FirstName',  `Last Name` = '$LastName',`username` = '$Username',`email` = '$EMail',`Phone` = '$Telephone',`Fax` = '$Fax',`password` = '$Password',`newsletter` = '$Newsletter' WHERE `username` = '$InitialCustomerName'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }
}
