<?php
// TODO:
//welke functies minimaal:
//construct
//getProjecten() -> dit is voor meervoud, dus alle projecten
//add()
//delete()
//update()
//get() -> dit is voor één project

error_reporting(E_ALL);
ini_set('display_errors',1);
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/BaseClass/Project.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/includes/DB.php");

class ProjectModel{

    private $conn;

    public function __construct()
    {
        $this->ConnectDb = new ConnectDb();
        $this->conn = $this->ConnectDb->GetConnection();
    }

    public function getProjecten(){
        $sql = "SELECT ProjectID,
            GebruikerID,
            Type,
            Titel,
            Beschrijving,
            CategorieID,
            Datumaangemaakt,
            Deadline,
            Status,
            Locatie,
            Verwijderd FROM Project";
        return $this->conn->query($sql);
    }
}