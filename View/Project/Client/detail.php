<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/BeschikbaarheidController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");
$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();
$feedbackcontroller = new FeedbackController();
$schowfeedbackdetail = 0;
$project = $projectController->getById($_GET['ProjectID']);

if (isset($_POST["feedback"])){
    $schowfeedbackdetail = 1;
}


if (isset($_POST["Cijfer"]) && isset($_POST["Feedback"])){
    $feedbackcontroller->add($project->getProjectID(), $_SESSION["GebruikerID"], $_POST["Cijfer"], $_POST["Feedback"]);
    $schowfeedbackdetail = 0;
}


$feedback = array();
$feedback = $feedbackcontroller->getGekregenFeedback($project->getGebruikerID());
$getlastresult = array();
foreach ($feedback as $result){
    $getlastresult[] = $result->getFeedbackID();
}
rsort($getlastresult);


$projectID = $_GET['ProjectID'];
$_SESSION["ProjectID"] = $projectID;//need it for beschikbaarheid.
if ($_POST){
    if (isset($_POST['submitReactie'])){
        verstuurReactie($reactiecontroller, $projectID);
    }
}

function verstuurReactie(ReactieController $reactiecontroller, $projectID){
    $reactiecontroller->add($_SESSION['GebruikerID'], $projectID, $_POST['Reactie']);
}

$deadline = getUitvoerDeadline($project);

function getUitvoerDeadline(Project $project){
    if ($project->getDeadline() == '0000-00-00 00:00:00'){
        return "Niet Bekend";
    } else{
        return $project->getDeadline();
    }
}

?><!DOCTYPE HTML>
<html>
<!--<head>-->
<title>Project</title>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php");

?>
<div id="projectpagina">
    <div class="grid-projecten-colums">
        <div id="overlinks">

        </div>
        <div id="filter-projecten">
            <div id="filter-project-terug">
            <a href="projecten.php?Page=1"/>
                <button id="project-button"><?php echo Translate::GetTranslation("ProjectTerug"); ?></button>
            </a>
            </div>
            <div id="nieuw-project">
                    <a href="./Project.php?view=add"
                       id="project-nieuw-button"><button id='project-button'><?php echo Translate::GetTranslation("ProjectNieuw"); ?></button></a>
            </div>
        </div>

        <div id="main">

            <div id="project-row">
                <?php

                echo "
                     <div id=\"project-row-grid\">
                         <div id=\"project-header\">
                             <div id=\"project-aanbieder\">
                                <div id=\"project-type-text\">
                                    <h3>" . Translate::GetTranslation("ProjectGemaaktDoor") . " " .
                    $gebruikersController->getById($project->getGebruikerID()) . "</h3>
                                </div>
                             </div>

                             <div id=\"project-titel\">
                                 <h3>" . $project->getTitel() . "</h3>
                             </div>
                         </div>
                         
                          <div id='project-info'>
                            <div id=\"project-info-grid\">
                                <div id=\"project-parameters\">
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectGemaaktOp") . ": </div>
                                    <div id='parameter-tekstvak'>" . substr($project->getDatumaangemaakt(), 0, 10) . "</div><br>
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectCategorie") . ": </div>
                                    <div id='parameter-tekstvak'>" .
                    $categoriecontroller->getById($project->getCategorieID()) . " </div><br>
                                    <div id='parameter-tekstvak'>Deadline: </div>
                                    <div id='parameter-tekstvak'>" . $deadline . "</div><br>
                                    <div id='parameter-tekstvak'>Locatie:  </div>
                                    <div id='parameter-tekstvak'>" . $project->getLocatie() . "</div><br>
                                    <div id='parameter-tekstvak'>Status:  </div>
                                    <div id='parameter-tekstvak'>" . $project->getStatus() . "</div><br>
                                
                                </div>
                                <div id=\"project-beschrijving\">
                                    " . $project->getBeschrijving() . "
                                </div>
                            </div>
                         </div>
                         
                         
                        <div id=\"project-footer\">
                         ";
                if ($project->getGebruikerID() == $_SESSION['GebruikerID']){
                    echo "<div id=\"project-footer-een\">
                            <div id='project-footer3'>
                                
                                    <a href=\"Project.php?ProjectID=$projectID&view=change\"><button id='project-button'>" .
                        Translate::GetTranslation("ProjectEdit") . "</button></a>
                                             
                            </div>
                         </div>
                         
                    ";
                } else{
                    echo ""; //anders hoeft er dus niets te worden weergegeven
                }
                echo "
                         </div>
                     </div>";
                ?>
            </div>
            <div id="reacties">
                <div id="reacties-scroll">
                    <div id="reactie-venster">
                        <form action="/StudentServices/ClientSide/Project.php?view=detail&ProjectID=<?php echo $projectID; ?>"
                              method="post">
                            <label for="Reactie">
                                <h3><?php echo Translate::GetTranslation("ProjectReactieNieuw"); ?></h3></label>
                            <textarea maxlength="500" name="Reactie" cols="1" rows="5"
                                      placeholder="Max 500 characters" required></textarea>
                            <input type="submit" name="submitReactie" value="Plaatsen">
                        </form>
                    </div>
                    <?php
                    $reacties = $reactiecontroller->getByProjectID($projectID);
                    if ($reacties != null){
                        foreach ($reactiecontroller->getByProjectID($projectID) as $reactie){
                            echo "                    
                        <div id=\"reactie-venster\">

                       
                            <div id='popup-knop'>
                                <h3 onclick=\"ShowPopup('reactie-popup" . $reactie->getGebruikerID() . "')\">" .
                                Translate::GetTranslation("ProjectReactieGegevenDoor") . " " .
                                $gebruikersController->getById($reactie->getGebruikerID()) . "
                                </h3>
                            </div>
                            <div id='reactie-popup" . $reactie->getGebruikerID() . "'  class='pop'>
                            <div class=\"reactie-popup-inhoud\">
                                <span onclick=\"HidePopup('reactie-popup" . $reactie->getGebruikerID() . "')\" class=\"close\">&times;</span>
                                    <p>";

                            $profielController = new ProfielController($reactie->getGebruikerID());


                            $NAW = $profielController->getNAW($reactie->getGebruikerID());
                            echo $NAW;
                            echo "</p>
                            </div>
                            </div>
                                                      
                            <div id=\"reactie-inhoud\">
                               " . $reactie->getReactie() . "
                            </div>
                            <div id=\"inhoud-footer\">
                                <!-- niks hier, weet niet direct of dit weg kan--> 
                            </div>
                    </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


        <div id="reclame">
            <div id="project-beschikbaarheid">
                <div id="project-beschikbaarheid-button">
                    <?php
                    if ($_SESSION['GebruikerID'] == $project->getGebruikerID()){

                        echo "<button id='project-button' onClick=\"window.location.href='/studentservices/View/Beschikbaarheid/View.php'\">
                            " . Translate::GetTranslation("ProjectenBeschikbaarheidButton") . "
                           </button>";
                    }
                    ?>
                </div>
                <div id="project-beschikbaarheidsoverzicht">
                    <?php

                    $beschikbaarheidcontroller = new BeschikbaarheidController();

                    foreach ($beschikbaarheidcontroller->GetBeschikbaarheidByProject($project->getProjectID()) as $sg){

                        $newStartTijd = $sg->getStartTijd()->format("Y-m-d H:i:s");
                        $newEindTijd  = $sg->getEindTijd()->format("Y-m-d H:i:s");

                        echo "<div id='beschikbaarheidrij>' <tr>";
                        echo "<td> <input type=\"submit\" value=\"" . $newStartTijd .
                            "\" formaction='Edit.php?ID=" .
                            $sg->getBeschikbaarheidID() . "' class=\"selectionrow\" style='width:200px;'> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> <input type=\"submit\" value=\"" . $newEindTijd . "\" formaction='Edit.php?ID=" .
                            $sg->getBeschikbaarheidID() . "' class=\"selectionrow\" style='width:200px;'> </td>";
                        echo "</tr>";
                        echo "<tr><td><hr></td>";
                        echo "</tr> </div>";
                    }

                    ?>
                </div>
            </div>
            <div id="project-feedback">
                <?php if (!$schowfeedbackdetail){ ?>
                    <div id="geef_feedback">
                        <form action="" method="post">
                            <input id="feedbackknop" type="submit" value="geef feedback">
                            <input id="feedback" type="hidden" name="feedback" value="feedback">
                        </form>
                    </div>
                    <div id="title_feedback">
                        <h3><?= $gebruikersController->getById($project->getGebruikerID())
                                ->getGebruikersnaam() ?></h3>
                    </div>
                    <div id="gemiddelde_cijfer">
                        <p>
                            beoordeling: <?= $feedbackcontroller->getGemiddeldeGekregenScore($project->getGebruikerID()) ?></p>
                    </div>
                    <?php

                    $counter = 0;
                    foreach ($getlastresult as $feedback){
                        if ($counter<4){
                            $counter++;
                            ?>
                            <div id='feedbacbox'>
                                <div id='feedbackby'><p>gegeven
                                        door <?= $gebruikersController->getById($feedbackcontroller->getById($feedback)
                                            ->getGebruikerID())->getGebruikersnaam() ?></p></div>
                                <div id='feedbackby'><p>cijfer <?= $feedbackcontroller->getById($feedback)
                                            ->getCijfer() ?></p></div>
                                <div><p><?= $feedbackcontroller->getById($feedback)->getReview() ?></p></div>
                            </div>
                        <?php }
                    }
                } else{ ?>
                    <form action="" method="post">
                        <label id="feedbacklabel" for="Feedback">
                            <h3>geef feedback</h3></label>
                        <label for="Cijfer">Cijfer</label>
                        <select id="Cijfer" name="Cijfer">
                            <?php
                            for ($i = 1; $i<=10; $i++){
                                // if ($i != $feedbackcontroller->getById($feedback)->getCijfer()){
                                ?>
                                <option id="cijfer" value=<?php echo $i ?>><?php echo $i ?></option>;
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <label for="comment"> vul hier je feedback in</label>
                        <textarea id="comment" maxlength="200" name="Feedback" cols="1" rows="5"
                                  placeholder="Max 200 characters" required></textarea>
                        <input type="submit" name="submitFeedback" value="Plaatsen">
                    </form>
                <?php } ?>

            </div>
        </div>
        <div id="overrechts">

        </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</div>

<script>
    function ShowPopup(ID) {
        document.getElementById(ID).style.display = "block";
    }

    function HidePopup(ID) {
        document.getElementById(ID).style.display = "none";
    }

    // // Get the button that opens the modal
    // var btn = document.getElementById("popup-knop");
    //
    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    //
    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //     modal.style.display = "none";
    // }
</script>


</body>
</html>