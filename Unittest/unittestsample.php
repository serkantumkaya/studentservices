<?php

use PHPUnit\Framework\TestCase;

require_once ('vendor/autoload.php');
include 'testsample.php';


require_once ("Model/SchoolModel.php");
require_once ("BaseClass/School.php");
require_once ("Controller/SchoolController.php");
require_once ("Includes/DB.php");

class unittestsample extends TestCase
{

    public function testTextInlogPagUserNameLabelNL(){
        $res = Translate::GetTranslation("inlogPagUserNameLabel");
        $this->assertEquals("Gebruikersnaam:",$res);
    }

<<<<<<< Updated upstream
    public function testReactieIDopvragen(){
        $this->assertClassHasAttribute('ReactieID', Reactie::class);
        }

/*    public function testSom(){
        $x = 11;
        $y = 12;

        $result = som($x,$y);
        $this->assertEquals(23,$result);
    }*/
=======
    public function testFeedback(){
        $this->assertClassHasAttribute('Review',Feedback::class);
    }

    public function testNewSchool()   {
        $School = new School(1,"EenSchool");
        $this->assertNotNull($School);
    }

    public function testNewOpleiding()   {
        $Opleiding = new Opleiding(1, "Unittesten", "Voltijd");
        $this->assertNotNull($Opleiding);
    }

    public function testHeeftReactieAtribuutReactieID(){
        $this->assertClassHasAttribute('ReactieID',Reactie::class);
    }

    public function testIsReactielijsteenArray(){
      $Reactielijst = array();
      $this->assertIsArray($Reactielijst);
    }

    public function testMapLocatieLeesbaar()
    {
        $this->assertDirectoryIsReadable('C:xampp/htdocs/StudentServices/Controller');
    }
>>>>>>> Stashed changes

    public function testGetSchool(){
        $sc = new SchoolController();
        $school = $sc->getById(1000);
        $this->assertNotNull($school);
    }
}

?>