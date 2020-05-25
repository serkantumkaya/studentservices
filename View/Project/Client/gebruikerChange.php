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
                <a href="Add.php" id="project-nieuw-button">Nieuw Project</a>
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
                               
                                </div>
                             </div>

                             <div id=\"project-titel\">
                                    <p>hier moet tekstvak om de titel te veranderen</p>
                             </div>
                         </div>
                         
                          <div id='project-info'>
                            <div id=\"project-info-grid\">
                                <div id=\"project-parameters\">
                                Hier moeten tekstvakken om dit te veranderen
                                    Gemaakt op: " . substr($project->getDatumaangemaakt(),0,10) . "<br>
                                    Categorie: ".  $categoriecontroller->getById($project->getCategorieID()) ."
                                </div>                         
                                <div id=\"project-beschrijving\">
                                <textarea maxlength=\"500\" name=\"Beschrijving\" cols=\"1\" rows=\"5\"
                                      placeholder=\"Max 500 characters\" required>" .$project->getBeschrijving()."</textarea>  
                                </div>
                            </div>
                         </div> 
                         <div id=\"project-footer\">
                         </div>
                     </div>";
                ?>
            </div>
            <div id="reacties">
                <div id="reacties-scroll">
                    <div id="reactie-venster">
                        <!--<form action="Project.php?ProjectID=<?php /*echo $projectID;*/?>" method="post">
                            <label for="Reactie"><h3>Nieuwe reactie:</h3></label>
                            <textarea maxlength="500" name="Reactie" cols="1" rows="5"
                                      placeholder="Max 500 characters" required></textarea>
                            <input type="submit" name="submitReactie" value="Plaatsen">
                        </form>-->
                    </div>

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