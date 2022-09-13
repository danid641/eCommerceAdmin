<?php
require_once 'RemoteConfig.php';
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

class Order extends RemoteDataBase
{
    public function GetDataOrder($condition)
    {
        if (empty($condition)) {
            $sql = 'SELECT * FROM delivery';
        } else {
            $sql = "SELECT * FROM delivery $condition";
        }
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $OrderData = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $this->OrderData = $OrderData;
    }

    public function DeleteOrder($Id)
    {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['sale/Orders']['access'] == "true" && $perm['permissions'][0]['sale/Orders']['modify'] == "true") {
            $sql = "DELETE FROM delivery where id = '$Id'";
            $stmt = $this->RemoteConn->prepare($sql);
            $stmt->execute();
        }
    }
}
