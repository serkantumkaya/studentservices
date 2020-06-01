<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();

if (empty($_Post) && !isset($_Post["actie"])){
    $feedbackController = new FeedbackController();
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
            <th>Gegeven door</th>
            <th>ProjectID</th>
            <th>Feedback</th>
            <th>Cijfer</th>
        </tr>
        <?php

        foreach ($feedbackController->getFeedback() as $feedback){

            echo "<tr>
                    <td>
                        <input type=\"submit\" value=\"" . $gebruikercontroller->getById($feedback->getGebruikerID()) .
                "\" formaction='../Profiel/Edit.php?ID=" . $feedback->getGebruikerID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $feedback->getProjectID() .
                "\" formaction='../Project/Edit.php?ID=" . $feedback->getProjectID() .
                "' class=\"table1col\"> 
                    </td>
                    <td>
                       <input type=\"submit\" value=\"" . $feedbackController->getReviewKort($feedback->getReview()) .
                "\" formaction='Edit.php?ID=" . $feedback->getFeedbackID() .
                "' class=\"table1col\">
                    </td>
                    <td>
                        <input type=\"submit\" value=\"" . $feedback->getCijfer() .
                "\" formaction='Edit.php?ID=" . $feedback->getFeedbackID() .
                "' class=\"table1col\"> 
                    </td>
                    
                </tr>";
        }
        ?>
    </table>
</form>
</body>
</html>

