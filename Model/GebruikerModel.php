<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class GebruikerModel
{
    // deze lijkt mij niet nodig?? de PDO, want die zit al in ConnectDB. nog even navragen
    //private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct($ID = null){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
        $this->ID        = $ID;
    }

    public function getGebruikers(){
        $sql = "SELECT GebruikerID,Gebruikersnaam,Wachtwoord,Email FROM Gebruiker";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
       // $db       = new ConnectDB();
      //  $sha256ww = $db->makeSafe($Wachtwoord);

        $parameters = ([
            'Gebruikersnaam' => $Gebruikersnaam,
            'Wachtwoord' => $Wachtwoord,
            'Email' => $Email
        ]);
        return $sql->execute($parameters);
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM Gebruiker WHERE GebruikerID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ID, string $Naamgebruiker, string $Email){

        $sql =
            $this->conn->prepare("UPDATE Gebruiker SET Gebruikersnaam=:Naam , Email=:Email Where GebruikerID=:SID");//let op id geen quotes

        $parameters = [
            'Naam' => $Naamgebruiker,
            'Email' => $Email,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function updateWachtwoord(int $ID, string $Wachtwoord){

        $sql =
            $this->conn->prepare("UPDATE Gebruiker SET Wachtwoord=:Wachtwoord Where GebruikerID=:SID");//let op id geen quotes

        $parameters = [
            'Wachtwoord' => $Wachtwoord,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function get(int $ID){
        $sql = "SELECT GebruikerID,Gebruikersnaam,Email FROM Gebruiker WHERE GebruikerID =$ID";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function getByGebruikersNaam(string $GebruikersNaam){
        $sql = "SELECT Gebruikersnaam FROM Gebruiker WHERE Gebruikersnaam = '" . $GebruikersNaam . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function Validate(string $GebruikersNaam, string $Password){
        $sql =
            "SELECT GebruikerID,GebruikersNaam, Wachtwoord,Email FROM Gebruiker WHERE GebruikersNaam = '" .
            $GebruikersNaam . "' and Wachtwoord = '" .
            $Password . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function checkRechten(){
        $sql = "Select level FROM admin where GebruikerID ='" . $this->ID . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

}

