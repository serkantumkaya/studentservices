<?php

use PHPUnit\Framework\TestCase;

require_once('vendor/autoload.php');

class unittestsample extends TestCase
{

    public function testTextInlogPagUserNameLabelNL(){
        $res = Translate::GetTranslation("inlogPagUserNameLabel");
        $this->assertEquals("Gebruikersnaam:", $res);
    }

    public function testReactieIDopvragen(){
        $this->assertClassHasAttribute('ReactieID', Reactie::class);
    }

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



}

?>