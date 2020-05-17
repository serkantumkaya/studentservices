<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/FeedbackModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Feedback.php");

class FeedbackController
{

    private FeedbackModel $Feedbackmodel;

    public function __construct(){
        $this->Feedbackmodel = new FeedbackModel();
    }

    public function getFeedback(){
        $feedbacklijst = array();
        foreach ($this->Feedbackmodel->getFeedback() as $feedback){
            $feedbackObj     = new Feedback($feedback['FeedbackID'], $feedback['GebruikerID'], $feedback['ProjectID'],
                $feedback['Cijfer'], $feedback['Review']);
            $feedbacklijst[] = $feedbackObj;
        }
        return $feedbacklijst;
    }

    public function add(int $projectID, int $gebruikerID, int $cijfer, string $review): bool{
        return $this->Feedbackmodel->add($projectID, $gebruikerID, $cijfer, $review);
    }

    public function delete(int $Id){
        return $this->Feedbackmodel->delete($Id);
    }

    public function update(Feedback $feedback){
        return $this->Feedbackmodel->update($feedback);
    }

    public function getById(int $ID): Feedback{
        $feedback = $this->Feedbackmodel->get($ID);
        return new Feedback($feedback['FeedbackID'], $feedback['GebruikerID'], $feedback['ProjectID'],
            $feedback['Cijfer'], $feedback['Review']);
    }

}