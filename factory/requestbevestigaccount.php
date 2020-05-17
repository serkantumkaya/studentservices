<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/factory/VerficatieModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/factory/sendEmail.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/GebruikerModel.php");

if (isset($_POST['vertifycode']) && isset($_POST['username']) && isset($_POST['email'])){
    // var_dump("test");
    $gebruikermodel = new GebruikerModel();
    $verficateemail = new createEmail();
    $vertifycode    = $_POST['vertifycode'];
    $email          = $_POST['email'];
    $username       = $_POST['username'];
    if (!empty($verficateemail->dataaccessmodel->getuser($username, $vertifycode[1]))){
        // $Wachtwoord = $verficateemail->dataaccessmodel->getuserpassword($username, $vertifycode[1]);
        // $Wachtwoord = $Wachtwoord["Wachtwoord"];
        date_default_timezone_set(date_default_timezone_get()); //voor het bepalen van de tijd
        if (empty($gebruikermodel->getByGebruikersNaam($username))){
            if ($gebruikermodel->Add($username,
                    $verficateemail->dataaccessmodel->getuserpassword($username, $vertifycode[1])["Wachtwoord"],
                    $email) &&
                (strtotime(date('m/d/Y h:i:s a', time()))-
                    strtotime($verficateemail->dataaccessmodel->getuser($username, $vertifycode[1])["Timestamp"])<=
                    100)){

                $status   = "success";
                $response = "account aanmelden is gelukt";
                $verficateemail->dataaccessmodel->delete(($verficateemail->dataaccessmodel->getuser($username,
                    $vertifycode[1])["UserID"]));
            } else{
                $status   = "failed";
                $response = "bevestigings link is verlopen";
            }


        } else{
            $status   = "failed";
            $response = "bevestigen account is niet gelukt. gebruiker bestaat niet";
            $verficateemail->dataaccessmodel->delete(($verficateemail->dataaccessmodel->getuser($username,
                $vertifycode[1])["UserID"]));
        }
    } else{
        $status   = "failed";
        $response = "bevestigen account is niet gelukt. gebruiker bestaat niet";
    }
    // $status = "success";
    //$response = ($verficateemail->dataaccessmodel->getuser($username, $vertifycode[1]))["UserID"];
    exit(json_encode(array("status" => $status, "response" => $response)));
}


