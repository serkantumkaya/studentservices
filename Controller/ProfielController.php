<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ProfielModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Opleiding.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/School.php");
//require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Projecten.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/OpleidingController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");

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

            $profiel = new Profiel(
                $profiel['ProfielID'],
                $profiel['GebruikerID'],
                $profiel['School'] == null ? null : $schoolc->getById($profiel['School']),
                $profiel['Opleiding'] == null ? null : $opleidingc->getById($profiel['Opleiding']),
                new DateTime($profiel['Startdatumopleiding']),
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
                new DateTime($profiel['Geboortedatum']),
                $profiel['Telefoonnummer'] == null ? "" : $profiel['Telefoonnummer']);
            $ProfielArray [] = $profiel;
        }
        return $ProfielArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(int $GebruikerID,?School $School,?Opleiding $Opleiding,string $Startdatumopleiding,string $Status,
        string $Achternaam,string $Voornaam,string $Tussenvoegsel,string $Prefix,string $Straat,int $Huisnummer,
        string $Extentie,string $Postcode,string $Woonplaats,string $Geboortedatum,
        string $Telefoonnummer)
    {
        return $this->profielmodel->Add($GebruikerID,$School,$Opleiding,$Startdatumopleiding,$Status,$Achternaam,
            $Voornaam,$Tussenvoegsel,$Prefix,$Straat,$Huisnummer,$Extentie,$Postcode,$Woonplaats,$Geboortedatum,
            $Telefoonnummer);
    }

    function delete(int $Id){
        return $this->profielmodel->Delete($Id);
    }

    function update(Profiel $Profiel){
        return $this->profielmodel->Update($Profiel);
    }

    function getById(int $id): profiel{
        $profielmodel = new ProfielController();
        $Profiel = $profielmodel->GetById($id)->fetchAll(PDO::FETCH_ASSOC);
        $schoolcontroller = new SchoolController();
        $opleidingcontroller = new OpleidingController();

        return new Profiel(
            $Profiel[0]['ProfielID'],
            $Profiel[0]['GebruikerID'],
            $schoolcontroller->getById($Profiel[0]['School']),
            $opleidingcontroller->getById($Profiel[0]['Opleiding']),
            new DateTime($Profiel[0]['Startdatumopleiding']),
            $Profiel[0]['Status'],
            $Profiel[0]['Achternaam'],
            $Profiel[0]['Voornaam'],
            $Profiel[0]['Tussenvoegsel'],
            $Profiel[0]['Prefix'],
            $Profiel[0]['Straat'],
            $Profiel[0]['Huisnummer'],
            $Profiel[0]['Extentie'],
            $Profiel[0]['Postcode'],
            $Profiel[0]['Woonplaats'],
            new DateTime($Profiel[0]['Geboortedatum']),
            $Profiel[0]['Telefoonnummer']);

    }

    function getByGebruikerID()
    {
        var_dump($this->gebruikerID);
        $profielmodel = new ProfielModel($this->gebruikerID);
        var_dump($profielmodel);
        $Profielc =$profielmodel->getByGebruikerID($this->gebruikerID)->fetchAll(PDO::FETCH_ASSOC);
        if (!isset($Profielc) || $Profielc == false)
            return null;//Profile does not exist
        $schoolcontroller = new SchoolController();
        $opleidingcontroller = new OpleidingController();

        return new Profiel(
            $Profielc['ProfielID'],
            $Profielc['GebruikerID'],
            $schoolcontroller->getById($Profielc['School']),
            $opleidingcontroller->getById($Profielc['Opleiding']),
            new DateTime($Profielc['Startdatumopleiding']),
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
            new DateTime($Profielc['Geboortedatum']),
            $Profielc['Telefoonnummer']);

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
