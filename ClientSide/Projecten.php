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
$gebruikerID = $_SESSION['GebruikerID'];


$pagina = intval($_GET['Page']);
$vorige = $pagina-1;
$volgende = $pagina+1;

$statusKlaar = null;
$statusMeeBezig = null;
$typeVraag = "";
$typeAanbod = "";
$welzelf = "";
$nietzelf = "";


//wat een gekloot was dit zeg
//
if ($_POST){
    $_SESSION['POST'] = $_POST;
    $_SESSION['PaginaNu'] = $pagina;
} elseif (empty($_POST)){
    echo "POST IS LEEEEGGGGGG!!!!!!";
    if ($_SESSION['PaginaNu'] == $pagina){
        //pagina is niet veranderd, dus de filter is weggehaald
        $_SESSION['POST']=null;
    } else{
        //pagina is dus veranderd, dus de post laten staan en de nieuwe pagina in de sessie plaatsen
        $_SESSION['PaginaNu'] = intval($pagina);
        echo "PAGINA IS VERANDERD";

    }
}

if (isset($_SESSION['POST']['status']['StatusK']) && $_SESSION['POST']['status']['StatusK'] == 'Klaar'){
    $statusKlaar = "checked";
}
if (isset($_SESSION['POST']['status']['StatusMB']) && $_SESSION['POST']['status']['StatusMB'] == 'Mee Bezig'){
    $statusMeeBezig = "checked";
}
if (isset($_SESSION['POST']['type']['vraag']) && $_SESSION['POST']['type']['vraag'] == 'vragen'){
    $typeVraag = "checked";
}
if (isset($_SESSION['POST']['type']['aanbod']) && $_SESSION['POST']['type']['aanbod'] == 'aanbieden'){
    $typeAanbod = "checked";
}
if (isset($_SESSION['POST']['persoon']['zelf']) && $_SESSION['POST']['persoon']['zelf'] == 'welzelf'){
    $welzelf = "checked";
} if (isset($_SESSION['POST']['persoon']['ander']) && $_SESSION['POST']['persoon']['ander'] == 'nietzelf'){
    $nietzelf = "checked";
}

$sql = $projectController->createFilter($_SESSION['POST'], $gebruikerID);

$maxpagina = ceil(count($projectController->getProjecten($sql)) / 6);

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
                <form action="Projecten.php?Page=1" method="post">
                    <div id="filter-projecten-status">
                        <input type=submit id="verwijderfilter" value="verwijder filters">
                        <div id="filter-projecten-kop">Status:</div>
                        <input type="checkbox" id="Klaar" name="status[StatusK]"
                               value="Klaar" onchange=this.form.submit() <?php echo $statusKlaar; ?> />
                        <!-- PHP na de onchange plaatsen, anders werkt het niet altijd -->
                        <label for="Klaar">Klaar</label><br>
                        <input type="checkbox" id="MeeBezig" name="status[StatusMB]"
                               value="Mee Bezig" onchange=this.form.submit() <?php echo $statusMeeBezig; ?> />
                        <label for="MeeBezig">Mee Bezig</label><br>
                    </div>
                    <div id="filter-projecten-categorie">
                        <div id="filter-projecten-kop">Categorie:</div>
                        <?php
                        foreach ($categorieController->getCategorieen() as $categorie){
                            $categorienaam = $categorie->getCategorieNaam();
                            $checker       = $categorienaam . "checked";
                            $status        = "";
                            if (isset($_SESSION['POST']['categorie'][$categorienaam])){
                                if ($_SESSION['POST']['categorie'][$categorienaam] === $categorienaam){
                                    $status = "checked";
                                }
                            }
                            echo "<input type=\"checkbox\" id=$categorienaam name=\"categorie[$categorienaam]\" value=$categorienaam $status onchange=this.form.submit() />";
                            echo "<label for=\"$categorienaam\">$categorienaam</label><br>";
                        }
                        ?>
                    </div>
                    <div id="filter-projecten-type">
                        <div id="filter-projecten-kop">Type:</div>
                        <input type="checkbox" id="vraag" name="type[vraag]"
                               value="vragen" onchange=this.form.submit() <?php echo $typeVraag; ?> />
                        <!-- PHP na de onchange plaatsen, anders werkt het niet altijd -->
                        <label for="Vraag">Gevraagd</label><br>
                        <input type="checkbox" id="aanbod" name="type[aanbod]"
                               value="aanbieden" onchange=this.form.submit() <?php echo $typeAanbod; ?> />
                        <label for="aanbod">Aangeboden</label><br>
                    </div>
                    <div id="filter-projecten-mijn">
                        <div id="filter-projecten-kop">Welke:</div>
                        <input type="checkbox" id="persoon" name="persoon[zelf]"
                               value="welzelf" onchange=this.form.submit() <?php echo $welzelf; ?> />
                        <!-- PHP na de onchange plaatsen, anders werkt het niet altijd -->
                        <label for="welzelf">Mijn projecten</label><br>
                        <input type="checkbox" id="nietzelf" name="persoon[ander]"
                               value="nietzelf" onchange=this.form.submit() <?php echo $nietzelf; ?> />
                        <label for="nietzelf">Niet mijn projecten</label><br>
                    </div>
                </form>

            </div>
        </div>

        <div id="main">
            <div id="projecten-row">
                <?php
                /*<h3><input type=\"submit\" value=\"" .$project->getTitel() . "\" formaction='../Profiel/Edit.php?ID="  .$project->getProjectID(). "' id=\"project-link\"></h3>*/
                $projecten = $projectController->getPerpagina($sql, $pagina);
                if (empty($projecten)){
                        echo "
                        <div id='projecten-geen-project'>
                        Er zijn geen projecten gevonden aan de hand van de opgegeven criteria.
                        </div>
                     
                     ";

                } else{
                    foreach ($projecten as $project){
                        echo "
                     <div id=\"projecten-row-grid\">
                         
                         <div id=\"projecten-header\">
                             <div id=\"projecten-type\">
                                <div id=\"projecten-type-text\">
                                    <h3>" . $project->getType() . "</h3>
                                </div>
                             </div>
                             <a href=\"Project.php?ProjectID=" . $project->getProjectID() . "&view=detail\">
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

</body>
</html>