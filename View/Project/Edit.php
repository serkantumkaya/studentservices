<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CategorieController.php");

session_start();
if (isset($_GET["ID"])){
    $projectController = new ProjectController();
    $project           = $projectController->getById($_GET["ID"]);
}

if ($_POST){
    $ProjectController = new ProjectController();
    if (isset($_POST['Wijzig'])){
        $deadline = makeDeadline($_POST['Deadline']);

        $project = new Project($project->getProjectID(), $_POST['GebruikerID'], $_POST['Type'], $_POST['Titel'],
            $_POST['Beschrijving'], $_POST['CategorieID'], $_POST['Datumaangemaakt'],
            $deadline, $_POST['Status'], $_POST['Locatie'], $_POST['Verwijderd']);

        $projectController->update($project);
        header('Location: View.php');
    }
    if (isset($_POST['Verwijder'])){
        $ProjectController->delete($project->getProjectID());
        header('Location: View.php');
    }
}
function makeDeadline($deadline){
    $deadline = explode("T", $deadline);
    return $deadline[0] . " " . $deadline[1];
}
//Ja, dit kon beter....
//TODO: Locatie en verwijderd
function getUitvoer(Project $project){
    $gebruikertext   = getUitvoerGebruiker($project);
    $titel           = $project->getTitel();
    $beschrijving    = $project->getBeschrijving();
    $projectID       = $project->getProjectID();
    $type            = getUitvoerType($project);
    $categorie       = getUitvoerCategorie($project);
    $deadline        = getUitvoerDeadline($project);
    $status          = getUitvoerStatus($project);
    $datumaangemaakt = $project->getDatumaangemaakt();
    $locatie         = $project->getLocatie();
    $verwijderd      = getVerwijderdUitvoer($project);

    $uitvoer = <<<EOD
<table>
    <form action = "Edit.php?ID=$projectID" method="post" >
    <tr>
        <td>Gebruiker</td>
        <td>$gebruikertext</td>
    </tr>
    <tr>
        <td>Titel</td>
        <td><textarea maxlength="70" name="Titel" cols="30" rows="2"
        required>$titel</textarea></td>
    </tr>
    <tr>
        <td>Omschrijving</td>
        <td><textarea maxlength="500" name="Beschrijving" cols="40" rows="6"
        placeholder="Max 500 characters" required>$beschrijving</textarea></td>
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
        <td><input type="datetime-local" name="Deadline" value="$deadline"/></td>
    </tr>    
    <tr>
        <td>Status</td>
        <td>$status</td>
    </tr>  
    <tr>
        <td>Locatie</td>
        <td><input type="text" name="Locatie" value="$locatie" /></td>
    </tr>  
    <tr>
        <td>Verwijderd</td>
        <td>$verwijderd</td>
    </tr>  
    <input type="hidden" name="Datumaangemaakt" value="$datumaangemaakt"/>
    <tr>
        <td><input type="submit" name="Wijzig" value="Wijzigen"/></td>
        <td><input type="submit" name="Verwijder" value="Verwijder"/></td>
    </tr>
    
    
    </form >
</table>
EOD;
    return $uitvoer;
}

function getUitvoerGebruiker(Project $project){
    $gebruikercontroller = new GebruikerController($project->getGebruikerID());
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

function getUitvoerType(Project $project){
    $huidigetype = $project->getType();
    $types       = array('vragen', 'Aanbieden');
    $text        = "<select id=\"Type\" name=\"Type\">";

    foreach ($types as $type){
        if ($huidigetype == $type){
            $text .= "<option selected='selected'value='" . $type . "'>$type</option>";
        } else{
            $text .= "<option value='" . $type . "'>$type</option>";
        }
    }
    return $text;
}

function getUitvoerCategorie(Project $project){
    $categorieController = new CategorieController();
    $categorieen         = $categorieController->getCategorieen();

    $text = "<select id=\"Categorie\" name=\"CategorieID\">";
    foreach ($categorieen as $categorie){
        if ($project->getCategorieID() == $categorie->getCategorieID()){
            $text .= "<option selected='selected' value='" . $categorie->getCategorieID() . "'>" .
                $categorie->getCategorieNaam() . "</option>";
        } else{
            $text .= "<option value='" . $categorie->getCategorieID() . "'>" . $categorie->getCategorieNaam() .
                "</option>";
        }
    }
    return $text;
}

function getUitvoerDeadline(Project $project){
    $deadline = $project->getDeadline();
    $time     = new DateTime($deadline);
    $deadline = $time->format("Y-m-d H:i");
    $deadline = explode(" ", $deadline);
    return $deadline[0] . "T" . $deadline[1];
}

function getUitvoerStatus(Project $project){
    $huidigestatus = $project->getStatus();
    $statussen = array(0 => 'Mee bezig', 1 => 'Klaar');
    $text      = "<select id=\"Status\" name=\"Status\">";
    foreach ($statussen as $key => $value){
        if ($huidigestatus == $key){
            $text .= "<option selected='selected' value='" . $value . "'>$value</option>";
        } else{
            $text .= "<option value='" . $value . "'>$value</option>";
        }
    }
    return $text;
}

function getVerwijderdUitvoer(Project $project){
    $huidigverwijderd = $project->isVerwijderd();
    $statussen        = array(0 => 'Niet verwijderd', 1 => 'Verwijderd');
    $text             = "<select id=\"Verwijderd\" name=\"Verwijderd\">";
    foreach ($statussen as $key => $value){
        if ($huidigverwijderd == $key){
            $text .= "<option selected='selected' value='" . $key . "'>$value</option>";
        } else{
            $text .= "<option value='" . $key . "'>$value</option>";
        }
    }
    return $text;
}


$uitvoer = getUitvoer($project);

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

<h1>Wijzigen Project</h1>
<?php

if (!$_POST){
    echo $uitvoer;
}

?>
</body>
</html>