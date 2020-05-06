<?php
//Create gebruiker en create login in 1 screen, because some fields of the gebruiker object are required.
//that's why you can't seperate the screens. Otherwise you will have to split the tables into login en gebruiker.
//DON'T fill in empty strings in required fields just to fill them. This is against all rules of integrity!
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Enum/EnumGebruikerStatus.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
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
        <a href="/StudentServices/inlogPag.php">Terug</a>
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
$VoornaamErr = "";
$AchternaamErr = "";
$StraatErr = "";
$HuisnummerErr = "";
$PostcodeErr = "";
$WoonplaatsErr = "";
$noerror = true;

//dit moet javascript worden?
if (isset($_POST["WachtwoordCheck"]) && isset($_POST["Wachtwoord"]) && $_POST["WachtwoordCheck"] != isset($_POST["Wachtwoord"]))
{
    $WachtwoordErr = "Wachtwoorden zijn niet gelijk";
    $WachtwoordCheckErr = "Wachtwoorden zijn niet gelijk";
    $noerror = false;
}
if (!isset($_POST[""]) || isset($_POST["Gebruikersnaam"]) =="")
{
    $WachtwoordCheckErr = "Gebruikersnaam is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Email"]) || isset($_POST["Email"]) =="")
{
    $WachtwoordCheckErr = "Email is verplicht.";
    $noerror = false;
}
if (!isset($_POST["WachtwoordCheck"]) || isset($_POST["WachtwoordCheck"]) =="")
{
    $WachtwoordCheckErr = "Wachtwoord check is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Wachtwoord"]) || isset($_POST["Wachtwoord"]) =="")
{
    $WachtwoordCheckErr = "Wacthwoord is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Voornaam"]) || isset($_POST["Voornaam"]) =="")
{
    $VoornaamErr = "Voornaam is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Achternaam"]) || isset($_POST["Achternaam"]) =="")
{
    $AchternaamErr = "Achternaam is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Straat"]) || isset($_POST["Straat"]) =="")
{
    $StraatErr = "Straat is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Huisnummer"]) || isset($_POST["Huisnummer"]) =="")
{
    $HuisnummerErr = "Huisnummer is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Postcode"]) || isset($_POST["Postcode"]) =="")
{
    $PostcodeErr = "Postcode is verplicht.";
    $noerror = false;
}
if (!isset($_POST["Woonplaats"]) || isset($_POST["Woonplaats"]) =="")
{
    $WoonplaatsErr = "Woonplaats is verplicht.";
    $noerror = false;
}


echo "<h1 > Aanmaken login gegevens</h1 ><br>
<form action = \"Add.php\" method = \"post\" >

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
 <div class='gebruikerlabel'>Extentie</div>
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
         
    <!--School-->
 <div class='gebruikerlabel'>School</div>
    <select name=\"School\" class='gebruikerinput'>";
        $School = new SchoolController();
        foreach($School->GetScholen() as $sh)
        {
            $schoolid = $sh->getSchoolID();
            $schoolnaam = $sh->getSchoolnaam();
            echo "<option value=\"$schoolid\">$schoolnaam</option>";
        }
   echo"</select>
    
    <!--Opleiding-->
     <div class='gebruikerlabel'>Opleiding</div>
    <select name=\"Opleiding\" class='gebruikerinput'>";
        $Opleiding = new OpleidingController();
        foreach($Opleiding->GetOpleidingen() as $op)
        {
            $opleidingid = $op->getOpleidingID();
            $naamopleiding = $op->getNaamopleiding();
            echo "<option value=\"$opleidingid\">$naamopleiding</option>";
        }
   echo"</select>
                   <!--Startdatumopleiding-->
 <div class='gebruikerlabel'>Startdatumopleiding</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Startdatumopleiding\" value=\"";
if (isset($_POST["Startdatumopleiding"])) echo $_POST["Startdatumopleiding"];

echo "\"/>
</div>

  <!--foto-->
 <div class='gebruikerlabel'>Foto</div><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" class=\"gebruikerinput\">
  <div class='gebruikerlabel'>Huidige foto</div>
<img id=\"nieuwestudent\" src=\"/StudentServices/images/sgtest.jpg\" class=\"studentfoto\"/>




 <div class='gebruikerlabel'>Status</div>
<select name=\"Status\">";
        $Status = new EnumGebruikerStatus();
        foreach($Status->getConstants() as $st)
        {
            echo "<option value=\"$st\">$st</option>";
        }
echo"</select>
    
 <!--Telefoonnummer-->
 <div class='gebruikerlabel'>Telefoonnummer</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Telefoonnummer\" value=\"";
        if (isset($_POST["Telefoonnummer"])) echo $_POST["Telefoonnummer"];
echo "\"></div>
       <input type=\"submit\" >  <br><br><br>
    </form >";
if ($noerror)//No validation errors
{
    $gebruikercontroller= new GebruikerController();

    if ($gebruikercontroller->Add(
        $_POST["Gebruikersnaam"],
        $_POST["Wachtwoord"],
        $_POST["Email"],
        $_POST["School"],
        $_POST["Opleiding"],
        $_POST["Startdatumopleiding"],
        $_POST["Status"],
        $_POST["Achternaam"],
        $_POST["Voornaam"],
        $_POST["Tussenvoegsel"],
        $_POST["Prefix"],
        $_POST["Straat"],
        $_POST["Huisnummer"],
        $_POST["Extentie"],
        $_POST["Postcode"],
        $_POST["Woonplaats"],
        $_POST["Geboortedatum"],
        $_POST["Telefoonnummer"]
        ))
    {
        echo "Record opgeslagen";
        //header("Location: /StudentServices/InlogPag.php");
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