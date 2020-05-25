<?php

$gebruikersController = new GebruikerController($_SESSION['GebruikerID']);
$projectController = new ProjectController();
$reactiecontroller = new ReactieController();
$categoriecontroller = new CategorieController();


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

                echo "
                     <div id=\"project-row-grid\">
                         <div id=\"project-header\">
                             <div id=\"project-aanbieder\">
                                <div id=\"project-type-text\">
                               
                                </div>
                             </div>

                             <div id=\"project-titel\">
                                    <p>hier moet tekstvak om de titel toe te voegen</p>
                             </div>
                         </div>
                         
                          <div id='project-info'>
                            <div id=\"project-info-grid\">
                                <div id=\"project-parameters\">
                                Hier moeten tekstvakken om dit toe te voegen
                                    Gemaakt op: <br>
                                    Categorie:
                                </div>                         
                                <div id=\"project-beschrijving\">
                                <textarea maxlength=\"500\" name=\"Beschrijving\" cols=\"1\" rows=\"5\"
                                      placeholder=\"Max 500 characters\" required></textarea>  
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