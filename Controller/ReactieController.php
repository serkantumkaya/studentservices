<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ReactieModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Reactie.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class ReactieController
{
    private ReactieModel $reactiemodel;
    private ProjectController $projectcontroller;

    public function __construct(){
        $this->reactiemodel = new ReactieModel();
        $this->projectcontroller = new ProjectController();
    }

    public function getReacties(){
        $Reactielijst = array();
        foreach ($this->reactiemodel->getReacties() as $reactieObject){
            $reactieObject = new Reactie(
                $reactieObject['ReactieID'],
                $reactieObject['Timestamp'],
                $reactieObject['GebruikersID'],
                $reactieObject['ProjectID'],
                $reactieObject['Reactie']);
            $Reactielijst [] = $reactieObject;
        }
        return $Reactielijst;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $ReactieID, string $Timestamp, int $GebruikerID,int $ProjectID,string $Reactie){
        return $this->reactiemodel->Add($ReactieID, $Timestamp,$GebruikerID,$ProjectID,$Reactie);
    }

    function delete(int $Id){
        return $this->reactiemodel->Delete($Id);
    }

    function update(Reactie $Reactie){
        return $this->reactiemodel->Update($Reactie);
    }

    function getById(int $ReactieID): reactie{
        $Reactie = $this->reactiemodel->GetById($ReactieID);
        return new Reactie(
            $Reactie['ReactieID'],
            $Reactie['Timestamp'],
            $Reactie['GebruikersID'],
            $Reactie['ProjectID'],
            $Reactie['Reactie']);
    }
    public function getByProjectID(int $projectID) :array{
        $Reactielijst = array();
        foreach ($this->Reactiemodel->getByProjectID($projectID) as $Reactie){
            $reactieObj     = new Reactie(
                $Reactie['FeedbackID'],
                $Reactie['GebruikerID'],
                $Reactie['ProjectID'],
                $Reactie['Cijfer'],
                $Reactie['Review']);
            $Reactielijst[] = $reactieObj;
        }
        return $Reactielijst;
    }
}