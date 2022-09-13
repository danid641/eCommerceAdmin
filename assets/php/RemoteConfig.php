<?php

class RemoteDataBase
{
    // Remote Store DataBase
    public $RemoteDsn = 'mysql:host=localhost;dbname=monchercosmetics';
    public $RemoteUsername = 'root';
    public $RemotePass = '';

    public $RemoteConn;

    public function __construct()
    {
        try {
            $RemoteConn = new PDO($this->RemoteDsn, $this->RemoteUsername, $this->RemotePass);
        } catch (PDOException $e) {
            echo 'Remote DataBase Connection Not Found';
        }
        return $this->RemoteConn = $RemoteConn;
    }
}