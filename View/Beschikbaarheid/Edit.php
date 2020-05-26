<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");
session_start();
?>
<html>
<body>
<h1>Wijzigen beschikbaarheid</h1>
<?php


if (isset($_GET["ID"])){
    $beschikbaarheidcontroller = new BeschikbaarheidController();
    $sg               = $beschikbaarheidcontroller->getById($_GET["ID"]);

    if (isset($sg)){
        $beschikbaarheid                     = new Beschikbaarheid($sg['SchoolID'], $sg['Schoolnaam']);
        $_SESSION["CurrentSchool"]   = $beschikbaarheid;
        $_SESSION["CurrentSchoolid"] = $beschikbaarheid->getSchoolID();

    }
}

if (isset($_POST["SchoolNaam"])){
    $_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
}

if ($_SESSION["CurrentSchool"] != null){
    $beschikbaarheid = $_SESSION["CurrentSchool"];

}

?>

<?php
$value = "";
if (isset($_POST["Post"])){
    $value = $_SESSION["CurrentNaam"];
} else{
    if (isset($_GET["ID"])){
        $value = $beschikbaarheidl->getSchoolnaam();
    } else{
        $value = $_POST["SchoolNaam"];
    }
}

if (!isset($_POST["Delete"]) && isset($_GET["ID"])){
    echo "<form action=\"Edit.php\" method=\"post\">
    School:
    <input type=\"text\" name=\"SchoolNaam\" value=\"" . $value . "\"/>
    <input type=\"submit\" value=\"post\" name=\"post\">
    <input type=\"submit\" value=\"delete\" name=\"delete\">
    </form>";

}

if (isset($_POST["delete"])){
    $beschikbaarheidcontroller = new BeschikbaarheidController();
    if ($beschikbaarheidcontroller->delete($_SESSION["CurrentSchoolid"])){
        header("Location: View.php");
        //echo "Record verwijderd";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
    }

} else{
    if (!isset($_POST["Delete"]) && isset($_POST["SchoolNaam"]) &&
        isset($_SESSION["CurrentSchoolid"]))//post van maken dit is niet goed,.
    {
        $beschikbaarheidcontroller = new BeschikbaarheidController();
        if ($_SESSION["CurrentNaam"]){
            $beschikbaarheid = new School($_SESSION["CurrentSchoolid"], $_SESSION["CurrentNaam"]);
        }

        if ($beschikbaarheidcontroller->update($beschikbaarheid)){
            $_SESSION["CurrentSchool"]   = $beschikbaarheid;
            $_SESSION["CurrentNaam"]     = $beschikbaarheid->getSchoolnaam();
            $_SESSION["CurrentSchoolid"] = $beschikbaarheid->getSchoolID();
            header("Location: View.php");
            //echo "Record opgeslagen.";
            //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
        } else{
            echo "Record niet opgeslagen";
        }
    } else{
        echo "<button onclick=\"window.location.href = 'View.php';\">Terug</button>";

    }
}
?>

</body>
</html>