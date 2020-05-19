$(document ).ready(function() {
    showSlides();
    showpopup();
});

var slideIndex = -1; //standaard geen slides selecteren
var blockbit  = false;

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides"); //get alle slides

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  //standaard verbergen
    }
    slideIndex++;
    if (slideIndex >= slides.length) //als de teller hoger of gelijk is aan het aantal slides n+1, dan terug naar 0
    {
        slideIndex = 0
    }
   // slides[slideIndex].style.display = "block"; //1 tonen die aan de beurt is.
    setTimeout(showSlides, 10000); // elke 10 sec wisselen
}

function GetSchool() {

    var elmnt = document.getElementById("<?php echo $focus ?>");
    if (elmnt != null) {
        elmnt.style.backgroundColor = 'green';//nu keihard een kleur mooier is om hiet een css .Newrecord {} van te maken
        elmnt.scrollIntoView();
    }
}

function checkGebruikerInput()
{


}

var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



function showpopup() {

    var queryString = window.location.href;
    var readdata = new URL(queryString);
    if(!(readdata.searchParams.get('action') == "failed") ^ (readdata.searchParams.get('action') == "succes")){
        document.getElementById("test").style.margin = "0";
       // console.log((readdata.searchParams.get('action') == "failed") ^ (readdata.searchParams.get('action') == "succes"));
    }
    if(readdata.searchParams.get('action') == "succes"){
        var popup = document.getElementById("myPopup");
        document.getElementById("myPopup").innerHTML = readdata.searchParams.get('content');
        document.getElementById("myPopup").style.backgroundColor = "green";
        popup.classList.toggle("show");
    }
    if(readdata.searchParams.get('action') == "failed"){
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
        document.getElementById("test").style.margin = "0";
    }
}


