<?php
//todo: haal deze error meldingen weg bij release
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
                <a href="../../Index.php">Terug</a>
            </li>
        </ul>
        </form>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>

<div class="info">

<?php
$GebruikersID =$_SESSION["GebruikerID"];

if (!isset($_SESSION["CurrentProfiel"]))
{
    //Directly from the login. So look for the profile by gebruikersID
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $profiel = $profielcontroller->getByGebruikerID();
    if ($profiel == null)
        header("Location: Add.php");
    //$Photo = $profiel->getFoto();

}
else if (isset($_SESSION["GebruikerID"]))
{
    //Directly from the login. So look for the profile by gebruikersID
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $profiel = $profielcontroller->getByGebruikerID();
    if ($profiel == null)
        header("Location: Add.php");
    //$Photo = $profiel->getFoto();
}

if ((isset($_GET["ID"]) || isset($profiel)) && $_SERVER['REQUEST_METHOD'] !='POST')
{
    $profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    //als de admin inlogt
    if (isset($_GET["ID"])){
        $profiel = $profielcontroller->getById($_GET["ID"]);
    }

    $_SESSION["CurrentProfiel"] = $profiel;
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
    $Extensie =$profiel->getExtensie();
    $Postcode=$profiel->getPostcode();
    $Woonplaats=$profiel->getWoonplaats();
    $Geboortedatum=$profiel->getGeboortedatum();
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
    $Photo = $profiel->getFoto();
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

$gbController = new GebruikerController($_SESSION["GebruikerID"]);
$gebruiker = $gbController->getById($_SESSION["GebruikerID"]);//in een session zetten werkt niet dan maar ophalen.


    //$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
   // echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();
{
 echo "<h1 > Profiel : ".$gebruiker->getGebruikersnaam()."</h1 ><br>";
?>

<div class="formouter">
<form action="Edit.php" method="post" enctype="multipart/form-data" >

<?php
echo "<!--Voornaam-->
<div class=\"block\">
<label class=\"formlabel\">Voornaam *</label>
<input type = \"text\" name=\"Voornaam\" value=\"";
    echo $Voornaam;
    echo "\"/>
<label class=\"formerrorlabel\">$VoornaamErr</label>
</div>";

echo "<!--Tussenvoegsel-->";
echo "<div class=\"block\">
<label class=\"formlabel\">Tussenvoegsel</label>
<input type = \"text\" name=\"Tussenvoegsel\" value=\"";
echo $Tussenvoegsel;
echo "\" />

<!--Prefix-->
<div class=\"block\">
<label class=\"formlabel\">Prefix</label>
<input type = \"text\" name=\"Prefix\" value=\"";
    echo $Prefix;
echo "\" /></div>

<!--Achternaam-->
<div class=\"block\">
<label class=\"formlabel\">Achternaam *</label>
<input type = \"text\" name=\"Achternaam\" value=\"";
    echo $Achternaam;
    echo "\"/>
<label class=\"formerrorlabel\"> <span >$AchternaamErr</label>  
</div>

<!--Straat-->
<div class=\"block\">
<label class=\"formlabel\">Straat *</label>
<input type = \"text\" name=\"Straat\" value=\"";
    echo $Straat;
    echo "\"/>
<label class=\"formerrorlabel\">$StraatErr</label>
</div>
  
<!--Huisnummer-->       
<div class=\"block\">
<label class=\"formlabel\">Huisnummer *</label>
<input type = \"text\" name=\"Huisnummer\" value=\"";
    echo $Huisnummer;
    echo "\"/>
<label class=\"formerrorlabel\">$HuisnummerErr</label>
</div>

<!--Extentie-->
<div class=\"block\">
<label class=\"formlabel\">Extensie</label>
<input type = \"text\" name=\"Extensie\" value=\"";
    echo $Extensie;
    echo "\"/>
<div class=\"block\">
</div>


<!--Postcode-->
<label class=\"formlabel\">Postcode *</label>
<input type = \"text\" name=\"Postcode\" value=\"";
echo $Postcode;
echo "\"/>
<label class=\"formerrorlabel\">$PostcodeErr</label>
</div>
  
<div class=\"block\">      
<!--Woonplaats-->
<label class=\"formlabel\">Woonplaats *</label>
<input type = \"text\" name=\"Woonplaats\" value=\"";
    echo $Woonplaats;
    echo "\"/>
<label class=\"formerrorlabel\">$WoonplaatsErr</label>
</div>";

echo "<div class=\"block\">";
echo "<!--Geboortedatum-->";
echo "<label class=\"formlabel\">Geboortedatum</label>";
echo "<input type = \"text\" name=\"Geboortedatum\" value=\"".$Geboortedatum."\">";
echo "</div>";

echo "<div class=\"block\">";
echo "    <!--School-->
<label class=\"formlabel\">School</label>";
echo "<select name=\"School\">";
$Schoolcontroller = new SchoolController();
foreach($Schoolcontroller->GetScholen() as $sh)
{
    $schoolid = $sh->getSchoolID();
    $schoolnaam = $sh->getSchoolnaam();
    if (isset($School) && $School->getSchoolID() == $schoolid)
        echo "<option value=\"$schoolid\" selected>$schoolnaam</option>";
    else
        echo "<option value=\"$schoolid\">$schoolnaam</option>";
}
echo"</select></div>


<div class=\"block\">
<!--Opleiding-->
<label class=\"formlabel\">Opleiding</label>
<select name=\"Opleiding\">";
$Opleidingcontroller = new OpleidingController();
foreach($Opleidingcontroller->GetOpleidingen() as $op)
{
    $opleidingid = $op->getOpleidingID();

    $naamopleiding = $op->getNaamopleiding();
    if (isset($Opleiding) && $Opleiding->getOpleidingID() == $opleidingid)
        echo "<option value=\"$opleidingid\" selected>$naamopleiding</option>";
    else
        echo "<option value=\"$opleidingid\">$naamopleiding</option>";
}
echo"</select></div>
 
<!--Startdatumopleiding-->
<div class=\"block\">
<label class=\"formlabel\">Startdatumopleiding</label>
<input type = \"text\" name=\"Startdatumopleiding\" value=\"";
    echo $Startdatumopleiding;
    echo "\"/>
</div>

<div class=\"block\">
<label class=\"formlabel\">Status</label>
<select name=\"Status\">";
$EnumStatus = new EnumGebruikerStatus();
foreach($EnumStatus->getConstants() as $st)
{
    if (isset($Status) && $Status == $st)
        echo "<option value=\"$st\" selected>$st</option>";
    else
        echo "<option value=\"$st\">$st</option>";
}
echo"</select>
</div>
    
<!--Telefoonnummer-->    
<div class=\"block\">
<label class=\"formlabel\">Telefoonnummer</label>
<input type = \"text\" name=\"Telefoonnummer\" value=\"";
if (isset($_POST["Telefoonnummer"])) echo $Telefoonnummer;
echo "\">
</div> 

<!--Profielfoto-->    
<div class=\"profielfotoform\">";
};?>
    <label class="formlabel">Profielfoto:</label><br />

    <?php

    if (isset($profiel)){
        $Photo = $profiel->getFoto();
        if (isset($Photo)){
            echo "<img src=data:image/gif;base64,".$Photo." class=\"studentfoto\" />";
        }
    }
    ?>
    <input type="file" name="ProfilePhoto" value="Upload je profielfoto.">
<?php echo "</div>" ?>
<div class="block">

    <input type="submit" value="submit" name='submit' >
    <input type="submit" value="delete" name='delete' >
</div>
</form >
</div>
<?php

    if(isset($_FILES["ProfilePhoto"]) && $_FILES["ProfilePhoto"]["name"] != "")
    {
        $imagename=$_FILES["ProfilePhoto"]["name"];
        $imagetmp=addslashes (file_get_contents($_FILES['ProfilePhoto']['tmp_name']));
        $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
        $Profielcontroller->UploadPhoto($imagetmp,$profiel->getProfielID());
    }

if (isset($_POST["delete"]))
{

    if ($Profielcontroller->delete($_SESSION["CurrentProfiel"]->getProfielID()))
    {
        header("Location: Add.php");
    }

}
else if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $schoolcontroller = new SchoolController();
    $opleidingcontroller = new OpleidingController();
    $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    $profiel = new Profiel($profiel->getProfielID(), $GebruikersID,$schoolcontroller->getById($School),
        $opleidingcontroller->getById($Opleiding),
        $Startdatumopleiding,  $Status,  $Achternaam,  $Voornaam,  $Tussenvoegsel,
         $Prefix,  $Straat,  $Huisnummer,  $Extensie,  $Postcode,
         $Woonplaats,  $Geboortedatum, $Telefoonnummer);

    if ($Profielcontroller->update($profiel))
    {
        if ($_SESSION["level"]>=50)
            //echo "Record opgeslagen";
            header("Location: ".$_SERVER['DOCUMENT_ROOT']."/StudentServices/view.php");
        else
            echo "Record opgeslagen";
            //Do nothing you're already there.
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