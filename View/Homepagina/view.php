<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/HomepageController.php");

$homepagina = new HomepageController($_SESSION['GebruikerID']);


?>

<div class="layout_homepage">
    <div class="head">
        <div id="title">
            <h1><?php echo Translate::GetTranslation("homeWelkom") ?><?=$homepagina->getfullname()?></h1>
<!--            <p> Account status //=$homepagina->getaccountstatus()?></p>-->
            <p> <?php echo Translate::GetTranslation("homeEmail") ?> <?=$homepagina->getemail()?></p>
        </div>
        <div id="foto">
           <div> <img id="userfoto" src=<?=$homepagina->getfoto()?>></div>
        </div>
    </div>
    <div class="layout_mainpage">
        <div id="layout_sub">
            <div id="title_project">
                <h2><?php echo Translate::GetTranslation("homeProjecten") ?></h2>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeAanbiedend") ?></h3>
                    <h4><?=$homepagina->getprojectnameAB()?></h4>
                    <p><?=$homepagina->getprojecttextAB()?></p>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeVragend") ?></h3>
                    <h4><?=$homepagina->getprojectnameVR()?></h4>
                    <p><?=$homepagina->getprojecttextVR()?></p>
                </div>
            </div>
        </div>
        <div id="layout_sub">
            <div id="title_project">
                <h2 id="reactie_title"><?php echo Translate::GetTranslation("homeReacties") ?></h2>
                <img id="message" src="images/message_icoon.png">
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeReactie1") ?> <?=$homepagina->getprojecttitlebyreactie()?></h3>
                    <h4><?php echo Translate::GetTranslation("homeVerzondenDoor") ?> <?=$homepagina->getusernamebyreactie()?> <?php echo Translate::GetTranslation("homeOm") ?> <?=$homepagina->gettimestampbyreactie()?></h4>
                    <p><?=$homepagina->getreactietext()?></p>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeReactie2") ?> <?=$homepagina->getprojecttitlebyreactie($_SESSION['GebruikerID'])?></h3>
                    <h4><?php echo Translate::GetTranslation("homeVerzondenDoor") ?> <?=$homepagina->getusernamebyreactie($_SESSION['GebruikerID'])?> <?php echo Translate::GetTranslation("homeOm") ?> <?=$homepagina->gettimestampbyreactie($_SESSION['GebruikerID'])?></h4>
                    <p><?=$homepagina->getreactietext($_SESSION['GebruikerID'])?></p>
                </div>
            </div>
        </div>
        <div id="layout_sub">
            <div id="title_project">
                <h2 id="feedback_title"><?php echo Translate::GetTranslation("homeFeedback") ?></h2>
                <img id="feedback" src="images/feedback_icoon.png">
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeFeedbackOpProject") ?> <?=$homepagina->getprojecttitlebyfeedback()?></h3>
                    <h4><?php echo Translate::GetTranslation("homeFeedbackDoor") ?> <?=$homepagina->getusernamebyfeedback()?></h4>
                    <div id="feedback_box">
                        <div id="beoordeling">
                            <div><img id="symbool_feedback" src=<?=$homepagina->geticoonfeedback()?>></div>
                            <div><p><?php echo Translate::GetTranslation("homeCijfer") ?></p>
                                <p><?=$homepagina->getcijferfeedback()?></p></div>
                        </div>
                        <div id="message">
                            <p><?=$homepagina->getfeedbacktext()?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_box">
                <div>
                    <h3 class="subtitle"><?php echo Translate::GetTranslation("homeFeedbackVanJou") ?> <?=$homepagina->getprojecttitlebyfeedback($_SESSION['GebruikerID'])?></h3>
                    <h4><?php echo Translate::GetTranslation("homeFeedbackVanAnder") ?> <?=$homepagina->getusernamebyfeedback($_SESSION['GebruikerID'])?></h4>
                    <div id="feedback_box">
                        <div id="beoordeling">
                           <div><img id='symbool_feedback' src=<?=$homepagina->geticoonfeedback($_SESSION['GebruikerID'])?>></div>
                            <div><p><p><?php echo Translate::GetTranslation("homeCijfer") ?></p>
                            <p><?=$homepagina->getcijferfeedback($_SESSION['GebruikerID'])?></p>
                            </div>
                    </div>
                        <div id="message">
                            <p><?=$homepagina->getfeedbacktext($_SESSION['GebruikerID'])?></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

