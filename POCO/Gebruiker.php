<?php

class Gebruiker
{
    private int $GebruikerID;
    private string $Gebruikersnaam;
    private string $Wachtwoord;
    private string $Email;

    public function __construct(int $GebruikerID, string $Gebruikersnaam, string $Wachtwoord, string $Email)
    {
        $this->GebruikerID = $GebruikerID;
        $this->Gebruikersnaam = $Gebruikersnaam;
        $this->Wachtwoord = $Wachtwoord;
        $this->Email = $Email;
    }

    /**
     * @return int
     */
    public function getGebruikerID(): int
    {
        return $this->GebruikerID;
    }

    /**
     * @param int $GebruikerID
     */
    public function setGebruikerID(int $GebruikerID): void
    {
        $this->GebruikerID = $GebruikerID;
    }

    /**
     * @return string
     */
    public function getGebruikersnaam(): string
    {
        return $this->Gebruikersnaam;
    }

    /**
     * @param string $Gebruikersnaam
     */
    public function setGebruikersnaam(string $Gebruikersnaam): void
    {
        $this->Gebruikersnaam = $Gebruikersnaam;
    }

    /**
     * @return string
     */
    public function getWachtwoord(): string
    {
        return $this->Wachtwoord;
    }

    /**
     * @param string $Wachtwoord
     */
    public function setWachtwoord(string $Wachtwoord): void
    {
        $this->Wachtwoord = $Wachtwoord;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void
    {
        $this->Email = $Email;
    }
}