<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CategorieController.php");
session_start();


//bekijken wat er nodig is, voor de gebruiker wordt zo de URL netjes
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