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

    public function getFeedback() : array{
        $sql = "SELECT * FROM FEEDBACK";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(int $projectID, int $gebruikerID, int $cijfer, string $feedback): bool{
        $statement =
            $this->conn->prepare("INSERT INTO Feedback (ProjectID, GebruikerID, Cijfer, Feedback) VALUES (:ProjectID, :GebruikerID, :Cijfer, :Feedback)");
        return $statement->execute([
            'ProjectID' => $projectID,
            'GebruikerID' => $gebruikerID,
            'Cijfer' => $cijfer,
            'Feedback' => $feedback
        ]);


    }
}