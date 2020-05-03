<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/GebruikerModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Gebruiker.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class GebruikerController
{
    private GebruikerModel $gebruikermodel;

    public function __construct() {
        $this->gebruikermodel = new GebruikerModel();
    }

    public function GetGebruikers()
    {
        $GebruikerArray = [];
        foreach ($this->gebruikermodel->GetGebruikers()->fetchAll(PDO::FETCH_ASSOC) as $gebruiker)
        {
            $gebruiker = new Gebruiker(
                $gebruiker['GebruikerID'],
                $gebruiker['Gebruikernaam'],
                $gebruiker['Wachtwoord'],
                $gebruiker['Email'],
                $gebruiker['School'],
                $gebruiker['Opleiding'],
                $gebruiker['Startdatumopleiding'],
                $gebruiker['Foto'],
                $gebruiker['Status'],
                $gebruiker['Achternaam'],
                $gebruiker['Voornaam'],
                $gebruiker['Tussenvoegsel'],
                $gebruiker['Prefix'],
                $gebruiker['Straat'],
                $gebruiker['Huisnummer'],
                $gebruiker['Extentie'],
                $gebruiker['Postcode'],
                $gebruiker['Woonplaats'],
                $gebruiker['Geboortedatum'],
                $gebruiker['Telefoonnummer']);
            $GebruikerArray [] = $gebruiker;
        }
        return $GebruikerArray ;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Gebruikersnaam,
            string $Wachtwoord,
            string $Email,
            School $School,
            Opleiding $Opleidingg,
            DateTime $Startdatumopleiding,
            string $Status,
            string $Achternaam,
            string $Voornaam,
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
        return $this->gebruikermodel->Add($Gebruikersnaam,
            $Wachtwoord,
            $Email,
            $School,
            $Opleidingg,
            $Startdatumopleiding,
            $Status,
            $Achternaam,
            $Voornaam,
            $Tussenvoegsel,
            $Prefix,
            $Straat,
            $Huisnummer,
            $Extentie,
            $Postcode,
            $Woonplaats,
            $Geboortedatum,
            $Telefoonnummer);
    }

    function delete(int $Id)
    {
        return $this->gebruikermodel->Delete($Id);
    }

    function update(Gebruiker $Gebruiker)
    {
        return $this->gebruikermodel->Update($Gebruiker);
    }

    function getById(int $id) : gebruiker
    {
        $Gebruiker = $this->gebruikermodel->Get($id)->fetchAll(PDO::FETCH_ASSOC);
        return new Gebruiker(
            $Gebruiker[0]['GebruikerID'],
            $Gebruiker[0]['Gebruikernaam'],
            $Gebruiker[0]['Wachtwoord'],
            $Gebruiker[0]['Email'],
            $Gebruiker[0]['School'],
            $Gebruiker[0]['Opleiding'],
            $Gebruiker[0]['Startdatumopleiding'],
            $Gebruiker[0]['Foto'],
            $Gebruiker[0]['Status'],
            $Gebruiker[0]['Achternaam'],
            $Gebruiker[0]['Voornaam'],
            $Gebruiker[0]['Tussenvoegsel'],
            $Gebruiker[0]['Prefix'],
            $Gebruiker[0]['Straat'],
            $Gebruiker[0]['Huisnummer'],
            $Gebruiker[0]['Extentie'],
            $Gebruiker[0]['Postcode'],
            $Gebruiker[0]['Woonplaats'],
            $Gebruiker[0]['Geboortedatum'],
            $Gebruiker[0]['Telefoonnummer']);

    }
}
