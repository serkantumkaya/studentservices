<?php

require_once "Gebruiker.php";
require_once "Profiel.php";
require_once "Projecten.php";

class Reactie
{
    private int $ReactieID;
    private int $GebruikersID;
    private int $ProjectID;
    private string $Reactie;

    public function __construct(int $ReactieID,int $GebruikersID,int $ProjectID,string $Reactie){
        $this->ReactieID    = $ReactieID;
        $this->GebruikersID = $GebruikersID;
        $this->ProjectID    = $ProjectID;
        $this->Reactie      = $Reactie;
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
    public function getGebruikersID(): int{
        return $this->GebruikersID;
    }

    /**
     * @param int $GebruikersID
     */
    public function setGebruikersID(int $GebruikersID): void{
        $this->GebruikersID = $GebruikersID;
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