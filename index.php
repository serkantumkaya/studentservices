<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'Includes/DB.php';
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");

session_start();
if (!isset($_SESSION["GebruikerID"]) || $_SESSION["GebruikerID"] == -1){
    Header("Location: /StudentServices/inlogPag.php");
}

?><!DOCTYPE HTML>
<html>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php"); ?>
<!--overige knoppen-->


<div class="grid-container">
    <div class="info">
        <p>Hier moet nog iets komen. waarschijnlijk een projectenoverzicht of jouw profiel van de ingelogde
            gebruiker<br>
            Zoeken moet nog worden verwerkt.
            de links bovenin vanaf 'mijn profiel' werken nog niet.</p>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</body>
</html>