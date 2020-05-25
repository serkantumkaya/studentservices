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
        $this->reactiegegeven = $this->reactiecontroller->GetByGebruikerId($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)) { //gebruiker kan geen projecten hebben.
            foreach ($this->project as $projectnumber) {
                $reacties = $this->reactiecontroller->getByProjectId($projectnumber->getProjectID());
                if(!(!isset($reacties) || $reacties == false)) {
                    foreach ($reacties as $_reactie) {
                        if (!(!isset($_reactie) || $_reactie == false)) {
                            if ($_reactie->getGebruikerID() != $this->gebruikersid) {
                                $this->reactiegekregen[] = $_reactie;
                            }
                        }
                    }
                }
            }
        }
        $this->feedbackcontroller = new FeedbackController();
        $this->feedbackgegeven = $this->feedbackcontroller->getGegevenFeedback($this->gebruikersid);
       // var_dump($this->feedbackcontroller->getGegevenFeedback($this->gebruikersid));
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
            $result != false || $result!= null || !empty($result)?$result:"/StudentServices/images/no_user_pic.png";
            return $result;
        }
        return "/StudentServices/images/no_user_pic.png";
    }

    public function getfullname(){
        if($this->profielexsist) {
            $voornaam = $this->profiel->getVoornaam();
            $tussenvoegsel = $this->profiel->getTussenvoegsel();
            $achternaam = $this->profiel->getAchternaam();
            return (" " . ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " . ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel)  ? $tussenvoegsel: "" ). " " .($achternaam != false || $achternaam != null || !empty($achternaam)  ? $achternaam: "" ));
        }
        return (" ". $this->gebruiker->getEmail());
    }

    public function getaccountstatus(){
        if($this->profielexsist) {
            $status =  $this->profiel->getStatus();
            return (" " .($status != false || $status != null || !empty($status)  ? $status: "" ));
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

    public function getreactietext(int $id = null){
        if($id != null){
            if (!empty($this->reactiegegeven)){
                if (!empty( $this->reactiegegeven[count($this->reactiegegeven) - 1]->getReactie())) {
                    return $this->reactiegegeven[count($this->reactiegegeven) - 1]->getReactie();
                }
            } else {
                return "geen reactie gevonden";
            }
        }
        else{
            if (!empty($this->reactiegekregen)) {
                if (!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getReactie())) {
                    return $this->reactiegekregen[count($this->reactiegekregen) - 1]->getReactie();
                }
            } else {
                return "geen reactie gevonden";
            }
        }
    }

    public function getprojecttitlebyreactie(int $id = null){
        if($id != null){
            if (!empty($this->reactiegegeven)){
                if (!empty($this->reactiegegeven[count($this->reactiegegeven) - 1]->getGebruikerID())) {
                    $projecten = $this->projectcontroller->getById($this->reactiegegeven[count($this->reactiegegeven) - 1]->getprojectID());
                    if (!(!isset($projecten) || $projecten == false)){ //gebruiker kan geen projecten hebben.
                            if ($projecten->getProjectID() == $this->reactiegegeven[count($this->reactiegegeven) - 1]->getProjectID()) {
                                return $projecten->getTitel();
                            }
                    }
                    else{
                        return "......";
                    }
                }
            } else {
                return "....";
            }
        }
        else {
            if (!empty($this->reactiegekregen)) {
                if (!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID())) {
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID()) {
                            return $projects->getTitel();
                        }
                    }
                }
            } else {
                return "....";
            }
        }
    }

    public function getusernamebyreactie(int $id = null){
        if($id != null){
           return $this->getfullname();
        }
        else {
            if (!empty($this->reactiegekregen)) {
                if (!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID())) {
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID()) {
                            $this->profielcontroller = new ProfielController($this->reactiegekregen[count($this->reactiegekregen) - 1]->getGebruikerID());
                            if (!empty($this->profielcontroller->getByGebruikerID() != null)) {
                                $getprofielreactieuser = $this->profielcontroller->getById($this->reactiegekregen[count($this->reactiegekregen) - 1]->getGebruikerID());
                                return (" " . $getprofielreactieuser->getVoornaam() . " " . $getprofielreactieuser->getTussenvoegsel() . " " . $getprofielreactieuser->getAchternaam());
                            } else {
                                $getuserreactieuser = $this->gebruikercontroller->getById($this->reactiegekregen[count($this->reactiegekregen) - 1]->getGebruikerID());
                                return (" " . $getuserreactieuser->getEmail());
                            }
                        }
                    }
                }
            } else {
                return "....";
            }
        }
    }

    public function gettimestampbyreactie(int $id = null){
        if($id != null){
            if (!empty($this->reactiegegeven)){
                if ($this->reactiegegeven[count($this->reactiegegeven) - 1]->getTimestamp()){
                    return $this->reactiegegeven[count($this->reactiegegeven) - 1]->getTimestamp();
                }
                else {
                    return "00-00-00 00:00:00";
                }
            }
            else {
                return "00-00-00 00:00:00";
            }
        }
        else {
            if (!empty($this->reactiegekregen)) {
                if (!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID())) {
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->reactiegekregen[count($this->reactiegekregen) - 1]->getProjectID()) {
                            if ($this->reactiegekregen[count($this->reactiegekregen) - 1]->getTimestamp()) {
                                return $this->reactiegekregen[count($this->reactiegekregen) - 1]->getTimestamp();
                            } else {
                                return "00-00-00 00:00:00";
                            }
                        }
                    }
                }
            } else {
                return "00-00-00 00:00:00";
            }
        }
    }










}