<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/BeschikbaarheidController.php");
session_start();
if (!isset($_POST["BeschikbaarheidNaam"])){
    echo "<html >
<body >
<h1 > Toevoegen beschikbaarheid </h1 >
<form action = \"Add.php\" method = \"post\" >
        Beschikbaarheid:
    <input type = \"text\" name = \"BeschikbaarheidNaam\" />
    <input type = \"submit\" >
</form >";
}

if (isset($_POST["BeschikbaarheidNaam"]))//post van maken dit is niet goed,.
{
    $beschikbaarheidcontroller = new BeschikbaarheidController();
    if ($beschikbaarheidcontroller->add($_POST["BeschikbaarheidNaam"])){
        $_SESSION["CurrentNaam"] = $_POST["BeschikbaarheidNaam"];
        header("Location: View.php");
        //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/Beschikbaarheid/Index.php';\">Terug</button>";
    } else{
        echo "Record niet opgeslagen";
    }
}
?>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</body>
</html>