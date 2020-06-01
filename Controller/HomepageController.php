<?php
require_once("C:xampp/htdocs/StudentServices/Controller/GebruikerController.php");
require_once("C:xampp/htdocs/StudentServices/Controller/FeedbackController.php");
require_once("C:xampp/htdocs/StudentServices/Controller/ReactieController.php");
require_once("C:xampp/htdocs/StudentServices/Controller/ProjectController.php");
require_once("C:xampp/htdocs/StudentServices/Controller/ProfielController.php");
require_once("C:xampp/htdocs/StudentServices/Includes/Translate/Translate.php");

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

    public function __construct(int $gebrID){

        $this->gebruikersid        = $gebrID;
        $this->gebruikercontroller = new GebruikerController($this->gebruikersid);
        $this->gebruiker           = $this->gebruikercontroller->getById($this->gebruikersid);//deze bestaat altijd
        $this->profielcontroller   = new ProfielController($this->gebruikersid);


       if ($this->profielcontroller->getByGebruikerID() != null){//dit is voor het geval dat een profiel niet bestaat en de user wel

            $this->profiel       = $this->profielcontroller->getById($this->gebruikersid);
           $this->profielexsist = true;
        }
        $this->projectcontroller = new ProjectController();
        $this->project           = $this->projectcontroller->getByGebruikerID($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)){ //gebruiker kan geen projecten hebben.
            $this->projectexsist = true;
        }
        $this->reactiecontroller = new ReactieController($this->gebruikersid);
        $this->reactiegegeven    = $this->reactiecontroller->GetByGebruikerId($this->gebruikersid);
        if (!(!isset($this->project) || $this->project == false)){ //gebruiker kan geen projecten hebben.
            foreach ($this->project as $projectnumber){
                $reacties = $this->reactiecontroller->getByProjectId($projectnumber->getProjectID());
                if (!(!isset($reacties) || $reacties == false)){
                    foreach ($reacties as $_reactie){
                        if (!(!isset($_reactie) || $_reactie == false)){
                            if ($_reactie->getGebruikerID() != $this->gebruikersid){
                                $this->reactiegekregen[] = $_reactie;
                            }
                        }
                    }
                }
            }
        }
        $this->feedbackcontroller = new FeedbackController();
        $feedbackgeg              = $this->feedbackcontroller->getGegevenFeedback($this->gebruikersid);
        $projecten[]              = $this->projectcontroller->getByGebruikerID($this->gebruikersid);
        $ownproject               = false;
        if (!(!isset($feedbackgeg) || $feedbackgeg == false)){ //gebruiker kan geen feedback hebben.
            foreach ($feedbackgeg as $feedback){
                if (!(!isset($projecten) || $projecten == false)){
                    foreach ($projecten[0] as $project){
                        if ($feedback->getProjectID() == $project->getProjectID()){
                            $ownproject = true;
                        }
                    }
                    if ($ownproject){
                        $ownproject = false;
                    } else{
                        $this->feedbackgegeven[] = $feedback;
                    }
                } else{
                    $this->feedbackgegeven[] = $feedback;
                }
            }
        }
        if (!(!isset($projecten) || $projecten == false)){
            foreach ($projecten[0] as $project){
                $feedbackgekregen = $this->feedbackcontroller->getByProjectID($project->getProjectID());
                if (!(!isset($feedbackgekregen) || $feedbackgekregen == false)){
                    foreach ($feedbackgekregen as $feedback){
                        if ($feedback->getGebruikerID() != $this->gebruikersid){
                            $this->feedbackgekregen[] = $feedback;
                        }
                    }
                }
            }
        }
    }


    public function getfoto(){
        if ($this->profielexsist){
            if($this->profiel->getFoto()!= false || $this->profiel->getFoto() != null || !empty($this->profiel->getFoto())){
                return  "data:image/jpeg;base64," . base64_encode($this->profiel->getFoto());
            }
            else{
                return "/StudentServices/images/no_user_pic.png";
            }
        }
        return "/StudentServices/images/no_user_pic.png";
    }

    public function getfullname(){
        /*  if($this->profielexsist) {
              $voornaam = $this->profiel->getVoornaam();
              $tussenvoegsel = $this->profiel->getTussenvoegsel();
              $achternaam = $this->profiel->getAchternaam();
              return (" " . ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " . ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel)  ? $tussenvoegsel: "" ). " " .($achternaam != false || $achternaam != null || !empty($achternaam)  ? $achternaam: "" ));
          }*/
        return (" " . $this->gebruiker->getGebruikersnaam());
    }

    public function getaccountstatus(){
        if ($this->profielexsist){
            $status = Translate::GetTranslation('home' . $this->profiel->getStatus());
            return (" " . ($status != false || $status != null || !empty($status) ? $status : ""));
        }
        return Translate::GetTranslation("homeonbekend");
    }

    public function getemail(){
        return (" " . $this->gebruiker->getEmail());
    }

    public function getprojectnameVR(){
        if ($this->projectexsist){
            if (!empty(($this->project)) && ($this->project)[count($this->project)-1]->getType() == "Vragen"){
                return ($this->project)[count($this->project)-1]->getTitel();
            } else{
                return Translate::GetTranslation("homegeen project gevonden");
            }
        } else{
            return Translate::GetTranslation("homegeen project gevonden");
        }
    }

    public function getprojecttextVR(){
        if ($this->projectexsist){
            if (($this->project)[count($this->project)-1]->getType() == "Vragen"){
                return ($this->project)[count($this->project)-1]->getBeschrijving();
            } else{
                return Translate::GetTranslation("homegeen project gevonden");
            }
        } else{
            return Translate::GetTranslation("homegeen project gevonden");
        }
    }

    public function getprojectnameAB(){
        if ($this->projectexsist){
            if (!empty(($this->project)) && ($this->project)[count($this->project)-1]->getType() == "Aanbieden"){
                return ($this->project)[count($this->project)-1]->getTitel();
            } else{
                return Translate::GetTranslation("homegeen project gevonden");
            }
        } else{
            return Translate::GetTranslation("homegeen project gevonden");
        }
    }

    public function getprojecttextAB(){
        if ($this->projectexsist){
            if (($this->project)[count($this->project)-1]->getType() == "Aanbieden"){
                return ($this->project)[count($this->project)-1]->getBeschrijving();
            } else{
                //return Translate::GetTranslation("homegeen project gevonden");
            }
        } else{
            //return Translate::GetTranslation("homegeen project gevonden");
        }
    }


    public function getreactietext(int $id = null){
        $lastreactieId = 0;
        if ($id != null){
            if (!empty($this->reactiegegeven)){

                foreach ($this->reactiegegeven as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                if (!empty($this->reactiecontroller->getById($lastreactieId)->getReactie())){
                    return $this->reactiecontroller->getById($lastreactieId)->getReactie();
                } else{
                    return Translate::GetTranslation("homegeen reactie gevonden");
                }
            } else{
                return Translate::GetTranslation("homegeen reactie gevonden");
            }
        } else{
            $lastreactieId = 0;
            if (!empty($this->reactiegekregen)){
                foreach ($this->reactiegekregen as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                if (!empty($this->reactiecontroller->getById($lastreactieId)->getProjectID())){
                    foreach ($this->project as $projects){
                        if ($projects->getProjectID() ==
                            $this->reactiecontroller->getById($lastreactieId)->getProjectID()){
                            if (!empty($this->reactiecontroller->getById($lastreactieId)->getReactie())){
                                return $this->reactiecontroller->getById($lastreactieId)->getReactie();
                            } else{
                                return Translate::GetTranslation("homegeen reactie gevonden");
                            }
                        }
                    }
                }
            } else{
                return Translate::GetTranslation("homegeen reactie gevonden");
            }
        }
    }

    public function getprojecttitlebyreactie(int $id = null){
        if ($id != null){
            $lastreactieId = 0;
            if (!empty($this->reactiegegeven)){
                foreach ($this->reactiegegeven as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }


                if (!empty($this->reactiecontroller->getById($lastreactieId)->getGebruikerID())){
                    $projecten = $this->projectcontroller->getById($this->reactiecontroller->getById($lastreactieId)
                        ->getProjectID());
                    if (!(!isset($projecten) || $projecten == false)){ //gebruiker kan geen projecten hebben.
                        if ($projecten->getProjectID() ==
                            $this->reactiecontroller->getById($lastreactieId)->getProjectID()){
                            return $projecten->getTitel();
                        }
                    } else{
                        return "......";
                    }

                } else{
                    return "....";
                }
            }

        } else{
            $lastreactieId = 0;
            if (!empty($this->reactiegekregen)){
                foreach ($this->reactiegekregen as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                if (!empty($this->reactiecontroller->getById($lastreactieId)->getProjectID())){
                    foreach ($this->project as $projects){
                        if ($projects->getProjectID() ==
                            $this->reactiecontroller->getById($lastreactieId)->getProjectID()){
                            return $projects->getTitel();
                        }
                    }
                }
            } else{
                return "....";
            }
        }
    }


    public function getusernamebyreactie(int $id = null){
        if ($id != null){
            if (!empty($this->reactiegegeven)){
                return $this->getfullname();
            }
            return "....";
        } else{
            $lastreactieId = 0;
            if (!empty($this->reactiegekregen)){
                foreach ($this->reactiegekregen as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() == $this->reactiecontroller->getById($lastreactieId)->getProjectID()){
                        $this->profielcontroller =
                            new ProfielController($this->reactiecontroller->getById($lastreactieId)->getGebruikerID());
                        if (!empty($this->profielcontroller->getByGebruikerID() != null)){
                            $getprofielreactieuser =
                                $this->profielcontroller->getById($this->reactiecontroller->getById($lastreactieId)
                                    ->getGebruikerID());
                            $voornaam              = $getprofielreactieuser->getVoornaam();
                            $tussenvoegsel         = $getprofielreactieuser->getTussenvoegsel();
                            $achternaam            = $getprofielreactieuser->getAchternaam();
                            return (" " .
                                ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " .
                                ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel) ?
                                    $tussenvoegsel : "") . " " .
                                ($achternaam != false || $achternaam != null || !empty($achternaam) ? $achternaam :
                                    ""));

                        } else{
                            $getuserreactieuser =
                                $this->gebruikercontroller->getById($this->reactiecontroller->getById($lastreactieId)
                                    ->getGebruikerID());
                            return (" " . $getuserreactieuser->getEmail());
                        }
                    }
                }

            } else{
                return "....";
            }
        }
    }

    public function gettimestampbyreactie(int $id = null){
        $lastreactieId = 0;
        if ($id != null){
            if (!empty($this->reactiegegeven)){

                foreach ($this->reactiegegeven as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                if (!empty($this->reactiecontroller->getById($lastreactieId)->getTimestamp())){
                    return $this->reactiecontroller->getById($lastreactieId)->getTimestamp();
                } else{
                    return "-";
                }
            } else{
                return "-";
            }
        } else{
            $lastreactieId = 0;
            if (!empty($this->reactiegekregen)){
                foreach ($this->reactiegekregen as $reactie){
                    if ($reactie->getReactieID()>$lastreactieId){
                        $lastreactieId = $reactie->getReactieID();
                    }
                }
                //var_dump($this->reactiecontroller->getById($lastreactieId));
                if (!empty($this->reactiecontroller->getById($lastreactieId)->getProjectID())){
                    foreach ($this->project as $projects){
                        //var_dump($projects->getProjectID());
                        //var_dump($this->reactiecontroller->getById($lastreactieId)->getProjectID());
                        if ($projects->getProjectID() ==
                            $this->reactiecontroller->getById($lastreactieId)->getProjectID()){
                            if (!empty($this->reactiecontroller->getById($lastreactieId)->getTimestamp())){
                                return $this->reactiecontroller->getById($lastreactieId)->getTimestamp();
                            } else{
                                return "-";
                            }
                        }
                    }
                }
            } else{
                return "-";
            }
        }
    }

    public function getfeedbacktext(int $id = null){
        if ($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                return $this->feedbackcontroller->getById($lastfeedbackId)->getReview();
            } else{
                return Translate::GetTranslation("homegeen feedback gevonden");
            }
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                return $this->feedbackcontroller->getById($lastfeedbackId)->getReview();
            } else{
                return Translate::GetTranslation("homegeen feedback gevonden");
            }
        }
    }

    public function getprojecttitlebyfeedback(int $id = null){
        if ($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                $projecten = $this->projectcontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)
                    ->getProjectID());
                if (!(!isset($projecten) || $projecten == false)){ //gebruiker kan geen projecten hebben.
                    if ($projecten->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        return $projecten->getTitel();
                    }
                } else{
                    return "......";
                }
            } else{
                return "....";
            }
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        return $projects->getTitel();
                    }
                }
            } else{
                return "....";
            }
        }
    }

    public function getusernamebyfeedback(int $id = null){
        if ($id != null){
            if (!empty($this->feedbackgegeven)){
                return $this->getfullname();
            }
            return "....";
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        $this->profielcontroller =
                            new ProfielController($this->feedbackcontroller->getById($lastfeedbackId)
                                ->getGebruikerID());
                        if (!empty($this->profielcontroller->getByGebruikerID()) &&
                            $this->profielcontroller->getByGebruikerID() != null){
                            $getprofielreactieuser =
                                $this->profielcontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)
                                    ->getGebruikerID());
                            $voornaam              = $getprofielreactieuser->getVoornaam();
                            $tussenvoegsel         = $getprofielreactieuser->getTussenvoegsel();
                            $achternaam            = $getprofielreactieuser->getAchternaam();
                            return (" " .
                                ($voornaam != false || $voornaam != null || !empty($voornaam) ? $voornaam : "") . " " .
                                ($tussenvoegsel != false || $tussenvoegsel != null || !empty($tussenvoegsel) ?
                                    $tussenvoegsel : "") . " " .
                                ($achternaam != false || $achternaam != null || !empty($achternaam) ? $achternaam :
                                    ""));

                        } else{
                            $getuserreactieuser =
                                $this->gebruikercontroller->getById($this->feedbackcontroller->getById($lastfeedbackId)
                                    ->getGebruikerID());
                            return (" " . $getuserreactieuser->getEmail());
                        }
                    }
                }
            } else{
                return "....";
            }
        }
    }

    public function gettimestampbyfeedback(int $id = null){//feedback heeft geen timestamp
        if ($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven) && false){
                foreach ($this->feedbackgegeven as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp())){
                    return $this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp();
                } else{
                    return "";
                }
            } else{
                return "";
            }
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen) && false){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp())){
                            return $this->feedbackcontroller->getById($lastfeedbackId)->getTimestamp();
                        } else{
                            return "";
                        }
                    }
                }
            } else{
                return "";
            }
        }
    }

    public function getcijferfeedback(int $id = null){
        if ($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                    return $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer();
                } else{
                    return "-";
                }
            } else{
                return "-";
            }
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                            return $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer();
                        } else{
                            return "-";
                        }
                    }
                }
            } else{
                return "-";
            }
        }
    }


    public function geticoonfeedback(int $id = null){
        $urlimage = "";
        if ($id != null){
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgegeven)){
                foreach ($this->feedbackgegeven as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                    if (round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() % 2) == 0){
                        $string = $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2;
                    } else{
                        $string = floor($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2)+1;
                    }
                    $urlimage = "/StudentServices/images/Feedback_smile_" . "$string" . ".png";
                } else{
                    $urlimage = "/StudentServices/images/Feedback_smile_5.png";
                }
            } else{
                $urlimage = "/StudentServices/images/Feedback_smile_5.png";
            }
        } else{
            $lastfeedbackId = 0;
            if (!empty($this->feedbackgekregen)){
                foreach ($this->feedbackgekregen as $feedback){
                    if ($feedback->getFeedbackID()>$lastfeedbackId){
                        $lastfeedbackId = $feedback->getFeedbackID();
                    }
                }
                foreach ($this->project as $projects){
                    if ($projects->getProjectID() ==
                        $this->feedbackcontroller->getById($lastfeedbackId)->getProjectID()){
                        if (!empty($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer())){
                            if (round($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() % 2) == 0){
                                $string = $this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2;
                            } else{
                                $string = floor($this->feedbackcontroller->getById($lastfeedbackId)->getCijfer() / 2)+1;
                            }
                            $urlimage = "/StudentServices/images/Feedback_smile_" . "$string" . ".png";
                        } else{
                            return "/StudentServices/images/Feedback_smile_5.png";
                        }
                    }
                }
            } else{
                return "/StudentServices/images/Feedback_smile_5.png";
            }
        }
        return $urlimage;
    }


}