<?php

require_once "EnumGebruikerStatus.php";
require_once "School.php";
require_once "Opleiding.php";

class Gebruiker
{
    private int GebruikerID;
    private string $Gebruikersnaam;
    private string $Wachtwoord;
    private string $Email;
    private School $School;
    private Opleiding $Opleidingg;
    private DateTime $Startdatumopleiding;
    private imagejpeg $Foto;
    private GebruikerStatus $Status;
    private $Achternaam varchar(60) NOT NULL,
    private $Voornaam varchar(50) NOT NULL,
    private $Tussenvoegsel varchar(10) NULL,
    private $Prefix varchar(8) NULL,
    private $Straat varchar(50) NOT NULL,
    private $Huisnummer int NOT NULL,
    private $Extentie varchar(3) NULL,
    private $Postcode varchar(6) NOT NULL,
    private $Woonplaats varchar(60) NOT NULL,
    private $Geboortedatum date NULL,
    private $Telefoonnummer varchar(15) NULL,
    private $FOREIGN KEY(School) REFERENCES School(SchoolID) ON UPDATE CASCADE,
    private $OREIGN KEY(Opleiding) REFERENCES SELECTIEOPLEIDING(OpleidingID) ON UPDATE CASCADE*/

    public function getGebruikersID () { $this->GebruikerID;}


}