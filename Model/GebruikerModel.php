<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class GebruikerModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function GetGebruikers(){
        $sql = "SELECT GebruikerID,Gebruikersnaam,Wachtwoord,Email FROM Gebruiker";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC) ;
    }

    //verhuist naar db
    //public static function makeSafe($password)
    //{
    //    $salt = "Gue\$This0192893847KGYTRT!";
    //    return hash("sha256", "{$salt}.{$password}");
    //}

    function Add(string $Gebruikersnaam, string $Wachtwoord, string $Email){
        $sql      =
            $this->conn->prepare("INSERT INTO Gebruiker (Gebruikersnaam,Wachtwoord,Email) Values(:Gebruikersnaam ,:Wachtwoord,:Email)");
        $sha256ww = $this->makeSafe($Wachtwoord);

        $parameters = ([
            'Gebruikersnaam' => $Gebruikersnaam,
            'Wachtwoord' => $sha256ww,
            'Email' => $Email
        ]);
        var_dump($parameters);
        return $sql->execute($parameters);
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM SelectieOpleiding WHERE OpleidingID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ID, string $Naamgebruiker, string $VoltijdDeeltijd){

        $sql =
            $this->conn->prepare("UPDATE SelectieOpleiding SET Naamgebruiker=:Naam , Voltijd_deeltijd=:VDD Where OpleidingID=:SID");//let op id geen quotes

        $parameters = [
            'Naam' => $Naamgebruiker,
            'VDD' => $VoltijdDeeltijd,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function get(int $ID){
        $sql = "SELECT OpleidingID,Naamgebruiker,Voltijd_deeltijd  FROM SelectieOpleiding WHERE OpleidingID =$ID";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function getByGebruikersNaam(string $GebruikersNaam){
        $sql = "SELECT GebruikersNaam FROM Gebruiker WHERE GebruikersNaam = '" . $GebruikersNaam . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectenByGebruiker(){
        return $this->conn->query("SELECT * from Project where GebruikerID= '$this->GebrID'");
    }

    function Validate(string $GebruikersNaam, string $Password){
        $sql =
            "SELECT GebruikerID,GebruikersNaam, Wachtwoord,Email FROM Gebruiker WHERE GebruikersNaam = '" . $GebruikersNaam . "' and Wachtwoord = '" .
            $Password . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}

