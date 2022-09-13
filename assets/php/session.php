<?php
require_once 'config.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['logout'])) {
    session_destroy();
}

class Check extends DataBase
{
    public function CheckUserSession()
    {
        if (isset($_SESSION['AuthTokenAdmin'])) {
            $sql = "SELECT * FROM `admin` WHERE `username` = '{$_SESSION['AuthTokenAdmin']}'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $Check = [$_SESSION['AuthTokenAdmin']];

            if (empty($data)) {
                session_destroy();
            }
        }
    }
}

$Check = new Check;

$Check->CheckUserSession();
