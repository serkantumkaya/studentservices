<?php

class ZoekOpdracht
{
    private int $ID;
    private string $zoekwoorden;
    private string $resultaat;
    private string $tijd;

    public function __construct(int $ID, string $zoekwoorden, string $resultaat, string $tijd){
        $this->ID          = $ID;
        $this->Zoekwoorden = $zoekwoorden;
        $this->Resultaat   = $resultaat;
        $this->Tijd        = $tijd;
    }

    /**
     * @return int
     */
    public function getID(): int{
        return $this->ID;
    }

    /**
     * @param int $ID
     */
    public function setID(int $ID): void{
        $this->ID = $ID;
    }

    /**
     * @return string
     */
    public function getZoekwoorden(): string{
        return $this->Zoekwoorden;
    }

    /**
     * @param string $zoekwoorden
     */
    public function setZoekwoorden(string $zoekwoorden): void{
        $this->Zoekwoorden = $zoekwoorden;
    }

    /**
     * @return string
     */
    public function getResultaat(): string{
        return $this->Resultaat;
    }

    /**
     * @param string $Resultaat
     */
    public function setResultaat(string $Resultaat): void{
        $this->Resultaat = $Resultaat;
    }

    /**
     * @return mixed
     */
    public function getTijd(){
        return $this->Tijd;
    }

    /**
     * @param mixed $Tijd
     */
    public function setTijd($Tijd): void{
        $this->Tijd = $Tijd;
    }


}


