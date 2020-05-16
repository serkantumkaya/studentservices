<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Opleiding.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class OpleidingModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Opleiding $opleiding;

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function GetOpleidingen(){
        $sql = "SELECT OpleidingID,Naamopleiding,Voltijd_deeltijd FROM Opleiding";
        return $this->conn->query($sql);
    }

    function add(string $NaamOpleiding, string $VoltijdDeeltijd){
        $statement =
            $this->conn->prepare("INSERT INTO Opleiding (Naamopleiding,Voltijd_deeltijd) VALUES (:Naam,:VDD)");
        $statement->execute([
            'Naam' => $NaamOpleiding,
            'VDD' => $VoltijdDeeltijd
        ]);
        return true;
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM Opleiding WHERE OpleidingID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ID, string $Naamopleiding, string $VoltijdDeeltijd){

        $sql =
            $this->conn->prepare("UPDATE Opleiding SET Naamopleiding=:Naam , Voltijd_deeltijd=:VDD Where OpleidingID=:SID");//let op id geen quotes

        $parameters = [
            'Naam' => $Naamopleiding,
            'VDD' => $VoltijdDeeltijd,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function get(int $ID){
        $sql = "SELECT OpleidingID,Naamopleiding,Voltijd_deeltijd  FROM Opleiding WHERE OpleidingID =$ID";
        return $this->conn->query($sql);
    }
}

