<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ProjectModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Project.php");

class ProjectController
{

    private ProjectModel $projectmodel;

    public function __construct(){
        $this->projectmodel = new ProjectModel();
    }

    public function getProjecten($sql = null){
        $ProjectArray = [];
        foreach ($this->projectmodel->getProjecten($sql) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Type'], $project['Titel'],
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
            $Project['Type'],
            $Project['Titel'],
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
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Type'], $project['Titel'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

<<<<<<< HEAD
    function getByProjectID(int $ProjectID){
        $ProjectArray = [];
        foreach ($this->projectmodel->getByID($ProjectID) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Type'], $project['Titel'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function getPerPagina(int $page):array {
=======
    function getPerPagina(string $sql,int $page):array {
>>>>>>> 161df6cde79144b048b2db3ba9134e2e5727440b
        $begin = ($page*6)-6;
        $limit = 6;
        $ProjectArray = [];
        foreach ($this->projectmodel->getPerPagina($sql, $begin, $limit) as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Type'], $project['Titel'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }


    function createFilter($filters = null):string {
        $SQL = "SELECT * FROM `project` WHERE ProjectID >= 1 ";
        if (isset($filters['status'])){
            $SQL .= $this->getFilter($filters['status'], "STATUS");
        }
        if (isset($filters['categorie'])){
            $SQL .= $this->getFilterCategorie($filters['categorie']);
        }
        if (isset($filters['type'])){
            $SQL .= $this->getFilter($filters['type'],"TYPE");
        }
        return $SQL;
    }

    function getFilter(array $zoekwoorden,string $filter):string {
        $i   = 0;
        $SQL = "";
        foreach ($zoekwoorden as $key => $value){
            $i++;
            if ($i == 1){
                $SQL .= "AND $filter LIKE '%$value%' ";
            }else{
                $SQL .= "OR $filter LIKE '%$value%' ";
            }
        }
        return $SQL;
    }
//SELECT * from project where ProjectID > 1 and CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = 'Kleien') or CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = 'fotograferen')
    function getFilterCategorie(array $zoekwoorden):string {
        $i   = 0;
        $SQL = "";
        foreach ($zoekwoorden as $key => $value){
            $i++;
            if ($i == 1){
                $SQL .= "AND CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = '$value') ";
            }else{
                $SQL .= "OR CategorieID = (SELECT CategorieID from selectiecategorie where CategorieNaam = '$value') ";
            }
        }
        return $SQL;
    }
}