<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/OpleidingModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Opleiding.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Includes/Enum/EnumVoltijdDeeltijd.php");

//controller for crud operations for Opleiding
class OpleidingController
{

    private OpleidingModel $Opleidingmodel;

    public function __construct() {
        $this->Opleidingmodel = new OpleidingModel();
    }

    public function GetOpleidingen()
    {
        $OpleidigArray = [];
        foreach ($this->Opleidingmodel->GetOpleidingen()->fetchAll(PDO::FETCH_ASSOC) as $sg)
        {
            $opleiding = new Opleiding($sg['OpleidingID'],$sg['Naamopleiding'],$sg['Voltijd_deeltijd']);
            $OpleidigArray [] = $opleiding;
        }
        return $OpleidigArray ;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Opleidingnaam, string $VoltijdDeeltijd) {
        echo("Komt bij stap 3");
        return $this->Opleidingmodel->Add($Opleidingnaam,$VoltijdDeeltijd);
    }

    function delete(int $Id)
    {
        return $this->Opleidingmodel->Delete($Id);
    }

    function update(Opleiding $Opleiding)
    {
        $naamopleiding = $Opleiding->getNaamopleiding();
        $id = $Opleiding->getOpleidingID();
        $voltijddeeltijd=$Opleiding->getVoltijdDeeltijd();
        return $this->Opleidingmodel->Update($id,$naamopleiding,$voltijddeeltijd);
    }

    function getById(int $id)
    {
        $Opleiding = $this->Opleidingmodel->Get($id)->fetchAll(PDO::FETCH_ASSOC);

        return new Opleiding($Opleiding[0]['OpleidingID'],$Opleiding[0]['Naamopleiding'], $Opleiding[0]['Voltijd_deeltijd']);//kijk dit bedoel ik dit is OO bitches!
    }
}
