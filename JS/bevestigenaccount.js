window.onload = vertifyemaillink;

function vertifyemaillink() {
    var queryString = window.location.href;
    var vertifycode = (queryString.substr((queryString.indexOf('?')), (queryString.indexOf('&') - queryString.indexOf('?')))).split("?");
    var readdata = new URL(queryString);
    var username = readdata.searchParams.get('username');
    var email = readdata.searchParams.get('email');
    //console.log(vertifycode);
    //console.log(email);
    //console.log(username);
    $.ajax({
        url: '/StudentServices/Controller/RequestbevestigaccountController.php',
        method: 'POST',
        dataType: 'json',
        data: {
            vertifycode: vertifycode,
            email: email,
            username: username
        }, success: function (response) {
            if(!(response === undefined || response == null)){
                if (response.status == "success") {
                    console.log(response["response"]);
                    window.location.href = "http://localhost/StudentServices/inlogPag.php?action=succes&content=" + response["response"];
                } else {
                    console.log(response["response"]);
                    window.location.href = "http://localhost/StudentServices/View/Gebruiker/Add.php?action=failed&content=" + response["response"];
                }
            }
        }
    });
}

//window.onload = resetwachtwoordlink;

function resetwachtwoordlink() {
    console.log("test");
    /*var queryString = window.location.href;
    var vertifycode = (queryString.substr((queryString.indexOf('?')), (queryString.indexOf('&') - queryString.indexOf('?')))).split("?");
    var readdata = new URL(queryString);
    var username = readdata.searchParams.get('username');
    var email = readdata.searchParams.get('email');
    $.ajax({
        url: '/StudentServices/Controller/RequestbevestigaccountController.php',
        method: 'POST',
        dataType: 'json',
        data: {
            vertifycode: vertifycode,
            email: email,
            username: username
        }, success: function (response) {
            if(!(response === undefined || response == null)){
                if (response.status == "success") {
                    console.log(response["response"]);
                    window.location.href = "http://localhost/StudentServices/inlogPag.php?action=succes&content=" + response["response"];
                } else {
                    console.log(response["response"]);
                    window.location.href = "http://localhost/StudentServices/View/Gebruiker/Add.php?action=failed&content=" + response["response"];
                }
            }
        }
    });*/
}
