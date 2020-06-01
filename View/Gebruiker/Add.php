<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
?>
<!DOCTYPE HTML>
<html>
<head>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");?>
<body>
<div class="header">

    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<div class="slider">
    <div class="popup" id="test"> <!--niet aanzitten is voor de popup-->
        <span class="popuptext" id="myPopup"></span>
    </div>
</div>

<nav id="menu">
    <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu cf">
        <li><a href="/StudentServices/inlogPag.php">Terug</a></a></li>
    </ul>
</nav>

<?php

$NaamErr = "";
$EmailErr = "";
$WachtwoordErr = "";
$WachtwoordCheckErr = "";

echo "<h1 class=\"h1profiel\">".Translate::GetTranslation("gebruikerCreateLogin")."</h1 ><br>
<div class=\"divprofiel\">
<form action = \"Add.php\" method = \"post\" class=\"profielform\" >

    <div class='gebruikerlabel'>".Translate::GetTranslation("gebruikerUsernameLabel")."</div>
        <div class='gebruikerinput'><input type = \"text\" name=\"GebruikersNaam\" value=\"";
if (isset($_POST["GebruikersNaam"])) echo $_POST["GebruikersNaam"];
echo "\"/>
        </div><span class='gebruikersinput'>$NaamErr</span>
    <div class='gebruikerlabel'>".Translate::GetTranslation("gebruikerEmailLabel")."</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Email\" value=\"";
if (isset($_POST["Email"])) echo $_POST["Email"];
echo "\"/></div>
         <span class='gebruikersinput'>$EmailErr</span>
    <div class='gebruikerlabel'>".Translate::GetTranslation("gebruikerPasswordLabel")."</div>
         <div class='gebruikerinput'><input type = \"password\" name=\"Wachtwoord\" value=\"";
if (isset($_POST["Wachtwoord"])) echo $_POST["Wachtwoord"];
echo "\"/></div>
         <span class='gebruikersinput'>$WachtwoordErr</span>
    <div class='gebruikerlabel'>".Translate::GetTranslation("gebruikerPasswordLabelCheck")."</div>
         <div class='gebruikerinput'><input type = \"password\" name=\"WachtwoordCheck\" value=\"";
if (isset($_POST["WachtwoordCheck"])) echo $_POST["WachtwoordCheck"];
echo "\" /></div>
         <span class='gebruikersinput'>$WachtwoordCheckErr</span>    

       <input type=\"submit\" >  <br><br><br>
    </form ></div>";

if (isset( $_POST["GebruikersNaam"]) && isset( $_POST["Wachtwoord"]) &&
isset( $_POST["WachtwoordCheck"]) && isset( $_POST["Email"]))//No validation errors
{
    $gebruikercontroller= new GebruikerController(-1);

    $answers = $gebruikercontroller->Add(

            $_POST["GebruikersNaam"],
            $_POST["Wachtwoord"],
            $_POST["WachtwoordCheck"],
            $_POST["Email"]
        );

    if ($answers["Errorsfound"] == "")
    {
        $_SESSION["GebruikerID"] = -1;
        header("Location:/StudentServices/Inlogpag.php?action=succes&content= verficatie email verstuurt gelukt");
    }
    else
    {
        //header("Location: /StudentServices/View/gebruiker/Add.php?action=failed&content= verficatie email versturen niet gelukt");
        $NaamErr = $answers["Gebruikersnaam"];
        $EmailErr = $answers["Email"];
        $WachtwoordErr = $answers["Wachtwoord"];

        echo Translate::GetTranslation("gebruikerRecordNotSaved");
        if ($NaamErr != "")
            echo "<br>".$NaamErr;
        if ($EmailErr != "") echo "<br>".$EmailErr;
        if ($WachtwoordErr != "") echo "<br>".$WachtwoordErr;
    }
}
?>
</body>
</html>