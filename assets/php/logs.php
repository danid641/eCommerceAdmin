<?php
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

class Logs
{
    public $Error_log = 'errorlog.txt';

    public function ClearLogs()
    {
        $Group = new Group;
        $users = new Users;
        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');
        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');
        $perm = $Group->GroupData[0]['permission'];
        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['system/logs/ErrorLogs']['access'] == "true" && $perm['permissions'][0]['system/logs/ErrorLogs']['modify'] == "true") {
            $logs = fopen('../../errorlog.txt', 'w');
            fclose($logs);
        }
    }

    public function GetLogsData()
    {
        if (file_exists($this->Error_log)) {
            if (filesize($this->Error_log) != 0) {
                $file = fopen($this->Error_log, 'r');
                $filesize = filesize($this->Error_log);
                echo  $filetext = fread($file, $filesize);
            } else {
                echo '<style>#ListError{display:flex; justify-content:center;}</style><li style="display:flex; justify-content:center; background-color: transparent;"><i style="font-size: 40px;" class="fa fa-thumbs-o-up fa-lg"></i></li>';
            }
        } else {
            fopen($this->Error_log, "w");
            echo '<style>#ListError{display:flex; justify-content:center;}</style><li style="display:flex; justify-content:center; background-color: transparent;"><i style="font-size: 40px;" class="fa fa-thumbs-o-up fa-lg"></i></li>';
        }
    }

    public function AddLogs($errno, $errstr, $errfile, $errline)
    {
        if (file_exists($this->Error_log)) {
            $log = '<li  class="list-group-item disabled">' . "<b>$errno</b> $errstr in $errfile on line $errline" . "</li>";
            $file = fopen($this->Error_log, 'a');
            fwrite($file, $log);
            fclose($file);
        } else {
            fopen($this->Error_log, "w");
            echo '<style>#ListError{display:flex; justify-content:center;}</style><li style="display:flex; justify-content:center; background-color: transparent;"><i style="font-size: 40px;" class="fa fa-thumbs-o-up fa-lg"></i></li>';
        }
    }

    public function __construct()
    {
        set_error_handler(array($this, 'AddLogs'), E_ALL);
    }
}
