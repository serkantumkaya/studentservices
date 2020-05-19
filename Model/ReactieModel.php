<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Reactie.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class ReactieModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private Reactie $reactie;

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function getReacties(){
        $sql = "SELECT ReactieID ,
            GebruikerID,
            ProfielID,
            ProjectID,
            Reactie FROM Reactie";
        return $this->conn->query($sql);
    }

    function add(
        int $GebruikersID, int $ProfielID, int $ProjectID, string $Reactie){

        $statement =
            $this->conn->prepare("INSERT INTO Reactie (GebruikerID, ProfielID, ProjectID, Reactie) VALUES (:GebruikerID, :ProfielID, :ProjectID, :Reactie)");
        $statement->execute(['GebruikersID' => $GebruikersID, 'ProfielID' => $ProfielID->getProfielID(),
            'PojecctID' => $ProjectID->getProjectID(),
            'Reatie' => $Reactie]);
        return true;
    }

    function delete(int $ID){

        $sql = $this->conn->prepare("DELETE FROM Reactie WHERE ReactieID=:RID");

        $parameters = [
            'RID' => $ID
        ];

        return $sql->execute($parameters);
    }

    function update(int $ProfielID, int $ProjectID, string $Reactie){

        $sql =

            $this->conn->prepare("UPDATE Reactie SET 
            Reactie=:SReactie)
            VALUES (:GebruikersID ,:ProfielID ,:ProjectID ,:Reactie Where ReactieID=:ReactieID");//let op id geen quotes

        $parameters = [
            'Reactie' => $Reactie];

        return $sql->execute($parameters);
    }

    function getById(int $ID){
        $sql = "SELECT *  FROM Reactie WHERE ReactieID =$ID";
        return $this->conn->query($sql);
    }
}