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
<html>
<head>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");?>
<body>

<?php

$booladded = false;
$School = "";
$Opleiding= "";
$Startdatumopleiding= "";
$Status= "";
$Achternaam= "";
$Voornaam= "";
$Tussenvoegsel= "";
$Prefix= "";
$Straat= "";
$Huisnummer= "";
$Extensie= "";
$Postcode= "";
$Woonplaats= "";;
$Geboortedatum= "";
$Telefoonnummer= "";
$Photo = "";


if ((isset($_GET["ID"]) || isset($profiel)) && $_SERVER['REQUEST_METHOD'] !='POST')
{
}
else{

    $profiel = $_SESSION["CurrentProfiel"];
    $profielcontroller= new ProfielController($_SESSION["GebruikerID"]);
    $schoolcontroller =new SchoolController();
    $opleidingcontroller=new OpleidingController();
    if (isset($profiel))
        $_SESSION["CurrentProfiel"] = $profiel;
    if (isset($_POST["School"]))
        $School = $schoolcontroller->getById($_POST["School"]);
    if (isset($_POST["Opleiding"]))
        $Opleiding= $opleidingcontroller->getById($_POST["Opleiding"]);
    if (isset($_POST["Startdatumopleiding"]))
        $Startdatumopleiding= $_POST["Startdatumopleiding"];
    if (isset($_POST["Status"]))
        $Status=$_POST["Status"];
    if (isset($_POST["Achternaam"]))
        $Achternaam=$_POST["Achternaam"];
    if (isset($_POST["Voornaam"]))
        $Voornaam=$_POST["Voornaam"];
    if (isset($_POST["Tussenvoegsel"]))
        $Tussenvoegsel=$_POST["Tussenvoegsel"];
    if (isset($_POST["Prefix"]))
        $Prefix=$_POST["Prefix"];
    if (isset($_POST["Straat"]))
        $Straat=$_POST["Straat"];
    if (isset($_POST["Huisnummer"]))
        $Huisnummer=$_POST["Huisnummer"];
    if (isset($_POST["Extensie"]))
        $Extensie =$_POST["Extensie"];
    if (isset($_POST["Postcode"]))
        $Postcode=$_POST["Postcode"];
    if (isset($_POST["Woonplaats"]))
        $Woonplaats=$_POST["Woonplaats"];
    if (isset($_POST["Geboortedatum"]))
        $Geboortedatum=$_POST["Geboortedatum"];
    if (isset($_POST["Telefoonnummer"]))
        $Telefoonnummer=$_POST["Telefoonnummer"];
    if (isset($profiel))
        $Photo = $profiel->getFoto();
}

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

    //$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
   // echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();


echo "<h1 > Koppelen profiel</h1 ><br>";
?>

<div class="divprofiel">
    <form action="Add.php" method="post" class="profielform" enctype="multipart/form-data"   >

        <?php
        echo "<!--Voornaam-->
<div class=\"block\">
<label class=\"formlabel\">Voornaam *</label>
<input type = \"text\" name=\"Voornaam\" Required value=\"";
        echo $Voornaam;
        echo "\" class=\"formInput\"/>
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
<input type = \"text\" name=\"Achternaam\" Required value=\"";
        echo $Achternaam;
        echo "\"/>
<label class=\"formerrorlabel\"> <span >$AchternaamErr</label>  
</div>

<!--Straat-->
<div class=\"block\">
<label class=\"formlabel\">Straat *</label>
<input type = \"text\" name=\"Straat\" Required value=\"";
        echo $Straat;
        echo "\"/>
<label class=\"formerrorlabel\">$StraatErr</label>
</div>
  
<!--Huisnummer-->       
<div class=\"block\">
<label class=\"formlabel\">Huisnummer *</label>
<input type = \"text\" name=\"Huisnummer\" Required value=\"";
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
<input type = \"text\" name=\"Postcode\" Required value=\"";
        echo $Postcode;
        echo "\"/>
<label class=\"formerrorlabel\">$PostcodeErr</label>
</div>
  
<div class=\"block\">      
<!--Woonplaats-->
<label class=\"formlabel\">Woonplaats *</label>
<input type = \"text\" name=\"Woonplaats\" Required value=\"";
        echo $Woonplaats;
        echo "\"/>
<label class=\"formerrorlabel\">$WoonplaatsErr</label>
</div>";

        echo "<div class=\"block\">";
        echo "<!--Geboortedatum-->";
        echo "<label class=\"formlabel\">Geboortedatum</label>";
        echo "<input type = \"text\" name=\"Geboortedatum\" value=\"";
        $time     = new DateTime($Geboortedatum);
        $newTime = $time->format("d-m-Y");
        echo    $newTime."\">";
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

            if ($School != "" && isset($School) && $School->getSchoolID() == $schoolid)
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
            if ($Opleiding != "" && isset($Opleiding) && $Opleiding->getOpleidingID() == $opleidingid)
                echo "<option value=\"$opleidingid\" selected>$naamopleiding</option>";
            else
                echo "<option value=\"$opleidingid\">$naamopleiding</option>";
        }
        echo"</select></div>
 
<!--Startdatumopleiding-->
<div class=\"formrow\">
<label class=\"formlabel\">Startdatumopleiding</label>
<input class=\"forminput\" type = \"text\" name=\"Startdatumopleiding\" value=\"";
        $time     = new DateTime($Startdatumopleiding);
        $newTime = $time->format("d-m-Y");

        echo $newTime;
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
<input type=\"text\" name=\"Telefoonnummer\" value='";
if (isset($_POST["Telefoonnummer"]))
    echo $Telefoonnummer;
echo "'></div>";
?>

<!--<label class="formlabel">Profielfoto:</label><br />-->

</div>
<!--<div class="block">-->
    <?php
    //echo "<label class=\"formlabel\">Profielfoto:</label><br />";

    //if (isset($profiel))
    //{
    //    $Photo = $profiel->getFoto();
    //    //echo $Photo;
    //    if (isset($Photo))
    //    {
    //        echo '<img src="data:image/jpeg;base64,' . base64_encode($Photo) . '" class="studentfoto"
    //        name="ProfileImage" ID="ProfileImage"/>';
    //    }
    //    else
    //    {
    //        echo '<img src="#" class="studentfoto" name="ProfileImage" ID="ProfileImage"/>';
    //    }
    //}
    //?>
    <!--<br><br>-->
    <!--<input type='file' name="ProfilePhotoFile"  value="Upload je profielfoto."-->
    <!--       accept="image/gif, image/jpeg, image/png" onchange="readURL(this);">-->

<!--</div>-->
<!--        <div class="block">-->
            <br>
            <input type="submit" value="submit" name='submit' >
        </div>
    </form >
<?php

if ($noerror && $_SERVER['REQUEST_METHOD'] != "GET")//No validation errors
{
    $schoolcontroller = new SchoolController();
    $opleidingcontroller = new OpleidingController();
    $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);

    $timegb     = new DateTime($Geboortedatum);
    $newGeboortedatum = $timegb->format("Y-m-d");
    $timesd     = new DateTime($Startdatumopleiding);
    $newStartdatumopleiding = $timesd->format("Y-m-d");


    if ($profielcontroller->Add(
        $gebruiker->getGebruikerID(),
        $schoolcontroller->getById($_POST["School"]) ,
        $opleidingcontroller->getById($_POST["Opleiding"]),
        $newStartdatumopleiding,
        $Status,
        $Achternaam,
        $Voornaam,
        $Tussenvoegsel,
        $Prefix,
        $Straat,
        $Huisnummer,
        $Extensie,
        $Postcode,
        $Woonplaats,
        $newGeboortedatum,
        $Telefoonnummer
        ))
    {
        //if(isset($_FILES["ProfilePhotoFile"]) && $_FILES["ProfilePhotoFile"]["name"] != "")
        //{
        //    $imagename=$_FILES["ProfilePhotoFile"]["name"];
        //    $imagetmp=addslashes (file_get_contents($_FILES['ProfilePhotoFile']['tmp_name']));
        //    $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
        //    $Profielcontroller->UploadPhoto(file_get_contents($_FILES['ProfilePhotoFile']['tmp_name']),$profiel->getProfielID());
        //
        //}
        $booladded = true;
    }
    else
    {
        echo "Record niet opgeslagen";
    }
}

    ?>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ProfileImage')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php
if (!$booladded)
    include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/footer.php");

if ($booladded){
    echo("<script>window.location.assign('/StudentServices/View/Profiel/Edit.php');</script>");
}
    ?>

</body>
</html>