<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/DB.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
$wronglogin = "";

if (isset($_POST['username']) && $_POST['password']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $DB       = new ConnectDB();
    //$password   = hash('sha256',$password);//
    $pwsafe    = $DB->MakeSafe($password);
    $GC        = new GebruikerController(-1);
    $Gebruiker = $GC->Validate($username, $pwsafe);

    if ($Gebruiker->getGebruikerID() != -1){
        echo "Je wachtwoord was goed echter werkt het doorverwijzen nog niet!";
        $_SESSION["GebruikerID"] = $Gebruiker->getGebruikerID();
        $GC    = new GebruikerController($_SESSION['GebruikerID']);
        $_SESSION["level"] = $GC->checkRechten();

        //$_SESSION["Gebruiker"] = $Gebruiker;
        header("Location: index.php");
    } else{
        $wronglogin = "De combinatie van gebruiker en/of wachtwoord is onjuist.";
    }
}

?><!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/studentservices.ico"/>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Inloggen" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
    <script type="text/javascript" src="/StudentServices/ClientSide/contactformulier.js"></script>
    <script type="text/javascript" src="/StudentServices/JS/script.js"></script>
    <script type="text/javascript" src="/StudentServices/JS/bevestigenaccount.js"></script>
</head>
<body onload="timeevents();">

<div class="grid-container">

    <div class="itemslider">
        <div class="mySlides fade">
            <img src="/StudentServices/images/9.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/11.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/12.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/13.png" class="sliderimage">
        </div>
    </div>

<div class="popup" id="test">
    <span class="popuptext" id="myPopup"></span>
</div>

<form id="login" action="inlogPag.php" method="POST"><!-No not verwerklogin-->

    <!--styling is tijdelijk-->
    <div class="container">
        <div style="width:100%">
            <label for='username' style="width:150px">Gebruikersnaam:</label>
            <input type='text' name='username' style="width:150px"/>
        </div>
        <div style="width:100%;padding-top: 5px">
            <label for='password' style="width:150px">Wachtwoord:</label>
            <input type='password' style="width:150px" name='password'/>
        </div>
        <?php
        echo $wronglogin
        ?>
        <br><br>
        <input type="checkbox" id="remember_me" name="_remember_me" checked/>
        <label for="remember_me">Onthoudt mij(werkt nog niet dus niet appen)</label>
        <br>
        <input type='submit' name='Submit' value='Submit'/>
        <?php
        if ($wronglogin != ""){
            echo "<input type = 'submit' name = 'ikbenmijnwwvergeten' value = 'Wachtwoord vergeten' />";
        }
        ?>

    </div>

</form>

<form id='add' action="View/Gebruiker/Add.php" accept-charset='UTF-8'>
    <div class="container">
        <input type='submit' name='Add' value='Registreren'/>
    </div>
</form>

</body>
</html>
