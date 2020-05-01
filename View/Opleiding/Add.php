
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Enum/EnumVoltijdDeeltijd.php");
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen opleiding" content="index">
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

<div class="info">
<!--kunnen we van bovenstaande niet een codesnippet/subpagina van maken-->

<?php
if (!isset($_POST["OpleidingNaam"]) && !isset($_POST["VoltijdDeeltijd"]))
{
echo "<h1 > Toevoegen opleiding </h1 ><br>
<form action = \"Add.php\" method = \"post\" >
        Opleiding:
    <input type = \"text\" name = \"OpleidingNaam\" />
    <select name=\"VoltijdDeeltijd\">";
        $voldeel = new EnumVoltijdDeeltijd();
        foreach($voldeel->getConstants() as $vd)
        {
            echo "<option value=\"$vd\">$vd</option>";
        }
   echo"</select>
    <input type = \"submit\" >
    </form >";
}

if ( isset($_POST["OpleidingNaam"]) && isset($_POST["VoltijdDeeltijd"]))
{
    $opleidingcontroller= new OpleidingController();
    if ($opleidingcontroller->add($_POST["OpleidingNaam"],$_POST["VoltijdDeeltijd"]))
    {
        header("Location: /StudentServices/View/Opleiding/View.php");
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