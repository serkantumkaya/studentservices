<?php
if (!isset($_SESSION["GebruikerID"]) || $_SESSION["GebruikerID"] == -1){
Header("Location: /StudentServices/inlogPag.php");
}
?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">
<link rel="stylesheet" href="/StudentServices/css/Menu.css">
    <link rel="stylesheet" href="/StudentServices/css/Profiel.css">
    <link rel="stylesheet" href="/StudentServices/css/Homepage.css">
    <link rel="stylesheet" href="/StudentServices/css/Projecten.css">
    <script type="text/javascript" src="/StudentServices/JS/script.js"></script>
    <script type="text/javascript" src="/StudentServices/ClientSide/contactformulier.js"></script>
    <script type="text/javascript" src="/StudentServices/JS/bevestigenaccount.js"></script>
    <link rel="icon" href="/StudentServices/images/StudentenServices.ico">

</head>

<body>
<div class="header">

        <?php
        include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/menu.php");
        ?>

</div>