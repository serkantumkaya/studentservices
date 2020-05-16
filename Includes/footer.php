<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

$GC    = new GebruikerController($_SESSION['GebruikerID']);
$level = $GC->checkRechten();

//footer heeft alleen contact, home, en FAQ

if ($level>=50){
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
<!--            ADMIN heeft admin + normale menu's -->
                
                <a href="/StudentServices/View/School/View.php">School</a>
                <a href="/StudentServices/View/Categorie/View.php">Categorie</a>
                <a href="/StudentServices/View/Opleiding/View.php">Opleiding</a>
                <a href="/StudentServices/View/Gebruiker/View.php">Gebruikers</a>
                <a href="/StudentServices/View/School/View.php">Mijn profiel</a>
                <a href="/StudentServices/View/Categorie/View.php">Projecten</a>
                <a href="/StudentServices/View/Opleiding/View.php">FAQ</a>
                <a href="/StudentServices/View/Gebruiker/View.php">IETS</a>
                <a href="/StudentServices/uitlog.php">Uitloggen</a>
            
EOD;
} else{
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
                <a href="/StudentServices/View/School/View.php">Mijn profiel</a>
                <a href="/StudentServices/View/Categorie/View.php">Projecten</a>
                <a href="/StudentServices/View/Opleiding/View.php">FAQ</a>
                <a href="/StudentServices/View/Gebruiker/View.php">IETS</a>
                <a href="/StudentServices/uitlog.php">Uitloggen</a>
          
EOD;
}


?>
<div class="footer">
    <div>© Student Services, 2020
        <?php
        echo $uitvoer;
        ?>
    </div>
</div>
