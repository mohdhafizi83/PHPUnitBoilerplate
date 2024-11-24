<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{

    public function testResetSession()
    {
		$sample = new Sample();
		
        $_SESSION['numberA'] = 100;
        $_SESSION['numberB'] = 50;
        $_SESSION['123456789012_someKey'] = 'someValue';
        $_SESSION['notMatchedKey'] = 'value';

        $sample->resetSession();

        $this->assertArrayNotHasKey('numberA', $_SESSION);
        $this->assertArrayNotHasKey('numberB', $_SESSION);
        $this->assertArrayNotHasKey('123456789012_someKey', $_SESSION);
        $this->assertArrayHasKey('notMatchedKey', $_SESSION);
    }	
}



?>