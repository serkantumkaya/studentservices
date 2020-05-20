<?php

// TODO: deze moet nog gedaan worden.
// wat te doen? kijk naar Gebruiker.php, je ziet daar de 4 variablen staan.
// deze variablen komen uit de database, maak dus voor projecten de variablen aan zoals uit de database.
// bepaal wat het type is (int, string, boolean) en zet dit er bij. dit kan met php 7.4, PHPstorm kan je aaraden om dus php7.4 te gebruiken
// maak de construct. kijk bij Profiel.php hoe we dit doen. dit alles meegeven in de construct.
//maak de getters en de setters. (bovenin bij 'Code' -> 'generate')


class Project
{

    private int $ProjectID;
    private int $GebruikerID;
    private string $Type;
    private string $Titel;
    private string $Beschrijving;
    private int $CategorieID;
    private string $Datumaangemaakt;
    private string $Deadline;
    private bool $Status;
    private string $Locatie;
    private bool $Verwijderd;


    function __construct(int $ProjectID, int $GebruikerID, string $Type, string $Titel, string $Beschrijving,
        int $CategorieID, string $Datumaangemaakt, string $Deadline, bool $Status, string $Locatie,
        bool $Verwijderd){
        $this->ProjectID       = $ProjectID;
        $this->GebruikerID     = $GebruikerID;
        $this->Type            = $Type;
        $this->Titel           = $Titel;
        $this->Beschrijving    = $Beschrijving;
        $this->CategorieID     = $CategorieID;
        $this->Datumaangemaakt = $Datumaangemaakt;
        $this->Deadline        = $Deadline;
        $this->Status          = $Status;
        $this->Locatie         = $Locatie;
        $this->Verwijderd      = $Verwijderd;
    }

    /**
     * @return int
     */
    public function getProjectID(): int{
        return $this->ProjectID;
    }

    /**
     * @param int $ProjectID
     */
    public function setProjectID(int $ProjectID): void{
        $this->ProjectID = $ProjectID;
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
     * @return string
     */
    public function getType(): string{
        return $this->Type;
    }

    /**
     * @param string $Type
     */
    public function setType(string $Type): void{
        $this->Type = $Type;
    }

    /**
     * @return string
     */
    public function getTitel(): string{
        return $this->Titel;
    }

    /**
     * Kortere versie van de Titel als die te lang wordt.
     * @return string
     */

    public function getTitelKort(): string{
        if (strlen($this->Titel)>40){
            return substr($this->Titel, 0, 40) . "...";
        } else{
            return $this->Titel;
        }
    }

    /**
     * @param string $Titel
     */
    public function setTitel(string $Titel): void{
        $this->Titel = $Titel;
    }

    /**
     * @return string
     */
    public function getBeschrijving(): string{
        return $this->Beschrijving;
    }

    public function getBeschrijvingKort(): string{
        if (strlen($this->Beschrijving)>100){
            return substr($this->Beschrijving, 0, 100) . "...";
        } else{
            return $this->Beschrijving;
        }
    }


    /**
     * @param string $Beschrijving
     */
    public function setBeschrijving(string $Beschrijving): void{
        $this->Beschrijving = $Beschrijving;
    }

    /**
     * @return int
     */
    public function getCategorieID(): int{
        return $this->CategorieID;
    }

    /**
     * @param int $CategorieID
     */
    public function setCategorieID(int $CategorieID): void{
        $this->CategorieID = $CategorieID;
    }

    /**
     * @return DateTime|null
     */
    public function getDatumaangemaakt(): string{
        return $this->Datumaangemaakt;
    }

    /**
     * @param DateTime|null $Datumaangemaakt
     */
    public function setDatumaangemaakt(string $Datumaangemaakt): void{
        $this->Datumaangemaakt = $Datumaangemaakt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeadline(): string{
        return $this->Deadline;
    }

    /**
     * @param DateTime|null $Deadline
     */
    public function setDeadline(string $Deadline): void{
        $this->Deadline = $Deadline;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool{
        return $this->Status;
    }

    /**
     * @param bool $Status
     */
    public function setStatus(bool $Status): void{
        $this->Status = $Status;
    }

    /**
     * @return string
     */
    public function getLocatie(): string{
        return $this->Locatie;
    }

    /**
     * @param string $Locatie
     */
    public function setLocatie(string $Locatie): void{
        $this->Locatie = $Locatie;
    }

    /**
     * @return bool
     */
    public function isVerwijderd(): bool{
        return $this->Verwijderd;
    }

    /**
     * @param bool $Verwijderd
     */
    public function setVerwijderd(bool $Verwijderd): void{
        $this->Verwijderd = $Verwijderd;
    }


}