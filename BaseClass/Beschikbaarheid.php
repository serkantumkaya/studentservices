<?php

class Beschikbaarheid
{
    private int $BeschikbaarheidID;

    /**
     * @return int
     */
    public function getBeschikbaarheidID(): int{
        return $this->BeschikbaarheidID;
    }

    /**
     * @param int $BeschikbaarheidID
     */
    public function setBeschikbaarheidID(int $BeschikbaarheidID): void{
        $this->BeschikbaarheidID = $BeschikbaarheidID;
    }

    private int $ProjectID;
    private DateTime $StartTijd;
    private DateTime $EindTijd;

    public function __construct(int $BeschikbaarheidID, int $projectID, DateTime $startTijd, DateTime $eindTijd){
        $this->BeschikbaarheidID = $BeschikbaarheidID;
        $this->ProjectID         = $projectID;
        $this->StartTijd         = $startTijd;
        $this->EindTijd          = $eindTijd;
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
     * @return DateTime
     */
    public function getStartTijd(): DateTime{
        return $this->StartTijd;
    }

    /**
     * @param DateTime $StartTijd
     */
    public function setStartTijd(DateTime $StartTijd): void{
        $this->StartTijd = $StartTijd;
    }

    /**
     * @return DateTime
     */
    public function getEindTijd(): DateTime{
        return $this->EindTijd;
    }

    /**
     * @param DateTime $EindTijd
     */
    public function setEindTijd(DateTime $EindTijd): void{
        $this->EindTijd = $EindTijd;
    }

}