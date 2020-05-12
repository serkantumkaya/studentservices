<?php

require_once "School.php";
require_once "Opleiding.php";

class Profiel
{
    private int $ProfielID;
    private int $GebruikerID;
    private ?School $School;
    private ?Opleiding $Opleiding;
    private ?DateTime $Startdatumopleiding;
    private imagejpeg $Foto;
    private string $Status;
    private string $Achternaam;
    private string $Voornaam;
    private string $Tussenvoegsel;
    private string $Prefix;
    private string $Straat;
    private int $Huisnummer;
    private string $Extentie;
    private string $Postcode;
    private string $Woonplaats;
    private ?DateTime $Geboortedatum;
    private string $Telefoonnummer;

    public function __construct(int $ProfielID,int $GebruikerID,?School $School, ?Opleiding $Opleiding,
        ?DateTime $Startdatumopleiding, string $Status, string $Achternaam, string $Voornaam, string $Tussenvoegsel,
        string $Prefix, string $Straat, int $Huisnummer, string $Extentie, string $Postcode,
        string $Woonplaats, ?DateTime $Geboortedatum, string $Telefoonnummer)
    {
        $this->ProfielID = $ProfielID;
        $this->GebruikerID = $GebruikerID;
        $this->School = $School;
        $this->Opleiding = $Opleiding;
        $this->Startdatumopleiding = $Startdatumopleiding;
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

    public function __toString() : string
    {
        return trim($this->Voornaam." ".$this->Tussenvoegsel." ").$this->Achternaam ;
    }

    /**
     * @return int
     */
    public function getProfielID(): int{
        return $this->ProfielID;
    }

    /**
     * @param int $ProfielID
     */
    public function setProfielID(int $ProfielID): void{
        $this->ProfielID = $ProfielID;
    }

    /**
     * @return int
     */
    public function getGebruikerID(): int{
        return $this->GebruikerID;
    }

    /**
     * @param int $GebruikerID
     */
    public function setGebruikerID(int $GebruikerID): void{
        $this->GebruikerID = $GebruikerID;
    }

     /**
     * @return School
     */
    public function getSchool(): ?School
    {
        return $this->School;
    }

    /**
     * @param School $School
     */
    public function setSchool(School $School): void
    {
        $this->School = $School;
    }

    /**
     * @return Opleiding
     */
    public function getOpleiding(): ?Opleiding
    {
        return $this->Opleiding;
    }

    /**
     * @param Opleiding $Opleidingg
     */
    public function setOpleidingg(Opleiding $Opleidingg): void
    {
        $this->Opleidingg = $Opleidingg;
    }

    /**
     * @return ?DateTime
     */
    public function getStartdatumopleiding(): ?DateTime
    {
        return $this->Startdatumopleiding;
    }

    /**
     * @param DateTime $Startdatumopleiding
     */
    public function setStartdatumopleiding(DateTime $Startdatumopleiding): void
    {
        $this->Startdatumopleiding = $Startdatumopleiding;
    }

    /**
     * @return imagejpeg
     */
    public function getFoto(): imagejpeg
    {
        return $this->Foto;
    }

    /**
     * @param imagejpeg $Foto
     */
    public function setFoto(imagejpeg $Foto): void
    {
        $this->Foto = $Foto;
    }

    /**
     * @return GebruikerStatus
     */
    public function getStatus(): GebruikerStatus
    {
        return $this->Status;
    }

    /**
     * @param GebruikerStatus $Status
     */
    public function setStatus(GebruikerStatus $Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @return string
     */
    public function getAchternaam(): string
    {
        return $this->Achternaam;
    }

    /**
     * @param string $Achternaam
     */
    public function setAchternaam(string $Achternaam): void
    {
        $this->Achternaam = $Achternaam;
    }

    /**
     * @return string
     */
    public function getVoornaam(): string
    {
        return $this->Voornaam;
    }

    /**
     * @param string $Voornaam
     */
    public function setVoornaam(string $Voornaam): void
    {
        $this->Voornaam = $Voornaam;
    }

    /**
     * @return string
     */
    public function getTussenvoegsel(): string
    {
        return $this->Tussenvoegsel;
    }

    /**
     * @param string $Tussenvoegsel
     */
    public function setTussenvoegsel(string $Tussenvoegsel): void
    {
        $this->Tussenvoegsel = $Tussenvoegsel;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->Prefix;
    }

    /**
     * @param string $Prefix
     */
    public function setPrefix(string $Prefix): void
    {
        $this->Prefix = $Prefix;
    }

    /**
     * @return string
     */
    public function getStraat(): string
    {
        return $this->Straat;
    }

    /**
     * @param string $Straat
     */
    public function setStraat(string $Straat): void
    {
        $this->Straat = $Straat;
    }

    /**
     * @return int
     */
    public function getHuisnummer(): int
    {
        return $this->Huisnummer;
    }

    /**
     * @param int $Huisnummer
     */
    public function setHuisnummer(int $Huisnummer): void
    {
        $this->Huisnummer = $Huisnummer;
    }

    /**
     * @return string
     */
    public function getExtentie(): string
    {
        return $this->Extentie;
    }

    /**
     * @param string $Extentie
     */
    public function setExtentie(string $Extentie): void
    {
        $this->Extentie = $Extentie;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->Postcode;
    }

    /**
     * @param string $Postcode
     */
    public function setPostcode(string $Postcode): void
    {
        $this->Postcode = $Postcode;
    }

    /**
     * @return string
     */
    public function getWoonplaats(): string
    {
        return $this->Woonplaats;
    }

    /**
     * @param string $Woonplaats
     */
    public function setWoonplaats(string $Woonplaats): void
    {
        $this->Woonplaats = $Woonplaats;
    }

    /**
     * @return ?DateTime
     */
    public function getGeboortedatum(): ?DateTime
    {
        return $this->Geboortedatum;
    }

    /**
     * @param DateTime $Geboortedatum
     */
    public function setGeboortedatum(DateTime $Geboortedatum): void
    {
        $this->Geboortedatum = $Geboortedatum;
    }

    /**
     * @return string
     */
    public function getTelefoonnummer(): string
    {
        return $this->Telefoonnummer;
    }

    /**
     * @param string $Telefoonnummer
     */
    public function setTelefoonnummer(string $Telefoonnummer): void
    {
        $this->Telefoonnummer = $Telefoonnummer;
    }
}