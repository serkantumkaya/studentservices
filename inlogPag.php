<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/DB.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
session_start();
$wronglogin = "";

$rememberpassword = isset($_POST["RememberMe"])
&& $_POST["RememberMe"] == 'on' ? 'on' : 'off';
//Even if you uncheck remember me and tell google to remember your password and user
//the credentials will still be visible. So if you want to test this right.
//Do not let google remember your password.
if (isset($_POST['username']) && $_POST['password']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cookie_name1  = "user";
    $cookie_name2  = "pw";
    $cookie_name3  = "ssrememberme";
    $cookie_value3 = $rememberpassword;

    $DB       = new ConnectDB();
    //$password   = hash('sha256',$password);//
    $pwsafe    = $DB->MakeSafe($password);
    $GC        = new GebruikerController(-1);
    $Gebruiker = $GC->Validate($username, $pwsafe);

    if ($Gebruiker->getGebruikerID() != -1){
        echo "Je wachtwoord was goed echter werkt het doorverwijzen nog niet!";
        $_SESSION["GebruikerID"] = $Gebruiker->getGebruikerID();
        $GC    = new GebruikerController($_SESSION['GebruikerID']);
        $_SESSION["level"] = $GC->checkRechten();

        if($rememberpassword =="on") {
            setcookie($cookie_name1, $_POST['username'], time()+(86400 * 365), "/"); // 86400 = 1 day
            setcookie($cookie_name2, $_POST['password'], time()+(86400 * 365), "/"); // 86400 = 1 day
            setcookie($cookie_name3, "on", time()+(86400 * 365), "/"); // 86400 = 1 day
        }
        else
        {
            setcookie($cookie_name1, "", time()-86400, "/"); // 86400 = 1 day
            setcookie($cookie_name2, "", time()-86400, "/"); // 86400 = 1 day
            setcookie($cookie_name3, "", time()-86400, "/"); // 86400 = 1 day
            $rememberpassword == "off";
        }

        Header("Location: index.php");
    } else{
        setcookie($cookie_name1, "", time()-86400, "/"); // 86400 = 1 day
        setcookie($cookie_name2, "", time()-86400, "/"); // 86400 = 1 day
        setcookie($cookie_name3, "off", time()-86400, "/"); // 86400 = 1 day
        $wronglogin = "De combinatie van gebruiker en/of wachtwoord is onjuist.";
    }
}

?><!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/studentservices.ico"/>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Inloggen" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">

    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body onload="showSlides(); timeevents();">

<div class="grid-container">

    <div class="itemslider">
        <div class="mySlides fade">
            <img src="/StudentServices/images/9.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/11.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/12.png" class="sliderimage">
        </div>

        <div class="mySlides fade">
            <img src="/StudentServices/images/13.png" class="sliderimage">
        </div>
    </div>

<form id="login" action="inlogPag.php" method="POST"><!-No not verwerklogin-->


    <!--styling is tijdelijk-->
    <div class="container">
        <div style="width:100%">
            <label for='username' style="width:150px">Gebruikersnaam:</label>
            <input type='text' name='username' style="width:150px"
            <?php

            if($rememberpassword == "on")
            {
                echo "value=\"".$_COOKIE["user"]."\"";
            }
            else
            {
                echo '';
            }
            ?>"/>
        </div>
        <div style="width:100%;padding-top: 5px">
            <label style="width:150px">Wachtwoord:</label>
            <input type='password' style="width:150px" name='password'
            <?php
            if($rememberpassword == "on")
            {
                echo "value=\"".$_COOKIE["pw"]."\"";
            }
            else
            {
                echo '';
            }
            ?>"/>
        </div>
        <?php
        echo $wronglogin
        ?>
        <br><br>

        <?php

            echo $rememberpassword;

        ?>

        <input type="checkbox" id="RememberMe" name="RememberMe"
          <?php
            if($rememberpassword == "on")
            {
                echo "checked";
            }
            ?>
         />
        <label>Onthoudt mij</label>
        <br>
        <input type='submit' name='Submit' value='Submit'/>
        <?php
        if ($wronglogin != ""){
            echo "<input type = 'submit' name = 'ikbenmijnwwvergeten' value = 'Wachtwoord vergeten' />";
        }
        ?>

    </div>

</form>

<form id='add' action="View/Gebruiker/Add.php" accept-charset='UTF-8'>
    <div class="container">
        <input type='submit' name='Add' value='Registreren'/>
    </div>
</form>


</body>
</html>
