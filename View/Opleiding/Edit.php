<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
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
<?php


if (isset($_GET["ID"]))
{
    $opleidingcontroller= new OpleidingController();
    $opleiding= $opleidingcontroller->getById($_GET["ID"]);
    $_SESSION["CurrentOpleiding"] = $opleiding;
}

if (isset($_POST["NaamOpleiding"]) || isset($_POST["VoltijdDeeltijd"]))
{
    $_SESSION["CurrentNaam"] = $_POST["NaamOpleiding"];
    $_SESSION["VoltijdDeeltijd"] = $_POST["VoltijdDeeltijd"];
}

if ( $_SESSION["CurrentOpleiding"] != null)
{
    $opleiding = $_SESSION["CurrentOpleiding"];
}

?>

<?php
$valueNaam = "";
$valueVD = "";
if (isset($_POST["Post"]))
{
    $valueNaam =  $_SESSION["CurrentNaam"];
    $valueVD=  $_SESSION["VoltijdDeeltijd"];
}
else if (isset($_GET["ID"])) {
    $valueNaam = $opleiding->getNaamopleiding();
    $valueVD=   $opleiding->getVoltijdDeeltijd();
}
else {
    $valueNaam = $_POST["NaamOpleiding"];
    $valueVD=  $_POST["VoltijdDeeltijd"];
}

if (!isset($_POST["Delete"]) && isset($_GET["ID"]))
{
    //todo : object van maken?
    echo "<h1 > Wijzigen opleiding </h1 ><br>
    <form action = \"Edit.php\" method = \"post\" >
            Opleiding:
        <input type = \"text\" name = \"NaamOpleiding\" value=\"" . $valueNaam . "\"/>
        <select name=\"VoltijdDeeltijd\">";
            $voldeel = new EnumVoltijdDeeltijd();
            foreach($voldeel->getConstants() as $vd)
            {
                if ($vd == $valueVD)
                    echo "<option value=\"$vd\" selected>$vd</option>";
                    else
                echo "<option value=\"$vd\">$vd</option>";
            }
       echo"</select>
                    <input type=\"submit\" value=\"post\" name=\"post\" class=\"ssbutton\">
            <input type=\"submit\" value=\"delete\" name=\"delete\" class=\"ssbutton\">
        </form >";
}

if (isset($_POST["delete"]))
{
    $opleidingcontroller= new OpleidingController();
    if ($opleidingcontroller->delete($_SESSION["CurrentOpleiding"]->getOpleidingID()))
    {
        header("Location: View.php");
    }

}
else if (!isset($_POST["Delete"]) && isset($_POST["NaamOpleiding"]) && isset($_POST["VoltijdDeeltijd"]) && isset($_SESSION["CurrentOpleiding"]))
{
    $opleidingcontroller= new OpleidingController();
    if ($_SESSION["CurrentNaam"] && $_SESSION["VoltijdDeeltijd"])
    {
        $opleiding = new Opleiding($_SESSION["CurrentOpleiding"]->getOpleidingID(),$_SESSION["CurrentNaam"],$_SESSION["VoltijdDeeltijd"]);
    }

    if ($opleidingcontroller->update($opleiding))
    {
        header("Location: View.php");
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
<!--kunnen we hier niet een codesnippet/subpagina van maken-->
</body>
</html>