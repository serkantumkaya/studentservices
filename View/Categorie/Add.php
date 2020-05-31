<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/CategorieController.php");
session_start();
?>
<!DOCTYPE HTML>
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
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
    <?php
    if (!isset($_POST["CategorieNaam"]))
    {
        echo "<h1 > Toevoegen categorie </h1 ><br>
<form action = \"Add.php\" method = \"post\" >
        Categorie:
    <input type = \"text\" name = \"CategorieNaam\" />
    <input type = \"submit\" >
</form >";
    }

    if ( isset($_POST["CategorieNaam"]))//post van maken dit is niet goed,.
    {
        $categoriecontroller= new CategorieController();
        if ($categoriecontroller->add($_POST["CategorieNaam"])) {
            //$_SESSION["CurrentNaam"] = $_POST["CategorieNaam"];
            header("Location: /StudentServices/View/Categorie/View.php");
            //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
            //echo "<button onclick=\"window.location.href = '/StudentServices/View/Categorie/Index.php';\">Terug</button>";
        }
        else
        {
            echo "Record niet opgeslagen";
        }
    }
    ?>
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