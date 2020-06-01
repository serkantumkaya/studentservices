<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ("C:xampp/htdocs/StudentServices/Model/ProjectModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Project.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/ZoekController.php");

class ProjectController
{

    private ProjectModel $projectmodel;
    private ZoekController $zoekcontroller;

    public function __construct(){
        $this->projectmodel   = new ProjectModel();
        $this->zoekcontroller = new ZoekController();
    }

    public function getProjecten($sql = null){
        $ProjectArray = [];
        foreach ($this->projectmodel->getProjecten($sql) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Titel'], $project['Type'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function add(int $GebruikerID,
        string $Titel,
        string $Type,
        string $Beschrijving,
        int $CategorieID,
        string $Deadline,
        string $Status,
        string $Locatie
    ){
        return $this->projectmodel->Add(
            $GebruikerID,
            $Titel,
            $Type,
            $Beschrijving,
            $CategorieID,
            $Deadline,
            $Status,
            $Locatie
        );
    }

    function delete(int $ProjectID){
        return $this->projectmodel->Delete($ProjectID);
    }

    function update(Project $Project){
        return $this->projectmodel->Update($Project);
    }

    function getById(int $ProjectID): project{//geeft losse objecten terug heb ik een andere functie voor gemaakt die een array van objecten terug geeft
        $Project = $this->projectmodel->getById($ProjectID);
        //var_dump($Project);

        return new Project(
            $Project['ProjectID'],
            $Project['GebruikerID'],
            $Project['Titel'],
            $Project['Type'],
            $Project['Beschrijving'],
            $Project['CategorieID'],
            $Project['Datumaangemaakt'],
            $Project['Deadline'],
            $Project['Status'],
            $Project['Locatie'],
            $Project['Verwijderd']);
    }

    function getByGebruikerID(int $gebruikerID){
        $ProjectArray = [];
        foreach ($this->projectmodel->getByGebruikerID($gebruikerID) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Titel'], $project['Type'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function getDeadlineFormat($deadline){
        $time     = new DateTime($deadline);
        $deadline = $time->format("Y-m-d H:i");
        $deadline = explode(" ", $deadline);
        return $deadline[0] . "T" . $deadline[1];
    }

    function undoDeadlineFormat($deadline){
        $datum = explode("T", $deadline);
        return $datum[0] . " " . $datum[1];
    }

    function getByProjectID(int $ProjectID){
        $ProjectArray = [];
        foreach ($this->projectmodel->getByID($ProjectID) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Titel'], $project['Type'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function getPerPagina(string $sql, int $page): array{
        $begin        = ($page * 6)-6;
        $limit        = 6;
        $ProjectArray = [];
        foreach ($this->projectmodel->getPerPagina($sql, $begin, $limit) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Titel'], $project['Type'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function createFilter($gebruikerID, $filters = null): string{
        $SQL = "SELECT * FROM `project` WHERE Verwijderd = 0 ";
        if (isset($filters['search']) && ($filters['search'] != '' || $filters['search'] != " ")){
            $SQL .= $this->getZoekFilter($filters['search']);
            if (empty($this->projectmodel->getProjecten($SQL))){
                $this->zoekcontroller->add($filters['search'], "Fail");
            } elseif (!empty($this->projectmodel->getProjecten($SQL))){
                $this->zoekcontroller->add($filters['search'], "Succes");
            }
        } else{
            if (isset($filters['status'])){
                $SQL .= $this->getFilter($filters['status'], "STATUS");
            }
            if (isset($filters['categorie'])){
                $SQL .= $this->getFilterCategorie($filters['categorie']);
            }
            if (isset($filters['type'])){
                $SQL .= $this->getFilter($filters['type'], "TYPE");
            }
            if (isset($filters['persoon'])){
                $SQL .= $this->getFilterGebruiker($filters['persoon'], $gebruikerID);
            }
        }
        return $SQL;
    }

    private function getZoekFilter($zoekwoordzin){
        $i           = 0;
        $SQL         = "";
        $zoekwoorden = explode(" ", $zoekwoordzin);
        foreach ($zoekwoorden as $zoek){
            $i++;
            if ($i == 1){
                $SQL .= "AND (Beschrijving LIKE '%$zoek%' OR Titel LIKE '%$zoek%')";
            } else{
                $SQL .= "OR (Beschrijving LIKE '%$zoek%' OR Titel LIKE '%$zoek%')";
            }
        }
        return $SQL;
    }

    function getFilter(array $zoekwoorden, string $filter): string{
        $i   = 0;
        $SQL = "";
        foreach ($zoekwoorden as $key => $value){
            $i++;
            if ($i == 1){
                $SQL .= "AND $filter LIKE '%$value%' ";
            } else{
                $SQL .= "OR $filter LIKE '%$value%' ";
            }
        }
        return $SQL;
    }

    //SELECT * from project where ProjectID > 1 and CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = 'Kleien') or CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = 'fotograferen')
    function getFilterCategorie(array $zoekwoorden): string{
        $i   = 0;
        $SQL = "";
        foreach ($zoekwoorden as $key => $value){
            $i++;
            if ($i == 1){
                $SQL .= "AND CategorieID = (SELECT CategorieID from categorie where categorienaam = '$value') ";
            } else{
                $SQL .= "OR CategorieID = (SELECT CategorieID from categorie where categorienaam = '$value') ";
            }
        }
        return $SQL;
    }

    function getFilterGebruiker(array $filter, $gebruikerID){
        $SQL = "";
        if (isset($filter['zelf']) && !isset($filter['ander'])){
            $SQL .= "AND GebruikerID = $gebruikerID ";
        } elseif (!isset($filter['zelf']) && isset($filter['ander'])){
            $SQL .= "AND GebruikerID != $gebruikerID ";
        }
        return $SQL;

    }
}
