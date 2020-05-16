<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/ReactieModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Reactie.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class ReactieController
{
    private ReactieModel $reactiemodel;

    public function __construct() {
        $this->reactiemodel = new ReactieModel();
    }

    public function getReacties()
    {
        $ReactieArray = [];
        foreach ($this->reactiemodel->getReacties() as $reactieObject)
        {
            $reactieObject = new Reactie($reactie['ReactieID'],$reactie['Reactienaam']);
            $ReactieArray [] = $reactieObject;
        }
        return $ReactieArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Reactienaam) {
        return $this->reactiemodel->Add($Reactienaam);
    }

    function delete(int $Id)
    {
        return $this->reactiemodel->Delete($Id);
    }

    function update(Reactie $Reactie)
    {
        return $this->reactiemodel->Update($Reactie);
    }

    function getById(int $id) : reactie
    {
        $Reactie = $this->reactiemodel->Get($id);
        return new Reactie($Reactie['ReactieID'],$Reactie['Reactienaam']);

    }
}