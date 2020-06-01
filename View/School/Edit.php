<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/SchoolController.php");
session_start();
?><!DOCTYPE HTML>
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
    <link rel="stylesheet" href="/StudentServices/css/menu.css">
    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body>
<!--kunnen we hier niet een codesnippet/subpagina van maken-->
<div class="header">
    <nav id="menu">
        <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
        <input type="checkbox" id="tm">
        <ul class="main-menu cf">
            <li><a href="./View.php">Terug</a></a></li>
        </ul>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>
<h1>Wijzigen school</h1>
<?php
if (isset($_GET["ID"])){
    $schoolcontroller          = new SchoolController();
    $school                    = $schoolcontroller->getById($_GET["ID"]);
    $_SESSION["CurrentSchool"] = $school;
}

if (isset($_POST["SchoolNaam"])){
    $_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
}

if ($_SESSION["CurrentSchool"] != null){
    $school = $_SESSION["CurrentSchool"];
}

?>

<?php
$value = "";
if (isset($_POST["Post"])){
    $value = $_SESSION["CurrentNaam"];
} else{
    if (isset($_GET["ID"])){
        $value = $school->getSchoolnaam();
    } else{
        $value = $_POST["SchoolNaam"];
    }
}

if (!isset($_POST["Delete"]) && isset($_GET["ID"])){
    echo "<form action=\"Edit.php\" method=\"post\">
    School:
    <input type=\"text\" name=\"SchoolNaam\" value=\"" . $value . "\"/>

            <input type=\"submit\" value=\"post\" name=\"post\" class=\"ssbutton\">
            <input type=\"submit\" value=\"delete\" name=\"delete\" class=\"ssbutton\">
    </form>";
}

if (isset($_POST["delete"])){
    $schoolcontroller = new SchoolController();
    if ($schoolcontroller->delete($_SESSION["CurrentSchool"]->getSchoolID())){
        header("Location: View.php");
    }
} else{
    if (!isset($_POST["Delete"]) && isset($_POST["SchoolNaam"]) && isset($_SESSION["CurrentSchool"])){
        $schoolcontroller = new SchoolController();
        if ($_SESSION["CurrentNaam"]){
            $school = new School($_SESSION["CurrentSchool"]->getSchoolID(),$_SESSION["CurrentNaam"]);
        }

        if ($schoolcontroller->update($school)){
            header("Location: View.php");
        } else{
            echo "Record niet opgeslagen";
        }
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