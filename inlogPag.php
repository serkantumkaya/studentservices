<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Services</title>
    <meta name="Toevoegen school" content="index">
    <meta name="author" content="The big 5">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--The viewport is the user's visible area of a web page.-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/StudentServices/css/style.css">

    <script type="text/javascript" src="/StudentServices/JS/script.js">
        // Get the modal VERHUIZEN NAAR JS
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>

</head>

<body>

<form id='login' action=verwerkLogin.php method='POST' accept-charset='UTF-8' class="modal-content animate">

    <div class="container">
        <label for='username' class="loginlabel">UserName:</label>
        <input type='text' name='username' id='username' class="logininput" />
        <BR>
        <label for='password' class="loginlabel">Password:</label>
        <input type='password' name='password' id='password' class="logininput"/>
        <br><br>
        <input type='submit' name='Submit' value='Submit' />
    </div>

</form>

<form id='login' action=View/Gebruiker/AddLogin.php accept-charset='UTF-8' class="modal-content animate">
    <div class="container">
      <input type='submit' name='Submit' value='Registreren' />
    </div>
</form>

</body>
</html>

