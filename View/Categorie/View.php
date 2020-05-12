
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/CategorieController.php");
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

<form  method="post" action="Add.php">
    <input type="submit" value="Nieuw"  class="ssbutton">
    <button onclick="window.location.href="./Index.php" class="ssbutton">Terug</button>
</form>
<form  method="post" action="Edit.php">
<table> <tr> <th>Categorie</th> <th></th> <th></th></tr>
<tr><td>
    <?php
        //DO NOT USE A BIG IF. If the conditions are not met. Return.
        if (empty($_Post) && !isset($_Post["actie"]))
        {
           $Categoriecontroller= new CategorieController();
            foreach ($Categoriecontroller->GetCategorieen() as $sg)
            {
                $Categorie = new Categorie($sg['CategorieID'],$sg['Categorienaam']);
                echo "<tr> <td> <input type=\"submit\" value=\"".$Categorie->getCategorienaam()."\" formaction='Edit.php?ID=".$Categorie->getCategorieID()."' class=\"selectionrow\"> </td></tr>";
            }
        }

    ?>
    </td>
</tr>
</table>
</form>
</body>
</html>

