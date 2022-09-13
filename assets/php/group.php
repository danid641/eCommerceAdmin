<?php
require_once 'config.php';

class Group extends DataBase
{

    public function GetGroupData($condition)
    {
        if (!empty($condition)) {
            $sql = "SELECT * FROM `group` $condition";
        } else {
            $sql = "SELECT * FROM `group`";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $this->GroupData = $data;
    }

    public function GetGroupDataCondition($condition)
    {
        $sql = "SELECT * FROM `group` $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $this->GroupData = $data;
    }

    public function ChangeGroupPermissions($GroupName, $permissions)
    {
        $sql = "UPDATE `group` SET permission = '$permissions' WHERE `User Group Name` = '$GroupName'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function CheckGroupPermissions()
    {
    }

    public function AddGroup($GroupName, $permission = '{"permissions":[{"dashboard":{"access":"false","modify":"false"},"user/user_permission":{"access":"false","modify":"false"},"catalog/Categories":{"access":"false","modify":"false"},"catalog/Products":{"access":"false","modify":"false"},"sale/Orders":{"access":"false","modify":"false"},"sale/Customers":{"access":"false","modify":"false"},"sale/Coupons":{"access":"false","modify":"false"},"sale/SendMail":{"access":"false","modify":"false"},"system/Settings/StoreDetails":{"access":"false","modify":"false"},"system/Settings/Mail":{"access":"false","modify":"false"},"system/Settings/System":{"access":"false","modify":"false"},"system/Localization/Currencies":{"access":"false","modify":"false"},"system/Localization/Countries":{"access":"false","modify":"false"},"system/data/BackupRestore":{"access":"false","modify":"false"},"system/data/Datasets":{"access":"false","modify":"false"},"system/data/ImportExport":{"access":"false","modify":"false"},"system/logs/InstallUpgradeHistory":{"access":"false","modify":"false"},"system/logs/ErrorLogs":{"access":"false","modify":"false"},"system/logs/ScheduledTasks":{"access":"false","modify":"false"},"system/users/Users":{"access":"false","modify":"false"},"system/users/UserGroups":{"access":"false","modify":"false"},"system/Messages":{"access":"false","modify":"false"}}]}')
    {
        $sql = "INSERT INTO `group` (`User Group Name`, `permission`) VALUE ('$GroupName', '$permission')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        echo 'success';
    }

    public function EditGroup($InitialGroupName, $GroupName)
    {
        $sql = "UPDATE `group` SET `User Group Name` = '$GroupName'  WHERE `User Group Name` = '$InitialGroupName'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        echo 'success';
    }

    public function DeleteGroup($id)
    {
        $sql = "DELETE FROM `group` WHERE id = '$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function CheckExistGroup($GroupName)
    {
        $sql = "SELECT * FROM `group` WHERE `User Group Name`='$GroupName'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
}
