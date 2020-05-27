<?php
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
        "inlogPagUserNameLabel" => ["Gebruikersnaam:","Username:"],
        "inlogPagPasswordLabel" => ["Wachtwoord:","Password:"],
        "inlogPagForgotPassword" => ["Wachtwoord vergeten","Forgot password"],
        "inlogRegister" => ["Registreren","Register"],
        "inlogSubmit" => ["Log in","Log on"],

        "gebruikerEmailInvalid" => ["Het emailadres is ongeldig.","Email is invalid."],
        "gebruikerEmailIsrequired" => ["Het emailadres is verplicht.","Email is required."],
        "gebruikerUsernameIsrequired" => ["De gebruikersnaam is verplicht.","Username is required."],
        "gebruikerUsernameInvalid" => ["De gebruikernaam is ongeldig. Gebruik geen leestekens of spaties."
            ,"The username is invalid. Do not use punctuation marks or spaces"],
        "gebruikerUsernameIsInUse" => ["Gebruikersnaam is al reeds gebruikt. Kies een andere gebruikersnaam.",
            "This username is already taken. Use another usename."],
        "gebruikerPasswordsNotEqual" => ["De wachtwoorden zijn niet gelijk.",
            "The passwords are not equal."],
        "gebruikerRecordNotSaved" => ["Record niet opgeslagen.","Record not saved"],
        "gebruikerCreateLogin" => ["Aanmaken login gegevens.","Create a login."],
        "gebruikerUsernameLabel" => ["Gebruikersnaam *","Username *"],
        "gebruikerEmailLabel" => ["Email *","Email *"],
        "gebruikerPasswordLabel" => ["Wachtwoord *","Password *"],
        "gebruikerPasswordLabelCheck" => ["Wachtwoord controle*","Password check*"],
    ];

    public static function GetTranslation(string $key) : string
    {
        if (!isset($_COOKIE["Language"])) $_COOKIE["Language"] = "NL";//NL is the default!
        if ($_COOKIE["Language"] == "NL") return self::$Translations[$key][0];
        if ($_COOKIE["Language"] == "EN") return self::$Translations[$key][1];
    }
}
?>

