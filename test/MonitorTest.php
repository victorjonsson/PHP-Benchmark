<?php

use PHPBenchmark\Monitor;

class MonitorTest extends PHPUnit_Framework_TestCase
{

    /** @var \PHPBenchmark\MonitorInterface */
    private static $monitor;

    public function setUp()
    {
        parent::setUp();
        self::$monitor = new Monitor();
        self::$monitor->init();
    }

    public function testMonitor()
    {
        self::$monitor->snapShot('begin');
        require_once __DIR__ . '/dummy-php-file.php';
        self::$monitor->snapShot('after-include');
        $bytes = str_repeat('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 10000);
        $snapShots = self::$monitor->getSnapShots();

        $this->assertEquals(3, count($snapShots));
        $this->assertEquals(1, $snapShots['after-include']->numFilesIncludedSincePreviousSnapshot());
        $this->assertNotEmpty($snapShots['after-include']->memoryAllocationDifference());
    }

}