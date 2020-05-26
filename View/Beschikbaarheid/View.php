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
    <input type="submit" value="Nieuw"  class="ssbutton">
    <button onclick="window.location.href="./Index.php" class="ssbutton">Terug</button>
</form>
<form  method="post" action="Edit.php">
<table> <tr> <th>Beschikbaarheid</th> <th></th> <th></th></tr>
<tr><td>
    <?php
        //DO NOT USE A BIG IF. If the conditions are not met. Return.
        if (empty($_Post) && !isset($_Post["actie"]))
        {
            $beschikbaarheidcontroller= new BeschikbaarheidController();
            var_dump($beschikbaarheidcontroller->GetBeschikbaarheden());
            foreach ($beschikbaarheidcontroller->GetBeschikbaarheden() as $sg)
            {
                $beschikbaarheid = new Beschikbaarheid(
                    $sg['projectID'],
                    $sg['dagBeschikbaar'],
                    $sg['startTijd'],
                    $sg['eindTijd']
                );

                echo "<tr> <td> <input type=\"submit\" value=\"".$beschikbaarheid->getBeschikbaarheidnaam()."\" formaction='Edit.php?ID=".
                    $beschikbaarheid->getBeschikbaarheid($sg['projectID'],
                        new DateTime($sg['dagBeschikbaar']),new DateTime($sg['startTijd']),
                        new DateTime($sg['eindTijd']))."' class=\"selectionrow\"> </td></tr>";
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

