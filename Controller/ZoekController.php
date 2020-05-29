<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ZoekModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/ZoekOpdracht.php");


class ZoekController
{

    public function __construct(){
        $this->zoekmodel = new ZoekModel();
    }

    public function getZoekOpdrachten():array{
        $zoeklijst = [];
        foreach ($this->zoekmodel->getZoekOpdrachten() as $opdracht){
            $opdrachtOBJ = new zoekOpdracht($opdracht['ZoekID'], $opdracht['Zoekwoorden'], $opdracht['Resultaat'],
                $opdracht['Tijd']);
            $zoeklijst[] = $opdrachtOBJ;
        }
        return $zoeklijst;
    }

    public function delete(int $ID):bool {
        return $this->zoekmodel->delete($ID);
    }

    public function add($woorden,$status):bool {
        return $this->zoekmodel->add($woorden,$status);
    }

    public function update(){
        //niet nodig
    }


}