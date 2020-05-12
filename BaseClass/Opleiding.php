<?php

// deze is klaar
class Opleiding
{
    private int $OpleidingID;
    private string $Naamopleiding;
    private string $VoltijdDeeltijd;

    public function __construct(int $OpleidingID, string $Naamopleiding, string $VoltijdDeeltijd){
        $this->OpleidingID     = $OpleidingID;
        $this->Naamopleiding   = $Naamopleiding;
        $this->VoltijdDeeltijd = $VoltijdDeeltijd;
    }

    /**
     * @return int
     */
    public function getOpleidingID(): int{
        return $this->OpleidingID;
    }

    /**
     * @param int $OpleidingID
     */
    public function setOpleidingID(int $OpleidingID): void{
        $this->OpleidingID = $OpleidingID;
    }

    /**
     * @return string
     */
    public function getNaamopleiding(): string{
        return $this->Naamopleiding;
    }

    /**
     * @param string $Naamopleiding
     */
    public function setNaamopleiding(string $Naamopleiding): void{
        $this->Naamopleiding = $Naamopleiding;
    }

    /**
     * @return string
     */
    public function getVoltijdDeeltijd(): string{
        return $this->VoltijdDeeltijd;
    }

    /**
     * @param string $VoltijdDeeltijd
     */
    public function setVoltijdDeeltijd(string $VoltijdDeeltijd): void{
        $this->VoltijdDeeltijd = $VoltijdDeeltijd;
    }
}