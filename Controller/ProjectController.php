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

    public function getProjecten(){
        $ProjectArray = [];
        foreach ($this->projectmodel->getProjecten() as $project){
            $projectObject   =
                new Project($project['ProjectID'], $project['GebruikerID'], $project['Type'], $project['Titel'],
                    $project['Beschrijving'], $project['CategorieID'], $project['Datumaangemaakt'],
                    $project['Deadline'], $project['Status'], $project['Locatie'], $project['Verwijderd']);
            $ProjectArray [] = $projectObject;
        }
        return $ProjectArray;
    }

    function add(int $ProjectID,
        int $GebruikerID,
        string $Type,
        string $Titel,
        string $Beschrijving,
        int $CategorieID,
        int $Datumaangemaakt,
        int $Deadline,
        int $Status,
        string $Locatie,
        int $Verwijderd){
        return $this->projectmodel->Add($ProjectID,
            $GebruikerID,
            $Type,
            $Titel,
            $Beschrijving,
            $CategorieID,
            $Datumaangemaakt,
            $Deadline,
            $Status,
            $Locatie,
            $Verwijderd);
    }

    function delete(int $Id){
        return $this->projectmodel->Delete($Id);
    }

    function update(Project $Project){
        return $this->projectmodel->Update($Project);
    }

    function getById(int $ProjectID): project{
        $Project = $this->projectmodel->getById($ProjectID);
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


}