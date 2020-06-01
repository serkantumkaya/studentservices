<?php

require_once ("C:xampp/htdocs/StudentServices/Model/GebruikerModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Gebruiker.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/SchoolController.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/OpleidingController.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/sendEmail.php");
require_once ("C:xampp/htdocs/StudentServices/Includes/Translate/Translate.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class GebruikerController
{
    public GebruikerModel $gebruikermodel;
    private createEmail $verficateemail;
    private $randomusernumber = 0;
    private string $OriginalUserName;


    public function __construct($ID){
        $this->gebruikermodel = new GebruikerModel($ID);
        $this->verficateemail = new createEmail();
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
            $Errorsfound["Wachtwoord"]  = Translate::GetTranslation("gebruikerPasswordsNotEqual")."<br>";
            $Errorsfound["Errorsfound"] = "true";
        }
        if ($Gebruikersnaam == ""){
            $Errorsfound["Gebruikersnaam"] = Translate::GetTranslation("gebruikerUsernameIsrequired")."<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if (!empty($this->verficateemail->dataaccessmodel->getusername($Gebruikersnaam)['Username'])){
            if ($this->verficateemail->dataaccessmodel->getusername($Gebruikersnaam)['Username'] == $Gebruikersnaam){
                $Errorsfound["Gebruikersnaam"] =
                    Translate::GetTranslation("gebruikerUsernameInvalid")."<br>";
                $Errorsfound["Errorsfound"]    = "true";
            }

        }
        if ($this->gebruikermodel->getByGebruikersNaam($Gebruikersnaam)){
            $Errorsfound["Gebruikersnaam"] = Translate::GetTranslation("gebruikerUsernameInvalid")."<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if (preg_match('/[^a-zA-Z\d]/', $Gebruikersnaam)){
            $Errorsfound["Gebruikersnaam"] .= Translate::GetTranslation("gebruikerUsernameInvalid")."<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }
        if (empty($Email)){
            $Errorsfound["Email"]       = Translate::GetTranslation("gebruikerEmailIsrequired")."<br>";
            $Errorsfound["Errorsfound"] = "true";
        }

        if ($this->testEmail($Email)== false) {
            $Errorsfound["Email"]  = Translate::GetTranslation("gebruikerEmailInvalid");
        }

        if (!empty($Errorsfound["Wachtwoord"]) || !empty($Errorsfound["Gebruikersnaam"]) ||
            !empty($Errorsfound["Email"])){
            return $Errorsfound;
        }

        if ($Errorsfound["Errorsfound"] == ""){
            $this->randomusernumber = rand(111111111111, 999999999999);
            if ($this->verficateemail->sendEmail($Gebruikersnaam, $Wachtwoord, $Email, $this->randomusernumber)){

            } else{
                //   vardump($this->verficateemail->getemailerrorinfo());//hoe we met eventuele errors die terug komen van de klass email
            }

            return $Errorsfound;
        }
    }

    function delete(int $Id){
        return $this->gebruikermodel->Delete($Id);
    }

    function updateWachtwoord(Gebruiker $Gebruiker): bool{
           return $this->gebruikermodel->UpdateWachtwoord($Gebruiker->getGebruikerID(), $Gebruiker->getWachtwoord());

    }

    function update(Gebruiker $Gebruiker): array{
        $Errorsfound = [
            "Errorsfound" => "",
            "Gebruikersnaam" => "",
            "Email" => ""];

        if ($Gebruiker->getGebruikersnaam() == ""){
            $Errorsfound["Gebruikersnaam"] = Translate::GetTranslation("gebruikerUsernameIsrequired")."<br>";
            $Errorsfound["Errorsfound"]    = "true";
        }

        if (empty($Gebruiker->getEmail())){
            $Errorsfound["Email"]       = Translate::GetTranslation("gebruikerEmailIsrequired")."<br>";
            $Errorsfound["Errorsfound"] = "true";
        }

        if ($this->testEmail($Gebruiker->getEmail())== false) {
            $Errorsfound["Email"]  = $Errorsfound["Email"]  + " " + Translate::GetTranslation("gebruikerEmailInvalid");
        }

        if ($Errorsfound["Errorsfound"] == ""){

            $this->gebruikermodel->Update($Gebruiker->getGebruikerID(), $Gebruiker->getGebruikersnaam(),
                $Gebruiker->getEmail());
        }
        return $Errorsfound;
    }


    private function testEmail($email) : bool
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return True;
        } else {
        return False;
        }
    }

        /**
     *
     * @param int|null $id
     * @return gebruiker
     */


    function getById(int $id = null): gebruiker{
        if ($id == null && isset($this->ID) && $this->ID != -1){
            $id = $this->ID;
        }

        $Gebruiker = $this->gebruikermodel->Get($id);

        return new Gebruiker(
            $Gebruiker['GebruikerID'],
            $Gebruiker['Gebruikersnaam'], "",
            $Gebruiker['Email']);
    }

    function getmail(): createEmail{
        return $this->verficateemail;
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
    }

    function Validate(string $GebruikersNaam, string $Password): Gebruiker
    {
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
}
