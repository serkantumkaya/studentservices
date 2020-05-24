foreach ($reactiecontroller->getByProjectID($projectID) as $reactie){
echo "
<div id=\"reactie-venster\">
    <h3>Gegeven door: ". $gebruikersController->getById($reactie->getGebruikerID()) ."</h3>
    <div id=\"inhoud\">
        ". $reactie->getReactie() ."
    </div>
</div>";
}