<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();

//var_dump($_SESSION);

$pagina = $_GET['Page'];
$vorige = $pagina-1;
$volgende = $pagina+1;
$maxpagina = ceil(count($projectController->getProjecten())/6);
?><!DOCTYPE HTML>
<html>
<!--<head>-->
<title>Projecten</title>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php");

?>
<div id="projectpagina">
    <div class="grid-projecten-colums">
        <div>

        </div>

        <div id="filter-projecten">
            <div id="nieuw-project">
                <a href="./Project.php?view=add" id="project-nieuw-button">Nieuw Project</a>
            </div>
            <div id="filter-projecten2">
                <h3>Filteren</h3>

                <form action="" method="post">

                        <input type="radio" name="joke" value="bed"/> A Bed<br>
                        <input type="radio" name="joke" value="clock"/> A Clock<br>
                        <input type="radio" name="joke" value="snake"/> A Snake<br>

                </form>

            </div>
        </div>

        <div id="main">
            <div id="projecten-row">
                <?php
                /*<h3><input type=\"submit\" value=\"" .$project->getTitel() . "\" formaction='../Profiel/Edit.php?ID="  .$project->getProjectID(). "' id=\"project-link\"></h3>*/
                foreach ($projectController->getPerpagina($pagina) as $project){
                    echo "
                     <div id=\"projecten-row-grid\">
                         
                         <div id=\"projecten-header\">
                             <div id=\"projecten-type\">
                                <div id=\"projecten-type-text\">
                                    <h3>" . $project->getType() . "</h3>
                                </div>
                             </div>
                             <a href=\"Project.php?view=detail&ProjectID=" . $project->getProjectID() . "\">
                             <div id=\"projecten-titel\">
                                 <h3>" . $project->getTitel() . "</h3>
                             </div>
                            </a>
                         </div>
                         
                         <div id=\"projecten-info\">
                             <div id=\"projecten-status\">" .
                        $project->getStatus() .
                        "</div>
                             <div id=\"projecten-beschrijving\">
                            " . $project->getBeschrijvingKort() . "
                            </div>
                         </div>
                         
                         <div id=\"projecten-footer\">
                         gemaakt door: " . $gebruikersController->getById($project->getGebruikerID()) . "
                         </div>
                     </div>";
                }

                echo "<div id=\"projecten-buttons\">";
                if ($pagina>1){
                    echo "        
            <a href=\"Projecten.php?Page=$vorige\" id=\"projecten-previous\">&laquo; Vorige</a>";
                }
                if ($pagina<$maxpagina){
                    echo "<a href=\"Projecten.php?Page=$volgende\" id=\"projecten-next\">Volgende &raquo;</a>";
                }
                echo "</div>";
                ?>
            </div>
        </div>
        <div id="reclame">

        </div>
    </div>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</div>
<script type="text/javascript">
    function ValidatePetSelection() {
        var checkboxes = document.getElementsByName("favorite_pet");
        var numberOfCheckedItems = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked)
                numberOfCheckedItems++;
        }
        if (numberOfCheckedItems > 2) {
            alert("You can't select more than two favorite pets!");
            return false;
        }
    }
</script>
</body>
</html>