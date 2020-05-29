<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ZoekController.php");

session_start();

$zoekController = new ZoekController();

if ($_POST){
    foreach ($_POST as $key => $value){
        $zoekController->delete($key);
    }
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

            echo "<li><a href=\"/StudentServices/index.php\">Terug</a></li>";
            ?>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<form method="post" action="Zoek.php">
    <table>
        <tr>
            <th>ZoekID</th>
            <th>Zoekwoorden</th>
            <th>Resultaat</th>
            <th>Tijd</th>
        </tr>

        <?php

        foreach ($zoekController->getZoekOpdrachten() as $opdracht){

            echo "<tr>
                    <td>
                        ".$opdracht->getID()."
                    </td>
                    <td>
                       ". $opdracht->getZoekwoorden() ."
                    </td>
                    <td>
                        ". $opdracht->getResultaat() ."
                    </td>
                    <td>
                      ". $opdracht->getTijd() ."
                    </td>
                      <td>
                       <input type=\"submit\" name=".$opdracht->getID()." value=\"Delete\"></td>
                    </td>
                </tr>";
        }
        ?>

    </table>
</form>
</body>
</html>

