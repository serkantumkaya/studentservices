<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

class Reactie
{
    private int $ReactieID;
    private string $Timestamp;
    private int $GebruikerID;
    private int $ProjectID;
    private string $Reactie;
    private GebruikerController $gebruikercontroller;

    public function __construct(int $ReactieID, string $Timestamp, int $GebruikerID,int $ProjectID,string $Reactie){
        $this->ReactieID    = $ReactieID;
        $this->Timestamp    = $Timestamp;
        $this->GebruikerID = $GebruikerID;
        $this->ProjectID    = $ProjectID;
        $this->Reactie      = $Reactie;
        $this->gebruikercontroller = new GebruikerController($this->getGebruikerID());
    }

    /**
     * @return string
     */
    public function getTimestamp(): string{
        return $this->Timestamp;
    }

    /**
     * @param string $Timestamp
     */
    public function setTimestamp(string $Timestamp): void{
        $this->Timestamp = $Timestamp;
    }

    /**
     * @return int
     */
    public function getReactieID(): int{
        return $this->ReactieID;
    }

    /**
     * @param int $ReactieID
     */
    public function setReactieID(int $ReactieID): void{
        $this->ReactieID = $ReactieID;
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
     * @return int|string
     */
    public function getReactie(){
        return $this->Reactie;
    }

    /**
     * @param int|string $Reactie
     */
    public function setReactie($Reactie): void{
        $this->Reactie = $Reactie;
    }

}