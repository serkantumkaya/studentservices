<?php


class Beschikbaarheid
{
    private int $ProjectID;
    private DateTime $Dagbeschikbaar;
    private DateTime $StartTijd;
    private DateTime $EindTijd;

    public function __construct(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd)
    {
        $this->ProjectID =  $projectID;
        $this->Dagbeschikbaar=$dagBeschikbaar;
        $this->StartTijd=$startTijd;
        $this->EindTijd= $eindTijd;
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
    public function getDagbeschikbaar(): DateTime{
        return $this->Dagbeschikbaar;
    }

    /**
     * @param DateTime $Dagbeschikbaar
     */
    public function setDagbeschikbaar(DateTime $Dagbeschikbaar): void{
        $this->Dagbeschikbaar = $Dagbeschikbaar;
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