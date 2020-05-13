<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'Includes/DB.php';
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

session_start();
if (!isset($_SESSION["GebruikerID"]) || $_SESSION["GebruikerID"]==-1)
{
    Header("Location: /StudentServices/inlogPag.php");
}

$GC = new GebruikerController($_SESSION['GebruikerID']);
$level = $GC->checkRechten();

var_dump($level);

?><!DOCTYPE HTML>
<html>
<?php
include ($_SERVER['DOCUMENT_ROOT']."/studentservices/Includes/header.php"); ?>

    <div class="info">
        <p>Hier moet nog iets komen. waarschijnlijk een projectenoverzicht of profiel overzicht<br></p>
    <?php

    ?>
    </div>
    <div class="footer">
        <div>© Student Services, 2020
            <?php
            $GebrID = 1;
            echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";
            echo "<a href=\"projecten.php?GebrID=$GebrID\">Projecten <a/>";
            echo "<a href=\"zoek.php?GebrID=$GebrID\">Zoek </a>";

            ?>
        </div>
    </div>
</div>


</body>
</html>