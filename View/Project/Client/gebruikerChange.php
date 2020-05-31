<?php
$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();
$projectID = $_GET['ProjectID'];



if ($_POST){

    if (isset($_POST['submit'])){
        if (!empty($_POST['deadline']['bekend']) && ($_POST['deadline']['bekend'] != '')){
            $deadline = $projectController->undoDeadlineFormat($_POST['deadline']['bekend']);
        } else{
            $deadline = '0000-00-00 00:00:00';
        }
        $projectchange = new Project($projectID, intval($_SESSION['GebruikerID']), $_POST['Titel'], $_POST['Type'],
            $_POST['Beschrijving'], intval($_POST['CategorieID']), $_POST['datumaangemaakt'],
            $deadline, "Mee bezig", $_POST['Locatie'], 0);
        if ($projectController->update($projectchange)){
            header('Location: project.php?ProjectID=' . $projectID . '&view=detail');
        }
    }
    if (isset($_POST['Klaar'])){
        if (!empty($_POST['deadline']['bekend']) && ($_POST['deadline']['bekend'] != '')){
            $deadline = $projectController->undoDeadlineFormat($_POST['deadline']['bekend']);
        } else{
            $deadline = '0000-00-00 00:00:00';
        }
        $projectklaar = new Project($projectID, intval($_SESSION['GebruikerID']), $_POST['Titel'], $_POST['Type'],
            $_POST['Beschrijving'], intval($_POST['CategorieID']), $_POST['datumaangemaakt'],
            $deadline, "Klaar", $_POST['Locatie'], 0);
        if ($projectController->update($projectklaar)){
            header('Location: project.php?ProjectID=' . $projectID . '&view=detail');
        }
    }

    if (isset($_POST['MeeBezig'])){
        if (!empty($_POST['deadline']['bekend']) && ($_POST['deadline']['bekend'] != '')){
            $deadline = $projectController->undoDeadlineFormat($_POST['deadline']['bekend']);
        } else{
            $deadline = '0000-00-00 00:00:00';
        }
        $projectbezig = new Project($projectID, intval($_SESSION['GebruikerID']), $_POST['Titel'], $_POST['Type'],
            $_POST['Beschrijving'], intval($_POST['CategorieID']), $_POST['datumaangemaakt'],
            $deadline, "Mee bezig", $_POST['Locatie'], 0);
        if ($projectController->update($projectbezig)){
            header('Location: project.php?ProjectID=' . $projectID . '&view=detail');
        }
    }
}

$project = $projectController->getById($_GET['ProjectID']);

$categorie = getUitvoerCategorie($categoriecontroller, $project);
$type = getUitvoerType($project);
$uitvoerdeadline = getUitvoerDeadline($project, $projectController);


function getUitvoerCategorie(CategorieController $categorieController, Project $project){
    $huidige = $project->getCategorieID();
    $categorieen = $categorieController->getCategorieen();
    $text = "<select id=\"Categorie\" name=\"CategorieID\">";
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

function getUitvoerDeadline(Project $project, ProjectController $controller){
    $deadline = $project->getDeadline();
    if ($deadline == '0000-00-00 00:00:00'){
        return "<input type=\"datetime-local\" name=\"Deadline[Bekend]\"/><br><input type=\"checkbox\" name=\"Deadline[NietBekend]\" checked='checked'/>" .
            Translate::GetTranslation("ProjectNietBekend");
    } else{
        return "<input type=\"datetime-local\" name=\"Deadline[Bekend]\" value='" .
            $controller->getDeadlineFormat($project->getDeadline()) .
            "'/><br><input type=\"checkbox\" name=\"Deadline[NietBekend]\"/>" .
            Translate::GetTranslation("ProjectNietBekend");
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

            <a href="project.php?ProjectID=<?php echo $projectID; ?>&view=detail"/><button id="project-button"><?php echo Translate::GetTranslation("ProjectTerug"); ?></button></a>


            <!--hier hoeft nu ook niets-->
        </div>


        <form action="/Studentservices/ClientSide/project.php?ProjectID=<?php echo $projectID; ?>&view=change"
              method="post">
            <div id="project-row-grid">
                <div id="project-header">
                    <div id="project-aanbieder">
                        <h3><?php echo Translate::GetTranslation("ProjectGemaaktDoor") . " ";
                            echo $gebruikersController->getById($_SESSION['GebruikerID']); ?> </h3>
                    </div>

                    <div id="project-titel">
                    <textarea maxlength="70" name="Titel" rows="1"
                              placeholder="Titel (max 70 characters)"
                              required><?php echo $project->getTitel(); ?></textarea>
                    </div>
                </div>
                <div id="project-info">
                    <div id="project-info-grid">
                        <div id="project-parameters">
                            <div id="parameter-tekstvak"><?php echo Translate::GetTranslation("ProjectGemaaktOp"); ?>:
                            </div>
                            <div id="parameter-tekstvak"><input type="text" name="datumaangemaakt"
                                                                value="<?php echo $project->getDatumaangemaakt(); ?>"
                                                                readonly/><br></div>
                            <div id="parameter-tekstvak"><?php echo Translate::GetTranslation("ProjectCategorie"); ?>:
                            </div>
                            <div id="parameter-tekstvak"><?php echo $categorie; ?> <br></div>
                            <div id="parameter-tekstvak"><?php echo Translate::GetTranslation("ProjectLocatie"); ?>:
                            </div>
                            <div id="parameter-tekstvak"><input type="text" name="Locatie"
                                                                value="<?php echo $project->getLocatie(); ?>"/><br>
                            </div>
                            <div id="parameter-tekstvak">Deadline:</div>
                            <!-- Dit stuk in fucntie voor deadline om checkbox eventueel aan te vinken -->
                            <div id='parameter-tekstvak'><?php echo $uitvoerdeadline; ?><br></div>
                            <div id="parameter-tekstvak">Type:</div>
                            <div id="parameter-tekstvak"><?php echo $type; ?> <br></div>
                        </div>
                        <div id="project-beschrijving">

                        <textarea maxlength="500" name="Beschrijving" rows="15"
                                  placeholder="Beschrijving (Max 500 characters)"
                                  required><?php echo $project->getBeschrijving(); ?> </textarea>
                        </div>
                    </div>
                </div>
                <div id="project-footer">
                    <div id="project-footer2">
                        <button id="project-button">
                       <input type="submit" name="submit" id="project-button"
                              value="<?php echo Translate::GetTranslation("ProjectEdit"); ?>"/></button>
                    </div>
                    <div id='project-footer3'>
                        <div>
                            <?php
                               if ($project->getStatus() == "Klaar"){
                                   echo "<button id=\"project-button\">
                               <input type=\"submit\" name=\"MeeBezig\" id=\"\"
                                   value=\"".Translate::GetTranslation("ProjectMeeBezig"). "\"/></button>";
                               }
                               if ($project->getStatus() == "Mee bezig"){
                                   echo "<button id=\"project-button\">
                               <input type=\"submit\" name=\"Klaar\" id=\"project-button\"
                                   value=\"" . Translate::GetTranslation("ProjectKlaar") . "\"/></button>";
                               }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="reclame">
            <!-- reclame ofzo-->
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