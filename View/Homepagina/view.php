<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/HomepageController.php");
$homepagina = new HomepageController($_SESSION['GebruikerID']);
//var_dump($homepagina->getprojectnameVR());
?>

<div class="layout_homepage">
    <div class="head">
        <div id="title">
            <h1>Hallo<?=$homepagina->getfullname()?></h1>
            <p> acount status <?=$homepagina->getaccountstatus()?></p>
            <p> Emailadres:  <?=$homepagina->getemail()?></p>
        </div>
        <div id="foto">
           <div> <img id="userfoto" src=<?=$homepagina->getfoto()?>></div>
           <div><button id="profiel">bewerk profiel</button></div>
        </div>
    </div>
    <div class="layout_mainpage">
        <div id="layout_sub">
            <div id="title_project">
                <h2>Projecten</h2>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">mijn aanbiedende projecten</h3>
                    <h4><?=$homepagina->getprojectnameAB()?></h4>
                    <p><?=$homepagina->getprojecttextAB()?></p>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">mijn vragende projecten</h3>
                    <h4><?=$homepagina->getprojectnameVR()?></h4>
                    <p><?=$homepagina->getprojecttextVR()?></p>
                </div>
            </div>
            <div id="to_project">
                <div><button id="button">naar projecten</button></div>
            </div>
        </div>
        <div id="layout_sub">
            <div id="title_project">
                <h2 id="reactie_title">Reacties</h2>
                <img id="message" src="images/message_icoon.png">
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">reactie op jouw project: <?=$homepagina->getprojecttitlebyreactie()?></h3>
                    <h4>verzonden door <?=$homepagina->getusernamebyreactie()?> om <?=$homepagina->gettimestampbyreactie()?></h4>
                    <p><?=$homepagina->getreactietext()?></p>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">jouw reactie op project:  <?=$homepagina->getprojecttitlebyreactie($_SESSION['GebruikerID'])?></h3>
                    <h4>verzonden door <?=$homepagina->getusernamebyreactie($_SESSION['GebruikerID'])?> om <?=$homepagina->gettimestampbyreactie($_SESSION['GebruikerID'])?></h4>
                    <p><?=$homepagina->getreactietext($_SESSION['GebruikerID'])?></p>
                </div>
            </div>
            <div id="to_project">
                <div><button id="button">naar Berichten</button></div>
            </div>
        </div>
        <div id="layout_sub">
            <div id="title_project">
                <h2 id="feedback_title">Feedback</h2>
                <img id="feedback" src="images/feedback_icoon.png">
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">Feedback op project stappenmotor aansturing</h3>
                    <h4>feedback door heil himler om 18:20:35</h4>
                    <div id="feedback_box">
                        <div id="beoordeling">
                            <img id="symbool_feedback" src="images/Feedback_smile_2.png">
                            <p>gegeven cijfer</p>
                            <p>2</p>
                        </div>
                        <div id="message">
                            <p>test</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle">Feedback op project Dc motor aansturing</h3>
                    <h4>feedback door heil himler om 18:20:35</h4>
                    <div id="feedback_box">
                        <div id="beoordeling">
                            <img id="symbool_feedback" src="images/Feedback_smile_2.png">
                            <p>gegeven cijfer</p>
                            <p>2</p>
                        </div>
                        <div id="message">
                            <p>was een asociale kwast en werken stond niet in het woordenboek van hem</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="to_project">
                <div><button id="button">naar Feedback</button></div>
            </div>
        </div>
    </div>
</div>

