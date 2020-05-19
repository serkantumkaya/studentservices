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
    private int $Datumaangemaakt;
    private int $Deadline;
    private int $Status;
    private string $Locatie;
    private int $Verwijderd;


    function __construct(int $ProjectID, int $GebruikerID, string $Type, string $Titel, string $Beschrijving, int $CategorieID, int $Datumaangemaakt, int $Deadline, int $Status, string $Locatie, int $Verwijderd)
    {
        $this->ProjectID = $ProjectID;
        $this->GebruikerID = $GebruikerID;
        $this->Type = $Type;
        $this-> Titel = $Titel;
        $this-> Beschrijving = $Beschrijving;
        $this-> CategorieID = $CategorieID;
        $this-> Datumaangemaakt = $Datumaangemaakt;
        $this-> Deadline = $Deadline;
        $this-> Status = $Status;
        $this-> Locatie = $Locatie;
        $this-> Verwijderd = $Verwijderd;
    }

    /**
     * @return mixed
     */
    public function getProjectID()
    {
        return $this->ProjectID;
    }

    /**
     * @param mixed $ProjectID
     */
    public function setProjectID($ProjectID)
    {
        $this->ProjectID = $ProjectID;
    }

    /**
     * @return mixed
     */
    public function getGebruikerID()
    {
        return $this->GebruikerID;
    }

    /**
     * @param mixed $GebruikerID
     */
    public function setGebruikerID($GebruikerID)
    {
        $this->GebruikerID = $GebruikerID;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return string
     */
    public function getTitel()
    {
        return $this->Titel;
    }

    /**
     * @param string $Titel
     */
    public function setTitel($Titel)
    {
        $this->Titel = $Titel;
    }

    /**
     * @return string
     */
    public function getBeschrijving()
    {
        return $this->Beschrijving;
    }

    /**
     * @param string $Beschrijving
     */
    public function setBeschrijving($Beschrijving)
    {
        $this->Beschrijving = $Beschrijving;
    }

    /**
     * @return int
     */
    public function getCategorieID()
    {
        return $this->CategorieID;
    }

    /**
     * @param int $CategorieID
     */
    public function setCategorieID($CategorieID)
    {
        $this->CategorieID = $CategorieID;
    }

    /**
     * @return int
     */
    public function getDatumaangemaakt()
    {
        return $this->Datumaangemaakt;
    }

    /**
     * @param int $Datumaangemaakt
     */
    public function setDatumaangemaakt($Datumaangemaakt)
    {
        $this->Datumaangemaakt = $Datumaangemaakt;
    }

    /**
     * @return int
     */
    public function getDeadline()
    {
        return $this->Deadline;
    }

    /**
     * @param int $Deadline
     */
    public function setDeadline($Deadline)
    {
        $this->Deadline = $Deadline;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param int $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return string
     */
    public function getLocatie()
    {
        return $this->Locatie;
    }

    /**
     * @param string $Locatie
     */
    public function setLocatie($Locatie)
    {
        $this->Locatie = $Locatie;
    }

    /**
     * @return int
     */
    public function getVerwijderd()
    {
        return $this->Verwijderd;
    }

    /**
     * @param int $Verwijderd
     */
    public function setVerwijderd($Verwijderd)
    {
        $this->Verwijderd = $Verwijderd;
    }


}