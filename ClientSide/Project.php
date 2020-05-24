<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ReactieController.php");
session_start();

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();

$projectID = $_GET['ProjectID'];

if ($_POST){
    if (isset($_POST['submitReactie'])){
        verstuurreactie($reactiecontroller,$projectID);
    }
}

function verstuurreactie(ReactieController $reactiecontroller,$projectID){
    $reactiecontroller->add($_SESSION['GebruikerID'], $projectID, $_POST['Reactie']);
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
                <a href="../View/Project/Add.php" id="project-nieuw-button">Nieuw Project</a>
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
                                    <h3>gemaakt door " . $gebruikersController->getById($project->getGebruikerID()) . "</h3>
                                </div>
                             </div>

                             <div id=\"project-titel\">
                                 <h3>" . $project->getTitel() . "</h3>
                             </div>
                         </div>
                         
                         <div id='project-info'>
                            <div id=\"project-info-grid\">
                                <div id=\"project-parameters\">
                                    HFJDKSFHKJ SDHFSKJDHASKL DHAKS 
                                </div>                         
                                <div id=\"project-beschrijving\">
                                    " . $project->getBeschrijving() . "
                                </div>
                            </div>
                         </div>
                         
                         
                         <div id=\"project-footer\">
                         Aangemaakt op: " . $project->getDatumaangemaakt() . "
                         </div>
                     </div>";
                ?>
            </div>
            <div id="reacties">
                <div id="reacties-scroll">
                    <div id="reactie-venster">
                        <form action="Project.php?ProjectID=<?php echo $projectID;?>" method="post">
                            <label for="Reactie"><h3>Nieuwe reactie:</h3></label>
                            <textarea maxlength="500" name="Reactie" cols="1" rows="5"
                                      placeholder="Max 500 characters" required></textarea>
                            <input type="submit" name="submitReactie" value="Plaatsen">
                        </form>
                    </div>
                    <?php



                    foreach ($reactiecontroller->getByProjectID($projectID) as $reactie){
                        echo "                    
                        <div id=\"reactie-venster\">
                            <h3>Gegeven door: ". $gebruikersController->getById($reactie->getGebruikerID()) ."</h3>
                            <div id=\"inhoud\">
                               ". $reactie->getReactie() ."
                            </div>
                            <div id=\"inhoud-footer\">
                                mail deze gebruiker: 
                            </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
        </div>



        <div id="reclame">

        </div>

        <div id="overrechts">

        </div>
    </div>



    <?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</div>
</body>
</html>