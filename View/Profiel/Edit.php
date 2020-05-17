
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
$GebruikersID =$_SESSION["GebruikerID"];
if (isset($_GET["ID"]))
{
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $profiel= $profielcontroller->getById($_GET["ID"]);
    $_SESSION["CurrentProfiel"] = $profiel;
    $School =$profiel->getSchool();
    $Opleiding=$profiel->getOpleiding();
    $Startdatumopleiding=$profiel->getStartdatumopleiding()->format('d-m-Y');
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
    $Geboortedatum=$profiel->getGeboortedatum()->format('d-m-Y');
    $Telefoonnummer=$profiel->getTelefoonnummer();
}
else
{
    $profiel = $_SESSION["CurrentProfiel"];
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $_SESSION["CurrentProfiel"] = $profiel;
    $School =$_POST["School"];
    $Opleiding=$_POST["Opleiding"];
    $Startdatumopleiding= $_POST["Startdatumopleiding"];
    $Status=$_POST["Status"];
    $Achternaam=$_POST["Achternaam"];
    $Voornaam=$_POST["Voornaam"];
    $Tussenvoegsel=$_POST["Tussenvoegsel"];
    $Prefix=$_POST["Prefix"];
    $Straat=$_POST["Straat"];
    $Huisnummer=$_POST["Huisnummer"];
    $Extensie =$_POST["Extensie"];
    $Postcode=$_POST["Postcode"];
    $Woonplaats=$_POST["Woonplaats"];
    $Geboortedatum=$_POST["Geboortedatum"];
    $Telefoonnummer=$_POST["Telefoonnummer"];
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

if (isset($_POST["Voornaam"]) && $_POST["Voornaam"] =="")
{
    $VoornaamErr = "Voornaam is verplicht.";
    $noerror = false;
}
if (isset($_POST["Achternaam"]) && $_POST["Achternaam"] =="")
{
    $AchternaamErr = "Achternaam is verplicht.";
    $noerror = false;
}
if (isset($_POST["Straat"]) && $_POST["Straat"] =="")
{
    $StraatErr = "Straat is verplicht.";
    $noerror = false;
}
if (isset($_POST["Huisnummer"]) && $_POST["Huisnummer"] =="")
{
    $HuisnummerErr = "Huisnummer is verplicht.";
    $noerror = false;
}
if (isset($_POST["Postcode"]) && $_POST["Postcode"] =="")
{
    $PostcodeErr = "Postcode is verplicht.";
    $noerror = false;
}
if (isset($_POST["Woonplaats"]) && $_POST["Woonplaats"] =="")
{
    $WoonplaatsErr = "Woonplaats is verplicht.";
    $noerror = false;
}
#endregion

$gbController = new GebruikerController();
$gebruiker = $gbController->getById($_SESSION["GebruikerID"]);//in een session zetten werkt niet dan maar ophalen.


    //$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
   // echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();
{
 echo "<h1 > Profiel wijzigen voor : ".$gebruiker->getGebruikersnaam()."</h1 ><br>
<form action = \"Edit.php\" method = \"post\" >";

echo "<!--Voornaam-->
    <div class='formcol1'>Voornaam *</div>
    <div class='formcol2'><input type = \"text\" name=\"Voornaam\" value=\"";
            echo $Voornaam;
            echo "\"/></div>
         <span class='formcolerror'>$VoornaamErr</span>";

echo "<!--Tussenvoegsel-->";
echo "<div class='formcol1'>Tussenvoegsel</div>
         <div class='formcol2'><input type = \"text\" name=\"Tussenvoegsel\" value=\"";
echo $Tussenvoegsel;
echo "\" /></div>";

echo "<!--Prefix-->";
echo "<div class='formcol1'>Prefix</div>
         <div class='formcol2'><input type = \"text\" name=\"Prefix\" value=\"";
echo $Prefix;
echo "\" /></div>

         <!--Achternaam-->
    <div class='formcol1'>Achternaam *</div>
         <div class='formcol2'><input type = \"text\" name=\"Achternaam\" value=\"";
echo $Achternaam;
echo "\"/></div>
         <span class='formcolerror'>$AchternaamErr</span>   
    <!--Straat-->
 <div class='formcol1'>Straat *</div>
         <div class='formcol2'><input type = \"text\" name=\"Straat\" value=\"";
echo $Straat;
echo "\"/></div>
         <span class='formcolerror'>$StraatErr</span>
         
    <!--Huisnummer-->
 <div class='formcol1'>Huisnummer *</div>
         <div class='formcol2'><input type = \"text\" name=\"Huisnummer\" value=\"";
echo $Huisnummer;
echo "\"/></div>
         <span class='formcolerror'>$HuisnummerErr</span>

        <!--Extentie-->
 <div class='formcol1'>Extensie</div>
         <div class='formcol2'><input type = \"text\" name=\"Extensie\" value=\"";
echo $Extensie;
echo "\"/></div>
         

<!--Postcode-->
 <div class='formcol1'>Postcode *</div>
         <div class='formcol2'><input type = \"text\" name=\"Postcode\" value=\"";
echo $Postcode;
echo "\"/></div>
         <span class='formcolerror'>$PostcodeErr</span>
         
     <!--Woonplaats-->
 <div class='formcol1'>Woonplaats *</div>
         <div class='formcol2'><input type = \"text\" name=\"Woonplaats\" value=\"";
echo $Woonplaats;
echo "\"/></div>
         <span class='formcolerror'>$WoonplaatsErr</span>";

echo "<!--Geboortedatum-->";
echo "<div class='formcol1'>Geboortedatum</div>";
echo "<div class='formcol2'><input type = \"text\" name=\"Geboortedatum\" value=\"".$Geboortedatum."\"></div>";

echo "    <!--School-->
 <div class='formcol1'>School</div>
    <select name=\"School\" class='formcol2'>";
        $Schoolcontroller = new SchoolController();
        foreach($Schoolcontroller->GetScholen() as $sh)
        {
            $schoolid = $sh->getSchoolID();
            $schoolnaam = $sh->getSchoolnaam();
            echo "<option value=\"$schoolid\">$schoolnaam</option>";
        }
   echo"</select>
    
    <!--Opleiding-->
     <div class='formcol1'>Opleiding</div>
    <select name=\"Opleiding\" class='formcol2'>";
        $Opleidingcontroller = new OpleidingController();
        foreach($Opleidingcontroller->GetOpleidingen() as $op)
        {
            $opleidingid = $op->getOpleidingID();
            $naamopleiding = $op->getNaamopleiding();
            echo "<option value=\"$opleidingid\">$naamopleiding</option>";
        }
   echo"</select>
                   <!--Startdatumopleiding-->
 <div class='formcol1'>Startdatumopleiding</div>
         <div class='formcol2'><input type = \"text\" name=\"Startdatumopleiding\" value=\"";
echo $Startdatumopleiding;

echo "\"/>
</div>

  <!--foto-->
 <div class='formcol1'>Foto</div><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" class=\"formcol2\">
  <div class='formcol1'>Huidige foto</div>
  <div class='formcol2'><div class='formcol3'>
  
  <a href='/StudentServices/images/studenten/ss3.png'>
<img id=\"nieuwestudent\" src=\"/StudentServices/images/studenten/ss3.png\" class=\"studentfoto\"/></a>
</div>
</div>


 <div class='formcol1'>Status</div>
  <div class='formcol2'>
<select name=\"Status\">";
        $Status = new EnumGebruikerStatus();
        foreach($Status->getConstants() as $st)
        {
            echo "<option value=\"$st\">$st</option>";
        }
echo"</select>
    </div>
    
 <!--Telefoonnummer-->
 <div class='formcol1'>Telefoonnummer</div>
         <div class='formcol2'><input type = \"text\" name=\"Telefoonnummer\" value=\"";
        if (isset($_POST["Telefoonnummer"])) echo $Telefoonnummer;
echo "\"></div> <div class='formcol1'>
       <input type=\"submit\" value=\"submit\" name='submit' > <input type=\"submit\" value=\"delete\" name='delete' ></div> <br><br><br>
    </form >";
}

$Profielcontroller= new ProfielController($GebruikersID);
if (isset($_POST["delete"]))
{

    if ($Profielcontroller->delete($_SESSION["CurrentProfiel"]->getProfielID()))
    {
        header("Location: View.php");
    }

}
else if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $profiel = new Profiel($profiel->getProfielID(), $GebruikersID,$School, $Opleiding,
        strtotime($Startdatumopleiding),  $Status,  $Achternaam,  $Voornaam,  $Tussenvoegsel,
         $Prefix,  $Straat,  $Huisnummer,  $Extensie,  $Postcode,
         $Woonplaats,  $Geboortedatum, $Telefoonnummer);

    if ($Profielcontroller->update($profiel))
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