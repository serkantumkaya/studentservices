<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/OpleidingModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/Opleiding.php");

//controller for crud operations for Opleiding
class OpleidingController
{

    private OpleidingModel $Opleidingmodel;

    public function __construct() {
        $this->Opleidingmodel = new OpleidingModel();
    }

    public function GetOpleidingen()
    {
        return $this->Opleidingmodel->GetOpleidingen()->fetchAll(PDO::FETCH_ASSOC);
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Opleidingnaam) {
        return $this->Opleidingmodel->Add($Opleidingnaam);
    }

    function delete(int $Id)
    {
        return $this->Opleidingmodel->Delete($Id);
    }

    function update(Opleiding $Opleiding)
    {
        return $this->Opleidingmodel->Update($Opleiding);
    }

    function getById(int $id)
    {
        $Opleiding = $this->Opleidingmodel->Get($id)->fetchAll(PDO::FETCH_ASSOC);

        return $Opleiding[0];

    }
}