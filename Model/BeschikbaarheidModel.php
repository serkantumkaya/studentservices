<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Beschikbaarheid.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class BeschikbaarheidModel
{
    // PDO is denk ik niet nodig.... staat al in ConnectDB
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Beschikbaarheid $beschikbaarheid;

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function GetBeschikbaarheden(){
        //Do not use * or face the errors and solve then yourself
        $sql = "SELECT projectID,dagBeschikbaar,startTijd,eindTijd FROM Beschikbaarheid";
        return $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetBeschikbaarheidByProject(int $ProjectID){
        $sql = "SELECT * FROM Beschikbaarheid where ProjectID=:" + $ProjectID;
        return $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function add(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        $statement = $this->conn->prepare("INSERT INTO Beschikbaarheid (projectID,dagBeschikbaar,startTijd,eindTijd) 
            VALUES (:projectID,:dagBeschikbaar,:startTijd,:eindTijd)");

        $parameters = [
            'projectID' => $projectID,
            'dagBeschikbaar' => $dagBeschikbaar,
            'startTijd' => $startTijd,
            'eindTijd' => $eindTijd
        ];

        return true;
    }

    function delete(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        //delete beschikbaarheid
        $sql = "Delete from Beschikbaarheid 
                    WHERE projectID=:projectID,dagBeschikbaar:=dagBeschikbaar,
                    startTijd:=startTijd,eindTijd:=eindTijd";

        $parameters = [
            'projectID' => $projectID,
            'dagBeschikbaar' => $dagBeschikbaar,
            'startTijd' => $startTijd,
            'eindTijd' => $eindTijd
        ];

        return $sql->execute($parameters);

    }

    function update(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        $sql        =
            $this->conn->prepare("UPDATE SCHOOL SET projectID=:projectID,dagBeschikbaar:=dagBeschikbaar,
                    startTijd:=startTijd,eindTijd:=eindTijd");

        $parameters = [
            'projectID' => $projectID,
            'dagBeschikbaar' => $dagBeschikbaar,
            'startTijd' => $startTijd,
            'eindTijd' => $eindTijd
        ];

        return $sql->execute($parameters);
    }

    function get(int $projectID,DateTime $dagBeschikbaar,DateTime $startTijd,DateTime $eindTijd){
        $sql = "Select BeschikbaarheidID,Beschikbaarheidnaam from SCHOOL Beschikbaarheid 
                    WHERE projectID=:projectID,dagBeschikbaar:=dagBeschikbaar,
                    startTijd:=startTijd,eindTijd:=eindTijd";

        $parameters = [
            'projectID' => $projectID,
            'dagBeschikbaar' => $dagBeschikbaar,
            'startTijd' => $startTijd,
            'eindTijd' => $eindTijd
        ];

        return $sql->execute($parameters);
    }
}

