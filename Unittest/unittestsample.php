<?php

use PHPUnit\Framework\TestCase;

include 'testsample.php';

class unittestsample extends TestCase {
	
	public function testSom() 
	{
		$x = 11;
		$y = 12;
		
		$result = som($x, $y);
		$this->assertEquals(23, $result);
	}
	
	public function testMinimum()
	{
		$x = 100;
		$y = 50;
		
		$result = minimum($x, $y);
		
		$this->assertEquals(50, $result);
		
		$x = -100;
		$y = -50;
		
		$result = minimum($x, $y);
		
		$this->assertEquals(-100, $result);
	}
	
	public function testProduct()
	{
		$x = 100;
		$y = 50;
		
		$result = product($x, $y);
		
		$this->assertEquals(5000, $result);
		
		$x = 0.1;
		$y = 0.25;
		
		$result = product($x, $y);
		
		$this->assertEquals(0.025, $result);
	}
	
	public function testModulo()
	{
		$getal = 97;
		$deler = 10;
		
		$result = modulo($getal, $deler);
		
		$this->assertEquals(7, $result);
		
		$result = modulo(45, 0);
		
		$this->assertEquals(45, $result);
		
		$getal = 95;
		$deler = -10;
		
		$result = modulo($getal, $deler);
		
		$this->assertEquals(5, $result);
	}
	
	public function testInhoud()
	{
		$h = 5;
		$b = 2.5;
		$l = 7;
		
		$result = inhoud($h, $b, $l);
		
		$this->assertEquals(87.5, $result);
		
		$h = -5;
		$b = 2.5;
		$l = 7;
		
		$result = inhoud($h, $b, $l);
		
		$this->assertEquals(0, $result);
		
		$h = 0;
		$b = 2.5;
		$l = 7;
		
		$result = inhoud($h, $b, $l);
		
		$this->assertEquals(0, $result);
	}
	
	public function testCheckIfLarger()
	{
		$x = 5;
		$y = 10;
		
		$result = checkIfLarger($x, $y);
		
		$this->assertFalse($result);
		
		$x = 17;
		$y = 12;
		
		$result = checkIfLarger($x, $y);
		
		$this->assertTrue($result);
	}
	
}
	
?>