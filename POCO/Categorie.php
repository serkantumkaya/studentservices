<?php
require_once "EnumVoltijdDeeltijd.php";

class Categorie
{
    private int $CategorieID;
    private string $Categorienaam;

    public function __construct(int $CategorieID, string $Categorienaam)
    {
        $this->$CategorieID= $CategorieID;
        $this->Categorienaam = $Categorienaam;
    }

    /**
     * @return int
     */
    public function getCategorieID(): int
    {
        return $this->CategorieID;
    }

    /**
     * @param int $CategorieID
     */
    public function setCategorieID(int $CategorieID): void
    {
        $this->CategorieID = $CategorieID;
    }

    /**
     * @return string
     */
    public function getCategorienaam(): string
    {
        return $this->Categorienaam;
    }

    /**
     * @param string $Categorienaam
     */
    public function setCategorienaam(string $Categorienaam): void
    {
        $this->Categorienaam = $Categorienaam;
    }
}