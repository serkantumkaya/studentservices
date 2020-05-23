<?php
foreach ($projectController->getProjecten() as $project){
    echo "
                    <div id=\"project-row-grid\">
                        <div id=\"project-header\">
                            <div id=\"project-type\"><h3>". $project->getType() ."</h3></div>
                                <div id=\"project-titel\">
                                    <h3>". $project->getTitel(). "</h3>
                                </div>
                        </div>
                        <div id=\"project-info\">
                        ". $project->getBeschrijvingKort() ."
                        </div>
                        <div id=\"project-footer\">
                        gemaakt door:". $gebruikersController->getById($project->getGebruikerID())  ."
                        </div>
                    </div>";
}
?>