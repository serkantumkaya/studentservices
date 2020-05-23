<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();


?><!DOCTYPE html>
<!DOCTYPE HTML>
<html>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php");

?>
<div class="grid-container-colums">
    <div>
        Over
    </div>
    <div id="sub-menu" style="background-color: #2ca02c ">
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
        hier moeten de verschillende categorie filters komen.
    </div>


    <div id="main" style="background-color: #007bff">
        <div id="project-row">
           <!-- <div id="project-kader-grid">
                <div id=\"project-header\">
                    <div id=\"project-type\"><h3>VRAAG/AANBOD</h3></div>
                    <div id=\"project-titel\">
                        <h3>Titel: Helpen bij maken van Taart</h3>
                    </div>
                </div>
                <div id=\"project-info\">
                    ik heb hulp nodig voor bla bal bal bla ik heb hulp nodig voor bla bal bal blaik heb hulp nodig
                    voor bla bal bal blaik heb hulp nodig voor bla bal bal blaik heb hulp nodig voor bla bal bal bla
                </div>
                <div id=\"project-footer\">
                    gemaakt door:
                </div>
            </div>-->

            <?php
                $i=0;
                 foreach ($projectController->getProjecten() as $project){
                     echo "
                     <div id=\"project-row-grid\">
                         <div id=\"project-header\">
                             <div id=\"project-type\">
                                <h3>". $project->getType() ."</h3>
                             </div>
                             <div id=\"project-titel\">
                                 <h3>". $project->getTitel(). "</h3>
                             </div>
                         </div>
                         <div id=\"project-info\">
                         ". $project->getBeschrijvingKort() ."
                         </div>
                         <div id=\"project-footer\">
                         gemaakt door: ". $gebruikersController->getById($project->getGebruikerID())  ."
                         </div>
                     </div>";
             }
            ?>
        </div>
    </div>


    <div id="reclame" style="background-color: #721c24">
        Hier kan de reclame
    </div>


</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</body>
</html>