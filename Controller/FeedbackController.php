<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/FeedbackModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Feedback.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");


class FeedbackController
{

    private FeedbackModel $Feedbackmodel;
    private ProjectController $projectcontroller;

    public function __construct(){
        $this->Feedbackmodel = new FeedbackModel();
        $this->ProjectController = new ProjectController();
    }

    public function getFeedback(){
        $feedbacklijst = array();
        foreach ($this->Feedbackmodel->getFeedback() as $feedback){
            $feedbackObj     = new Feedback(
                $feedback['FeedbackID'],
                $feedback['GebruikerID'],
                $feedback['ProjectID'],
                $feedback['Cijfer'],
                $feedback['Review']);
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

    /**
     * Eén feedback aan de hand van het ID ophalen.
     * @param int $ID
     * @return Feedback
     */

    public function getById(int $FeedbackID): Feedback{
        $feedback = $this->Feedbackmodel->getById($FeedbackID);
        return new Feedback(
            $feedback['FeedbackID'],
            $feedback['GebruikerID'],
            $feedback['ProjectID'],
            $feedback['Cijfer'],
            $feedback['Review']);
    }

    public function getByProjectID(int $projectID) :array{
        $feedbacklijst = array();
        foreach ($this->Feedbackmodel->getByProjectID($projectID) as $feedback){
            $feedbackObj     = new Feedback(
                $feedback['FeedbackID'],
                $feedback['GebruikerID'],
                $feedback['ProjectID'],
                $feedback['Cijfer'],
                $feedback['Review']);
            $feedbacklijst[] = $feedbackObj;
        }
        return $feedbacklijst;
    }

    /**
     * verkorte versie van de Review teruggeven. past beter op het scherm
     * @return string
     */

    public function getReviewKort($review): string{
        if (strlen($review)>40){
            return substr($review, 0, 40) . "...";
        } else{
            return $review;
        }
    }

    /**
     * Door het GebruikerID , worden ALLE feedback van die gebruiker teruggegeven.
     * dit zijn dus feedback op verschillende projecten.
     * kan handig zijn voor het overzicht van een gebruiker. gemiddelde score die die heeft gegeven enzo.
     * @param int $ID
     * @return array
     */

    public function getGegevenFeedback(int $GebruikerID): array{
        $feedbacklijst = [];
        foreach ($this->Feedbackmodel->getGegevenFeedbak($GebruikerID) as $feedback){
            $feedbackObj     = new Feedback($feedback['FeedbackID'], $feedback['GebruikerID'], $feedback['ProjectID'],
                $feedback['Cijfer'], $feedback['Review']);
            $feedbacklijst[] = $feedbackObj;
        }
        return $feedbacklijst;
    }

    /**
     * gemiddelde score ophalen van Fedback wat je hebt weggegeven.
     * dit moet als float want kommagetallen.
     * @return float
     */

    function getGemiddeldeGegevenScore(int $gebruikerID): float{
        $i = 0;
        $aantal = count($this->getGegevenFeedback($gebruikerID));
        $feedbacklijst = $this->getGegevenFeedback($gebruikerID);
        foreach ($feedbacklijst as $feedback){
            $i += $feedback->getCijfer();
        }
        return round($i/$aantal,1);
    }

    /**
     * de feedback die jij hebt gegeven
     */

    public function getGekregenFeedback(int $gebruikerID):array {
        $feedbacklijst = array();
        $mijnprojecten = $this->ProjectController->getALLByGebruikerID($gebruikerID);

        foreach ($mijnprojecten as $project){
            $feedback = $this->getByProjectID($project->getProjectID());
            foreach ($feedback as $f){
                $feedbacklijst[] = $f;
            }
        }
        return $feedbacklijst;
    }

    /**
     * Door middel van het gebruikersID kan hier de score worden opgehaald die hij van andere heeft gekregen.
     * @param int $gebruikerID
     * @return float
     */

    function getGemiddeldeGekregenScore(int $gebruikerID): float{
        $score = 0;
        $aantal = count($this->getGekregenFeedback($gebruikerID));
        foreach($this->getGekregenFeedback($gebruikerID) as $feedback){
            $score += $feedback->getCijfer();
        }
        return round($score/$aantal,1);
    }

}