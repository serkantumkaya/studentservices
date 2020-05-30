<?php

use PHPUnit\Framework\TestCase;

require_once ('vendor/autoload.php');
include 'testsample.php';




class unittestsample extends TestCase
{

    public function testTextInlogPagUserNameLabelNL(){
        $res = Translate::GetTranslation("inlogPagUserNameLabel");
        $this->assertEquals("Gebruikersnaam:",$res);
    }

    public function testTextInlogPagUserNameLabelEN(){
        $res = Translate::GetTranslation("inlogPagUserNameLabel");
        $this->assertEquals("Username:",$res);
    }

/*    public function testSom(){
        $x = 11;
        $y = 12;

        $result = som($x,$y);
        $this->assertEquals(23,$result);
    }*/

}

?>