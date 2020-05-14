
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
    <meta name="Toevoegen opleiding" content="index">
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

<!--kunnen we hier niet een codesnippet/subpagina van maken-->
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
        </form>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>

<div class="info">
    <!--kunnen we van bovenstaande niet een codesnippet/subpagina van maken-->

<?php
if (isset($_GET["ID"]))
{
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $profiel= $profielcontroller->getById($_GET["ID"]);
    $_SESSION["CurrentProfiel"] = $profiel;

    $GebruikersID =$profiel->getGebruikerID();
    $School =$profiel->getSchool();
    $Opleiding=$profiel->getOpleiding();
    $Startdatumopleiding=$profiel->getStartdatumopleiding();
    $Status=$profiel->getStatus();
    $Achternaam=$profiel->getAchternaam();
    $Voornaam=$profiel->getVoornaam();
    $Tussenvoegsel=$profiel->getTussenvoegsel();
    $Prefix=$profiel->getPrefix();
    $Straat=$profiel->getStraat();
    $Huisnummer=$profiel->getHuisnummer();
    $Extensie =$profiel->getExtentie();
    $Postcode=$profiel->getPostcode();
    $Woonplaats=$profiel->getWoonplaats();
    $Geboortedatum=$profiel->getGeboortedatum();
    $Telefoonnummer=$profiel->getTelefoonnummer();
}

#region [errorafhandeling]
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
#endregion

$gbController = new GebruikerController();
$gebruiker = $gbController->getById($_SESSION["GebruikerID"]);//in een session zetten werkt niet dan maar ophalen.

echo "Profiel aanmaken voor : ".$gebruiker->getGebruikersnaam()."<br>";

    //$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
   // echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();
{
 echo "<h1 > Koppelen profiel</h1 ><br>
<form action = \"Add.php\" method = \"post\" >";

echo "<!--Voornaam-->
    <div class='profiellabel'>Voornaam *</div>
    <div class='profielinput'><input type = \"text\" name=\"Voornaam\" value=\"";
            echo $Voornaam;
            echo "\"/></div>
         <span class='profielsinput'>$VoornaamErr</span>";

echo "<!--Tussenvoegsel-->";
echo "<div class='profiellabel'>Tussenvoegsel</div>
         <div class='profielinput'><input type = \"password\" name=\"Tussenvoegsel\" value=\"";
if (isset($_POST["Tussenvoegsel"])) echo $Tussenvoegsel;
echo "\" /></div>";

echo "<!--Prefix-->";
echo "<div class='profiellabel'>Prefix</div>
         <div class='profielinput'><input type = \"text\" name=\"Prefix\" value=\"";
if (isset($_POST["Prefix"])) echo $Prefix;
echo "\" /></div>

         <!--Achternaam-->
    <div class='profiellabel'>Achternaam *</div>
         <div class='profielinput'><input type = \"text\" name=\"Achternaam\" value=\"";
if (isset($_POST["Achternaam"])) echo $Achternaam;
echo "\"/></div>
         <span class='profielsinput'>$AchternaamErr</span>   
    <!--Straat-->
 <div class='profiellabel'>Straat *</div>
         <div class='profielinput'><input type = \"text\" name=\"Straat\" value=\"";
if (isset($_POST["Straat"])) echo $Straat;
echo "\"/></div>
         <span class='profielsinput'>$StraatErr</span>
         
    <!--Huisnummer-->
 <div class='profiellabel'>Huisnummer *</div>
         <div class='profielinput'><input type = \"text\" name=\"Huisnummer\" value=\"";
if (isset($_POST["Huisnummer"])) echo $Huisnummer;
echo "\"/></div>
         <span class='profielsinput'>$HuisnummerErr</span>

        <!--Extentie-->
 <div class='profiellabel'>Extensie</div>
         <div class='profielinput'><input type = \"text\" name=\"Extensie\" value=\"";
if (isset($_POST["Extensie"])) echo $Extensie;
echo "\"/></div>
         

<!--Postcode-->
 <div class='profiellabel'>Postcode *</div>
         <div class='profielinput'><input type = \"text\" name=\"Postcode\" value=\"";
if (isset($_POST["Postcode"])) echo $Postcode;
echo "\"/></div>
         <span class='profielsinput'>$PostcodeErr</span>
         
     <!--Woonplaats-->
 <div class='profiellabel'>Woonplaats *</div>
         <div class='profielinput'><input type = \"text\" name=\"Woonplaats\" value=\"";
if (isset($_POST["Woonplaats"])) echo $Woonplaats;
echo "\"/></div>
         <span class='profielsinput'>$WoonplaatsErr</span>
        
                <!--Geboortedatum-->
 <div class='profiellabel'>Geboortedatum</div>
         <div class='profielinput'><input type = \"text\" name=\"Geboortedatum\" value=\"";
if (isset($_POST["Geboortedatum"])) echo $Geboortedatum;
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
if (isset($_POST["Startdatumopleiding"])) echo $Startdatumopleiding;

echo "\"/>
</div>

  <!--foto-->
 <div class='profiellabel'>Foto</div><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" class=\"profielinput\">
  <div class='profiellabel'>Huidige foto</div>
<img id=\"nieuwestudent\" src=\"/StudentServices/images/studenten/ss3.png\" class=\"studentfoto\"/>




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
        if (isset($_POST["Telefoonnummer"])) echo $Telefoonnummer;
echo "\"></div>
       <input type=\"submit\" >  <br><br><br>
    </form >";
}

if (isset($_POST["delete"]))
{
    $opleidingcontroller= new OpleidingController();
    if ($opleidingcontroller->delete($_SESSION["CurrentOpleiding"]->getOpleidingID()))
    {
        header("Location: View.php");
    }

}
else if (!isset($_POST["Delete"]) && isset($_POST["NaamOpleiding"]) && isset($_POST["VoltijdDeeltijd"]) && isset($_SESSION["CurrentOpleiding"]))
{
    $opleidingcontroller= new OpleidingController();
    if ($_SESSION["CurrentNaam"] && $_SESSION["VoltijdDeeltijd"])
    {
        $opleiding = new Opleiding($_SESSION["CurrentOpleiding"]->getOpleidingID(),$_SESSION["CurrentNaam"],$_SESSION["VoltijdDeeltijd"]);
    }

    if ($opleidingcontroller->update($opleiding))
    {
        header("Location: View/Profiel/View.php");
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