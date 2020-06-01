<?php

require_once ("C:xampp/htdocs/StudentServices/BaseClass/Beschikbaarheid.php");
require_once ("C:xampp/htdocs/StudentServices/includes/DB.php");

class BeschikbaarheidModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Beschikbaarheid $beschikbaarheid;

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function GetBeschikbaarheden(){
        $sql = "SELECT * FROM Beschikbaarheid";
        return $this->conn->query($sql);
    }


    public function GetScholen(){
        $sql = "SELECT SchoolID,Schoolnaam FROM School";
        return $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function GetBeschikbaarheidByProject(int $ProjectID){

        $sql = "SELECT * FROM Beschikbaarheid where ProjectID=".$ProjectID;
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function add(int $projectID,DateTime $startTijd,DateTime $eindTijd){
        $sql = $this->conn->prepare("INSERT INTO Beschikbaarheid (projectID,startTijd,eindTijd) 
            VALUES (:projectID,:startTijd,:eindTijd)");

        $sql ->execute([
            'projectID' => $projectID,
            'startTijd' => $startTijd->format('Y-m-d H:i:s'),
            'eindTijd' => $eindTijd->format('Y-m-d H:i:s')
        ]);
        return true;
    }

    function delete(int $beschikbaarheidID){
        $sql = $this->conn->prepare("DELETE FROM Beschikbaarheid WHERE BeschikbaarheidID  =:BID");

        $parameters = [
            'BID' => $beschikbaarheidID
        ];

        if ($sql->execute($parameters) == true){
            return "Record verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function update(int $beschikbaarheidID, int $projectID,DateTime $startTijd,DateTime $eindTijd){
        $sql = $this->conn->prepare("UPDATE Beschikbaarheid SET projectID=:projectID,
                    startTijd=:startTijd,eindTijd=:eindTijd WHERE BeschikbaarheidID=:BeschikbaarheidID");
        var_dump($sql);
        var_dump($projectID);
        var_dump($startTijd->format('Y-m-d H:i:s'));
        var_dump($eindTijd->format('Y-m-d H:i:s'));
        var_dump($beschikbaarheidID);
        $parameters = ['projectID' => $projectID,
            'startTijd' => $startTijd->format('Y-m-d H:i:s'),
            'eindTijd' => $eindTijd->format('Y-m-d H:i:s'),
            'BeschikbaarheidID' => $beschikbaarheidID
        ];
        return $sql->execute($parameters);

    }

    function getByID(int $ID){
        $sql = "Select * FROM Beschikbaarheid WHERE BeschikbaarheidID = '$ID'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}

