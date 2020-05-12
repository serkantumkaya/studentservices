<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Profiel.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/includes/DB.php");

class ProfielModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Profiel $profiel;

    public function __construct()
    {
        $this->ConnectDb = new ConnectDb();
        $this->conn = $this->ConnectDb->GetConnection();
    }

    public function GetProfielen()
    {
        //Blob hier nog niet meenemen is intensief en hier nog niet nodig.
        $sql = "SELECT ProfielID ,
            GebruikerID,
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
            Telefoonnummer FROM Profiel";
        return $this->conn->query($sql);


    }

    //FOTO toevoegen gaat anders niet via een constructor
    //todo : Via een factory doen?
    function add(
        string $Profielsnaam,
        string $Wachtwoord,
        string $Email,
        ?School $School,
        ?Profiel $Profiel,
        ?DateTime $Startdatumopleiding,
        string $Status,
        string $Achternaam,
        String $Voornaam,
        string $Tussenvoegsel,
        string $Prefix,
        string $Straat,
          int $Huisnummer,
        string $Extentie,
        string $Postcode,
        string $Woonplaats,
        ?DateTime $Geboortedatum,
        string $Telefoonnummer)
    {
        $statement = $this->conn->prepare("INSERT INTO Profiel (ProfielID , Profielsnaam ,Wachtwoord,Email,School ,Profiel ,Startdatumopleiding ,Status,
            Achternaam ,Voornaam ,Tussenvoegsel,Prefix ,Straat ,Huisnummer,Extentie ,Postcode ,Woonplaats ,Geboortedatum ,Telefoonnummer) 
            VALUES (:ProfielID ,:Profielsnaam ,:Wachtwoord,:Email,:School ,:Profiel ,:Startdatumopleiding ,:Status,
:Achternaam ,:Voornaam ,:Tussenvoegsel,:Prefix ,:Straat ,:Huisnummer,:Extentie ,:Postcode ,:Woonplaats ,:Geboortedatum ,:Telefoonnummer)");
        $statement->execute([
            'Profielsnaam'  => $Profielsnaam,
            'Wachtwoord'  => $Wachtwoord,
            'Email'  => $Email,
            'School'  => $School,
            'Profiel'  => $Profiel,
            'Startdatumopleiding'  => $Startdatumopleiding,
            'Status'  => $Status,
            'Achternaam'  => $Achternaam,
            'Voornaam'  => $Voornaam,
            'Tussenvoegsel'  => $Tussenvoegsel,
            'Prefix'  => $Prefix,
            'Straat'  => $Straat,
            'Huisnummer'  => $Huisnummer,
            'Extentie'  => $Extentie,
            'Postcode'  => $Postcode,
            'Woonplaats'  => $Woonplaats,
            'Geboortedatum'  => $Geboortedatum,
            'Telefoonnummer' => $Telefoonnummer
        ]);
        return true;
    }

    function delete(int $ID) {

        $sql = $this->conn->prepare("DELETE FROM SelectieProfiel WHERE ProfielID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ID, string $Naamprofiel, string $VoltijdDeeltijd)
    {

        $sql = $this->conn->prepare("UPDATE SelectieProfiel SET Naamprofiel=:Naam , Voltijd_deeltijd=:VDD Where ProfielID=:SID");//let op id geen quotes

        $parameters = [
            'Naam' => $Naamprofiel,
            'VDD' => $VoltijdDeeltijd,
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function getById(int $ID)
    {
        $sql = "SELECT ProfielID,Naamprofiel,Voltijd_deeltijd  FROM SelectieProfiel WHERE ProfielID =$ID";
        return $this->conn->query($sql);
    }
}

