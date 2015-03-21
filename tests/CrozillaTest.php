<?php
use Mabasic\CrozillaIntegration\Crozilla;

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
