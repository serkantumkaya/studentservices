<?php
//session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

$GC    = new GebruikerController($_SESSION['GebruikerID']);

if ($_SESSION["level"]>=50){
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
<!--            ADMIN heeft admin en normale menu's -->
<nav id='menu'>
            <ul  id="nav">
                        <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
            <li><a href="/StudentServices/index.php">Home</a></li>
            <li><a href="/StudentServices/View/Beschikbaarheid/View.php">Beschikbaarheid</a></li>  
            
            <li><a href="#">Stamdata</a>
                <ul>
                    <li class="#lisub"><a href="/StudentServices/View/Categorie/View.php">Categorie</a></li>
                    <li class="#lisub"><a href="/StudentServices/View/Opleiding/View.php">Opleiding</a></li>
                    <li class="#lisub"><a href="/StudentServices/View/School/View.php">School</a></li>
                </ul>
            </li>
            <li><a href="/StudentServices/View/Gebruiker/View.php">Gebruikers</a></li>
            <li><a href="/StudentServices/View/Project/View.php">ProjectenAdmin</a></li>
            <li><a href="/StudentServices/View/Feedback/View.php">Feedback</a></li>
           <!-- tijdelijk even 2x projecten neergezet, een voor de gebruiker, een voor de admin. -->
            <li><a href="/StudentServices/View/Profiel/View.php">Mijn profiel</a></li>
            <li><a href="/StudentServices/View/Categorie/View.php">ProjectenGebr</a></li>
            <li><a href="/StudentServices/View/Opleiding/View.php">FAQ</a></li>
            <li><a href="/StudentServices/View/Gebruiker/View.php">IETS</a></li>
             <li><a href="/StudentServices/ClientSide/contact.php">Contact</a></li>

        </ul>
</nav>
EOD;
} else{
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
            <ul>
                <li><a href="/StudentServices/View/Profiel/Edit.php">Mijn profiel</a></li>
                <li><a href="/StudentServices/View/Categorie/View.php">Projecten</a></li>
                <li><a href="/StudentServices/View/Opleiding/View.php">FAQ</a></li>
                <li><a href="/StudentServices/View/Gebruiker/View.php">IETS</a></li>
                <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
            </ul>
EOD;
}
echo $uitvoer;
?>


