
<?php

require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="stylesheet" href="/StudentServices/css/Menu.css">
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
<body>

<!--kunnen we hier niet een codesnippet/subpagina van maken-->
<div class="header">
    <nav id="menu">
        <ul class="main-menu cf">
            <li><a href="./View.php">Terug</a></li>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<?php


if (isset($_GET["ID"]))
{
    $gebruikercontroller= new GebruikerController(-1);
    $gebruiker= $gebruikercontroller->getById($_GET["ID"]);
    $_SESSION["CurrentGebruiker"] = $gebruiker;
    $_SESSION["OriginalLoginName"] = $gebruiker->getGebruikersnaam();
}

if (isset($_POST["GebruikersNsaam"]) || isset($_POST["Email"]) )
{
    $_SESSION["Gebruikersnaam"] = $_POST["GebruikersNaam"];
    $_SESSION["Email"] = $_POST["Email"];
}

if ( $_SESSION["CurrentGebruiker"] != null)
{
    $gebruiker = $_SESSION["CurrentGebruiker"];
}

$valueGebruikersnaam = "";
$valueEmail = "";

if (isset($_POST["Post"]))
{
    $valueGebruikersnaam =  $_SESSION["Gebruikersnaam"];
    $valueEmail=  $_SESSION["Email"];
}
else if (isset($_GET["ID"])) {
    $valueGebruikersnaam = $gebruiker->getGebruikersnaam();
    $valueEmail=   $gebruiker->getEmail();
}
else {
    $valueGebruikersnaam = $_POST["GebruikersNaam"];
    $valueEamil=  $_POST["Email"];
}
$form =  "<h1 > Wijzigen login gegevens</h1 ><br>
<form action = \"Edit.php\" method = \"post\" >

    <div class='gebruikerlabel'>Gebruikersnaam *</div>
        <div class='gebruikerinput'><input type = \"text\" name=\"GebruikersNaam\" value=\"" . $valueGebruikersnaam . "\"/>
        </div>
    <div class='gebruikerlabel'>Email *</div>
         <div class='gebruikerinput'><input type = \"text\" name=\"Email\" value=\"" . $valueEmail . "\"/></div>
       <input type=\"submit\" >  
       <input type=\"submit\" value=\"delete\" name=\"delete\">
    </form >";
$formset = false;
if (!isset($_POST["Delete"]) && isset($_GET["ID"]))
{
    //todo : object van maken?

    $formset = true;
    echo $form;
}


if (isset($_POST["delete"]))
{
    $gebruikercontroller= new GebruikerController(-1);
    if ($gebruikercontroller->delete($_SESSION["CurrentGebruiker"]->getGebruikerID()))
    {
        header("Location: View.php");
    }

}
else if (!isset($_POST["Delete"]) && isset($_SESSION["Gebruikersnaam"]) && isset($_SESSION["Email"]))
{
    $gebruikercontroller= new GebruikerController(-1);

    $gebruiker = new Gebruiker($_SESSION["CurrentGebruiker"]->getGebruikerID(),$_SESSION["Gebruikersnaam"] ,"",$_SESSION["Email"]);
    $gebruikercontroller->setOriginalUserName($_SESSION["OriginalLoginName"]);

    $answers = $gebruikercontroller->update($gebruiker);

        if (isset($answers) && $answers["Errorsfound"] != "true")
        {
            unset($_SESSION['CurrentGebruiker']);
            unset($_SESSION["Gebruikersnaam"]);
            unset($_SESSION["Email"]);
            header("Location: View.php");
        }
        else
        {
            $NaamErr = $answers["Gebruikersnaam"];
            $EmailErr = $answers["Email"];
            //todo : object van maken?
            if ($formset==false)
                echo $form;
            echo "Record niet opgeslagen.";
            if ($NaamErr != "")
                echo "<br>".$NaamErr;
            if ($EmailErr != "") echo "<br>".$EmailErr;
        }
}

?>
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