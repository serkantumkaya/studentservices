<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Opleiding.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/includes/DB.php");

class GebruikerModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Opleiding $gebruiker;

    public function __construct()
    {
        $this->ConnectDb = new ConnectDb();
        $this->conn = $this->ConnectDb->GetConnection();
    }

    public function GetGebruikers()
    {
        //Blob hier nog niet meenemen is intensief en hier nog niet nodig.
        $sql = "SELECT GebruikerID ,
            Gebruikersnaam ,
            Wachtwoord,
            Email,
            School ,
            Opleiding ,
            Startdatumopleiding ,
            Status,
            Achternaam ,
            Voornaam ,
            Tussenvoegsel,
            Prefix ,
            Straat ,
            Huisnummer,
            Extentie ,
            Postcode ,
            Woonplaats ,
            Geboortedatum , 
            Telefoonnummer FROM Gebruiker";
        return $this->conn->query($sql);


    }

    //FOTO toevoegen gaat anders niet via een constructor
    function add( int $GebruikerID,
        string $Gebruikersnaam,
        string $Wachtwoord,
        string $Email,
        School $School,
        Opleiding $Opleiding,
        DateTime $Startdatumopleiding,
        GebruikerStatus $Status,
        string $Achternaam,
        String $Voornaam,
        string $Tussenvoegsel,
        string $Prefix,
        string $Straat,
          int $Huisnummer,
        string $Extentie,
        string $Postcode,
        string $Woonplaats,
        DateTime $Geboortedatum,
        string $Telefoonnummer)
    {
        $statement = $this->conn->prepare("INSERT INTO Gebruiker (GebruikerID ,
            Gebruikersnaam ,
            Wachtwoord,
            Email,
            School ,
            Opleiding ,
            Startdatumopleiding ,
            Status,
            Achternaam ,
            Voornaam ,
            Tussenvoegsel,
            Prefix ,
            Straat ,
            Huisnummer,
            Extentie ,
            Postcode ,
            Woonplaats ,
            Geboortedatum , 
            Telefoonnummer) 
            VALUES (
            :GebruikerID ,
            :Gebruikersnaam ,
            :Wachtwoord,
            :Email,
            :School ,
            :Opleiding ,
            :Startdatumopleiding ,
            :Status,
            :Achternaam ,
            :Voornaam ,
            :Tussenvoegsel,
            :Prefix ,
            :Straat ,
            :Huisnummer,
            :Extentie ,
            :Postcode ,
            :Woonplaats ,
            :Geboortedatum , 
            :Telefoonnummer)");
        $statement->execute([
            'Gebruikersnaam'  => $Gebruikersnaam,
            Wachtwoord,
            Email,
            School ,
            Opleiding ,
            Startdatumopleiding ,
            Status,
            Achternaam ,
            Voornaam ,
            Tussenvoegsel,
            Prefix ,
            Straat ,
            Huisnummer,
            Extentie ,
            Postcode ,
            Woonplaats ,
            Geboortedatum ,
            Telefoonnummer' => $VoltijdDeeltijd
        ]);
        return true;
    }

    function delete(int $ID) {

        $sql = $this->conn->prepare("DELETE FROM SelectieOpleiding WHERE OpleidingID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ID, string $Naamgebruiker, string $VoltijdDeeltijd)
    {

        $sql = $this->conn->prepare("UPDATE SelectieOpleiding SET Naamgebruiker=:Naam , Voltijd_deeltijd=:VDD Where OpleidingID=:SID");//let op id geen quotes

        $parameters = [
            'Naam' => $Naamgebruiker,
            'VDD' => $VoltijdDeeltijd,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function get(int $ID)
    {
        $sql = "SELECT OpleidingID,Naamgebruiker,Voltijd_deeltijd  FROM SelectieOpleiding WHERE OpleidingID =$ID";
        return $this->conn->query($sql);
    }
}

