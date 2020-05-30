<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CSVController.php");
session_start();
$databew = "";
$errors        = "";
$csvcontroller = new CSVController();

if (isset($_POST["download"])){
    $csvcontroller->setFileschoolname("scholen");
    $csvcontroller->generatecsvfileschool();
    $csvcontroller->downloadcsv($csvcontroller->getFileschoolname());
}

if (isset($_POST["upload"]) && !empty($_FILES)){
    $databew = "";
    $data    = $csvcontroller->uploadcsv($_FILES);
    $actions = $csvcontroller->settodatabaseschool($data["result"],$data["errorindex"]);
    $errors  = $data["errors"];
    $databew .= $actions["update"] . " records geupdate<br>";
    $databew .= $actions["add"] . " records toegevoegt<br>";
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

<div class="school">
    <p><?= $databew ?></p>
    <p><?= $errors ?></p>
    <div>
        <form action="" method="post">
            <input id="Submit" type="submit" value="download csv file">
            <input id="csv_download" type="hidden" name="download" value="download">
        </form>
    </div>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <input id="Submit" type="submit" value="upload csv file">
            <input type="file" accept=".csv" name="fileToUpload" id="fileToUpload">
            <input id="csv_upload" type="hidden" name="upload" value="upload">
        </form>
    </div>
    <form method="post" action="Edit.php">
        <table>
            <tr>
                <th>School</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <?php

                    //DO NOT USE A BIG IF. If the conditions are not met. Return.
                    if (empty($_Post) && !isset($_Post["actie"])){
                        $schoolcontroller = new SchoolController();

                        foreach ($schoolcontroller->GetScholen() as $school){
                            echo "<tr> <td> <input type=\"submit\" value=\"" . $school->getSchoolnaam() .
                                "\" formaction='Edit.php?ID=" . $school->getSchoolID() .
                                "' class=\"table1col\"> </td></tr>";
                        }
                    }

                    ?>
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="footer">
    <div>© Student Services, 2020
        <?php
        $GebrID = 1;
        echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";

        ?>
    </div>
</div>
</body>
</html>

