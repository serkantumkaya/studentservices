<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Project.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class ProjectModel
{

    private $conn;

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    //HIER VANAF BLIJVEN HEEEEEL BELANGRIJK
    public function getProjecten($sql){
        if ($sql == null){
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
        }

        return $this->conn->query($sql);
    }

    public function add(int $gebruikerID, string $titel, string $type, string $beschrijving, int $categorieID,
        ?string $deadline, string $status, $locatie){
        $sql = "INSERT INTO Project (GebruikerID, Titel,Type, Beschrijving, CategorieID,Deadline, Status, Locatie)
           VALUES(:GebruikerID, :Titel, :Type, :Beschrijving, :CategorieID,:Deadline, :Status, :Locatie)";

        $statement = $this->conn->prepare($sql);

        $parameters = [
            'GebruikerID' => $gebruikerID,
            'Titel' => $titel,
            'Type' => $type,
            'Beschrijving' => $beschrijving,
            'CategorieID' => $categorieID,
            'Deadline' => $deadline,
            'Status' => $status,
            'Locatie' => $locatie
        ];
        return $statement->execute($parameters);
    }

    public function delete(int $ID){
        $sql        = $this->conn->prepare("DELETE FROM Project WHERE ProjectID  =:ProjectID");
        $parameters = [
            'ProjectID' => $ID
        ];
        if ($sql->execute($parameters) == true){
            return "Record verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function update(Project $project): bool{
        $sql        =
            $this->conn->prepare("UPDATE Project SET GebruikerID=:GebruikerID, Titel=:Titel, Type=:Type, Beschrijving=:Beschrijving, CategorieID=:CategorieID, Deadline=:Deadline, Status=:Status, Locatie=:Locatie, Verwijderd=:Verwijderd WHERE ProjectID = " .
                $project->getProjectID() . " ");
        $parameters = [
            'GebruikerID' => $project->getGebruikerID(),
            'Titel' => $project->getTitel(),
            'Type' => $project->getType(),
            'Beschrijving' => $project->getBeschrijving(),
            'CategorieID' => $project->getCategorieID(),
            'Deadline' => $project->getDeadline(),
            'Status' => $project->getStatus(),
            'Locatie' => $project->getLocatie(),
            'Verwijderd' => $project->isVerwijderd()
        ];
        return $sql->execute($parameters);
    }

    /**
     * @param int $ID
     * @return array
     */

    public function getById(int $ID): array{
        $sql = "Select * FROM Project WHERE ProjectID = '$ID'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $ID
     * @return array
     */

    public function getByGebruikerID(int $ID): array{
        $sql = "Select * FROM Project WHERE GebruikerID = '$ID'";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Verwijderde projecten niet meenemen
     * @param int $begin
     * @param int $limit
     * @return array
     */

    public function getPerPagina(string $sql, int $begin, int $limit): array{
        $sql .= "AND Verwijderd = 0 LIMIT $begin, $limit";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}