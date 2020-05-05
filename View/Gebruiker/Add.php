//Create gebruiker en create login in 1 screen, because some fields of the gebruiker object are required.
//that's why you can't seperate the screens. Otherwise you will have to spit the tables into login en gebruiker.
//DON'T fill in empty strings in required fields just to fill them. This is against all rules of integrity.
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Enum/EnumGebruikerStatus.php");
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen gebruiker" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">

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
        <a href="./View.php">Terug</a>
    </li>
</ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>

<div class="info">
<!--kunnen we van bovenstaande niet een codesnippet/subpagina van maken-->

<?php
$NaamErr = "";
$EmailErr = "";
$WachtwoordErr = "";
$WachtwoordCheckErr = "";

if (isset($_POST["WachtwoordCheck"]) && isset($_POST["Wachtwoord"]) && $_POST["WachtwoordCheck"] != isset($_POST["Wachtwoord"]))
{
    $WachtwoordErr = "Wachtwoorden zijn niet gelijk";
    $WachtwoordCheckErr = "Wachtwoorden zijn niet gelijk";
}
else if (isset($_POST[""]) && isset($_POST["Gebruikersnaam"]) =="")
{
    $WachtwoordCheckErr = "Gebruikersnaam is verplicht.";
}
else if (isset($_POST["Email"]) && isset($_POST["Email"]) =="")
{
    $WachtwoordCheckErr = "Email is verplicht.";
}
else if (isset($_POST["WachtwoordCheck"]) && isset($_POST["WachtwoordCheck"]) =="")
{
    $WachtwoordCheckErr = "Wachtwoord check is verplicht.";
}
else if (isset($_POST["Wachtwoord"]) && isset($_POST["Wachtwoord"]) =="")
{
    $WachtwoordCheckErr = "Wacthwoord is verplicht.";
}

echo "<h1 > Aanmaken login gegevens</h1 ><br>
<form action = \"AddLogin.php\" method = \"post\" >

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
         <!--Voornaam-->
    <div class='gebruikerlabel'>Voornaam *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Voornaam\" value=\"";
if (isset($_POST["Voornaam"])) echo $_POST["Voornaam"];
echo "\"/></div>
         <span class='gebruikersinput'>$VoornaamErr</span>
         <!--Tussenvoegsel-->
<div class='gebruikerlabel'>Tussenvoegsel</div>
         <div class='gebruikerinput'><input type = \"password\" name=\"Tussenvoegsel\" value=\"";
if (isset($_POST["Tussenvoegsel"])) echo $_POST["Tussenvoegsel"];
echo "\" /></div>
         <!--Achternaam-->
    <div class='gebruikerlabel'>Achternaam *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Achternaam\" value=\"";
if (isset($_POST["Achternaam"])) echo $_POST["Achternaam"];
echo "\"/></div>
         <span class='gebruikersinput'>$AchternaamErr</span>   
    <!--Straat-->
 <div class='gebruikerlabel'>Straat *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Straat\" value=\"";
if (isset($_POST["Straat"])) echo $_POST["Straat"];
echo "\"/></div>
         <span class='gebruikersinput'>$StraatErr</span>
         
    <!--Huisnummer-->
 <div class='gebruikerlabel'>Huisnummer *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Huisnummer\" value=\"";
if (isset($_POST["Huisnummer"])) echo $_POST["Huisnummer"];
echo "\"/></div>
         <span class='gebruikersinput'>$HuisnummerErr</span>

        <!--Extentie-->
 <div class='gebruikerlabel'>Extentie *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Extentie\" value=\"";
if (isset($_POST["Extentie"])) echo $_POST["Extentie"];
echo "\"/></div>
         

<!--Postcode-->
 <div class='gebruikerlabel'>Postcode *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Postcode\" value=\"";
if (isset($_POST["Postcode"])) echo $_POST["Postcode"];
echo "\"/></div>
         <span class='gebruikersinput'>$PostcodeErr</span>
         
     <!--Woonplaats-->
 <div class='gebruikerlabel'>Woonplaats *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Woonplaats\" value=\"";
if (isset($_POST["Woonplaats"])) echo $_POST["Woonplaats"];
echo "\"/></div>
         <span class='gebruikersinput'>$WoonplaatsErr</span>
        
                <!--Geboortedatum-->
 <div class='gebruikerlabel'>Geboortedatum</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Geboortedatum\" value=\"";
if (isset($_POST["Geboortedatum"])) echo $_POST["Geboortedatum"];
echo "\"/></div>
         
         

    private ?School $School;
    private ?Opleiding $Opleiding;
    

                   <!--Startdatumopleiding-->
 <div class='gebruikerlabel'>Startdatumopleiding</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Startdatumopleiding\" value=\"";
if (isset($_POST["Startdatumopleiding"])) echo $_POST["Startdatumopleiding"];
echo "\"/></div>
 
  <!--foto-->
 <div class='gebruikerlabel'>Foto</div>


    private string $Status;
    
 <!--Telefoonnummer-->
 <div class='gebruikerlabel'>Telefoonnummer</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Telefoonnummer\" value=\"";
if (isset($_POST["Telefoonnummer"])) echo $_POST["Telefoonnummer"];
echo "\"/></div>

    
    <input type = \"submit\" >
    </form >";


    


if (isset($_POST["GebruikersNaam"]) && isset($_POST["Email"]) && isset($_POST["Wachtwoord"]))
{
    $gebruikercontroller= new GebruikerController();

    if ($gebruikercontroller->CreateNewUser($_POST["GebruikersNaam"],$_POST["Email"] ,$_POST["Wachtwoord"]))
    {
        //header("Location: /StudentServices/View/Gebruiker/View.php");
    }
    else
    {
        echo "Record niet opgeslagen";
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