<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ReactieModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Reactie.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class ReactieController
{
    private ReactieModel $reactiemodel;
    //private ProjectController $projectcontroller;

    public function __construct(){
        $this->reactiemodel = new ReactieModel();
        //$this->projectcontroller = new ProjectController();
    }

    public function getReacties(){
        $Reactielijst = array();
        foreach ($this->reactiemodel->getReacties() as $reactieObject){
            $reactieObject = new Reactie(
                $reactieObject['ReactieID'],
                $reactieObject['Timestamp'],
                $reactieObject['GebruikerID'],
                $reactieObject['ProjectID'],
                $reactieObject['Reactie']);
            $Reactielijst [] = $reactieObject;
        }

        return $Reactielijst;
    }

    function add(int $GebruikerID,int $ProjectID,string $Reactie){

        return $this->reactiemodel->add($GebruikerID,$ProjectID,$Reactie);
    }

    function delete(int $Id){
        return $this->reactiemodel->Delete($Id);
    }

    function update(Reactie $Reactie){
        return $this->reactiemodel->Update($Reactie);
    }


    function getById(int $id){//kan maar een object return reactieid uniekesleutel
            $Reactie = $this->reactiemodel->GetById($id);
            if (!(!isset($Reactie) || $Reactie == false)) {
                    $reactieObj     = new Reactie(
                        $Reactie['ReactieID'],
                        $Reactie['Timestamp'],
                        $Reactie['GebruikerID'],
                        $Reactie['ProjectID'],
                        $Reactie['Reactie']);
                return $reactieObj;
            }
            else{
                return null;
            }
    }

    function getByProjectId(int $id){//deze heb ik voor homepage toegevoegt
        $Reactie = $this->reactiemodel->GetByProjectId($id);
        if (!(!isset($Reactie) || $Reactie == false)) {
            $reactielist = array();
            foreach ($Reactie as $reactie){
                $reactieObj     = new Reactie(
                    $reactie['ReactieID'],
                    $reactie['Timestamp'],
                    $reactie['GebruikerID'],
                    $reactie['ProjectID'],
                    $reactie['Reactie']);
                $reactielist[] = $reactieObj;
            }
            return $reactielist;
        }
        else{
            return null;
        }
    }
    function getByGebruikerId(int $id){//deze heb ik voor homepage toegevoegt
        $Reactie = $this->reactiemodel->GetByGebruikerId($id);
        if (!(!isset($Reactie) || $Reactie == false)) {
            $reactielist = array();
            foreach ($Reactie as $reactie){
                $reactieObj     = new Reactie(
                    $reactie['ReactieID'],
                    $reactie['Timestamp'],
                    $reactie['GebruikerID'],
                    $reactie['ProjectID'],
                    $reactie['Reactie']);
                $reactielist[] = $reactieObj;
            }
            return $reactielist;
        }
        else{
            return null;
        }
    }
}