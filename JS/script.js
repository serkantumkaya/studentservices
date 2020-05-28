$(document ).ready(function() {
    showSlides();
    showpopup();
});

var slideIndex = -1; //standaard geen slides selecteren
var blockbit  = false;

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides"); //get alle slides
    if(($(".mySlides")[0]) !== undefined){
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  //standaard verbergen

        }
        slideIndex++;
        if (slideIndex >= slides.length) //als de teller hoger of gelijk is aan het aantal slides n+1, dan terug naar 0
        {
            slideIndex = 0
        }
        slides[slideIndex].style._width = '100%';
        slides[slideIndex].style.display = "block"; //1 tonen die aan de beurt is.
        // slides[i].style.width = '100%';
        setTimeout(showSlides, 5000); // elke 10 sec wisselen
    }
}

function GetSchool() {

    var elmnt = document.getElementById("<?php echo $focus ?>");
    if (elmnt != null) {
        elmnt.style.backgroundColor = 'green';//nu keihard een kleur mooier is om hiet een css .Newrecord {} van te maken
        elmnt.scrollIntoView();
    }
}


var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



function showpopup() {
    //console.log("test");

    var queryString = window.location.href;
    var readdata = new URL(queryString);
    if(!(readdata.searchParams.get('action') == "failed") ^ (readdata.searchParams.get('action') == "succes")){
//TODO:        document.getElementById("test").style.margin = "0";
       // console.log((readdata.searchParams.get('action') == "failed") ^ (readdata.searchParams.get('action') == "succes"));
    }
    //console.log(readdata.searchParams.get('action'));
    if(readdata.searchParams.get('action') === "succes"){
        var popup = document.getElementById("myPopup");
        document.getElementById("myPopup").innerHTML = readdata.searchParams.get('content');
        document.getElementById("myPopup").style.backgroundColor = "green";
        popup.classList.toggle("show");
    }
    if(readdata.searchParams.get('action') === "failed"){
        var popup = document.getElementById("myPopup");
        document.getElementById("myPopup").innerHTML = readdata.searchParams.get('content');
        document.getElementById("myPopup").style.backgroundColor = "red";
        popup.classList.toggle("show");
    }
    if(!blockbit) {
        setTimeout(showpopup, 5000);
        blockbit = true;


    }
    else{
     //TODO:   document.getElementById("test").style.margin = "0";
    }
}

function validate(phone) {
    var regex = /^\+(?:[0-9] ?){6,14}[0-9]$/;

    if (regex.test(phone)) {
        return true;
    } else {
        return false;
    }
}

function is_nlZipCode(str)
{
    regexp = /^([0-9]{4}[ ]+[a-zA-Z]{2})$/;

    if (regexp.test(str))
    {
        return true;
    }
    else
    {
        return false;
    }
}


function isValidDate(dateString)
{
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};





