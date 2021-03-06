<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
//print_r($_POST);
if (isset($_POST['submit'])){
    if (isset($_POST["Review"])){
        $feedbackcontroller = new FeedbackController();
        if ($feedbackcontroller->add($_POST["ProjectID"], $_POST['GebruikerID'], $_POST['Cijfer'], $_POST['Review'])){
            //wat doet die hier? waar is dit geod voor?'
            $_SESSION["CurrentNaam"] = $_POST["ProjectID"];
            header("Location: View.php");
            //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
            //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
        } else{
            echo "Record niet opgeslagen";
        }
    } else {
        echo "Er gaat iets mis. probeer nogmaals<br>";
    }
}

function getUitvoer(){
    $projecttext = getUitvoerProject();
    $gebruikertext   = getUitvoerGebruiker();
    $cijfer = getUitvoerCijfer();
    $uitvoer = <<<EOD
    <h1>Toevoegen Feedback</h1>
<table>
    <form action = "Add.php" method="post" >
    <tr>
        <td>ProjectID</td>
        <td>$projecttext</td>
    </tr>
    <tr>
        <td>Gebruiker</td>
        <td>$gebruikertext</td>
    </tr>
    <tr>
        <td>Cijfer</td>
        <td>$cijfer</td>
    </tr>
    <tr>
        <td>Feedback</td>
        <td><textarea maxlength="500" name="Review" cols="31" 
        placeholder="Max 500 characters" required></textarea></td>
    </tr>
    <tr>
        <td><input type="submit" name="submit" value="Toevoegen"/></td>
    </tr>
    
    </form >
</table>
EOD;
    return $uitvoer;
}

function getUitvoerProject(){
    //$projectcontroller = new ProjectController();

    $text = "<select id='PID' name='ProjectID'>";
    for ($i=1;$i<=10;$i++){
        $text .= "<option value='$i'>$i MoetNog</option>";
    }
    return $text;
}

function getUitvoerGebruiker(){
    $gebruikercontroller = new GebruikerController(-1);
    $text = "<select id=\"GebrID\" name=\"GebruikerID\">";
    foreach ($gebruikercontroller->getGebruikers() as $gebruiker){
        $text .= "<option value='".$gebruiker->getGebruikerID()."'>".$gebruiker->getGebruikersnaam()."</option>";
    }

    return $text;
}

function getUitvoerCijfer(){
    $text = "<select id=\"Cijfer\" name=\"Cijfer\">";

    for($i=1;$i<=10;$i++){
        $text .= "<option value='$i'>$i</option>";
    }

    return $text;
}

$uitvoer = getUitvoer();
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen school" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
    <link rel="stylesheet" href="/StudentServices/css/menu.css">
    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body>

<!--kunnen we hier niet een codesnippet/subpagina van maken-->
<div class="header">
    <nav id="menu">
        <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
        <input type="checkbox" id="tm">
        <ul class="main-menu cf">
            <li><a href="./View.php">Terug</a></a></li>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<?php
if (!isset($_POST["FeedbackID"])){
    echo $uitvoer;
}
?>
</body>
</html>