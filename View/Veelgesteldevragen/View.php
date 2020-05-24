<?php
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
    <label class="Vraaglabel" for="vraag-een">Voor wie is StudentenServices?</label>
    <div class="Antwoord">
        <p>StudentenServices is voor Studenten die graag hulp willen krijgen of juist hulp willen aanbieden aan andere studenten.</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-twee" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-twee">Ben ik te oud voor StudentenServices?</label>
    <div class="Antwoord">
        <p>Zolang je student bent ben je welkom bij StudentSerivces, voor ons is leeftijd maar een cijfer!</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-drie" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-drie">Waarom staat mijn school er niet bij?</label>
    <div class="Antwoord">
        <p>Voor jou school hebben we nog geen overeenkomst, neem contact op via het contactformulier dan gaan we hier z.s.m. een oplossing voor zoeken.</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-vier" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-vier">Mag ik hier ook mijn spullen te koop aanbieden?</label>
    <div class="Antwoord">
        <p>Ons doel is om studenten te helpen met hun problemen of vraagstukken. Miscchien kan er iemand je helpen met het maken van je eigen webshop!</p>
    </div>    
</div>
<div class="Vraag"> 
    <input id="vraag-vijf" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-vijf">Hoe kom ik in contact met StudentSerivces</label>
    <div class="Antwoord">
        <p>Dit kan via het contactformulier die te vinden is op onze pagina.</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-zes" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-zes">Waarom reageert er niemand op mijn project?</label>
    <div class="Antwoord">
        <p>Helaas is er nog niemand die zich bekwaam genoeg voelt om jou te helpen. Heb geduld en we zoeken met je mee.</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-zeven" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-zeven">Mag ik buiten StudentenServices nog meer hulp vragen?</label>
    <div class="Antwoord">
        <p>Natuurlijk! Wij proberen een hulpmiddel te zijn en als een ander je al heeft geholpen dan horen we dat graag.</p>
    </div>
</div>
<div class="Vraag"> 
    <input id="vraag-acht" type="checkbox" name="Vragen">
    <label class="Vraaglabel" for="vraag-acht">Hoe kan ik jullie bedanken?</label>
    <div class="Antwoord">
        <p>Wij zijn niet bang voor complimenten, laat het ons weten via het contactformulier!</p>
    </div>
</div>
</body>
</html>