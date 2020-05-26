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
include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");

?>
<!--overige knoppen-->


<div class="homepage">
      <?php require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/View/Homepagina/view.php");?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/footer.php"); ?>
</body>
</html>