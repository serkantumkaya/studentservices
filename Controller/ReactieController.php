<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ReactieModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Reactie.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class ReactieController
{
    private ReactieModel $reactiemodel;

    public function __construct(){
        $this->reactiemodel = new ReactieModel();
    }

    public function getReacties(){
        $ReactieArray = [];
        foreach ($this->reactiemodel->getReacties()->fetchAll(PDO::FETCH_ASSOC) as $reactieObject){
            $gebruikersc = new GebruikerController(-1);
            $profielc    = new ProfielController(-1);
            $projectc    = new ProjectController();
            $reactieObject = new Reactie(
                $reactieObject['ReactieID'],
                $reactieObject['Timestamp'],
                $reactieObject['GebruikersID'] == null?null:$gebruikersc->getById($reactieObject['GebruikersID']),
                $reactieObject['ProjectID'] == null?null:$projectc->getById($reactieObject['ProjectID']),
                $reactieObject['Reactie']);

            $ReactieArray [] = $reactieObject;
        }
        return $ReactieArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $ReactieID,int $GebruikerID,int $ProjectID,int $ProfielID,string $Reactie){
        return $this->reactiemodel->Add($ReactieID,$GebruikerID,$ProjectID,$ProfielID,$Reactie);
    }

    function delete(int $Id){
        return $this->reactiemodel->Delete($Id);
    }

    function update(Reactie $Reactie){
        return $this->reactiemodel->Update($Reactie);
    }

    function getById(int $id): reactie{
        $Reactie = $this->reactiemodel->GetById($id)->fetchAll(PDO::FETCH_ASSOC);
        return new Reactie(
            $Reactie['ReactieID'],
            $Reactie['GebruikersID'],
            $Reactie['ProjectID'],
            $Reactie['ProfielID'],
            $Reactie['Reactie'],
        );
    }
}