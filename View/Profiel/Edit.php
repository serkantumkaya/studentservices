<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/OpleidingController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Enum/EnumGebruikerStatus.php");
session_start();

if (!isset($_SESSION["GebruikerID"]) || $_SESSION["GebruikerID"] == -1){
    Header("Location: /StudentServices/inlogPag.php");
}

?><!DOCTYPE HTML>
<html>
<head>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php"); ?>
<body>

<?php
$GebruikersID = $_SESSION["GebruikerID"];

if (!isset($_SESSION["CurrentProfiel"])){
    //Directly from the login. So look for the profile by gebruikersID
    $profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    $profiel           = $profielcontroller->getByGebruikerID();
    if ($profiel == null){
        header("Location: Add.php");
    }
    //$Photo = $profiel->getFoto();

} else{
    if (isset($_SESSION["GebruikerID"])){
        //Directly from the login. So look for the profile by gebruikersID
        $profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
        $profiel           = $profielcontroller->getByGebruikerID();
        if ($profiel == null){
            header("Location: Add.php");
        }
        //$Photo = $profiel->getFoto();
    }
}

if ((isset($_GET["ID"]) || isset($profiel)) && $_SERVER['REQUEST_METHOD'] != 'POST'){
    $profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    //als de admin inlogt
    if (isset($_GET["ID"])){
        $profiel = $profielcontroller->getById($_GET["ID"]);
    }

    $_SESSION["CurrentProfiel"] = $profiel;
    $School                     = $profiel->getSchool();
    $Opleiding                  = $profiel->getOpleiding();
    $Startdatumopleiding        = $profiel->getStartdatumopleiding();
    $Status                     = $profiel->getStatus();
    $Achternaam                 = $profiel->getAchternaam();
    $Voornaam                   = $profiel->getVoornaam();
    $Tussenvoegsel              = $profiel->getTussenvoegsel();
    $Prefix                     = $profiel->getPrefix();
    $Straat                     = $profiel->getStraat();
    $Huisnummer                 = $profiel->getHuisnummer();
    $Extensie                   = $profiel->getExtensie();
    $Postcode                   = $profiel->getPostcode();
    $Woonplaats                 = $profiel->getWoonplaats();
    $Geboortedatum              = $profiel->getGeboortedatum();
    $Telefoonnummer             = $profiel->getTelefoonnummer();
} else{
    $profiel                    = $_SESSION["CurrentProfiel"];
    $profielcontroller          = new ProfielController($_SESSION["GebruikerID"]);
    $schoolcontroller           = new SchoolController();
    $opleidingcontroller        = new OpleidingController();
    $_SESSION["CurrentProfiel"] = $profiel;
    $School                     = $schoolcontroller->getById($_POST["School"]);
    $Opleiding                  = $opleidingcontroller->getById($_POST["Opleiding"]);
    $Startdatumopleiding        = $_POST["Startdatumopleiding"];
    $Status                     = $_POST["Status"];
    $Achternaam                 = $_POST["Achternaam"];
    $Voornaam                   = $_POST["Voornaam"];
    $Tussenvoegsel              = $_POST["Tussenvoegsel"];
    $Prefix                     = $_POST["Prefix"];
    $Straat                     = $_POST["Straat"];
    $Huisnummer                 = $_POST["Huisnummer"];
    $Extensie                   = $_POST["Extensie"];
    $Postcode                   = $_POST["Postcode"];
    $Woonplaats                 = $_POST["Woonplaats"];
    $Geboortedatum              = $_POST["Geboortedatum"];
    $Telefoonnummer             = $_POST["Telefoonnummer"];
    $Photo                      = $profiel->getFoto();
}
#region [errorafhandeling]
$NaamErr            = "";
$EmailErr           = "";
$WachtwoordErr      = "";
$WachtwoordCheckErr = "";
$VoornaamErr        = "";
$AchternaamErr      = "";
$StraatErr          = "";
$HuisnummerErr      = "";
$PostcodeErr        = "";
$WoonplaatsErr      = "";
$noerror            = true;

if (isset($_POST["Voornaam"]) && $_POST["Voornaam"] == ""){
    $VoornaamErr = "Voornaam is verplicht.";
    $noerror     = false;
}
if (isset($_POST["Achternaam"]) && $_POST["Achternaam"] == ""){
    $AchternaamErr = "Achternaam is verplicht.";
    $noerror       = false;
}
if (isset($_POST["Straat"]) && $_POST["Straat"] == ""){
    $StraatErr = "Straat is verplicht.";
    $noerror   = false;
}
if (isset($_POST["Huisnummer"]) && $_POST["Huisnummer"] == ""){
    $HuisnummerErr = "Huisnummer is verplicht.";
    $noerror       = false;
}
if (isset($_POST["Postcode"]) && $_POST["Postcode"] == ""){
    $PostcodeErr = "Postcode is verplicht.";
    $noerror     = false;
}
if (isset($_POST["Woonplaats"]) && $_POST["Woonplaats"] == ""){
    $WoonplaatsErr = "Woonplaats is verplicht.";
    $noerror       = false;
}
#endregion

$gbController = new GebruikerController($_SESSION["GebruikerID"]);
$gebruiker    = $gbController->getById($_SESSION["GebruikerID"]);//in een session zetten werkt niet dan maar ophalen.


//$huidigegebruiker = json_decode($_SESSION["Gebruiker"]);
// echo "De huidige gebruiker is :" . $huidigegebruiker->getGebruikersnaam();
echo "<h1 class=\"h1profiel\"> Profiel : " . $gebruiker->getGebruikersnaam() . "</h1 ><br>";
?>

<div class="divprofiel">
    <form action="Edit.php" method="post" class="profielform" enctype="multipart/form-data">

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
<input type = \"number\" name=\"Huisnummer\" Required value=\"";
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
        echo "\" pattern=\"[1-9][0-9]{3}\s?[a-zA-Z]{2}\">
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
        $time    = new DateTime($Geboortedatum);
        $newTime = $time->format("d-m-Y");

        echo    $newTime."\" pattern=\"(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}\">";
        echo "</div>";

        echo "<div class=\"block\">";
        echo "    <!--School-->
<label class=\"formlabel\">School</label>";
        echo "<select name=\"School\">";
        $Schoolcontroller = new SchoolController();
        foreach ($Schoolcontroller->GetScholen() as $sh){
            $schoolid   = $sh->getSchoolID();
            $schoolnaam = $sh->getSchoolnaam();

            if (isset($School) && $School->getSchoolID() == $schoolid){
                echo "<option value=\"$schoolid\" selected>$schoolnaam</option>";
            } else{
                echo "<option value=\"$schoolid\">$schoolnaam</option>";
            }
        }
        echo "</select></div>



<div class=\"block\">
<!--Opleiding-->
<label class=\"formlabel\">Opleiding</label>
<select name=\"Opleiding\">";
        $Opleidingcontroller = new OpleidingController();
        foreach ($Opleidingcontroller->GetOpleidingen() as $op){
            $opleidingid = $op->getOpleidingID();

            $naamopleiding = $op->getNaamopleiding();
            if (isset($Opleiding) && $Opleiding->getOpleidingID() == $opleidingid){
                echo "<option value=\"$opleidingid\" selected>$naamopleiding</option>";
            } else{
                echo "<option value=\"$opleidingid\">$naamopleiding</option>";
            }
        }
        echo "</select></div>
 
<!--Startdatumopleiding-->
<div class=\"formrow\">
<label class=\"formlabel\">Startdatumopleiding</label>
<input class=\"forminput\" type = \"text\" name=\"Startdatumopleiding\" value=\"";
        $time    = new DateTime($Startdatumopleiding);
        $newTime = $time->format("d-m-Y");

        echo $newTime;
        echo "\" pattern=\"(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}\"/>
</div>

<div class=\"block\">
<label class=\"formlabel\">Status</label>
<select name=\"Status\">";
        $EnumStatus = new EnumGebruikerStatus();
        foreach ($EnumStatus->getConstants() as $st){
            if (isset($Status) && $Status == $st){
                echo "<option value=\"$st\" selected>$st</option>";
            } else{
                echo "<option value=\"$st\">$st</option>";
            }
        }
        echo "</select>
</div>
    
<!--Telefoonnummer-->    
<div class=\"block\">
<label class=\"formlabel\">Telefoonnummer</label>

<input type=\"phone\" name=\"Telefoonnummer\" value=\"";
    echo $Telefoonnummer;
    echo "\" pattern=\"(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)\"/></div>";

echo "<label class=\"formlabel\">Profielfoto:</label><br />";

    if (isset($profiel))
    {
        $Photo = $profiel->getFoto();
        //echo $Photo;
        if (isset($Photo))
        {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($Photo) . '" class="studentfoto" 
            name="ProfileImage" ID="ProfileImage"/>';
            } else{
                echo '<img src="#" class="studentfoto" name="ProfileImage" ID="ProfileImage"/>';
            }
        }
        ?>
        <br><br>
        <input type='file' name="ProfilePhotoFile" value="Upload je profielfoto."
               accept="image/gif, image/jpeg, image/png" onchange="readURL(this);">

</div>
<div class="block">

</div>
<div class="block">
    <br>
    <input type="submit" value="submit" name='submit'>
    <input type="submit" value="delete" name='delete'>
</div>
</form >

<?php

if (isset($_FILES["ProfilePhotoFile"]) && $_FILES["ProfilePhotoFile"]["name"] != ""){
    $imagename         = $_FILES["ProfilePhotoFile"]["name"];
    $imagetmp          = addslashes(file_get_contents($_FILES['ProfilePhotoFile']['tmp_name']));
    $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    $Profielcontroller->UploadPhoto(file_get_contents($_FILES['ProfilePhotoFile']['tmp_name']),
        $profiel->getProfielID());

}

if (isset($_POST["delete"])){
    $Profielcontroller = new ProfielController($_SESSION["GebruikerID"]);
    $Profielcontroller->delete($_SESSION["CurrentProfiel"]->getProfielID());

    echo("<script>window.location.assign('/StudentServices/inlogPag.php');</script>");

} else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $schoolcontroller    = new SchoolController();
        $opleidingcontroller = new OpleidingController();
        $Profielcontroller   = new ProfielController($_SESSION["GebruikerID"]);

        $timegb                 = new DateTime($Geboortedatum);
        $newGeboortedatum       = $timegb->format("Y-m-d");
        $timesd                 = new DateTime($Startdatumopleiding);
        $newStartdatumopleiding = $timesd->format("Y-m-d");

        $profiel = new Profiel($profiel->getProfielID(), $GebruikersID, $School,
            $Opleiding,
            $newStartdatumopleiding, $Status, $Achternaam, $Voornaam, $Tussenvoegsel,
            $Prefix, $Straat, $Huisnummer, $Extensie, $Postcode,
            $Woonplaats, $newGeboortedatum, $Telefoonnummer);

        if ($Profielcontroller->update($profiel)){
            if ($_SESSION["level"]>=50)//echo "Record opgeslagen";
            {
                header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/StudentServices/view.php");
            } else{
                echo("<script>window.location.assign('/StudentServices/View/Profiel/edit.php');</script>");
            }
            //Do nothing you're already there.
        } else{
            echo "Record niet opgeslagen";
        }
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

<?php include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/footer.php"); ?>

</body>
</html>