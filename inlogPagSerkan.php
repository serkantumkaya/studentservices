<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/DB.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");

$wronglogin = "";

//Why on and off? Because it's a checkbox thing.
$rememberpassword = "off";
//for choosing language
if (isset($_POST["language"]) && $_POST["language"] == "EN")
{
    $doRefresh = $_POST["language"] != $_COOKIE["Language"];
    setcookie("Language", "EN", time()+(86400 * 365), "/"); // 86400 = 1 day

    if ($doRefresh) header("Refresh:0");
}
else if (isset($_POST["language"]))
{
    $doRefresh = $_POST["language"] != $_COOKIE["Language"];
    setcookie("Language", "NL", time()+(86400 * 365), "/"); // 86400 = 1 day
    if ($doRefresh) header("Refresh:0");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    if (isset($_POST["chkRememberMe"])
        && $_POST["chkRememberMe"] == "on"){
        $rememberpassword = "on";
    }
    else
    {
        $rememberpassword = "off";
    }
}
//otherwise check if the cookie is present
else
{
    if (isset($_COOKIE["ssrememberme"]) && $_COOKIE["ssrememberme"] == "on")
    {
        $rememberpassword = "on";
    }
}

$username ="";
$password = "";
if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['password'])) $password = $_POST['password'];
$cookie_name1  = "user";
$cookie_name2  = "pw";
$cookie_name3  = "ssrememberme";
$cookie_value3 = $rememberpassword;

if($rememberpassword == "on") {
    setcookie($cookie_name1, $username, time()+(86400 * 365), "/"); // 86400 = 1 day
    setcookie($cookie_name2, $password, time()+(86400 * 365), "/"); // 86400 = 1 day
    setcookie($cookie_name3, "on", time()+(86400 * 365), "/"); // 86400 = 1 day
}
else
{
    setcookie($cookie_name1, "", time()-86400, "/"); // 86400 = 1 day
    setcookie($cookie_name2, "", time()-86400, "/"); // 86400 = 1 day
    setcookie($cookie_name3, "", time()-86400, "/"); // 86400 = 1 day
    $rememberpassword == "off";
}


//Even if you uncheck remember me and tell google to remember your password and user
//the credentials will still be visible. So if you want to test this right.
//Do not let google remember your password.
if (isset($_POST['username']) && $_POST['password'])
{
    $DB       = new ConnectDB();
    //$password   = hash('sha256',$password);//
    $pwsafe    = $DB->MakeSafe($password);
    $GC        = new GebruikerController(-1);
    $Gebruiker = $GC->Validate($username, $pwsafe);

    if ($Gebruiker->getGebruikerID() != -1){
        echo Translate::GetTranslation("inlogPagGoodButNoLogin");
        $_SESSION["GebruikerID"] = $Gebruiker->getGebruikerID();
        $GC    = new GebruikerController($_SESSION['GebruikerID']);
        $_SESSION["level"] = $GC->checkRechten();
       Header("Location: index.php");
    }
    else
    {
        $wronglogin = Translate::GetTranslation("inlogPagLoginIncorrect");
    }
}



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/studentservices.ico"/>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Inloggen" content="index">
    <meta name="author" content="Student Services">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">

    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body onload="showSlides(); timeevents();">

    <form method="post" action="inlogPag.php">
        <button type="submit" name="language" value="NL" class="flaglanguagebutton">
            <img src="/StudentServices/images/NL.png" alt="NL" class="flaglanguage"></button>
        <button type="submit" name="language" value="EN" class="flaglanguagebutton">
            <img src="/StudentServices/images/EN.png" alt="EN" class="flaglanguage"></button>
    </form>

<<<<<<< Updated upstream:inlogPag.php
    <img id="logo" src="/StudentServices/images/logo.png"/>
=======
    <div class="header">

        <img id=
             <a href="index.html"><img id="logo" src="images/logotrans.png"/></a>
    </div>

>>>>>>> Stashed changes:inlogPagSerkan.php
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

<<<<<<< Updated upstream:inlogPag.php



<div class="infologin">
=======
    <div class="info">


    </div>
    <div class="footer">
        <div>© Student Services, 2020
        </div>
    </div>

    <div class="popup" id="test">
        <span class="popuptext" id="myPopup"></span>
    </div>


>>>>>>> Stashed changes:inlogPagSerkan.php

<form id="login" action="inlogPagSerkan.php" method="POST"><!-No not verwerklogin-->


    <!--styling is tijdelijk-->
    <div class="container" >
        <div style="width:100%">
<<<<<<< Updated upstream:inlogPag.php
            <label for='username' style="width:150px"><?php echo Translate::GetTranslation("inlogPagUserNameLabel") ?></label>
            <input type='text' name='username' style="width:150px"
            <?php

            if($rememberpassword == "on" && isset($_COOKIE[$cookie_name1]))
            {
                echo "value=\"".$_COOKIE[$cookie_name1]."\"";
            }
            else
            {
                echo '';
            }
            ?>"/>
=======
            <label for='username' style="width:150px">Gebruikersnaam:</label>
            <input type='text' name='username' style="width:150px;padding-left:50px"/>
>>>>>>> Stashed changes:inlogPagSerkan.php
        </div>

        <div style="width:100%;padding-top: 5px">
<<<<<<< Updated upstream:inlogPag.php
            <label style="width:150px"><?php echo Translate::GetTranslation("inlogPagPasswordLabel") ?></label>
            <input type='password' style="width:150px" name='password'
            <?php
            if($rememberpassword == "on" && isset($_COOKIE[$cookie_name2]))
            {
                echo "value=\"".$_COOKIE[$cookie_name2]."\"";
            }
            else
            {
                echo '';
            }
            ?>"/>
=======
            <label for='password' style="width:150px">Wachtwoord:</label>
            <input type='password' style="width:150px;padding-left:15px" name='password'/>
>>>>>>> Stashed changes:inlogPagSerkan.php
        </div>
        <?php
        echo $wronglogin
        ?>
<<<<<<< Updated upstream:inlogPag.php
        <br><br>

        <input type="checkbox" id="chkRememberMe" name="chkRememberMe"
          <?php
            if($rememberpassword == "on")
            {
                echo "checked";
            }
            ?>
         />
        <label><?php echo Translate::GetTranslation("inlogPagRememberMe")?></label>
=======

        <div style="font-size: x-small"> <input type="checkbox" style="width: 78px;" id="remember_me" name="_remember_me" checked/>
        <label for="remember_me">Onthoud mij (werkt nog niet)</label><br>
>>>>>>> Stashed changes:inlogPagSerkan.php
        <br>
        <input type='submit' name='Submit' value='<?php echo Translate::GetTranslation("inlogSubmit") ?>'/>
        <?php
        if ($wronglogin != ""){
            echo "<input type = 'submit' name = 'ikbenmijnwwvergeten' value ='".
            Translate::GetTranslation("inlogPagForgotPassword")."'/>";
        }
        ?>
        </div>

    </div>

</form>

<form id='add' action="View/Gebruiker/Add.php" accept-charset='UTF-8'>
<<<<<<< Updated upstream:inlogPag.php
    <div class="container">
        <input type='submit' name='Add' value='<?php echo Translate::GetTranslation("inlogRegister") ?>'/>
=======
    <div class="container-register">
        <label for='submit'> Nog geen account ?</label>
        <input type='submit' name='Add' value='Registreren'/>

>>>>>>> Stashed changes:inlogPagSerkan.php
    </div>
</form>

</div>

</body>
</html>
<?php

    ?>