<?php
session_start();
//put your translations here
//USE English keys! Be professional.
class Translate
{
    //NL,EN
    static  $Translations = [
        "inlogPagRememberMe" => ["Onthoud mij","Remember me"],
        "inlogPagGoodButNoLogin" => ["Je wachtwoord was goed echter werkt het doorverwijzen nog niet!",
            "Your credentials were correct. Only the next page is not responding.!"],
        "inlogPagLoginIncorrect" => ["De combinatie van gebruiker en/of wachtwoord is onjuist.",
            "De combination of user and/or password is incorrect."],
        "inlogPagUserNameLabel" => ["Gebruikersnaam:","User:"],
        "inlogPagPasswordLabel" => ["Wachtwoord:","Password:"],
        "inlogPagForgotPassword" => ["Wachtwoord vergeten","Forgot password"],
        "inlogRegister" => ["Registreren","Register"],
        "inlogSubmit" => ["Log in","Log on"],
    ];

    public static function GetTranslation(string $key) : string
    {
        if (!isset($_SESSION["Language"])) $_SESSION["Language"] = "NL";//NL is the default!
        if ($_SESSION["Language"] == "NL") return self::$Translations[$key][0];
        if ($_SESSION["Language"] == "EN") return self::$Translations[$key][1];
    }


}
?>

