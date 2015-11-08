<?php

use \PHPBenchmark\testing\metrics\PerformanceSnapshot;


class PerformanceSnapShotTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \PHPBenchmark\testing\metrics\PerformanceSnapshotInterface
     */
    protected static $initSnap;

    protected function setUp()
    {
        self::$initSnap = new PerformanceSnapshot();
    }

    function testCreationOfSnapShots()
    {
        $this->assertEmpty(self::$initSnap->timePassed());
        $this->assertNotEmpty(self::$initSnap->numClassesDeclared());
        $this->assertNotEmpty(self::$initSnap->numFilesIncluded());

        usleep(100);

        $snapShot = new PerformanceSnapshot(self::$initSnap);
        $this->assertNotEmpty($snapShot->timePassed());

        $bits = str_repeat('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 10000);
        $snapShot = new PerformanceSnapshot(self::$initSnap);
        $this->assertNotEmpty($snapShot->memoryAllocationDifference());

    }

}