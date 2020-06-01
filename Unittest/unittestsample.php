<?php

use PHPUnit\Framework\TestCase;

require_once('vendor/autoload.php');

require_once ("Model/SchoolModel.php");
require_once ("BaseClass/School.php");
require_once ("Controller/SchoolController.php");
require_once ("Includes/DB.php");

class unittestsample extends TestCase
{
    /**
     * We controleren hier of de functie GetTranslation werkt zoals we het verwachten.
     * We hebben een key die een bepaalde waarde moet teruggeven. We verwachten Gebruikersnaam terug.     *
     */
    public function testTextInlogPagUserNameLabelNL(){
        $res = Translate::GetTranslation("inlogPagUserNameLabel");
        $this->assertEquals("Gebruikersnaam:", $res);
    }

    public function testFeedback(){
        $this->assertClassHasAttribute('Review',Feedback::class);
    }

    public function testNewSchool()   {
        $School = new School(1,"EenSchool");
        $this->assertNotNull($School);
    }

    /**
     * In de volgende test controleren we of de class Reactie alle atributen heeft die we in de DB hebben ingevoerd.
     * Dit zijn: ReactieID, GebruikerID, ProjectID, Timestamp en Reactie.
     */
    public function testHeeftReactieAtribuutReactieID(){
        $this->assertClassHasAttribute('ReactieID',Reactie::class);
        $this->assertClassHasAttribute('GebruikerID',Reactie::class);
        $this->assertClassHasAttribute('ProjectID',Reactie::class);
        $this->assertClassHasAttribute('Timestamp',Reactie::class);
        $this->assertClassHasAttribute('Reactie',Reactie::class);

    }

    public function testNewOpleiding()   {
        $Opleiding = new Opleiding(1, "Unittesten", "Voltijd");
        $this->assertNotNull($Opleiding);
    }

    /**
     * Als we een array aanmaken, dan verwacthen we ook een array.
     */
    public function testIsReactielijstEenArray(){
      $Reactielijst = array();
      $this->assertIsArray($Reactielijst);
    }

    /**
     * We controleren of de map Controller leesbaar is.
     */
    public function testMapLocatieLeesbaar()
    {
        $this->assertDirectoryIsReadable('C:xampp/htdocs/StudentServices/Controller');
    }

    public function testGetSchool(){
        $sc = new SchoolController();
        $school = $sc->getById(1000);
        $this->assertNotNull($school);
    }

    /***
     * hier wordt het de baseclass gebruiker getest dit doen we door eerst een nieuw object gebruiker te maken
     * daarna halen we de gegevens weer op en verglijken ze met de gegevens die we er in hebben gepusht
     *
     */

    public function testConstructbaseclass()
    {
        $gebruiker = new Gebruiker(1002,"Dirk","AVANS_HOGESCHOOL","Dirk353@outlook.com");

        $this->assertEquals("Dirk",$gebruiker->getGebruikersnaam());
        $this->assertEquals(1002,$gebruiker->getGebruikerID());
        $this->assertEquals("Dirk353@outlook.com",$gebruiker->getEmail());
        $this->assertEquals("AVANS_HOGESCHOOL",$gebruiker->getWachtwoord());
    }

    /**
     * hier wordt weer de baseclass van de gerbruiker getest hier doen we het update gedeelte van de baseclass testen
     * we maken een nieuw object van gebruiker
     * daarna gaan we verschillende gegevens updaten
     * daarna halen we ze op en kijken of ze succesvol veranderd zijn
     * hier laat ik er 1 moetwillig fout gaan test3
     */

    public function testUpdategebruiker()
    {
        $gebruiker = new Gebruiker(1002,"Dirk","AVANS_HOGESCHOOL","Dirk353@outlook.com");
        $gebruiker->setGebruikerID(1005);
        $gebruiker->setWachtwoord("isnuveranderd");
        $gebruiker->setGebruikersnaam("dirk van der vliet");
        $gebruiker->setEmail("dirkvliet1@student.avans.nl");

        $this->assertEquals(1005,$gebruiker->getGebruikerID());
        $this->assertEquals("dirkvliet1@student.avans.nl",$gebruiker->getEmail());
        $this->assertEquals("dirkpirkiepollepel",
            $gebruiker->getWachtwoord());// deze laat ik falen hij verwacht hij = "isnuveranderd"
        $this->assertEquals("dirk van der vliet",$gebruiker->getGebruikersnaam());
    }

    /**
     * wat we hier doen is het testen van de gebruiker we maken een nieuwe gebruiker aan
     * daarna halen we de naam op die controleren we of die overeen komt met wat er in gestopt hebben
     * kijken we of we een object terug krijgen als we de inlog fucntie uitvoeren
     * checken we of de gebruikers object ook de mail object heeft;
     * daarna kijken we of de gebruiker de rechten krijgt als een normale gebruiker
     * we halen een complete gebruiker op doormiddels van validate
     * we veranderd de gebruikers naam en updaten hem.
     * daarna kijken we of we de inlog fucntie nog kunnen uitvoeren
     * en als laatst deleten we de gebruiker want anders geef een error als hem voor de tweede keer uitvoert,
     * want dan bestaat de gebruiker al.
     */

    public function testToevoegengebrTODB()
    {
        $gebruikers = new GebruikerController(-1);
        $gebruikers->gebruikermodel->add("dirkus","test01","dirkvliet@gmail.com");
        $this->assertEquals("dirkus",$gebruikers->gebruikermodel->getByGebruikersNaam("dirkus")["Gebruikersnaam"]);
        $this->assertIsObject($gebruikers->validate("dirkus","test01"));
        $this->assertIsObject($gebruikers->getmail());
        $gebruikerid = $gebruikers->validate("dirkus","test01")->getGebruikerID();
        $gebruikers  = new GebruikerController($gebruikerid);
        $this->assertEquals(1,$gebruikers->checkRechten());
        $gebruiker = $gebruikers->validate("dirkus","test01");
        $gebruiker->setEmail("dirk353@outlook.com");
        $gebruiker->setGebruikersnaam("peterlimonade");
        $gebruikers->update($gebruiker);
        $this->assertIsObject($gebruikers->validate("peterlimonade","test01"));
        $gebruikers->delete($gebruikerid);
    }

    /**
     * we maken hier een gebruiker controller aan
     * daarna kijken we of de functie add van de gebruikerscontroller errors terug geeft bij een verschil tussen ww en wwcheck
     * dan kijken we of hij errors terug geeft bij een onjuist email adress
     * volgende test is of hij reageert op een niet ingevulde gebruikersnaam
     * daarna maakt hij een gebruiker aan
     * daarna haalt hij het gebruiker object op
     * veranderd email
     * update de gebruiker kijk of er geen errors terug komen
     * zet de gebruikersnaam naar leeg
     * kijk of er errors terug komen
     * set de gebruikernaam terug naar dirkus
     * kijk of je het gebruikerobject leeg is
     * verwijder daarna de gebruiker
     */

    public function testcontrolesaddupdate()
    {
        $gebruikers = new GebruikerController(-1);
        $this->assertNotEmpty($gebruikers->add("dirkus","test01", "test1","dirkvliet@gmail.com"));
        $this->assertNotEmpty($gebruikers->add("dirkus","test01", "test01","dirkvlietgmail.com"));
        $this->assertNotEmpty($gebruikers->add("","test1", "test1","dirkvliet@gmail.com"));
        $this->assertNotEmpty($gebruikers->add("dirkus","test01", "test01","dirkvliet@gmail.com"));
        $gebruiker = $gebruikers->validate("dirkus","test01");
        $gebruiker->setEmail("dirk353@outlook.com");
        $this->assertNotEmpty($gebruikers->update($gebruiker)); //???????
        $gebruiker->setGebruikersnaam("");
        $this->assertNotEmpty($gebruikers->update($gebruiker));
        $gebruiker->setGebruikersnaam("dirkus");
        $this->assertNotEmpty($gebruikers->validate("dirkus","test01"));
        $gebruikerid = $gebruikers->validate("dirkus","test01")->getGebruikerID();
        $gebruikers->delete($gebruikerid);
    }

    /***
     * hier wordt het de baseclass gebruiker getest dit doen we door eerst een nieuw object gebruiker te maken
     * daarna halen we de gegevens weer op en verglijken ze met de gegevens die we er in hebben gepusht
     *
     */

    public function testConstructbaseclassProject()
    {
        $project = new Project(1040,1002,"ik ben aan unittesten","Vragen",
            "ik ben de unitesten aan het maken maar moet er nog veel te veel kun je er ook wat voor mijn doen??",3,
            "2020-6-1 00:33:00","2020-6-1 23:59:59","Mee bezig","Den Bosch",0);

        $this->assertEquals(1002,$project->getGebruikerID());
        $this->assertEquals(1040,$project->getProjectID());
        $this->assertEquals("ik ben aan unittesten",$project->getTitel());
        $this->assertEquals("ik ben de unitesten aan het maken maar moet er nog veel te veel kun je er ook wat voor mijn doen??",
            $project->getBeschrijving());
        $this->assertEquals("2020-6-1 00:33:00",$project->getDatumaangemaakt());
        $this->assertEquals("2020-6-1 23:59:59",$project->getDeadline());
        $this->assertEquals("Mee bezig",$project->getStatus());
        $this->assertEquals("Den Bosch",$project->getLocatie());
    }

    /**
     * hier wordt weer de baseclass van de gerbruiker getest hier doen we het update gedeelte van de baseclass testen
     * we maken een nieuw object van gebruiker
     * daarna gaan we verschillende gegevens updaten
     * daarna halen we ze op en kijken of ze succesvol veranderd zijn
     * hier laat ik er 1 moetwillig fout gaan test6
     */

    public function testUpdateproject()
    {
        $project = new Project(1040,1002,"ik ben aan unittesten","Vragen",
            "ik ben de unitesten aan het maken maar moet er nog veel te veel kun je er ook wat voor mijn doen??",3,
            "2020-6-1 00:33:00","2020-6-1 23:59:59","Mee bezig","Den Bosch",0);
        $project->setGebruikerID(1005);
        $project->setProjectID(1080);
        $project->setTitel("ik ben de setters aan het testen");
        $project->setBeschrijving("de vorige waren vier tests 19 assertions en 1 fail maar die was moedwillig");
        $project->setDatumaangemaakt("2020-6-1 00:51:00");
        $project->setDeadline("2020-6-1 23:59:58");
        $project->setStatus("nog niet klaar");
        $project->setLocatie("Nederland");

        $this->assertEquals(1005,$project->getGebruikerID());
        $this->assertEquals(1080,$project->getProjectID());
        $this->assertEquals("ik ben de setters aan het testen",$project->getTitel());
        $this->assertEquals("de vorige waren vier tests 19 assertions en 1 fail maar die was moedwillig",
            $project->getBeschrijving());
        $this->assertEquals("2020-6-1 00:51:00",$project->getDatumaangemaakt());
        $this->assertEquals("2020-6-1 23:59:59",$project->getDeadline());
        $this->assertEquals("nog niet klaar",$project->getStatus());
        $this->assertEquals("Nederland",$project->getLocatie());
    }

}

?>