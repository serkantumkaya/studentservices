<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Reactie.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class ReactieModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function getReacties(): array{
        $sql = "SELECT ReactieID,
            GebruikerID,
            Timestamp, 
            ProjectID,
            Reactie FROM Reactie";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);;
    }

    function add(
        int $GebruikersID,string $Timestamp,int $ProfielID,int $ProjectID,string $Reactie){

        $statement =
            $this->conn->prepare("INSERT INTO Reactie (GebruikerID, Timestamp, ProjectID, Reactie) VALUES (:GebruikerID, :Timestamp, :ProjectID, :Reactie)");
        return $statement->execute([
            'GebruikersID' => $GebruikersID,
            'Timestamp' => $Timestamp,
            'PojecctID' => $ProjectID,
            'Reatie' => $Reactie]);
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM Reactie WHERE ReactieID=:RID");

        $parameters = [
            'RID' => $ID
        ];
        if ($sql->execute($parameters) == true){
            return "Record verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function update(Reactie $Reactie):void {

        $sql =
            $this->conn->prepare("UPDATE Reactie SET GebruikerID=:GebruikerID,TIMESTAMP=:Timestamp, Reactie=:SReactie, ProjectID=:ProjectID)
            WHERE ReactieID= ".$Reactie->getReactieID()." ");

        $parameters = [
            'GebruikerID'=>$Reactie->getGebruikerID(),
            'Timestamp' => $Reactie->getTimestamp(),
            'Reactie' => $Reactie->getReactie(),
            'ProjectID' => $Reactie->getProjectID(),
        ];
        $sql->execute($parameters);
    }

    function getById(int $ID){
        $sql = "SELECT *  FROM Reactie WHERE ReactieID =$ID";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function getByProjectID(int $ID): array{
        $sql = "SELECT * FROM Reactie WHERE ProjectID = $ID";
        return $this->conn->query($sql)->fetchALL(PDO::FETCH_ASSOC);
    }

}
