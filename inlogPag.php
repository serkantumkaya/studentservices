<?php
session_start();
error_reporting(E_ALL);//todo :weghalen
ini_set('display_errors',1);//todo :weghalen
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/DB.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/Translate/Translate.php");
$wronglogin = "";

//Why on and off? Because it's a checkbox thing.
$rememberpassword = "off";
//for choosing language
if (isset($_POST["language"]) && $_POST["language"] == "EN"){
    $doRefresh = $_POST["language"] != $_COOKIE["Language"];
    setcookie("Language","EN",time()+(86400*365),"/"); // 86400 = 1 day

    if ($doRefresh){
        header("Refresh:0");
    }
} else{
    if (isset($_POST["language"])){
        $doRefresh = $_POST["language"] != $_COOKIE["Language"];
        setcookie("Language","NL",time()+(86400*365),"/"); // 86400 = 1 day
        if ($doRefresh){
            header("Refresh:0");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (isset($_POST["chkRememberMe"])
        && $_POST["chkRememberMe"] == "on"){
        $rememberpassword = "on";
    } else{
        $rememberpassword = "off";
    }
} //otherwise check if the cookie is present
else{
    if (isset($_COOKIE["ssrememberme"]) && $_COOKIE["ssrememberme"] == "on"){
        $rememberpassword = "on";
    }
}

$username = "";
$password = "";
if (isset($_POST['username'])){
    $username = $_POST['username'];
}
if (isset($_POST['password'])){
    $password = $_POST['password'];
}
$cookie_name1 = "user";
$cookie_name2 = "pw";
$cookie_name3 = "ssrememberme";
$cookie_value3 = $rememberpassword;

if ($rememberpassword == "on"){
    setcookie($cookie_name1,$username,time()+(86400*365),"/"); // 86400 = 1 day
    setcookie($cookie_name2,$password,time()+(86400*365),"/"); // 86400 = 1 day
    setcookie($cookie_name3,"on",time()+(86400*365),"/"); // 86400 = 1 day
} else{
    setcookie($cookie_name1,"",time()-86400,"/"); // 86400 = 1 day
    setcookie($cookie_name2,"",time()-86400,"/"); // 86400 = 1 day
    setcookie($cookie_name3,"",time()-86400,"/"); // 86400 = 1 day
    $rememberpassword == "off";
}
//Even if you uncheck remember me and tell google to remember your password and user
//the credentials will still be visible. So if you want to test this right.
//Do not let google remember your password.

if (isset($_POST['username']) && $_POST['password']){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $DB = new ConnectDB();
    //$password   = hash('sha256',$password);//
    $pwsafe    = $DB->MakeSafe($password);
    $GC        = new GebruikerController(-1);
    $Gebruiker = $GC->Validate($username,$pwsafe);

    if ($Gebruiker->getGebruikerID() != -1){

        $_SESSION["GebruikerID"] = $Gebruiker->getGebruikerID();
        $GC                      = new GebruikerController($_SESSION['GebruikerID']);
        $_SESSION["level"]       = $GC->checkRechten();

        //$_SESSION["Gebruiker"] = $Gebruiker;
        header("Location: index.php");
    } else{
        $wronglogin = "De combinatie van gebruiker en/of wachtwoord is onjuist.";
    }
}

if(isset($_POST['Email']) && !empty($_POST['Email']) && filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)){
    //   var_dump($_POST['Email']);
    $status ="";
    $response ="";
    $gebruikerscontroller = new GebruikerController(-1);
    $gebruikers = $gebruikerscontroller->getGebruikers();
    foreach($gebruikers as $gebruiker){
        if($gebruiker->getEmail() == $_POST["Email"]){
            $randomnumber = rand(111111111111, 999999999999);
            if($gebruikerscontroller->getmail()->sendWachwoordreset($gebruiker->getGebruikersnaam(), $gebruiker->getEmail(), $randomnumber)){
                $gebruiker->setWachtwoord($randomnumber);
                $gebruikerscontroller->updateWachtwoord($gebruiker);
                $status   = "succes";
                $response = "Wachtwoord herstel Email is verstuurd";
                header("Location: /StudentServices/inlogPag.php?action=". $status. "&content=". $response);
                break;
            }
            else{
                $status   = "failed";
                $response = "Wachtwoord herstel Email versturen mislukt";
                header("Location: /StudentServices/inlogPag.php?action=". $status. "&content=". $response);
                break;
            }
        }
    }
    $_POST['Email'] = "";

}
else{
    if(isset($_POST['Email'])){
        $status   = "failed";
        $response = "Email adres is niet in gebruik";
        $_POST['Email'] = "";
        header("Location: /StudentServices/inlogPag.php?action=". $status. "&content=". $response);
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
    <script type="text/javascript" src="/StudentServices/JS/bevestigenaccount.js">
    </script>
    <script type="text/javascript" src="/StudentServices/JS/script.js">
    </script>
</head>
<body onload="showSlides();">


<div class="inlogpag">
    <div class="header">
        <form method="post" action="inlogPag.php">
            <button type="submit" name="language" value="NL" class="flaglanguagebutton">
                <img src="/StudentServices/images/NL.png" alt="NL" class="flaglanguage"></button>
            <button type="submit" name="language" value="EN" class="flaglanguagebutton">
                <img src="/StudentServices/images/EN.png" alt="EN" class="flaglanguage"></button>
        </form>
        <img id=
             <a href="index.html"><img id="logo" src="images/logotrans.png"/></a>
    </div>
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


    <div class="login">
        <form id="login" action="inlogPag.php" method="POST"><!-No not verwerklogin-->

            <!--styling is tijdelijk-->
            <div class="container">
                <div style="width:100%">
                    <label for='username'
                           style="width:150px"><?php echo Translate::GetTranslation("inlogPagUserNameLabel") ?></label>
                    <input type='text' name='username' style="width:150px;padding-left:50px"
                    <?php

                    if ($rememberpassword == "on" && isset($_COOKIE[$cookie_name1])){
                        echo "value=\"" . $_COOKIE[$cookie_name1] . "\"";
                    } else{
                        echo '';
                    }
                    ?>"/>
                </div>

                <div style="width:100%;padding-top: 5px">
                    <label for='password'
                           style="width:150px"><?php echo Translate::GetTranslation("inlogPagPasswordLabel") ?></label>
                    <input type='password' style="width:150px;padding-left:15px" name='password'
                    <?php
                    if ($rememberpassword == "on" && isset($_COOKIE[$cookie_name2])){
                        echo "value=\"" . $_COOKIE[$cookie_name2] . "\"";
                    } else{
                        echo '';
                    }
                    ?>"/>
                </div>
                <?php
                echo $wronglogin
                ?>
                <br><br>


                <input type="checkbox" id="chkRememberMe" name="chkRememberMe"
                    <?php
                    if ($rememberpassword == "on"){
                        echo "checked";
                    }
                    ?>
                />
                <label><?php echo Translate::GetTranslation("inlogPagRememberMe") ?></label>
                <br>
                <input type='submit' name='Submit' value='Submit'/>
                <?php
                if ($wronglogin != ""){
                    echo "<a href='?action=resetpassword'>reset password</a>";
                }
                ?>


            </div>
        </form>
    </div>
    <div class="popup" id="test">
        <span class="popuptext" id="myPopup"></span>
    </div>
    <div>
        <?php
        if (filter_input(INPUT_GET,'action') == "resetpassword"){
            ?>
            <div id="reset_password">
                <form action="" method="post">
                    <div><label for="Email">Vul hier het Email adress in wat aan je account gekoppeld zit.<br> U krijgt
                            een mail toegestuurd met wachtwoord reset link</label></div>
                    <div><input type="text" id="Email" name="Email" placeholder="Vul hier je Email in"></div>
                    <div><input onclick="resetpassword()" id="Submit" type="submit" value="Send Email"></div>
                </form>
            </div>
            <?php
        }
        ?>
    </div>

    <form id='add' action="View/Gebruiker/Add.php" accept-charset='UTF-8'>
        <div class="container-register">
            <label for='submit'> Nog geen account ?</label>
            <input type='submit' name='Add' value='Registreren'/>

        </div>
    </form>

    <div class="footer">
        <div>© Student Services, 2020
        </div>
    </div>
</div>
</body>
</html>
