<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Opleiding.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/includes/DB.php");

class OpleidingModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Opleiding $opleiding;

    public function __construct()
    {
        $this->ConnectDb = new ConnectDb();
        $this->conn = $this->ConnectDb->GetConnection();
    }

    public function GetOpleidingen()
    {
        $sql = "SELECT OpleidingID,Naamopleiding,Voltijd_deeltijd FROM SelectieOpleiding";
        return $this->conn->query($sql);

        $stmt->setFetchMode(PDO::FETCH_CLASS,'Opleiding');
        $result = $stmt->fetch();

    }
    function add(string $opleidingNaam,string $voltijddeeltijd)
    {
        $statement = $this->conn->prepare("INSERT INTO SelectieOpleiding (Naamopleiding,Voltijd_deeltijd) VALUES (:Naam,:VDD)");
        $statement->execute([
            'Naam' => $opleidingNaam,
            'VDD' => $voltijddeeltijd
        ]);
        return true;
        //i van integer. s voor string enz enz //bindparam kreeg ik niet aan de praat. Maar is wel beter
       /// $sql->bind_param("s", $opleidingNaam);//https://www.w3opleidings.com/php/php_mysql_prepared_statements.asp
        //{
        //    $last_id = $this->conn->insert_id;
        //    return get($last_id);//nieuwe object terugsturen met nieuwe ID
        //} else {
        //    echo "Error: " . $sql . "<br>" . $this->conn->error;
       // }
    }

    function delete(int $ID) {
        //delete opleiding
        $sql = $this->conn->prepare("DELETE FROM SelectieOpleiding WHERE OpleidingID  =:SID");

        $parameters = [
            'SID' => $ID
        ];

        if ($sql->execute($parameters) == TRUE)
        {
            return "Record verwijderd";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    function update(Opleiding $opleiding)
    {

        $sql = $this->conn->prepare("UPDATE SelectieOpleiding SET Naamopleiding=:SN AND Voltijd_deeltijd = :VDD Where OpleidingID =:SID");//let op id geen quotes
        $opleidingnaam = $opleiding->getOpleidingnaam();
        $id = $opleiding->getOpleidingID();
        $Voltijddeeltijd=$opleiding->getVoltijdDeeltijd();
        $parameters = [
            'SID' => $id,
            'SN' => $opleidingnaam,
            'VDD' => $Voltijddeeltijd
        ];

        if ($sql->execute($parameters) == TRUE)
        {
            return "Record gewijzigd";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function get(int $ID)
    {
        $sql = "SELECT OpleidingID,Naamopleiding,Voltijd_deeltijd  FROM SelectieOpleiding WHERE OpleidingID =$ID";
        return $this->conn->query($sql);
    }
}

