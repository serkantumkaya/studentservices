<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/GebruikerController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/BeschikbaarheidController.php");

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();
$projectID = $_GET['ProjectID'];

$project = $projectController->getById($_GET['ProjectID']);


$_SESSION["ProjectID"] = $projectID;//need it for beschikbaarheid.

if ($_POST){
    if (isset($_POST['submitReactie'])){
        verstuurReactie($reactiecontroller, $projectID);
    }
}

function verstuurReactie(ReactieController $reactiecontroller, $projectID){
    $reactiecontroller->add($_SESSION['GebruikerID'], $projectID, $_POST['Reactie']);
}

$deadline = getUitvoerDeadline($project);

function getUitvoerDeadline(Project $project){
    if ($project->getDeadline() == '0000-00-00 00:00:00'){
        return "Niet Bekend";
    }else{
        return $project->getDeadline();
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

        </div>
        <div id="filter-projecten">
            <div id="nieuw-project">
                <a href="./Project.php?view=add"
                   id="project-nieuw-button"><?php echo Translate::GetTranslation("ProjectNieuw"); ?></a>
            </div>
        </div>

        <div id="main">

            <div id="project-row">
                <?php

                echo "
                     <div id=\"project-row-grid\">
                         <div id=\"project-header\">
                             <div id=\"project-aanbieder\">
                                <div id=\"project-type-text\">
                                    <h3>" . Translate::GetTranslation("ProjectGemaaktDoor") . " " .
                    $gebruikersController->getById($project->getGebruikerID()) . "</h3>
                                </div>
                             </div>

                             <div id=\"project-titel\">
                                 <h3>" . $project->getTitel() . "</h3>
                             </div>
                         </div>
                         
                          <div id='project-info'>
                            <div id=\"project-info-grid\">
                                <div id=\"project-parameters\">
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectGemaaktOp") . ": </div>
                                    <div id='parameter-tekstvak'>" . substr($project->getDatumaangemaakt(), 0, 10) . "</div><br>
                                    <div id='parameter-tekstvak'>" . Translate::GetTranslation("ProjectCategorie") . ": </div>
                                    <div id='parameter-tekstvak'>". $categoriecontroller->getById($project->getCategorieID()) . " </div><br>
                                    <div id='parameter-tekstvak'>Deadline: </div>
                                    <div id='parameter-tekstvak'>". $deadline ."</div><br>
                                    <div id='parameter-tekstvak'>Locatie:  </div>
                                    <div id='parameter-tekstvak'>". $project->getLocatie() ."</div><br>
                                
                                </div>
                                <div id=\"project-beschrijving\">
                                    " . $project->getBeschrijving() . "
                                </div>
                            </div>
                         </div>
                         
                         
                         <div id=\"project-footer\">
                         ";
                if ($project->getGebruikerID() == $_SESSION['GebruikerID']){
                    echo "<div id=\"project-footer-een\">
                            <div id='project-footer3'>
                                <button id='project-button'>
                                    <a href=\"Project.php?ProjectID=$projectID&view=change\">" .
                        Translate::GetTranslation("ProjectEdit") . "</a>
                                </button>               
                            </div>
                         </div>
                         
                    ";
                } else{
                    echo ""; //anders hoeft er dus niets te worden weergegeven
                }
                echo "
                         </div>
                     </div>";
                ?>
            </div>
            <div id="reacties">
                <div id="reacties-scroll">
                    <div id="reactie-venster">
                        <form action="/StudentServices/ClientSide/Project.php?view=detail&ProjectID=<?php echo $projectID; ?>"
                              method="post">
                            <label for="Reactie">
                                <h3><?php echo Translate::GetTranslation("ProjectReactieNieuw"); ?></h3></label>
                            <textarea maxlength="500" name="Reactie" cols="1" rows="5"
                                      placeholder="Max 500 characters" required></textarea>
                            <input type="submit" name="submitReactie" value="Plaatsen">
                        </form>
                    </div>
                    <?php
                    $reacties = $reactiecontroller->getByProjectID($projectID);
                    if ($reacties != null){
                        foreach ($reactiecontroller->getByProjectID($projectID) as $reactie){
                            echo "                    
                        <div id=\"reactie-venster\">
                       
                            <div id='popup-knop'>
                                <h3>" . Translate::GetTranslation("ProjectReactieGegevenDoor") . " ".
                                $gebruikersController->getById($reactie->getGebruikerID()) . "
                                </h3>
                            </div>
                            <div id='reactie-popup' class='pop'>
                            <div class=\"reactie-popup-inhoud\">
                                <span class=\"close\">&times;</span>
                                    <p>Some text in the Modal..</p>
                            </div>
                            </div>
                                                      
                            <div id=\"reactie-inhoud\">
                               " . $reactie->getReactie() . "
                            </div>
                            <div id=\"inhoud-footer\">
                                <!-- niks hier, weet niet direct of dit weg kan--> 
                            </div>
                    </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


        <div id="reclame">


                <div id="project-beschikbaarheid" style="height:400px;">

                    <button onClick="window.location.href='/studentservices/View/Beschikbaarheid/View.php'">
                        <?php
                            echo Translate::GetTranslation("ProjectenBeschikbaarheidButton")
                        ?>
                        </button>
                    <div id="Beshikbaarheidoverzicht"  style="overflow:auto;height:275px;">
                        <?php
                        $beschikbaarheidcontroller= new BeschikbaarheidController();

                        foreach ($beschikbaarheidcontroller->GetBeschikbaarheidByProject($_SESSION["ProjectID"]) as $sg)
                        {
                            $newStartTijd      = $sg->getStartTijd()->format("Y-m-d H:i:s");
                            $newEindTijd       = $sg->getEindTijd()->format("Y-m-d H:i:s");

                            echo "<tr>";
                            echo "<td> <input type=\"submit\" value=\"".$newStartTijd."\" formaction='Edit.php?ID=".
                                $sg->getBeschikbaarheidID()."' class=\"selectionrow\" style='width:200px;'> </td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td> <input type=\"submit\" value=\"".$newEindTijd."\" formaction='Edit.php?ID=".
                                $sg->getBeschikbaarheidID()."' class=\"selectionrow\" style='width:200px;'> </td>";
                            echo "</tr>";
                            echo "<tr><td>_________________</td>";
                            echo "</tr>";
                        }
                        ?>
                    </div>
                </div>
                <div id="project-feedback">
                    //TODO: Dirk moet hier zijn werk inbouwen
                    Feedback

                </div>
        </div>

        <div id="overrechts">

        </div>
    </div>


    <?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("reactie-popup");

    // Get the button that opens the modal
    var btn = document.getElementById("popup-knop");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>



</body>
</html>