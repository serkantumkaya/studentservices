<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");
session_start();
print_r($_POST);
if (isset($_POST["FeedbackID"]))//post van maken dit is niet goed,.
{
    $feedbackcontroller = new FeedbackController();
    if ($feedbackcontroller->add($_POST["SchoolNaam"])){
        $_SESSION["CurrentNaam"] = $_POST["SchoolNaam"];
        header("Location: View.php");
        //echo "Record opgeslagen. Klik op terug om naar het overzicht te gaan.";
        //echo "<button onclick=\"window.location.href = '/StudentServices/View/School/Index.php';\">Terug</button>";
    } else{
        echo "Record niet opgeslagen";
    }
}




?><!DOCTYPE HTML>
<html>
<body>
<?php
if (!isset($_POST["FeedbackID"])){
    echo "<h1> Toevoegen Feedback</h1 >
    <form action = \"Add.php\" method = \"post\" >
        Feedback:
    <input type = \"text\" name = \"SchoolNaam\" />
    <input type = \"submit\" >
    </form >";
}
?>
</body>
</html>