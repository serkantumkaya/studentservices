<?php

require_once ("C:xampp/htdocs/StudentServices/Controller/BeschikbaarheidController.php");
session_start();
?><!DOCTYPE HTML>
<html>
<head>

    <?php
    include ("C:xampp/htdocs/StudentServices/Includes/header.php");?>
<body>

<form  method="post" action="Add.php" style="float:left">
    <button id="project-button"><input type="submit" value="<?php echo Translate::GetTranslation("BeschikbaarheidNew"); ?>"  class="ssbutton"></button>
</form>
<?php $poststring = "/StudentServices/ClientSide/Project.php?ProjectID=".$_SESSION["ProjectID"]."&view=detail";
?>
<form method="post" action="<?php echo $poststring ?>" style="width:200px;float:left;clear: right">
     <button id="project-button" type="submit" class="ssbutton"><?php echo Translate::GetTranslation("BeschikbaarheidBack"); ?></button>
</form>


<form  method="post" action="Edit.php" style="width:100%;clear: both">
<table> <tr> <th><?php echo Translate::GetTranslation("Beschikbaarheid"); ?></th> <th></th> <th></th></tr>
<tr><td>
    <?php
        //DO NOT USE A BIG IF. If the conditions are not met. Return.
        if (empty($_Post) && !isset($_Post["actie"]))
        {
            $beschikbaarheidcontroller= new BeschikbaarheidController();

            foreach ($beschikbaarheidcontroller->GetBeschikbaarheidByProject($_SESSION["ProjectID"]) as $sg)
            {
                $newStartTijd      = $sg->getStartTijd()->format("Y-m-d\TH:i:s");
                $newEindTijd       = $sg->getEindTijd()->format("Y-m-d\TH:i:s");

                echo "<tr>";
            echo "<td> <input type=\"submit\" value=\"".$sg->getBeschikbaarheidID()."\" formaction='Edit.php?ID=".
                    $sg->getBeschikbaarheidID()."' class=\"selectionrow\"> </td>";
            echo "<td> <input type=\"submit\" value=\"".$newStartTijd."\" formaction='Edit.php?ID=".
                    $sg->getBeschikbaarheidID()."' class=\"selectionrow\"> </td>";
            echo "<td> <input type=\"submit\" value=\"".$newEindTijd."\" formaction='Edit.php?ID=".
                    $sg->getBeschikbaarheidID()."' class=\"selectionrow\"> </td>";
                echo "</tr>";
            }
        }

    ?>
    </td>
</tr>
</table>
</form>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/footer.php"); ?>
</body>
</html>

