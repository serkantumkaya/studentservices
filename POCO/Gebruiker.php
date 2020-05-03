<?php

require_once "School.php";
require_once "Opleiding.php";

class Gebruiker
{
    private int $GebruikerID;
    private string $Gebruikersnaam;
    private string $Wachtwoord;
    private string $Email;
    private School $School;
    private Opleiding $Opleidingg;
    private DateTime $Startdatumopleiding;
    private imagejpeg $Foto;
    private GebruikerStatus $Status;
    private string $Achternaam;
    private string $Voornaam;
    private string $Tussenvoegsel;
    private string $Prefix;
    private string $Straat;
    private int $Huisnummer;
    private string $Extentie;
    private string $Postcode;
    private string $Woonplaats;
    private DateTime $Geboortedatum;
    private string $Telefoonnummer;

    public function __construct(int $GebruikerID, string $Gebruikersnaam, string $Wachtwoord, string $Email, School $School, Opleiding $Opleidingg,
                                DateTime $Startdatumopleiding, GebruikerStatus $Status, string $Achternaam, string $Voornaam, string $Tussenvoegsel,
                                string $Prefix, string $Straat, int $Huisnummer, string $Extentie, string $Postcode, string $Woonplaats, DateTime $Geboortedatum, string $Telefoonnummer)
    {
        $this->GebruikerID = $GebruikerID;
        $this->Gebruikersnaam = $Gebruikersnaam;
        $this->Wachtwoord = $Wachtwoord;
        $this->Email = $Email;
        $this->School = $School;
        $this->Opleidingg = $Opleidingg;
        $this->Startdatumopleiding = $Startdatumopleiding;
        $this->Foto = $Foto;
        $this->Status = $Status;
        $this->Achternaam = $Achternaam;
        $this->Voornaam = $Voornaam;
        $this->Tussenvoegsel = $Tussenvoegsel;
        $this->Prefix = $Prefix;
        $this->Straat = $Straat;
        $this->Huisnummer = $Huisnummer;
        $this->Extentie = $Extentie;
        $this->Postcode = $Postcode;
        $this->Woonplaats = $Woonplaats;
        $this->Geboortedatum = $Geboortedatum;
        $this->Telefoonnummer = $Telefoonnummer;
    }

    public function getGebruikersID () { $this->GebruikerID;}


}