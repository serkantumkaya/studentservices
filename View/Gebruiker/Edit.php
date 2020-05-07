
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen gebruiker" content="index">
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

<?php


if (isset($_GET["ID"]))
{
    $gebruikercontroller= new GebruikerController();
    $gebruiker= $gebruikercontroller->getById($_GET["ID"]);
    $_SESSION["CurrentGebruiker"] = $gebruiker;
}

if (isset($_POST["NaamGebruiker"]) || isset($_POST["VoltijdDeeltijd"]))
{
    $_SESSION["CurrentNaam"] = $_POST["NaamGebruiker"];
    $_SESSION["VoltijdDeeltijd"] = $_POST["VoltijdDeeltijd"];
}

if ( $_SESSION["CurrentGebruiker"] != null)
{
    $gebruiker = $_SESSION["CurrentGebruiker"];
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
    $valueNaam = $gebruiker->getNaamgebruiker();
    $valueVD=   $gebruiker->getVoltijdDeeltijd();
}
else {
    $valueNaam = $_POST["NaamGebruiker"];
    $valueVD=  $_POST["VoltijdDeeltijd"];
}

if (!isset($_POST["Delete"]) && isset($_GET["ID"]))
{
    //todo : object van maken?
    echo "<h1 > Wijzigen gebruiker </h1 ><br>
    <form action = \"Edit.php\" method = \"post\" >
            Gebruiker:
        <input type = \"text\" name = \"NaamGebruiker\" value=\"" . $valueNaam . "\"/>
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
    $gebruikercontroller= new GebruikerController();
    if ($gebruikercontroller->delete($_SESSION["CurrentGebruiker"]->getGebruikerID()))
    {
        header("Location: View.php");
    }

}
else if (!isset($_POST["Delete"]) && isset($_POST["NaamGebruiker"]) && isset($_POST["VoltijdDeeltijd"]) && isset($_SESSION["CurrentGebruiker"]))
{
    $gebruikercontroller= new GebruikerController();
    if ($_SESSION["CurrentNaam"] && $_SESSION["VoltijdDeeltijd"])
    {
        $gebruiker = new Gebruiker($_SESSION["CurrentGebruiker"]->getGebruikerID(),$_SESSION["CurrentNaam"],$_SESSION["VoltijdDeeltijd"]);
    }

    if ($gebruikercontroller->update($gebruiker))
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