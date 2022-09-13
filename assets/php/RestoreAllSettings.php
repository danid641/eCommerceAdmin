<?php
require_once 'RemoteConfig.php';

class RestoreSettings extends RemoteDataBase
{
    public function Restore()
    {
        $administratorPermission = '{"permissions":[{"dashboard":{"access":"true","modify":"true"},"user/user_permission":{"access":"true","modify":"true"},"catalog/Categories":{"access":"true","modify":"true"},"catalog/Products":{"access":"true","modify":"true"},"sale/Orders":{"access":"true","modify":"true"},"sale/Customers":{"access":"true","modify":"true"},"sale/Coupons":{"access":"true","modify":"true"},"sale/SendMail":{"access":"true","modify":"true"},"system/Settings/StoreDetails":{"access":"true","modify":"true"},"system/Settings/Mail":{"access":"true","modify":"true"},"system/Settings/System":{"access":"true","modify":"true"},"system/Localization/Currencies":{"access":"true","modify":"true"},"system/Localization/Countries":{"access":"true","modify":"true"},"system/data/BackupRestore":{"access":"true","modify":"true"},"system/data/Datasets":{"access":"true","modify":"true"},"system/data/ImportExport":{"access":"true","modify":"true"},"system/logs/InstallUpgradeHistory":{"access":"true","modify":"true"},"system/logs/ErrorLogs":{"access":"true","modify":"true"},"system/logs/ScheduledTasks":{"access":"true","modify":"true"},"system/users/Users":{"access":"true","modify":"true"},"system/users/UserGroups":{"access":"true","modify":"true"},"system/Messages":{"access":"true","modify":"true"}}]}';
        $DemonstrationPermission = '{"permissions":[{"dashboard":{"access":"false","modify":"false"},"user/user_permission":{"access":"false","modify":"false"},"catalog/Categories":{"access":"false","modify":"false"},"catalog/Products":{"access":"false","modify":"false"},"sale/Orders":{"access":"false","modify":"false"},"sale/Customers":{"access":"false","modify":"false"},"sale/Coupons":{"access":"false","modify":"false"},"sale/SendMail":{"access":"false","modify":"false"},"system/Settings/StoreDetails":{"access":"false","modify":"false"},"system/Settings/Mail":{"access":"false","modify":"false"},"system/Settings/System":{"access":"false","modify":"false"},"system/Localization/Currencies":{"access":"false","modify":"false"},"system/Localization/Countries":{"access":"false","modify":"false"},"system/data/BackupRestore":{"access":"false","modify":"false"},"system/data/Datasets":{"access":"false","modify":"false"},"system/data/ImportExport":{"access":"false","modify":"false"},"system/logs/InstallUpgradeHistory":{"access":"false","modify":"false"},"system/logs/ErrorLogs":{"access":"false","modify":"false"},"system/logs/ScheduledTasks":{"access":"false","modify":"false"},"system/users/Users":{"access":"false","modify":"false"},"system/users/UserGroups":{"access":"false","modify":"false"},"system/Messages":{"access":"false","modify":"false"}}]}';

        sleep(12);

        $RestoreConfigsmtp = "DELETE FROM configsmtp";
        $stmt = $this->RemoteConn->prepare($RestoreConfigsmtp);
        $stmt->execute();

        $RestoreConfig = "DELETE FROM config";
        $stmt = $this->RemoteConn->prepare($RestoreConfig);
        $stmt->execute();

        $RestoreGroup = "DELETE FROM `group`;
        INSERT INTO `group` (`User Group Name`,`permission`) VALUE ('administrator', '$administratorPermission'),('Demonstration','$DemonstrationPermission')";
        $stmt = $this->RemoteConn->prepare($RestoreGroup);
        $stmt->execute();

        $logs = fopen('../../errorlog.txt', 'w');
        fclose($logs);

        $logs = fopen('../js/configCancel.js', 'w');
        fclose($logs);
    }
}
