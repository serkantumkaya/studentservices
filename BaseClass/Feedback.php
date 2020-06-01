<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

class Feedback
{

    private int $FeedbackID;
    private int $GebruikerID;
    private int $ProjectID;
    private int $Cijfer;
    private string $Review;

    public function __construct(int $FeedbackID, int $GebruikerID, int $ProjectID, int $Cijfer, string $Review){
        $this->FeedbackID          = $FeedbackID;
        $this->GebruikerID         = $GebruikerID;
        $this->ProjectID           = $ProjectID;
        $this->Cijfer              = $Cijfer;
        $this->Review              = $Review;
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

}