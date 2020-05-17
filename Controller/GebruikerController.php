<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/GebruikerModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Gebruiker.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/OpleidingController.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class GebruikerController
{
    private GebruikerModel $gebruikermodel;
    private string $OriginalUserName;

    public function __construct($ID){
        $this->gebruikermodel = new GebruikerModel($ID);
        $this->ID             = $ID;
    }

    /**
     * @return string
     */
    public function getOriginalUserName(): string{
        return $this->OriginalUserName;
    }

    /**
     * @param string $OriginalUserName
     */
    public function setOriginalUserName(string $OriginalUserName): void{
        $this->OriginalUserName = $OriginalUserName;
    }

    public function getGebruikers(){
        $GebruikerArray = [];
        foreach ($this->gebruikermodel->getGebruikers() as $gebruiker){

            $gebruiker         = new Gebruiker(
                $gebruiker['GebruikerID'],
                $gebruiker['Gebruikersnaam'],
                $gebruiker['Wachtwoord'],
                $gebruiker['Email'] == null ? "" : $gebruiker['Email'],
            );
            $GebruikerArray [] = $gebruiker;
        }
        return $GebruikerArray;
    }

    function Add(string $Gebruikersnaam, string $Wachtwoord, string $WachtwoordCheck, string $Email): array{

        $Errorsfound = [
            "Errorsfound" => "",
            "Gebruikersnaam" => "",
            "Wachtwoord" => "",
            "Email" => ""];
        if ($Wachtwoord != $WachtwoordCheck || empty($Wachtwoord) || empty($WachtwoordCheck)){
            $Errorsfound["Wachtwoord"]  = "De wachtwoorden zijn niet gelijk of 1 van de wachtwoorden is leeg.<br>";
            $Errorsfound["Errorsfound"] = "true";
        }
        if ($Gebruikersnaam == ""){
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is verplicht.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if ($this->gebruikermodel->getByGebruikersNaam($Gebruikersnaam)){
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is al reeds gebruikt. Kies een andere gebruikersnaam.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if (preg_match('/[^a-zA-Z\d]/', $Gebruikersnaam)){
            $Errorsfound["Gebruikersnaam"] .= "De gebruikernaam is ongeldig. Gebruik geen leestekens of spaties.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }
        if (empty($Email)){
            $Errorsfound["Email"]       = "Email is verplicht.<br>";
            $Errorsfound["Errorsfound"] = "true";
        }
        if (!empty($Errorsfound["Wachtwoord"]) || !empty($Errorsfound["Gebruikersnaam"]) ||
            !empty($Errorsfound["Email"])){
            return $Errorsfound;
        }

        if ($Errorsfound["Errorsfound"] == ""){
            //This is what a controller does. You pass your 2nd password for validation. But is it not needed in the add of the model.
            $this->gebruikermodel->Add($Gebruikersnaam,
                $Wachtwoord,
                $Email);

            return $Errorsfound;
        }
        return $Errorsfound;
    }

    function delete(int $Id){
        return $this->gebruikermodel->Delete($Id);
    }

    function update(Gebruiker $Gebruiker): array{
        $Errorsfound = [
            "Errorsfound" => "",
            "Gebruikersnaam" => "",
            "Email" => ""];

        if ($Gebruiker->getGebruikersnaam() == ""){
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is verplicht.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if ($this->gebruikermodel->getByGebruikersNaam($Gebruiker->getGebruikersnaam()) &&
            $Gebruiker->getGebruikersnaam() != $this->OriginalUserName){
            $Errorsfound["Gebruikersnaam"] = "Gebruikersnaam is al reeds gebruikt. Kies een andere gebruikersnaam.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if (preg_match('/[^a-zA-Z\d]/', $Gebruiker->getGebruikersnaam())){
            $Errorsfound["Gebruikersnaam"] .= "De gebruikernaam is ongeldig. Gebruik geen leestekens of spaties.<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }
        if (empty($Gebruiker->getEmail())){
            $Errorsfound["Email"]       = "Email is verplicht.<br>";
            $Errorsfound["Errorsfound"] = "true";
        }
        if ($Errorsfound["Errorsfound"] == ""){
            $this->gebruikermodel->Update($Gebruiker->getGebruikerID(), $Gebruiker->getGebruikersnaam(),
                $Gebruiker->getEmail());
        }
        return $Errorsfound;
    }

    function getById(int $id = null): gebruiker{
        if (isset($this->ID) && $this->ID != -1){
            $id = $this->ID;
        }
        $Gebruiker = $this->gebruikermodel->Get($id);

        return new Gebruiker(
            $Gebruiker['GebruikerID'],
            $Gebruiker['Gebruikersnaam'], "",
            $Gebruiker['Email']);
    }

    function CheckUserName(string $UserName): bool{
        return !empty($this->gebruikermodel->GetByName($UserName));
    }

    function checkRechten(){
        $level = $this->gebruikermodel->checkRechten();
        if ($level == false){ //indien niet bestaat, level 1 terugsturen.
            return 1;
        } else{
            return intval($level['level']);
        }
        //var_dump($this->gebruikermodel->checkRechten());
    }

    /**
     * @param string $GebruikersNaam
     * @param string $Password
     * @return Gebruiker
     */

    function Validate(string $GebruikersNaam, string $Password): Gebruiker{
        $Gebruiker = $this->gebruikermodel->Validate($GebruikersNaam, $Password);

        if (!empty($Gebruiker)){
            return new Gebruiker(
                $Gebruiker['GebruikerID'],
                $Gebruiker['GebruikersNaam'],
                $Gebruiker['Wachtwoord'],
                $Gebruiker['Email']);
        }
        return new Gebruiker(-1, "", "", "");
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
