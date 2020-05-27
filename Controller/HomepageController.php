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

    public function __construct(int $gebrID)
    {
        $this->gebruikersid = $gebrID;
        $this->gebruikercontroller = new GebruikerController($this->gebruikersid);
        $this->gebruiker = $this->gebruikercontroller->getById($this->gebruikersid);//deze bestaat altijd
        $this->profielcontroller = new ProfielController($this->gebruikersid);
        if ($this->profielcontroller->getByGebruikerID() != null) {//dit is voor het geval dat een profiel niet bestaat en de user wel
            $this->profiel = $this->profielcontroller->getById($this->gebruikersid);
            $this->profielexsist = true;
        }
        $this->projectcontroller = new ProjectController();
        $this->project = $this->projectcontroller->getByGebruikerID($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)) { //gebruiker kan geen projecten hebben.
            $this->projectexsist = true;
        }
        $this->reactiecontroller = new ReactieController($this->gebruikersid);
        $this->reactiegegeven = $this->reactiecontroller->GetByGebruikerId($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)) { //gebruiker kan geen projecten hebben.
            foreach ($this->project as $projectnumber) {
                $reacties = $this->reactiecontroller->getByProjectId($projectnumber->getProjectID());
                if (!(!isset($reacties) || $reacties == false)) {
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
        $feedbackgeg = $this->feedbackcontroller->getGegevenFeedback($this->gebruikersid);
        $projecten[] = $this->projectcontroller->getByGebruikerID($this->gebruikersid);
        $ownproject = false;
        if (!(!isset($feedbackgeg) || $feedbackgeg == false)) { //gebruiker kan geen feedback hebben.
                foreach ($feedbackgeg as $feedback) {
                    if (!(!isset($projecten) || $projecten == false)) {
                        foreach($projecten[0] as $project) {
                            if ($feedback-> getProjectID() == $project->getProjectID()) {
                                $ownproject = true;
                            }
                        }
                        if($ownproject){
                            $ownproject = false;
                        }
                        else{
                            $this->feedbackgegeven[] = $feedback;
                        }
                    }
                    else{
                        $this->feedbackgegeven[] = $feedback;
                    }
                }
        }
        if (!(!isset($projecten) || $projecten == false)) {
            foreach ($projecten[0] as $project) {
                $feedbackgekregen = $this->feedbackcontroller->getByProjectID($project->getProjectID());
                if (!(!isset($feedbackgekregen) || $feedbackgekregen == false)){
                    foreach ($feedbackgekregen as $feedback){
                        if($feedback->getGebruikerID() != $this->gebruikersid){
                            $this->feedbackgekregen[] = $feedback;
                        }
                    }
                }
            }
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
                                $voornaam = $getprofielreactieuser->getVoornaam();
                                $tussenvoegsel = $getprofielreactieuser->getTussenvoegsel();
                                $achternaam = $getprofielreactieuser->getAchternaam();
                                return (" " . ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " . ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel)  ? $tussenvoegsel: "" ). " " .($achternaam != false || $achternaam != null || !empty($achternaam)  ? $achternaam: "" ));

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
                            if (!empty($this->reactiegekregen[count($this->reactiegekregen) - 1]->getTimestamp())) {
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

    public function getfeedbacktext(int $id = null){
        if($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
             return $this->feedbackcontroller->getById($lastfeedbackId)->getReview();
            } else {
                return "geen feedback gevonden";
            }
        }
        else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                return $this->feedbackcontroller->getById($lastfeedbackId)->getReview();
            } else {
                return "geen feedback gevonden";
            }
        }
    }

    public function getprojecttitlebyfeedback(int $id = null){
        if($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                $projecten = $this->projectcontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)->getProjectID());
                if (!(!isset($projecten) || $projecten == false)){ //gebruiker kan geen projecten hebben.
                    if ($projecten->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        return $projecten->getTitel();
                    }
                }
                else{
                    return "......";
                }
            }else {
                return "....";
            }
        }
        else {
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()) {
                            return $projects->getTitel();
                        }
                    }
            }else {
                return "....";
            }
        }
    }

    public function getusernamebyfeedback(int $id = null){
        if($id != null){
            return $this->getfullname();
        }
        else {
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()) {
                            $this->profielcontroller = new ProfielController($this->feedbackcontroller->getById($lastfeedbackId)->getGebruikerID());
                            if (!empty($this->profielcontroller->getByGebruikerID()) && $this->profielcontroller->getByGebruikerID() != null) {
                                $getprofielreactieuser = $this->profielcontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)->getGebruikerID());
                                $voornaam = $getprofielreactieuser->getVoornaam();
                                $tussenvoegsel = $getprofielreactieuser->getTussenvoegsel();
                                $achternaam = $getprofielreactieuser->getAchternaam();
                                return (" " . ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " . ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel)  ? $tussenvoegsel: "" ). " " .($achternaam != false || $achternaam != null || !empty($achternaam)  ? $achternaam: "" ));

                            } else {
                                $getuserreactieuser = $this->gebruikercontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)->getGebruikerID());
                                return (" " . $getuserreactieuser->getEmail());
                            }
                        }
                    }
                }
            else {
                return "....";
            }
        }
    }

    public function gettimestampbyfeedback(int $id = null){
        if($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven) && false){
                foreach ($this->feedbackgegeven as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp())){
                    return $this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp();
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
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen) && false){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                    foreach ($this->project as $projects) {
                        if ($projects->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()) {
                            if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp())) {
                                return $this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp();
                            } else {
                                return "00-00-00 00:00:00";
                            }
                        }
                    }
            }
            else {
                return "00-00-00 00:00:00";
            }
        }
    }

    public function getcijferfeedback(int $id = null){
        if($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                    return $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer();
                }
                else {
                    return "geen cijfer gevonden";
                }
            }
            else {
                return "geen cijfer gevonden";
            }
        }
        else {
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects) {
                    if ($projects->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()) {
                        if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())) {
                            return $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer();
                        } else {
                            return "geen cijfer gevonden";
                        }
                    }
                }
            }
            else {
                return "geen cijfer gevonden";
            }
        }
    }



    public function geticoonfeedback(int $id = null){
        $urlimage = "";
      if($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                    if (round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer()/2) == 0) {
                    $string =  $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2;

                        $urlimage = "/StudentServices/images/Feedback_smile_"."$string".".png";
                        //var_dump($urlimage);

                    } else {
                        $string =  round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2) + 1;
                        //var_dump( round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer()/2));
                        $urlimage = "/StudentServices/images/Feedback_smile_"."$string".".png";
                        //var_dump($urlimage);
                    }

                }
                else {
                    $urlimage = "/StudentServices/images/Feedback_smile_5.png";
                }
            }
            else {
                $urlimage = "/StudentServices/images/Feedback_smile_5.png";
            }
        }
        else {
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if($feedback->getFeedbackID() > $lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects) {
                    if ($projects->getProjectID() == $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()) {
                        if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())) {
                            if (round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer()/2) == 0) {
                                $string =  $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2;
                                $urlimage = "/StudentServices/images/Feedback_smile_"."$string".".png";
                               // var_dump($urlimage);
                            } else {
                                $string =  round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2) + 1;
                                $urlimage = "/StudentServices/images/Feedback_smile_"."$string".".png";
                               // var_dump($urlimage);
                            }
                        } else {
                            return  "/StudentServices/images/Feedback_smile_5.png";
                        }
                    }
                }
            }
            else {
                return  "/StudentServices/images/Feedback_smile_5.png";
            }
        }
        return $urlimage;
    }
}