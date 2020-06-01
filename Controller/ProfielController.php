<?php

require_once ("C:xampp/htdocs/StudentServices/Model/ProfielModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Opleiding.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/School.php");
//require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Projecten.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/OpleidingController.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/SchoolController.php");

//hier doe je de crud afvangen vanuit de profiel.
class ProfielController
{
    private $profielmodel;
    private $gebruikerID;

    //link the gebruiker here so you always have a connection to the logged on user.
    public function __construct(int $GebruikerID){
        $this->profielmodel = new ProfielModel();
        $this->gebruikerID  = $GebruikerID;
    }

    public function GetProfielen(){
        $ProfielArray = [];
        foreach ($this->profielmodel->GetProfielen()->fetchAll(PDO::FETCH_ASSOC) as $profiel){

            $schoolc    = new SchoolController();
            $opleidingc = new OpleidingController();

            $profiel         = new Profiel(
                $profiel['ProfielID'],
                $profiel['GebruikerID'],
                $profiel['School'] == null ? null : $schoolc->getById($profiel['School']),
                $profiel['Opleiding'] == null ? null : $opleidingc->getById($profiel['Opleiding']),
                $profiel['Startdatumopleiding'],
                $profiel['Status'] = null ? "onbekend" : $profiel['Status'],
                $profiel['Achternaam'] ?? "",
                $profiel['Voornaam'] ?? "",
                $profiel['Tussenvoegsel'] == null ? "" : $profiel['Tussenvoegsel'],
                $profiel['Prefix'] == null ? "" : $profiel['Prefix'],
                $profiel['Straat'] ?? "",
                $profiel['Huisnummer'] ?? "",
                $profiel['Extentie'] ?? "",
                $profiel['Postcode'] ?? "",
                $profiel['Woonplaats'] ?? "",
                $profiel['Geboortedatum'],
                $profiel['Telefoonnummer'] == null ? "" : $profiel['Telefoonnummer']);
            $ProfielArray [] = $profiel;
        }
        return $ProfielArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(int $GebruikerID, ?School $School, ?Opleiding $Opleiding, string $Startdatumopleiding, string $Status,
        string $Achternaam, string $Voornaam, string $Tussenvoegsel, string $Prefix, string $Straat, int $Huisnummer,
        string $Extentie, string $Postcode, string $Woonplaats, string $Geboortedatum,
        string $Telefoonnummer){
        $this->profielmodel->Add($GebruikerID, $School, $Opleiding, $Startdatumopleiding, $Status, $Achternaam,
            $Voornaam, $Tussenvoegsel, $Prefix, $Straat, $Huisnummer, $Extentie, $Postcode, $Woonplaats, $Geboortedatum,
            $Telefoonnummer);
        return true;
    }

    function delete(int $Id){
        return $this->profielmodel->Delete($Id);
    }

    function update(Profiel $Profiel){
        return $this->profielmodel->Update($Profiel);
    }

    function getById(int $id): profiel{
        //echo "1";
        $profielmodel        = new ProfielModel();
        $Profiel             = $profielmodel->getByID($id)->fetch(PDO::FETCH_ASSOC);
        $schoolcontroller    = new SchoolController();
        $opleidingcontroller = new OpleidingController();

        $ProfielObject =  new Profiel(
            $Profiel['ProfielID'],
            $Profiel['GebruikerID'],
            $schoolcontroller->getById($Profiel['School']),
            $opleidingcontroller->getById($Profiel['Opleiding']),
            $Profiel['Startdatumopleiding'],
            $Profiel['Status'],
            $Profiel['Achternaam'],
            $Profiel['Voornaam'],
            $Profiel['Tussenvoegsel'],
            $Profiel['Prefix'],
            $Profiel['Straat'],
            $Profiel['Huisnummer'],
            $Profiel['Extentie'],
            $Profiel['Postcode'],
            $Profiel['Woonplaats'],
            $Profiel['Geboortedatum'],
            $Profiel['Telefoonnummer'] == null ? "" : $Profiel['Telefoonnummer']
        );
        if (isset($Profiel['Foto']))
            $ProfielObject->setFoto($Profiel['Foto']);
        return $ProfielObject;
    }

    function getByGebruikerID(){

        $profielmodel = new ProfielModel($this->gebruikerID);

        $Profielc = $profielmodel->getByGebruikerID($this->gebruikerID)->fetch(PDO::FETCH_ASSOC);

        if (!isset($Profielc) || $Profielc == false){

            return null;
        }

        //Profile does not exist
        $schoolcontroller    = new SchoolController();
        $opleidingcontroller = new OpleidingController();

        $ProfielObject = new Profiel(
            $Profielc['ProfielID'],
            $Profielc['GebruikerID'],
            $schoolcontroller->getById($Profielc['School']),
            $opleidingcontroller->getById($Profielc['Opleiding']),
            $Profielc['Startdatumopleiding'],
            $Profielc['Status'],
            $Profielc['Achternaam'],
            $Profielc['Voornaam'],
            $Profielc['Tussenvoegsel'],
            $Profielc['Prefix'],
            $Profielc['Straat'],
            $Profielc['Huisnummer'],
            $Profielc['Extentie'],
            $Profielc['Postcode'],
            $Profielc['Woonplaats'],
            $Profielc['Geboortedatum'],
            $Profielc['Telefoonnummer'] == null || $Profielc['Telefoonnummer'] == "" ? "" : $Profielc['Telefoonnummer'],

            );

        $ProfielObject->setFoto($Profielc['Foto']== null ? "" : $Profielc['Foto']);

        return $ProfielObject;
    }

    function UploadPhoto($Photo,int $GebruikersId)
    {
        $this->profielmodel->UploadPhoto($Photo,$GebruikersId);
    }

    function getEmail(int $id) : string
    {
        $GebruikerController = new GebruikerController($id);
        $gebruiker = $GebruikerController->getById($id);
        return $gebruiker->getEmail();
    }

    function getNAW(int $id) : string
    {
        $this->gebruikerID = $id;

        $profiel = $this->getByGebruikerID();

        $Achternaam = $profiel->getAchternaam();
        $Voornaam = $profiel->getVoornaam();
        $Tussenvoegsel = $profiel->getTussenvoegsel();
        $Prefix = $profiel->getPrefix();
        $Straat = $profiel->getStraat();
        $Huisnummer = $profiel->getHuisnummer();
        $Extensie = $profiel->getExtensie();
        $Postcode = $profiel->getPostcode();
        $Woonplaats = $profiel->getWoonplaats();
        $Telefoonnummer = $profiel->getTelefoonnummer();
        $Email = $this->GetEmail($id);
        $labelName = Translate::GetTranslation("ProfielNAWName");
        $labelAdres = Translate::GetTranslation("ProfielNAWAdres");
        $labelTelefoonnummer = Translate::GetTranslation("ProfielNAWTel");
        $labelEmail = Translate::GetTranslation("ProfielNAWEmail");

        return $labelName.trim($Prefix." ".$Voornaam." ".$Tussenvoegsel)." ".$Achternaam."<br>".
            $labelAdres.$Straat." ".trim($Huisnummer." ".$Extensie)."<br>".
               "                 ".        $Postcode."  ".$Woonplaats."<br>".
            $labelTelefoonnummer.$Telefoonnummer."<br>"
            .            $labelEmail.$Email;
    }
    //todo : maken als projecten af is
    //public function getProjectenByProfiel()
    //{
    //    $res = $this->profielmodel->getProjectenByProfiel()->fetchAll(PDO::FETCH_ASSOC);
    //    while($obj = mysqli_fetch_array($res)) {
    //        $projecten[] = new Project($obj,$this);
    //    }
    //    return $projecten;
    //}
}
