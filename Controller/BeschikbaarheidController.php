<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Beschikbaarheid.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/BeschikbaarheidModel.php");

class BeschikbaarheidController
{
    private BeschikbaarheidModel $beschikbaarheidmodel;

    public function __construct(){

    }

    //public function GetOpleidingen()
    //{
    //    $OpleidigArray = [];
    //    foreach ($this->Opleidingmodel->GetOpleidingen()->fetchAll(PDO::FETCH_ASSOC) as $sg)
    //    {
    //        $opleiding = new Opleiding($sg['OpleidingID'],$sg['Naamopleiding'],$sg['Voltijd_deeltijd']);
    //        $OpleidigArray [] = $opleiding;
    //    }
    //    return $OpleidigArray ;
    //}


    //public function GetBeschikbaarheden(){
    //    $beschikbaarheidmodel = new BeschikbaarheidModel();
    //    $BeschikbaarheidArray = [];
    //    foreach ($beschikbaarheidmodel->GetBeschikbaarheden()->fetchAll(PDO::FETCH_ASSOC) as $beschikbaarheid)
    //    {
    //        $ST     = new DateTime($beschikbaarheid['Starttijd']);
    //        $ET     = new DateTime($beschikbaarheid['Eindtijd']);
    //
    //        $beschikbaarheid = new Beschikbaarheid(
    //            $beschikbaarheid['BeschikbaarheidID'],
    //            $beschikbaarheid['ProjectID'],
    //            $ST,
    //            $ET,
    //        );
    //        $BeschikbaarheidArray [] = $beschikbaarheid;
    //    }
    //    return $BeschikbaarheidArray;
    //}

    public function GetBeschikbaarheidByProject(int $ProjectID){
        $BeschikbaarheidArray = [];
        $this->beschikbaarheidmodel = new BeschikbaarheidModel();
        foreach ($this->beschikbaarheidmodel->GetBeschikbaarheidByProject($ProjectID) as $beschikbaarheid){

            $ST     = new DateTime($beschikbaarheid['Starttijd']);
            $ET     = new DateTime($beschikbaarheid['Eindtijd']);

            $beschikbaarheid = new Beschikbaarheid(
                $beschikbaarheid['BeschikbaarheidID'],
                $beschikbaarheid['ProjectID'],
                $ST,
                $ET,
            );
            $BeschikbaarheidArray [] = $beschikbaarheid;
        }
        return $BeschikbaarheidArray;
    }

    function add(int $projectID,DateTime $startTijd,DateTime $eindTijd){
        $beschikbaarheidmodel = new BeschikbaarheidModel();
        return $beschikbaarheidmodel->Add($projectID,$startTijd,$eindTijd);
    }

    function delete(int $beschikbaarheidID){
        $this->beschikbaarheidmodel = new BeschikbaarheidModel();
        return $this->beschikbaarheidmodel->Delete($beschikbaarheidID);
    }

    function update(int $beschikbaarheidID,int $projectID,DateTime $startTijd,DateTime $eindTijd)
    {
        $this->beschikbaarheidmodel = new BeschikbaarheidModel();
        return $this->beschikbaarheidmodel->Update($beschikbaarheidID,$projectID,$startTijd,$eindTijd);
    }


    function getByID(int $beschikbaarheidID)
    {
        $this->beschikbaarheidmodel = new BeschikbaarheidModel();

        $Beschikbaarheid = $this->beschikbaarheidmodel->getByID($beschikbaarheidID);

        $ST     = new DateTime($Beschikbaarheid['Starttijd']);
        $ET     = new DateTime($Beschikbaarheid['Eindtijd']);

        $beschikbaarheid = new Beschikbaarheid(
            $Beschikbaarheid['BeschikbaarheidID'],
            $Beschikbaarheid['ProjectID'],
            $ST,
            $ET,
        );

        return $beschikbaarheid;
    }

}
