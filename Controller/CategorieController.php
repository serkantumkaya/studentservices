<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ("C:xampp/htdocs/StudentServices/Model/CategorieModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Categorie.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class CategorieController
{
    private CategorieModel $Categoriemodel;

    public function __construct(){
        $this->Categoriemodel = new CategorieModel();
    }

    public function getCategorieen(){
        $categorielijst = array();
        foreach ($this->Categoriemodel->getCategorieen() as $categorie){
            $categorieObj      = new Categorie($categorie['CategorieID'],$categorie['Categorienaam']);
            $categorielijst [] = $categorieObj;
        }
        return $categorielijst;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Categorienaam){
        return $this->Categoriemodel->Add($Categorienaam);
    }

    function delete(int $Id){
        return $this->Categoriemodel->Delete($Id);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function update(Categorie $Categorie){
        return $this->Categoriemodel->Update($Categorie);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function getById(int $id){
        $Categorie = $this->Categoriemodel->Get($id);
        if(!empty($Categorie) && $Categorie != null){
            return new Categorie($Categorie['CategorieID'],$Categorie['Categorienaam']);
        }
        else{
            return null;
        }
    }
}
