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

    /**
     * Eén feedback aan de hand van het ID ophalen.
     * @param int $ID
     * @return Feedback
     */

    public function getById(int $FeedbackID): Feedback{
        $feedback = $this->Feedbackmodel->get($FeedbackID);
        return new Feedback($feedback['FeedbackID'], $feedback['GebruikerID'], $feedback['ProjectID'],
            $feedback['Cijfer'], $feedback['Review']);
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

    public function getGekregenFeedback(){
        //TODO: via de projectcontroller jou projectID (meervoud) ophalen.
        //  aan de hand daarvan bepalen hoeveel feedback je hebt gekregen.
        //  ook hiermee kan je dan een gemiddelde maken met hoe de score ongeveer is.
    }

    public function getGeversNaam(int $gebruikerID){
        //zoiets als dit:
        //  return $this->ProfielController->getById($gebruikerID);
        // TODO: maken dat je hier dmv projectID de naam van de gever kan ophalen.
        //  hopelijk kan projectcontroller dat wel regelen.
    }



}