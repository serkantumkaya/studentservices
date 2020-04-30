
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
session_start();
if (!isset($_POST["SchoolNaam"]))
{
    echo "<html >
<body >
<h1 > Toevoegen school </h1 >
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
        $_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
        header("Location: View.php");
        //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
    }
    else
    {
        echo "Record niet opgeslagen";
    }
}
?>

</body>
</html>