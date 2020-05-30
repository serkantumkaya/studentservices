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
            <!-- [MENU ITEMS] -->
<!--            ADMIN heeft admin en normale menu's -->
<nav id='menu'>
            <ul  id="nav">
            <li><a href="/StudentServices/index.php">Home</a></li>
            <li><a href="#">Admin</a>
                <ul>
                <li class="#lisub"><a href="/StudentServices/View/Gebruiker/View.php">Gebruikers</a></li>
                <li class="#lisub" ><a href="/StudentServices/View/Project/View.php">ProjectenAdmin</a></li>
                <li class="#lisub"><a href="/StudentServices/View/Beschikbaarheid/View.php">BeschikbaarheidAdmin</a></li>
                <li class="#lisub"><a href="/StudentServices/View/Reactie/View.php">Reactie</a></li>
                <li class="#lisub"><a href="/StudentServices/View/Feedback/View.php">Feedback</a></li>
                <li class="#lisub"><a href="/StudentServices/View/Beschikbaarheid/View.php">Beschikbaarheid</a></li>  
                <li class="#lisub"><a href="/StudentServices/View/Categorie/View.php">Categorie</a></li>
                <li class="#lisub"><a href="/StudentServices/View/Opleiding/View.php">Opleiding</a></li>
                <li class="#lisub"><a href="/StudentServices/View/School/View.php">School</a></li>
                </ul>
            </li>
           <!-- tijdelijk even 2x projecten neergezet, een voor de gebruiker, een voor de admin. -->
            <li><a href="/StudentServices/View/Profiel/View.php">Mijn profiel</a></li>
            <li><a href="/StudentServices/ClientSide/Projecten.php?Page=1">Projecten</a></li>
            <li><a href="/StudentServices/View/Veelgesteldevragen/View.php">FAQ</a></li>
             <li><a href="/StudentServices/ClientSide/Contact.php">Contact</a></li>
             <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
        </ul>
</nav>
EOD;
} else{
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
            <ul>
                <li><a href="/StudentServices/index.php">$homeVertalen</a></li>
                <li><a href="/StudentServices/View/Profiel/Edit.php">$profielVertalen</a></li>
                <li><a href="/StudentServices/ClientSide/Projecten.php?Page=1">$projectVertalen</a></li>
                <li><a href="/StudentServices/View/Veelgesteldevragen/View.php">$faqVertalen</a></li>
                <li><a href="/StudentServices/ClientSide/Contact.php">$contactVertalen</a></li>
                <li><a href="/StudentServices/uitlog.php">$uitloggenVertalen</a></li>
            </ul>
EOD;
}
echo $uitvoer;
?>


