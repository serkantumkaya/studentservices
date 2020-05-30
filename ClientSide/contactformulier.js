/*******************************************************************************************************************************
 * @author Dirk van der Vliet
 * @datum 16-10-2019
 * @description dit is de javascript file voor de controle van de invoer op de contactpagina
 * en het verder verwerken van de gegeven naar een json and e-mail
 * @revisions
 * V1.1 het maken van de eerste versie
 * V1.2 miste de de juiste werking van de checkboxen actie erop is toevoegen van de check
 */




function validateForm() {
    document.getElementById("error1").innerHTML = "";
    document.getElementById("error3").innerHTML = "";
    document.getElementById("error6").innerHTML = "";
    document.getElementById("error6b").innerHTML = "";
    document.getElementById("error7").innerHTML = "";
    document.getElementById("error10").innerHTML = "";
    document.getElementById("error11").innerHTML = "";
    if (document.forms["contactform"]["firstname"].value === "") {
        document.getElementById("error1").innerHTML = "De voornaam is niet ingevuld.<br>"
    }

    if (document.forms["contactform"]["lastname"].value === "") {
        document.getElementById("error3").innerHTML += "De achternaam is niet ingevuld.<br>"
    }

    if (document.forms["contactform"]["E-mailadres"].value === "") {
        document.getElementById("error7").innerHTML += "Het emailadres is niet ingevuld.<br>"
    }

    if (document.forms["contactform"]["E-mailadres"].value != document.forms["contactform"]["E-mailadres2"].value) {
        document.getElementById("error6b").innerHTML += "De emailadressen zijn ongelijk.<br>"
    }


    if (document.forms["contactform"]["telefoonnummer"].value === "") {
        document.getElementById("error10").innerHTML += "telefoonnummer niet ingevuld.<br>"
    }

    if (document.forms["contactform"]["telefoonnummer"].value.length !== 10) {
        document.getElementById("error10").innerHTML += "telefoonnummer niet correct ingevuld.<br>"
    }

    if (document.forms["contactform"]["subject"].value === "") {
        document.getElementById("error11").innerHTML += "Het opmerkingen veld moet ook nog ingevuld worden.<br>"

    }
    if (document.forms["contactform"]["telefoonnummer"].value === "") {
        document.getElementById("error10").innerHTML += "telefoonnummer niet ingevuld.<br>"
    }


    if (!(/^0[0-9]{9}$/i.test(document.forms["contactform"]["telefoonnummer"].value))){
        document.getElementById("error10").innerHTML += "ongeldig telefoonnummer.<br>"
    }

    if (validateEmail(document.forms["contactform"]["E-mailadres"].value) === false) {
        document.getElementById("error6").innerHTML += "Het emailadres is niet juist.<br>"
    }

    return !(document.getElementById("error1").innerHTML.length > 0 ||
        document.getElementById("error3").innerHTML.length > 0 ||
        document.getElementById("error7").innerHTML.length > 0 ||
        document.getElementById("error10").innerHTML.length > 0 ||
        document.getElementById("error11").innerHTML.length > 0 ||
        document.getElementById("error6").innerHTML.length > 0 ||
        document.getElementById("error6b").innerHTML.length > 0);
}


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


// dit deel van de code is voor het bijhouden van de stand checkboxes
function timeevents() { //plaats hier de fucnties die met iedere 100ms moeten worden uitgevoerd
    setTimeout(timeevents, 100); //iedere 100ms de functie opnieuw uitvoeren wordt voor de eerste keer aangeroepen bij document.ready
    // checkboxstatus();
    console.log("test");
}


var oldbittel = false;
var oldbitmail = false;

function checkboxstatus() { //voor het selecteren van de checkbox zorgt ervoor dat er maar een tegelijk true kan zijn.
    var checkboxemail = document.getElementById("email");
    var checkboxtel = document.getElementById("tele");
    var cm = checkboxemail.checked;
    var ct = checkboxtel.checked;
    if (cm === true && ct === false) {
        oldbitmail = true;
    }
    if (cm === true && ct === true) {
        if (oldbitmail === true) {
            oldbitmail = false;
            oldbittel = true;
            checkboxemail.checked = false;
        } else {
            oldbittel = true;
            oldbitmail = false;
            checkboxtel.checked = false;
        }
    }
    if (cm === false && ct === true) {
        oldbittel = true;
    }
}




