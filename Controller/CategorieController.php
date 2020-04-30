<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/CategorieModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Categorie.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class CategorieController
{
    private CategorieModel $Categoriemodel;

    public function __construct() {
        $this->Categoriemodel = new CategorieModel();
    }

    public function GetCategorieen()
    {
        return $this->Categoriemodel->GetCategorieen()->fetchAll(PDO::FETCH_ASSOC);
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Categorienaam) {
        return $this->Categoriemodel->Add($Categorienaam);
    }

    function delete(int $Id)
    {
        return $this->Categoriemodel->Delete($Id);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function update(Categorie $Categorie)
    {
        return $this->Categoriemodel->Update($Categorie);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function getById(int $id)
    {
        $Categorie = $this->Categoriemodel->Get($id)->fetchAll(PDO::FETCH_ASSOC);

        return $Categorie[0];

    }
}
