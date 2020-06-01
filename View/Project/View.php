<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

session_start();

if (empty($_Post) && !isset($_Post["actie"])){
    $projectController   = new ProjectController();
    $gebruikerController = new GebruikerController(-1);
}

?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="description" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
    <link rel="stylesheet" href="/StudentServices/css/menu.css">
    <script type="text/javascript" src="/StudentServices/JS/script.js">
        <?php
        //nu i
        $focus = "";
        if (isset($_SESSION["CurrentNaam"])){
            $focus = trim($_SESSION["CurrentNaam"]);
        }
        ?>
    </script>
</head>
<body>
<div class="header">
    <nav id="menu">
        <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
        <input type="checkbox" id="tm">
        <ul class="main-menu cf">
            <li><a href="Add.php">Nieuw</a></li>
            <li><a href="/StudentServices/index.php">Terug</a></li>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<form method="post" action="Edit.php">
    <table>
        <tr>
            <th>Gemaakt door</th>
            <th>Titel</th>
            <th>Omschrijving</th>
            <th>Type</th>
        </tr>
        <?php

        foreach ($projectController->getProjecten() as $project){

            echo "<tr>
                    <td>
                        <input type=\"submit\" value=\"" . $gebruikerController->getById($project->getGebruikerID()) .
                "\" formaction='../Profiel/Edit.php?ID=" . $project->getGebruikerID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                       <input type=\"submit\" value=\"" . $project->getTitelKort() .
                "\" formaction='Edit.php?ID=" . $project->getProjectID() .
                "' class=\"table1col\">
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $project->getBeschrijving() .
                "\" formaction='Edit.php?ID=" . $project->getProjectID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $project->getType() .
                "\" formaction='Edit.php?ID=" . $project->getProjectID() .
                "' class=\"table1col\">
                    </td>
                    
                </tr>";
        }
        ?>
    </table>
</form>

<button><a href="Zoek.php">Zoekopdrachten</a></button>
</body>
</html>

