<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/ProjectModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Project.php");

class ProjectController{

    private ProfielModel $projectmodel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }

   public function GetProjecten()
    {
        $ProjectArray = [];
        foreach ($this->projectModel->GetProjecten() as $project)
        {
            $projectObject = new Project($project['ProjectID'],$project['GebruikerID'],$project['Type'],$project['Titel'],$project['Beschrijving'],$project['CategorieID'],$project['Datumaangemaakt'],$project['Deadline'],$project['Status'],$project['Locatie'],$project['Verwijderd']);
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
                 int $Verwijderd) {
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

    function delete(int $Id)
    {
        return $this->projectmodel->Delete($Id);
    }

    function update(Project $Project)
    {
        return $this->projectmodel->Update($Project);
    }

    function getById(int $id): project{
        $Project = $this->projectModel->GetById($id)->fetchAll(PDO::FETCH_ASSOC);
        return new Project(
            $Project[0]['ProjectID'],
            $Project[0]['GebruikerID'],
            $Project[0]['Type'],
            $Project[0]['Titel'],
            $Project[0]['Beschrijving'],
            $Project[0]['CategorieID'],
            $Project[0]['Datumaangemaakt'],
            $Project[0]['Deadline'],
            $Project[0]['Status'],
            $Project[0]['Locatie'],
            $Project[0]['Verwijderd'];

    }
}