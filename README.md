TODO:

Projecten.php moet de baseclasse nog worden gemaakt. 


functies schrijven op de volgende manier, eerst kleine letter, eerstvolgende woord grote letter.
dus: 
function ditIsEenFunctie(){

}
en niet:

function DITisEENfunctie(){}
of welke andere vorm dan ook. 
dit staat nog niet overal goed. kom je ergens een fout tegen? verbeter het (zie in ProfielModel.php de functie GetProfielen(), deze staat fout)


Het model: deze regelt dat de gegevens uit de database wordt gehaald
alleen uit de databse, het koppelen aan de baseclasse doet de controller.

voor de volgende moet de Model worden gemaakt:
Categorie
welke functies minimaal:
	
construct 
getCategorieen() -> dit is voor meervoud, dus alle categorieen
add()
delete()
update()
get() -> dit is voor één categorie. 

ook moet ProjectModel.php nog worden gedaan
welke functies minimaal: 
construct 
getProjecten() -> dit is voor meervoud, dus alle categorieen
add()
delete()
update()
get() -> dit is voor één categorie. 


ook moeten er voor deze controllers worden gebouwd.
hiervoor geld dat de schoolcontroller de lijdende draad is. 
bouw de functies dus ook na zoals in de controller

in de vieuw kan je bepalen wat je wilt gaan zien om te testen. 
Tip: bouw alle functies een voor een. dus: eerst alle getProjecten() functies door het MVC model heen
dan kan je die testen, en doorgaan naar de add, dan de delete enzovoorts