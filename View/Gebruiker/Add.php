
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
if (!isset($_POST["GebruikerNaam"]) && !isset($_POST["VoltijdDeeltijd"]))
{
echo "<h1 > Toevoegn gebruiker gegevens</h1 ><br>
<form action = \"Add.php\" method = \"post\" >

    <div class='gebruikerlabel'>Achternaam:</div>
        <div class='gebruikerinput'><input type = \"text\" name = \"Achternaam\" /></div>
    <div class='gebruikerlabel'>Voornaam:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Voornaam\" /></div>
    <div class='gebruikerlabel'>Tussenvoegsel:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Tussenvoegsel\" /></div>
    <div class='gebruikerlabel'>Prefix:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Prefix\" /></div>
    <div class='gebruikerlabel'>Straat:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Straat\" /></div>
    <div class='gebruikerlabel'>Huisnummer:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Huisnummer\" /></div><!--check voor alleen numeriek-->
    <div class='gebruikerlabel'>Extentie:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Extentie\" /></div>
    <div class='gebruikerlabel'>Postcode:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Postcode\" /></div>
    <div class='gebruikerlabel'>Woonplaats:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Woonplaats\" /></div>
    <div class='gebruikerlabel'>School:</div>
          <div class='gebruikerinput'><div class='gebruikerinput'><input type = \"text\" name = \"School\" /></div><!--popup selectie scherm van maken (php popup select list)-->
    <div class='gebruikerlabel'>Opleiding:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Opleiding\" /></div><!--popup selectie scherm van maken (php popup select list)-->
    <div class='gebruikerlabel'>Startdatumopleiding:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Email\" /><!--email regex op loslaten-->
        Foto:<input type = \"text\" name = \"Email\" /><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                    <input type=\"submit\" value=\"Upload Foto\" name=\"submit\"></div><!--file upload functie van maken. Misschien via plugins.-->
    <div class='gebruikerlabel'>Soort Opleiding</div>
      <div class='gebruikerinput'><select name=\"VoltijdDeeltijd\">";
        $voldeel = new EnumVoltijdDeeltijd();
        foreach($voldeel->getConstants() as $vd)
        {
            echo "<option value=\"$vd\">$vd</option>";
        }
   echo"</select></div>

    <div class='gebruikerlabel'>Geboortedatum:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Geboortedatum\" /></div><!--kalender van maken via plugins-->
    <div class='gebruikerlabel'>Telefoonnummer:</div>
         <div class='gebruikerinput'><input type = \"text\" name = \"Telefoonnummer\" /></div><!--check voor tel maken-->
    
    <input type = \"submit\" >
    </form >";
}

if ( isset($_POST["GebruikerNaam"]) && isset($_POST["VoltijdDeeltijd"]))
{
    $gebruikercontroller= new GebruikerController();
    if ($gebruikercontroller->add($_POST["GebruikerNaam"],$_POST["VoltijdDeeltijd"]))
    {
        header("Location: /StudentServices/View/Gebruiker/View.php");
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