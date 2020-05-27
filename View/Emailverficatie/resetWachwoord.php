<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");
$errors               = "";
if (isset($_POST['Wachtwoord1']) && !empty($_POST['Wachtwoord1']) && isset($_POST['Wachtwoord2']) &&
    !empty($_POST['Wachtwoord2']) && isset($_POST['Username']) && !empty($_POST['Username']) &&
    isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['code']) && !empty($_POST['code'])){
    $gebruikerscontroller = new GebruikerController(-1);
    $gebruikers           = $gebruikerscontroller->getGebruikers();
    $sha256               = new ConnectDB();
    $controlebits         = ["gebruiker" => 0,"email" => 0,"verficatiecode" => 0];
    $gebruikerid = 0;
    foreach ($gebruikers as $gebruiker){
        if ($gebruiker->getEmail() == $_POST["email"]){
            $controlebits["email"] = 1;
            $gebruikerid = $gebruiker->getGebruikerID();
        }
        if ($gebruiker->getGebruikersnaam() == $_POST["Username"]){
            $controlebits["gebruiker"] = 1;
        }
        if ($gebruiker->getWachtwoord() == $_POST["code"]){
            $controlebits["verficatiecode"] = 1;
        }
    }
    if ($_POST['Wachtwoord1'] != $_POST['Wachtwoord2']){
        $errors .= "Wachtwoorden zijn niet gelijk. <br>";
    }
    if (!$controlebits["email"]){
        $errors .= "Email bestaat niet. <br>";
    }
    if (!$controlebits["gebruiker"]){
        $errors .= "Gebruiker bestaat niet. <br>";
    }
    if (!$controlebits["verficatiecode"]){
        $errors .= "ongeldige code. <br>";
    }
    if($errors == ""){
        $gebruiker =  $gebruikerscontroller->getById($gebruikerid);
        $gebruiker->setWachtwoord($sha256->makesafe($_POST['Wachtwoord1']));
        $gebruikerscontroller->updateWachtwoord($gebruiker);;
        header("Location: /StudentServices/inlogPag.php?action=succes&content=Wachtwoord succesvol hersteld");
    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bevestig StudentServices account</title>
    <meta name="description" content="bevesting link">
    <meta name="author" content="Student Services">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
</head>
<body onload="changeform()">
<div class="header">
    <img id="logo" src="/StudentServices/images/logotrans.png"/>
</div>
<div id="reset_password">
    <form action="/StudentServices/View/Emailverficatie/resetWachwoord.php" method="post">
        <div id="errors"><p><?= $errors ?></p></div>
        <div><label for="Wachtwoord1">Vul je hier je nieuwe wachtwoord in</label></div>
        <div><input type="password" id="Email" name="Wachtwoord1" placeholder="vul hier je Wachtwoord in"></div>
        <label for="Wachtwoord2">Herhaal wachtwoord</label>
        <div><input type="password" id="Email" name="Wachtwoord2" placeholder="Herhaal wachtwoord"></div>
        <div><input id="username" type="hidden" name="" value=""></div>
        <div><input id="email" type="hidden" name="" value=""></div>
        <div><input id="code" type="hidden" name="" value=""></div>
        <div><input id="Submit" type="submit" value="Reset wachtwoord"></div>
    </form>
</div>
<div class="footer">
    <div>© Student Services, 2020</div>
</div>
</body>
<script>
    function changeform() {
        var queryString = window.location.href;
        var vertifycode = (queryString.substr((queryString.indexOf('?')+1), (queryString.indexOf('&') - queryString.indexOf('?'))-1)).split("?");
        var readdata = new URL(queryString);
        var username = readdata.searchParams.get('username');
        var email = readdata.searchParams.get('email');
        document.getElementById("username").name = "Username";
        document.getElementById("username").value = username;
        document.getElementById("email").name = "email";
        document.getElementById("email").value = email;
        document.getElementById("code").name = "code";
        document.getElementById("code").value = vertifycode;
    }
</script>
</html>
