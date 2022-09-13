<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'group.php';
require_once 'users.php';
require_once 'session.php';

$mail = new PHPMailer(true);

class SmtpCon extends DataBase
{

    public function ConfigSmtp()
    {
        $sql = "SELECT * FROM configsmtp";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->data = $data;
    }

    public function AddConfigSmtp($Host, $SMTPAuth, $Username, $Password, $Port)
    {
        $Group = new Group;
        $users = new Users;

        $users->GetDataUsers('WHERE username ="' . $_SESSION['AuthTokenAdmin'] . '"');

        $Group->GetGroupData('WHERE `User Group Name` ="' . $users->UsersData[0]['Group'] . '"');

        $perm = $Group->GroupData[0]['permission'];

        $perm = json_decode($perm, true);

        if ($perm['permissions'][0]['system/Settings/Mail']['access'] == "true" && $perm['permissions'][0]['system/Settings/Mail']['modify'] == "true") {
            $sql = "UPDATE configsmtp SET Host = '$Host', SMTPAuth = '$SMTPAuth', Username = '$Username', Password = '$Password', Port = '$Port'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }
}

$smtp = new SmtpCon;

$smtp->ConfigSmtp();
// Server Settings
$mail->isSMTP();
$mail->Host       = $smtp->data['Host'];
$mail->SMTPAuth   = $smtp->data['SMTPAuth'];
$mail->Username   = $smtp->data['Username'];
$mail->Password   = $smtp->data['Password'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = $smtp->data['Port'];
