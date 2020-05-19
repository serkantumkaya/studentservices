<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Feedback.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");

class FeedbackModel
{

    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function getFeedback(): array{
        $sql = "SELECT * FROM FEEDBACK";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(int $projectID, int $gebruikerID, int $cijfer, string $review): bool{
        $statement =
            $this->conn->prepare("INSERT INTO Feedback (ProjectID, GebruikerID, Cijfer, Review) VALUES (:ProjectID, :GebruikerID, :Cijfer, :Review)");
        return $statement->execute([
            'ProjectID' => $projectID,
            'GebruikerID' => $gebruikerID,
            'Cijfer' => $cijfer,
            'Review' => $review
        ]);
    }

    public function delete(int $ID){
        //delete feedback
        $sql = $this->conn->prepare("DELETE FROM Feedback WHERE FeedbackID  =:SID");
        $parameters = [
            'SID' => $ID
        ];
        if ($sql->execute($parameters) == true){
            return "Record verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function update(Feedback $feedback){
        //    UPDATE `feedback` SET `ProjectID` = '4', `Cijfer` = '6', `Review` = 'HEEL GAAF' WHERE `feedback`.`FeedbackID` = 3;
        $sql =
            $this->conn->prepare("UPDATE Feedback SET ProjectID=:ProjectID, GebruikerID=:GebruikerID, Cijfer=:Cijfer, Review=:Review WHERE FeedbackID = ".$feedback->getFeedbackID()." ");

        $parameters = [
            'ProjectID' => $feedback->getProjectID(),
            'GebruikerID'=>$feedback->getGebruikerID(),
            'Cijfer' => $feedback->getCijfer(),
            'Review' => $feedback->getReview()
        ];
        $sql->execute($parameters);
    }


    public function get(int $ID): array{
        $sql = "SELECT * FROM FEEDBACK WHERE FeedbackID = $ID";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

}