<?php

$_SERVER['DOCUMENT_ROOT'] = "C:/xampp/htdocs"; //is undefined dus zet ik hier als global variable

require_once 'C:/xampp/htdocs/StudentServices/Controller/GebruikerController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/ProjectController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/CategorieController.php';
require_once 'C:/xampp/htdocs/StudentServices/BaseClass/Project.php';

use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /***
     * hier wordt het de baseclass project getest dit doen we door eerst een nieuw object project te maken
     * daarna halen we de gegevens weer op en verglijken ze met de gegevens die we er in hebben gepusht
     *
     */

    public function testConstructbaseclass()
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
     * hier wordt weer de baseclass van de project getest hier doen we het update gedeelte van de baseclass testen
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

    /**
     * wat ik hier test is de filter van het project
     * dit doen ik door eerst een filter handmatig te creeren doormiddels van een $array
     * daarna heb een paar decaleren van objecten en variablen
     * daarna haal ik de juiste categorie id op
     * maak een paar array aan waar ik de op te halen waardes in doet.
     * daarna schrijf ik de variables met een categorie, type en status check
     * die verglijk ik met de waardes opgegeven in de filter en terug gekomen resultaten
     */

    public function testsortproject()
    {
        $array               = array(
            "status" => ["StatusK" => "Klaar"],
            "categorie" => ["Kleien" => "Kleien"],
            "type" => ["aanbod" => "Aanbieden"],
            "persoon" => ["zelf" => "welzelf"]
        );
        $gebruikerid         = 1002;
        $projectController   = new ProjectController();
        $categorieController = new CategorieController();
        $sql                 = $projectController->createFilter($gebruikerid,$array);
        $categorieid         = 0;
        foreach ($categorieController->getCategorieen() as $categorie) {
            if ($categorie->getCategorieNaam() == "Kleien") {
                $categorieid = $categorie->getCategorieID();
            }
        }
        $categorieidcheck   = array();
        $categorieidproject = array();
        $statuscheck        = array();
        $statuscheckproject = array();
        $typecheck          = array();
        $typecheckproject   = array();

        foreach ($projectController->getProjecten($sql) as $project) {
            $categorieidcheck[] = $categorieid;
            $statuscheck[]      = "Klaar";
            $typecheck[]        = "Aanbieden";
        }

        foreach ($projectController->getProjecten($sql) as $project) {
            $categorieidproject[] = $project->getCategorieID();
            $statuscheckproject[] = $project->getStatus();
            $typecheckproject[]   = $project->getType();

        }
        $this->assertTrue($categorieidcheck === $categorieidproject);
        $this->assertTrue($statuscheck === $statuscheckproject);
        $this->assertTrue($typecheck === $typecheckproject);
    }


    /**
     * wat ik hier doet is een nieuwe gebruiker aanmaken dit is makelijker omdat ik een gebruiker met los project kan testen
     * ik maak een nieuw project aan
     * daarna haal ik het project op en controleer ik of het goed in de database is weg geschrven
     * dat doe ik door het object wt ik terug krijgt de variables te controleren
     * daarbij kijk ik met veschillende test of er de juiste type variable terug komt
     * dan update een paar dingen en update hem in de database en kijk ik of er de juist geupdate is
     * dit doe ik door het opnieuw uit de database op te halen
     * en de variables uit het object halen en vergelijken
     * daarna verwijder ik de gebruiker en de project
     *
     */

    public function testcontrolesaddupdate()
    {
        $gebruikers = new GebruikerController(-1);
        $gebruikers->gebruikermodel->add("dirkus","test01","dirkvliet@gmail.com");
        $gebruikerid = $gebruikers->validate("dirkus","test01")->getGebruikerID();
        $projectController = new ProjectController();
        $projectController->add($gebruikerid,"unittest 8","Aanbieden",
            "beschrijving ik test het toevoegen en wijzingen gebruiker",20,"2020-6-1 17:59:59","Mee bezig","Den bosch");
        $project   = ($projectController->getByGebruikerID($gebruikerid))[0];
        $projectid = $project->getProjectID();
        $this->assertIsObject($project);
        $this->assertIsNumeric($project->getGebruikerID());
        $this->assertIsNumeric($project->getProjectID());
        //$time     = new DateTime($project->getDeadline());
        //$this->assertGreaterThan( $time->format("m/d/Y h:i:s a"), date('m/d/Y h:i:s a', time())); //check of deadline niet verlopen is
        $this->assertEquals("Aanbieden",$project->getType());
        $this->assertEquals("beschrijving ik test het toevoegen en wijzingen gebruiker",$project->getBeschrijving());
        $this->assertEquals("Mee bezig",$project->getStatus());
        $this->assertEquals("unittest 8",$project->getTitel());
        $project->setType("Vragen");
        $project->setBeschrijving("net had ik een hoop errors waar niet goed van werdt");
        $project->setStatus("Klaar");
        $project->setTitel("mooi ding nie");
        $projectController->Update($project);
        $project = null;
        $project   = ($projectController->getByGebruikerID($gebruikerid))[0];
        $this->assertEquals("Vragen",$project->getType());
        $this->assertEquals("net had ik een hoop errors waar niet goed van werdt",$project->getBeschrijving());
        $this->assertEquals("Mee bezig",$project->getStatus());
        $this->assertEquals("mooi ding nie",$project->getTitel());
        $projectController->delete($projectid);
        $gebruikers->delete($gebruikerid);
    }
}


