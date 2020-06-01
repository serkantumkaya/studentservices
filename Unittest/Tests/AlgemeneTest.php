<?php

use PHPUnit\Framework\TestCase;

require_once 'C:/xampp/htdocs/StudentServices/Model/SchoolModel.php';
require_once 'C:/xampp/htdocs/StudentServices/BaseClass/School.php';
require_once 'C:/xampp/htdocs/StudentServices/Controller/SchoolController.php';
require_once 'C:/xampp/htdocs/StudentServices/Includes/DB.php';

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
}

?>