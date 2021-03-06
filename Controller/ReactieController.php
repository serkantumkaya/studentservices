<?php

require_once ("C:xampp/htdocs/StudentServices/Model/ReactieModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Reactie.php");


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

    function getById(int $id){
        $reactie = $this->reactiemodel->GetById($id);

                return new Reactie(
                    $reactie['ReactieID'],
                    $reactie['Timestamp'],
                    $reactie['GebruikerID'],
                    $reactie['ProjectID'],
                    $reactie['Reactie']);
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