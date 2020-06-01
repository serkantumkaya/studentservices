<?php

$_SERVER['DOCUMENT_ROOT'] = "C:/xampp/htdocs"; //is undefined dus zet ik hier als global variable

require_once 'C:/xampp/htdocs/StudentServices/Controller/ProjectController.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/CategorieController.php';
require_once 'C:/xampp/htdocs/StudentServices/BaseClass/Project.php';

use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /***
     * hier wordt het de baseclass gebruiker getest dit doen we door eerst een nieuw object gebruiker te maken
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
/*
    public function testsortproject()
    {
        $array = array(
            "status" => ["StatusK" => "Klaar","StatusMB" => "Mee Bezig"],
            "categorie" => ["Kleien" => "Kleien"],
            "type" => ["aanbod" => "Aanbieden"],
            "persoon" => ["zelf" => "welzelf"]
        );
        $gebruikerid       = 1002;
        $projectController = new ProjectController();
        $categorieController = new CategorieController();
        $categorieid = 0;
        foreach ($categorieController->getCategorieen() as $categorie){
            if($categorie->getCategorieNaam() == "Kleien") {
                $categorieid = $categorie->getCategorieID();
                break;
            }
        }
        $sql               = $projectController->createFilter($gebruikerid,$array);
        $project = $projectController->getProjecten($sql);
        $verglijkcategorie = array();
             $this->assertEquals($verglijkcategorie[$counter],$project->getCategorieID());
            $this->assertEquals( $verglijkcategorienaam[$counter] ,$project->getType() );


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
    /*
        public function testcontrolesaddupdate()
        {
            $gebruikers = new GebruikerController(-1);
            $this->assertNotEmpty($gebruikers->add("dirkus","test01","test1","dirkvliet@gmail.com"));
            $this->assertNotEmpty($gebruikers->add("dirkus","test01","test01","dirkvlietgmail.com"));
            $this->assertNotEmpty($gebruikers->add("","test1","test1","dirkvliet@gmail.com"));
            $this->assertNotEmpty($gebruikers->add("dirkus","test01","test01","dirkvliet@gmail.com"));
            $gebruiker = $gebruikers->validate("dirkus","test01");
            $gebruiker->setEmail("dirk353@outlook.com");
            $this->assertNotEmpty($gebruikers->update($gebruiker)); //???????
            $gebruiker->setGebruikersnaam("");
            $this->assertNotEmpty($gebruikers->update($gebruiker));
            $gebruiker->setGebruikersnaam("dirkus");
            $this->assertNotEmpty($gebruikers->validate("dirkus","test01"));
            $gebruikerid = $gebruikers->validate("dirkus","test01")->getGebruikerID();
            $gebruikers->delete($gebruikerid);
        }*/
}
