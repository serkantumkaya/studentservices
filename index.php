<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'Includes/DB.php';
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

        <script type="text/javascript" src="/StudentServices/JS/script.js">
        </script>
    </head>

</head>

<body>


<div class="grid-container">
    <div class="header">
        <nav id="page-nav">
            <!-- [THE HAMBURGER] -->
            <label for="hamburger">&#9776;</label>
            <input type="checkbox" id="hamburger"/>

            <!-- [MENU ITEMS] -->
            <ul>
                <?php
                // echo "<li><a href=\"index.php?GebrID=$GebrID\">Home</a></li>";
                echo "<li><a href=\"".$_SERVER['DOCUMENT_ROOT']."\StudentServices\View\School\View.php\"\">School</a></li>";
                ?>
            </ul>
        </nav>
        <img id=
             <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
    </div>
   <div class="slider">
        <div class="mySlides">
            <img src="/StudentServices/images/1.png" class="sliderimage">
        </div>

        <div class="mySlides">
            <img src="/StudentServices/images/21.png" class="sliderimage">
        </div>

        <div class="mySlides">
            <img src="/StudentServices/images/3.png" class="sliderimage">
        </div>

        <div class="mySlides">
            <img src="/StudentServices/images/4.png" class="sliderimage">
        </div>
    </div>
    <div class="info">

    <?php
    //include ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Header.php");
    //if inloggen bla bla

    //if school bla bla
    include ($_SERVER['DOCUMENT_ROOT']."/StudentServices/View/School/View.php");
    //if projecten enz enz
    ?>
    </div>
    <div class="footer">
        <div>© Student Services, 2020
            <?php
            $GebrID = 1;
            echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";
            echo "<a href=\"projecten.php?GebrID=$GebrID\">Projecten <a/>";
            echo "<a href=\"zoek.php?GebrID=$GebrID\">Zoek </a>";

            ?>
        </div>
    </div>
</div>


</body>
</html>