
<?php

//**************************let op dit is nog oud ***********************************************
//alleen nuttige functies overnemen en plaatsen in controller.

class Gebruiker
{
    private $GebrID;
    private $Gebruikersnaam;
    private $wachtwoord;
    private $Email;
    private $SchoolID;
    private $OpleidingID;
    private $Startopleiding;
    private $Foto;
    private $Status;
    private $Achternaam;
    private $Voornaam;
    private $Tussenvoegsel;
    private $Prefix;
    private $Straat;
    private $Huisnummer;
    private $Extentie;
    private $Postcode;
    private $Woonplaats;
    private $Geboortedatum;
    private $Telefoonnummer;
    public $projecten;

    public function __construct($ID)
    {
        $this->conn = ConnectDb::getInstance()->getConnection();
        $res = $this->conn->query("Select * from gebruiker where GebruikerID = '$ID'");
        $line = mysqli_fetch_array($res);

        $this->GebrID = $line['GebruikerID'];
        $this->Gebruikersnaam = $line['Gebruikersnaam'];
        $this->Wachtwoord = $line['Wachtwoord'];
        $this->Email = $line['Email'];
        $this->SchoolID = $line['School'];
        $this->OpleidingID = $line['Opleiding'];
        $this->Startopleiding = $line['Startdatumopleiding'];
        $this->Foto = $line['Foto'];
        $this->Status = $line['Status'];
        $this->Achternaam = $line['Achternaam'];
        $this->Voornaam = $line['Voornaam'];
        $this->Tussenvoegsel = $line['Tussenvoegsel'];
        $this->Prefix = $line['Prefix'];
        $this->Straat = $line['Straat'];
        $this->Huisnummer = $line['Huisnummer'];
        $this->Extentie = $line['Extentie'];
        $this->Postcode = $line['Postcode'];
        $this->Woonplaats = $line['Woonplaats'];
        $this->Geboortedatum = $line['Geboortedatum'];
        $this->Telefoonnummer = $line['Telefoonnummer'];
    }

    public function getProjectenZelf(){
        $projecten  = Array();
        $res = $this->conn->query("SELECT * from Project where GebruikerID= '$this->GebrID'");
        while($obj = mysqli_fetch_array($res)) {
            $projecten[] = new Project($obj,$this);
        }
        return $projecten;
    }

    public function getProjectenAlles(){
        $projecten  = Array();
        $res = $this->conn->query("SELECT * from Project");
        while($obj = mysqli_fetch_array($res)) {
            $projecten[] = new Project($obj,$this);
        }
        return $projecten;
    }

    public function getSchoolNaam(){
        $res = $this->conn->query("Select Schoolnaam from school where SchoolID = '$this->SchoolID'");
        $line = mysqli_fetch_array($res);
        return $line['Schoolnaam'];
    }
    public function getOpleidingNaam(){
        $res = $this->conn->query("Select Naamopleiding from selectieopleiding where OpleidingID = '$this->OpleidingID'");
        $line = mysqli_fetch_array($res);
        return $line['Naamopleiding'];
    }

    public function getFullName(){
        return $this->Voornaam." ". (isset($this->Tussenvoegsel)?$this->Tussenvoegsel." ". $this->Achternaam:$this->Achternaam);
    }

    public function getInfoAlgemeen(){
        $INFO = "";
        if (isset($this->Gebruikersnaam)){
            $INFO .= "Gebruikersnaam: ". $this->Gebruikersnaam. "<br>";
        }
        if (isset($this->Email)){
            $INFO .= "Email: ". $this->Email. "<br>";
        }
        if (isset($this->Telefoonnummer)){
            $INFO .= "Telefoonnummer: " .$this->Telefoonnummer. "<br>";
        }
        if (isset($this->Woonplaats)){
            $INFO .= "Woonplaats: " .$this->Woonplaats. "<br>";
        }
        if (isset($this->SchoolID)){
            $INFO .= "School: " .$this->getSchoolNaam(). "<br>";
        }
        if (isset($this->OpleidingID)){
            $INFO .= "Opleiding: " .$this->getOpleidingNaam(). "<br>";
        }
        return $INFO;
    }

    function selecteer(){

    }

    //Getters en Setters lekker onderaan houden. kutdingen.
    public function getGebrID(){
        return $this->GebrID;
    }
    public function getGebruikersnaam()
    {
        return $this->Gebruikersnaam;
    }
    public function setGebruikersnaam($Gebruikersnaam)
    {
        $this->Gebruikersnaam = $Gebruikersnaam;
    }
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }
    public function setWachtwoord($wachtwoord)
    {
        $this->wachtwoord = $wachtwoord;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
    public function getSchoolID()
    {
        return $this->SchoolID;
    }
    public function setSchoolID($SchoolID)
    {
        $this->SchoolID = $SchoolID;
    }
    public function getOpleidingID()
    {
        return $this->OpleidingID;
    }
    public function setOpleidingID($OpleidingID)
    {
        $this->OpleidingID = $OpleidingID;
    }
    public function getStartopleiding()
    {
        return $this->Startopleiding;
    }
    public function setStartopleiding($Startopleiding)
    {
        $this->Startopleiding = $Startopleiding;
    }
    public function getFoto()
    {
        return base64_encode($this->Foto);
    }
    public function setFoto($Foto)
    {
        $this->Foto = $Foto;
    }
    public function getStatus()
    {
        return $this->Status;
    }
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }
    public function getAchternaam()
    {
        return $this->Achternaam;
    }
    public function setAchternaam($Achternaam)
    {
        $this->Achternaam = $Achternaam;
    }
    public function getVoornaam()
    {
        return $this->Voornaam;
    }
    public function setVoornaam($Voornaam)
    {
        $this->Voornaam = $Voornaam;
    }
    public function getTussenvoegsel()
    {
        return $this->Tussenvoegsel;
    }
    public function setTussenvoegsel($Tussenvoegsel)
    {
        $this->Tussenvoegsel = $Tussenvoegsel;
    }
    public function getPrefix()
    {
        return $this->Prefix;
    }
    public function setPrefix($Prefix)
    {
        $this->Prefix = $Prefix;
    }
    public function getStraat()
    {
        return $this->Straat;
    }
    public function setStraat($Straat)
    {
        $this->Straat = $Straat;
    }
    public function getHuisnummer()
    {
        return $this->Huisnummer;
    }
    public function setHuisnummer($Huisnummer)
    {
        $this->Huisnummer = $Huisnummer;
    }
    public function getExtentie()
    {
        return $this->Extentie;
    }
    public function setExtentie($Extentie)
    {
        $this->Extentie = $Extentie;
    }
    public function getPostcode()
    {
        return $this->Postcode;
    }
    public function setPostcode($Postcode)
    {
        $this->Postcode = $Postcode;
    }
    public function getWoonplaats()
    {
        return $this->Woonplaats;
    }
    public function setWoonplaats($Woonplaats)
    {
        $this->Woonplaats = $Woonplaats;
    }
    public function getGeboortedatum()
    {
        return $this->Geboortedatum;
    }
    public function setGeboortedatum($Geboortedatum)
    {
        $this->Geboortedatum = $Geboortedatum;
    }
    public function getTelefoonnummer()
    {
        return $this->Telefoonnummer;
    }
    public function setTelefoonnummer($Telefoonnummer)
    {
        $this->Telefoonnummer = $Telefoonnummer;
    }
}
?>