<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
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
        <a href="View.php">Terug</a>
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

//validatie client and serverside. https://stackoverflow.com/questions/8780436/user-input-validation-client-side-or-server-side-php-js?
//dus de invoer checken met javascript maar ook in de controler controleren serverside.

echo "<h1 class=\"h1profiel\"> Aanmaken login gegevens</h1 ><br>
<div class=\"divprofiel\">
<form action = \"Add.php\" method = \"post\" class=\"profielform\" >

    <div class='gebruikerlabel'>Gebruikersnaam *</div>
        <div class='gebruikerinput'><input type = \"text\" name=\"GebruikersNaam\" value=\"";
if (isset($_POST["GebruikersNaam"])) echo $_POST["GebruikersNaam"];
echo "\"/>
        </div><span class='gebruikersinput'>$NaamErr</span>
    <div class='gebruikerlabel'>Email *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Email\" value=\"";
if (isset($_POST["Email"])) echo $_POST["Email"];
echo "\"/></div>
         <span class='gebruikersinput'>$EmailErr</span>
    <div class='gebruikerlabel'>Wachtwoord *</div>
         <div class='gebruikerinput'><input type = \"password\" name=\"Wachtwoord\" value=\"";
if (isset($_POST["Wachtwoord"])) echo $_POST["Wachtwoord"];
echo "\"/></div>
         <span class='gebruikersinput'>$WachtwoordErr</span>
    <div class='gebruikerlabel'>Wachtwoord controle *</div>
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

        echo "Record niet opgeslagen.";
        if ($NaamErr != "")
            echo "<br>".$NaamErr;
        if ($EmailErr != "") echo "<br>".$EmailErr;
        if ($WachtwoordErr != "") echo "<br>".$WachtwoordErr;
    }
}

?>
<!--kunnen we hier niet een codesnippet/subpagina van maken-->
</div>
<div class="footer">
    <div>© Student Services, 2020
        <?php
        $GebrID = 1;
        echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";

        ?>
    </div>
</div>
<!--kunnen we hier niet een codesnippet/subpagina van maken-->
</body>
</html>