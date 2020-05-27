<?php


$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();
$projectID = $_GET['ProjectID'];

if($_POST){
    if (isset($_POST['submit'])){
        if (!empty($_POST['deadline']['bekend']) && ($_POST['deadline']['bekend'] != '')){
            $deadline = $projectController->undoDeadlineFormat($_POST['deadline']['bekend']);
        } else {
            $deadline = '0000-00-00 00:00:00';
        }

        $projectchange = new Project($projectID, intval($_SESSION['GebruikerID']), $_POST['Titel'], $_POST['Type'],
            $_POST['Beschrijving'], intval($_POST['CategorieID']), $_POST['datumaangemaakt'],
            $deadline, "Mee Bezig", $_POST['Locatie'], 0);

        if ($projectController->update($projectchange)){

            header('Location: project.php?ProjectID='.$projectID.'&view=detail');
        }


        var_dump($_POST);
    }



    die();

}

$project = $projectController->getById($_GET['ProjectID']);

$categorie = getUitvoerCategorie($categoriecontroller, $project);
$type = getUitvoerType($project);
$uitvoerdeadline = getUitvoerDeadline($project,$projectController);


function getUitvoerCategorie(CategorieController $categorieController, Project $project){
    $huidige     = $project->getCategorieID();
    $categorieen = $categorieController->getCategorieen();
    $text        = "<select id=\"Categorie\" name=\"CategorieID\">";
    foreach ($categorieen as $categorie){
        if ($huidige == $categorie->getCategorieID()){
            $text .= "<option selected='selected' value='" . $categorie->getCategorieID() . "'>" .
                $categorie->getCategorieNaam() .
                "</option>";
        } else{
            $text .= "<option value='" . $categorie->getCategorieID() . "'>" . $categorie->getCategorieNaam() .
                "</option>";
        }
    }
    $text .= "</select>";
    return $text;
}

function getUitvoerType(Project $project){
    $huidige = $project->getType();
    $typen   = array("aanbieden" => 'Ik bied hulp aan', "vragen" => 'Ik vraag om hulp');
    $text    = "<select id=\"Type\" name=\"Type\">";
    foreach ($typen as $type => $value){
        if ($huidige == $type){
            $text .= "<option selected='selected' value='$type'>$value</option>";
        } else{
            $text .= "<option value='$type'>$value</option>";
        }
    }
    $text .= "</select>";
    return $text;
}

function getUitvoerDeadline(Project $project,ProjectController $controller){
    $deadline = $project->getDeadline();
    if ($deadline == '0000-00-00 00:00:00'){
        return "<input type=\"datetime-local\" name=\"Deadline[Bekend]\"/><br><input type=\"checkbox\" name=\"Deadline[NietBekend]\" checked='checked'/>Niet bekend";
    } else {
        return "<input type=\"datetime-local\" name=\"Deadline[Bekend]\" value='".$controller->getDeadlineFormat($project->getDeadline()) ."'/><br><input type=\"checkbox\" name=\"Deadline[NietBekend]\"/>Niet bekend";
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
            <!--<h4>hier is wat over</h4>-->
        </div>
        <div id="filter-projecten" style="background-color: #004085">
            <!--hier hoeft nu ook niets-->
        </div>
        <form action="/Studentservices/ClientSide/project.php?ProjectID=<?php echo $projectID;?>&view=change" method="post">
            <div id="project-row-grid">
                <div id="project-header">
                    <div id="project-aanbieder">
                        <h3>Gemaakt door <?php echo $gebruikersController->getById($_SESSION['GebruikerID']); ?> </h3>
                    </div>

                    <div id="project-titel">
                    <textarea maxlength="70" name="Titel" rows="1"
                              placeholder="Titel (max 70 characters)" required><?php echo $project->getTitel();?></textarea>
                    </div>
                </div>
                <div id="project-info">
                    <div id="project-info-grid">
                        <div id="project-parameters">
                            <div id="parameter-tekstvak">Aangemaakt op:</div>
                            <div id="parameter-tekstvak"><input type="text" name="datumaangemaakt" value="<?php echo $project->getDatumaangemaakt();?>" readonly/><br></div>
                            <div id="parameter-tekstvak">Categorie:</div>
                            <div id="parameter-tekstvak"><?php echo $categorie; ?> <br></div>
                            <div id="parameter-tekstvak">Locatie:</div>
                            <div id="parameter-tekstvak"><input type="text" name="Locatie" value="<?php echo $project->getLocatie(); ?>" /><br></div>
                            <div id="parameter-tekstvak">Deadline:</div>
                            <!-- Dit stuk in fucntie voor deadline om checkbox eventueel aan te vinken -->
                            <div id='parameter-tekstvak'><?php echo $uitvoerdeadline; ?><br></div>
                            <div id="parameter-tekstvak">Type:</div>
                            <div id="parameter-tekstvak"><?php echo $type; ?> <br></div>
                        </div>
                        <div id="project-beschrijving">

                        <textarea maxlength="500" name="Beschrijving" rows="20"
                                  placeholder="Beschrijving (Max 500 characters)"
                                  required><?php echo $project->getBeschrijving(); ?> </textarea>
                        </div>
                    </div>
                </div>
                <div id="project-footer">
                    <button><a href="project.php?ProjectID=<?php echo $projectID;?>&view=detail"/>Terug</a></button>
                    <input type="submit" name="submit" value="Wijzig"/>
                </div>
            </div>
        </form>
        <div id="reclame">
            reclame ofzo
        </div>

        <div id="overrechts">
            <!--rechts over-->
        </div>
    </div>
</div>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</div>
</body>
</html>