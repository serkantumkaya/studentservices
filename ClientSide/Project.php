<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CategorieController.php");
session_start();


$view = $_GET['view'];

switch ($view){
    case 'detail':
        require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/View/Project/Client/detail.php");
        break;
    case 'change':
        require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/View/Project/Client/gebruikerChange.php");
        break;
    case 'add':
        require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/View/Project/Client/gebruikerAdd.php");
        break;
}





/*
if ($view === 'overzicht'){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/View/Project/detail.php");
}*/
