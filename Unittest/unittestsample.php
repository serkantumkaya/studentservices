<?php

use PHPUnit\Framework\TestCase;

//require_once ('vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Controller/GebruikerController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/GebruikerModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/Gebruiker.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/DB.php");

class unittestsample extends TestCase
{

    //public function testTextInlogPagUserNameLabelNL(){
    //    $res = Translate::GetTranslation("inlogPagUserNameLabel");
    //    $this->assertEquals("Gebruikersnaam:",$res);
    //
    //}

    //public function testTextInlogPagUserNameLabelEN(){
    //    $res = Translate::GetTranslation("inlogPagUserNameLabel");
    //    $this->assertEquals("Username:",$res);
    //
    //}

    public function testInlogSHA()
    {
        $a = 1 + 2;
        $this->assertEquals("3",$a);
    }

    public function testInlogSHA()
    {
        $GebruikerController = new GebruikerController(1005);
        $DB = new ConnectDB();
        $gebruiker = $GebruikerController->Validate("Patrick",$DB->MakeSafe("Welkom01"));
        $this->assertEquals("Patrick",$gebruiker->getGebruikersnaam(),"Login failed");
    }

    //public function testWrongInlogSHA(){
    //    $GebruikerController = new GebruikerController();
    //    $gebruiker = $GebruikerController->Validate("Patrick",MakeSafe("Welkom"));
    //    $this->assertEquals("Patrick",null);
    //
    //}
    //
    //public function testCheckIfAdmin(){
    //    $GebruikerController = new GebruikerController();
    //    $gebruiker = $GebruikerController->Validate("Patrick",MakeSafe("Welkom01"));
    //    $level = $GebruikerController->checkRechten();
    //    $this->assertEquals("100",$level);
    //
    //}


    /*    public function testSom(){
            $x = 11;
            $y = 12;

            $result = som($x,$y);
            $this->assertEquals(23,$result);
        }*/

}

?>