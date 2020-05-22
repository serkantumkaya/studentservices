<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/ProfielController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Enum/EnumGebruikerStatus.php");
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen profiel" content="index">
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
        <a href="/StudentServices/View.php">Terug</a>
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

$gbController = new GebruikerController($_SESSION["GebruikerID"]);
$gebruiker = $gbController->getById($_SESSION["GebruikerID"]);//in een session zetten werkt niet dan maar ophalen.

echo "Profiel aanmaken voor : ".$gebruiker->getGebruikersnaam()."<br>";

    //$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
   // echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();


echo "<h1 > Koppelen profiel</h1 ><br>
<form action = \"Add.php\" method = \"post\" >";

echo "<!--Voornaam-->
    <div class='profiellabel'>Voornaam *</div>
    <div class='profielinput'><input type = \"text\" name=\"Voornaam\" value=\""; if (isset($_POST["Voornaam"]))
            echo $_POST["Voornaam"];echo "\"/></div>
         <span class='profielsinput'>$VoornaamErr</span>";

echo "<!--Tussenvoegsel-->";
echo "<div class='profiellabel'>Tussenvoegsel</div>
         <div class='profielinput'><input type = \"text\" name=\"Tussenvoegsel\" value=\"";
if (isset($_POST["Tussenvoegsel"])) echo $_POST["Tussenvoegsel"];
echo "\" /></div>";

echo "<!--Prefix-->";
echo "<div class='profiellabel'>Prefix</div>
         <div class='profielinput'><input type = \"text\" name=\"Prefix\" value=\"";
if (isset($_POST["Prefix"])) echo $_POST["Prefix"];
echo "\" /></div>

         <!--Achternaam-->
    <div class='profiellabel'>Achternaam *</div>
         <div class='profielinput'><input type = \"text\" name=\"Achternaam\" value=\"";
if (isset($_POST["Achternaam"])) echo $_POST["Achternaam"];
echo "\"/></div>
         <span class='profielsinput'>$AchternaamErr</span>   
    <!--Straat-->
 <div class='profiellabel'>Straat *</div>
         <div class='profielinput'><input type = \"text\" name=\"Straat\" value=\"";
if (isset($_POST["Straat"])) echo $_POST["Straat"];
echo "\"/></div>
         <span class='profielsinput'>$StraatErr</span>
         
    <!--Huisnummer-->
 <div class='profiellabel'>Huisnummer *</div>
         <div class='profielinput'><input type = \"text\" name=\"Huisnummer\" value=\"";
if (isset($_POST["Huisnummer"])) echo $_POST["Huisnummer"];
echo "\"/></div>
         <span class='profielsinput'>$HuisnummerErr</span>

        <!--Extentie-->
 <div class='profiellabel'>Extensie</div>
         <div class='profielinput'><input type = \"text\" name=\"Extentie\" value=\"";
if (isset($_POST["Extentie"])) echo $_POST["Extentie"];
echo "\"/></div>
         

<!--Postcode-->
 <div class='profiellabel'>Postcode *</div>
         <div class='profielinput'><input type = \"text\" name=\"Postcode\" value=\"";
if (isset($_POST["Postcode"])) echo $_POST["Postcode"];
echo "\"/></div>
         <span class='profielsinput'>$PostcodeErr</span>
         
     <!--Woonplaats-->
 <div class='profiellabel'>Woonplaats *</div>
         <div class='profielinput'><input type = \"text\" name=\"Woonplaats\" value=\"";
if (isset($_POST["Woonplaats"])) echo $_POST["Woonplaats"];
echo "\"/></div>
         <span class='profielsinput'>$WoonplaatsErr</span>
        
                <!--Geboortedatum-->
 <div class='profiellabel'>Geboortedatum</div>
         <div class='profielinput'><input type = \"text\" name=\"Geboortedatum\" value=\"";
if (isset($_POST["Geboortedatum"])) echo $_POST["Geboortedatum"];
echo "\"/></div>
         
    <!--School-->
 <div class='profiellabel'>School</div>
    <select name=\"School\" class='profielinput'>";
        $School = new SchoolController();
        foreach($School->GetScholen() as $sh)
        {
            $schoolid = $sh->getSchoolID();
            $schoolnaam = $sh->getSchoolnaam();
            echo "<option value=\"$schoolid\">$schoolnaam</option>";
        }
   echo"</select>
    
    <!--Opleiding-->
     <div class='profiellabel'>Opleiding</div>
    <select name=\"Opleiding\" class='profielinput'>";
        $Opleiding = new OpleidingController();
        foreach($Opleiding->GetOpleidingen() as $op)
        {
            $opleidingid = $op->getOpleidingID();
            $naamopleiding = $op->getNaamopleiding();
            echo "<option value=\"$opleidingid\">$naamopleiding</option>";
        }
   echo"</select>
                   <!--Startdatumopleiding-->
 <div class='profiellabel'>Startdatumopleiding</div>
         <div class='profielinput'><input type = \"text\" name=\"Startdatumopleiding\" value=\"";
if (isset($_POST["Startdatumopleiding"])) echo $_POST["Startdatumopleiding"];

echo "\"/>
</div>

  <!--foto-->
 <div class='profiellabel'>Foto</div><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" class=\"profielinput\">
  <div class='profiellabel'>Huidige foto</div>
<img id=\"nieuwestudent\" src=\"/StudentServices/images/sgtest.jpg\" class=\"studentfoto\"/>

 <div class='profiellabel'>Status</div>
<select name=\"Status\">";
        $Status = new EnumGebruikerStatus();
        foreach($Status->getConstants() as $st)
        {
            echo "<option value=\"$st\">$st</option>";
        }
echo"</select>
    
 <!--Telefoonnummer-->
 <div class='profiellabel'>Telefoonnummer</div>
         <div class='profielinput'><input type = \"text\" name=\"Telefoonnummer\" value=\"";
        if (isset($_POST["Telefoonnummer"])) echo $_POST["Telefoonnummer"];
echo "\"></div>
       <input type=\"submit\" >  <br><br><br>
    </form >";

if ($noerror)//No validation errors
{

    $profielcontroller= new ProfielController($gebruiker->getGebruikerID());
    $schoolcontroller= new SchoolController();
    $opleidingcontroller= new OpleidingController();

    if ($profielcontroller->Add(
        $gebruiker->getGebruikerID(),
        $schoolcontroller->getById($_POST["School"]) ,
        $opleidingcontroller->getById($_POST["Opleiding"]),
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
        $_POST["Telefoonnummer"] == null ? "" : $_POST["Telefoonnummer"]
        ))
    {
        if ($_SESSION["level"]>=50)
        //echo "Record opgeslagen";
            header("Location: ".$_SERVER['DOCUMENT_ROOT']."/StudentServices/view.php");
        else
            //echo "Record opgeslagen";
            header("Location: ".$_SERVER['DOCUMENT_ROOT']."/StudentServices/edit.php");
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