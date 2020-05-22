<?php
session_start();
class Translate
{
    static  $NLTranslations = [
        "RememberMe" => "Onthoud mij",
        "GoodButNoLogin" => "Je wachtwoord was goed echter werkt het doorverwijzen nog niet!",
        "LoginIncorrect" => "De combinatie van gebruiker en/of wachtwoord is onjuist.",
        "UserNameLabel" => "Gebruikersnaam:",
        "PasswordLabel" => "Wachtwoord:"
    ];

    static $ENTranslations = [
        "RememberMe" => "Remember me",
        "GoodButNoLogin" => "You're credentials were correct. Only the next page is not responding.!",
        "LoginIncorrect" => "De combination of user and/or password is incorrect.",
        "UserNameLabel" => "User:",
        "PasswordLabel" => "Password:"
    ];

    public static function GetTranslation(string $key) : string
    {
        if (!isset($_SESSION["Language"])) $_SESSION["Language"] = "NL";//NL is the default!
        if ($_SESSION["Language"] == "NL") return self::$NLTranslations[$key];
        if ($_SESSION["Language"] == "EN") return self::$ENTranslations[$key];
    }


}
?>

