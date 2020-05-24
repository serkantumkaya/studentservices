<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
session_start();
print_r($_POST);


if (isset($_POST['submit'])){
    if (isset($_POST["Reactie"])){
        $reactiecontroller = new ReactieController();
        if ($reactiecontroller->add($_POST["ProjectID"], $_POST['GebruikerID'], $_POST['Reactie'])){
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
    $uitvoer = <<<EOD
    <h1>Toevoegen Reactie</h1>
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
        <td>Reactie</td>
        <td><textarea maxlength="500" name="Reactie" cols="31" 
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
    $projectcontroller = new ProjectController();
    $text = "<select id='PID' name='ProjectID'>";
    foreach ($projectcontroller->getProjecten() as $project){
        $text .= "<option value='".$project->getProjectID()."'>".$project->getTitel()."</option>";
    }
    return $text;


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

$uitvoer = getUitvoer();
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Reactie" content="index">
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
<?php
if (!isset($_POST["ReactieID"])){
    echo $uitvoer;
}
?>
</body>
</html>