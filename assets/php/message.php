<?php
require_once 'Config.php';

class Message extends DataBase
{

    public function GetMessageData()
    {
        $sql = "SELECT * FROM `message`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $MessageData = $stmt->fetchAll();

        return $this->MessageData = $MessageData;
    }
}
