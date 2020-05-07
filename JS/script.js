$(document ).ready(function() {
    showSlides();
});

var slideIndex = -1; //standaard geen slides selecteren

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
    slides[slideIndex].style.display = "block"; //1 tonen die aan de beurt is.
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