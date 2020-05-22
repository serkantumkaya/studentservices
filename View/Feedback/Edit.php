<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
if (isset($_GET["ID"])){
    $feedbackController = new FeedbackController();
    $feedback           = $feedbackController->getById($_GET["ID"]);
}

if ($_POST){
    $feedbackController = new FeedbackController();
    if (isset($_POST['Wijzig'])){
        $feedback = new Feedback($feedback->getFeedbackID(), $_POST['GebruikerID'], $_POST['ProjectID'],
            $_POST['Cijfer'], $_POST['Review']);
        $feedbackController->update($feedback);
        header('Location: View.php');
    }
    if (isset($_POST['Verwijder'])){
        $feedbackController->delete($feedback->getFeedbackID());
        header('Location: View.php');
    }
}

function getUitvoer(Feedback $feedback){
    $projecttext   = getUitvoerProject();
    $gebruikertext = getUitvoerGebruiker($feedback);
    $cijfer        = getUitvoerCijfer($feedback);
    $review        = getUitvoerReview($feedback);
    $feedbackID    = $feedback->getFeedbackID();
    $uitvoer       = <<<EOD
<table>
    <form action = "Edit.php?ID=$feedbackID" method="post" >
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
        placeholder="Max 500 characters" required>$review</textarea></td>
    </tr>
    <tr>
        <td><input type="submit" name="Wijzig" value="Wijzigen"/></td>
        <td><input type="submit" name="Verwijder" value="Verwijder"/></td>
    </tr>
    
    </form >
</table>
EOD;
    return $uitvoer;
}

function getUitvoerProject(){
    //$projectcontroller = new ProjectController();

    $text = "<select id='PID' name='ProjectID'>";
    for ($i = 1; $i<=10; $i++){
        $text .= "<option value='$i'>$i MoetNog</option>";
    }
    return $text;
}

function getUitvoerGebruiker(Feedback $feedback){
    $gebruikercontroller = new GebruikerController($feedback->getGebruikerID());
    $huidigenaam         = $gebruikercontroller->getById()->getGebruikersnaam();

    $text = "<select id=\"GebrID\" name=\"GebruikerID\">";
    foreach ($gebruikercontroller->getGebruikers() as $gebruiker){
        if ($gebruiker->getGebruikersnaam() !== $huidigenaam){
            $text .= "<option value='" . $gebruiker->getGebruikerID() . "'>" . $gebruiker->getGebruikersnaam() .
                "</option>";
        } else{
            $text .= "<option selected='selected' value='" . $gebruiker->getGebruikerID() . "'>" .
                $gebruiker->getGebruikersnaam() .
                "</option>";
        }
    }

    return $text;
}

function getUitvoerCijfer(Feedback $feedback){
    $text = "<select id=\"Cijfer\" name=\"Cijfer\">";

    for ($i = 1; $i<=10; $i++){
        if ($i != $feedback->getCijfer()){
            $text .= "<option value='$i'>$i</option>";
        } else{
            $text .= "<option selected='selected'  value='$i'>$i</option>";
        }
    }
    return $text;
}

function getUitvoerReview(Feedback $feedback){
    return $feedback->getReview();
}

$uitvoer = getUitvoer($feedback);
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

    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
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

<h1>Wijzigen Feedback</h1>
<?php

if (!$_POST){
    echo $uitvoer;
}

?>
</body>
</html>