<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/BeschikbaarheidController.php");
session_start();
?><!DOCTYPE HTML>
<html>
<head>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/header.php");?>
<body>

<form  method="post" action="Add.php">
    <input type="submit" value="<?php echo Translate::GetTranslation("BeschikbaarheidNew"); ?>"  class="ssbutton">
    <button onclick="window.location.href="/StudentServices/ClientSide/Project.php?ProjectID="<?php echo $_SESSION["ProjectID"]; ?> "&view=detail" class="ssbutton"><?php echo Translate::GetTranslation("BeschikbaarheidBack"); ?></button>
</form>
<form  method="post" action="Edit.php">
<table> <tr> <th><?php echo Translate::GetTranslation("Beschikbaarheid"); ?></th> <th></th> <th></th></tr>
<tr><td>
    <?php
        //DO NOT USE A BIG IF. If the conditions are not met. Return.
        if (empty($_Post) && !isset($_Post["actie"]))
        {
            $beschikbaarheidcontroller= new BeschikbaarheidController();

            foreach ($beschikbaarheidcontroller->GetBeschikbaarheidByProject($_SESSION["ProjectID"]) as $sg)
            {
                $newStartTijd      = $sg->getStartTijd()->format("Y-m-d");
                $newEindTijd       = $sg->getEindTijd()->format("Y-m-d");

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

