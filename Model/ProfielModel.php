<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Profiel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class ProfielModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function GetProfielen(){
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
    //FOTO toevoegen gaat anders, niet via een constructor
    function add(
        int $GebruikersID,?School $School,?Opleiding $Opleiding,string $Startdatumopleiding,string $Status,
        string $Achternaam,String $Voornaam,string $Tussenvoegsel,string $Prefix,string $Straat,int $Huisnummer,
        string $Extensie,string $Postcode,string $Woonplaats,string $Geboortedatum,string $Telefoonnummer)
    {

        $statement = $this->conn->prepare("INSERT INTO Profiel (GebruikerID,School ,Opleiding ,Startdatumopleiding ,Status,
            Achternaam ,Voornaam ,Tussenvoegsel,Prefix ,Straat ,Huisnummer,Extentie ,Postcode ,Woonplaats ,Geboortedatum ,Telefoonnummer)
            VALUES (:GebruikersID ,:School ,:Opleiding ,:Startdatumopleiding ,:Status,:Achternaam ,:Voornaam ,:Tussenvoegsel,:Prefix ,
            :Straat ,:Huisnummer,:Extensie ,:Postcode ,:Woonplaats ,:Geboortedatum ,:Telefoonnummer)");

        $statement->execute(['GebruikersID' => $GebruikersID,'School' => $School->getSchoolID(),'Opleiding' => $Opleiding->getOpleidingID(),
            'Startdatumopleiding' => $Startdatumopleiding,'Status' => $Status,'Achternaam' => $Achternaam,'Voornaam' => $Voornaam,
            'Tussenvoegsel' => $Tussenvoegsel,'Prefix' => $Prefix,'Straat' => $Straat,'Huisnummer' => $Huisnummer,
            'Extensie' => $Extensie,'Postcode' => $Postcode,'Woonplaats' => $Woonplaats
            ,'Geboortedatum' => $Geboortedatum
            ,'Telefoonnummer' => $Telefoonnummer]);
        return true;
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM profiel WHERE ProfielID=:SID");

        $parameters = [
            'SID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(Profiel $profiel){

        $sql =

            $this->conn->prepare("UPDATE Profiel SET 
            School=:School ,Opleiding=:Opleiding ,Startdatumopleiding=:Startdatumopleiding ,Status=:Status,
            Achternaam=:Achternaam ,Voornaam=:Voornaam ,Tussenvoegsel=:Tussenvoegsel,Prefix=:Prefix ,Straat=:Straat ,Huisnummer=:Huisnummer,
            Extentie=:Extensie ,Postcode=:Postcode ,Woonplaats=:Woonplaats ,Geboortedatum=:Geboortedatum ,Telefoonnummer=:Telefoonnummer
            Where ProfielID=:ProfielID");//let op id geen quotes

        $parameters = [
            'School' => $profiel->getSchool()->getSchoolID(),
            'Opleiding' => $profiel->getOpleiding()->getOpleidingID(),
            'Startdatumopleiding' => $profiel->getStartdatumopleiding(),
            'Status' => $profiel->getStatus(),
            'Achternaam' => $profiel->getAchternaam(),
            'Voornaam' => $profiel->getVoornaam(),
            'Tussenvoegsel' => $profiel->getTussenvoegsel(),
            'Prefix' => $profiel->getPrefix(),
            'Straat' => $profiel->getStraat(),
            'Huisnummer' => $profiel->getHuisnummer(),
            'Extensie' => $profiel->getExtensie(),
            'Postcode' => $profiel->getPostcode(),
            'Woonplaats' => $profiel->getWoonplaats(),
            'Geboortedatum' => $profiel->getGeboortedatum(),
            'Telefoonnummer' => $profiel->getTelefoonnummer(),
            'ProfielID' => $profiel->getProfielID()
        ];
        return $sql->execute($parameters);
    }

    function getByID(int $ID){
        $sql = "SELECT *  FROM Profiel WHERE ProfielID =$ID";
        return $this->conn->query($sql);
    }

    function getByGebruikerID(int $ID){
        $sql = "SELECT *  FROM Profiel WHERE GebruikerID =$ID";
        return $this->conn->query($sql);
    }

    function UploadPhoto($Photo, int $profielID)
    {
        $sql =

            $this->conn->prepare("UPDATE Profiel SET Foto = :Photo 
            Where ProfielID=:ProfielID");//let op id geen quotes

        $parameters = [
            'Photo' => $Photo,
            'ProfielID' => $profielID,
        ];
        return $sql->execute($parameters);
    }
}

