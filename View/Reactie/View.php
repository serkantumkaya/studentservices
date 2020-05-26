<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();

if (empty($_Post) && !isset($_Post["actie"])){
    $reactiecontroller = new ReactieController();
}
$gebruikercontroller = new GebruikerController(-1);
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
    <nav id="page-nav">
        <!-- [THE HAMBURGER] -->
        <label for="hamburger">&#9776;</label>
        <input type="checkbox" id="hamburger"/>

        <!-- [MENU ITEMS] -->

        <ul>
            <?php
            echo "<li>
            <a href=\"Add.php\">Nieuw</a>
        </li>";
            echo "<li><a href=\"/StudentServices/index.php\">Terug</a></li>";
            ?>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<form method="post" action="Edit.php">
    <table>
        <tr>
            <th>Gegeven door</th>
            <th>ProjectID</th>
            <th>Reactie</th>
            <th>Tijdstip</th>
        </tr>
        <?php

        foreach ($reactiecontroller->getReacties() as $Reactie){

            echo "<tr>
                    <td>
                        <input type=\"submit\" value=\"" . $gebruikercontroller->getById($Reactie->getGebruikerID()) .
                "\" formaction='../Profiel/Edit.php?ID=" . $Reactie->getGebruikerID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $Reactie->getProjectID() .
                "\" formaction='../Project/Edit.php?ID=" . $Reactie->getProjectID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                       <input type=\"submit\" value=\"" . $Reactie->getReactie() .
                "\" formaction='Edit.php?ID=" . $Reactie->getReactieID() .
                "' class=\"table1col\">
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $Reactie->getTimestamp() .
                "\" formaction='Edit.php?ID=" . $Reactie->getReactieID() .
                "' class=\"table1col\"> 
                    </td>
                    
                </tr>";
        }
        ?>
    </table>
</form>
</body>
</html>

