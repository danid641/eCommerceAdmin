<?php
require_once 'config.php';

class Auth extends DataBase
{
    public function Login($email, $password)
    {
        $sql = "SELECT * FROM `admin` WHERE email='$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $data['password'])) {
            require_once 'session.php';
            $_SESSION['AuthTokenAdmin'] = $data['username'];
            echo 'success';
        } else {
            echo 'IncPass';
        }
    }

    public function Register($username, $email, $password, $Group = 'Demonstration')
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `admin` (`username`, `Group`, `email`,`password`) VALUE('$username', '$Group', '$email','$password')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        require_once 'session.php';
        $_SESSION['AuthTokenAdmin'] = $username;

        echo 'success';
    }

    public function CheckExistUser($email)
    {
        $sql = "SELECT * FROM `admin` WHERE email='$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function forgot_pass($email, $token)
    {
        $sql = "UPDATE `admin` SET token = '$token', token_expire = DATE_ADD(NOW(),
         INTERVAL 10 MINUTE) WHERE email = '$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = [
            'token' => $token,
            'email' => $email
        ];

        return $this->data = $data;
    }

    public function Set_New_Pass($email, $pass)
    {
        $sql = "UPDATE `admin` SET password = '$pass' WHERE email = '$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        echo 'success';

        $token = uniqid();
        $token = str_shuffle($token);

        $this->forgot_pass($email, $token);
    }
}
