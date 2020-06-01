<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/ProfielController.php");
session_start();
?><!DOCTYPE HTML>
<html>
<head>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");

if ($_SESSION["level"]<50)
    echo("<script>window.location.assign('/StudentServices/inlogPag.php');</script>");
?>
    <script type="text/javascript" src="/StudentServices/JS/script.js">
        <?php
        //nu i
        $focus = "";
        if (isset($_SESSION["CurrentNaam"])){
            $focus = trim($_SESSION["CurrentNaam"]);
        }
        ?>

    </script>
</head>
<body>
    <form method="post" action="Edit.php">
        <table>
            <tr>
                <th>Profiel</th>
            </tr>
            <tr>
                <td>
                    <?php

                    //DO NOT USE A BIG IF. If the conditions are not met. Return.
                    if (empty($_Post) && !isset($_Post["actie"])){
                        //todo : wijzigen naar $_SESSION["GebruikerID"]
                        $profielcontroller = new ProfielController($_SESSION["GebruikerID"]);

                        foreach ($profielcontroller->GetProfielen() as $profiel){
                            echo "<tr> <td> <input type=\"submit\" value=\"" . $profiel->getVoornaam() .
                                "\" formaction='EditAdmin.php?ID=" . $profiel->getProfielId() .
                                "' class=\"table1col\"> </td></tr>";
                        }
                    }

                    ?>
                </td>
            </tr>
        </table>
    </form>
</html>

