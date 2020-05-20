<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/CategorieController.php");
session_start();
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen categorie" content="index">
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

<div class="info">
    <!--kunnen we van bovenstaande niet een codesnippet/subpagina van maken-->

    <h1>Wijzigen categorie</h1>
    <?php


    if (isset($_GET["ID"]))
    {
        $categoriecontroller= new CategorieController();
        $categorie = $categoriecontroller->getById($_GET["ID"]);
        $_SESSION["CurrentCategorie"] = $categorie;
    }

    if (isset($_POST["CategorieNaam"]))
    {
        $_SESSION["CurrentNaam"] = $_POST["CategorieNaam"];
    }

    if ( $_SESSION["CurrentCategorie"] != null)
    {
        $categorie = $_SESSION["CurrentCategorie"];
    }

    ?>

    <?php
    $value = "";
    if (isset($_POST["Post"]))
        $value =  $_SESSION["CurrentNaam"];
    else if (isset($_GET["ID"]))
        $value =  $categorie->getCategorienaam();
    else
        $value =  $_POST["CategorieNaam"];

    if (!isset($_POST["Delete"]) && isset($_GET["ID"]))
    {
        echo "<form action=\"Edit.php\" method=\"post\">
    Categorie:
    <input type=\"text\" name=\"CategorieNaam\" value=\"" . $value . "\"/>

            <input type=\"submit\" value=\"post\" name=\"post\" class=\"ssbutton\">
            <input type=\"submit\" value=\"delete\" name=\"delete\" class=\"ssbutton\">
    </form>";

    }

    if (isset($_POST["delete"]))
    {
        $categoriecontroller= new CategorieController();
        if ($categoriecontroller->delete($_SESSION["CurrentCategorie"]->getCategorieID())) {
            header("Location: View.php");
        }

    }
    else if (!isset($_POST["Delete"]) && isset($_POST["CategorieNaam"]) && isset($_SESSION["CurrentCategorie"]))
    {
        $categoriecontroller= new CategorieController();
        if ($_SESSION["CurrentNaam"])
        {
            $categorie = new Categorie( $_SESSION["CurrentCategorie"]->getCategorieID(),$_SESSION["CurrentNaam"]);
        }

        if ($categoriecontroller->update($categorie))
        {
            header("Location: View.php");
        }
        else
        {
            echo "Record niet opgeslagen";
        }
    }
    ?>
    <!--kunnen we hier niet een codesnippet/subpagina van maken-->
</div>
<div class="footer">
    <div>© Student Services, 2020
        <?php
        $GebrID = 1;
        echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";

        ?>
    </div>
</div>
<!--kunnen we hier niet een codesnippet/subpagina van maken-->
</body>
</html>