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
    private ProfielModel $profielmodel;
    private int $ebruikerID;

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

    ////voor parameters bindparam gebruiken. Named parameters
    //function add(int $GebruikerID,?School $School,?Opleiding $Opleiding,string $Startdatumopleiding,string $Status,
    //    string $Achternaam,string $Voornaam,string $Tussenvoegsel,string $Prefix,string $Straat,int $Huisnummer,
    //    string $Extentie,string $Postcode,string $Woonplaats,string $Geboortedatum,
    //    string $Telefoonnummer)
    //{
    //    return $this->profielmodel->Add($GebruikerID,$Achternaam,
    //        $Voornaam,$Straat,$Huisnummer,$Postcode,$Woonplaats);
    //}


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
        $Profiel = $this->profielmodel->GetById($id)->fetchAll(PDO::FETCH_ASSOC);
        return new Profiel(
            $Profiel[0]['ProfielID'],
            $Profiel[0]['Wachtwoord'],
            $Profiel[0]['Email'],
            $Profiel[0]['School'],
            $Profiel[0]['Opleiding'],
            $Profiel[0]['Startdatumopleiding'],
            $Profiel[0]['Foto'],
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
            $Profiel[0]['Geboortedatum'],
            $Profiel[0]['Telefoonnummer']);

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
