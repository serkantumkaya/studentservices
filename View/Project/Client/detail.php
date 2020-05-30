<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/FeedbackController.php");

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


if(isset($_POST["Cijfer"]) && isset($_POST["Feedback"])){
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
        verstuurReactie($reactiecontroller,$projectID);
    }
}

function verstuurReactie(ReactieController $reactiecontroller,$projectID){
    $reactiecontroller->add($_SESSION['GebruikerID'],$projectID,$_POST['Reactie']);
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
            <div id="nieuw-project">
                <a href="./Project.php?view=add"
                   id="project-nieuw-button"><?php echo Translate::GetTranslation("ProjectNieuw"); ?></a>
            </div>
        </div>

        <div id="main">

            <div id="project-row">
                <?php
                $project = $projectController->getById($_GET['ProjectID']);
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
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectGemaaktOp") .
                    ": </div><div id='parameter-tekstvak'>" . substr($project->getDatumaangemaakt(),0,10) . "</div><br>
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectCategorie") .
                    ": </div><div id='parameter-tekstvak'>" .
                    $categoriecontroller->getById($project->getCategorieID()) . " </div><br>
                                </div>                         
                                <div id=\"project-beschrijving\">
                                    " . $project->getBeschrijving() . "
                                </div>
                            </div>
                         </div>
                         
                         
                         <div id=\"project-footer\">
                         ";
                if ($project->getGebruikerID() == $_SESSION['GebruikerID']){
                    echo "<div id='project-button'>
                                <a href=\"Project.php?ProjectID=$projectID&view=change\" id=\"project-wijzig-button\">" .
                        Translate::GetTranslation("ProjectEdit") . "</a>               
                            </div>
                          <div id='project-button'>
                                <button id='project-klaar'>" . Translate::GetTranslation("ProjectKlaar") . "</button> 
                          </div>
                    ";
                } else{
                    echo "";
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
                            <h3>" . Translate::GetTranslation("ProjectReactieGegevenDoor") . "<a href='' ></a>  " .
                                $gebruikersController->getById($reactie->getGebruikerID()) . "</h3>
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

            <div id="project-beschikbaarheid" style="Height:25px;">
                <button onClick="window.location.href='/studentservices/View/Beschikbaarheid/View.php'">
                    <?php
                    echo Translate::GetTranslation("ProjectenBeschikbaarheidButton")
                    ?>
                </button>
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
                        <h3><?= $gebruikersController->getById($project->getGebruikerID())->getGebruikersnaam() ?></h3>
                    </div>
                    <div id="gemiddelde_cijfer">
                        <p>
                            beoordeling <?= $feedbackcontroller->getGemiddeldeGekregenScore($project->getGebruikerID()) ?></p>
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
                }else{ ?>
                    <form action="" method="post">
                        <label id="feedbacklabel" for="Feedback">
                            <h3>geef feedback</h3></label>
                            <select id="Cijfer" name="Cijfer">";
                            <?php
                            for ($i = 1; $i<=10; $i++){
                           // if ($i != $feedbackcontroller->getById($feedback)->getCijfer()){
                            ?>
                            <option value= <?=$i?>><?=$i?></option>;
                           <?php
                            }
                            ?>
                        <textarea id="feedbackfield" maxlength="200" name="Feedback" cols="1" rows="5"
                                  placeholder="Max 200 characters" required></textarea>
                        <input type="submit" name="submitFeedback" value="Plaatsen">
                    </form>
                <?php }?>
            </div>
        </div>

        <div id="overrechts">

        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>

</body>
</html>