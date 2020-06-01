<?php
//session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");

$GC                = new GebruikerController($_SESSION['GebruikerID']);
$homeVertalen      = Translate::GetTranslation("menuHome");
$profielVertalen   = Translate::GetTranslation("menuMijnProfiel");
$projectVertalen   = Translate::GetTranslation("menuProjecten");
$faqVertalen       = Translate::GetTranslation("menuFAQ");
$contactVertalen   = Translate::GetTranslation("menuContact");
$uitloggenVertalen = Translate::GetTranslation("menuUitloggen");


if ($_SESSION["level"]>=50){
    $uitvoer = <<<EOD
<nav id="menu">
    <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu cf">
        <li><a href="/StudentServices/index.php">Home</a></li>
        <li><a href="#">Admin
                <span class="drop-icon">▾</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm0">▾</label>
            </a>
            <input type="checkbox" id="sm0">
            <ul class="sub-menu">
                <li><a href="/StudentServices/View/Gebruiker/View.php">Gebruikers</a></li>
                <li ><a href="/StudentServices/View/Project/View.php">ProjectenAdmin</a></li>
                <li ><a href="/StudentServices/View/Reactie/View.php">Reactie</a></li>
                <li><a href="/StudentServices/View/Feedback/View.php">Feedback</a></li>
                <li><a href="/StudentServices/View/Categorie/View.php">Categorie</a></li>
                <li><a href="/StudentServices/View/Opleiding/View.php">Opleiding</a></li>
                <li><a href="/StudentServices/View/School/View.php">School</a></li>
            </ul>

                      <!-- tijdelijk even 2x projecten neergezet, een voor de gebruiker, een voor de admin. -->
            <li><a href="/StudentServices/View/Profiel/View.php">Profielen</a></li>
         <li><a href="/StudentServices/ClientSide/Projecten.php?Page=1">Projecten</a></li>
         <li><a href="/StudentServices/View/Veelgesteldevragen/View.php">FAQ</a></li>
         <li><a href="/StudentServices/ClientSide/Contact.php">Contact</a></li>
         <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
        </li>

    </ul>
</nav>
<?php
EOD;
} else{
    $uitvoer = <<<EOD
<nav id="menu">
    <label for="tm" id="toggle-menu">Navigatiemenu <span class="drop-icon">▾</span></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu cf">
        <li><a href="/StudentServices/index.php">$homeVertalen</a></li>
        <li><a href="/StudentServices/View/Profiel/Edit.php">$profielVertalen</a></li>
        <li><a href="/StudentServices/ClientSide/Projecten.php?Page=1">$projectVertalen</a></li>
        <li><a href="/StudentServices/View/Veelgesteldevragen/View.php">$faqVertalen?</a></li>
        <li><a href="/StudentServices/ClientSide/Contact.php">$contactVertalen</a></li>
        <li><a href="/StudentServices/uitlog.php">$uitloggenVertalen</a></li>

    </ul>
</nav>
<?php
EOD;
}
echo $uitvoer;
?>
<img id="logo" src="/StudentServices/images/logotrans.png"/>


