<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

class ConnectDB {
    private PDO $conn;

    public function __construct() {
        $servername = "127.0.0.1";
        $username = "SSimp";
        $password = "SSimp1234!";
        $database = "studentservices";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function GetConnection() : PDO
    {
        return $this->conn;
    }
}
?>