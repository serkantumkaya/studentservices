<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
?>
<!DOCTYPE HTML>
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
    <link rel="stylesheet" href="/StudentServices/css/Menu.css">
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
        <ul class="main-menu cf">
            <li><a href="/StudentServices/index.php">Terug</a></li>
            </li>
        </ul>
    </nav>

    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
    <form method="post" action="Edit.php">
        <table>
            <tr>
                <th>Gebruiker</th>
            </tr>
            <tr>
                <td>
                    <?php

                    //DO NOT USE A BIG IF. If the conditions are not met. Return.
                    if (empty($_Post) && !isset($_Post["actie"])){
                        LoadList();
                        return;
                    }

                    function LoadList(){
                        $gebruikercontroller = new GebruikerController($_SESSION["GebruikerID"]);

                        foreach ($gebruikercontroller->getGebruikers() as $gebruiker){
                            echo "<tr> <td> <input type=\"submit\" value=\"" . $gebruiker->getGebruikersNaam() .
                                "\" formaction='Edit.php?ID=" . $gebruiker->getGebruikerID() .
                                "' class=\"table1col\"> </td></tr>";
                        }
                    }

                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

