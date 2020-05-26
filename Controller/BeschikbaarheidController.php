<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Beschikbaarheid.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/BeschikbaarheidModel.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class BeschikbaarheidController
{
    private BeschikbaarheidModel $beschikbaarheidmodel;

    public function __construct(){

    }

    public function GetBeschikbaarheden(){
        $beschikbaarheidmodel = new BeschikbaarheidModel();
        $BeschikbaarheidArray = [];
        foreach ($beschikbaarheidmodel->GetBeschikbaarheden() as $beschikbaarheid)
        {
            $beschikbaarheid = new Beschikbaarheid(
                $beschikbaarheid['projectID'],
                new DateTime($beschikbaarheid['dagBeschikbaar']),
                new DateTime($beschikbaarheid['startTijd']),
                new DateTime($beschikbaarheid['eindTijd']),
            );
            $BeschikbaarheidArray [] = $beschikbaarheid;
        }
        return $BeschikbaarheidArray;
    }

    public function GetBeschikbaarheidByProject(int $ProjectID){
        $BeschikbaarheidArray = [];
        foreach ($this->beschikbaarheidmodel->GetBeschikbaarheden() as $beschikbaarheid){
            $beschikbaarheid         = new Beschikbaarheid(
                $beschikbaarheid['projectID'],
                $beschikbaarheid['dagBeschikbaar'],
                $beschikbaarheid['startTijd'],
                $beschikbaarheid['eindTijd'],
            );
            $BeschikbaarheidArray [] = $beschikbaarheid;
        }
        return $BeschikbaarheidArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        return $this->beschikbaarheidmodel->Add($projectID,$dagBeschikbaar,$startTijd,$eindTijd);
    }

    function delete(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        return $this->beschikbaarheidmodel->Delete($projectID,$dagBeschikbaar,$startTijd,$eindTijd);
    }

    function update(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd)
    {
        return $this->beschikbaarheidmodel->Update($projectID,$dagBeschikbaar,$startTijd,$eindTijd);
    }

    function getBeschikbaarheid(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd)
    {
        return $this->beschikbaarheidmodel->Update($projectID,$dagBeschikbaar,$startTijd,$eindTijd);
    }

}
