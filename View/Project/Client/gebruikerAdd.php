<?php

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();

if ($_POST){
    if (isset($_POST['Titel']) && isset($_POST['Beschrijving']) && isset($_POST['submit'])){
        if($projectController->add($_SESSION['GebruikerID'], $_POST['Titel'], $_POST['Type'], $_POST['Beschrijving'],
            $_POST['CategorieID'], $_POST['Deadline'], "Mee Bezig", $_POST['Locatie'])){
            //TODO: notificatie dat project is toegevoegd ofzo.
            // kan denk met javascript, even wachten, dan terugsturen naar dat project

            header('Location: Projecten.php?Page=1');
        }

    }

}

$categorie = getUitvoerCategorie($categoriecontroller);
$type = getUitvoerType();

function getUitvoerCategorie(CategorieController $categorieController){
    $categorieen = $categorieController->getCategorieen();
    $text        = "<select id=\"Categorie\" name=\"CategorieID\">";
    foreach ($categorieen as $categorie){
        $text .= "<option value='" . $categorie->getCategorieID() . "'>" . $categorie->getCategorieNaam() .
            "</option>";
    }
    $text .= "</select>";
    return $text;
}

function getUitvoerType(){
    $typen = array("aanbieden" => 'Ik bied hulp aan', "vragen" => 'Ik vraag om hulp');
    $text  = "<select id=\"Type\" name=\"Type\">";
    foreach ($typen as $type => $value){
        $text .= "<option value='$type'>$value</option>";
    }
    $text .= "</select>";
    return $text;

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
        <form action="/Studentservices/ClientSide/project.php?view=add" method="post">
            <div id="project-row-grid">
                <div id="project-header">
                    <div id="project-aanbieder">
                        <h3><?php echo Translate::GetTranslation("ProjectGemaaktDoor"). " ";   echo $gebruikersController->getById($_SESSION['GebruikerID']); ?> </h3>
                    </div>

                    <div id="project-titel">
                    <textarea maxlength="70" name="Titel" rows="1"
                              placeholder="Titel (max 70 characters)" required></textarea>
                    </div>
                </div>
                <div id="project-info">
                    <div id="project-info-grid">
                        <div id="project-parameters">
                            <div id="parameter-tekstvak"><?php echo Translate::GetTranslation("ProjectCategorie"); ?>:</div>
                            <div id="parameter-tekstvak"><?php echo $categorie; ?></div>
                            <div id="parameter-tekstvak"><?php echo Translate::GetTranslation("ProjectLocatie"); ?>:</div>
                            <div id="parameter-tekstvak"><input type="text" name="Locatie"/></div>
                            <div id="parameter-tekstvak">Deadline:</div>
                            <div id="parameter-tekstvak"><input type="datetime-local" name="Deadline" /> <br><input
                                        type="checkbox" name="NietBekend"/><?php echo Translate::GetTranslation("ProjectNietBekend"); ?><br></div>
                            <div id="parameter-tekstvak">Type:</div>
                            <div id="parameter-tekstvak"><?php echo $type; ?> </div>
                        </div>
                        <div id="project-beschrijving">

                        <textarea maxlength="500" name="Beschrijving" rows="20"
                                  placeholder="Beschrijving (Max 500 characters)" required></textarea>
                        </div>
                    </div>
                </div>
                <div id="project-footer">
                    <input type="submit" name="submit" value="<?php echo Translate::GetTranslation("ProjectVoegToe");?>"/>
                </div>
            </div>
        </form>
        <div id="reclame">
            <!--reclame ofzo-->
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