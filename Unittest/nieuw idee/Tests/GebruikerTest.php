<?php

$_SERVER['DOCUMENT_ROOT'] = "C:/xampp/htdocs"; //is undefined dus zet ik hier als global variable

require_once 'C:/xampp/htdocs/StudentServices/Controller/GebruikerController.php';
require_once 'C:/xampp/htdocs/StudentServices/BaseClass/Gebruiker.php';

use PHPUnit\Framework\TestCase;

class GebruikerTest extends TestCase
{
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
}
