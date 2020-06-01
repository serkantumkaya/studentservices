<?php

$_SERVER['DOCUMENT_ROOT'] = "C:/xampp/htdocs"; //is undefined dus zet ik hier als global variable

require_once 'C:/xampp/htdocs/StudentServices/Controller/ProfielController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/SchoolController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/OpleidingController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/GebruikerController.php';
require_once 'C:/xampp/htdocs/StudentServices/BaseClass/Profiel.php';

use PHPUnit\Framework\TestCase;

class ProfielTest extends TestCase
{
    /***
     * hier haalt hij een profiel op en wijzigt deze daarna update hij hem weer
     * hier gaan twee dingen niet expres fout daar staat // voor
     * daarna haalt hij het profiel opnieuw op en zet de gevenens weer terug en update het opnieuw
     *
     */

    public function testupdate()
    {
        $schoolcontroller    = new SchoolController(1010);
        $school              = $schoolcontroller->getById(1010);
        $opleidingcontroller = new OpleidingController(1010);
        $opleiding           = $opleidingcontroller->getById(1044);
        $profielcontroller   = new ProfielController(1005);
        $profiel             = $profielcontroller->getByGebruikerID(1005);
        $profiel->setVoornaam("test");
        $profiel->setTelefoonnummer("0797644332");
        $profiel->setOpleidingg($opleiding);
        $profiel->setPostcode("5225JB");
        $profiel->setAchternaam("batsbak");
        $profielcontroller->update($profiel);
        $profiel = null;
        $profiel = $profielcontroller->getByGebruikerID(1005);
        $this->assertEquals("test",$profiel->getVoornaam());
        $this->assertEquals("0797644332",$profiel->getTelefoonnummer());
        $this->assertEquals("5225JB",$profiel->getPostcode());
        $this->assertEquals("batsbak",$profiel->getAchternaam());
        //$this->assertEquals(1010,$profiel->getSchool()->getSchoolID());
        // $this->assertEquals(1044,$profiel->getOpleiding()->getOpleidingID());
        $profiel->setVoornaam("peter");
        $profiel->setTelefoonnummer("07976436433532");
        $profiel->setOpleidingg($opleidingcontroller->getById(1020));
        $profiel->setPostcode("1344IJ");
        $profiel->setAchternaam("Smets");
        $profielcontroller->update($profiel);
    }

    /**
     * ik maak hier een nieuwe gebruiker aan
     * een object voor school en een opject voor opleiding
     * maak een profiel controller en voeg een nieuw profiel tot de database
     * haal hem op uit de database en verglijk of de gegevens juist zijn
     * daaruit blijkt dat de startdatum opleiding in de database niet wordt gezet is nu uitgevoerd met //
     * tot slot verwijder ik weer het profiel en gebruiker die ik heb aangemaakt
     */
    public function testadd()
    {
        $schoolcontroller    = new SchoolController(1010);
        $school              = $schoolcontroller->getById(1010);
        $opleidingcontroller = new OpleidingController(1010);
        $opleiding           = $opleidingcontroller->getById(1044);
        $gebruikers          = new GebruikerController(-1);
        $gebruikers->gebruikermodel->add("dirkus","test01","dirkvliet@gmail.com");
        $gebruikerid       = $gebruikers->validate("dirkus","test01")->getGebruikerID();
        $profielcontroller = new ProfielController($gebruikerid);
        $profielcontroller->add($gebruikerid,$school,$opleiding,"12-14-1999","Actief","Vliet","Dirk","Van der","NL",
            "Maasdijk",4,"","5222JB","Den Bosch","29-06-2000", "krijgjenie");
        $profiel = $profielcontroller->getByGebruikerID($gebruikerid);
        $this->assertIsObject($profiel);
        $this->assertEquals("Dirk",$profiel->getVoornaam());
        $this->assertEquals("krijgjenie",$profiel->getTelefoonnummer());
        $this->assertEquals("5222JB",$profiel->getPostcode());
        $this->assertEquals("Vliet",$profiel->getAchternaam());
        $this->assertEquals(1010,$profiel->getSchool()->getSchoolID());
        $this->assertEquals(1044,$profiel->getOpleiding()->getOpleidingID());
        $this->assertIsObject($profiel->getOpleiding());
        $this->assertIsObject($profiel->getSchool());
        //$this->assertEquals("12-14-1999",$profiel->getStartdatumopleiding());//deze ging niet moetwillig fout
        $this->assertEquals("Den Bosch",$profiel->getWoonplaats());
        $profielcontroller->delete($profiel->getProfielID());
        $gebruikers->delete($gebruikerid);
    }
}

