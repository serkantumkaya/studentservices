<?php
session_start();

?><html lang="en">
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
                <h2>Contact formulier</h2>
                <label for="fname">Voornaam</label><br>
                <input type="text" id="fname" name="firstname" placeholder="Vul je voornaam in." maxlength="50" size="50"><br>
                <div id="error1" class="error"></div><br>
                <label for="lname">Achternaam</label><br>
                <input type="text" id="lname" name="lastname" placeholder="Vul je achternaam in." maxlength="50" size="50"><br>
                <div id="error3" class="error"></div><br>
                <label for="E-mail">E-mailadres</label><br>
                <input type="text" id="E-mail" name="E-mailadres" placeholder="Vul je e-mailadres in." maxlength="50" size="50"><br>
                <div id="error6" class="error"></div><br>
                <div id="error7" class="error"></div><br>
                <label for="E-mail2">E-mailadres controle</label><br>
                <input type="text" id="E-mail2" name="E-mailadres2" placeholder="Vul je e-mailadres nogmaals in voor controle." maxlength="50" size="50"><br>
                <div id="error6b" class="error"></div><br>
                <div id="error7b" class="error"></div><br>
                <label for="tel">Telefoonnummer</label><br>
                <input type="text" id="tel" name="telefoonnummer" placeholder="Vul je telefoonnummer in." maxlength="30" size="30"><br>
                <div id="error10" class="error"></div><br>
                 <label for="email">Contact voorkeur</label><br>
                <div class="E-mail"><br>
                    <input type="checkbox" name="myCheckBox" id="email" value="e-mail">
                    <label for="email">E-mail</label><br>
                </div>
                <div class="tel"><br>
                    <input type="checkbox" name="myCheckBox" id="tele" value="tel" checked>
                    <label for="tele">Whatsapp</label><br>
                    <br>
                </div><br>
                <label for="subject">Opmerking</label><br>
                <textarea id="subject" name="subject" placeholder="Vul hier uw opmerking in." style="height:200px" maxlength="1000" size="1000"></textarea><br>
                <div id="error11" class="error"></div><br>

                    <input id="submit" type="submit" value="Submit" />

                    <a href="contact.html" class="formbutton">Terug naar contact</a>

            </form>
        </div>

</div>

</div>
</body>
</html>