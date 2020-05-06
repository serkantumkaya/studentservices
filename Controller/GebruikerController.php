<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/GebruikerModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Gebruiker.php");
//require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Projecten.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class GebruikerController
{
    private GebruikerModel $gebruikermodel;

    public function __construct() {
        $this->gebruikermodel = new GebruikerModel();
    }

    public function GetGebruikers()
    {
        $GebruikerArray = [];
        foreach ($this->gebruikermodel->GetGebruikers()->fetchAll(PDO::FETCH_ASSOC) as $gebruiker)
        {

            $gebruiker = new Gebruiker(
                $gebruiker['GebruikerID'],
                $gebruiker['Gebruikersnaam'],
                $gebruiker['Wachtwoord'],
               $gebruiker['Email'] == null ? "" : $gebruiker['Email'],
                );
            $GebruikerArray [] = $gebruiker;
        }
        return $GebruikerArray ;
    }
    function Add(string $Gebruikersnaam,string $Wachtwoord,string $WachtwoordCheck,string $Email) : array
    {
        $Errorsfound = [
            "Gebruikersnaam" => "",
            "Wachtwoord" => "",
            "Email" => ""] ;
        if ($Wachtwoord != $WachtwoordCheck || empty($Wachtwoord) || empty($WachtwoordCheck))
        {
            $Errorsfound["Wachtwoord"] = "De wachtwoorden zijn niet gelijk of 1 van de wachtwoorden is leeg.<br>";
        }
        if ($Gebruikersnaam =="")
        {
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is verplicht.<br>";
        }

        if ($this->gebruikermodel->getByGebruikersNaam($Gebruikersnaam ))
        {
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is al reeds gebruikt. Kies een andere gebruikersnaam.<br>";
        }

        if (preg_match('/[^a-zA-Z\d]/',$Gebruikersnaam))
        {
            $Errorsfound["Gebruikersnaam"] += "De gebruikernaam is ongeldig. Gebruik geen leestekens of spaties.<br>";
        }
        if (empty($Email))
        {
            $Errorsfound["Email"] = "Email is verplicht.<br>";
        }
        if (!empty($Errorsfound["Wachtwoord"]) || !empty($Errorsfound["Gebruikersnaam"]) || !empty($Errorsfound["Email"]) )
        {
            return $Errorsfound;
        }
        //This is what a controller does. You pass your 2nd password for validation. But is it not needed in the add of the model.
        if ($this->gebruikermodel->Add($Gebruikersnaam,
            $Wachtwoord,
            $Email))
        {
            return $Errorsfound();
        }
    }

    function delete(int $Id)
    {
        return $this->gebruikermodel->Delete($Id);
    }

    function update(Gebruiker $Gebruiker)
    {
        return $this->gebruikermodel->Update($Gebruiker);
    }

    function getById(int $id) : gebruiker
    {
        $Gebruiker = $this->gebruikermodel->Get($id);
        return new Gebruiker(
            $Gebruiker['GebruikerID'],
            $Gebruiker['Gebruikernaam'],
            $Gebruiker['Wachtwoord'],
            $Gebruiker['Email']);
    }
    function CheckUserName(string $UserName) : bool
    {
        return !empty($this->gebruikermodel->GetByName($UserName));
    }

    //todo : maken als projecten af is. Met een koppeling heb je altijd een verzameling bij het gekoppelde object.
    //public function getProjectenByGebruiker()
    //{
    //    $res = $this->gebruikermodel->getProjectenByGebruiker()->fetchAll(PDO::FETCH_ASSOC);
    //    while($obj = mysqli_fetch_array($res)) {
    //        $projecten[] = new Project($obj,$this);
    //    }
    //    return $projecten;
    //}
}
