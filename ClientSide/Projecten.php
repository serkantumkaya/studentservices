<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProjectController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/CategorieController.php");
session_start();

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$categorieController = new CategorieController();
//var_dump($_SESSION);
var_dump($_POST);

$pagina = $_GET['Page'];
$vorige = $pagina-1;
$volgende = $pagina+1;
$maxpagina = ceil(count($projectController->getProjecten()) / 6);

$statusKlaar= "";
$statusMeeBezig = "";

if ($_POST){
    if (isset($_POST['status']['StatusK']) && $_POST['status']['StatusK'] == 'Klaar'){
    $statusKlaar = "checked";
    }
    if (isset($_POST['status']['StatusMB']) && $_POST['status']['StatusMB'] == 'Mee Bezig'){
        $statusMeeBezig = "checked";
    }
    $filter = createFilter();
}

//SELECT * FROM `project` WHERE ProjectID >= 1 AND Status = "Mee Bezig"
//SELECT * FROM `project` WHERE ProjectID >= 1 AND Status = "Mee Bezig" AND CategorieID = (SELECT CategorieID from categorie where categorieNaam = "Kleien")

    //TODO: dit in de controller plaatsen,
    // telling meesturen of het AND of OR moet zijn....

function createFilter(){
    $statusSQL = getStatusSQL();
    var_dump($statusSQL);

    $categorieSQL = getCategorieSQL();
}

function getStatusSQL(){
    $SQL = "";
    foreach ($_POST['status'] as $key => $value){
            $SQL .= "AND STATUS LIKE '%$value%'";
    }
    return $SQL;
}

function getCategorieSQL(){
    return " ";
}


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
                    <div id="filter-projecten-status">
                    Status:<br>
<!--                    <input type="checkbox" id="Klaar" name="StatusK" value="Klaar" <?php /*echo $statusKlaar; */?> onclick=if(this.checked){this.form.submit();}else{unsetValue('StatusK')} />
-->                    <input type="checkbox" id="Klaar" name="status[StatusK]" value="Klaar" <?php echo $statusKlaar; ?> onchange=this.form.submit() />
                    <label for="Klaar">Klaar</label><br>
                    <input type="checkbox" id="MeeBezig" name="status[StatusMB]" value="Mee Bezig" <?php echo $statusMeeBezig; ?> onchange=this.form.submit() />
                    <label for="MeeBezig">Mee Bezig</label><br>
                    </div>
                    <div id="filter-projecten-categorie">
                    Categorie:<br>
                    <?php
                        foreach ($categorieController->getCategorieen() as $categorie){
                            $categorienaam = $categorie->getCategorieNaam();
                            $checker = $categorienaam."checked";
                            $status = "";
                            if (isset($_POST['categorie'][$categorienaam])){
                                if ($_POST['categorie'][$categorienaam] === $checker){
                                    $status = "checked";
                                }
                            }
                            echo "<input type=\"checkbox\" id=$categorienaam name=\"categorie[$categorienaam]\" value=$checker $status onchange=this.form.submit() />";
                            echo "<label for=\"$categorienaam\">$categorienaam</label><br>";
                        }
                    ?>
                    </div>

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

<script>
function unsetValue(){

}
</script>

</body>
</html>