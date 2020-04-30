
<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
session_start();
?>
<html>
<body>
<h1>Wijzigen school</h1>
<?php


if (isset($_GET["ID"]))
{
    $schoolcontroller= new SchoolController();
    $sg = $schoolcontroller->getById($_GET["ID"]);

    if ( isset($sg))
    {
        $school = new School($sg['SchoolID'],$sg['Schoolnaam']);
        $_SESSION["CurrentSchool"] = $school;
        $_SESSION["CurrentSchoolid"] = $school->getSchoolID();

    }
}

if ( isset($_POST["SchoolNaam"]))
{
    $_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
}

if ( $_SESSION["CurrentSchool"] != null)
{
    $school = $_SESSION["CurrentSchool"];

}

?>

<?php
$value = "";
if (isset($_POST["Post"]))
    $value =  $_SESSION["CurrentNaam"];
else if (isset($_GET["ID"]))
    $value =  $school->getSchoolnaam();
else
    $value =  $_POST["SchoolNaam"];

if (!isset($_POST["Delete"]) && isset($_GET["ID"]))
{
    echo "<form action=\"Edit.php\" method=\"post\">
    School:
    <input type=\"text\" name=\"SchoolNaam\" value=\"" . $value . "\"/>
    <input type=\"submit\" value=\"post\" name=\"post\">
    <input type=\"submit\" value=\"delete\" name=\"delete\">
    </form>";

}

if (isset($_POST["delete"]))
{
    $schoolcontroller= new SchoolController();
    if ($schoolcontroller->delete($_SESSION["CurrentSchoolid"])) {
        header("Location: View.php");
        //echo "Record verwijderd";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
    }

}
else if (!isset($_POST["Delete"]) && isset($_POST["SchoolNaam"]) && isset($_SESSION["CurrentSchoolid"]))//post van maken dit is niet goed,.
{
    $schoolcontroller= new SchoolController();
    if ($_SESSION["CurrentNaam"])
    {
        $school = new School( $_SESSION["CurrentSchoolid"],$_SESSION["CurrentNaam"]);
    }

    if ($schoolcontroller->update($school))
    {
        $_SESSION["CurrentSchool"] = $school;
        $_SESSION["CurrentNaam"] = $school->getSchoolnaam();
        $_SESSION["CurrentSchoolid"] = $school->getSchoolID();
        header("Location: View.php");
        //echo "Record opgeslagen.";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
    }
    else
    {
        echo "Record niet opgeslagen";
    }
}
else{
    echo "<button onclick=\"window.location.href = 'View.php';\">Terug</button>";

}
?>

</body>
</html>