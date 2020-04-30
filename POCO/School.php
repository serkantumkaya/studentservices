<?php

//poco school
class School
{
    private int $SchoolID;
    private string $Postcode;
    private string $Schoolnaam;
    private string $Locatie;

   # public function __construct(int $SchoolID=0, string $Schoolnaam='')
   public function __construct(int $SchoolID, string $Schoolnaam)
            {
            $this->SchoolID = $SchoolID;
            $this->Schoolnaam = $Schoolnaam;
    }

    /**
     * @return int
     */
    public function getSchoolID(): int
    {
        return $this->SchoolID;
    }

    /**
     * @return string
     */
    public function getLocatie(): string
    {
        return $this->Locatie;
    }

    /**
     * @param string $Locatie
     */
    public function setLocatie(string $Locatie): void
    {
        $this->Locatie = $Locatie;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->Postcode;
    }

    /**
     * @param string $Postcode
     */
    public function setPostcode(string $Postcode): void
    {
        $this->Postcode = $Postcode;
    }

    /**
     * @return string
     */
    public function getSchoolnaam(): string
    {
        return $this->Schoolnaam;
    }

    /**
     * @param string $Schoolnaam
     */
    public function setSchoolnaam(string $Schoolnaam): void
    {
        $this->Schoolnaam = $Schoolnaam;
    }




}
