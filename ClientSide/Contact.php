<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
var_dump($_POST);
if (isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) &&
    !empty($_POST['lastname']) && isset($_POST['E-mailadres']) && !empty($_POST['E-mailadres']) &&
    isset($_POST['E-mailadres2']) && !empty($_POST['E-mailadres2']) && isset($_POST['telefoonnummer']) &&
    !empty($_POST['telefoonnummer']) && isset($_POST['subject']) && !empty($_POST['subject'])){
    $status               = "";
    $response             = "";
    $gebruikerscontroller = new GebruikerController($_SESSION["GebruikerID"]);
    $gebruikers           = $gebruikerscontroller->getById();
    $mail = new createEmail();
    $mail->sendcontactmail(($_POST['firstname']. " " . $_POST['lastname']), $_POST['E-mailadres'], $_POST['telefoonnummer'], $_POST['subject'], $_SESSION["GebruikerID"]);
}
?>
<html lang="en">
<head>

    <title>Contact</title>
    <meta name="description" content="index">
    <meta name="author" content="StudentServices">
    <script src="contactformulier.js"></script>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/studentservices/Includes/header.php");

    ?>

</head> <!-- staat hier, omdat anders PHPstorm ging janken -->

<div onload="timeevents()" class="row">


    <div class="contacttekstform" id="rcornersContactform">


        <form name="contactform" method="post" onsubmit="return validateForm()" action="#">
            <h2><?php echo Translate::GetTranslation("contactformulier") ?></h2>
            <label for="fname"><?php echo Translate::GetTranslation("contactVoornaam") ?></label><br>
            <input type="text" id="fname" name="firstname"
                   placeholder="<?php echo Translate::GetTranslation("contactVoornaamPlaceholder") ?>" maxlength="50"
                   size="50"><br>
            <div id="error1" class="error"></div>
            <br>
            <label for="lname"><?php echo Translate::GetTranslation("contactAchternaam") ?></label><br>
            <input type="text" id="lname" name="lastname"
                   placeholder="<?php echo Translate::GetTranslation("contactAchternaamPlaceholder") ?>" maxlength="50"
                   size="50"><br>
            <div id="error3" class="error"></div>
            <br>
            <label for="E-mail"><?php echo Translate::GetTranslation("contactEmail") ?></label><br>
            <input type="text" id="E-mail" name="E-mailadres"
                   placeholder="<?php echo Translate::GetTranslation("contactEmailPlaceholder") ?>" maxlength="50"
                   size="50"><br>
            <div id="error6" class="error"></div>
            <div id="error7" class="error"></div>
            <br>
            <label for="E-mail2"><?php echo Translate::GetTranslation("contactEmail2") ?></label><br>
            <input type="text" id="E-mail2" name="E-mailadres2"
                   placeholder="<?php echo Translate::GetTranslation("contactEmailPlaceholder2") ?>" maxlength="50"
                   size="50"><br>
            <div id="error6b" class="error"></div>
            <div id="error7b" class="error"></div>
            <br>
            <label for="tel"><?php echo Translate::GetTranslation("contactTelefoon") ?></label><br>
            <input type="text" id="tel" name="telefoonnummer"
                   placeholder="<?php echo Translate::GetTranslation("contactTelefoonPlaceholder") ?>" maxlength="30"
                   size="50"><br>
            <div id="error10" class="error"></div>
            <br>
            <label for="subject"><?php echo Translate::GetTranslation("contactOpmerking") ?></label><br>
            <textarea id="subject" name="subject"
                      placeholder="<?php echo Translate::GetTranslation("contactOpmerkingPlaceholder") ?>"
                      style="height:200px" maxlength="1000" size="1000"></textarea><br>
            <div id="error11" class="error"></div>
            <br>

            <input id="submit" type="submit" value="<?php echo Translate::GetTranslation("contactVerstuur") ?>"/>

            <a href="contact.html" class="formbutton"><?php echo Translate::GetTranslation("contactTerug") ?></a>

        </form>
    </div>

</div>

</div>
</body>
</html>