<?php
require_once 'config.php';

class Users extends DataBase
{

    public function DeleteUser($id)
    {
        $sql = "DELETE FROM `admin` WHERE id = '$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function AddUser($username, $email, $password, $Group)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `admin` (`username`, `Group`, `email`,`password`) VALUE('$username', '$Group', '$email','$password')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        echo 'success';
    }

    public function EditUser($InitialUserName, $username, $email, $password)
    {
    }

    public function GetDataUsers($condition)
    {
        if (!empty($condition)) {
            $sql = "SELECT * FROM `admin` $condition";
        } else {
            $sql = "SELECT * FROM `admin`";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $UsersData = $stmt->fetchALL(PDO::FETCH_ASSOC);


        return $this->UsersData = $UsersData;
    }

    public function GetDataUsersCondition($condition)
    {

        $sql = "SELECT * FROM `admin` $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $UsersData = $stmt->fetchALL(PDO::FETCH_ASSOC);


        return $this->UsersData = $UsersData;
    }
}
