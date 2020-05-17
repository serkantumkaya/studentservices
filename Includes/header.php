<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");

$GC    = new GebruikerController($_SESSION['GebruikerID']);
$level = $GC->checkRechten();

if ($level>=50){
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
<!--            ADMIN heeft admin en normale menu's -->
                <ul>
                <li><a href="/StudentServices/index.php">Home</a></li>
                <li><a href="/StudentServices/View/Beschikbaarheid/View.php">Beschikbaarheid</a></li>  
                <li><a href="/StudentServices/View/School/View.php">School</a></li>
                <li><a href="/StudentServices/View/Categorie/View.php">Categorie</a></li>
                <li><a href="/StudentServices/View/Opleiding/View.php">Opleiding</a></li>
                <li><a href="/StudentServices/View/Gebruiker/View.php">Gebruikers</a></li>
                <li><a href="/StudentServices/View/Feedback/View.php">Feedback</a></li>
                <li><a href="/StudentServices/View/Profiel/View.php">Mijn profiel</a></li>
                <li><a href="/StudentServices/View/Categorie/View.php">Projecten</a></li>
                <li><a href="/StudentServices/View/Opleiding/View.php">FAQ</a></li>
                <li><a href="/StudentServices/View/Gebruiker/View.php">IETS</a></li>
                <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
            </ul>
EOD;
} else{
    $uitvoer = <<<EOD
            <!-- [MENU ITEMS] -->
            <ul>
                <li><a href="/StudentServices/View/Profiel/View.php">Mijn profiel</a></li>
                <li><a href="/StudentServices/View/Categorie/View.php">Projecten</a></li>
                <li><a href="/StudentServices/View/Opleiding/View.php">FAQ</a></li>
                <li><a href="/StudentServices/View/Gebruiker/View.php">IETS</a></li>
                <li><a href="/StudentServices/uitlog.php">Uitloggen</a></li>
            </ul>
EOD;
}

?>
<head>
    <title>StudentServices</title>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="description" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body>
<div class="header">
    <nav id="page-nav">
        <!-- [THE HAMBURGER] -->
        <label for="hamburger">&#9776;</label>
        <input type="checkbox" id="hamburger"/>

        <?php
        echo $uitvoer;

        ?>
    </nav>
    <img id=
         <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
</div>