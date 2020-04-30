<?php
require_once "EnumVoltijdDeeltijd.php";

class SelectieOpleiding
{
    private int $OpleidingID;
    private string $Naamopleiding;
    private EnumVoltijdDeeltijd $VoltijdDeeltijd;//Yes an enum. Don't you dare hardcode this. Or get it from the database each time.

    public function __construct(int $OpleidingID, string $Naamopleiding,EnumVoltijdDeeltijd $VoltijdDeeltijd)
    {
        $this->CategorieID= $CategorieID;
        $this->Naamopleiding = $Naamopleiding;
        $this->VoltijdDeeltijd = $VoltijdDeeltijd;
    }

    /**
     * @return int
     */
    public function getOpleidingID(): int
    {
        return $this->OpleidingID;
    }

    /**
     * @param int $OpleidingID
     */
    public function setOpleidingID(int $OpleidingID): void
    {
        $this->OpleidingID = $OpleidingID;
    }

    /**
     * @return string
     */
    public function getNaamopleiding(): string
    {
        return $this->Naamopleiding;
    }

    /**
     * @param string $Naamopleiding
     */
    public function setNaamopleiding(string $Naamopleiding): void
    {
        $this->Naamopleiding = $Naamopleiding;
    }

    /**
     * @return EnumVoltijdDeeltijd
     */
    public function getVoltijdDeeltijd(): EnumVoltijdDeeltijd
    {
        return $this->VoltijdDeeltijd;
    }

    /**
     * @param EnumVoltijdDeeltijd $VoltijdDeeltijd
     */
    public function setVoltijdDeeltijd(EnumVoltijdDeeltijd $VoltijdDeeltijd): void
    {
        $this->VoltijdDeeltijd = $VoltijdDeeltijd;
    }
}