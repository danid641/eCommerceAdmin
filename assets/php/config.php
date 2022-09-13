<?php

class DataBase
{
    // Admin Database
    public $dsn = 'mysql:host=localhost;dbname=monchercosmeticsAdmin';
    public $Dbuser = 'root';
    public $Dbpass = '';

    public $conn;

    public function __construct()
    {
        try {
            $conn = new PDO($this->dsn, $this->Dbuser, $this->Dbpass);
        } catch (PDOException $e) {
            echo 'DataBase Connection Not Found';
        }
        return $this->conn = $conn;
    }
}

new DataBase();
