<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

class Feedback
{

    private int $FeedbackID;
    private int $GebruikerID;
    private int $ProjectID;
    private int $Cijfer;
    private string $Review;
    private GebruikerController $gebruikercontroller;

    public function __construct(int $FeedbackID, int $GebruikerID, int $ProjectID, int $Cijfer, string $Review){
        $this->FeedbackID          = $FeedbackID;
        $this->GebruikerID         = $GebruikerID;
        $this->ProjectID           = $ProjectID;
        $this->Cijfer              = $Cijfer;
        $this->Review              = $Review;
        $this->gebruikercontroller = new GebruikerController($this->getGebruikerID());
    }

    /**
     * @return int
     */
    public function getFeedbackID(): int{
        return $this->FeedbackID;
    }

    /**
     * @param int $FeedbackID
     */
    public function setFeedbackID(int $FeedbackID): void{
        $this->FeedbackID = $FeedbackID;
    }

    /**
     * @return int
     */
    public function getGebruikerID(): int{
        return $this->GebruikerID;
    }

    /**
     * @param int $GebruikerID
     */
    public function setGebruikerID(int $GebruikerID): void{
        $this->GebruikerID = $GebruikerID;
    }

    /**
     * @return int
     */
    public function getProjectID(): int{
        return $this->ProjectID;
    }

    /**
     * @param int $ProjectID
     */
    public function setProjectID(int $ProjectID): void{
        $this->ProjectID = $ProjectID;
    }

    /**
     * @return int
     */
    public function getCijfer(): int{
        return $this->Cijfer;
    }

    /**
     * @param int $Cijfer
     */
    public function setCijfer(int $Cijfer): void{
        $this->Cijfer = $Cijfer;
    }

    /**
     * @return string
     */
    public function getReview(): string{
        return $this->Review;
    }

    /**
     * @param string $Review
     */
    public function setReview(string $Review): void{
        $this->Review = $Review;
    }

    /**
     * TODO: naar controller
     * verkorte versie van de Review teruggeven. past beter op het scherm
     * @return string
     */

    public function getReviewKort(): string{
        if (strlen($this->Review)>40){
            return substr($this->Review, 0, 40) . "...";
        } else{
            return $this->Review;
        }
    }

    /**
     * Gebruikersnaam ophalen aan de hand van het ID.
     * dit is de persoon die de feedback heeft gegeven
     *  TODO: Dit moet naar de Controller.
     * @return string
     */

    public function getGebruikerNaam(): string {
        return $this->gebruikercontroller->getById();
    }

    /**
     * Naam ophalen van degene die het heeft gegeven.
     * @return string
     */

    public function getGeversNaam(): string{
        //TODO: moet denk ik in de controller van de gebruiker??
    }


}