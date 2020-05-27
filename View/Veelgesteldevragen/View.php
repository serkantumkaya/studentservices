<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");
session_start();

?><html lang="en">
<head>

    <title>Veelgestelde Vragen</title>
    <meta name="description" content="index">
    <meta name="author" content="StudentServices">

    <?php
include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php");

?>
    <link rel="stylesheet" href="/StudentServices/css/Veelgesteldevragen.css">
</head>
<body>
<div class="Vraag"> 
    <input id="vraag-een" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-een"><?php echo Translate::GetTranslation("vraag-een") ?></label>
    <div class="Antwoord" for="Antwoord-een">
        <p> <?php echo Translate::GetTranslation("Antwoord-een") ?> </p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-twee" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-twee"><?php echo Translate::GetTranslation("vraag-twee") ?></label>
    <div class="Antwoord" for="Antwoord-twee">
        <p><?php echo Translate::GetTranslation("Antwoord-twee") ?></p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-drie" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-drie"><?php echo Translate::GetTranslation("vraag-drie") ?></label>
    <div class="Antwoord" for="Antwoord-drie">
        <p><?php echo Translate::GetTranslation("Antwoord-drie") ?></p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-vier" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-vier"><?php echo Translate::GetTranslation("vraag-vier") ?></label>
    <div class="Antwoord" for="Antwoord-vier">
        <p><?php echo Translate::GetTranslation("Antwoord-vier") ?></p>
    </div>    
</div>
<div class="Vraag"> 
    <input id="vraag-vijf" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-vijf"><?php echo Translate::GetTranslation("vraag-vijf") ?></label>
    <div class="Antwoord" for="Antwoord-vijf">
        <p><?php echo Translate::GetTranslation("Antwoord-vijf") ?></p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-zes" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-zes"><?php echo Translate::GetTranslation("vraag-zes") ?></label>
    <div class="Antwoord" for="Antwoord-zes">
        <p><?php echo Translate::GetTranslation("Antwoord-zes") ?></p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-zeven" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-zeven"><?php echo Translate::GetTranslation("vraag-zeven") ?></label>
    <div class="Antwoord" for="Antwoord-zeven">
        <p><?php echo Translate::GetTranslation("Antwoord-zeven") ?></p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-acht" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-acht"><?php echo Translate::GetTranslation("vraag-acht") ?></label>
    <div class="Antwoord" for="Antwoord-acht">
        <p><?php echo Translate::GetTranslation("Antwoord-acht") ?></p>
    </div>
</div>
</body>
</html>