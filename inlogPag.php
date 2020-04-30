<!DOCTYPE html>
<head>

</head>
<body style='text-align:center;margin-top:20px'>

<form id='login' action=verwerkLogin.php method='GET' accept-charset='UTF-8'>
    <fieldset >
        <legend>Login</legend>
        <input type='hidden' name='submitted' id='submitted' value='1'/>

        <label for='username' >UserName*:</label>
        <input type='text' name='username' id='username' />

        <label for='password' >Password*:</label>
        <input type='password' name='password' id='password'/>

        <input type='submit' name='Submit' value='Submit' />

    </fieldset>
</form>

</body>

