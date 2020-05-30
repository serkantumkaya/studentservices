<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/BeschikbaarheidController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");

session_start();
$ProjectID = 0;

$ProjectID = 0;
$StartTijd = null;
$EindTijd = null;

if (isset($_POST) && !isset($_GET["ID"]))
{
    $ProjectID = $_SESSION["ProjectID"];
    $timesd                 = new DateTime();

    $StartTijd = isset($_POST["StartTijd"]) ? $_POST["StartTijd"] : $timesd->format("d-m-Y H:i:s");
    $EindTijd = isset($_POST["EindTijd"]) ? $_POST["EindTijd"] : $timesd->format("d-m-Y H:i:s");
}
else
{
    $ProjectID = $_SESSION["ProjectID"];
    $beschikbaarheidController = new BeschikbaarheidController();

    $_SESSION["Beschikbaarheid"] = $_GET["ID"];
    $beschikbaarheid = $beschikbaarheidController->getByID($_GET["ID"]);

    $StartTijd = $beschikbaarheid->getStartTijd()->format("Y-m-d\TH:i:s");
    $EindTijd = $beschikbaarheid->getEindTijd()->format("Y-m-d\TH:i:s");
}
?>

<!DOCTYPE HTML>
<html>
<head>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");?>
<body>

<h1 > <?php echo Translate::GetTranslation("BeschikbaarheidEditAvailabilityFor");?>
    <?php
    $projectcontroller = new ProjectController();
    $project = $projectcontroller->getById($_SESSION["ProjectID"]);
    echo $project->getTitel();
    ?>
</h1 >
<form action ="Edit.php" method="post" >
    <div class="block">
        <label class="formlabel"><?php echo Translate::GetTranslation("BeschikbaarheidStartTimeLabel"); ?></label>
        <input type="datetime-local" name="StartTijd" value="<?php echo $StartTijd  ?>" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}"/>
    </div>
    <div class="block">
        <label class="formlabel"><?php echo Translate::GetTranslation("BeschikbaarheidEndTimeLabel"); ?></label>
        <input type="datetime-local" name="EindTijd" value="<?php echo $EindTijd  ?>" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}"/>
    </div>

    <input type="submit" >
</form >

<?php
if (isset($StartTijd) && isset($EindTijd) && !isset($_GET["ID"]))//post van maken dit is niet goed,.
{
    $beschikbaarheidcontroller = new BeschikbaarheidController();

    $ST     = new DateTime($StartTijd);
    $ET     = new DateTime($EindTijd);

    if ($beschikbaarheidcontroller->Update($_SESSION["Beschikbaarheid"],$_SESSION["ProjectID"],$ST ,$ET))
    {

        header("Location: /studentservices/View/Beschikbaarheid/View.php");
    }
    else{
        echo Translate::GetTranslation("BeschikbaarheidRecordnotSaved");
    }
}
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</body>
</html>