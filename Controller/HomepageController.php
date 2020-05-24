<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");

class HomepageController
{
    private $gebruikersid;
    private Gebruikercontroller $gebruikercontroller;
    private Gebruiker $gebruiker;
    private ProfielController $profielcontroller;
    private profiel $profiel;
    private bool $profielexsist = false;
    private ProjectController $projectcontroller;
    private $project = null;//deze heeft geen object decalering omdat hij een array terug krijgt van objecten
    private bool $projectexsist = false;
    private ReactieController $reactiecontroller;
    private $reactiegegeven = null;
    private $reactiegekregen;
    private $reactiegegevenexsist = false;
    private $reactiegekregenexsist = false;
    private FeedbackController $feedbackcontroller;
    private $feedbackgegeven = null;
    private $feedbackgekregen = null;
    private $feedbackgegevenexsist = false;
    private $feedbackgekregenexsist = false;

    public function __construct(int $gebrID)
    {
        $this->gebruikersid = $gebrID;
        $this->gebruikercontroller = new GebruikerController($this->gebruikersid);
        $this->gebruiker = $this->gebruikercontroller->getById($this->gebruikersid);//deze bestaat altijd
        $this->profielcontroller = new ProfielController($this->gebruikersid);
        if( $this->profielcontroller->getByGebruikerID() != null){//dit is voor het geval dat een profiel niet bestaat en de user wel
            $this->profiel = $this->profielcontroller->getById($this->gebruikersid);
            $this->profielexsist = true;
        }
        $this->projectcontroller = new ProjectController();
        $this->project = $this->projectcontroller->getByGebruikerID($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)){ //gebruiker kan geen projecten hebben.
            $this->projectexsist = true;
        }
        $this->reactiecontroller = new ReactieController($this->gebruikersid);
        foreach($this->project as $projectnumber){
            foreach ($this->reactiecontroller->getByProjectId($projectnumber->getProjectID()) as $_reactie){
                if (!(!isset($_reactie) || $_reactie == false)) {
                    if($_reactie->getGebruikersID()!=$this->gebruikersid){
                        $this->reactiegekregen[] = $_reactie;
                    }
                }
            }
        }
        $this->feedbackcontroller = new FeedbackController();
        $this->feedbackgegeven = $this->feedbackcontroller->getGegevenFeedback($this->gebruikersid);
        $this->feedbackgekregen = $this->feedbackcontroller->getGekregenFeedback($this->gebruikersid);
        if (!(!isset($this->feedbackgegeven) || $this->feedbackgegeven == false)){ //gebruiker kan geen feedback gegeven hebben.
            $this->feedbackgegevenexsist = true;
        }
        if (!(!isset($this->feedbackgekregen) || $this->feedbackgekregen == false)){ //gebruiker kan geen feedback ontvangen hebben.
            $this->feedbackgekregenexsist = true;
        }
}

    public function getfoto(){
        if($this->profielexsist) {
            $result = "data:image/jpeg;base64," . base64_encode($this->profiel->getFoto());
            $result != false || $result!= null?$result:"/StudentServices/images/no_user_pic.png";
            return $result;
        }
        return "/StudentServices/images/no_user_pic.png";
    }

    public function getfullname(){
        if($this->profielexsist) {
            return (" ".$this->profiel->getVoornaam(). " ". $this->profiel->getTussenvoegsel(). " ". $this->profiel->getAchternaam());
        }
        return (" ". $this->gebruiker->getEmail());
    }

    public function getaccountstatus(){
        if($this->profielexsist) {
            return (" " . $this->profiel->getStatus());
        }
        return "Onbekend";
    }

    public function getemail(){
        return (" ". $this->gebruiker->getEmail());
    }

    public function getprojectnameVR()
    {
        if($this->projectexsist) {
            if (!empty(($this->project)) && ($this->project)[count($this->project) - 1]->getType() == "Vragen") {
                return ($this->project)[count($this->project) - 1]->getTitel();
            } else {
                return "geen project gevonden";
            }
        }
        else{
            return "geen project gevonden";
        }
    }

    public function getprojecttextVR(){
        if($this->projectexsist){
            if (($this->project)[count($this->project) - 1]->getType() == "Vragen") {
                return ($this->project)[count($this->project) - 1]->getBeschrijving();
            } else {
                return "geen project gevonden";
            }
        }
        else{
            return "geen project gevonden";
        }
    }

    public function getprojectnameAB()
    {
        if($this->projectexsist) {
            if (!empty(($this->project)) && ($this->project)[count($this->project) - 1]->getType() == "Aanbieden") {
                return ($this->project)[count($this->project) - 1]->getTitel();
            } else {
                return "geen project gevonden";
            }
        }
        else{
            return "geen project gevonden";
        }
    }

    public function getprojecttextAB(){
        if($this->projectexsist){
            if (($this->project)[count($this->project) - 1]->getType() == "Aanbieden") {
                return ($this->project)[count($this->project) - 1]->getBeschrijving();
            } else {
                return "geen project gevonden";
            }
        }
        else{
            return "geen project gevonden";
        }
    }

    public function getreactietext(){
        if(!empty($this->reactiegekregen)) {
            if(!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getReactie())){
                return $this->reactiegekregen[count($this->reactiegekregen) - 1]->getReactie();
            }
        }
        else{
            return "geen reactie gevonden";
        }
    }

    public function getprojecttitlebyreactie(){
        if(!empty($this->reactiegekregen)) {
            if(!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID())){
                foreach ($this->project as $projects){
                    if($projects->getProjectID() == $this->reactiegekregen[count($this->reactiegekregen) - 1]-> getProjectID()){
                        return $projects->getTitel();
                    }
                }
            }
        }
        else{
            return "....";
        }
    }

    /*public function getusernamebyreactie(){
        if(!empty($this->reactiegekregen)) {
            if(!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getGebruikersID()())){
                foreach ($this->project as $projects){
                    if($projects->getProjectID() == $this->reactiegekregen[count($this->reactiegekregen) - 1]->getGebruikersID()()){
                        return $projects->getTitel();
                    }
                }
            }
        }
        else{
            return "....";
        }
    }*/








}