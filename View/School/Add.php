<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
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
if (!isset($_POST["SchoolNaam"]))
{
echo "<h1 > Toevoegen school </h1 ><br>
<form action = \"Add.php\" method = \"post\" >
        School:
    <input type = \"text\" name = \"SchoolNaam\" />
    <input type = \"submit\" >
</form >";
}

if ( isset($_POST["SchoolNaam"]))//post van maken dit is niet goed,.
{
    $schoolcontroller= new SchoolController();
    if ($schoolcontroller->add($_POST["SchoolNaam"])) {
        //$_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
        header("Location: /StudentServices/View/School/View.php");
        //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
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