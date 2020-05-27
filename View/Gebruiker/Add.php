<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href=/images/StudentServices.ico" />
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen gebruiker" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
    <link rel="stylesheet" href="/StudentServices/css/Profiel.css">
    <script type="text/javascript" src="/StudentServices/JS/bevestigenaccount.js"></script>
    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>

</head>


<body>
<div class="header">
    <nav id="page-nav">
        <!-- [THE HAMBURGER] -->
        <label for="hamburger">&#9776;</label>
        <input type="checkbox" id="hamburger"/>

        <!-- [MENU ITEMS] -->
        <ul>
            <li>
                <a href="/StudentServices/inlogPag.php">Terug</a>
            </li>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<div class="slider">
    <div class="popup" id="test"> <!--niet aanzitten is voor de popup-->
        <span class="popuptext" id="myPopup"></span>
    </div>
</div>

<div class="info">
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
</div>
</body>
</html>