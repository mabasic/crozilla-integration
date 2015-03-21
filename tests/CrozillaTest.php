<?php namespace Tests;

use Mabasic\CrozillaIntegration\Crozilla;
use Mockery;
use PHPUnit_Framework_TestCase;

class CrozillaTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function it_works()
    {
        $writer = Mockery::mock('Sabre\Xml\Writer');

        $crozilla = new Crozilla($writer);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
