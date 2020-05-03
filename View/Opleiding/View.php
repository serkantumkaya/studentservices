
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
session_start();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="description" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">

    <script type="text/javascript" src="/StudentServices/JS/script.js">
        <?php
        //nu i
        $focus = "";
        if (isset($_SESSION["CurrentNaam"])) {
            $focus = trim($_SESSION["CurrentNaam"]);
        }
        ?>

    </script>
</head>

</head>

<body>

    <div class="header">
        <nav id="page-nav">
            <!-- [THE HAMBURGER] -->
            <label for="hamburger">&#9776;</label>
            <input type="checkbox" id="hamburger"/>

            <!-- [MENU ITEMS] -->

<ul>
    <?php
    echo "<li>
            <a href=\"Add.php\">Nieuw</a>
        </li>";
    echo "<li><a href=\"/StudentServices/index.php\">Terug</a></li>";
    ?>
</ul>
        </nav>
        <img id=
             <a href="index.html"><img id="logo" src="/StudentServices/images/logotrans.png"/></a>
    </div>

<div class="info">
<form  method="post" action="Edit.php">
<table> <tr> <th>Opleiding</th> <th></th> <th></th></tr>
<tr><td>
    <?php

        //DO NOT USE A BIG IF. If the conditions are not met. Return.
        if (empty($_Post) && !isset($_Post["actie"]))
        {
            LoadList();
            return;
        }


        switch ($_Post["actie"])//dit mag omdat je boven empty afvraagt anders mag dit niet zo
        {
            ////add via add.php en update via edit.php dat is het makkelijkste denk ik
            //case "add"://want de add stuurt je terug naar dit formulier met de data om toe te voegen
            //{

            //    break;
            //}
             case "delete":
             {
                 echo "De te verwijderen ID = ".$_Post("OpleidingId");
                 $this->delete($_Post["OpleidingId"]);
                break;
             }
             default:
             {
                 Loadlist();//interface maken die loadlist voor iedere index verplicht maakt?
             }
        }

        function LoadList()
        {
            $opleidingcontroller= new OpleidingController();
            foreach ($opleidingcontroller->GetOpleidingen() as $opleiding )
            {
                echo "<tr> <td>
                    <input type=\"submit\" value=\"".$opleiding->getNaamopleiding()."\" formaction='Edit.php?ID=".$opleiding->getOpleidingID()."' class=\"table1col\">
                    </td>
                    <td><input type=\"submit\" value=\"".$opleiding->getVoltijdDeeltijd()."\" formaction='Edit.php?ID=".$opleiding->getOpleidingID()."' class=\"table1col\"</td>
                    </tr>";
            }
        }

    ?>
    </td>
</tr>
</table>
</form>
</div>
<div class="footer">
    <div>© Student Services, 2020
        <?php
        $GebrID = 1;
        echo "<a href=\"index.php?GebrID=$GebrID\">Home </a>";

        ?>
    </div>
</div>
</body>
</html>

