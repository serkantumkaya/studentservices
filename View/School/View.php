
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/SchoolController.php");
session_start();
?>

    <script>
        <?php
            //nu i
        $focus = "";
        if (isset($_SESSION["CurrentNaam"])) {
            $focus = trim($_SESSION["CurrentNaam"]);
        }
        ?>

    </script>

<form  method="post" action="./StudentServices/View/School/Add.php">
    <input type="submit" value="Voeg een nieuwe toe" >
</form>
<form  method="post" action="./StudentServices/View/School/Edit.php">
<table> <tr> <th>School</th> <th></th> <th></th></tr>
<tr><td>
    <?php


        //GEEN grote if. Afvragen of er iets gepost is zo nee dan eruit springen. Anders gewoon
        //de code uitvoeren zonder slecht leesbare if {}
        if (empty($_Post) && !isset($_Post["actie"]))
        {
            echo "geen actie gevonden";
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
                 echo "De te verwijderen ID = ".$_Post("SchoolId");
                 $this->delete($_Post["SchoolId"]);
                break;
             }
             default:
             {
                 Loadlist();//interface maken die loadlist voor iedere index verplicht maakt?
             }
        }

        function LoadList()
        {
            $schoolcontroller= new SchoolController();

            foreach ($schoolcontroller->GetScholen() as $sg)
            {
                $school = new School($sg['SchoolID'],$sg['Schoolnaam']);

                //persoonlijk vindt ik dit niet mooi. Ben meer voor row select en dan op een knop edit of delete klikken.
                //Misschien weet iemand anders hoe dit moet.
                echo "<tr> <td > <div id='".$school->getSchoolnaam()."'> ".$school->getSchoolnaam()."</div></td>";
                echo " <td> <input type=\"submit\" value=\"Edit\" formaction='./View/School/Edit.php?ID=".$school->getSchoolID()."' > </td>";//want je haalt hier de data op? Of school in zijn geheel doorgeven?
                //echo "// <td> <a href=\"index.php?actie=delete?id=".$school->getSchoolID()."\">delete</a></td ></tr>";
            }
        }

    ?>
    </td>
</tr>
</table>
</form>

