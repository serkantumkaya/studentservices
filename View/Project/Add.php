<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CategorieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");

session_start();

//var_dump($_POST);

$deadline = '';


if (isset($_POST['submit'])){
    if (isset($_POST["Beschrijving"]) && isset($_POST['Titel']) && isset($_POST['Type'])){
        $projectController = new ProjectController();
        if (isset($_POST['NietBekend']) && $_POST['NietBekend'] == 'on'){
            $deadline == 'NULL';
        } else{
            var_dump("test");
            $deadline = convert($_POST['Deadline']);
        }

        if ($projectController->add(intval($_POST['GebruikerID']), $_POST['Titel'], $_POST['Type'],
            $_POST['Beschrijving'], intval($_POST['CategorieID']),
            $deadline, $_POST['Status'], $_POST['Locatie'])){

            header('Location: View.php');
        } else{
            echo "Record niet opgeslagen";
        }
    } else{
        echo "Er gaat iets mis, probeer nogmaals <br>";
    }
}

function convert($datum){
    $datum = explode("T", $datum);
    return $datum[0] . " " . $datum[1];
}

$uitvoer = getUitvoer();

function getUitvoer(){
    $gebruikertext = getUitvoerGebruiker();
    $type          = getUitvoerType();
    $categorie     = getUitvoerCategorie();
    $status        = getUitvoerStatus();

    $uitvoer = <<<EOD
<table>
    <form action = "Add.php" method="post" >
    <tr>
        <td>Gebruiker</td>
        <td>$gebruikertext</td>
    </tr>
    <tr>
        <td>Titel</td>
        <td><textarea maxlength="70" name="Titel" cols="30" rows="2"
        required></textarea></td>
    </tr>
    <tr>
        <td>Omschrijving</td>
        <td><textarea maxlength="500" name="Beschrijving" cols="40" rows="6"
        placeholder="Max 500 characters" required></textarea></td>
    </tr>
    <tr>
        <td>Type</td>
        <td>$type</td>
    </tr>
    <tr>
        <td>Categorie</td>
        <td>$categorie</td>
    </tr>   
    <tr>
        <td>Deadline</td>
        <td><input type="datetime-local" name="Deadline"/></td><td><input type="checkbox" name="NietBekend"/>Niet Bekend</td>
    </tr>    
    
    <tr>
        <td>Status</td>
        <td>$status</td>
    </tr>  
    <tr>
        <td>Locatie</td>
        <td><input type="text" name="Locatie"/></td>
    </tr>  
    <tr>
        <td>Verwijderd</td>
        <td>Nee</td><input type="hidden" name="Verwijderd" value="false"/>
    </tr>  
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Toevoegen"/></td>
    </tr>
    
    
    </form >
</table>
EOD;
    return $uitvoer;
}

function getUitvoerGebruiker(){
    $gebruikercontroller = new GebruikerController(-1);
    $text                = "<select id=\"GebrID\" name=\"GebruikerID\">";
    foreach ($gebruikercontroller->getGebruikers() as $gebruiker){
        $text .= "<option value='" . $gebruiker->getGebruikerID() . "'>" . $gebruiker->getGebruikersnaam() .
            "</option>";
    }


    return $text;
}

function getUitvoerType(){
    $types = array('vragen', 'Aanbieden');
    $text  = "<select id=\"Type\" name=\"Type\">";
    foreach ($types as $type){
        $text .= "<option value='" . $type . "'>$type</option>";
    }
    return $text;
}

function getUitvoerCategorie(){
    $categorieController = new CategorieController();
    $categorieen         = $categorieController->getCategorieen();
    $text                = "<select id=\"Categorie\" name=\"CategorieID\">";
    foreach ($categorieen as $categorie){
        $text .= "<option value='" . $categorie->getCategorieID() . "'>" . $categorie->getCategorieNaam() .
            "</option>";
    }
    return $text;
}

function getUitvoerStatus(){
    $statussen = array(0 => 'Mee bezig', 1 => 'Klaar');
    $text      = "<select id=\"Status\" name=\"Status\">";
    foreach ($statussen as $key => $value){
        $text .= "<option value='" . $value . "'>$value</option>";
    }
    return $text;
}

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
if (!isset($_POST["ProjectID"])){
    echo $uitvoer;
}
?>
</body>
</html>