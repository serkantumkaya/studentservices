* voor het initen van de composer gebruiken we command: composer init

* voor het installeren van unit testen download phpunit.phar gooi die in de map war de testen staan
* check version phpunit:    php phpunit.phar --version
* voer het commando: composer require --dev phpunit/phpunit ^9.1
* ik voor het testen een file van het internet gehaald die pushen en pop van een array test
* maak een nieuw file met de naam StackTest.php
*plak deze code erin

<?php
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
}
 
 
*voer het commando uit :    php phpunit.phar StackTest.php
*hij voert hier een test uit met 5 assertions

mijn bron is:    https://phpunit.readthedocs.io/en/9.1/writing-tests-for-phpunit.html#test-dependencies

ik heb het uit gevoerd in de gitbash maar maak volgens mijn niets uit of je in de cmd of git doet.

rest is hieop verder bouwen met het spul van kenneth


