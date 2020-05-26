<?php

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();
$projectID = $_GET['ProjectID'];

if ($_POST){
    if (isset($_POST['submitReactie'])){
        verstuurReactie($reactiecontroller,$projectID);
    }
}

function verstuurReactie(ReactieController $reactiecontroller,$projectID){
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
                <a href="./Project.php?view=add" id="project-nieuw-button">Nieuw Project</a>
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
                                    Gemaakt op: " . substr($project->getDatumaangemaakt(),0,10) . "<br>
                                    Categorie: ".  $categoriecontroller->getById($project->getCategorieID()) ."
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
                                <a href=\"Project.php?view=change&ProjectID=$projectID\" id=\"project-wijzig-button\">Wijzig project</a>               
                            </div>
                          <div id='project-button'>
                                <button id='project-klaar'>project klaar</button> 
                          </div>
                    ";
                } else {
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
                        <form action="/StudentServices/ClientSide/Project.php?view=detail&ProjectID=<?php echo $projectID;?>" method="post">
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
                            <div id=\"reactie-inhoud\">
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